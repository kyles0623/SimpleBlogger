<?php
defined('ACCESS') or die("Access Denied");

class AdminPage extends AbstractPage
{

	public function __construct($template)
	{
		parent::__construct($template);
		$this->user = User::getLoggedInUser();
		$this->checkPost();
		//var_dump($this->user);
	}
	public function getNav()
	{
		include($this->template->getPath().DS.'content'.DS.'navbar.phtml');
	}
	public function getContent()
	{
		$action = isset($_GET['action'])?$_GET['action']:'main';
		$post_id = isset($_GET['post'])?$_GET['post']:'';
		
		$comment_id = isset($_GET['comment'])?$_GET['comment']:'';
		$isPost = $this->checkPost($action);
		
		
		if($action == 'main' && empty($post_id))
		{
			
			$posts = BlogPost::getPosts($this->page_no-1);
			
		}
		else if($action =='edit' && !empty($post_id))
		{
			$post = BlogPost::getPostById($post_id);
			$comments = Comment::getCommentsByPost($post_id);
			
			if($post == null)
				$this->addError("Page could not be found to edit");
		}
		else if ($action=='new')
		{
			
		}
		else if($action == 'delete')
		{
			if(empty($post_id) && empty($comment_id))
				$this->addError("No id submitted for deletion.");
			else if(!empty($post_id) && !BlogPost::delPost($post_id))
			{
				$this->addError("Can not delete post that doesn't exist");
			}
			else if(!empty($comment_id) && !Comment::delComment($comment_id))
			{
				$this->addError("Can not delete comment that doesn't exist");
			}
			else
			{
				header('Location: '.LAST_VISITED);
				
			}
		}
		$errors = $this->errors;
		//var_dump($this->errors);
		
		include($this->getFile(array(
		'errors' =>$errors,
		'action' => $action,
		'post_id'=>$post_id,
		'comment_id'=>$comment_id
		)));
		
	}
	public function checkPost($action = null)
	{
		//Need to check for updating Post
		if($action == 'new' && isset($_POST['title']) && isset($_POST['text']))
		{
			$title = $_POST['title'];
			$text = mysql_real_escape_string($_POST['text']);
			$date = date('Y-m-d G:i:s');
			$data = array('title'=>$title,'text'=>$text,'created_at'=>$date,'updated_last'=>$date);
			
			$post = new BlogPost($data);
			$post->insert(BlogPost::$table);
			
			
			return true;
			
		}
		else if($action == 'edit' && isset($_POST['title']) && isset($_POST['text']))
		{
			
			$title = $_POST['title'];
			$text = mysql_real_escape_string($_POST['text']);
			$date = date('Y-m-d G:i:s');
			$post = BlogPost::getPostById($_GET['post']);
			if($post == null)
				return false;
			
			
			$post->title = $title;
			$post->text = $text;
			$post->updated_last = $date;
			$post->save(BlogPost::$table);
			return true;
		}
		
		
		return false;
		
	}
	//Pass Through Post Value and other stuff
	public function getFile($array)
	{
		$dir = $this->template->getPath().DS.'content'.DS;
		
		if(!empty($array['errors']))
			return $dir.'error.phtml';
		else if($array['action'] == 'edit')
			return $dir.'editPost.phtml';
		else if($array['action'] == 'new')
			return $dir.'newPost.phtml';
		else
			return $dir.'default.phtml';
	
	}
	public function getDelPath($id)
	{
		return ADMIN_WEB_PATH."delete/post/".$id;
	}
	public function getAdminHome()
	{
		return ADMIN_WEB_PATH;
	}
	public function getMainPage()
	{
		return dirname(ADMIN_WEB_PATH);
	}
	public function getCommDelPath($id)
	{
		return ADMIN_WEB_PATH."delete/comment/".$id;
	}
	public function getEditPath($id)
	{
		return ADMIN_WEB_PATH."edit/post/".$id;
	}
	public function getUpdatePath($id)
	{
		return ADMIN_WEB_PATH.'edit/post/'.$id;
	}
	public function getNewPost()
	{
		return ADMIN_WEB_PATH.'new';
	}



}