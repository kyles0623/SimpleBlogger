 <?php
defined('ACCESS') or die('Access Denied');


	$template = Template::getActive();


$auth = new Auth();


//echo $auth->authorized?'true':'false';


//If User create user variable 
if($auth->authorized)
{
	$page = new AdminPage(new Template(array('name'=>ADMIN_TEMPLATE)));
}
else
{
	$page = new AdminPage(new Template(array('name'=>'login')));
}


$page->display();
