<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Model Nepal Administrator Login</title>
  <link rel="stylesheet" href="<?php echo base_url().ADMINCSSPATH?>login-style.css">
  <link rel="stylesheet" href="<?php echo base_url().ADMINCSSPATH?>flash.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<?php if(ENVIRONMENT=='production'):?>
		<script src='http://code.jquery.com/jquery-latest.min.js' type='text/javascript'></script>
	<?php else : ?>
		<script src='<?php echo base_url().JSPATH?>jquery-1.8.2.min.js' type='text/javascript'></script>
	<?php endif?>
	
	<script type='text/javascript' src='<?php echo base_url().ADMINJSPATH?>functions.js'></script>
  <script type='text/javascript' src='<?php echo base_url().ADMINJSPATH?>flash.js'></script>
</head>
<body>
	
  <?php 
    $attr = array(
                'id'=>'admin-login',
                'class'=>'login'
            );
    echo form_open(false,$attr)
  ?>
    <p>
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" value="Username">
    </p>

    <p>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="********">
    </p>

    <p class="login-submit">
      <button type="submit" class="login-button">Login</button>
    </p>

    <p class="forgot-password">
      <a href="<?php echo site_url('admin/reset_user')?>">Forgot your password?</a></p>
  </form>

  <section class="about">
    <p class="about-links">
      <a href="http://www.cssflow.com/snippets/dark-login-form" target="_parent">View Article</a>
      <a href="http://www.cssflow.com/snippets/dark-login-form.zip" target="_parent">Download</a>
    </p>
    <p class="about-author">
      &copy; 2012&ndash;2013 <a href="http://thibaut.me" target="_blank">Thibaut Courouble</a> -
      <a href="http://www.cssflow.com/mit-license" target="_blank">MIT License</a><br>
      Original PSD by <a href="http://365psd.com/day/2-234/" target="_blank">Rich McNabb</a>
  </section>

  <?php echo $flash?>

</body>
</html>
