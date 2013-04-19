<script>
$(function(){
	$('#event_pics .event').click(function(e){
		window.location = '<?php echo site_url('news/')?>'+'/'+$(this).attr('data-id');
	})
})
</script>

<div class="events_slideshow">

	<?php //medium size image?>
	<div class="eventpics" id="event_pics">
		<?php foreach($news as $key=>$val):?>
			<div class="event" data-id="<?php echo $val->id?>">
				<span class="title event_summary"><?php echo $val->title?></span>
				<img src="tmp/up-coming-edited.jpg<?php //echo $val->image?>" 
						alt="<?php echo $val->title?>" 
						title="<?php echo $val->title?>" />
			</div>
		<?php endforeach?>
	</div>

	<?php //small size image?>
	<div class="event_thumbs" id="event_thumbs">
		<?php foreach($news as $key=>$val):?>
			<div class="event">
				<div>
					<span class="title event_summary"><?php echo $val->title?></span>
					<img src="tmp/up-coming-edited.jpg<?php //echo $val->image?>" 
							alt="<?php echo $val->title?>" 
							title="<?php echo $val->title?>" />

                    <div class="selected"></div>
				</div>
			</div>
		<?php endforeach?>
	</div>

</div>
