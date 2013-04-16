<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="mainContents">

	<div class="leftPart">
		
		<div class="modeldisplay">
			<div class="name"><?php echo $featured[0]->name?></div>
            <div class="like">
               <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(current_url())?>&amp;send=false&amp;layout=standard&amp;width=53&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=25" 
                     scrolling="no" 
                     frameborder="0" 
                     style="border:none; overflow:hidden; width:53px; height:25px;" 
                     allowTransparency="true">
               </iframe>
            </div>
			
			<div class="mpic">
				<img src="<?php echo  $img_links['cur_img']?>" alt="<?php echo $featured[0]->name?>" 
						height="600" width="400"/>
			</div>
			<div class="rtbox">
		        <?php 
		        if($rtbbox[0] && $rtbbox[0]->type=='script'): 
					echo $rtbbox[0]->script;
	            elseif($rtbbox[0] && $rtbbox[0]->type=='image'): 
	            ?>
	               <a href="<?php echo $rtbbox[0]->link?>">
	                  <img src="<?php echo base_url().ADDSPATH.$rtbbox[0]->image?>" 
	                        title="<?php echo $rtbbox[0]->title?>" 
	                        alt="<?php echo $rtbbox[0]->title?>"
	                        width="200" height="200" />
	               </a>
	            <?php
				endif;
				?>
			</div>
			<div class="rbbox">
		        <?php 
		        if($rtbbox[1] && $rtbbox[1]->type=='script'): 
					echo $rtbbox[1]->script;
				elseif($rtbbox[1] && $rtbbox[1]->type=='image'): 
				?>
					<a href="<?php echo $rtbbox[1]->link?>">
						<img src="<?php echo base_url().ADDSPATH.$rtbbox[1]->image?>" 
								title="<?php echo $rtbbox[1]->title?>" 
								alt="<?php echo $rtbbox[1]->title?>"
								width="200" height="200" />
					</a>
				<?php
				endif;
				?>
			</div>

			<table class="modelinfo">
			    <tr>
			        <td>Wardrobe :</td>
			        <td><?php echo $featured[0]->wardrobe?></td>
			    </tr>
			    <tr>
			        <td>Location :</td>
			        <td><?php echo $featured[0]->location?></td>
			    </tr>
			    <tr>
			        <td>Make-Up :</td>
			        <td><?php echo $featured[0]->make_up?></td>
			    </tr>
			    <tr>
			        <td>Photographer :</td>
			        <td><?php echo $featured[0]->photographer?></td>
			    </tr>
			    <tr>
			        <td>Model By :</td>
			        <td><?php echo $featured[0]->model_by?></td>
			    </tr>
			</table>

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

	</div>

   <?php $this->view('site/right_part.php')?>
</div>
