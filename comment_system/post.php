<?php
define('ACCESS',1);
require_once('DB.class.php');
$db = DB::getInstance();

function sanitizeString($comment)
{
	$comment = str_replace('<','&lt;',$comment);
	$comment = str_replace('>','&gt;',$comment);
	return mysql_real_escape_string($comment);
}
if(!isset($_POST['name']) || !isset($_POST['comment']))
{
	header('Location: index.php');
}

$name = sanitizeString($_POST['name']);

if($name == '')
{
	$name = 'Anonymous';

}
$comment = sanitizeString($_POST['comment']);

if($comment == "")
{
	header('Location: index.php');
}
else
{
	$db->insert('comments',array('name'=>$name,'comment'=>$comment));
	
	$to = "9544782449";
	$formatted_number = $to."@tomomail.net";
	//mail($formatted_number, "SMS", $name."\n \n".$comment) or die('Could not send');
	
	header('Location: index.php');
}