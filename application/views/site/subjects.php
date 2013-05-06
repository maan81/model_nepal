<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="mainContents">
   <div class="leftPart">

      <!--
      <div class="fullbanner">
         <a href="<?php //echo $add->link?>">
            <img src="<?php //echo base_url().ADDSPATH.$add->image?>" alt="Banner" width="690" height="110" />
         </a>
      </div>
      -->

      <div class="modelfilter" style="margin-top:10px;">
         <form action="" method="post">
         <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
               <tr style="text-align:center">
                  <td>
                     <select class="modelparam" name="name" style="width:140px;">
                        <option selected="selected" value="">Model Name</option>
                        <?php foreach($subjects as $key=>$val):?>
                           <option value="<?php echo $val->name?>"><?php echo $val->name?></option>
                        <?php endforeach;?>
                     </select>
                  </td>
                  <td>
                     <select class="modelparam" name="gender" style="width:90px;">
                        <option selected="selected" value="">Gender</option>
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                     </select>
                  </td>
                  <td>
                     <select class="modelparam" name="ethnicity" style="width:100px;">
                        <option selected="selected">Ethnicity</option>
                        <?php foreach($ethnicity as $key=>$val):?>
                           <option value="<?php echo $val?>"><?php echo ucfirst($val)?></option>
                        <?php endforeach;?>
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


         <div class="bannertwo">
            
            <div class="leftimg">
               
               <script type="text/javascript"><!--
                  google_ad_client = "ca-pub-7372466155313335";
                  /* 300 Ad */
                  google_ad_slot = "5624517025";
                  google_ad_width = 300;
                  google_ad_height = 250;
               //-->
               </script>
               <script type="text/javascript"
                     src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
               </script>

            </div>


            <div class="rightadsense">
            
               <?php
               //advertizing thru image ad
               if($add2[0]->type=='image') : ?>
                  <a href="<?php echo $add2[0]->link?>">
                     <img src="<?php echo ADDSPATH.$add2[0]->image?>" 
                              alt="model" width="355" height="250" />
                  </a>
               
               <?php 
               //advertizing thru scrip
               else: 
                  echo $add2[0]->script;
               endif;
               ?>

            </div>

         </div>

   </div>


   <?php $this->view('site/right_part.php')?>

</div>