<?php
/**
 * SimpleBlog 
 * 
 * Simple Blog is an extremely simple Blogging Application in PHP.
 * Post, comment, backend and templating
 * @author Kyle Shamblin <kyles0623@gmail.com>
 * @version 1.0
 * 
 */
 
 /**
 *Define Access, allows all subpages to be used without direct connection in url.
 * ex. a person can't go to http://sample.com/template/default/index.php
 */
define('ACCESS',true);

/**
*Directory Separator
*/
define('DS',DIRECTORY_SEPARATOR);

/**
* The directory where the file is located.
*/
define('BASE_PATH',dirname(__FILE__));
/**
* The directory where the file is located without sublocations. Used for website links.
*/
define('WEB_PATH',dirname($_SERVER['PHP_SELF']).DS);
/**
*	Require Init File
*/
require_once(BASE_PATH.DS.'config'.DS.'init.php');

