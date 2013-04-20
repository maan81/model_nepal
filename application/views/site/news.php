<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php //print_r($news);die;?>

<div class="mainContents">

	<div class="leftPart">

		<div class="fullbanner">
			<a href="<?php echo $add->link?>">
				<img src="<?php echo base_url().ADDSPATH.$add->image?>" alt="Banner" width="690" height="110" />
			</a>
		</div>


		<div class="upcoming">

			<?php $this->view('site/news_slideshow')?>

			<div class="articles">
				
				<?php foreach($news as $key=>$val) :?>

				<div class="block">
					<img src="<?php echo $val->image?>" alt="articles" />
					<h1>
						<a href="#"><?php echo $val->title?></a> 
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
