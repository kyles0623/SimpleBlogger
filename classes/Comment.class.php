<?php
defined('ACCESS') or die('Access Denied');

class Comment extends Row
{
	public static $table = 'comments';
	
	/**
	  * Constructs Comment Object.
	  * @param array $data Mysql_row array
	  * @return void
	*/
	public function __construct($data)
	{
		parent::__construct($data);
		if($this->name == "")
			$this->name = 'Anonymous';
	}
	public function insert($table)
	{
	
			parent::insert($table);
		
	}
	public function getTimeCreated()
	{
		$index = strpos($this->created_at," ");
		$time =  substr($this->created_at,$index);
		
		return date('g:s a',strtotime($time));
	}
	public function getDateCreated()
	{
		$index = strpos($this->created_at," ");
		

		$date =  substr($this->created_at,0,$index);
		
		$newdate =  date('F jS, Y', strtotime($date));
		$today = date('F jS, Y');
		
		if($newdate == $today)
			return 'Today';
		else
			return $newdate;
	}
	public static function getCommentsByPost($id)
	{
		$db = DB::getInstance();
		
		$c = $db->select(self::$table,'post_id = '.$id);
		
		//Must always return array
		$comments = array();
		foreach($c as $comment)
		{
			
			if(isset($c['id']))
			{
				array_push($comments,new Comment($c));
				return $comments;	
			}
			else
			{
				array_push($comments,new Comment($comment));
			}
		}
			
		return $comments;
	
	}
	
	public static function delComment($id)
	{
		$db = DB::getInstance();
		$where = " id = '".$id."'";
		
		return $db->delete(self::$table,$where);
		
	}
	public static function delCommentByPost($id)
	{
		$db = DB::getInstance();
		$where = " post_id = '".$id."'";
		
		return $db->delete(self::$table,$where);
	}

	public function emailComment($post_id)
	{
		$post = BlogPost::getPostById($this->post_id);
		 $to = ADMIN_EMAIL;
		 $subject = "Someone has commented on your blog";
		 
		 $body = "Someone has posted a comment on the following post:<br /> <a href='".$post->getPostPath()."'>".$post->title."</a>";
		 
		 if (!mail($to, $subject, $body)) {
		   echo "<script type='text/javascript'>
			alert('An error has occured. Please email the administrator at ".ADMIN_EMAIL." ');
			</script>";
			
			
			//Fix later. Fix email.
			return true;
		  } 
		  else
			return true;
		
	}



}