<?php

namespace App;

// nb. This class extends 'UserPixie', ie. you must be logged in to use it
class User extends \App\UserPixie {

	public function action_index() {
		$auth = $this->pixie->auth;
		$user = $auth->user();
		$this->view->user_id = $user->identifier;
		$this->view->user_role = $user->role->name;
	}


}

