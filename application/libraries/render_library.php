<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* library to render page beside the main page
*/
 
 
class Render_library{

	/**
	 * __construct
	 *
	 * @return void
	 **/
	public function __construct(){}

	/**
	 * Render the headher
	 *
	 * @param array (obj[header_add], links ) 
	 * @return string [generated html]
	 */
	public function render_header($data){

		$op = 	'<div class="header">
					<div class="logo">
						<a href="'.base_url().'">
							<img src="'.base_url().IMGSPATH.'logo.png" alt="Model Nepal" title="Model Nepal" />
						</a>
					</div>
					<div class="h-ad">';

				if(isset($data['ads'])){
				foreach($data['ads'] as $key=>$val){
					$op .= '<a href="'.$val->link.'">
								<img src="'.base_url().ADDSPATH.$val->image.'" alt="ad1" />
							</a>';
				}	
				}

		$op .=		'</div>
					<div class="nav">
						<a href="'.base_url().'">Home</a>';
					foreach($data['nav'] as $key=>$val){
						$op .= '<a href="'.$val.'">'.$key.'</a>';
					}
		$op .=		'</div>
					<!--
					<div class="search">
						<form>
							<input type="button" name="" style="position:absolute;">
							<input type="text" 
									onfocus="this.value=\'\'" 
									value="Type Email Address ..." 
									id="search" name="search" />
						</form>
					</div>
					-->

					<!-- Google custom search box Start -by BloggerSentral.com -->
					<div class="cse search" style="color:#000000;float:right;/*margin:6px 10px 0 0;*/">
						<form action="'.site_url('search').'" id="cse-search-box">
							<input name="cx" type="hidden" value="partner-pub-7372466155313335:2216816197"/>
							<input id="q" type="text" name="q" />
							<input name="ie" type="hidden" value="ISO-8859-1"/>
							<input type="submit" name="sa" value="&nbsp;&nbsp;" />
							<input type="hidden" name="cof" value="FORID:10" />
						</form>
						<script type="text/javascript" 
								src="http://www.google.com/cse/brand?form=cse-search-box&amp;lang=en">
						</script>
						<script>
						$(function(){
						
							$("#cse-search-box").submit(function(){
								document.cookie = "s" + "=" + $("#q").val() + "; path=/";
							})

							c_name = "s";							
							c_start = document.cookie.indexOf(c_name + "=");
							if (c_start != -1) {
							    var s;
							    c_start = c_start + c_name.length + 1;
							    c_end = document.cookie.indexOf(";", c_start);
							    if (c_end == -1) {
							        c_end = document.cookie.length;
							    }
							    s = unescape(document.cookie.substring(c_start, c_end));
							    document.cookie = "s" + "=" + "";
							}
        
    						s = "";
    						if(window.location.search.length)
    							s = window.location.search.split("&")[1].split("=")[1];
							$("#q").delay(250).css({border:0,"padding-top":"2px"}).val(s);
						})
						</script>
					</div>
					<!-- Google custom search box End -->

				</div>';
		return $op;
	}

	/**
	 * Facebook's Like button
	 * Server's date
	 */
	public function render_toplink($data){
		$op = 	'<div id="toplink">
					<div class="toplink">
						<div class="date">'.date('j F Y').'</div>';


		////facebook disabled ... for offline use
		//$op .=		'</div>
		//		</div>';
		//return $op;


		$op .=			'<!--
						<div class="like">
							<div class="addthis_toolbox addthis_default_style ">
								<a class="addthis_button_facebook_like"></a>
							</div>
							<script type="text/javascript" 
									src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-512a3fd75f430942"
									data-href="'.base_url().'">
							</script>
						</div>
						-->
						<!--
						<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fmodelsnepal&amp;send=false&amp;layout=standard&amp;width=53&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=25" 
								scrolling="no" 
								frameborder="0" 
								style="border:none; overflow:hidden; width:53px; height:25px;" 
								allowTransparency="true">
						</iframe>
						-->
						<!--
						<div class="like">
							<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fmodelsnepal&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=false&amp;font&amp;colorscheme=dark&amp;action=like&amp;height=35" 
									scrolling="no" 
									frameborder="0" 
									style="border:none; overflow:hidden; width:450px; height:35px;" 
									allowTransparency="true">
							</iframe>
						</div>
						-->
						<div class="like">	
							<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fmodelsnepal&amp;send=false&amp;layout=button_count&amp;amp;show_faces=false&amp;font&amp;colorscheme=dark&amp;action=like&amp;height=21" 
									scrolling="no" 
									frameborder="0" 
									style="border:none; overflow:hidden; height:21px;" 
									allowTransparency="true">
							</iframe>
						</div>

				    </div>
				</div>';	
		return $op;
	}

