<?php
session_start();

define('ROOT', dirname(__FILE__) . '/');
define('IDEAL', dirname(__FILE__) . '/ideal/');
define('APP', dirname(__FILE__) . '/application/');
define('CONFIG', dirname(__FILE__) . '/ideal/config/');
define('DATABASES', dirname(__FILE__) . '/ideal/databases/');
define('USER_IMAGES', dirname(__FILE__) . '/assets/images/users/');

include IDEAL . 'framework.php';

App::gi()->start();