<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="agencymodel">

   <div class="title">Search Results :</div>

   <div class="contents">

      <?php if($subjects) :?>
      <?php $count_img=1?>
      <?php foreach($subjects as $key=>$val):?>
<?php //print_r($val)?>
         <div class="aModel" style="overflow:hidden;position:relative;">
  
              <div>
                <img style="width: 140px;" alt="<?php echo $val->name?>" title="<?php echo $val->name?>"
                    src="<?php echo base_url().$val->thumbs?>" />
                <h1><?php echo $val->name?></h1>              
              </div>

<style>
.contents .desc {
    background: none repeat scroll 0 0 black;
    color: #999;
    height: 228px;
    left: 0;
    opacity: 0;
    overflow: hidden;
    padding: 10px;
    position: absolute;
    text-decoration: none;
    top: 0;
    z-index: 1;
    text-decoration: none;
    width: inherit;
}
</style>
<script>
$(function(){
  $('.desc','.contents').hover(
    function(){
      $(this).animate(
                {'opacity':0.75},
                {duration:400,queue:false}
              );
    },function(){
      $(this).animate(
                {'opacity':0},
                {duration:400,queue:false}
              );
    }
  )
})
</script>
<a href="<?php echo site_url('subjects/'.$val->id)?>" class="desc">
  <h1><?php echo $val->name?></h1>              
  <table>
    <tr><td>Age</td>    <td><?php echo $val->age?></td></tr>
    <tr><td>Height</td> <td><?php echo $val->height?></td></tr>
    <tr><td>Weight</td> <td><?php echo $val->weight?></td></tr>
    <tr><td>Bust</td>   <td><?php echo $val->bust?></td></tr>
    <tr><td>Waist</td>  <td><?php echo $val->waist?></td></tr>
    <tr><td>Hips</td>   <td><?php echo $val->hips?></td></tr>
    <tr><td>Ethnicity</td><td><?php echo $val->ethnicity?></td></tr>
    <tr><td>Profile Viewed</td><td><?php echo $val->profile_viewed?></td></tr>
  </table>
</a> 

         </div>

         <?php $count_img++?>
      <?php endforeach?>
      <?php else : ?>
         <div class="thumb" style="">
            <span class="title">No Results</span> 
         </div>
      <?php endif?>

   </div>

   <?php echo $pagination?>

   <!--
   <div class="pagination">
       <img src="images/prev.png" alt="Previous" /> 
       <a href="#">1</a>  
       <a href="#">2</a>  
       <a href="#">3</a>  
       <a href="#">4</a>  
       <a href="#">5</a> 
       <img src="images/next.png" alt="Next" />
    </div>
   -->
</div>
