	
<?php

abstract class AbstractPage
{

	public function __construct($template)
	{
		$this->template = $template;
	}
	public function getTemplatePath()
	{
		return $this->template->getFolderPath();
	}
	
	public function display()
	{
		require_once(TEMPLATE_PATH.DS.$this->template->name.DS.'index.php');
	}
	
	public abstract function checkPost();
	
	public abstract function getContent();
	
	public abstract function getFile();