<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* library to render page beside the main page
*/
 
 
class Render_library{

	private $ci = null;

	/**
	 * __construct
	 *
	 * @return void
	 **/
	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->database();
	}

	public function render_header($data){

		$op = 	'<div class="header">
					<div class="logo">
						<a href="'.base_url().'">
							<img src="'.IMGSPATH.'logo.png" alt="Model Nepal" title="Model Nepal" />
						</a>
					</div>
					<div class="h-ad">';
//echo '<pre>';
//print_r($data['ads']);die;
				foreach($data['ads'] as $key=>$val){
//echo $key;
//print_r($val);
//echo '<br/>';
					$op .= '<a href="'.$val->link.'">
								<img src="'.ADDSPATH.$val->image.'" alt="ad1" />
							</a>';
				}	
//die;					
		$op .=		'</div>
					<div class="nav">
						<a href="'.base_url().'">Home</a>';
					foreach($data['nav'] as $key=>$val){
						$op .= '<a href="'.$val.'">'.$key.'</a>';
					}
		$op .=		'</div>
					<div class="search">
						<form>
							<input type="button" name="">
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


	public function render_mainContents($data){
//echo '<pre>';
//print_r($data['add2']);die;
		$op = 	'<div class="mainContents">
					<div class="leftPart">
						<div class="fullbanner">
							<a href="'.$data['add']->link.'">
								<img src="'.ADDSPATH.$data['add']->image.'" alt="Banner" width="690" height="110" />
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
										<img  src="'.FEATUREDPATH.$val['img'].'" alt="model"  />
										<div class="ps_desc">
											<h2>'.$val['title'].'</h2>
											<span>'.$val['desc'].'</span>
										</div>
									</div>';
						}
									
					$op .= 		'</div>
							</div>
							<!-- slider end -->

							</div>
						<div class="bannertwo">
							
							<div class="leftimg">
						    	<a href="'.$data['subject']['url'].'">
						    		<img  src="'.SUBJECTSPATH.$data['subject']['img'].'" alt="model" width="300" height="250" />
					    		</a>
							</div>

						    <div class="rightadsense">
						    	<a href="'.$data['add2'][0]->link.'">
						    		<img  src="'.ADDSPATH.$data['add2'][0]->image.'" alt="model" width="355" height="250" />
					    		</a>
						    </div>
						</div>

						<div class="twia">
							<div class="heading"> 
								<span class="left">
									<img src="tmp/left.png" alt="left" />
								</span>
						    	the world in action
						    	<span class="right">
						    		<img src="tmp/right.png" alt="right" />
						    	</span>
						    </div>

						    <div class="twiacontents">
						    	<div class="contents">
						            <span>Miss Nepal 2013! Begins</span>
						            <img src="tmp/twia.jpg" alt="twia" width="210" height="120" />
						    	</div>
						    	<div class="contents">
						            <span>Miss Nepal 2013! Begins</span>
						        	<img src="tmp/twia.jpg" alt="twia" width="210" height="120" />
						        </div>
						        <div class="contents">
						        	<span>Miss Nepal 2013! Begins</span>
									<img src="tmp/twia.jpg" alt="twia" width="210" height="120" />
								</div>
						    </div>
						</div>
					</div>'.

	                $this->render_right($data['render_right']).
	               
				'</div>';

		return $op;
	}


	public function render_right($data){
//echo '<pre>';
//print_r($data);
//die;
		$op = 	'<div class="rightPart">';

		foreach($data as $key=>$val){
			$op .= 	'<div class="rads">
						<a href="'.$val->link.'">
							<img src="'.ADDSPATH.$val->image.'" alt="Ad" width="250" />
						</a>
					</div>';
		}
		$op .=	'</div>';

		return $op;
	}


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
				          <img src="'.IMGSPATH.'fisheye.png" alt="Fish Eya" />
				        </span>
				        <span class="logs">in Association with<br />
				          <img src="'.IMGSPATH.'studiof.png" alt="Fish Eya" />
				        </span>
				        <span class="logs">Supported By:<br />
				          <img src="'.IMGSPATH.'songsnepal.png" alt="Fish Eya" />
				        </span>
				        <span class="logs"><br />
				          <img src="'.IMGSPATH.'sparrow.png" alt="Fish Eya" />
				        </span>
				        <span class="logs">Hosting By<br />
				          <img src="'.IMGSPATH.'ws.png" alt="Fish Eya" />
				        </span>
				      </div>
				    </div>
				  <div class="footerend">&copy; Copyright '.date("Y").' ModelsNepal.com. All Rights Reserved.</div>
				</div>';		
		
		return $op;
	}
}
