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
					<div class="search">
						<form>
							<input type="button" name="" style="position:absolute;">
							<input type="text" 
									onfocus="this.value=\'\'" 
									value="Type Email Address ..." 
									id="search" name="search" />
						</form>
					</div>				
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
						<div class="date">'.date('j F Y').'</div>
						<div class="like">
							<div class="addthis_toolbox addthis_default_style ">
								<a class="addthis_button_facebook_like"></a>
							</div>
							<script type="text/javascript" 
									src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-512a3fd75f430942">
							</script>
						</div>
				    </div>
				</div>';	
		return $op;
	}

	/**
	 * Render Main conteht of the page
	 */
	public function render_mainContents($data){
		$op = 	'<div class="mainContents">
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
										<a href="'.$val['link'].'" style="width:inherit;height:inherit;">
											<img  src="'.$val['img'].'" alt="'.$val['model']->name.'"  />'.
											//'<div class="ps_desc">'
											//'	<h2>'.$val['title'].'</h2>'
											//'	<span>'.$val['desc'].'</span>'
											//'</div>'
										'</a>
									</div>';
						}
									
					$op .= 		'</div>
							</div>
							<!-- slider end -->

							</div>
						<div class="bannertwo">
							
							<div class="leftimg">
						    	<a href="'.$data['subject']['url'].'">
						    		<!--<img  src="'.base_url().SUBJECTSPATH.$data['subject']['img'].'" alt="model" width="300" height="250" />-->
						    		<img  src="'.base_url().'tmp/m4.jpg" alt="model" width="300" height="250" />
					    		</a>
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
										});
									});
									</script>
									<style>
									#left,#right{cursor:pointer;}
									</style>';
							}
				$op .=	    '<div class="twiacontents" id="twiacontents">';

						    $news_count=0;
						    foreach($data['news'] as $key=>$val){
				$op .= 	    	'<div class="contents slide" >
									<a href="#">
							            <span>'.$val->title.'</span>
							            <img src="'.NEWSSPATH.$val->image.'" alt="'.$val->title.'" 
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

	                $this->render_right($data['render_right']).
	               
				'</div>';

		return $op;
	}


	public function render_right($data){

		$op = 	'<div class="rightPart">';

		//events link
		$op .= 	'<div class="rads">';

		$op.=		'<a href="'.site_url('events').'">
						<img src="'.base_url().IMGSPATH.'events.jpg" alt="Latest Events" width="250" />
					</a>';
		
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
				          <img src="'.base_url().IMGSPATH.'fisheye.png" alt="Fish Eya" />
				        </span>
				        <span class="logs">in Association with<br />
				          <img src="'.base_url().IMGSPATH.'studiof.png" alt="Fish Eya" />
				        </span>
				        <span class="logs">Supported By:<br />
				          <img src="'.base_url().IMGSPATH.'songsnepal.png" alt="Fish Eya" />
				        </span>
				        <span class="logs"><br />
				          <img src="'.base_url().IMGSPATH.'sparrow.png" alt="Fish Eya" />
				        </span>
				        <span class="logs">Hosting By<br />
				          <img src="'.base_url().IMGSPATH.'ws.png" alt="Fish Eya" />
				        </span>
				      </div>
				    </div>
				  <div class="footerend">&copy; Copyright '.date("Y").' ModelsNepal.com. All Rights Reserved.</div>
				</div>';		
		
		return $op;
	}
}
