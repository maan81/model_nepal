<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php //print_r($news);die;?>


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

<?php echo $pagination?>
