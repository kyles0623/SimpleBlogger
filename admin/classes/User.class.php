<?php
defined('ACCESS') or die('Access Denied');

class User extends Row
{
	private static $loggedInUser;

	
	public static function getLoggedInUser()
	{
		$db = DB::getInstance();
		$where = 'username = "'.self::$loggedInUser.'"';
		$data = $db->select('users',$where);
		return new User($data);
	}
	
	public static function setUser($username)
	{
		self::$loggedInUser = $username;
	}


}

