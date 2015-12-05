<?php
return array(
	'sitename' => 'Разработка сайтов',
	'encode' => 'utf-8',
	'cookietime' => 3600,
	'version' => '1.0.4 ',
	'default_controller' => 'index',
	'default_action' => 'index',
    'db' => include 'db.php',
	'router' => array( 
		'([a-z0-9+_\-]+)/([a-z0-9+_\-]+)/([0-9]+)' => '$controller/$action/$id',
        '([a-z0-9+_\-]+)/([a-z0-9+_\-]+)' => '$controller/$action',
        '([a-z0-9+_\-]+)/?' => '$controller',
        '([a-z0-9+_\-]+\.html)' => 'page/read/$controller',
	),
	'scripts'=>array(
		'/assets/js/jquery-2.1.3.min.js',
		'/assets/js/bootstrap.min.js',
		'/assets/js/scripts.js',
	),
	'styles'=>array(
		'/assets/css/bootstrap.min.css',
		'/assets/css/bootstrap-theme.min.css',
		'/assets/css/styles.css',
	),
);