<div class="rightPart">

  <?php //vertical jquery slider ?>
  <script type="text/javascript">
    $(function(){
      $("#flinks").my_slider({
        move  : 750,
        pause : 5000,
        each_width: 250,
        each_height:300,
        num   : 1,
        showDir : false,
        showPlay: false,
        autoMove: true,
        display : "vertical",
      });
    });
  </script>
  <style>
    #main #flinks {
              width:250px;
              margin-bottom:10px;
            }
    #main #flinks .slide{
                width:250px;
                border:0;
                margin-bottom:0;
              }
  </style>

  
  <?php //featured link ?>
  <div class="rads" id="flinks">
    <?php foreach($flinks as $key=>$val): ?>
      <div class="flink slide">
        <a href="<?php echo $val->link?>">
          <img src="<?php echo base_url().FLINKSPATH.$val->image?>" 
                alt="<?php echo $val->title?>" 
                title="<?php echo $val->title?>" 
                width="250" height="300" />
        </a>
      </div>
    <?php endforeach?>
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
