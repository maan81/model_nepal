<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="mainContents">
  <div class="leftPart">
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
     <div class="agencyDisplay">
        <div class="modelpic">
           <img src="<?php echo $subjects->cur_img?>" alt="<?php echo $subjects->name?>" 
                width="330" height="496" />
        </div>
        <div class="agencymodeldetail">
           <h1><?php echo $subjects->name?></h1>
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr class="bg">
                 <td width="42%">Model ID</td>
                 <td>: <?php echo $subjects->id?></td>
              </tr>
              <tr>
                 <td>Language</td>
                 <td>: English, French</td>
              </tr>
              <tr class="bg">
                 <td>Traveling Preference </td>
                 <td>: National, International</td>
              </tr>
              <tr>
                 <td>Professional Status </td>
                 <td>: <?php echo $subjects->professional?></td>
              </tr>
              <tr class="bg">
                 <td>Portfolio Views</td>
                 <td>: 100</td>
              </tr>
              <tr	>
                 <td>Availability</td>
                 <td>: <strong>Fashion:</strong> Editorial, print, Runway, Catalog, Fit<br />
                    <strong>Commercial:</strong> Product, Lifestyle<br />
                    <strong>Glamour:</strong> Lingrie, Art, Swimsuit
                 </td>
              </tr>
           </table>

           <h2>Physical Status</h2>
           Eyes  :  <?php echo $subjects->eyes?>          Skin  :  <?php echo $subjects->skin?>          Teeth  :   <?php echo $subjects->teeth?>
           <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0;">
              <tr class="bgbold">
                 <td>Measurements</td>
                 <td>Metric</td>
                 <td>Imperial</td>
              </tr>
              <tr class="bg">
                 <td>Height</td>
                 <td><?php echo $subjects->height?></td>
                 <td>5' 10"</td>
              </tr>
              <tr>
                 <td>Weight</td>
                 <td><?php echo $subjects->weight?></td>
                 <td>170 lbs</td>
              </tr>
              <tr class="bg">
                 <td>Bust</td>
                 <td><?php echo $subjects->bust?></td>
                 <td>&nbsp;</td>
              </tr>
              <tr>
                 <td>Waist</td>
                 <td><?php echo $subjects->waist?></td>
                 <td>&nbsp;</td>
              </tr>
              <tr class="bg">
                 <td>Hips;</td>
                 <td><?php echo $subjects->hips?></td>
                 <td>&nbsp;</td>
              </tr>
              <tr>
                 <td>Dress/Clothes Size</td>
                 <td><?php echo $subjects->dress?></td>
                 <td>&nbsp;</td>
              </tr>
              <tr class="bg">
                 <td>Shoes Size</td>
                 <td><?php echo $subjects->shoe?></td>
                 <td>&nbsp;</td>
              </tr>
           </table>
        </div>
        <div class="pagination">
           <div class="block"></div>
           <div class="block"></div>
           <div class="block"></div>
        </div>

        <?php if(isset($subjects->prev)):?>
        <div class="prev">
          <a href="<?php echo $subjects->prev?>">
            <img src="<?php echo base_url().IMGSPATH?>prev.png" alt="Previous" />
          </a>
        </div>
        <?php endif?>
        <?php if(isset($subjects->next)):?>
        <div class="next">
          <a href="<?php echo $subjects->next?>">
            <img src="<?php echo base_url().IMGSPATH?>next.png" alt="Next" />
          </a>
        </div>
        <?php endif?>
        <div class="book">
          <a href="#">
            <img src="<?php echo base_url().IMGSPATH?>book.png" alt="Book this model" />
          </a>
        </div>
  
     </div>
     <div class="bannertwo">
        <div class="leftimg">
           <img  src="images/m4.jpg" alt="model" width="300" height="250" />
        </div>
        <div class="rightadsense"><img  src="images/ad3.jpg" alt="model" width="355" height="250" /></div>
     </div>
  </div>

   <div class="rightPart">

      <?php foreach($render_right as $key=>$val):?>
         <div class="rads">
            <a href="<?php echo $val->link?>">
               <img src="<?php echo base_url().ADDSPATH.$val->image?>" alt="Ad" width="250" />
            </a>
         </div>
      <?php endforeach;?>

   </div>

</div>
