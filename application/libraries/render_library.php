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

//				if(isset($data['ads'])){
//				foreach($data['ads'] as $key=>$val){
//					$op .= '<a href="'.$val->link.'">
//								<img src="'.base_url().ADDSPATH.$val->image.'" alt="ad1" />
//							</a>';
//				}	
//				}

		$op .=		'</div>
					<div class="nav">
						<a href="'.base_url().'">Home</a>';
					foreach($data['nav'] as $key=>$val){
						$op .= '<a href="'.$val.'">'.$key.'</a>';
					}
		$op .=		'</div>


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
						-->
						<!--
						-->
						<div class="like">	
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
								
						
							</div>

						    <div class="rightadsense">';

					//advertizing thru image ad
					if($data['add2'][0]->type=='image'){
						
					//advertizing thru scrip
					}else{
					}

			$op .= 		    '</div>
						</div>

						<div class="twia">
							<div class="heading"> 
								<span class="left" id="left">
									<img src="'.base_url().IMGSPATH.'left.png" alt="left" />
								</span>
						    	the world in action
						    	<span class="right" id="right">
						    		<img src="'.base_url().IMGSPATH.'right.png" alt="right" />
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
			
			//advertizing thru scrip
			}else{
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