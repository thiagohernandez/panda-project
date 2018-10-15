<?php

namespace App\Model;

class User extends \PHPixie\ORM\Model {

	public $table='users';

	protected $belongs_to = array('role');
}

