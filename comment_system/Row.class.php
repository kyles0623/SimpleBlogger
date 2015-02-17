<?php
defined('ACCESS') or die('Access Denied');

class Comment
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
	public function getCommentString()
	{
		 
		
		
	$string ="<div class='comment'>"
		."<h4 class='comment_by'>By: ".$this->name."</h4>".
		"<p class ='created'>".$this->getDateCreated()." ".$this->getTimeCreated()."</p>".
		"<p>".$this->comment."</p></div>";
	
		return $string;
	
	}
		public function getTimeCreated()
	{
		$index = strpos($this->time," ");
		$time =  substr($this->time,$index);
		
		return date('g:s a',strtotime($time));
	}
	public function getDateCreated()
	{
		$index = strpos($this->time," ");
		

		$date =  substr($this->time,0,$index);
		
		return date('F jS, Y', strtotime($date));
	}
	


}