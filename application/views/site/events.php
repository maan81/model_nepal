<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php $this->template->add_js(JSPATH.'default_search.js')?>

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

                     <select class="modelparam" name="date_created" style="width:130px;">
                        <option selected="selected" value="">Select a month</option>
                        <?php echo $date_dropdown?>
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

   <?php $this->view('site/right_part.php')?>

</div>