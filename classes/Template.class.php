<?php
defined('ACCESS') or die('Access Denied');
/**
* Template 
* Inherits Row Class
*
*/
class Template extends Row
{
	
	/**
	*getActive.
	*@access public
	*@param none
	*@return Returns Template Object
	* Gets Template that is set in configuration file as ACTIVE_TEMPLATE
	*/
	public static function getActive()
	{
		//Gets DB instance
		$db = DB::getInstance();
		
		//returns Template Object
		$template = new Template(array('name'=>ACTIVE_TEMPLATE));
		
		
		
		return $template;
		
	}
	/**
	*Path used for Inclusion of files
	* ex. /var/www/templates/default/content/blog.phtml
	*@access public
	*@return Returns path used for inclusion of files
	*/
	public function getPath()
	{
		return BASE_PATH.DS.'templates'.DS.$this->name;
	}
	
	/**Path used in actual template 
	* ex. www.example.com/templates/default/images/test.jpg
	*@access public
	*@return Path to template folder
	*/
	public function getFolderPath()
	{
		return WEB_PATH.'templates'.DS.$this->name;
	}
	

}