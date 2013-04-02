<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Model Nepal</title>

	<link href="<?php echo base_url().CSSPATH?>style.css" rel="stylesheet" type="text/css" />

	<?php if(ENVIRONMENT=='production'):?>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<?php else:?>
		<script type='text/javascript' src='<?php echo base_url().JSPATH?>jquery-1.8.2.min.js'></script>
	<?php endif;?>

	<?php echo $_scripts?>
	<?php echo $_styles?>
</head>
<body>

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
