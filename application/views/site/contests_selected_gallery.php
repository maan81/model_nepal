<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
//$subject = "abcdefe";
//$pattern = '/defe$/';
//echo preg_match($pattern, $subject, $matches);
//die;
?>
<?php //print_r($contests);//die;?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<style type="text/css">
    .fb-like{margin-top: -40px;}
    .fb-like-wrapper{
        overflow: hidden;
        top: 10px;
        right:10px;
        margin-right: 10px;
        float: right;
    }
    .contester_block_botom{
        position:relative;
    }
    .fb_edge_widget_with_comment{
        margin-left:10px;
    }
</style>

<div class="mainContents">

    <div class="leftPart">

        <div class="fullbanner">
            <a href="<?php echo $add->link?>">
                <img src="<?php echo base_url().ADDSPATH.$add->image?>" alt="Banner" width="690" height="110" />
            </a>
        </div>

        <div class="fullbanner">
            <br>
            <h3><?php echo strtoupper($contests[0]->title)?></h3>
        </div>

        <div class="contester">

            <?php $count_img=1?>
            <?php foreach($contests[0]->thumbs as $key=>$val):?>
                <?php 
                    if($val['name']=='Search Img ')continue;
                    if( preg_match('/-detail/i', $val['name'])) continue;
                ?>
    
                <div class="contester_block">
                    <div class="contester_block_head">
                        <h3><?php echo $val['name']?></h3>
                    </div>
                    <a href="<?php echo $val['link']?>">
                        <img width="212" height="149" class="imgstyle" 
                                alt="<?php echo $val['name']?>" 
                                title="<?php echo $val['name']?>" 
                                src="<?php echo $val['img']?>" />
                    </a>
                    <div class="contester_block_botom">
                        <!--facebook like button-->
                        <div class="fb-like-wrapper">
                            <div class="fb-like" data-href="<?php echo $val['link']?>" 
                                    data-send="false" data-layout="box_count" 
                                    data-width="450" data-show-faces="false">
                            </div>
                        </div>
                        

                        <!--facebook send button-->
                        <fb:send href="<?php echo $val['link']?>"></fb:send>
                    </div>
                </div>

                <?php if(($count_img)%3):?>
                    <div class="spacerright"></div>
                <?php else : ?>
                    <div class="spacerbottom"></div>
                <?php endif?>

                <?php $count_img++?>
            <?php endforeach?>


            <?php /*
            <!-- pagination -->
            <div class="contester_footr">
                <img src="<?php echo base_url().IMGSPATH?>prev.png" alt="Previous" /> 
                <span>1 2 3</span>
                <img src="<?php echo base_url().IMGSPATH?>next.png" alt="Next" />
            </div>
            */ ?>
        </div>
<?php

/*

<div class="pagina">
   <a href="#">
      <img src="<?php echo IMGSPATH?>prev.png" alt="Previous" /> 
   </a>
   
   <a href="#">1</a>  
   <a href="#">2</a>  
   <a href="#">3</a>  
   <a href="#">4</a>  
   <a href="#">5</a> 

   <a href="#">
      <img src="<?php echo IMGSPATH?>next.png" alt="Next" />
   </a>
</div>

*/

?>
<?php
/*
        <!--<div class="bannerthree">
         <div class="models">
          <img  src="images/m1.jpg" alt="model" width="210" height="390" />
          </div><div class="models"><img  src="images/m1.jpg" alt="model" width="210" height="390" /></div><div class="models"><img  src="images/m1.jpg" alt="model" width="210" height="390" /></div>
          </div>-->
        <!--<div class="bannertwo">
         <div class="leftimg">
         <img  src="images/m4.jpg" alt="model" width="300" height="250" /></div>
         <div class="rightadsense"><img  src="images/ad3.jpg" alt="model" width="355" height="250" /></div>
         </div>-->
        <!--<div class="twia">
         <div class="heading"> <span class="left"><img src="images/left.png" alt="left" /></span>
            the world in action<span class="right"><img src="images/right.png" alt="right" /></span>
            </div>
            <div class="twiacontents">
                <div class="contents">
                <span>Miss Nepal 2013! Begins</span>
            <img src="images/twia.jpg" alt="twia" width="210" height="120" /></div><div class="contents">
                <span>Miss Nepal 2013! Begins</span>
            <img src="images/twia.jpg" alt="twia" width="210" height="120" /></div><div class="contents">
                <span>Miss Nepal 2013! Begins</span>
            <img src="images/twia.jpg" alt="twia" width="210" height="120" /></div>
            </div>
         </div>-->
*/
?>
    </div>

   <?php $this->view('site/right_part.php')?>

</div>