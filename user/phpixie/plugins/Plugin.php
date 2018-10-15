<?php
/*
 * A generic plugin object for PHPixie
 *
 * It's a good idea to make your Controller plugins children of this object
 *
 * It gives you easy access to the global 'pixie' object and also the Controller.
 */
 
namespace PHPixie;

class Plugin {

	// My PHPixie objects
	protected $pixie;
	protected $controller;
	
	// The objects are passed to the contructor of a plugin
	public function __construct($p,$c) {
		$this->pixie = $p;
		$this->controller = $c;
	}

	// This function is called after the object is constructed
	public function on_load() {}
}
