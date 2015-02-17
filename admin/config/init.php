<?php
defined('ACCESS') or die('Access Denied');

$parts = explode(DS,BASE_PATH);
array_pop($parts);
define('ROOT_PATH',implode($parts,DS)	);

//Path to the Classes
define('SITE_CLASS_PATH',ROOT_PATH.DS.'classes');
define('SITE_TEMPLATE_PATH',ROOT_PATH.DS.'templates');
define('CLASS_PATH',BASE_PATH.DS.'classes');
define('TEMPLATE_PATH',BASE_PATH.DS.'templates');
//Paths to include in viewable directories

session_start();
if(!isset($_SESSION['last_visited']))
	$_SESSION['last_visited'] = $_SERVER['REQUEST_URI'];
	
define('LAST_VISITED',$_SESSION['last_visited']);
$_SESSION['last_visited'] = $_SERVER['REQUEST_URI'];


$paths = array(get_include_path(),SITE_CLASS_PATH,SITE_TEMPLATE_PATH,CLASS_PATH,BASE_PATH,TEMPLATE_PATH);
set_include_path(implode(PATH_SEPARATOR,$paths));



//Universal autoload function
function __autoload($className)
{
	require_once($className.'.class.php');
}

//Register Autoload = Technically not necessary
spl_autoload_register('__autoload');

error_reporting(E_ALL); 

//Writes Error to File
function error_handler($num, $str, $file, $line) 
{
	//File Path. Uses Dates. Get Errors for that day.
	$file_path = BASE_PATH.DS.'log'.DS.date('m-d-Y');
	//Open for writing to end of file only. No Reading!
	$handle = fopen($file_path,'a');
	
	//String to write to file
	$string = "Encountered error $num in $file, line $line: $str\n";
	echo $string;
	
	fwrite($handle,$string);
	fclose($handle);
}

set_error_handler("error_handler");



require_once(ROOT_PATH.DS.'config'.DS.'configuration.php');

require_once('Front.php');


