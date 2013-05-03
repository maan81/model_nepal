<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="mainContents">
<style>
.eventpic img{width:674px;height:315px;}
</style>
<?php //print_r($events);die;?>
   <div class="leftPart">
      
      <div class="fullbanner">
         <a href="<?php echo $add->link?>">
            <img src="<?php echo base_url().ADDSPATH.$add->image?>" alt="Banner" width="690" height="110" />
         </a>
      </div>

      <div class="upcoming">
         
         <div class="eventpic" style="position:relative;">
            <span class="title"><?php echo ucfirst($events->title)?></span>
            <img src="<?php echo $events->cur_img?>" 
                  alt="<?php echo $events->title?>" title="<?php echo $events->title?>" />

         </div>
         
         <div class="highlights">
            <h1> Event Highlights</h1>
            <p><?php echo $events->summary?></p>
         </div>
         
         <div class="details">
            <div class="desc">
               <div class="title">Event Details</div>
               <div class="contents"><?php echo $events->details?></div>
            </div>

            <div class="descright">
              
               <div class="block">
                  <div class="title">When &amp; Where</div>
                  <div class="contents">
                  Date: <?php echo $events->date_created?><br />
                  Time: <?php echo $events->time?><br />
                  Venue: <?php echo $events->location?><br />
                  </div>
               </div>

               <div class="block">
                  <div class="title">Download Forms</div>
                  <div class="contents">
                  <p align="center"><a href="#" class="link">Download Forms</a></p>
                  </div>
               </div>
               
               <div class="block">
                  <div class="title">For More Info</div>
                  <div class="contents">
                  <p align="center"><a href="#" class="link">Contact Organizer</a></p>
                  </div>
               </div>
            
            </div>

         </div>
      
      </div>
      
   </div>

   <?php $this->view('site/right_part.php')?>

</div>