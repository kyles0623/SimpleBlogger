<?php


define('ACCESS',true);
define('DS',DIRECTORY_SEPARATOR);
define('MODE','admin');
define('ADMIN_WEB_PATH',dirname($_SERVER['PHP_SELF']).DS);
define('WEB_PATH',dirname($_SERVER['PHP_SELF']).DS);
define('BASE_PATH',dirname(__FILE__));
require_once(BASE_PATH.DS.'config'.DS.'init.php');