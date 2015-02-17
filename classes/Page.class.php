<?php
defined('ACCESS') or die("Access Denied");

class Page extends AbstractPage
{
	public $template;
	public $title;
	public function __construct($template)
	{
		parent::__construct($template);
		$this->post_id = isset($_GET['post'])?$_GET['post']:'';
		$this->title = $this->setTitle();
	}
	public function setTitle()
	{
		
		if($this->post_id != '')
		{
			$post = BlogPost::getPostById($this->post_id);
			if(!empty($post))
			return $post->title;
		}
		else
		{
			return BLOG_TITLE;
		}
	}
	public function getTemplatePath()
	{
		return $this->template->getFolderPath();
	}
	public function getHeadTitle()
	{
		return $this->title;
	}
	public function display()
	{
		
		require_once(TEMPLATE_PATH.DS.$this->template->name.DS.'index.php');
	}
	

	public function checkPost($action = null)
	{
		if(isset($_POST['name']) && isset($_POST['comment']))
		{
			//Set DB Data for Comment and Escape Strings sent by Visitor
			$data = array('name'=>$this->sanitizeString($_POST['name']),'comment'=>$this->sanitizeString($_POST['comment']),'created_at'=>date('Y-m-d G:i:s'),'post_id'=>$this->post_id);
			$temp = new Comment($data);
			$temp->insert(Comment::$table);
		}
	
	}
	public function sanitizeString($comment)
	{
		$comment = str_replace('<','&lt;',$comment);
		$comment = str_replace('>','&gt;',$comment);
		return mysql_real_escape_string($comment);
	}
	public function getContent()
	{
		
		//If Post ID is there, get from DB check if real
		if($this->post_id != '')
		{
			
			$post = BlogPost::getPostById($this->post_id);
			if($post == null)
			{
				$this->addError(DEFAULT_ERROR_MESSAGE);
			}
			$single_post = true;
			$this->checkPost();
			$comments = Comment::getCommentsByPost($this->post_id);
		}
		else	
		{
			$single_post = false;
			$posts = BlogPost::getPosts($this->page_no-1);
			$this->title = BLOG_TITLE;
		}
			
			include($this->getFile(
			array(
			'errors'=>$this->errors,
			'single_post'=>$single_post
			)));
			
			
	
	
	}
	
	public function getFile($array)
	{
		$dir = $this->template->getPath().DS.'content'.DS;
		if(!empty($array['errors']))
		{
			$this->title = 'Error';
			return $dir.'error.phtml';
		}
		else if($array['single_post'])
		{
			
			return $dir.'blogpost.phtml';
		}
		else
		{
			return $dir.'blog.phtml';
		}
	
	}




}