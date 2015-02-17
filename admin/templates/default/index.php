<?php
defined('ACCESS') or die("Access Denied");
?>

<html>
<head>
	<title>Admin Area</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->getTemplatePath();?>/css/style.css" />
</head>

<body>
<div id="user">
Hello <?=$this->user->username;?>
</div>
<div id="Nav">
<?=$this->getNav();?>
</div>
<div id="container">
<?=$this->getContent();?>
</div>


</body>

</html>