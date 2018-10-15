<?php
/*---------------------------------------------------------
	Login & password management functions
 ----------------------------------------------------------*/

namespace App;

class Login extends \PHPixie\Controller {

	// Set up the template for this page
	public function before() {
		$this->view = $this->pixie->view('user/_template');
		$this->view->pagetitle = $this->pixie->site_name;
		$this->view->subview = 'pages/login/'.strtolower($this->request->param('action'));
	}

/*--------------------------------------------------
	Login page
 --------------------------------------------------*/
	public function do_login($prompt, $role, $type) {
		$this->view->subview = 'pages/login/login';
		$this->view->prompt = $prompt;
		$this->view->role = $role;
		$this->view->type = $type;
	}
	public function action_index() 				{	$this->do_login('Email','user', 'email');				}
	public function action_login_admin() 	{	$this->do_login('Admin login','admin', 'text');	}

	// This is called from the input form
	public function action_login() {
    if ($this->request->method == 'POST') {
			$id = $this->request->post('identifier');
			$password = $this->request->post('password');
			$role = $this->request->post('role');

			$auth = $this->pixie->auth;
			$auth->provider('password')->login($id,$password);
			$user = $auth->user();
			if (!empty($user)) {
				if ($auth->has_role('admin')) {
					return $this->redirect('/admin');
				}
				return $this->redirect('/user');
			}
			$this->pixie->fail('Login failed!');
			if ($role=='admin') { $this->redirect('/login/login_admin'); }
		}
		// Something is wrong, try again
		$this->redirect('/login');
	}

	public function action_logout() {
		$auth = $this->pixie->auth;
		if ($auth->user()) {
			$auth->logout();
		}
		$this->redirect('/');
	}

/*--------------------------------------------------
	AJAX login
 --------------------------------------------------*/
	private function request($k) {
    if ($this->request->method == 'POST') {
			return $this->request->post($k);
		}
		else {
			return $this->request->get($k);
		}
	}
	public function action_login_ajax() {
		$reply = array('result' => false, 'reason' => '');
		$email = urldecode($this->request('email'));				$reply['email'] = $email;
		$pass  = urldecode($this->request('password'));
		$auth = $this->pixie->auth;
		if ($auth->provider('password')->login($email, $pass)) {
			$reply['result'] = true;
			$reply['url'] = '/user/';
		}
		else {
			$reply['reason'] = 'bad login';
		}
		$this->ajax_reply($reply);
	}

/*--------------------------------------------------
	AJAX - Check if an email exists in the database
 --------------------------------------------------*/
	private function isTest($email) {
	 return ($email === "prueba@brokerpanda.com") || !$this->pixie->devmode;
	}
	public function action_check_email_exists() {
		$reply = array('result' => false, 'reason' => '');
		$email = urldecode($this->request('email'));			$reply['email'] = $email;
		if (!$this->isTest($email)) {
			$c = $this->db->query('count')->table('users')->where('email',$email)->execute();
			$reply['result'] = (int)$c > 0;
		}
		$this->ajax_reply($reply);
	}

/*--------------------------------------------------
	AJAX - register a new user
 --------------------------------------------------*/
	public function action_register() {
		$reply = array('result' => false, 'reason' => '');
		$email = urldecode($this->request('email'));				$reply['email'] = $email;
		$pass  = urldecode($this->request('password'));
		if ($this->isTest($email)) {
			// Delete previous user if this is the test email address
			$user = $this->orm->get('user')->where('email',$email)->find();
			while ($user->loaded()) {
				$this->db->query('delete')->table('companies_users_joins')->where('user_id',$user->id())->execute();
				$user->delete();
				$user = $this->orm->get('user')->where('email',$email)->find();
			}
			// Clean up ghost users (we need to find out who's making these - google robot?)
			$this->db->query('delete')->table('users')->where('email',null)->execute();
		}
		$user = $this->orm->get('user')->where('email',$email)->find();
		if ($user->loaded()) {
			$reply['result'] = false;
			$reply['reason'] = 'already exists';
		}
		else if (strlen($email)>0) {
			$at = strpos($email,'@');
			if (($at != false) && ($at > 0) && ($at < (strlen($email)-1))) {
				$auth = $this->auth->provider('password');
				// Create a new user
				$user = $this->orm->get('user');
				$user->email = $email;
				$user->password = $auth->hash_password($pass);
				$user->level_id = 1;
				$user->country_id = 7;
				$user->save();
				// Select some companies for alerts
				if ($auth->login($email,$pass)) {
					$reply['result'] = true;
					$reply['reason'] = 'register OK';
					$reply['url'] = '/user/';
					$ibex = $this->db->query('select')
						->table('companies')
						->where('index_id',$user->country_id)
						->where('top10',1)
						->execute()->as_array();
					foreach ($ibex as $i) {
						$this->db->query('insert')
							->table('companies_users_joins')
							->data(array(
								'user_id' => $user->id(),
								'company_id' => $i->id
							))
							->execute();
					}
				}
			}
		}
		$this->ajax_reply($reply);
	}

/*--------------------------------------------------
	Send reminder emails + respond to them
 --------------------------------------------------*/
	// Create a reset token for the user
	private function generate_token() {
		return base64_encode(pack('N4', mt_rand(), mt_rand(), mt_rand(), mt_rand()));
	}
	// Send a reset email
	private function send_reset_mail($email) {
		$result = false;
		if ($email) {
			$user = $this->pixie->orm->get('user')->where('identifier',$email)->find();
			if ($user->loaded()) {
				$user->token = $this->generate_token();
				$user->save_fields('token');
				$crlf = "\r\n";
				$p = $this->pixie;
				$server_name = $p->server_name();
				$link = $p->server().$p->basepath.'/login/reset_password?token='.$user->token.$crlf.$crlf;
				$no_reply = $this->view->text('LoginNoReply');
				$subject = $this->view->text('LoginEmailSubject');
				$follow = $this->view->text('LoginEmailFollowLink');
				$thanks = $this->view->text('LoginEmailThanks');
				$team = $this->view->text('LoginEmailTheTeam');
				$params = array(
					'to' => $email,
					'from' => "$no_reply@$server_name",
					'subject' => "$subject $server_name",
					'message' => "$follow$crlf$crlf$link$crlf$crlf$thanks$crlf$team"
				);
				$this->debug->pretty($params);//die;
				$result = $this->email->send($params);
			}
			else {
				sleep(5);		// Annoy the hackers
			}
		}
		return $result;
	}

