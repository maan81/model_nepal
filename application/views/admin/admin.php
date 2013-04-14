<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Model Nepal Administrator</title>
	<link rel="stylesheet" href="<?php echo base_url().ADMINCSSPATH?>960.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="<?php echo base_url().ADMINCSSPATH?>template.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="<?php echo base_url().ADMINCSSPATH?>colour.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="shortcut icon" href="<?php echo base_url().IMGSPATH?>favicon.ico" />

	<?php if(ENVIRONMENT=='production'):?>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<?php else:?>
	<script type='text/javascript' src='<?php echo base_url().JSPATH?>jquery-1.8.2.min.js'></script>
	<?php endif;?>

	<?php echo $_styles?>
	<?php echo $_scripts?>
</head>
<body>
	<h1 id="head">
		Model Nepal Administrator
		<?php echo $userlogged?>
	</h1>

	<?php echo $menu?>

	<div id="content" class="container_16 clearfix">
<!--
	<div class="grid_11">
		<h2>About</h2>
		<p>After looking for a decent admin template and not having any success I decided to knock this one up. It's released under the creative commons license, so make sure you look at that before using it in your project.</p>
		<h3>Credits</h3>
		<p>I would like to thank Nathan Smith for creating the 960.gs CSS framework which made this project a <i>little</i> easier.</p>
	</div>
	<div class="grid_5">
		<h2>Mock Examples</h2>
		<ol>
			<li><a href="dashboard.html">Home (Dashboard)</a></li>
			<li><a href="news.html">Submit News Article (Forms)</a></li>
			<li><a href="user.html">User Listing (Tables &amp; Pagination)</a></li>
		</ol>
	</div>

	<div class="grid_4">
		<p>
			<label>Username<small>Alpha-numeric values</small></label>
			<input type="text">
		</p>
	</div>
	<div class="grid_5">
		<p>
			<label>Email Address</label>
			<input type="text">
		</p>
	</div>
	<div class="grid_5">
		<p>
			<label>Department</label>
			<select>
				<option>Development</option>
				<option>Marketing</option>
				<option>Design</option>
				<option>IT</option>
			</select>
		</p>
	</div>
-->			
		<?php echo $list?>
		<?php echo $new_item?>
	</div>

	<div id="foot">
		<i>Designed by </i><a href="http://mathew-davies.co.uk/">Mathew Davies</a>
	</div>

	<?php echo $flash?>	

</body>
</html>
