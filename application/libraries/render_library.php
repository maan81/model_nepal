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
		$data = array(
					'ads'	=>	array(
									'ad1'	=> 'ad1.jpg',
									'ad2'	=> 'ad2.jpg'
								),
					'nav'	=>	array(
									'Featured Models'	=> '#',
									'Agency'			=> '#',
									'News & Gossips'	=> '#',
									'Events'			=> '#',
									'Music'				=> '#',
									'Videos'			=> '#',
								)
				);

		$op = 	'<div class="header">
					<div class="logo">
						<img src="'.IMGSPATH.'logo.png" alt="Model Nepal" title="Model Nepal" />
					</div>
					<div class="h-ad">'.
						'<img src="'.IMGSPATH.$data['ads']['ad1'].'" alt="ad1" />'.//add1
						'<img src="'.IMGSPATH.$data['ads']['ad2'].'" alt="ad1" />'.//add1
					'</div>
					<div class="nav">
						<a href="#">Home</a>';
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


	public function render_toplink($data){
		$op = 	'<div id="toplink">
					<div class="toplink">
						<div class="date">'.date('j F Y').'</div>
						<div class="like">
							<div class="addthis_toolbox addthis_default_style ">
								<a class="addthis_button_facebook_like"></a>
							</div>
							<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-512a3fd75f430942"></script>
						</div>
				    </div>
				</div>';	
		return $op;
	}


	public function render_mainContents($data){

		$op = 	'<div class="mainContents">
					<div class="leftPart">
						<div class="fullbanner">
							<img src="tmp/fullbanner.jpg" alt="Banner" width="690" height="110" />
						</div>
						<div class="bannerthree">

							<!-- slider start -->
							<div id="ps_slider" class="ps_slider">
								<a class="prev disabled"></a>
								<a class="next disabled"></a>

								<div id="ps_albums">
									<div class="ps_album models" style="opacity:0;">
										<img  src="tmp/m1.jpg" alt="model"  />
										<div class="ps_desc">
											<h2>The Night</h2>
											<span>
												Top Cat! The most effectual Top Cat! Who$#39;s intellectual close friends get 
												to call him T.C., providing it&#39;s with dignity.Top Cat! The indisputable leader!
											</span>
										</div>
									</div>
									<div class="ps_album models" style="opacity:0;">
										<img  src="tmp/m1.jpg" alt="model"  />
										<div class="ps_desc">
											<h2>The Night</h2>
											<span>
												Top Cat! The most effectual Top Cat! Who&#39;s intellectual close friends get 
												to call him T.C., providing it&#39;s with dignity.Top Cat! The indisputable leader!
											</span>
										</div>
									</div>
									<div class="ps_album models" style="opacity:0;">
										<img  src="tmp/m1.jpg" alt="model" />
										<div class="ps_desc">
											<h2>The Night</h2>
											<span>
												Top Cat! The most effectual Top Cat! Who&#39;s intellectual close friends get 
												to call him T.C., providing it&#39;s with dignity.Top Cat! The indisputable leader!
											</span>
										</div>
									</div>
									<div class="ps_album models" style="opacity:0;">
										<img  src="tmp/m1.jpg" alt="model"  />
										<div class="ps_desc">
											<h2>The Night</h2>
											<span>
												Top Cat! The most effectual Top Cat! Who&#39;s intellectual close friends get 
												to call him T.C., providing it&#39;s with dignity.Top Cat! The indisputable leader!
											</span>
										</div>
									</div>
									<div class="ps_album models" style="opacity:0;">
										<img  src="tmp/m1.jpg" alt="model"  />
										<div class="ps_desc">
											<h2>The Night</h2>
											<span>
												Top Cat! The most effectual Top Cat! Who&#39;s intellectual close friends get 
												to call him T.C., providing it&#39;s with dignity.Top Cat! The indisputable leader!
											</span>
										</div>
									</div>
									<div class="ps_album models" style="opacity:0;">
										<img  src="tmp/m1.jpg" alt="model" />
										<div class="ps_desc">
											<h2>The Night</h2>
											<span>
												Top Cat! The most effectual Top Cat! Who&#39;s intellectual close friends get 
												to call him T.C., providing it&#39;s with dignity.Top Cat! The indisputable leader!
											</span>
										</div>
									</div>
								</div>
							</div>
							<!-- slider end -->

							</div>
							<div class="bannertwo">
								<div class="leftimg">
							    	<img  src="tmp/m4.jpg" alt="model" width="300" height="250" />
								</div>
							    <div class="rightadsense"><img  src="tmp/ad3.jpg" alt="model" width="355" height="250" />
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

	                $this->render_right(false).
	               
				'</div>';

		return $op;
	}


	public function render_right($data){

		$op = 	'<div class="rightPart">
					<div class="rads">
						<img src="tmp/rad1.jpg" alt="Ad" />
					</div>
					<div class="rads">
						<img src="tmp/rad2.jpg" alt="Ad" />
					</div>
					<div class="rads">
						<img src="tmp/rad3.jpg" alt="Ad" />
					</div>
					<div class="rads">
						<img src="tmp/rad1.jpg" alt="Ad" width="250" height="200" />
					</div>
					<div class="rads">
						<img src="tmp/rad4.jpg" alt="Ad" width="250" height="100"  />
					</div>
				</div>';

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
				          <img src="tmp/fisheye.png" alt="Fish Eya" />
				        </span>
				        <span class="logs">in Association with<br />
				          <img src="tmp/studiof.png" alt="Fish Eya" />
				        </span>
				        <span class="logs">Supported By:<br />
				          <img src="tmp/songsnepal.png" alt="Fish Eya" />
				        </span>
				        <span class="logs"><br />
				          <img src="tmp/sparrow.png" alt="Fish Eya" />
				        </span>
				        <span class="logs">Hosting By<br />
				          <img src="tmp/ws.png" alt="Fish Eya" />
				        </span>
				      </div>
				    </div>
				  <div class="footerend">&copy; Copyright <?php echo date("Y"); ?> ModelsNepal.com. All Rights Reserved.</div>
				</div>';		
		
		return $op;
	}
}
