<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php //print_r($featured);?>
<div class="modelsthumb">
   <?php if($featured) :?>
   <?php foreach($featured as $key=>$val):?>

      <div class="thumb" style="text-align:center;">
         <a href="<?php echo site_url('featured/'.$val->link.'/01')?>">
            <span class="title"><?php echo $val->name?></span> 
            <img src="<?php echo $val->thumbs?>" alt="<?php echo $val->name?>"
                  title="<?php echo $val->name?>" width="323" height="152" />
         </a>
      </div>

   <?php endforeach?>
   <?php else : ?>
      <div class="thumb" style="margin-right:15px;">
         <span class="title">No Results</span> 
         <!--<img src="" />-->
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