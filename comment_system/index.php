<?php
define('ACCESS',1);
require_once('DB.class.php');
require_once('Row.class.php');
$db = DB::getInstance();


$comment_data = $db->select('comments','','time DESC');

$comments = array();

	foreach($comment_data as $c)
	{
		array_push($comments,new Comment($c));
	}

?>
<html>

	<head>
		<title>Kyle's Comment System</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>

	<body>

		
		<div id="content">
		<form method="post" action="post.php">

		<label for="name">Name:</label><input type="text" name="name" />
		<label for="message">Comment:</label><textarea name="comment"></textarea>
		<input type="Submit" value="Add Comment" />
		</form>
		
			<?php
				foreach($comments as $c)
				{
					echo $c->getCommentString();
				}
				
			?>

		</div>


	</body>



</html>


