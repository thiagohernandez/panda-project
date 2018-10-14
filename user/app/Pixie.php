<?php

namespace App;

/**
 * This is the master Pixie object for your application
 *
 * This object is available everywhere in your app, it
 * binds everything together and gives you access to all
 * the pixie modules, etc.
 *
 * Here you add overrides to replace system components.
 *
 * FTB.
 */
class Pixie extends \PHPixie\Pixie {

	// This enables developer mode. In developer mode you see error messages and debug output.
	public $devmode = false;

	// Set this to 'true' to load bootstrap and jQuery via CDN in the '_template' files
	public $use_CDN = true;

	// The name of your web site (usually shown in the page title)
	public $site_name = "Broker Panda";

	// This is called before the app runs
	protected function before_bootstrap() {
		// Set the character encoding for the output
		//
		// Do *NOT* change this to "UTF-8"!
		// Seriously, DON'T...it breaks all sorts of things (eg. "htmlentities()")
		// Write your code to produce &HTML; codes instead.
		ini_set('default_charset', 'ISO-8859-1');		// ...or whatever charset you use in your text

		// PHP is rubbish
		date_default_timezone_set("Europe/Madrid");

		// Set the basepath so that all links, etc. will work even when the app is in a subfolder.
		$this->basepath = '/user';
		
		// Is this a dev machine?
		if (strstr($this->root_dir,':\Apache24\htdocs')!==false) {		// Or whatever your setup is...
			// Yes, enable debug mode
			$this->devmode = true;
			$this->debug->display_errors = true;
		}
	}

	// Whatever code you want to run after bootstrap is done.
	protected function after_bootstrap() {
		try {
			$this->debug->sql_prefix('Auth');		// Show this as "Auth" in the SQL log
			if (!$this->devmode && $this->auth->user()) {
				// devmode is set when you're a 'dev'
				$this->devmode = $this->auth->has_role('dev');
				// Errors are shown if you're admin
				$this->debug->display_errors = $this->devmode||$this->auth->has_role('admin');
			}
		}
		catch (\Exception $e) {
			$this->debug->log('Auth exploded');
			// Auth threw an exception - assume the database is missing, show all error info
			$this->devmode = true;
			$this->debug->display_errors = true;
		}
		$this->debug->sql_prefix('App');		// SQL log now shows the app has started
	}
	
// My view Helper
	public $language_prefix = '';
	public function view_helper() {	return new \App\View\Helper($this);	}

// Flash messages - stored in PHP session so they're visible after a redirect
	// Set/get confirmation message
	public function confirm($msg) {	$this->session->flash('flash_confirm',$msg);		}
	public function get_confirm() {	return $this->session->flash('flash_confirm');	}

	// Set/get fail message
	public function fail($msg) {	$this->session->flash('flash_fail',$msg);		}
	public function get_fail() {	return $this->session->flash('flash_fail');	}
}
