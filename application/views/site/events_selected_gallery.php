<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="mainContents">

<?php //print_r($events);die;?>
   <div class="leftPart">
      
      <div class="model-details">

         <div class="title">
            Gallery of <strong><?php echo ucfirst($events[0]->title)?></strong>
         </div>

         <div class="contents">

            <div class="potrait">

               <?php $count_img=1?>
               <?php foreach($events[0]->thumbs as $key=>$val):?>

                  <?php if($val['type']=='potrait'):?>
                     <a href="<?php echo $val['link']?>">
                        <img src="<?php echo $val['img']?>" width="110" height="165" alt="model album name" />
                     </a>
                  <?php endif?>

                  <?php $count_img++?>
               <?php endforeach?>

            </div>

            <div class="landscape">

               <?php $count_img=1?>
               <?php foreach($events[0]->thumbs as $key=>$val):?>

                  <?php if($val['type']=='landscape'):?>
                     <a href="<?php echo $val['link']?>">
                        <img src="<?php echo $val['img']?>" width="143" height="145" alt="model album name" />
                     </a>
                  <?php endif?>

                  <?php $count_img++?>
               <?php endforeach?>

            </div>

         </div>

         <!--
         <div class="pagination">
      		 <img src="images/prev.png" alt="Previous" /> 
      		 <a href="#">1</a>  
      		 <a href="#">2</a>  
      		 <a href="#">3</a>  
      		 <a href="#">4</a>  
      		 <a href="#">5</a> 
      		 <img src="images/next.png" alt="Next" />
      	 </div>
         -->

      </div>
      
      <!--
      <div class="bannertwo">
         <div class="leftimg">
            <img  src="images/m4.jpg" alt="model" width="300" height="250" />
         </div>
         <div class="rightadsense"><img  src="images/ad3.jpg" alt="model" width="355" height="250" /></div>
      </div>
      -->
   </div>

   <?php $this->view('site/right_part.php')?>

</div>