	
<?php

abstract class AbstractPage
{
	public $errors = array();

	public function __construct($template)
	{
		$this->template = $template;
		$this->page_no = $this->getPage();
	}
	public function getTemplatePath()
	{
		return $this->template->getFolderPath();
	}
	public function getBlogTitle()
	{
		return BLOG_TITLE;
	}
	public function getBlogPath()
	{
		return WEB_PATH;
	}
	public function getPage()
	{
		$num = isset($_GET['page'])?$_GET['page']:1;
		
		//echo $num;
		//echo BlogPost::getMaxNumPages();
		if($num <= 0)
			$num = 1;
		else if($num >= BlogPost::getMaxNumPages())
			$num = BlogPost::getMaxNumPages();
			
			return $num;	
	}
	public function getNextPage($word = 'Next')
	{
	
		//Returns blank if There is no Next Page, else returns A href link. Word is optional
		
		$max = BlogPost::getMaxNumPages();
		if($this->page_no >= $max)
			return '';
		else if(MODE == 'site')
			return "<a href='".WEB_PATH."page/".($this->page_no+1)."' >".$word."</a>";
		else
			return "<a href='".ADMIN_WEB_PATH."page/".($this->page_no+1)."' >".$word."</a>";
			//return '<a href="?page='.($this->page_no+1).'>'.$word.'</a>';
		
	}
	public function getPrevPage($word = 'Previous')
	{
		
		//Returns blank if There is no previous Page, else returns A href link. Word is optional
		if($this->page_no <= 1)
			return '';
		else if(MODE == 'site')
			return "<a href='".WEB_PATH."page/".($this->page_no-1)."' >".$word."</a>";
		else
			return "<a href='".ADMIN_WEB_PATH."page/".($this->page_no-1)."' >".$word."</a>";
	}
	public function addError($error)
	{
		array_push($this->errors,$error);
	}
	public function display()
	{
		require_once(TEMPLATE_PATH.DS.$this->template->name.DS.'index.php');
	}
	
	public abstract function checkPost($action = null);
	
	public abstract function getContent();
	
	public abstract function getFile($array);
	
}