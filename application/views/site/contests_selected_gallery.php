<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php //print_r($contests);//die;?>
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
                <?php if($val['name']=='Search Img ')continue;?>
    
                <div class="contester_block">
                    <div class="contester_block_head">
                        <h3><?php echo $val['name']?></h3>
                    </div>
                    <a href="<?php echo $val['link']?>">
                        <img width="212" height="149" class="imgstyle" 
                                alt="<?php echo $val['name']?>" 
                                title="<?php echo $val['name']?>" 
                                src="<?php echo $val['img']?>">
                    </a>
                    <div class="contester_block_botom">
                        <!--facebook like button-->
                        <img width="47" height="24" class="imgstlef" src="images/like-btn.png">
                        <!--facebook send button-->
                        <img width="47" height="24" class="imgstrigh" src="images/send.png">
                    </div>
                </div>

                <div class="spacerright"></div>


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

?>        <!--<div class="bannerthree">
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
    </div>

   <?php $this->view('site/right_part.php')?>

</div>