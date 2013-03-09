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
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<?php if(ENVIRONMENT=='production'):?>
		<script src='http://code.jquery.com/jquery-latest.min.js' type='text/javascript'></script>
	<?php else : ?>
		<script src='<?php echo base_url().JSPATH?>jquery-1.8.2.min.js' type='text/javascript'></script>
	<?php endif?>
	
  <script>
  $(function(){
    $('#email','#admin-login')
    .click(function(){
        if($(this).val() == 'Email')
            $(this).val('');
        })
    .blur(function(){
            if($(this).val() == '')
        $(this).val('Email')
    }) 
  })
  </script>
  <style >
    #reset-user-submit {
        border-radius: 32px 32px 32px 32px;
        /*box-shadow: 0 0 4px rgba(0, 0, 0, 0.35);*/
        height: 48px;
        padding: 8px;
        position: absolute;
        right: -37px;
        top: -11px;
        width: 48px;
        top: 35px;
    }
  </style>
</head>
<body>
	
  <form id="admin-login" class="login" action="" method="post">
    <h2 style="font-size: 1.5em; font-weight: bold; text-align: center; padding-bottom: 30px;">Enter your email</h2>
    <p>
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="Email">
    </p>

    <p id="reset-user-submit">
      <button class="login-button" type="submit">Login</button>
    </p>
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
</body>
</html>
