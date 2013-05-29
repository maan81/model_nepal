<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php //print_r($news[0]);die;?>
<div class="mainContents">

   <div class="leftPart">
      
      <div class="fullbanner">
         <a href="<?php echo $add->link?>">
            <img src="<?php echo base_url().ADDSPATH.$add->image?>" alt="Banner" width="690" height="110" />
         </a>
      </div>

      <div class="article-details">
         
         <div class="title">
            <?php echo $news[0]->title?>
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style " style="padding-top:15px; margin-left:150px;">
               <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
               <a class="addthis_button_tweet"></a>
               <a class="addthis_button_pinterest_pinit"></a>
               <a class="addthis_counter addthis_pill_style"></a>
            </div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51a16ca366581684"></script>
            <!-- AddThis Button END -->
         </div>
         
         <div class="contents">
            <span class="hor">
               <img src="<?echo $news[0]->image?>" 
                     title="<?php echo $news[0]->title?>" 
                     alt="<?php echo $news[0]->title?>" />
            </span>
            <span class="ver">
               <img src="" alt="vertical img" title="vertical img"/>
            </span>
            <p>
               <strong>Event:</strong> 
               <?php echo $news[0]->title?>
            </p>
            <p>
               <strong>Details: </strong>

               <?php echo $news[0]->content?>
         </div>
      </div>

      
   </div>

   <?php $this->view('site/right_part.php')?>

</div>
