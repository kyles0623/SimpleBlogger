<?php
defined('ACCESS') or die('Access Denied');

class DB
{
	private static $instance = null;
	
	private $data;
	
	private $conn;

	private function __construct()
	{
		$this->data = array('host' => 'localhost',
		'user' => 'root',
		'pass' => '',
		'db_name' => 'comment_system'
		);
		
		$this->conn = mysql_connect($this->data['host'],$this->data['user'],$this->data['pass']) or die('Could Not Connect to Database');
		mysql_select_db($this->data['db_name'],$this->conn) or die('Could not Connect to database: '.$this->data['db_name']); 
	}
	

	public static function getInstance()
	{
	
		if(self::$instance == null)
			self::$instance = new DB();
		
		return self::$instance;
	}
	
	public function insert($table,$data)
	{
		$fields = array();
		$values = array();
		foreach($data as $field=>$value)
		{
			if(!$value == null)
			{
				$fields[] = $field;
				$values[] = '"'.$value.'"';
			}
		}
		
		$field_list = join(',',$fields);
		$value_list = join(',',$values);
		
		$query = "INSERT INTO ".$table." (".$field_list.") VALUES(".$value_list.")";
		//echo $query.'<br /><br />';
		
		mysql_query($query) or die(mysql_error());
	
	}
	
	//Update Table
	public function update($table,$where,$data)
	{
		$fields = array();
		$values = array();
		$temp = "";
		$last = end($data);
		foreach($data as $field=>$value)
		{
			if(!$value == null)
			{
				if($value == $last)
					$temp .= " ".$field.' = "'.$value.'"';
				else
					$temp .= " ".$field.'= "'.$value.'" ,';
				//$fields[] = $field; 
				//$values[] = '"'.$value.'"';
			}
			
		}
		
		//$field_list = join(',',$fields);
		//$value_list = join(',',$values);
		
		$query = "UPDATE ".$table." SET ".$temp." WHERE ".$where;
		
		//$query = "UPDATE ".$table." SET ".$var."=".$value." WHERE ".$where;
		$result = mysql_query($query);
		
	
	}
	//Select Object From Table
	public function select($table,$where='',$order='')
	{ 
		//Creates Query, Disregards where if empty, Disregard Fetch is empty, Disregard Order if empty
		$query = "SELECT * from ".$table.($where?" WHERE ".$where:"").($order?" ORDER BY ".$order:"");
		
		//echo $query;
		
		if(!$result = mysql_query($query))	
			return array();
			
		//initialize temp and row
		$temp = array();
		$row = null;
		
		
		while($row = mysql_fetch_assoc($result))
		{	
			//Inputs Assoc Array into Return Object
			array_push($temp,$row);
		}
		
			return $temp;
	}
	public function delete($table,$where)
	{
		$query = "DELETE FROM ".$table." WHERE ".$where;
		
		if(!$result = mysql_query($query))
		{
			return false;
		}
		else
		{
			return true;
		}
	
	}


}