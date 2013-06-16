<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Model Nepal</title>

	<link rel="shortcut icon" href="<?php echo base_url().IMGSPATH?>favicon.ico" />
	
	<link href="<?php echo base_url().CSSPATH?>style.css" rel="stylesheet" type="text/css" />

	<?php if(ENVIRONMENT=='production'):?>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<?php else:?>
		<script type='text/javascript' src='<?php echo base_url().JSPATH?>jquery-1.8.2.min.js'></script>
	<?php endif;?>

	<?php $this->carabiner->display()?>
	<?php //echo $_scripts?>
	<?php echo $_styles?>
	<?php echo $_meta?>
</head>
<body>
	<!--
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-40135663-1', 'modelnepal.com');
		ga('send', 'pageview');
	</script>	
	-->

	<?php echo $toplink?>

	<div id="warp">
		<div id="main">
	        <div class="mainin">

	        	<?php echo $header?>

	        	<?php echo $mainContents?>

	        </div>
        </div>
    </div>

	 <?php echo $footer?>       
</body>
</html>
