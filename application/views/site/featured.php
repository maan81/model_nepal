<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="mainContents">
   <div class="leftPart">

      <div class="fullbanner">
         <a href="<?php echo $add->link?>">
            <img src="<?php echo base_url().ADDSPATH.$add->image?>" alt="Banner" width="690" height="110" />
         </a>
      </div>

      <div class="modelspage">
         <style>
         .featuredimg_wrapper {
             border: 5px solid #FFFFFF;
             border-radius: 5px 5px 5px 5px;
             height: 315px;
             overflow: hidden;
             position: inherit;
             width: 430px;
         }
         .featuredimg_wrapper a{
            height:inherit;
         }

         .featuredimg_wrapper img {
             height: inherit;
             position: absolute;
             left: -25%;
         }
         </style>         
         <div class="featuremodel">
            <div class="featuredimg_wrapper">
               <a href="<?php echo $latest_featured[0]->link?>">
                  <img src="<?php echo $latest_featured[0]->latest_img?>" 
                        alt="<?php echo $latest_featured[0]->name?>" 
                        title="<?php echo $latest_featured[0]->name?>" />
               </a>
            </div>
         </div>

         <div class="featurem">Featured Model</div>
         
         <div class="popularmodel">
            <div class="title">Popular Models</div>

               <script type="text/javascript">
               $(function(){
                  $('#contents_wrapper').my_slider({
                        'display':'vertical',
                        'showDir':false,
                        'showPlay':false,
                        'h'      : false,
                        'each_width':215,
                        'each_height':275,
                        'v_spacing':15,
                        'pause':10000,
                        'move':1000,

                     });
               })
               </script>
               <style>
               .popularmodel #contents_wrapper{
                  border:none;
                  height:280px;
                  width:inherit;
                  background: none;
                  top:40px;
                  left:7px;
               }
               .popularmodel #contents_wrapper .slide{
                  border:0;
                  border-radius:0px;
                  background: none;
                  overflow:hidden;
               }
               .popularmodel #contents_wrapper img{
                  border-radius:0px;
               }
               </style>
               
               <!-- popular models vertical scroll start -->
               <div id="contents_wrapper">
                  <?php if(count($popular_featured)) : ?>
                  <?php foreach($popular_featured as $key=>$val) : ?>
                     <div class="contents slide" >
                        <a href="<?php echo $val->link?>">
                           <img style="width: 100%; height: auto;" alt="<?php echo $val->name?>" 
                                 title="<?php echo $val->name?>"
                                 src="<?php echo $val->popular_img?>" />
                        </a>
                     </div>
                  <?php endforeach; ?>
                  <?php endif; ?>
               </div>
               <!-- popular models vertical scroll end -->

         </div>
      </div>


      <div class="modelfilter" style="margin-top:10px;">
         <?php $this->load->helper('form'); echo form_open()?>
         <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
               <tr style="text-align:center">
                  <td>
                     <select class="modelparam" name="name" style="width:140px;">
                        <option selected="selected" value="">Model Name</option>
                        <?php foreach($featured as $key=>$val):?>
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

   </div>

   <?php $this->view('site/right_part.php')?>

</div>