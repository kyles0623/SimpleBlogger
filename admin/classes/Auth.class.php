<?php
defined('ACCESS') or die('Access Denied');

class Auth
{

	public $authorized;
	
	public function __construct()
	{
		if(isset($_COOKIE['username']))
		{
			
			$username = $_COOKIE['username'];
			$md5_pass = $_COOKIE['password'];
			if($this->authorized = $this->authorize($username,$md5_pass))
				User::setUser($username);
		}
		
		else if(isset($_POST['username']))
		{
			$username = mysql_real_escape_string($_POST['username']);
			$md5_pass = md5($_POST['password']);
			
			//Set Authorized to return value of Authorize
			if($this->authorized = $this->authorize($username,$md5_pass))
			{
				setcookie('username',$username,0,ADMIN_WEB_PATH);
				setcookie('password',$md5_pass,0,ADMIN_WEB_PATH);
				User::setUser($username);
			}
			
		}
		else
		{
			$this->authorized = false;
		}
	}
 
 
	private function authorize($username,$pass)
	{
		$db = DB::getInstance();
		$where = "username = '".$username."'	AND password = '".$pass."'";
		$user = $db->select('users',$where);
			//var_dump($user);
			return !empty($user);
	}








}