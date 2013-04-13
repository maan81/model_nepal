<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!--<pre><?php //print_r($subjects);die;?></pre>-->
<div class="mainContents">
  <div class="leftPart">
     <div class="agencyDisplay">
        <?php if($subjects->img_type == 'potrait') : ?>
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
                   <td>Traveling Preference </td>
                   <td>: National, International</td>
                </tr>
                <tr class="bg">
                   <td>Professional Status </td>
                   <td>: <?php echo $subjects->professional?></td>
                </tr>
                <tr>
                   <td>Portfolio Views</td>
                   <td>: <?php echo $subjects->profile_viewed?></td>
                </tr>
                <tr class="bg">
                   <td>Availability</td>
                   <td>: <?php if(isset($subjects->fashion_type)):?>
                            <strong>Fashion:</strong>
                            <?php
                              foreach($subjects->fashion_type as $key=>$val){
                                echo $key.' ';
                              } 
                            ?>
                            <br />
                        <?php endif?>
                        <?php if(isset($subjects->commercial_type)):?>
                          <strong>Commercial:</strong>
                          <?php
                            foreach($subjects->commercial_type as $key=>$val){
                              echo $key.' ';
                            }
                          ?>
                          <br />
                        <?php endif?>
                        <?php if(isset($subjects->glamour)):?>
                          <strong>Glamour:</strong>
                          <?php
                            foreach($subjects->glamour as $key=>$val){
                              echo $key.' ';
                            }
                          ?>
                          <br/>
                        <?php endif?>
                   </td>
                </tr>
             </table>

             <h2>Physical Status</h2>
             Eyes  :  <?php echo $subjects->eyes?>          Skin  :  <?php echo $subjects->skin?>          Teeth  :   <?php echo $subjects->teeth?>
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0;">
                <tr class="bgbold">
                   <td>Measurements</td>
                   <td><!--Metric--></td>
                   <!--<td>Imperial</td>-->
                </tr>
                <tr class="bg">
                   <td>Height</td>
                   <td><?php echo $subjects->height?></td>
                   <!--<td>5' 10"</td>-->
                </tr>
                <tr>
                   <td>Weight</td>
                   <td><?php echo $subjects->weight?></td>
                   <!--<td>170 lbs</td>-->
                </tr>
                <tr class="bg">
                   <td>Bust</td>
                   <td><?php echo $subjects->bust?></td>
                   <!--<td>&nbsp;</td>-->
                </tr>
                <tr>
                   <td>Waist</td>
                   <td><?php echo $subjects->waist?></td>
                   <!--<td>&nbsp;</td>-->
                </tr>
                <tr class="bg">
                   <td>Hips;</td>
                   <td><?php echo $subjects->hips?></td>
                   <!--<td>&nbsp;</td>-->
                </tr>
                <tr>
                   <td>Dress/Clothes Size</td>
                   <td><?php echo $subjects->dress?></td>
                   <!--<td>&nbsp;</td>-->
                </tr>
                <tr class="bg">
                   <td>Shoes Size</td>
                   <td><?php echo $subjects->shoe?></td>
                   <!--<td>&nbsp;</td>-->
                </tr>
             </table>
          </div>
          <div class="pagination">
            <style type="text/css">
              .block img{width:54px;height:90px;}
            </style>
            <?php foreach($subjects->thumbs as $key=>$val):?>
               <div class="block">
                  <a href="<?php echo $val['link']?>">
                    <img src="<?php echo $val['img']?>"/>
                  </a>
               </div>
            <?php endforeach?>
          </div>

          <?php if(isset($subjects->prev)):?>
          <div class="previous">
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

        <?php else : ?>
          <style>
.agencyDisplay{
  height:580px !important;
}
.prev-hor {
    bottom: 30px;
    left: 70px;
    position: absolute;
}
.book-hor{
    bottom: 25px;
    left: 240px !important;
    position: absolute;
}

.next-hor {
    bottom: 30px;
    position: absolute;
    right: 70px !important;
}
          </style>
        
         <div class="model-display-hor">
          <div class="name"><?php echo $subjects->name?></div>
          <div class="like">
            
            <div class="addthis_toolbox addthis_default_style ">
            
              <a class="addthis_button_facebook_like"></a>
            </div>
            <script type="text/javascript" 
                src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-512a3fd75f430942"
                data-url="<?php echo current_url()?>"></script>
          </div>
          
          <div class="mpic">
            <img src="<?php echo  $subjects->cur_img?>" alt="<?php echo $subjects->name?>" 
                height="400" width="610"/>
          </div>

          <?php if(isset($subjects->prev)):?>
          <div class="prev-hor">
            <a href="<?php echo $subjects->prev?>">
              <img src="<?php echo base_url().IMGSPATH?>prev.png" alt="Previous" />
            </a>
          </div>
          <?php endif?>
          
          <div class="book-hor">
            <a href="#">
              <img src="<?php echo base_url().IMGSPATH?>book.png" alt="Book this model" />
            </a>
          </div>
          
          <?php if(isset($subjects->next)):?>
          <div class="next-hor">
            <a href="<?php echo $subjects->next?>">
              <img src="<?php echo base_url().IMGSPATH?>next.png" alt="Next" />
            </a>
          </div>
          <?php endif?>

        </div>
        <?php endif?>

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


       <!-- <img  src="<?php echo base_url()?>tmp/m4.jpg" alt="model" width="300" height="250" /> -->
    </div>

    <div class="rightadsense">
      <a href="<?php echo $add2[0]->link?>">
        <img  src="<?php echo base_url().ADDSPATH.$add2[0]->image?>" 
              alt="model" width="355" height="250" />
      </a>
    </div>
  
  </div>

</div>

   <?php $this->view('site/right_part.php')?>

</div>