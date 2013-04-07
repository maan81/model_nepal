<div class="rightPart">
  <div class="rads">
     <a href="<?php echo site_url('events')?>">
        <img src="<?php echo base_url().IMGSPATH?>events.jpg" alt="Latest Events" width="250" />
     </a>
  </div>

  <?php foreach($render_right as $key=>$val):?>
     <div class="rads">
     <?php
        //advertizing thru image ad
        if($val->image){ ?>
           <a href="<?php echo $val->link?>">
              <img src="<?php echo base_url().ADDSPATH.$val->image?>" alt="Ad" width="250" />
           </a>
        <?php 
        //advertizing thru scrip
        }else{ 
           echo $val->script;
     }?>
     </div>
  <?php endforeach;?>

</div>
