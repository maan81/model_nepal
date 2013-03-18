<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="mainContents">

	<div class="leftPart">
		
		<div class="modeldisplay">
			<div class="name"><?php echo $featured[0]->name?></div>
			<div class="like">
				<div class="addthis_toolbox addthis_default_style ">
					<a class="addthis_button_facebook_like"></a>
				</div>
				<script type="text/javascript" 
						src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-512a3fd75f430942"></script>
			</div>
			
			<div class="mpic">
				<img src="<?php echo  $img_links['cur_img']?>" alt="<?php echo $featured[0]->name?>" 
						height="600" width="400"/>
			</div>
			<div class="rtbox"></div>
			<div class="rbbox"></div>

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
						<a href="#">
								<img src="<?php echo base_url().$val?>" 
										width="110" height="165" alt="model album name" /> 
						</a>
						Gallery <?php echo ++$count?> 
				</div>

			<?php endforeach?>

			</div>
		</div>

	</div>


   <div class="rightPart">

      <?php foreach($render_right as $key=>$val):?>
         <div class="rads">
            <a href="<?php echo $val->link?>">
               <img src="<?php echo base_url().ADDSPATH.$val->image?>" alt="Ad" width="250" />
            </a>
         </div>
      <?php endforeach;?>

   </div>

</div>
