<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php //customized google search css ?>
<style>
.leftPart
.cse .gsc-control-cse, .gsc-control-cse {
    background-color: transparent;
}
.leftPart .cse .gsc-control-cse, .gsc-control-cse {
    border:0;
}
.leftPart .cse .gsc-control-cse, .gsc-control-cse {
    padding:1em 1.5em 1em 1em;
}    
.leftPart .cse .gsc-webResult.gsc-result, .gsc-webResult.gsc-result, .gsc-imageResult-classic, .gsc-imageResult-column {
    border-left: 1px solid #999999;
}
</style>

<div class="mainContents">

    <div class="leftPart">
        <div class="fullbanner">
            <a href="<?php echo $add->link?>">
                <img src="<?php echo base_url().ADDSPATH.$add->image?>" alt="Banner" width="690" height="110" />
            </a>
        </div>

        <script>
            (function() {
                var cx = '012904614657930534599:m9nt-ujiieu';
                var gcse = document.createElement('script');
                gcse.type = 'text/javascript';
                gcse.async = true;
                gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                '//www.google.com/cse/cse.js?cx=' + cx;
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(gcse, s);
            })();
        </script>
        <gcse:searchresults-only></gcse:searchresults-only>


        <div class="bannertwo">
            <div class="leftimg">
                <!-- <img  src="<?php echo base_url()?>tmp/m4.jpg" alt="model" width="300" height="250" /> -->
                <script type="text/javascript"><!--
                google_ad_client = "ca-pub-7372466155313335";
                /* 300 Ad */
                google_ad_slot = "5624517025";
                google_ad_width = 300;
                google_ad_height = 250;
                //-->
                </script>
                <script type="text/javascript"
                        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                </script>
            </div>

            <div class="rightadsense">
                <a href="<?php echo $add2[0]->link?>">
                    <img  src="<?php echo base_url().ADDSPATH.$add2[0]->image?>" 
                       alt="model" width="355" height="250" />
                </a>
            </div>
        </div>
    
    </div>

   <?php $this->view('site/right_part.php')?>

</div>