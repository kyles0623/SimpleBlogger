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
defined('ACCESS') or die('Access Denied');



 /**
 *Path to Classes
 */
define('CLASS_PATH',BASE_PATH.DS.'classes');
 /**
 *Path to Templates */
define('TEMPLATE_PATH',BASE_PATH.DS.'templates');
//Paths to include in viewable directories

 /**
 *Paths Variable to include files
 *@var array
 */
$paths = array(get_include_path(),CLASS_PATH,BASE_PATH,TEMPLATE_PATH);
set_include_path(implode(PATH_SEPARATOR,$paths));



 /**
 *Autoloader
 *@param string $className
 *@return null
 */
function __autoload($className)
{
	require_once(CLASS_PATH.DS.$className.'.class.php');
}

 /**
 *Register Autoloader Function
 */
spl_autoload_register('__autoload');



 /**
 *Error Handler
 *Writes to Error Log file
 *@param integer $num Error Number
 *@param string $str Error reported
 *@param string $file name of file error found in
 *@param integer $line line number error found on
 */
function error_handler($num, $str, $file, $line) 
{
	
	 /**
	*@var string $file_path File Path.  Uses Dates. Get Errors for that day.
	*/
	$file_path = BASE_PATH.DS.'log'.DS.date('m-d-Y');
	 /**
	*@var fopen $handle Open for writing to end of file only. No Reading!
	*/
	
	$handle = @fopen($file_path,'a');
	
	/**
	*@var string $string String to write to file
	*/
	$string = "Encountered error $num in $file, line $line: $str\n";
	@fwrite($handle,$string);
	fclose($handle);
}
/**
*Sets Error Handler Function
*/
set_error_handler("error_handler");



require_once('configuration.php');

require_once('Front.php');


