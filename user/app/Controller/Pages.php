<?php

/**
 * This controller does no authentication
 *
 * Use it for pages where the user doesn't need to be logged in
 */
 
namespace App;

class Pages extends \PHPixie\Controller {

	// Basic setup for the view
	public function before() {
		// The view template for this page
		$this->view = $this->pixie->view('user/_template');

		// Page title
		$this->view->pagetitle = $this->pixie->site_name;

		// A default subview based on the action in the URL
		$this->view->subview = 'pages/'.strtolower($this->request->param('action'));
	}

	public function action_index() {
		$this->action_dashboard();
	}

/*------------------------------------------------------
	Main dashboard view page
 ------------------------------------------------------*/
	public function action_dashboard() {
		$user = $this->utils->get_user();
		$userLevel = (int)$this->request->param('id');
		if (($userLevel < 1) || ($userLevel > 3)) {
			$userLevel = 1;
		}
		$user->level_id = (int)$userLevel;
		$user_companies = $this->get_subcriptions($user);

		$this->view->subview = 'pages/dashboard';
		$this->language->setLanguage("es");
		$this->view->text = $this->language;
		
		$now = time();
		$earlyBird = 0;
		/*if ($this->isClub30($user)) {
			$earlyBird = 31*60;
		}*/

		// Swizzle the exchanges
		$exchanges = $this->utils->swizzle('indexes');
		foreach ($exchanges as &$e) {
			$e->has_alert = false;
			$e->companies = array();
			if ($e->id == $user->country_id) {
				$user->continent_id = $e->continent_id;
			}
		}
		// Swizzle the companies
		$companies = $this->utils->swizzle('companies');
		foreach ($companies as &$c) {
			if ($c->index_id != 0) {
				if ($c->has_alert) {
					// Are we between start and end?
					$start = strtotime($c->alert_start)-$earlyBird;
					$end = strtotime($c->alert_end);
					if (($start > $now) || ($now > $end)) {
						$c->has_alert = false;		// Not active
					}
					if ($c->has_alert) {
						$exchanges[$c->index_id]->has_alert = true;
					}
				}
				$exchanges[$c->index_id]->companies[] = $c->id;
			}
		}
		//echo '<pre>';var_dump($exchanges);die;
		$this->view->user = $user;
		$this->view->baseURL = $this->pixie->basepath;
		$this->view->fx_mode = false;
		$this->view->enableExtras = false;
		$this->view->exchanges = $exchanges;
		$this->view->companies = $companies;
		$this->view->user_companies = $user_companies;
	}
/*------------------------------------------------------
	BBVA demo page
 ------------------------------------------------------*/
	public function action_demo() {
		$user = $this->utils->get_user();
		$userLevel = (int)$this->request->param('id');
		if (($userLevel < 1) || ($userLevel > 3)) {
			$userLevel = 1;
		}
		$user->level_id = (int)$userLevel;
		$user_companies = $this->get_subcriptions($user);

		$this->view->subview = 'pages/bbva';
		$this->language->setLanguage("es");
		$this->view->text = $this->language;
		
		$now = time();
		$earlyBird = 0;
		/*if ($this->isClub30($user)) {
			$earlyBird = 31*60;
		}*/

		// Swizzle the exchanges
		$exchanges = $this->utils->swizzle('indexes');
		foreach ($exchanges as &$e) {
			$e->has_alert = false;
			$e->companies = array();
			if ($e->id == $user->country_id) {
				$user->continent_id = $e->continent_id;
			}
		}
		// Swizzle the companies
		$companies = $this->utils->swizzle('companies');
		foreach ($companies as &$c) {
			if ($c->index_id == 7) {		// IBEX
				if ($c->has_alert) {
					// Are we between start and end?
					$start = strtotime($c->alert_start)-$earlyBird;
					$end = strtotime($c->alert_end);
					if (($start > $now) || ($now > $end)) {
						$c->has_alert = false;		// Not active
					}
					if ($c->has_alert) {
						$exchanges[$c->index_id]->has_alert = true;
					}
				}
				$exchanges[$c->index_id]->companies[] = $c->id;
			}
		}
		//echo '<pre>';var_dump($exchanges);die;
		$this->view->user = $user;
		$this->view->baseURL = $this->pixie->basepath;
		$this->view->fx_mode = false;
		$this->view->enableExtras = false;
		$this->view->exchanges = $exchanges;
		$this->view->companies = $companies;
		$this->view->user_companies = $user_companies;
	}

/*--------------------------------------------------
	User subscriptions (managed via AJAX)
 --------------------------------------------------*/
	private function ajax($result) {
		//$this->utils->dump($result);die;
		echo json_encode($result);
		die;
	}
	private $subs_table = 'companies_users_joins';
	private function get_subcriptions($user) {
		$subs = $this->db->query('select')->table($this->subs_table)
			->where('user_id', $user->id)
			->fields('company_id')
			->execute();
		$result = array();
		foreach ($subs as $s) {
			$result[] = $s->company_id;
		}
		return $result;
	}

	private function is_subscribed_to($user,$companyId) {
		$c = $this->db->query('count')->table($this->subs_table)
			->where('user_id', $user->id)
			->where('company_id', $companyId)
			->execute();
		$this->debug->log_to_file("count=".$c);
		return ($c != 0);
	}
	public function action_subscribe() {
		$company_id = (int)$this->request->param('id');
		if ($company_id > 0) {
			$user = $this->utils->get_user();
			if (!$this->is_subscribed_to($user,$company_id)) {
				$this->db->query('insert')->table($this->subs_table)
					->data(array('user_id' => $user->id, 'company_id' => $company_id))
					->execute();
				$this->ajax(array('text'=>'You subscribed to: '.$company_id));
			}
			else {
				$this->ajax(array('text'=>'You were already subscribed to: '.$company_id));
			}
		}
		$this->ajax(array('text'=>'Bad call to subscribe()'));
	}
	public function action_unsubscribe() {
		$company_id = (int)$this->request->param('id');
		if ($company_id > 0) {
			$user = $this->utils->get_user();
			if ($this->is_subscribed_to($user,$company_id)) {
				$this->db->query('delete')->table($this->subs_table)
					->where('user_id', $user->id)
					->where('company_id', $company_id)
					->execute();
					$this->ajax(array('text'=>'You unsubscribed from: '.$company_id));
			}
			else {
				$this->ajax(array('text'=>'You weren\'t subscribed to: '.$company_id));
			}
		}
		$this->ajax(array('text'=>'Bad call to unsubscribe()'));
	}
}
