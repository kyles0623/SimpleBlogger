<?php
defined('ACCESS') or die('Access Denied');

abstract class Row
{
	
	private static $table;
	
	public function __construct($data)
	{
	
		//var_dump($data);
		$keys = array_keys($data);
		
		for($i=0;$i<count($data);$i++)
		{
			$this->$keys[$i] = $data[$keys[$i]];
		}
	
	}
	
	public function insert($table)
	{
		$temp = array();
		foreach($this as $key=>$value)
		{
			if($key != 'table')
				$temp[$key] = $value;
		}
		
		$db = DB::getInstance();
		
		$db->insert($table,$temp);
	}
	public function save($table)
	{
		$temp = array();
		
		foreach($this as $key=>$value)
		{
			if($key == 'id')
				$id = $value;
			else if($key != 'table')
				$temp[$key] = $value;
		}
		
		$db = DB::getInstance();
		
		
		$db->update($table,'id = '.$id,$temp);
	
	}
	
	


}