<script>
$(function(){
	$('#event_pics .event').click(function(e){
		window.location = '<?php echo site_url('news/')?>'+'/'+$(this).attr('data-id');
	})
})
</script>

<div class="events_slideshow">

    <?php $count=0?>
	<?php //medium size image?>
	<div class="eventpics" id="event_pics">
		<?php foreach($news as $key=>$val):?>
            <?php if($count<4): $count++?>
    			<div class="event" data-id="<?php echo $val->id?>">
    				<span class="title event_summary"><?php echo $val->title?></span>
    				<img src="<?php echo $val->image?>" 
    						alt="<?php echo $val->title?>" 
    						title="<?php echo $val->title?>" 
                            width="674" height="315"/>
    			</div>
            <?php endif?>
		<?php endforeach?>
	</div>

    <?php $count=0?>
	<?php //small size image?>
	<div class="event_thumbs" id="event_thumbs">
		<?php foreach($news as $key=>$val):?>
            <?php if($count<4): $count++?>
    			<div class="event">
    				<div>
    					<img src="<?php echo $val->image?>" 
    							alt="<?php echo $val->title?>" 
    							title="<?php echo $val->title?>" />

                        <div class="selected"></div>
    				</div>
    			</div>
            <?php endif?>
		<?php endforeach?>
	</div>

    <img src="<?php echo base_url().IMGSPATH?>thumb-bg.png"/>

</div>
