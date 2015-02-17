<?php defined('ACCESS') or die('Access Denied'); ?>
<html>

	<head>
		<title><?=$this->getHeadTitle();?></title>
		<link rel='stylesheet' type='text/css' href="<?=$this->getTemplatePath();?>/css/style.css"/>
		<link rel="icon"   type="image/png"   href="<?=$this->getTemplatePath();?>/favicon.png">
	</head>


	<body>
			
		<div id="container">
		<div class="title">
			<!--<img src="<?=$this->getTemplatePath();?>/images/kyle.jpg"  width="200px"/><br /><br />-->
			<a href="<?=$this->getBlogPath();?>"><?php echo $this->getBlogTitle();?></a>
		</div>	
		
			<?php echo $this->getContent();  //Blog Posts or Single Post Page with comments
			?>
			
		</div>

	</body>
</html>