	/**
	 * Render Main conteht of the page
	 */
	public function render_mainContents($data){
		$op =	'<script type="text/javascript">
				$(function(){
					$(".ps_album .ps_desc",".ps_slider").hover(
						function(){
							$(this).animate({"opacity":0.75},250)
						},
						function(){
							$(this).animate({"opacity":0},250)
						}
					)
				})
				</script>';
		$op .= 	'<div class="mainContents">
					<div class="leftPart">
						<div class="fullbanner">
							<a href="'.$data['add']->link.'">
								<img src="'.base_url().ADDSPATH.$data['add']->image.'" 
										alt="Banner" width="690" height="110" />
							</a>
						</div>
						<div class="bannerthree">

							<!-- slider start -->
							<div id="ps_slider" class="ps_slider">
								<a class="prev disabled"></a>
								<a class="next disabled"></a>

								<div id="ps_albums">';

						foreach($data['featured'] as $key=>$val){
							$op .= 	'<div class="ps_album models" style="opacity:0;">
										<a href="'.$val['link'].'" style="width:inherit;height:inherit;" title="'.$val['model']->name.'">
											<img src="'.$val['img'].'" alt="'.$val['model']->name.'" title="'.$val['model']->name.'"  />'.
											'<div class="ps_desc">'.
											'	<h2>'.$val['model']->name.'</h2>'.
											//'	<table>
											//		<tr><td>Wardrobe :</td><td>'.$val['model']->wardrobe.'</td></tr>
											//		<tr><td>Location :</td><td>'.$val['model']->location.'</td></tr>
											//		<tr><td>Make-Up :</td><td>'.$val['model']->make_up.'</td></tr>
											//		<tr><td>Photographer:</td><td>'.$val['model']->photographer.'</td></tr>
											//		<tr><td>Model By :</td><td>'.$val['model']->model_by.'</td></tr>
											//		<tr><td>Date Created:</td><td>'.$val['model']->date_created.'</td></tr>
											//		<tr><td>Profile Viewed:</td><td>'.$val['model']->profile_viewed.'</td></tr>
											//	</table>'.
											'</div>'.
										'</a>
									</div>';
						}
									
					$op .= 		'</div>
							</div>
							<!-- slider end -->

							</div>
						<div class="bannertwo">
							
							<div class="leftimg">
						    	<!-- 
						    	<a href="'.$data['subject']['url'].'">
						    		<!--<img  src="'.base_url().SUBJECTSPATH.$data['subject']['img'].'" 
						    					alt="model" width="300" height="250" /> ->
						    		<img  src="'.base_url().'tmp/m4.jpg" alt="model" width="300" height="250" />
					    		</a>
					    		-->
								
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

						    <div class="rightadsense">';

					//advertizing thru image ad
					if($data['add2'][0]->type=='image'){
						$op .=	'<a href="'.$data['add2'][0]->link.'">
									<img  src="'.ADDSPATH.$data['add2'][0]->image.'" alt="model" width="355" height="250" />
							    </a>';
					
					//advertizing thru scrip
					}else{
						$op.=	$data['add2'][0]->script;
					}

			$op .= 		    '</div>
						</div>

						<div class="twia">
							<div class="heading"> 
								<span class="left" id="left">
									<img src="tmp/left.png" alt="left" />
								</span>
						    	the world in action
						    	<span class="right" id="right">
						    		<img src="tmp/right.png" alt="right" />
						    	</span>
						    </div>';

						    if(count($data['news'])>3){
							$op .=	'<script type="text/javascript">
									$(function(){
										$("#twiacontents").my_slider({
											l:"left",
											r:"right",
											each_width:	220,
											each_height:120,
											h:false,
											autoMove:false,
											showPlay:false,
											move:750,
										});
									});
									</script>
									<style>
									#left,#right{cursor:pointer;}
									.twia #twiacontents{
										width:690px;
									}
									</style>';
							}
				$op .=	    '<div class="twiacontents" id="twiacontents">';

