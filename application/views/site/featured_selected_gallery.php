<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="mainContents">

  <div class="leftPart">

	 <div class="model-details">
		
		<div class="title">
			Gallery of <strong><?php echo $featured[0]->name?></strong>
		</div>
		
		<div class="contents">

			<div class="potrait">
			<?php foreach($imgs_preview['potrait'] as $key=>$val):?>

				<div class="modelAlbum">
					<a href="<?php echo $val['link']?>">
							<img src="<?php echo base_url().$val['img']?>" 
									width="110" height="165" alt="model album name" /> 
					</a>
				</div>

			<?php endforeach?>
			</div>

			<div class="landscape">
			<?php foreach($imgs_preview['landscape'] as $key=>$val):?>

				<div class="modelAlbum">
					<a href="<?php echo $val['link']?>">

							<style>
							.landscapeimg_wrapper{
								display: inline-block; 
								overflow: hidden; 
								background: none repeat scroll 0px 0px #000; 
								border: 5px solid rgb(0, 0, 0); 
								margin: 5px; 
								width: 143px; 
								height: 145px;
							}
							.landscapeimg_wrapper img{
								background: none repeat scroll 0% 0% transparent !important; 
								border: 0px none !important; 
								margin: 0px 0px 0px -25% !important;
							}
							</style>
							<div class="landscapeimg_wrapper">
								<img src="<?php echo base_url().$val['img']?>" 
										alt="<?php echo $featured[0]->name?>" />
							</div>

							<!-- <img src="<?php echo base_url().$val['img']?>" 
									width="143" height="145" alt="<?php echo $featured[0]->name?>" />  -->
					</a>
				</div>

			<?php endforeach?>
			</div>

		</div>

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

  </div>

   <?php $this->view('site/right_part.php')?>
  
</div>
