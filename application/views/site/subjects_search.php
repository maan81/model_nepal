<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="agencymodel">

   <div class="title">Search Results :</div>

   <div class="contents">

      <?php if($subjects) :?>
      <?php $count_img=1?>
      <?php foreach($subjects as $key=>$val):?>

         <div class="aModel">

            <div style="width: 140px; height: 160px; overflow: hidden; position: relative;">
              <img style="height: auto; width: 140px; position: absolute; top: -10%;" 
                  src="<?php echo base_url().$val->thumbs?>" alt="<?php echo $val->name?>">
            </div>
            
            <!--
            <img src="<?php echo $val->thumbs?>" 
                  alt="<?php echo $val->name?>" width="140" height="160" />
            -->

            <h1><?php echo $val->name?></h1>
            Height:<?php echo $val->height?><br />
            Weight: <?php echo $val->weight?><br />
            <a href="<?php echo site_url('subjects/'.$val->id)?>">More &raquo;</a> 

         </div>

         <?php $count_img++?>
      <?php endforeach?>
      <?php else : ?>
         <div class="thumb" style="">
            <span class="title">No Results</span> 
         </div>
      <?php endif?>

   </div>

   <?php echo $pagination?>

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