						    $news_count=0;
						    foreach($data['news'] as $key=>$val){
				$op .= 	    	'<div class="contents slide" >
									<a href="#">
							            <span>'.$val->title.'</span>
							            <img src="'.$val->image.'" alt="'.$val->title.'" 
							            		title="'.$val->content.'"
							            		width="210" height="120" />
									</a>
						    	</div>';
						    	$news_count++;

						    }


				$op .=	   // 	'<div class="contents">
						   //         <span>Miss Nepal 2013! Begins</span>
						   //     	<img src="tmp/twia.jpg" alt="twia" width="210" height="120" />
						   //     </div>
						   //     <div class="contents">
						   //     	<span>Miss Nepal 2013! Begins</span>
							//		<img src="tmp/twia.jpg" alt="twia" width="210" height="120" />
							//	</div>
						    '</div>
						</div>
					</div>'.

	                $this->render_right($data['render_right'],$data['flinks']).
	               
				'</div>';

		return $op;
	}


	public function render_right($data,$flinks){

		//vertical jquery slider
		$op =	'<script type="text/javascript">
				$(function(){
					$("#flinks").my_slider({
						move	:	750,
						pause	:	5000,
						each_width:	250,
						each_height:300,
						num		:	1,
						showDir	:	false,
						showPlay:	false,
						autoMove:	true,
						display	:	"vertical",
					});
				});
				</script>';
		$op .= '<style>
					#main #flinks {
										width:250px;
										margin-bottom:10px;
									}
					#main #flinks .slide{
											width:250px;
											border:0;
											margin-bottom:0;
										}
				</style>';

		
		$op .= 	'<div class="rightPart">';

		//featured link
		$op .= 	'<div class="rads" id="flinks">';
		foreach($flinks as $key=>$val){
			$op.=	'<div class="flink slide">
						<a href="'.$val->link.'">
							<img src="'.base_url().FLINKSPATH.$val->image.'" 
								alt="'.$val->title.'" 
								title="'.$val->title.'" 
								width="250" height="300" />
						</a>
					</div>';
		}
		$op .=	'</div>';

		foreach($data as $key=>$val){

			$op .= 	'<div class="rads">';

			//advertizing thru image ad
			if($val->type=='image'){
				$op.=	'<a href="'.$val->link.'">
							<img src="'.base_url().ADDSPATH.$val->image.'" alt="Ad" width="250" />
						</a>';
			
			//advertizing thru scrip
			}else{
				$op.=	$val->script;
			}

			$op .=	'</div>';
		}
		$op .=	'</div>';

		return $op;
	}


	/**
	 *  Render Footer of the content page.
	 *  Variables not yet set....................
	 */
	public function render_footer($data){

		$op = 	'<div id="footer">
				  <div class="footer">
				    <div class="contact">
				        A Venture of <br />
				        THE FASHION PLUS<br />
				        Putalisadak, Kathmandu, Nepal<br />
				        + 977 01-4242893 | 9851026750 </div>
				      <div class="logos">
				        <span class="logs">A presentation of<br />
				          <a href="http://www.facebook.com/fisheye.interactive">
				          	<img src="'.base_url().IMGSPATH.'fisheye.png" alt="Fish Eya" />
			          	  </a>
				        </span>
				        <span class="logs">in Association with<br />
				          <a href="http://www.facebook.com/f8photography">
				          	<img src="'.base_url().IMGSPATH.'studiof.png" alt="Fish Eya" />
				          </a>
				        </span>
				        <span class="logs">Supported By:<br />
				          <img src="'.base_url().IMGSPATH.'songsnepal.png" alt="Fish Eya" />
				        </span>
				        <span class="logs"><br />
				          <img src="'.base_url().IMGSPATH.'sparrow.png" alt="Fish Eya" />
				        </span>
				        <span class="logs">Hosting By<br />
				          <a href="http://websansar.com">
					          <img src="'.base_url().IMGSPATH.'ws.png" alt="Fish Eya" />
				          </a>
				        </span>
				      </div>
				    </div>
				  <div class="footerend">&copy; Copyright '.date("Y").' ModelsNepal.com. All Rights Reserved.</div>
				</div>';		
		
		return $op;
	}
}