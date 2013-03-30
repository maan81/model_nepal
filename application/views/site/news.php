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
			<div class="eventpic">
				<span class="title">Featured articles</span>
				<img src="tmp/up-coming.jpg" alt="upcoming event" title="" />
			</div>
			<div class="articles">
				
				<?php foreach($news as $key=>$val) :?>

				<div class="block">
					<img src="tmp/article.jpg" alt="articles" />
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

	<div class="rightPart">

		<?php foreach($render_right as $key=>$val):?>
			<div class="rads">
				<?php
				//advertizing thru image ad
				if($val->image){ ?>
					<a href="<?php echo $val->link?>">
						<img src="<?php echo base_url().ADDSPATH.$val->image?>" alt="Ad" width="250" />
					</a>
				<?php 
				//advertizing thru scrip
				}else{ 
					echo $val->script;
				
				}?>
			</div>
		<?php endforeach;?>

	</div>

</div>
