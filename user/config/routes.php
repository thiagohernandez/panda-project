<?php

return array(
	'home' => array('/', 
		array(
			'controller' => 'Pages',
			'action' => 'index'
		),
	),
	'default' => array('(/<controller>(/<action>(/<id>)))', 
		array(
			'controller' => 'Pages',
			'action' => 'index'
		),
	)
);
