<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php //print_r($news);die;?>

<style type="text/css">
#footer{
	margin-top: 35px;
}
</style>

<div class="mainContents">

	<div class="leftPart">

		<div class="fullbanner">
			<a href="<?php echo $add->link?>">
				<img src="<?php echo base_url().ADDSPATH.$add->image?>" alt="Banner" width="690" height="110" />
			</a>
		</div>


		<div class="upcomming">

			<?php $this->view('site/news_slideshow_old')?>

			<div class="articles" style="margin-top:110px;">
				
				<?php foreach($news as $key=>$val) :?>

				<div class="block">
					<img src="<?php echo $val->image?>" alt="<?php echo $val->title?>" title="<?php echo $val->title?>" />
					<h1>
						<a href="<?php echo site_url('news/'.$val->id)?>"><?php echo $val->title?></a> 
						<span>Posted Under: <?php echo $val->type?></span>
					</h1>
					<?php echo $val->summary?>
				</div>

				<?php endforeach?>

			</div>
		</div>
	</div>

   <?php $this->view('site/right_part.php')?>

</div>
