<?php
defined('ACCESS') or die("Access Denied");
 ?>
<html>
<head>
<title><?=BLOG_TITLE.' Login Page'?></title>
</head>
<body>
<form action="index.php" method="post">
<label>Username: </label><input type="text" name="username" /><br />
<label>Password: </label><input type="password" name="password" /><br />

<input type="submit" />
</form>
</body>
</html>