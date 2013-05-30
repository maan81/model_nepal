<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="articlepic">
   <span class="title"><?php echo $val->title?></span>
   <img src="<?php echo $val->image?>" 
         alt="<?php echo $val->title?>" 
         title="<?php echo $val->title?>" />
</div>

<div class="thumb">
   <div class="box">
      <img src="images/thumb-icon.png" alt="thumb" />
      <img src="images/thumb-icon.png" alt="thumb" /> 
      <img src="images/thumb-icon.png" alt="thumb" /> 
      <img src="images/thumb-icon.png" alt="thumb" />
      <img src="images/thumb-icon.png" alt="thumb" />
      <img src="images/thumb-icon.png" alt="thumb" width="103" height="85" />
   </div>
</div>



====================
<div class="eventpics" id="event_pics">
   <?php foreach($news as $key=>$val):?>
         <?php if($count<4): $count++?>
         <div class="event" data-id="<?php echo $val->id?>">
            <span class="title event_summary"><?php echo $val->title?></span>
            <img src="<?php echo $val->image?>" 
                  alt="<?php echo $val->title?>" 
                  title="<?php echo $val->title?>" />
         </div>
         <?php endif?>
   <?php endforeach?>
</div>
