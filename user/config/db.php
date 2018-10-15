<?php
if (strstr(dirname(__DIR__), 'C:\Apache24\htdocs\panda')!==false) {
	return array(
		'default' => array(
			'user' => 'panda',
			'password' => 'panda',
			'driver' => 'PDO',

			// PDO connections (choose one)
			'connection' => 'mysql:host=127.0.0.1;dbname=db591158991',
			//'connection' => 'sqlite:'.dirname(__DIR__).'/database.sqlite',

			// Direct MySQLi driver
			'db'  => 'db591158991',
			'host' => 'localhost'
		)
	);
}
else {
	return array(
		'default' => array(
			'user' => 'dbo591158991',
			'password' => 'jHHdgyeBH56',
			'driver' => 'PDO',

			// PDO connections (choose one)
			'connection' => 'mysql:host=db591158991.db.1and1.com;dbname=db591158991',
			//'connection' => 'sqlite:'.dirname(__DIR__).'/database.sqlite',

			// Direct MySQLi driver
			'db'  => 'db591158991',
			'host' => 'db591158991.db.1and1.com'
		)
	);
}

