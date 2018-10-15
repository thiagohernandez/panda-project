<?php

namespace App;

/**
 * Base controller for all "User" controllers
 *
 * Users must be logged in to be able to use these controllers
 *
 */
class UserPixie extends \PHPixie\Controller {
	
	public function before() {
		// Make sure you're logged in as a valid user
		$this->debug->sql_prefix('Auth');
		$auth = $this->pixie->auth;
		if ($auth->user()) {
			// This sets the view template file for user pages
			$this->view = $this->pixie->view('user/_template');
			$this->view->pagetitle = $this->pixie->site_name;

			// Set a default subview based on controller/action
			$controller = strtolower($this->request->param('controller'));
			$action = strtolower($this->request->param('action'));
			$this->view->subview = $controller.'_'.$action;
		}
		else {
			$this->redirect('/login');
		}
		$this->debug->sql_prefix('App');
	}

	public function after() {
		$this->pixie->debug->sql_prefix('View');
		$this->response->body = $this->view->render();
	}

}
