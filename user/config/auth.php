<?php

return array(
	'default' => array(
		// The model that has the user info
		'model' => 'user',
		// List of login providers
		'login' => array(
			// Login via password
			'password' => array(
				'login_field' => 'email', 						// Column used as the login field
				'password_field' => 'password', 			// Column used as the password field, varchar(128)
				'login_token_field' => 'login_token',	// Name of column in "users" database table where the login token is stored, varchar(64)
				'hash_method' => 'panda'
			)
		),
		// Configuration of user roles
		'roles' => array(
			'driver' => 'relation',
			'type' => 'belongs_to',
			'name_field' => 'name', //Column for the name of the roles
			'relation' => 'role',   //Name of the role table
			'field' => 'name'				//Role's name field in the role table
		)
	)
);
