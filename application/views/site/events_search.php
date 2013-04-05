<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php //print_r($events);?>
<div class="modelsthumb">
   <?php if($events) :?>
   <?php foreach($events as $key=>$val):?>

      <div class="thumb" style="text-align:center;">
         <a href="<?php echo site_url('events/get/'.$val->id)?>">
            <span class="title"><?php echo $val->title?></span> 
            <img src="<?php echo base_url().$val->thumbs?>" width="323" height="152" />
         </a>
      </div>

   <?php endforeach?>
   <?php else : ?>
      <div class="thumb" style="margin-right:15px;">
         <span class="title">No Results</span> 
      </div>
   <?php endif?>
</div>

<?php echo $pagination?>

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