<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Model Display</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include("includes/toplink.php"); ?>
<div id="warp">
	<div id="main">
        <div class="mainin">
        	<?php include("includes/header.php"); ?>
            <div class="mainContents">
            	<div class="leftPart">
                <div class="fullbanner"><img src="images/fullbanner.jpg" alt="Banner" width="690" height="110" /></div>
               	  <div class="modelspage">
                   	<div class="featuremodel"><img src="images/feature-model-page.jpg" alt="Model" width="430" height="315" /></div>
                    <div class="featurem">Featured Model</div>
                    
                    <div class="popularmodel">
                    	<div class="title">Popular Models</div>
                        <div class="contents"></div>
                    </div>
                    </div>
                  <div class="modelfilter" style="margin-top:10px;">
                    <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <form action="" method="post">
  <tr style="text-align:center">
  	
    <td><select name="mname" style="width:140px;">
    	<option value="Hem">Hem</option>
        <option value="Raj">Raj</option>
        <option selected="selected">Model Name</option>
    </select></td>
    <td><select name="mname" style="width:90px;">
    	<option value="Hem">Hem</option>
        <option value="Raj">Raj</option>
        <option selected="selected">Gender</option>
    </select></td>
    <td><select name="mname" style="width:100px;">
    	<option value="Hem">Hem</option>
        <option value="Raj">Raj</option>
        <option selected="selected">Ethnicity</option>
    </select></td>
    <td><select name="mname" style="width:130px;">
    	<option value="Hem">Hem</option>
        <option value="Raj">Raj</option>
        <option selected="selected">Select a month</option>
    </select></td>
  </tr>
  </form>
</table>

                    </div>
                  <div class="modelsthumb">
                  	<div class="thumb" style="margin-right:15px;"><span class="title">Sakira Shrestha</span> <img src="images/thumb.jpg" /></div>
                    <div class="thumb"><span class="title">Sakira Shrestha</span> <img src="images/thumb.jpg" /></div>
                    <div class="thumb" style="margin-right:15px;"><span class="title">Sakira Shrestha</span> <img src="images/thumb.jpg" /></div>
                    <div class="thumb"><span class="title">Sakira Shrestha</span> <img src="images/thumb.jpg" /></div>
                    <div class="thumb" style="margin-right:15px;"><span class="title">Sakira Shrestha</span> <img src="images/thumb.jpg" /></div>
                    <div class="thumb"><span class="title">Sakira Shrestha</span> <img src="images/thumb.jpg" /></div>
                    
                  </div>
                  <div class="pagina"><img src="images/prev.png" alt="Previous" /> <a href="#">1</a>  <a href="#">2</a>  <a href="#">3</a>  <a href="#">4</a>  <a href="#">5</a> <img src="images/next.png" alt="Next" /></div>
            	</div>
                <?php include("includes/right.php"); ?>
            </div>
        </div>
        </div>
        </div>
 <?php include("includes/footer.php"); ?>       
</body>
</html>