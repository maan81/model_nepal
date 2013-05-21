<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php //print_r($contestants);die;?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<style type="text/css">
	.fb-like{margin-top: -40px;}
	.fb-like-wrapper{
		overflow: hidden;
		top: 7px;
		position: absolute;
		right: 170px;
	}
	.contester_detail_btnfacebk{
		position:relative;
	}
</style>
<div class="mainContents">

	<div class="leftPart">
		
		<div class="fullbanner">
			<a href="<?php echo $add->link?>">
				<img src="<?php echo base_url().ADDSPATH.$add->image?>" alt="Banner" width="690" height="110" />
			</a>
		</div>

		<div class="contester_detail">
	
			<div class="contester_detail_head">

				<?php if(isset($contestants->prev)) :?>				
				<a href="<?php echo $contestants->prev?>">
					<img src="<?php echo base_url().IMGSPATH?>previous-btn.png" 
							width="88" height="28" class="imgleftal" />
				</a>
				<?php endif?>

				<span><?php echo $contestants->name?></span>

				<?php if(isset($contestants->next)):?>
				<a href="<?php echo $contestants->next?>">
					<img src="<?php echo base_url().IMGSPATH?>/next-btn.png" width="88" height="28" class="imgrightal" />
				</a>
				<?php endif?>

			</div>

			<img src="<?php echo $contestants->img?>" height="304" width="648" alt="Details" class="insideimage" />

			<div class="contester_detail_btnfacebk">

				<fb:send href="<?php echo current_url()?>"></fb:send>

				<div class="fb-like-wrapper">
					<div class="fb-like" data-href="<?php echo current_url()?>" 
							data-send="false" data-layout="box_count" 
							data-width="450" data-show-faces="false">
					</div>
				</div>
			</div>


			<div class="contester_detail_fotcoment">
				<fb:comments href="<?php echo current_url()?>" width="470" num_posts="10">
				</fb:comments>
			</div>

		</div>

	</div>

	<?php $this->view('site/right_part.php')?>

</div>
