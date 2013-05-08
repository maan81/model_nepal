<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="mainContents">

	<div class="leftPart">
		
		 <div class="model-display-hor">
            <div class="name"><?php echo $events->title?></div>
            <div class="like">
               <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(current_url())?>&amp;send=false&amp;layout=standard&amp;width=53&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=25" 
                     scrolling="no" 
                     frameborder="0" 
                     style="border:none; overflow:hidden; width:53px; height:25px;" 
                     allowTransparency="true">
               </iframe>
            </div>
			
	         <div class="mpic" style="top:70px;">
	            <img src="<?php echo $events->cur_img?>" alt="<?php echo $events->title?>" 
	            	title="<?php echo $events->title?>" width="610" height="400" />
	         </div>

	         <?php if(isset($events->prev)):?>
	         <div class="prev">
	            <a href="<?php echo $events->prev?>">
	            <img src="<?php echo base_url().IMGSPATH?>prev.png" alt="Previous" />
	            </a>
	         </div>
	         <?php endif?>

	         <?php if(isset($events->next)):?>
	         <div class="next">
	            <a href="<?php echo $events->next?>">
	            <img src="<?php echo base_url().IMGSPATH?>next.png" alt="Next" />
	            </a>
	         </div>
	         <?php endif?>

		</div>

		<div class="bannertwo">
		 <div class="leftimg">
		    <!-- <img  src="<?php echo base_url()?>tmp/m4.jpg" alt="model" width="300" height="250" /> -->
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
		    <a href="<?php echo $add2[0]->link?>">
		    <img  src="<?php echo base_url().ADDSPATH.$add2[0]->image?>" 
		       alt="model" width="355" height="250" />
		    </a>
		 </div>
		</div>

	</div>


   <?php $this->view('site/right_part.php')?>

</div>