	// This displays a page for users to enter an email adress and get a reset email
	public function action_recover_password() {
    if ($this->request->method == 'GET') {
			$email = $this->request->get('email');
			$this->send_reset_mail($email);
			return;
		}
		$this->redirect('/pages/forgot_password');
	}

	// This is called after "recover_password()" when the user enters their email address (AJAX)
	public function action_send_reminder() {
		$email = null;
		if ($this->request->method == 'POST') {
			$email = $this->request->post('email');
		}
		else if ($this->request->method == 'GET') {
			$email = $this->request->get('email');
		}
		$result = array('success' => $this->send_reset_mail($email));
		$this->ajax_reply($result);
	}

	// This is called via the link that was sent in the email
	public function action_reset_password() {
		if ($this->request->method == 'GET') {
			$token = $this->request->get('token');
			$user = $this->pixie->orm->get('user')->where('token',$token)->find();
			if ($user->loaded()) {
				$this->view->token = $token;
				return;
			}
			else {
				$this->view->subview = 'pages/login/bad_reset';
				return;
			}
		}
		$this->redirect('/');		// Was called incorrectly
	}
	// This AJAX function is called from the reset password form after the user enters a new password
	// It needs the correct token to work.
	public function action_do_password_reset() {
		$result = array('success' => false);
		if ($this->request->method == 'POST') {
			$token = $this->request->post('token');					$result['token'] = $token;
			$password = $this->request->post('password');		$result['password'] = $password;
			if ((strlen($token)>0) && (strlen($password)>0)) {
				$user = $this->pixie->orm->get('user')->where('token',$token)->find();
				$result['found'] = $user->loaded();
				if ($user->loaded()) {
					$auth = $this->pixie->auth;
					$user->password = $auth->provider('password')->hash_password($password);
					$user->token = '';		// Token is single-use
					$user->save();
					// Try to log the user in using the new password (should never fail...!)
					if ($auth->provider('password')->login($user->identifier, $password)) {
						$result['success'] = true;
					}
				}
			}
		}
		$this->ajax_reply($result);
	}
	
}
