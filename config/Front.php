 <?php
defined('ACCESS') or die('Access Denied');


if(SITE_MODE == 'live')
{
	$template = Template::getActive();
}
else
{
	$template = new Template(array('name'=>'construction','active'=>null,'id'=>null));
}


$page = new Page($template);

$page->display();

/*
$post_id = (isset($_GET['post'])?$_GET['post']:'');

if($post_id != '')
{
	$post = BlogPost::getPostById($post_id);
	if($post == null)
	{
		$error = DEFAULT_ERROR_MESSAGE;
	}	
	$single_post = true;
}
else
{
	$page = (isset($_GET['page'])?$_GET['page']-1:'');
	$previous = BlogPost::getPrevious($page);
	$next = BlogPost::getNext($page);
		
	$single_post = false;
	$posts = BlogPost::getPosts($page);
}




require_once(TEMPLATE_PATH.DS.$template->name.DS.'index.php');


*/