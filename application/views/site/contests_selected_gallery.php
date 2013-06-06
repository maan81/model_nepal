<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
//$subject = "abcdefe";
//$pattern = '/defe$/';
//echo preg_match($pattern, $subject, $matches);
//die;
?>
<?php //print_r($contests);//die;?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$(function(){
/*
  $('.fb_share').find('a').live('click',function(e){
    e.preventDefault();
console.log($(this))    
var $cur_link = $(this).attr('link');
var $link = 'https://www.facebook.com/sharer/sharer.php?u='+$cur_link;



  $(this).after().dialog({  //create dialog, but keep it closed
     autoOpen: true,
     height: 300,
     width: 350,
     modal: true
  });
    $(this).after().load($link);
    $(this).after().dialog("open");
  })
*/
})
function fbs_click(contestant_name,constent_name) {
    var leftPosition, topPosition, width=300, height=200, u='';
    //Allow for borders.
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    //Allow for title and status bars.
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);

    var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";


    u += 'http://localhost/modelnepal/constents/'+constent_name+'/'+contestant_name;
    t='Model Nepal Share';

    window.open('https://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer', windowFeatures);
    return false;
}

function fb_share(contestant_name,constent_name){

  var $html = '<div class="overlay"></div><div class="pop" ></div>';
  $('body').append($html);
console.log("<?php echo site_url('contests/share').'/'?>"+constent_name+'/'+contestant_name  );
  $('.pop').load("<?php echo site_url('contests/share').'/'?>"+constent_name+'/'+contestant_name);
 
  return false;
}

</script>
<style type="text/css">
    body > .overlay{
      background: none repeat scroll 0% 0% black; 
      height: 100%; 
      width: 100%; 
      opacity: 0.5; 
      left: 0px; 
      position: fixed; 
      top: 0px;
    }
    body > .pop{
      z-index: 5; 
      position: fixed; 
      top: 20px; 
      left: 20px; 
      background: none repeat scroll 0% 0% white; 
      width: 800px; 
      height: 300px;
    }

    .fb-like-wrapper{
        overflow: hidden;
        right:10px;
        position: absolute;
        width: 50px;
    }
    .contester_block_botom{
        position:relative;
    }
    .fb_edge_widget_with_comment{
        margin-left:10px;
    }
    .fb_share a{
      text-decoration: none; 
      width: 100%; 
      font-size: 11px; 
      background: none repeat scroll 0px 0px rgb(236, 238, 245); 
      color: rgb(59, 89, 152); 
      border: 1px solid rgb(202, 212, 231); 
      border-radius: 4px 4px 4px 4px; 
      padding: 3px; 
      height: 100%;
    }
    .fb_share div{
      background: url(http://static.ak.fbcdn.net/rsrc.php/v2/yF/r/wtsky0Emo_J.png) no-repeat scroll 0% 0% transparent; 
      width: 14px; 
      height: 14px; 
      display: inline-block; 
      position: relative; 
      padding-right: 2px; 
      top: 2px;
    }
</style>


<div class="mainContents">

    <div class="leftPart">

        <div class="fullbanner">
            <a href="<?php echo $add->link?>">
                <img src="<?php echo base_url().ADDSPATH.$add->image?>" alt="Banner" width="690" height="110" />
            </a>
        </div>

        <div class="fullbanner">
            <br>
            <h3><?php echo strtoupper($contests[0]->title)?></h3>
        </div>

        <div class="contester">

            <?php $count_img=1?>
            <?php foreach($contests[0]->thumbs as $key=>$val):?>
                <?php 
                    if($val['name']=='Search Img ')continue;
                    if( preg_match('/-detail/i', $val['name'])) continue;
                ?>
    
                <div class="contester_block">
                    <div class="contester_block_head">
                        <h3><?php echo $val['name']?></h3>
                    </div>
                    <a href="<?php echo $val['link']?>">
                        <img width="212" height="149" class="imgstyle" 
                                alt="<?php echo $val['name']?>" 
                                title="<?php echo $val['name']?>" 
                                src="<?php echo $val['img']?>" />
                    </a>
                    <div class="contester_block_botom">
                        <!--facebook like button-->
                        <div class="fb-like-wrapper">
                          <div class="fb-like">
                            <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $val['link']?>&amp;send=false&amp;layout=button_count&amp;amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21" 
                                scrolling="no" 
                                frameborder="0" 
                                style="border:none; overflow:hidden; height:21px;" 
                                allowTransparency="true">
                            </iframe>

                          </div>
                        </div>

                        <!--facebook share button-->
                        <div class="fb_share">
<?php
 $tmp = explode('/',$val['link']);
 $contestant_name = array_pop($tmp);
 $constent_name = array_pop($tmp);
?>
                          <a id="fb_share" href="#" onClick="return fbs_click('<?php echo $constent_name?>','<?php echo $contestant_name?>')">
                            <div></div>
                            Share
                          </a>
                      </div>
                    </div>
                </div>

                <?php if(($count_img)%3):?>
                    <div class="spacerright"></div>
                <?php else : ?>
                    <div class="spacerbottom"></div>
                <?php endif?>

                <?php $count_img++?>
            <?php endforeach?>


            <?php /*
            <!-- pagination -->
            <div class="contester_footr">
                <img src="<?php echo base_url().IMGSPATH?>prev.png" alt="Previous" /> 
                <span>1 2 3</span>
                <img src="<?php echo base_url().IMGSPATH?>next.png" alt="Next" />
            </div>
            */ ?>
        </div>
<?php

/*

<div class="pagina">
   <a href="#">
      <img src="<?php echo IMGSPATH?>prev.png" alt="Previous" /> 
   </a>
   
   <a href="#">1</a>  
   <a href="#">2</a>  
   <a href="#">3</a>  
   <a href="#">4</a>  
   <a href="#">5</a> 

   <a href="#">
      <img src="<?php echo IMGSPATH?>next.png" alt="Next" />
   </a>
</div>

*/

?>
<?php
/*
        <!--<div class="bannerthree">
         <div class="models">
          <img  src="images/m1.jpg" alt="model" width="210" height="390" />
          </div><div class="models"><img  src="images/m1.jpg" alt="model" width="210" height="390" /></div><div class="models"><img  src="images/m1.jpg" alt="model" width="210" height="390" /></div>
          </div>-->
        <!--<div class="bannertwo">
         <div class="leftimg">
         <img  src="images/m4.jpg" alt="model" width="300" height="250" /></div>
         <div class="rightadsense"><img  src="images/ad3.jpg" alt="model" width="355" height="250" /></div>
         </div>-->
        <!--<div class="twia">
         <div class="heading"> <span class="left"><img src="images/left.png" alt="left" /></span>
            the world in action<span class="right"><img src="images/right.png" alt="right" /></span>
            </div>
            <div class="twiacontents">
                <div class="contents">
                <span>Miss Nepal 2013! Begins</span>
            <img src="images/twia.jpg" alt="twia" width="210" height="120" /></div><div class="contents">
                <span>Miss Nepal 2013! Begins</span>
            <img src="images/twia.jpg" alt="twia" width="210" height="120" /></div><div class="contents">
                <span>Miss Nepal 2013! Begins</span>
            <img src="images/twia.jpg" alt="twia" width="210" height="120" /></div>
            </div>
         </div>-->
*/
?>
    </div>

   <?php $this->view('site/right_part.php')?>

</div>