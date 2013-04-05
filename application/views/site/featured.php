<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="mainContents">
   <div class="leftPart">

      <div class="fullbanner">
         <a href="<?php echo $add->link?>">
            <img src="<?php echo base_url().ADDSPATH.$add->image?>" alt="Banner" width="690" height="110" />
         </a>
      </div>

      <div class="modelspage">
         <div class="featuremodel">
            <img src="<?php 
                           $this->load->helper('utilites_helper'); 
                           echo base_url().FEATUREDPATH.gen_folder_name($featured[0]->name)

                        ?>/01/m1.jpg" alt="Model" width="430" height="315" />
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
         <form action="" method="post">
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
                     <select class="modelparam" name="mmonth" style="width:130px;">
                        <option value="Hem">Hem</option>
                        <option value="Raj">Raj</option>
                        <option selected="selected" value="">Select a month</option>
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