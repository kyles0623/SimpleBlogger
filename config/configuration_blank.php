<?php
defined('ACCESS') or die('Access Denied');
error_reporting(E_ALL);
define('DB_HOST','localhost');
define('DB_USER','');
define('DB_PASS','');
define('DB_NAME','blog');
define('ACCESS_DENIED','You do not have access to view this page');
define('ACTIVE_TEMPLATE','default');
define('ADMIN_TEMPLATE','default');
define('MAX_POSTS_ON_PAGE',10);
define('ADMIN_EMAIL','');

//If You set the mode to construction it will go to the construction template defaulted with the templates, otherwise make it live.
define('SITE_MODE','live');
define('DEFAULT_ERROR_MESSAGE',"We could not find the page you were looking for. Better Luck Next Time!");

define('BLOG_TITLE','');
