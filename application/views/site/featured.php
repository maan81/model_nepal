<div class="mainContents">
   <div class="leftPart">

      <div class="fullbanner">
         <a href="<?php echo $add->link?>">
            <img src="<?php echo ADDSPATH.$add->image?>" alt="Banner" width="690" height="110" />
         </a>
      </div>

      <div class="modelspage">
         <div class="featuremodel">
            <img src="<?php 
                           $this->load->helper('utilites_helper'); 
                           echo FEATUREDPATH.gen_folder_name($featured[0]->name)

                        ?>/01/m1.jpg" alt="Model" width="430" height="315" />
         </div>

         <div class="featurem">Featured Model</div>
         
         <div class="popularmodel">
            <div class="title">Popular Models</div>
            <div class="contents"></div>
         </div>
      </div>


      <div class="modelfilter" style="margin-top:10px;">
         <form action="" method="post">
         <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
               <tr style="text-align:center">
                  <td>
                     <select name="name" style="width:140px;">
                        <option selected="selected">Model Name</option>
                        <?php foreach($featured as $key=>$val):?>
                           <option value="<?php echo $val->name?>"><?php echo $val->name?></option>
                        <?php endforeach;?>
                     </select>
                  </td>
                  <td>
                     <select name="gender" style="width:90px;">
                        <option selected="selected">Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                     </select>
                  </td>
                  <td>
                     <select name="ethnicity" style="width:100px;">
                        <option selected="selected">Ethnicity</option>
                        <?php foreach($ethnicity as $key=>$val):?>
                           <option value="<?php echo $val?>"><?php echo ucfirst($val)?></option>
                        <?php endforeach;?>
                     </select>
                  </td>
                  <td>
                     <select name="mmonth" style="width:130px;">
                        <option value="Hem">Hem</option>
                        <option value="Raj">Raj</option>
                        <option selected="selected">Select a month</option>
                     </select>
                  </td>
               </tr>
         </table>
         </form>
      </div>

   </div>

   <div class="rightPart">

      <?php foreach($render_right as $key=>$val):?>
         <div class="rads">
            <a href="<?php echo $val->link?>">
               <img src="<?php echo ADDSPATH.$val->image?>" alt="Ad" width="250" />
            </a>
         </div>
      <?php endforeach;?>

   </div>


</div>