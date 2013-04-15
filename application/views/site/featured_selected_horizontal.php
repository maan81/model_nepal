<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="mainContents">

	<div class="leftPart">
		
		 <div class="model-display-hor">
			<div class="name"><?php echo $featured[0]->name?></div>
			<div class="like">
				<div class="addthis_toolbox addthis_default_style ">
					<a class="addthis_button_facebook_like"></a>
				</div>
				<script type="text/javascript" 
						src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-512a3fd75f430942"
						data-url="<?php echo current_url()?>"></script>
			</div>
			
			<div class="mpic">
				<img src="<?php echo  $img_links['cur_img']?>" alt="<?php echo $featured[0]->name?>" 
						height="400" width="610"/>
			</div>

			<?php if($img_links['prev']):?>
			<div class="prev">
				<a href="<?php echo $img_links['prev']?>">
					<img src="<?php echo base_url().IMGSPATH?>prev.png" alt="Previous" />
				</a>
			</div>
			<?php endif?>
			<div class="book">
				<a href="#">
					<img src="<?php echo base_url().IMGSPATH?>book.png" alt="Book this model" />
				</a>
			</div>
			<?php if($img_links['next']):?>
			<div class="next">
				<a href="<?php echo $img_links['next']?>">
					<img src="<?php echo base_url().IMGSPATH?>next.png" alt="Next" />
				</a>
			</div>
			<?php endif?>
		</div>

		<div class="model-gallery">
			
			<div class="title">
				Gallery of <strong><?php echo $featured[0]->name?></strong>
			</div>
			<div class="contents">
			<?php $count=0?>
			<?php foreach($galleries[0]['gallery_cover'] as $key=>$val):?>

				<div class="modelAlbum">
						<a href="<?php echo site_url('featured/'.$featured[0]->id.'/'.$key)?>">
								<img src="<?php echo base_url().$val?>" 
										width="110" height="165" alt="model album name" /> 
						</a>
						Gallery <?php echo ++$count?> 
				</div>

			<?php endforeach?>

			</div>
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
				if($add2[0]->type=='image'):?>
					<a href="<?php echo $add2[0]->link?>">
							<img  src="<?php echo base_url().ADDSPATH.$add2[0]->image?>" 
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
