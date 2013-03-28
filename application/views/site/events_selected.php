<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!--<pre><?php //print_r($events)?></pre>-->
<div class="mainContents">
  <div class="leftPart">
    <!--
     <div class="modelfilter">
        <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
           <form action="" method="post">
              <tr style="text-align:center">
                 <td>
                    <select name="mname" style="width:140px;">
                       <option value="Hem">Hem</option>
                       <option value="Raj">Raj</option>
                       <option selected="selected">Model Name</option>
                    </select>
                 </td>
                 <td>
                    <select name="mname" style="width:90px;">
                       <option value="Hem">Hem</option>
                       <option value="Raj">Raj</option>
                       <option selected="selected">Gender</option>
                    </select>
                 </td>
                 <td>
                    <select name="mname" style="width:100px;">
                       <option value="Hem">Hem</option>
                       <option value="Raj">Raj</option>
                       <option selected="selected">Ethnicity</option>
                    </select>
                 </td>
                 <td>
                    <select name="mname" style="width:130px;">
                       <option value="Hem">Hem</option>
                       <option value="Raj">Raj</option>
                       <option selected="selected">Select a month</option>
                    </select>
                 </td>
              </tr>
           </form>
        </table>
     </div>
    -->

     <div class="agencyDisplay">
        
        <div class="modelpic">
           <img src="<?php echo $events->cur_img?>" alt="<?php echo $events->title?>" 
                width="330" height="496" />
        </div>
        
        <div class="agencymodeldetail">
           <h1><?php echo $events->title?></h1>
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                 <td width="42%">Event Type</td>
                 <td>: <?php echo $events->type?></td>
              </tr>
              <tr class="bg">
                 <td>Location</td>
                 <td>: <?php echo $events->location?></td>
              </tr>
           </table>

           <h2>Summary</h2>
           <div><?php echo $events->summary?></div>

        </div>
        
        <div class="pagination">
          <style type="text/css">
            .block img{width:54px;height:90px;}
          </style>
          <?php foreach($events->thumbs as $key=>$val):?>
             <div class="block">
                <a href="<?php echo $val['link']?>">
                  <img src="<?php echo $val['img']?>"/>
                </a>
             </div>
          <?php endforeach?>
        </div>

        <?php if(isset($events->prev)):?>
        <div class="previous">
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

   <div class="rightPart">

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

</div>
