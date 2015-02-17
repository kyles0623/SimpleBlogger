<?php
defined('ACCESS') or die('Access Denied');
/**
* BlogPost Class
* A class with methods used for individual blogposts in class
* Inherits Row Class
*/
class BlogPost extends Row
{
	/**
	* The BlogPost id
	* @var string
	* @access public
	*/
	public $id = null;
	
	/**
	* BlogPost Title
	* @var string
	* @access public
	*/
	public $title = null;
	
	/**
	* The Text of the Blogpost
	* @var string;
	* @access public
	*/
	public $text = null;
	
	/**
	* Time and Date Created at 
	* @var string
	* @access public
	*/
	public $created_at = null;
	
	/**
	* Time and Date Updated Last
	* @var string
	* @access public
	*/
	public $updated_last = null;
	
	/**
	* Table in Database
	* @static
	* @var string
	* @access public
	*/
	public static $table = 'blog_post';

	/**
	* Constructor
	* @access public
	* @param array An Associative array of database variables
	*/
	public function __construct($data = "")
	{
		if(!empty($data))
		{
			parent::__construct($data);
		}
		
		
	}
	
	
	/**
	* Get Time Created
	* @access public 
	* @return string Formated version of the Date
	*/
	public function getTimeCreated()
	{
		//The time and date are put together in the database so we must split it up
		$index = strpos($this->created_at," ");
		
		//Time is captured in a variable
		$time =  substr($this->created_at,$index);
		
		//returns formated date ex. 8:12 pm
		return date('g:s a',strtotime($time));
	}
	
	
	/**
	* Get Date Created
	* @access public
	* @return string Formated version of the date
	*/
	public function getDateCreated()
	{
		//Time and date are one string in the database and must be split
		$index = strpos($this->created_at," ");
		
		//Grabs date
		$date =  substr($this->created_at,0,$index);
		
		//Formats Date to look like ex. January 25th, 2011
		$newdate =  date('F jS, Y', strtotime($date));
		
		//Gets todays date in same format as above
		$today = date('F jS, Y');
		
		//Returns Today is posted today else returns date
		if($newdate == $today)
			return 'Today';
		else
			return $newdate;
	}
	
	/**
	* getPosts for Page
	* @static
	* @param int Page Number to be grabbed 
	* @return array An array of all the posts to be printed on the page
	*/
	public static function getPosts($page = 0)
	{
		//Instance of the DB
		$db = DB::getInstance();
		
		//Selects all post in DB
		$posts = $db->select(self::$table,'','id DESC');
		
		//Temporary array to be returned 
		$temp = array();
		
		//If MAX_POSTS_ON_PAGE is too large make max for FORLOOP to be the count of POSTS grabbed || if page requested is too big
		if(count($posts) <= MAX_POSTS_ON_PAGE || ($page*MAX_POSTS_ON_PAGE)+MAX_POSTS_ON_PAGE > count($posts) )
			$max = count($posts);
		else //Set Max to be Page + 1 times MAX_POSTS
			$max = ($page*MAX_POSTS_ON_PAGE)+MAX_POSTS_ON_PAGE;
		
		
		//Goes through page of Posts, puts the data in BlogPost objects and returns array of those objects
		for($i=($page>=0?($page*MAX_POSTS_ON_PAGE):0);$i<$max;$i++)
		{
			array_push($temp,new BlogPost($posts[$i]));
		}
		
		//Returns Posts Based on Page
		return $temp;
	}
	
	/**
	* getNumComments
	* @access public 
	* @return Returns number of comments for the post
	*/
	public function getNumComments()
	{
		//Returns Count of comments by post id
		return count(Comment::getCommentsByPost($this->id));
	}
	/**
	* GetPostPath
	* @access public
	* @return Returns Path of the Personal Post page
	*/
	public function getPostPath()
	{	
		return WEB_PATH.'post'.DS.$this->id;
	
	}
	
	/**
	* GetPostById
	* @param int the posts id
	* @static
	* @return Object BlogPost Object or null if nothing is found
	*/
	public static function getPostById($id)
	{
	
		//Returns Blank if isn't a number
		if(!is_numeric($id))
			return "";
			
		//Instantiates Database connection
		$db = DB::getInstance();
		
		//Selects Post based on ID
		$post = $db->select(self::$table,'id = '.$id);
		
		//Returns nothing if post isn't in the Database
		if($post != null)
			return new BlogPost($post);
		else
			return "";
	}
	/**
	* getMaxNumPages
	* @static
	* @access public
	* @return int Maximum number of pages to be used on the blog
	*/
	public static function getMaxNumPages()
	{
		//Instantiates Database Connection
		$db = DB::getInstance();
		
		//Divides count of all the posts in the table BY MAX_POSTS_ON_PAGE and Rounds up
		$int =  ceil((count($db->select(self::$table)) / MAX_POSTS_ON_PAGE));
		
		return $int;
	}
	
	/**
	* Delete Post
	* @static
	* @param int the posts id
	* @return boolean true if was deleted
	*/
	public static function delPost($id)
	{
		$db = DB::getInstance();
		$where = " id = '".$id."'";
		
		//Deletes all the comments for the post
		Comment::delCommentByPost($id);
		return $db->delete(self::$table,$where);
	}
	
	
	
}