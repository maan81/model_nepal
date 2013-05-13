<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php $this->template->add_js(JSPATH.'default_search.js')?>
<?php $this->template->add_js(JSPATH.'events_slideshow.js')?>
<?php $this->template->add_css(CSSPATH.'events_upcomming.css')?>


<div class="mainContents">

   <div class="leftPart">

      <?php if($events_slideshow): ?>
         <div class="upcomming">
            <div class="upcomming_selectors">
               <?php foreach($events_slideshow as $key=>$val):?>
                  <div class="upcomming_selector"></div>
               <?php endforeach?>
            </div>
            <?php foreach($events_slideshow as $key=>$val): ?>
               <div class="eventpic">
                  <a href="<?php echo site_url('events/'.$val->link)?>">
                     <span class="title"><?php echo $val->title?></span>
                     <img  title="<?php echo $val->title?>" 
                           alt="<?php echo $val->title?>" 
                           width="674" height="315"
                           src="<?php echo base_url().EVENTSPATH.gen_folder_name($val->title)?>.jpg" />
                  </a>
               </div>
            <?php endforeach?>
         </div>
      <?php endif?>
         <!--
         <div class="eventpic">
            <span class="title">Featured Events</span>
            <img title="" alt="upcomming event" src="tmp/up-coming.jpg" />
         </div>
         -->

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