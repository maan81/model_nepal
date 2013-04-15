<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php $this->template->add_js(JSPATH.'default_search.js')?>

<div class="mainContents">

   <div class="leftPart">

      <div class="upcoming">
         <div class="eventpic">
            <span class="title">Featured Events</span>
            <img title="" alt="upcoming event" src="tmp/up-coming.jpg" />
         </div>
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
                                 
                                 array_push($titles ,$val->title); ?>
                                 <?php
                              }
                           } 
                           foreach($titles as $key=>$val){
                              ?><option value="<?php echo $val?>"><?php echo $val?></option><?php
                           }
                        ?>
                     </select>

                  </td>
                  <td>

                     <select class="modelparam" name="type" style="width:90px;">
                        <option selected="selected" value="">Type</option>
                        <?php 
                           foreach($types as $key=>$val){
                              ?><option value="<?php echo $key?>"><?php echo $val?></option><?php
                           }
                        ?>
                     </select>

                  </td>
                  <td>

                     <select class="modelparam" name="location" style="width:100px;">
                        <option selected="selected">Location</option>
                        <?php 
                           $locations=array();
                           foreach($events as $key=>$val){
                              
                              if(!in_array($val->location,$locations)) { 
                                 array_push($locations ,$val->location);
                              }
                           } 
                           natcasesort($locations);
                           foreach($locations as $key=>$val){
                              ?><option value="<?php echo $val?>"><?php echo ucfirst($val)?></option><?php
                           }
                        ?>
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