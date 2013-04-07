<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!--<pre><?php //print_r($events)?></pre>-->

<style>
.modelinfo_summary{
  background-color: white;
  color: black;
  height: inherit;
  margin-top: 5px;
  padding: 10px;
}
</style>

<div class="mainContents">

   <div class="leftPart">
      <div class="modeldisplay">
         
         <div class="model-display">
            <div class="name"><?php echo $events->title?></div>
            <div class="like">
               <div class="addthis_toolbox addthis_default_style ">
                  <a class="addthis_button_facebook_like"></a>
               </div>
               <script type="text/javascript" 
                  src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-512a3fd75f430942"></script>
            </div>
         </div>
         
         <div class="mpic" style="top:70px;">
            <img src="<?php echo $events->cur_img?>" alt="<?php echo $events->title?>" 
               width="400" height="600" />
         </div>
         
         <div class="rtbox">
              <?php 
              if($rtbbox[0] && $rtbbox[0]->type=='script'): 
               echo $rtbbox[0]->script;
            endif;
            ?>
         </div>
         <div class="rbbox"></div>
         
         <div class="modelinfo">
            <h1>Event Info</h1>
            <div class="modelinfo_summary"><?php echo $events->summary?></div>
         </div>
         
         <?php if(isset($events->prev)):?>
         <div class="prev">
            <a href="<?php echo $events->prev?>">
            <img src="<?php echo base_url().IMGSPATH?>prev.png" alt="Previous" />
            </a>
         </div>
         <?php endif?>
         
         <?php if(isset($events->next)):?>
         <div class="next">
            <a href="<?php echo $events->next?>">
            <img src="<?php echo base_url().IMGSPATH?>next.png" alt="Next" />
            </a>
         </div>
         <?php endif?>
      
      </div>
      
      <div class="bannertwo">
         <div class="leftimg">
            <img  src="<?php echo base_url()?>tmp/m4.jpg" alt="model" width="300" height="250" />
         </div>
         <div class="rightadsense">
            <a href="<?php echo $add2[0]->link?>">
            <img  src="<?php echo base_url().ADDSPATH.$add2[0]->image?>" 
               alt="model" width="355" height="250" />
            </a>
         </div>
      </div>

   </div>

   <?php $this->view('site/right_part.php')?>

</div>
