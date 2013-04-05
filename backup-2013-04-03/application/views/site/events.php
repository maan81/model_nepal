<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="mainContents">

   <div class="leftPart">

      <div class="fullbanner">
         <a href="<?php echo $add->link?>">
            <img src="<?php echo base_url().ADDSPATH.$add->image?>" alt="Banner" width="690" height="110" />
         </a>
      </div>

      <div class="modelfilter" style="margin-top:10px;">
         <form action="" method="post">
         <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
               <tr style="text-align:center">
                  <td>

                     <select class="modelparam" name="title" style="width:140px;">
                        <option selected="selected" value="">Event Name</option>
                        <?php 
                           $titles=array();
                           foreach($events as $key=>$val){
                              
                              if(!in_array($val->title,$titles)) { 
                                 
                                 array_push($titles ,$val->titles); ?>

                                 <option value="<?php echo $val->title?>"><?php echo $val->title?></option>
                                 <?php
                           }
                        } ?>
                     </select>

                  </td>
                  <td>

                     <select class="modelparam" name="type" style="width:90px;">
                        <option selected="selected" value="">Type</option>
                        <?php 
                           $types=array();
                           foreach($events as $key=>$val){
                              
                              if(!in_array($val->type,$types)) { 
                                 
                                 array_push($types ,$val->type); ?>

                                 <option value="<?php echo $val->type?>"><?php echo ucfirst($val->type)?></option>
                                 <?php
                           }
                        } ?>

                     </select>

                  </td>
                  <td>

                     <select class="modelparam" name="location" style="width:100px;">
                        <option selected="selected">Location</option>
                        <?php 
                           $locations=array();
                           foreach($events as $key=>$val){
                              
                              if(!in_array($val->location,$locations)) { 
                                 
                                 array_push($locations ,$val->location); ?>

                                 <option value="<?php echo $val->location?>"><?php echo ucfirst($val->location)?></option>
                                 <?php
                           }
                        } ?>
                     </select>

                  </td>
                  <td>

                     <select class="modelparam" name="mmonth" style="width:130px;">
                        <option selected="selected" value="">Select a month</option>
                        <option value="Hem">Hem</option>
                        <option value="Raj">Raj</option>
                     </select>

                  </td>
               </tr>
         </table>
         </form>
      </div>

      <div style="text-align: center;">
         <img class="loading" alt="loading" 
               src="<?php echo base_url().IMGSPATH?>ajax-loader.gif" 
               style="display:none;padding: 50px;">
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