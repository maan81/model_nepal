<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* library to render page beside the main page
*/
 
 
class Adminrender_library{
	
	private $ci = null;
	protected $news_type = array();
	protected $ethnicity = array();
	protected $usertype = array();
	protected $adddimensions	= array();
	protected $adddimensions_script = array();

	/**
	 * __construct
	 *
	 * @return void
	 **/
	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->database();
		$this->ci->load->helper('form');

		array_push( $this->usertype,
						'administrator', 'editor', 'user'
					);

		$this->adddimensions = array(
									'h-ad'		  => 'Horizontal Ads',
									'fullbanner'  => 'Full Banner',
									'rads'		  => 'Right Ads',
									'rightadsense'=> 'Right Adsense',
									'rtbbox'	  => 'Right Upper/Lower Box'
								);

		$this->adddimensions_script = array(
										'rads'		  => 'Right Ads',
										'rightadsense'=> 'Right Adsense',
										'rtbbox'	  => 'Right Upper/Lower Box'
									);
	}
	

	/**
	 * admin menu
	 */
	public function render_navigation($selected){
		$this->ci->load->config('nav');
		$data = $this->ci->config->item('admin_nav');

		if($this->ci->session->userdata('usertype')=='administrator'){
			$data['Users'] = base_url().'admin/users';
		}

		$op = '<ul id="navigation">';
		foreach($data as $key=>$val){

			if($key==$selected){
				$op .= '<li><span class="active">'.$key.'</span></li>';//for selected poriton
			}else{
				$op .= '<li><a href="'.$val.'">'.$key.'</a></li>';
			}
		}
		$op .= '</ul>';
		
		return $op;
	}
	


	/**
	 * Admin's homepage
	 */
	public function render_adminhome($data){
		$this->ci->template->add_css(ADMINCSSPATH.'adminhome.css');

		$op = 	'<div class="grid_5 user_hist">
					<div class="box">
						<h2>'.$data->username.'</h2>
						<p>
							<strong>Last Signed In : </strong>'.$data->last_loggedin.'<br>
							<strong>IP Address : </strong> '.$data->last_location.'
						</p>
					</div>
				</div>
				<h2>Select a Task</h2>';

		if( $this->ci->session->userdata('usertype')=='administrator'){
		$op .=	'<div class="grid_14" style="border: 1px solid black; border-radius: 25px 25px 25px 25px; position: relative; margin: 20px 0 20px 60px; padding-left: 25px; padding-top: 10px; padding-bottom: 10px;">';
		}else{
		$op .=	'<div class="grid_12" style="border: 1px solid black; border-radius: 25px 25px 25px 25px; position: relative; margin: 20px 0 20px 100px; padding-left: 25px; padding-top: 10px; padding-bottom: 10px;">';
		}

		$op .=		'<a class="icon-box" href="'.site_url('admin/featured/new_featured').'">
						<img alt="new featured" src="'.base_url().ADMINIMGSPATH.'woman_slim3.png" title="Create New Featured Model">
						<div class="value">New Model</div>
					</a>

					<a class="icon-box" href="'.site_url('admin/events/new_event').'">
						<img alt="new event" src="'.base_url().ADMINIMGSPATH.'show_reel.png" title="Create New Event">
						<div class="value">New Event</div>
					</a>

					<a class="icon-box" href="'.site_url('admin/news/new_news').'">
						<img alt="new news" src="'.base_url().ADMINIMGSPATH.'news.png" title="Create New News">
						<div class="value">New News</div>
					</a>

					<a href="'.site_url('admin/models/new_subject').'" class="icon-box">
						<img alt="new agency" src="'.base_url().ADMINIMGSPATH.'users_2.png" title="Create New Agency">
						<div class="value">New Agency</div>
					</a>

					<a href="'.site_url('admin/ads/new_ad').'" class="icon-box">
						<img alt="new advertizement" src="'.base_url().ADMINIMGSPATH.'clipping_picture.png" title="Create New Advertizement">
						<div class="value">New Ads</div>
					</a>

					<a href="'.site_url('admin/contests/new_contest').'" class="icon-box">
						<img alt="new advertizement" src="'.base_url().ADMINIMGSPATH.'clipping_picture.png" title="Create New Advertizement">
						<div class="value">New Contest</div>
					</a>

					<a href="'.site_url('admin/flinks/new_flink').'" class="icon-box">
						<img alt="new link" src="'.base_url().ADMINIMGSPATH.'clipping_picture.png" title="Create New Featured Link">
						<div class="value">New Link</div>
					</a>';

		if( $this->ci->session->userdata('usertype')=='administrator'){
			$op .=	'<a href="'.site_url('admin/users/new_user').'" class="icon-box">
						<img alt="new user" src="'.base_url().ADMINIMGSPATH.'user3.png" title="Create New User">
						<div class="value">New User</div>
					</a>';
		}


			$op .=	'<a class="icon-box" href="'.site_url('admin/featured').'">
						<img alt="list featured" src="'.base_url().ADMINIMGSPATH.'onebit_39.png" title="List Existing Featured Model">
						<div class="value">List Models</div>
					</a>

					<a class="icon-box" href="'.site_url('admin/events').'">
						<img alt="list events" src="'.base_url().ADMINIMGSPATH.'onebit_39.png" title="List Existing Events">
						<div class="value">List Events</div>
					</a>

					<a class="icon-box" href="'.site_url('admin/news').'">
						<img alt="list news" src="'.base_url().ADMINIMGSPATH.'onebit_39.png" title="List Existing News">
						<div class="value">List News</div>
					</a>

					<a href="'.site_url('admin/subjects').'" class="icon-box">
						<img alt="list agency" src="'.base_url().ADMINIMGSPATH.'onebit_39.png" title="List Existing Agencies">
						<div class="value">List Agency</div>
					</a>

					<a href="'.site_url('admin/ads').'" class="icon-box">
						<img alt="list advertizement" src="'.base_url().ADMINIMGSPATH.'onebit_39.png" title="List Existing Advertizements">
						<div class="value">List Ads</div>
					</a>

					<a href="'.site_url('admin/contests').'" class="icon-box">
						<img alt="list contests" src="'.base_url().ADMINIMGSPATH.'onebit_39.png" title="List Existing Contests">
						<div class="value">List Contests</div>
					</a>

					<a href="'.site_url('admin/flinks').'" class="icon-box">
						<img alt="list featured links" src="'.base_url().ADMINIMGSPATH.'onebit_39.png" title="List Existing Featured Links">
						<div class="value">List Links</div>
					</a>';

		if( $this->ci->session->userdata('usertype')=='administrator'){
			$op .=	'<a href="'.site_url('admin/users').'" class="icon-box">
						<img alt="list users" src="'.base_url().ADMINIMGSPATH.'onebit_39.png" title="List Existing Users">
						<div class="value">List Users</div>
					</a>';
		}

		$op .=	'</div>

				<hr/>';

		return $op;
	}

	/**
	 * ads list
	 */
	public function render_adslist($data){
		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/ads/new_ad').'">New</a>
					</p>
				</div>
				<h2>Advertizements List</h2>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';

		if($data)
		foreach($data as $key=>$val){
			$op .=	'['.
						'"'.$val->id.'", '.
						'"'.$val->category.'", '.
						'"'.$val->title.'", '.
						'"'.$val->type.'", '.
						'"'.$val->dimensions.'", '.
						'"'.$val->position.'", ';

			if($val->position == 1 ){
				$op .=	'"<span class=\"disabled_positioning\">------</span>", ';

			}else{
				$op .=	'"<a class=\"up\" href=\"'.site_url('admin/ads/up/'.$val->id).'\" title=\"Shift the ad one step up\" >Up</a>", ';
			}

			if($val->position == count($data)){

				$op .= 	'"<span class=\"disabled_positioning\">------</span>", ';
			}else{

				$op .= 	'"<a class=\"down\" href=\"'.site_url('admin/ads/down/'.$val->id).'\" title=\"Shift the ad one step down\" >Dn</a>", ';
			}

			$op .= 		'"<a class=\"edit\" href=\"'.site_url('admin/ads/edit/'.$val->id).'\" title=\"Edit element ID '.$val->id.'\" >Edit</a>", '.
						'"<a class=\"delete\" href=\"'.site_url('admin/ads/del/'.$val->id).'\" title=\"Delete element ID '.$val->id.'\" >Delete</a>" ], ';
		}

		$op .=  '],
				"aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Category" },
			            { "sTitle": "Title" },
			            { "sTitle": "Type" },
			            { "sTitle": "Dimensions"},
			            { "sTitle": "Position"},
			            { "sTitle": "Move Up" , sWidth:"5%"},
			            { "sTitle": "Move Down" , sWidth:"5%"},
			            { "sTitle": "Actions", sWidth:"5%"},
			            { "sTitle": "" , sWidth:"5%"},
		        ],
			    "aaSorting":[[5,\'asc\']],
				"bStateSave": true,
			    } );   
			} );
			</script>';
		$op .= 	'<div class="grid_16"><table id="list_data"></table></div>';
		return $op;
	}
	
	
	/**
	 * new ads form
	 */
	public function render_new_ads($data){
		$op = '<style>
				#content .fx {
				    border: 1px solid #DDDDDD;
				    font-family: inherit;
				    font-size: inherit;
				    padding: 1.5px 4px;
				    position: absolute;
				    width: 330px;
				}</style>';

		$op .= '<script type="text/javascript">
				$(function(){
					
					var type;
					$("select[name=type]").change(function(){
						type = $(this).val();

						$(".is_"+type).slideDown();
						$(".not_"+type).slideUp();
					});

					$("select[name=type]").trigger("change");

					$("#content").find("form").submit(function(){
						$(".not_"+type).remove();
					});';

		if(is_object($data[0])){
			$op .=	'var $img;
					//remove old img & add input for new image
					$(".change_img").live("click",function(e){
						e.preventDefault();
						
						var str = "<input class=\"new_img\" type=\"file\" name=\"image\">";
						str = str + "<a class=\"cancel_change_img\" href=\"#\">cancel</a>";

						$(this).after(str);
						$img = $(".old_img").detach()+$(this).detach();

						$(".new_img").trigger("click");
					});						

					//restore the earlier image 
					$(".cancel_change_img").live("click",function(e){
						e.preventDefault();
						
 						var str = "<img class=\"old_img\" src=\"'.base_url().ADDSPATH.$data[0]->image.'\" />";
						str = str + "<a href=\"#\" class=\"change_img\">Change</a>";

						$(this)
							.after(str)
						$(".new_img").remove();
						$(this).remove();
					});';
		}
		$op .= 	'})
			  </script> ';

		$op .=	//'<div class="container_16 clearfix" id="content">'.
					form_open_multipart().'
					<div class="grid_16">
						<div class="grid_2" style="float: right;">
							<p>
								<a href="'.base_url('admin/ads').'">Back</a>
							</p>
						</div>

						<h2>New Advertizement</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="title">Title <small>Alpha-numeric characters without spaces.</small></label>';
					if($data){
						//uneditable form input
						$op .=		'<span class="fx">'.$data[0]->title.'</span>';
					}else{
						//empty form input
						$op .=		'<input type="text" name="title" value=""/>';
					}
					$op .= 	'</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="category">Category</label>
							<select name="category">
								<option value="draft" '.($data?($data[0]->category=='draft'?'selected="selected"':''):'').'>Draft</option>
								<option value="published" '.($data?($data[0]->category=='published'?'selected="selected"':''):'').'>Published</option>
								<option value="private" '.($data?($data[0]->category=='private'?'selected="selected"':''):'').'>Private</option>
							</select>
						</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="type">Type<small>Select the type of ad</small></label>
							<select name="type">'.
								'<option value="image" '.
									($data?($data[0]->type=='image'?'selected="selected"':''):'').'>Advertizement Image Link'.
								'</option>'.
								'<option value="script" '.
									($data?($data[0]->type=='script'?'selected="selected"':''):'').'>Advertizement Script'.
								'</option>'.
							'</select>
						</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="dimensions">Dimensions <small>( width x height )</small></label>
							<select name="dimensions" class="is_image not_script">';
					foreach($this->adddimensions as $key=>$val){
						$op .= 	'<option value="'.$key.'" '.
									($data?($data[0]->dimensions==$key?'selected="selected"':''):'').'>'.$val.
								'</option>';
					}							
					$op .= 	'</select>
							<select name="dimensions" class="not_image is_script">';
					foreach($this->adddimensions_script as $key=>$val){
						$op .= 	'<option value="'.$key.'" '.
									($data?($data[0]->dimensions==$key?'selected="selected"':''):'').'>'.$val.
								'</option>';
					}							
					$op .= 	'</select>
						</p>
					</div>

					<div class="grid_12 not_image is_script">
						<p>
							<label for="script">Advertizement Script<small>Alpha-numeric characters without spaces.</small></label>
							<textarea name="script" style="height: 36px; resize: vertical; min-height: 100px;">'.
								(($data && $data[0]->script)?$data[0]->script:'')
							.'</textarea>
						</p>
					</div>

					<div class="grid_6 not_script is_image">
						<p class="img">
							<label for="image">Image<small>The required Advertizement image..</small></label>';
			
				if($data && $data[0]->image){
					$op .=	'<img class="old_img" src="'.base_url().ADDSPATH.$data[0]->image.'" />
							 <a href="#" class="change_img">Change</a>';
				}else{
					$op .= '<input class="new_img" type="file" name="image">';
							//'<a href="#" class="cancel_change_img">Cancel</a>';
				}		
			
			$op .= 		'</p>
					</div>

					<div class="grid_12 not_script is_image">
						<p>
							<label for="link">Link<small>Must contain alpha-numeric characters.</small></label>
							<input type="text" name="link" value="'.($data?$data[0]->link:'').'">
						</p>
					</div>

					<div class="grid_12">
						<p class="submit">
							<a href="javascript:history.back()">Cancel</a>
							<input type="submit" value="Submit">
						</p>
					</div>		
					</form>';
				//</div>';

		return  $op;
	}


	/**
	 * featured list
	 */
	public function render_featuredlist($data){

		$this->ci->load->config('ethnicity');
		$this->ethnicity = $this->ci->config->item('ethnicity');

		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/featured/new_featured').'">New</a>
					</p>
				</div>
				<h2>Featured Models List</h2>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';

		if($data)
		foreach($data as $key=>$val){
			$op .=	'[ '.
						'"'.$val->id.'", '.
						'"'.$val->name.'", '.
						
						'"'.$val->model_by.'", '.
						'"'.ucfirst($val->ethnicity).'", '.

						'"'.$val->position.'", ';

					if($val->position == 1 ){
						$op .=	'"<span class=\"disabled_positioning\">------</span>", ';

					}else{
						$op .=	'"<a class=\"up\" href=\"'.site_url('admin/featured/up/'.$val->id).'\" title=\"Shift the ad one step up\" >Up</a>", ';
					}

					if($val->position == count($data)){

						$op .= 	'"<span class=\"disabled_positioning\">------</span>", ';
					}else{

						$op .= 	'"<a class=\"down\" href=\"'.site_url('admin/featured/down/'.$val->id).'\" title=\"Shift the ad one step down\" >Dn</a>", ';
					}


				$op .=	'"<a class=\"edit\" href=\"'.site_url('admin/featured/edit/'.$val->id).'\">Edit</a>", '.
						'"<a class=\"delete\" href=\"'.site_url('admin/featured/del/'.$val->id).'\">Delete</a>", '.
						'"<a class=\"browse\" href=\"'.site_url('admin/featured/browse/'.$val->link).'\">Browse</a>", '.
					'],';
		}

		$op .=  '],"aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Name" },

			            { "sTitle": "Model By"},
			            { "sTitle": "Ethnicity"},

			            { "sTitle": "Position"},
			            { "sTitle": "Move Up" , sWidth:"5%"},
			            { "sTitle": "Move Down" , sWidth:"5%"},

			            { "sTitle": "Actions", sWidth:"5%"},
			            { "sTitle": "" , sWidth:"5%"},
			            { "sTitle": "" , sWidth:"5%"},
			        ],
				    "aaSorting":[[7,\'asc\']],
					"bStateSave": true,
			    } );   
			} );
			</script>';
		$op .= 	'<div class="grid_16"><table id="list_data"></table></div>';
		return $op;
	}
	

	/**
	 * new featured form
	 */
	public function render_new_featured($data){

		$this->ci->load->config('ethnicity');
		$this->ethnicity = $this->ci->config->item('ethnicity');

		$this->ci->template->add_css(ADMINJSPATH.'jquery-ui.css');
		$this->ci->template->add_js(ADMINJSPATH.'jquery-ui.js');

		$op = '';
		$op .= 	'<script type="text/javascript">
					$(function() {
						$( "#date_created" ).datepicker({
														dateFormat: "yy-mm-dd",
														showAnim:	"fadeIn"
													});
					});
				</script>';


		$op .= 	'<style>
					#content .fx{
						border: 1px solid #DDDDDD;
						font-family: inherit;
						font-size: inherit;
						padding: 1.5px 4px;
						width: 330px;
						position:absolute;
					}
					#ui-datepicker-div {
						font-family: "Trebuchet MS", "Helvetica", "Arial", "Verdana", "sans-serif";
						font-size: inherit;
					}
					.reset_ml{
						margin-left:0;
					}
		</style>';

		/* for [multiple ??] file uploads ..........  
		$op .=
		'
			<link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-responsive.min.css">

			<div class="container">

			    <!-- The file upload form used as target for the file upload widget -->
			    <form id="fileupload" action="<?=base_url()?>index.php/home/upload" method="POST" enctype="multipart/form-data">
			        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
			        <div class="row fileupload-buttonbar">
			            <div class="span7">
			                <!-- The fileinput-button span is used to style the file input field as button -->
			                <span class="btn btn-success fileinput-button">
			                    <i class="icon-plus icon-white"></i>
			                    <span>Add files...</span>
			                    <input type="file" name="files[]" multiple>
			                </span>
			                <button type="submit" class="btn btn-primary start">
			                    <i class="icon-upload icon-white"></i>
			                    <span>Start upload</span>
			                </button>
			                <button type="reset" class="btn btn-warning cancel">
			                    <i class="icon-ban-circle icon-white"></i>
			                    <span>Cancel upload</span>
			                </button>
			                <button type="button" class="btn btn-danger delete">
			                    <i class="icon-trash icon-white"></i>
			                    <span>Delete</span>
			                </button>
			                <input type="checkbox" class="toggle">
			            </div>
			            <!-- The global progress information -->
			            <div class="span5 fileupload-progress fade">
			                <!-- The global progress bar -->
			                <div class="progress progress-success progress-striped active">
			                    <div class="bar" style="width:0%;"></div>
			                </div>
			                <!-- The extended global progress information -->
			                <div class="progress-extended">&nbsp;</div>
			            </div>
			        </div>
			        <!-- The loading indicator is shown during file processing -->
			        <div class="fileupload-loading"></div>
			        <br>
			        <!-- The table listing the files available for upload/download -->
			        <table class="table table-striped">
						<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
					</table>
			    </form>
			    <br>
			    
			</div>
		';
		*/
		$op .=	//'<div class="container_16 clearfix" id="content">'.
					form_open().'
					<div class="grid_16">
						<div class="grid_2" style="float: right;">
							<p>
								<a href="'.base_url('admin/featured').'">Back</a>
							</p>
						</div>
						
						<h2>Featured Model</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="name">Name <small>Name is not editable once saved.</small></label>';
					if($data){
						//uneditable form input
						$op .=		'<span class="fx">'.$data[0]->name.'</span>';
					}else{
						//empty form input
						$op .=		'<input type="text" name="name" value=""/>';
					}
					$op .= 	'</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="date_created">Date Created</label>
							<input id="date_created" type="text" name="date_created" value="'.($data?$data[0]->date_created:'').'" />
						</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="gender">Gender</label>
							<select name="gender" class="grid_5 reset_ml" style="margin-bottom:20px">
								<option value="1" '.($data?($data[0]->gender=='1'?'selected="selected"':''):'').' >Male</option>
								<option value="0" '.($data?($data[0]->gender=='0'?'selected="selected"':''):'').'>Female</option>
								
							</select>
						</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="ethnicity">Ethnicity </label>
							<select class="grid_5 reset_ml" name="ethnicity" style="margin-bottom:20px;">';

				foreach($this->ethnicity as $val){
					$op .= '<option value="'.$val.'" '.
								($data?($data[0]->ethnicity==$val?'selected="selected"':''):'').'>'.
								ucfirst($val)
							.'</option>';								
				}

				$op .=		'</select>
						</p>
					</div>
					<div class="grid_14">
						<p class="grid_6 reset_ml">
							<label for="wardrobe">Wardrobe<small>Alpha-numeric characters without spaces.</small></label>
							<input class="grid_5 reset_ml" type="text" name="wardrobe" value="'.($data?$data[0]->wardrobe:'').'">
						</p>
						<p class="grid_7">
							<label for="wardrobe_link">Wardrobe Link<small>URL of the Wardrobe.</small></label>
							<input class="grid_6 reset_ml" type="text" name="wardrobe_link" value="'.($data?urldecode($data[0]->wardrobe_link):'').'">
						</p>
					</div>
					<div class="grid_14">
						<p class="grid_6 reset_ml">
							<label for="location">Location<small>Alpha-numeric characters without spaces.</small></label>
							<input class="grid_5 reset_ml" type="text" name="location" value="'.($data?$data[0]->location:'').'">
						</p>
						<p class="grid_7">
							<label for="location_link">Location Link<small>URL of the Location.</small></label>
							<input class="grid_6 reset_ml" type="text" name="location_link" value="'.($data?urldecode($data[0]->location_link):'').'" >
						</p>
					</div>
					<div class="grid_14">
						<p class="grid_6 reset_ml">
							<label for="make_up">Make Up<small>Alpha-numeric characters without spaces.</small></label>
							<input class="grid_5 reset_ml" type="text" name="make_up" value="'.($data?$data[0]->make_up:'').'">
						</p>
						<p class="grid_7">
							<label for="make_up_link">Make Up Link<small>URL of the Make-Up.</small></label>
							<input class="grid_6 reset_ml" type="text" name="make_up_link" value="'.($data?urldecode($data[0]->make_up_link):'').'" >
						</p>
					</div>
					<div class="grid_14">
						<p class="grid_6 reset_ml">
							<label for="model_by">Model By<small>Alpha-numeric characters without spaces.</small></label>
							<input class="grid_5 reset_ml" type="text" name="model_by" value="'.($data?$data[0]->model_by:'').'">
						</p>
						<p class="grid_7">
							<label for="model_by_link">Model By Link<small>URL of the Model By.</small></label>
							<input class="grid_6 reset_ml" type="text" name="model_by_link" value="'.($data?urldecode($data[0]->model_by_link):'').'" >
						</p>
					</div>
					<div class="grid_14">
						<p class="grid_6 reset_ml">
							<label for="photographer">Photographer<small>Alpha-numeric characters without spaces.</small></label>
							<input class="grid_5 reset_ml" type="text" value="'.($data?$data[0]->photographer:'').'" name="photographer">
						</p>
						<p class="grid_7">
							<label for="photographer_link">Photographer Link<small>URL of the Photographer.</small></label>
							<input class="grid_6 reset_ml" type="text" value="'.($data?urldecode($data[0]->photographer_link):'').'" name="photographer_link" >
						</p>
					</div>
					<div class="grid_16">
						<p class="submit">
							<a href="javascript:history.back()">Cancel</a>
							<input type="submit" value="Submit">
						</p>
					</div>	

					<div class="grid_16">
						<small>
							Add Profile Image as :
						</small>
						<small>
							<ul style="list-style:none;">
								<li><code>&lt;site&gt;\public\model_name\profile_img.jpg</code></li>
							</ul>
						</small>
						<small>
							To create a gallery, create a folder within <code>public\</code> 
							and upload the images there using any ftp client. 
						</small>
						<br>
						<small>eg.</small>  	
						<small>
							<ul style="list-style:none;">
								<li><code>&lt;site&gt;\public\model_name\01</code></li>
								<li><code>&lt;site&gt;\public\model_name\02</code></li>
								<li><code>&lt;site&gt;\public\another_model\01</code></li>
								<li><code>&lt;site&gt;\public\another_model\02</code></li>
							</ul>
						</small>
					</div>		

					</form>';
				//</div>';


		return  $op;
	}


	/*
		// 	/**
		// 	 * gossips list
		// 	 *
		// 	public function render_gossipslist($data){
		// //print_r($data);die;		
		// 		$op =	'<div class="grid_2" style="float:right;">
		// 					<p>
		// 						<a href="'.site_url('admin/gossips/new_gossip').'">New</a>
		// 					</p>
		// 				</div>'.
		// 				'<script type="text/javascript">
		// 				$(function() {
		// 				    $(\'#list_data\').dataTable( {
		// 				        "aaData": [';

		// 		if($data)
		// 		foreach($data as $key=>$val){
		// 			$op .=	'["'.$val->id.'", "'.$val->title.'", "'.$val->summary.'", "<a class=\"edit\" href=\"'.site_url('admin/gossips/edit/'.$val->id).'\">Edit</a>", "<a class=\"delete\" href=\"'.site_url('admin/gossips/del/'.$val->id).'\">Delete</a>"], ';
		// 		}

		// 		$op .=  '],"aoColumns": [
		// 			            { "sTitle": "ID" },
		// 			            { "sTitle": "Title" },
		// 			            { "sTitle": "Summary" },
		// 			            { "sTitle": "Actions", sWidth:"5%"},
		// 			            { "sTitle": "" , sWidth:"5%"},
		// 			        ]
		// 			    } );   
		// 			} );
		// 			</script>';
		// 		$op .= 	'<div class="grid_16"><table id="list_data"></table></div>';
		// 		return $op;
		// 	}
			
			
		// 	/**
		// 	 * new gossip form
		// 	 *
		// 	public function render_new_gossips($data){
		// //echo '<pre>';
		// //print_r($data);
		// //echo '</pre>';
		// //die;

		// 		$op =	//'<div class="container_16 clearfix" id="content">'.
		// 					form_open_multipart().'
		// 					<div class="grid_16">
		// 						<div class="grid_2" style="float: right;">
		// 							<p>
		// 								<a href="'.base_url('admin/gossips').'">Back</a>
		// 							</p>
		// 						</div>

		// 						<h2>Gossip</h2>
		// 						<p class="error">Something went wrong.</p>
		// 					</div>

		// 					<div class="grid_5">
		// 						<p>
		// 							<label for="title">Title <small>Alpha-numeric characters without spaces.</small></label>
		// 							<input type="text" name="title" value="'.($data?$data[0]->title:'').'" />
		// 						</p>
		// 					</div>

		// 					<div class="grid_16">
		// 						<p>
		// 							<label>Summary <small>Will be displayed in search engine results.</small></label>
		// 							<textarea class="area_small" name="summary">'.
		// 								($data?$data[0]->summary:'').
		// 							'</textarea>
		// 						</p>
		// 					</div>

		// 					<div class="grid_16">
		// 						<p>
		// 							<label>Article <small>Markdown Syntax.</small></label>
		// 							<textarea class="area_medium" name="content">'.
		// 								($data?$data[0]->content:'').
		// 							'</textarea>
		// 						</p>
		// 						<p class="submit">
		// 							<a href="'.site_url('admin/gossips').'">Cancel</a>
		// 							<input type="submit" value="Submit">
		// 						</p>
		// 					</div>	

		// 					</form>';
		// 				//</div>';//.$generated_editor;


		// 		return  $op;
		// 	}
	*/

	/**
	 * events list
	 */
	public function render_eventslist($data){

		$this->ci->load->helper('text');

		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/events/new_event').'">New</a>
					</p>
				</div>
				<h2>Events List</h2>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';

		if($data)
		foreach($data as $key=>$val){
			$op .=	'['.
						'"'.$val->id.'", '.
						'"'.$val->title.'", '.
						'"'.word_limiter($val->summary,10).'", '.
						'"'.$val->type.'", '.
						'"'.($val->upcomming=='1'?'Yes':'No').'", '.
						'"'.$val->location.'", '.

						'"'.$val->position.'", ';

			if($val->position == 1 ){
				$op .=	'"<span class=\"disabled_positioning\">------</span>", ';

			}else{
				$op .=	'"<a class=\"up\" href=\"'.site_url('admin/events/up/'.$val->id).'\" title=\"Shift the ad one step up\" >Up</a>", ';
			}

			if($val->position == count($data)){

				$op .= 	'"<span class=\"disabled_positioning\">------</span>", ';
			}else{

				$op .= 	'"<a class=\"down\" href=\"'.site_url('admin/events/down/'.$val->id).'\" title=\"Shift the ad one step down\" >Dn</a>", ';
			}

			$op .= 		'"<a class=\"edit\" href=\"'.site_url('admin/events/edit/'.$val->id).'\">Edit</a>", '.
						'"<a class=\"delete\" href=\"'.site_url('admin/events/del/'.$val->id).'\">Delete</a>"], ';
		}

		$op .=  '],"aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Title" },
			            { "sTitle": "Summary" },
			            { "sTitle": "Type" },
			            { "sTitle": "Upcomming" },
			            { "sTitle": "Location" },

			            { "sTitle": "Position"},
			            { "sTitle": "Move Up" , sWidth:"5%"},
			            { "sTitle": "Move Down" , sWidth:"5%"},
			            { "sTitle": "Actions", sWidth:"5%"},
			            { "sTitle": "" , sWidth:"5%"},
			        ],
			    "aaSorting":[[6,\'asc\']],
				"bStateSave": true,
			    } );   
			} );
			</script>';
		$op .= 	'<div class="grid_16"><table id="list_data"></table></div>';
		return $op;
	}
	
	
	/**
	 * new events form
	 */
	public function render_new_events($data){

		$this->ci->template->add_css(ADMINJSPATH.'jquery-ui.css');
		$this->ci->template->add_js(ADMINJSPATH.'jquery-ui.js');

		$op = 	'<style>
					#content .fx{
						border: 1px solid #DDDDDD;
						font-family: inherit;
						font-size: inherit;
						padding: 1.5px 4px;
						width: 330px;
						position:absolute;
					}
					#ui-datepicker-div {
						font-family: "Trebuchet MS", "Helvetica", "Arial", "Verdana", "sans-serif";
						font-size: inherit;
					}
				</style>';
		$op .= 	'<script type="text/javascript">
					$(function() {
						$( "#date_created" ).datepicker({
														dateFormat: "yy-mm-dd",
														showAnim:	"fadeIn"
													});
					});
				</script>';

		$op .= '<script type="text/javascript">$(function(){
					$(".fx").parent().css("margin-bottom","45px");

					function change_event_type($param){
						if($param==1){
							$(".upcomming").fadeIn();
						}else{
							$(".upcomming").fadeOut();
						}
					}
					$("input[name=upcomming]").click(function(){
						change_event_type($(this).val());
					})
					$(".upcomming").hide();
					'.($data?(($data[0]->upcomming=='1')?'$(".upcomming").show();':''):'').'


				})</script>';

		$op .=	//'<div class="container_16 clearfix" id="content">'.
					form_open().'
					<div class="grid_16">
						<div class="grid_2" style="float: right;">
							<p>
								<a href="'.base_url('admin/events').'">Back</a>
							</p>
						</div>
						<h2>New Events</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="title">Title <small>Title is not editable once saved.</small></label>';
					if($data){
						//uneditable form input
						$op .=		'<span class="fx">'.$data[0]->title.'</span>';
					}else{
						//empty form input
						$op .=		'<input type="text" name="title" value=""/>';
					}
					$op .= 	'</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="type">Type</label>
							<select name="type">';

				$this->ci->load->config('eventstype');
				$eventstype = $this->ci->config->item('eventstype');

				foreach($eventstype as $key=>$val){
					$op .= '<option value="'.$key.'" '.
								($data?($data[0]->type==$key?'selected="selected"':''):'').'>'.$val
							.'</option>';					
				}

				$op .=		'</select>
						</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="date_created">Date Created</label>
							<input id="date_created" type="text" name="date_created" value="'.($data?$data[0]->date_created:'').'" />
						</p>
					</div>
					
					<div class="grid_6">
						<p>
							<label for="location">Location</label>
							<input type="text" name="location" value="'.($data?$data[0]->location:'').'" />
						</p>
					</div>


					<div class="grid_12">
						<p>
							<label>Event Category</label>
							<span>
							     <input class="radio" type="radio" value="1" name="upcomming" '.
							     									($data?($data[0]->upcomming==1?'checked="checked"':''):'').' />
							     <span>Upcomming Event</span>
							</span>							
							<span class="grid_4">
							     <input class="radio" type="radio" value="0" name="upcomming" '.
							     									($data?($data[0]->upcomming==0?'checked="checked"':''):'').' />
							     <span>Past Event</span>
							</span>
							<!--
							<span class="grid_4" style="float:right;">
							     <input type="checkbox" name="featured" value="1" '.
							     									($data?($data[0]->featured==1?'checked="checked"':''):'').' />
							     <span>Featured Event</span>
							</span>
							-->
						</p>
					</div>


					<div class="grid_6 upcomming">
						<p>
							<label for="time">Time</label>
							<input type="text" value="'.($data?$data[0]->time:'').'" name="time">
						</p>
					</div>

					<div class="grid_16"></div>

					<div class="grid_12">
						<p>
							<label>Event Summary <small>Will be displayed in search engine results.</small></label>
							<textarea class="area_small" name="summary">'.
								($data?$data[0]->summary:'').
							'</textarea>
						</p>
					</div>

					<div class="grid_12 upcomming">
						<p>
							<label>Event Details <small>Will be displayed in search engine results.</small></label>
							<textarea name="details" class="area_medium">'.
								($data?$data[0]->details:'').
							'</textarea>
						</p>
					</div>

					<div class="grid_12">

						<p class="submit">
							<a href="javascript:history.back()">Cancel</a>
							<input type="submit" value="Submit">
						</p>
					</div>

					<div class="grid_16">
						<small>
							To create a Events Gallery, create a folder within <code>public\</code> 
							and upload the images there using any ftp client. 
						</small>
						<br>
						<small>eg.</small>  	
						<small>
							<ul style="list-style:none;">
								<li><code>&lt;site&gt;\public\event_name\</code></li>
								<li><code>&lt;site&gt;\public\another_event_name\</code></li>
							</ul>
						</small>
					</div>		
					</form>';
				//</div>';


		return  $op;
	}


	/**
	 * flinks list
	 */
	public function render_flinkslist($data){
		$this->ci->load->helper('text');

		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/flinks/new_flink').'">New</a>
					</p>
				</div>
				<h2>Featured Links List</h2>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';

		if($data)
		foreach($data as $key=>$val){
			$op .=	'['.
						'"'.$val->id.'", '.
						'"'.$val->title.'", '.
						'"'.word_limiter($val->summary,10).'", '.
						'"'.$val->link.'", '.
						'"'.$val->enabled.'", '.
						'"'.$val->position.'", ';

			if($val->position == 1 ){
				$op .=	'"<span class=\"disabled_positioning\">------</span>", ';

			}else{
				$op .=	'"<a class=\"up\" href=\"'.site_url('admin/flinks/up/'.$val->id).'\" title=\"Shift the ad one step up\" >Up</a>", ';
			}

			if($val->position == count($data)){

				$op .= 	'"<span class=\"disabled_positioning\">------</span>", ';
			}else{

				$op .= 	'"<a class=\"down\" href=\"'.site_url('admin/flinks/down/'.$val->id).'\" title=\"Shift the ad one step down\" >Dn</a>", ';
			}

			$op .= 		'"<a class=\"edit\" href=\"'.site_url('admin/flinks/edit/'.$val->id).'\" title=\"Edit element ID '.$val->id.'\" >Edit</a>", '.
						'"<a class=\"delete\" href=\"'.site_url('admin/flinks/del/'.$val->id).'\" title=\"Delete element ID '.$val->id.'\" >Delete</a>" ], ';
		}

		$op .=  '],
				"aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Title" },
			            { "sTitle": "Summary" },
			            { "sTitle": "Link" },
			            { "sTitle": "Enabled"},
			            { "sTitle": "Position"},
			            { "sTitle": "Move Up" , sWidth:"5%"},
			            { "sTitle": "Move Down" , sWidth:"5%"},
			            { "sTitle": "Actions", sWidth:"5%"},
			            { "sTitle": "" , sWidth:"5%"},
		        ],
			    "aaSorting":[[5,\'asc\']],
				"bStateSave": true,
			    } );   
			} );
			</script>';
		$op .= 	'<div class="grid_16"><table id="list_data"></table></div>';
		return $op;
	}
	
	
	/**
	 * new flinks form
	 */
	public function render_new_flinks($data){
		$op = '<style>
				#content .fx {
				    border: 1px solid #DDDDDD;
				    font-family: inherit;
				    font-size: inherit;
				    padding: 1.5px 4px;
				    position: absolute;
				    width: 330px;
				}</style>';

		$op .= '<script type="text/javascript">
				$(function(){
					
					var type;
					$("select[name=type]").change(function(){
						type = $(this).val();

						$(".is_"+type).slideDown();
						$(".not_"+type).slideUp();
					});

					$("select[name=type]").trigger("change");

					$("#content").find("form").submit(function(){
						$(".not_"+type).remove();
					});';

		if(is_object($data[0])){
			$op .=	'var $img;
					//remove old img & add input for new image
					$(".change_img").live("click",function(e){
						e.preventDefault();
						
						var str = "<input class=\"new_img\" type=\"file\" name=\"image\">";
						str = str + "<a class=\"cancel_change_img\" href=\"#\">cancel</a>";

						$(this).after(str);
						$img = $(".old_img").detach()+$(this).detach();

						$(".new_img").trigger("click");
					});						

					//restore the earlier image 
					$(".cancel_change_img").live("click",function(e){
						e.preventDefault();
						
 						var str = "<img class=\"old_img\" src=\"'.base_url().FLINKSPATH.$data[0]->image.'\" />";
						str = str + "<a href=\"#\" class=\"change_img\">Change</a>";

						$(this)
							.after(str)
						$(".new_img").remove();
						$(this).remove();
					});';
		}
		$op .= 	'})
			  </script> ';

		$op .=	//'<div class="container_16 clearfix" id="content">'.
					form_open_multipart().'
					<div class="grid_16">
						<div class="grid_2" style="float: right;">
							<p>
								<a href="'.base_url('admin/flinks').'">Back</a>
							</p>
						</div>

						<h2>New Featured Link</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="title">Title <small>Title is not editable once saved.</small></label>';
					if($data){
						//uneditable form input
						$op .=		'<span class="fx">'.$data[0]->title.'</span>';
					}else{
						//empty form input
						$op .=		'<input type="text" name="title" value=""/>';
					}
					$op .= 	'</p>
					</div>


					<div class="grid_6">
						<p class="img">
							<label for="image">Image<small>The required Advertizement image..</small></label>';
			
				if($data && $data[0]->image){
					$op .=	'<img class="old_img" src="'.base_url().FLINKSPATH.$data[0]->image.'" />';
							 //<a href="#" class="change_img">Change</a>';
				}else{
					$op .= '<input class="new_img" type="file" name="image">';
							//'<a href="#" class="cancel_change_img">Cancel</a>';
				}		
			
			$op .= 		'</p>
					</div>

					<div class="grid_12">
						<p>
							<label for="link">Link<small>Must contain alpha-numeric characters.</small></label>
							<input type="text" name="link" value="'.($data?$data[0]->link:'').'">
						</p>
					</div>

					<div class="grid_12">
						<p>
							<label>Link Status</label>
							<span>
							     <input class="radio" type="radio" value="1" name="enabled" '.
							     									($data?($data[0]->enabled==1?'checked="checked"':''):'').' />
							     <span>Enable Link</span>
							</span>							
							<span class="grid_4">
							     <input class="radio" type="radio" value="0" name="enabled" '.
							     									($data?($data[0]->enabled==0?'checked="checked"':''):'').' />
							     <span>Disable Link</span>
							</span>
						</p>
					</div>

					<div class="grid_12">
						<p>
							<label>Featured Link Summary <small>Will be displayed in search engine results.</small></label>
							<textarea class="area_small" name="summary">'.
								($data?$data[0]->summary:'').
							'</textarea>
						</p>
					</div>

					<div class="grid_12">
						<p class="submit">
							<a href="javascript:history.back()">Cancel</a>
							<input type="submit" value="Submit">
						</p>
					</div>		
					</form>';
				//</div>';

		return  $op;
	}



	/**
	 * contests list
	 */
	public function render_contestslist($data){
		$this->ci->load->helper('text');

		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/contests/new_contest').'">New</a>
					</p>
				</div>
				<h2>Contests List</h2>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';

		if($data)
		foreach($data as $key=>$val){
			$op .=	'['.
						'"'.$val->id.'", '.
						'"'.$val->title.'", '.
						'"'.word_limiter($val->summary,10).'", '.
						'"'.$val->type.'", '.
						'"'.($val->upcomming=='1'?'Yes':'No').'", '.
						'"'.$val->location.'", '.

						'"'.$val->position.'", ';

			if($val->position == 1 ){
				$op .=	'"<span class=\"disabled_positioning\">------</span>", ';

			}else{
				$op .=	'"<a class=\"up\" href=\"'.site_url('admin/contests/up/'.$val->id).'\" title=\"Shift the contest one step up\" >Up</a>", ';
			}

			if($val->position == count($data)){

				$op .= 	'"<span class=\"disabled_positioning\">------</span>", ';
			}else{

				$op .= 	'"<a class=\"down\" href=\"'.site_url('admin/contests/down/'.$val->id).'\" title=\"Shift the contest one step down\" >Dn</a>", ';
			}

			$op .= 		'"<a class=\"edit\" href=\"'.site_url('admin/contests/edit/'.$val->id).'\">Edit</a>", '.
						'"<a class=\"delete\" href=\"'.site_url('admin/contests/del/'.$val->id).'\">Delete</a>"], ';
		}

		$op .=  '],"aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Title" },
			            { "sTitle": "Summary" },
			            { "sTitle": "Type" },
			            { "sTitle": "Upcomming" },
			            { "sTitle": "Location" },

			            { "sTitle": "Position"},
			            { "sTitle": "Move Up" , sWidth:"5%"},
			            { "sTitle": "Move Down" , sWidth:"5%"},
			            { "sTitle": "Actions", sWidth:"5%"},
			            { "sTitle": "" , sWidth:"5%"},
			        ],
			    "aaSorting":[[6,\'asc\']],
				"bStateSave": true,
			    } );   
			} );
			</script>';
		$op .= 	'<div class="grid_16"><table id="list_data"></table></div>';
		return $op;
	}
	
	
	/**
	 * new contest form
	 */
	public function render_new_contests($data){

		$this->ci->template->add_css(ADMINJSPATH.'jquery-ui.css');
		$this->ci->template->add_js(ADMINJSPATH.'jquery-ui.js');

		$op = 	'<style>
					#content .fx{
						border: 1px solid #DDDDDD;
						font-family: inherit;
						font-size: inherit;
						padding: 1.5px 4px;
						width: 330px;
						position:absolute;
					}
					#ui-datepicker-div {
						font-family: "Trebuchet MS", "Helvetica", "Arial", "Verdana", "sans-serif";
						font-size: inherit;
					}
				</style>';
		$op .= 	'<script type="text/javascript">
					$(function() {
						$( "#date_created" ).datepicker({
														dateFormat: "yy-mm-dd",
														showAnim:	"fadeIn"
													});
					});
				</script>';

		$op .= '<script type="text/javascript">$(function(){
					$(".fx").parent().css("margin-bottom","45px");

					function change_event_type($param){
						if($param==1){
							$(".upcomming").fadeIn();
						}else{
							$(".upcomming").fadeOut();
						}
					}
					$("input[name=upcomming]").click(function(){
						change_event_type($(this).val());
					})
					$(".upcomming").hide();
					'.($data?(($data[0]->upcomming=='1')?'$(".upcomming").show();':''):'').'


				})</script>';

		$op .=	//'<div class="container_16 clearfix" id="content">'.
					form_open().'
					<div class="grid_16">
						<div class="grid_2" style="float: right;">
							<p>
								<a href="'.base_url('admin/contests').'">Back</a>
							</p>
						</div>
						<h2>New Contest</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="title">Title <small>Ttile is not editable once saved.</small></label>';
					if($data){
						//uneditable form input
						$op .=		'<span class="fx">'.$data[0]->title.'</span>';
					}else{
						//empty form input
						$op .=		'<input type="text" name="title" value=""/>';
					}
					$op .= 	'</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="type">Type</label>
							<select name="type">';

				$this->ci->load->config('eventstype');
				$eventstype = $this->ci->config->item('eventstype');

				foreach($eventstype as $key=>$val){
					$op .= '<option value="'.$key.'" '.
								($data?($data[0]->type==$key?'selected="selected"':''):'').'>'.$val
							.'</option>';					
				}

				$op .=		'</select>
						</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="date_created">Date Created</label>
							<input id="date_created" type="text" name="date_created" value="'.($data?$data[0]->date_created:'').'" />
						</p>
					</div>
					
					<div class="grid_6">
						<p>
							<label for="location">Location</label>
							<input type="text" name="location" value="'.($data?$data[0]->location:'').'" />
						</p>
					</div>


					<div class="grid_12">
						<p>
							<label>Contest Category</label>
							<span>
							     <input class="radio" type="radio" value="1" name="upcomming" '.
							     									($data?($data[0]->upcomming==1?'checked="checked"':''):'').' />
							     <span>Upcomming Contest</span>
							</span>							
							<span class="grid_4">
							     <input class="radio" type="radio" value="0" name="upcomming" '.
							     									($data?($data[0]->upcomming==0?'checked="checked"':''):'').' />
							     <span>Past Contests</span>
							</span>
							<!--
							<span class="grid_4" style="float:right;">
							     <input type="checkbox" name="featured" value="1" '.
							     									($data?($data[0]->featured==1?'checked="checked"':''):'').' />
							     <span>Featured Event</span>
							</span>
							-->
						</p>
					</div>


					<div class="grid_6 upcomming">
						<p>
							<label for="time">Time</label>
							<input type="text" value="'.($data?$data[0]->time:'').'" name="time">
						</p>
					</div>

					<div class="grid_16"></div>

					<div class="grid_12">
						<p>
							<label>Contest Summary <small>Will be displayed in search engine results.</small></label>
							<textarea class="area_small" name="summary">'.
								($data?$data[0]->summary:'').
							'</textarea>
						</p>
					</div>

					<div class="grid_12 upcomming">
						<p>
							<label>Contest Details <small>Will be displayed in search engine results.</small></label>
							<textarea name="details" class="area_medium">'.
								($data?$data[0]->details:'').
							'</textarea>
						</p>
					</div>

					<div class="grid_12">

						<p class="submit">
							<a href="javascript:history.back()">Cancel</a>
							<input type="submit" value="Submit">
						</p>
					</div>

					<div class="grid_16">
						<small>
							To create a Events Gallery, create a folder within <code>public\</code> 
							and upload the images there using any ftp client. 
						</small>
						<br>
						<small>eg.</small>  	
						<small>
							<ul style="list-style:none;">
								<li><code>&lt;site&gt;\public\event_name\</code></li>
								<li><code>&lt;site&gt;\public\another_event_name\</code></li>
							</ul>
						</small>
					</div>		
					</form>';
				//</div>';


		return  $op;
	}



	/**
	 * news list
	 */
	public function render_newslist($data){
		$this->ci->load->helper('text');

		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/news/new_news').'">New</a>
					</p>
				</div>
				<h2>News List</h2>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';
		if($data)
		foreach($data as $key=>$val){
			$op .=	'[ '.
						'"'.$val->id.'", '.
						'"'.$val->type.'", '.
						'"'.$val->title.'", '.
						'"'.word_limiter($val->summary,10).'", '.
						'"'.$val->position.'", ';

			if($val->position == 1 ){
				$op .=	'"<span class=\"disabled_positioning\">------</span>", ';

			}else{
				$op .=	'"<a class=\"up\" href=\"'.site_url('admin/news/up/'.$val->id).'\" title=\"Shift the news one step up\" >Up</a>", ';
			}

			if($val->position == count($data)){

				$op .= 	'"<span class=\"disabled_positioning\">------</span>", ';
			}else{

				$op .= 	'"<a class=\"down\" href=\"'.site_url('admin/news/down/'.$val->id).'\" title=\"Shift the news one step down\" >Dn</a>", ';
			}
				$op .=	'"<a class=\"edit\" href=\"'.site_url('admin/news/edit/'.$val->id).'\">Edit</a>", '.
						'"<a class=\"delete\" href=\"'.site_url('admin/news/del/'.$val->id).'\">Delete</a>", '.
					'], ';
		}

		$op .=  '], "aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Type" },
			            { "sTitle": "Title" },
			            { "sTitle": "Summary" },

			            { "sTitle": "Position"},
			            { "sTitle": "Move Up" , sWidth:"5%"},
			            { "sTitle": "Move Down" , sWidth:"5%"},
			            { "sTitle": "Actions", sWidth:"5%"},
			            { "sTitle": "" , sWidth:"5%"},
			        ],
			    "aaSorting":[[4,\'asc\']],
				"bStateSave": true,
			    } );   
			} );
			</script>';
		$op .= 	'<div class="grid_16"><table id="list_data"></table></div>';
		return $op;
	}
	
	
	/**
	 * new news form
	 */
	public function render_new_news($data){

		$this->ci->load->config('news_type');
		$this->ci->template->add_css(ADMINJSPATH.'jquery-ui.css');
		$this->ci->template->add_js(ADMINJSPATH.'jquery-ui.js');

		$news_types = $this->ci->config->item('news_type');

		$op = '<style>
				#content .fx {
				    border: 1px solid #DDDDDD;
				    font-family: inherit;
				    font-size: inherit;
				    padding: 1.5px 4px;
				    position: absolute;
				    width: 330px;
				}
				#ui-datepicker-div {
					font-family: "Trebuchet MS", "Helvetica", "Arial", "Verdana", "sans-serif";
					font-size: inherit;
				}
				</style>';

		$op .= 	'<script type="text/javascript">
					$(function() {
						$( "#date_created" ).datepicker({
														dateFormat: "yy-mm-dd",
														showAnim:	"fadeIn"
													});
					});
				</script>';
		$op .= '<script type="text/javascript">
				$(function(){ ';
					

		if(is_object($data[0])){
			$op .=	'var $img;
					//remove old img & add input for new image
					$(".change_img").live("click",function(e){
						e.preventDefault();
						
						var str = "<input class=\"new_img\" type=\"file\" name=\"image\">";
						str = str + "<a class=\"cancel_change_img\" href=\"#\">cancel</a>";

						$(this).after(str);
						$img = $(".old_img").detach()+$(this).detach();

						$(".new_img").trigger("click");
					});						

					//restore the earlier image 
					$(".cancel_change_img").live("click",function(e){
						e.preventDefault();
						
 						var str = "<img class=\"old_img\" src=\"'.base_url().NEWSSPATH.$data[0]->image.'\" />";
						str = str + "<a href=\"#\" class=\"change_img\">Change</a>";

						$(this)
							.after(str)
						$(".new_img").remove();
						$(this).remove();
					});';
		}
		$op .= 	'})
			  </script> ';


		$op .=	//'<div class="container_16 clearfix" id="content">'.
					form_open_multipart().'
					<div class="grid_16">
						<div class="grid_2" style="float: right;">
							<p>
								<a href="'.base_url('admin/news').'">Back</a>
							</p>
						</div>
						<h2>New News</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="title">Title <small>Alpha-numeric characters without spaces.</small></label>';
					if($data){
						//uneditable form input
						$op .=		'<span class="fx">'.$data[0]->title.'</span>';
					}else{
						//empty form input
						$op .=		'<input type="text" name="title" value=""/>';
					}
					$op .= 	'</p>
						</p>
					</div>


					<div class="grid_6">
						<p>
							<label for="type">Type</label>
							<select name="type">';

					foreach($news_types as $key=>$val){
						$op .= 	'<option value="'.$key.'" '.
									($data?($data[0]->type==$key?'selected="selected"':''):'').'>'.$val.
								'</option>';
					}							

					$op .= 	'</select>

						</p>
					</div>


					<div class="grid_6 not_script is_image">
						<p class="img">
							<label for="image">Image<small>610x400</small></label>';
			
				if($data && $data[0]->image){
					$op .=	'<img class="old_img" src="'.$data[0]->image.'" />
							 <a href="#" class="change_img">Change</a>';
				}else{
					$op .= '<input class="new_img" type="file" name="image">';
							//'<a href="#" class="cancel_change_img">Cancel</a>';
				}		
			
			$op .= 		'</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="date_created">Date Created</label>
							<input id="date_created" type="text" name="date_created" value="'.($data?$data[0]->date_created:'').'" />
						</p>
					</div>

					<div class="grid_12">
						<p>
							<label>Summary <small>Will be displayed in search engine results.</small></label>
							<textarea class="area_small" name="summary">'.
								($data?$data[0]->summary:'').
							'</textarea>
						</p>
					</div>

					<div class="grid_12">
						<p>
							<label>News <small>Markdown Syntax.</small></label>
							<textarea class="area_medium" name="content">'.
								($data?$data[0]->content:'').
							'</textarea>
						</p>
						<p class="submit">
							<a href="javascript:history.back()">Cancel</a>
							<input type="submit" value="Submit">
						</p>
					</div>	
					</form>';
				//</div>';


		return  $op;
	}



	/**
	 * subjects list
	 */
	public function render_subjectslist($data){

		$this->ci->load->config('ethnicity');
		$this->ethnicity = $this->ci->config->item('ethnicity');

		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/models/new_subject').'">New</a>
					</p>
				</div>
				<h2>Agency Models List</h2>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';
				if($data)
				foreach($data as $key=>$val){
			        $op .= '['.
			        			'"'.$val->id.'", '.
			        			'"'.$val->name.'", '.
			        			'"'.($val->gender==1?'Male':'Female').'", '.
			        			'"'.ucfirst($val->ethnicity).'", '.
			        			'"'.$val->position.'", ';

			if($val->position == 1 ){
				$op .=	'"<span class=\"disabled_positioning\">------</span>", ';

			}else{
				$op .=	'"<a class=\"up\" href=\"'.site_url('admin/models/up/'.$val->id).'\" title=\"Shift the ad one step up\" >Up</a>", ';
			}

			if($val->position == count($data)){

				$op .= 	'"<span class=\"disabled_positioning\">------</span>", ';
			}else{

				$op .= 	'"<a class=\"down\" href=\"'.site_url('admin/models/down/'.$val->id).'\" title=\"Shift the ad one step down\" >Dn</a>", ';
			}


					$op .= 		'"<a class=\"edit\" href=\"'.site_url('admin/models/edit/'.$val->id).'\">Edit</a>", 
			        			"<a class=\"delete\" href=\"'.site_url('admin/models/del/'.$val->id).'\">Delete</a>" ],';
    			}
		$op .=  '],"aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Name" },
			            { "sTitle": "Gender" },
			            { "sTitle": "Ethnicity"},
			            { "sTitle": "Position"},
			            { "sTitle": "Move Up" , sWidth:"5%"},
			            { "sTitle": "Move Down" , sWidth:"5%"},
			            { "sTitle": "Actions", sWidth:"5%"},
			            { "sTitle": "" , sWidth:"5%"},
			        ],
				    "aaSorting":[[4,\'asc\']],
					"bStateSave": true,
			    } );   
			} );
			</script>';
		$op .= 	'<div class="grid_16"><table id="list_data"></table></div>';
		return $op;
	}
	

	/**
	 * new subjects form
	 */
	public function render_new_subjects($data){

		$this->ci->load->config('ethnicity');
		$this->ethnicity = $this->ci->config->item('ethnicity');

		$this->ci->template->add_css(ADMINJSPATH.'jquery-ui.css');
		$this->ci->template->add_js(ADMINJSPATH.'jquery-ui.js');

		$op = '';
		$op .= 	'<script type="text/javascript">
					$(function() {
						$( "#date_created" ).datepicker({
														dateFormat: "yy-mm-dd",
														showAnim:	"fadeIn"
													});
					});
				</script>';
		$op .='<style>
				#content .checkboxes *:first-child {
				    font-size: 17px;
				    font-weight: bold;
				}
				#content .checkboxes * {
				    font-size: 1em;
				    font-weight: normal;
				}
				#content textarea{	
					resize: vertical; 
					min-height: 100px;
				}
				#content .page{
					display:none;
				}
				#content .fx{
					border: 1px solid #DDDDDD;
					font-family: inherit;
					font-size: inherit;
					padding: 1.5px 4px;
					width: 690px;
					display:inline-block;
				}
				#ui-datepicker-div {
					font-family: "Trebuchet MS", "Helvetica", "Arial", "Verdana", "sans-serif";
					font-size: inherit;
				}
			</style>
			<script>
				$(function(){
					$(".page").eq(0).css("display","block")
					$("#next_btn").on("click",function(e){
						e.preventDefault();
						$(this)
							.closest(".page")
							.slideUp(250)
							.next()
							.slideDown(250)
						
						$("html").animate({
							scrollTop : $("html").offset().top
						},"fast")

					})
					$("#prev_btn").on("click",function(e){
						e.preventDefault();
						$(this)
							.closest(".page")
							.slideUp(250)
							.prev()
							.slideDown(250)
						$("html").animate({
						    scrollTop : $("html").offset().top
						},"fast")					})
				})
			</script>
				'.form_open().'
					<div class="page" style="position:relative;">
						<div class="grid_16">
							<div class="grid_2" style="float: right;">
								<p>
									<a href="'.site_url('admin/subjects').'">Back</a>
								</p>
							</div>
							<h2>Model</h2>
							<p class="error">Something went wrong.</p>
						</div>

						<div class="grid_12">
							<p>
								<label for="name">Name <small>Name is not editable once saved.</small></label>';
					if($data){
						//uneditable form input
						$op .=		'<span class="fx">'.$data[0]->name.'</span>';
					}else{
						//empty form input
						$op .=		'<input type="text" name="name" value="">';
					}
					$op .= 	'</p>
						</div>

						<div class="grid_6">
							<p>
								<label for="age">Age</label>
								<input type="text" name="age" value="'.($data?$data[0]->age:'').'" />
							</p>
						</div>
						<div class="grid_6">
							<p>
								<label for="gender">Gender</label>
							<select name="gender">
									<option value="1" '.($data?($data[0]->gender=='1'?'selected="selected"':''):'').'>Male</option>
									<option value="0" '.($data?($data[0]->gender=='0'?'selected="selected"':''):'').' >Female</option>
								</select>
							</p>
						</div>

						<div class="grid_12">
							<p>
								<label for="address">Address</label>
								<input type="text" name="address" value="'.($data?$data[0]->address:'').'" />
							</p>
						</div>

						<div class="grid_6">
							<p>
								<label for="contact_no">Contact No.</label>
								<input type="text" name="contact_no" value="'.($data?$data[0]->contact_no:'').'" />
							</p>
						</div>
						<div class="grid_6">
							<p>
								<label for="email">Email</label>
								<input type="text" name="email" value="'.($data?$data[0]->email:'').'" />
							</p>
						</div>

						<div class="grid_5"></div><div class="grid_6">
							<p>
								<label for="height">Height (ft. / inches) <small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" name="height" value="'.($data?$data[0]->height:'').'" />
							</p>
						</div>
						<div class="grid_6">
							<p>
								<label for="weight">Weight (kgs.) <small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" name="weight" value="'.($data?$data[0]->weight:'').'" />
							</p>
						</div>
						<div class="grid_5"></div>
						<div class="grid_4">
							<p>
								<label for="bust">Bust<small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" name="bust" value="'.($data?$data[0]->bust:'').'" />
							</p>
						</div>
						<div class="grid_4">
							<p>
								<label for="waist">Waist<small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" value="'.($data?$data[0]->waist:'').'" name="waist" />
							</p>
						</div>
						<div class="grid_4">
							<p>
								<label for="hips">Hips<small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" name="hips" value="'.($data?$data[0]->hips:'').'" />
							</p>
						</div>

						<div class="grid_5"></div>
						<div class="grid_6">
							<p>
								<label for="shoe">Shoes<small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" name="shoe" value="'.($data?$data[0]->shoe:'').'" />
							</p>
						</div>
						<div class="grid_6">
							<p>
								<label for="dress">Dress<small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" name="dress" value="'.($data?$data[0]->dress:'').'" />
							</p>
						</div>
						<div class="grid_6">
							<p>
								<label for="hair_color">Hair Color<small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" name="hair_color" value="'.($data?$data[0]->hair_color:'').'" />
							</p>
						</div>
						<div class="grid_6">
							<p>
								<label for="hair_length">Hair Length<small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" name="hair_length" value="'.($data?$data[0]->hair_length:'').'" />
							</p>
						</div>
						<div class="grid_6">
							<p>
								<label for="ethnicity">Ethnicity </label>
									<select name="ethnicity">';

								foreach($this->ethnicity as $val){
									$op .= '<option value="'.$val.'" '.
												($data?($data[0]->ethnicity==$val?'selected="selected"':''):'').'>'.
												ucfirst($val)
											.'</option>';								
								}
								$op .='</select>	
							</p>
						</div>
						<div class="grid_6">
							<p>
								<label for="skin">Skin<small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" value="'.($data?$data[0]->skin:'').'" name="skin" />
							</p>
						</div>
						<div class="grid_6">
							<p>
								<label for="eyes">Eyes<small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" value="'.($data?$data[0]->eyes:'').'" name="eyes">
							</p>
						</div>
						<div class="grid_6">
							<p>
								<label for="teeth">Teeth<small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" value="'.($data?$data[0]->teeth:'').'" name="teeth" />
							</p>
						</div>
						<div class="grid_6">
							<p>
								<label for="professional">Professonal Status</label>
								<select name="professional" >
									<option value="armateur" '.($data?($data[0]->professional=='armateur'?'selected="selected"':''):'').'>
										Armateur
									</option>
									<option value="semi-pro" '.($data?($data[0]->professional=='semi-pro'?'selected="selected"':''):'').'>
										Semi. Pro
									</option>
									<option value="professional" '.($data?($data[0]->professional=='professonal'?'selected="selected"':''):'').'>
										Professonal
									</option>
								</select>
							</p>
						</div>

						<div class="grid_6">
							<p>
								<label for="date_created">Date Created</label>
								<input id="date_created" type="text" name="date_created" value="'.($data?$data[0]->date_created:'').'" />
							</p>
						</div>

						<div class="grid_12">
							<p>
								<label for="additional">Additional Info<small>Alpha-numeric characters without spaces.</small></label>
								<textarea style="height: 36px; resize: vertical; min-height: 100px;" name="additional">'.
									($data?$data[0]->additional:'').
								'</textarea>
							</p>
						</div>
						<div class="grid_16">
							<p class="submit">
								<a href="#" id="next_btn">Next</a>
								<a href="http://localhost/model_nepal/admin/subjects">Cancel</a>
							</p>
						</div>	
					</div>
					<div class="page" style="position:relative;">
						<div class="grid_16">
							<div style="float: right;" class="grid_2">
								<p>
									<a href="'.site_url('admin/subjects').'">Back</a>
								</p>
							</div>
							<h2>Availability</h2>
							<p class="error">Something went wrong.</p>
						</div>

						<div class="grid_6">
							<p>
								<label for="travelling_area">Travelling Area<small>Alpha-numeric characters without spaces.</small></label>
								<select name="travelling_area">
									<option value="local" '.($data?($data[0]->travelling_area=='local'?'selected="selected"':''):'').'>
										Local
									</option>
									<option value="national" '.($data?($data[0]->travelling_area=='national'?'selected="selected"':''):'').'>
										National
									</option>
									<option value="international" '.($data?($data[0]->travelling_area=='internatinal'?'selected="selected"':''):'').'>
										International
									</option>
								</select>
							</p>
						</div>
						<div class="grid_6">
							<p>
								<label for="travelling_duration">Travelling Duration<small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" name="travelling_duration" id="travelling_duration" value="'.($data?$data[0]->travelling_duration:'').'" />
							</p>
						</div>

						<div class="grid_16"></div>
						
						<div class="grid_16">
							<p class="checkboxes">
								<label>Fashion Type </label>

								<label class="grid_4" for="editorial">
									<input type="checkbox" value="1" name="editorial" id="editorial" '.($data?($data[0]->editorial==1?'checked="checked"':''):'').' >
										Editorial
								</label>

								<label for="runaway" class="grid_4">
									<input type="checkbox" value="1" name="runaway" id="runaway" '.($data?($data[0]->runaway==1?'checked="checked"':''):'').' >
										Runaway
								</label>

								<label for="catalog" class="grid_4">
									<input type="checkbox" value="1" name="catalog" id="catalog" '.($data?($data[0]->catalog==1?'checked="checked"':''):'').' >
										Catalog
								</label>

								<label for="print" class="grid_4">
									<input type="checkbox" value="1" name="print" id="print" '.($data?($data[0]->editorial==1?'checked="checked"':''):'').' >
										Print
								</label>

								<label for="showroom" class="grid_4">
									<input type="checkbox" value="1" name="showroom" id="showroom" '.($data?($data[0]->showroom==1?'checked="checked"':''):'').' >
										Showroom
								</label>

								<label for="fitness" class="grid_4">    
									<input type="checkbox" value="1" name="fitness" id="fitness" '.($data?($data[0]->fitness==1?'checked="checked"':''):'').' >
										Fitness
								</label>

								<label for="fit" class="grid_4">
									<input type="checkbox" value="1" name="fit" id="fit" '.($data?($data[0]->fit==1?'checked="checked"':''):'').' >
										Fit
								</label>

								<label for="tearoom" class="grid_4">
									<input type="checkbox" value="1" name="tearoom" id="tearoom" '.($data?($data[0]->tearoom==1?'checked="checked"':''):'').' >
										Tearoom
								</label>

								<label for="body_part" class="grid_4">
									<input type="checkbox" value="1" name="body_part" id="body_part" '.($data?($data[0]->body_part==1?'checked="checked"':''):'').' >
										Body Part
								</label>

								<label for="lingerie" class="grid_4">    
									<input type="checkbox" value="1" name="lingerie" id="lingerie" '.($data?($data[0]->lingerie==1?'checked="checked"':''):'').' >
										Lingerie / Swinsuit
								</label>
							</p>
								
						</div>
						
						<div class="grid_16">
							<p class="checkboxes">
								<label>Commercial Type</label>

								<label for="product_modelling" class="grid_4">
									<input type="checkbox" id="product_modelling" name="product_modelling" value="1" '.($data?($data[0]->product_modelling==1?'checked="checked"':''):'').' >
										Product Modelling
								</label>

								<label class="grid_4" for="lifestyle_modelling">
									<input type="checkbox" id="lifestyle_modelling" name="lifestyle_modelling" value="1" '.($data?($data[0]->lifestyle_modelling==1?'checked="checked"':''):'').' >
										Lifestyle Modelling
								</label>

								<label class="grid_4" for="coorporate_modelling">
									<input type="checkbox" id="coorporate_modelling" name="coorporate_modelling" value="1" '.($data?($data[0]->coorporate_modelling==1?'checked="checked"':''):'').' >
										Coorporate Modelling
								</label>

								<label class="grid_4" for="product_demo">
									<input type="checkbox" id="product_demo" name="product_demo" value="1" '.($data?($data[0]->product_demo==1?'checked="checked"':''):'').' >
										Product Demo
								</label>

								<label class="grid_4" for="tradeshow">
									<input type="checkbox" id="tradeshow" name="tradeshow" value="1" '.($data?($data[0]->tradeshow==1?'checked="checked"':''):'').' >
										Tradeshow
								</label>
							</p>
						</div>
						
						<div class="grid_16">
							<p class="checkboxes">
								<label>Glamour Type</label>

								<label class="grid_4" for="lingrie">
									<input type="checkbox" value="1" name="lingrie" id="lingrie" '.($data?($data[0]->lingrie==1?'checked="checked"':''):'').' >
										Lingrie / Swimsuit
								</label>

								<label for="art" class="grid_4">
									<input type="checkbox" value="1" name="art" id="art" '.($data?($data[0]->art==1?'checked="checked"':''):'').' >
										Art
								</label>
							</p>
						</div>

						<div class="grid_12">
							<p>
								<label for="experience">Experience<small>Alpha-numeric characters without spaces.</small></label>
								<textarea name="experience" style="height: 36px; resize: vertical; min-height: 100px;">'.
									($data?$data[0]->experience:'').
								'</textarea>
							</p>
						</div>
						
						<div class="grid_16">
							<small>
								Create a folder within <code>public\model_name</code> 
								and upload three potrait images there using any ftp client. 
							</small>
							<br>
							<small>eg.</small>  	
							<small>
								<ul style="list-style:none;">
									<li><code>&lt;site&gt;\public\model_name\img1.jpg</code></li>
									<li><code>&lt;site&gt;\public\model_name\img2.jpg</code></li>
									<li><code>&lt;site&gt;\public\model_name\img3.jpg</code></li>
									<li><code>&lt;site&gt;\public\another_model\img1.jpg</code></li>
									<li><code>&lt;site&gt;\public\another_model\img2.jpg</code></li>
									<li><code>&lt;site&gt;\public\another_model\img3.jpg</code></li>
								</ul>
							</small>
						</div>		

						<div class="grid_16">
							<p class="submit">
								<a id="prev_btn" href="#">Previous</a>
								<a href="javascript:history.back()">Cancel</a>
								<input type="submit" value="Submit">
							</p>
						</div>	
					</div>
				</form>';

		return  $op;
	}


	public function render_userlogged($data=false){
	
		if(! $data)
			return false;

		
		$op =	'
				<style type="text/css" rel="stylesheet">
				#username{
					float:right;
					font-size: 0.5em;
					margin: 10px;
					width:60px;
					cursor:pointer;	
				}
				#username:hover{
					background-color: #434A48;
				}
				#user_details{
					display:none;
				}
				#user_details ul{
					list-style: none outside none;
					margin-bottom: auto;
					padding-top: 5px;
				}
				#user_details li{
					margin-left: 0;
					padding: 5px;	
				}
				#user_details li:hover{
					background-color: #383E3C;
				}
				</style>

				<script type="text/javascript">
				$(function(){
					$("#username").hover(function(){
							$("#user_details").fadeIn(250);
						},function(){
							$("#user_details").fadeOut(250);
						}
					)

					$("#profile").click(function(){
						window.location = "'.site_url('admin/users/view_profile').'";
					})
					$("#logout").click(function(){
						window.location = "'.site_url('admin/logout').'";
					})
				})
				</script>
				<div id="username" >
					<a>'.$this->ci->session->userdata('username').'</a>
					<div style="" id="user_details">
					    <ul>
					        <li><span id="profile">Profile</span></li>
					        <li><span id="logout">Logout</span></li>
					    </ul>
					</div>
				</div>';
		return $op;
	}

	public function view_profile($data=false){
		if(! $data)
			return false;

		$op =	form_open().'
					<div class="grid_16">
						<div class="grid_2" style="float: right;">
							<p>
								<a href="'.site_url('admin/main').'">Back</a>
							</p>
						</div>
						<h2>User Information</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_12">
						<p>
							<label for="view_username">Username <small>Alpha-numeric characters without spaces.</small></label>
							<div id="view_username" class="profile_data">'.($data?$data[0]->username:'').'</div>
						</p>
					</div>

					<div class="grid_4">
						<p>
							<a id="new_password" href="'.site_url('admin/users/change_password').'">Change password</a>';

				//	if($this->ci->session->userdata('username')=='root'){
				//		$op .=	'<span id="del_account">Delete account</span>';
				//	}else{
				//		$op .=	'<a id="del_account" href="#">Delete account</a>';
				//	}

				$op .=	'</p>
					</div>
					<div class="grid_6">
						<p>
							<label for="view_email">Email</label>
							<div id="view_email" class="profile_data">'.($data?$data[0]->email:'').'</div>
						</p>
					</div>

					<div class="grid_5"></div>
					<div class="grid_6">
						<p>
							<label for="view_usertype">User Type </label>
							<div id="view_usertype" class="profile_data">'.($data?$data[0]->usertype:'').'</div>
						</p>
					</div>
				</form>';
		return  $op;
	}

	public function change_password($data=false){
		if(!$data)
			return false;

		$op = form_open().
				'<div class="grid_16">
					<div style="float: right;" class="grid_2">
						<p>
							<a href="'.site_url('admin/users/view_profile').'">Back</a>
						</p>
					</div>
					<h2>User Information</h2>
					<p class="error">Something went wrong.</p>
				</div>

				<div class="grid_6">
					<p>
						<label for="old_password">Old password </label>
						<input type="password" class="profile_data" id="old_password" name="old_password">
					</p>
				</div>
				<div class="grid_12"></div>

				<div class="grid_6">
					<p>
						<label id="new_password" for="new_password">New password</label>
						<input type="password" name="new_password" id="new_password">
					</p>
				</div>
				<div class="grid_6">
					<p>
						<label for="new_password_reenter">Re-Enter New Password</label>
						<input type="password" class="profile_data" name="new_password_reenter" id="new_password_reenter">
					</p>
				</div>

				
				<div class="grid_6">
					<p>
						<input type="submit" value="Update" name="submit">
						<a href="javascript:history.back()">Cancel</a>
					</p>
				</div>
			</form>';
		return $op;
	}

	/**
	 * users list
	 */
	public function render_userslist($data){

		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/users/new_user').'">New</a>
					</p>
				</div>
				<h2>Users List</h2>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';

		if($data)
		foreach($data as $key=>$val){
			$op .=	'[
						"'.$val->id.'", 
						"'.$val->usertype.'", 
						"'.$val->username.'", 
						"'.$val->last_loggedin.'",
						"'.$val->last_location.'",
						"<a class=\"edit\" href=\"'.site_url('admin/users/edit/'.$val->id).'\">Edit</a>",
						"<a class=\"delete\" href=\"'.site_url('admin/users/del/'.$val->id).'\">Delete</a>"
					], ';
		}

		$op .=  '],"aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Usertype" },
			            { "sTitle": "Username" },
			            { "sTitle": "Last Logged" },
			            { "sTitle": "Last Location" },
			            { "sTitle": "Actions", sWidth:"5%"},
			            { "sTitle": "" , sWidth:"5%"},
			        ]
			    } );   
			} );
			</script>';
		$op .= 	'<div class="grid_16"><table id="list_data"></table></div>';
		return $op;
	}

	/**
	 * new users form
	 */
	public function render_new_user($data){

		$op =	//'<div class="container_16 clearfix" id="content">'.
					form_open().'
					<div class="grid_16">
						<div class="grid_2" style="float: right;">
							<p>
								<a href="'.base_url('admin/users').'">Back</a>
							</p>
						</div>

						<h2>New User</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="username">Username <small>Alpha-numeric characters without spaces.</small></label>';
						if($data){
							$op .= '<span class="fx">'.$data[0]->username.'</span>';
						}else{
							$op .= '<input type="text" name="username" value="" />';
						}

				$op.=	'</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="usertype">User Type</label>
							<select name="usertype">
								<option value="administrator" '.($data?($data[0]->usertype=='administrator'?'selected="selected"':''):'').'>Administrator</option>
								<option value="editor" '.($data?($data[0]->usertype=='editor'?'selected="selected"':''):'').'>Editor</option>
								<option value="user" '.($data?($data[0]->usertype=='user'?'selected="selected"':''):'').'>User</option>
							</select>
						</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="email">Email <small>Alpha-numeric characters without spaces.</small></label>
							<input type="text" name="email" value="'.($data?$data[0]->email:'').'" />
						</p>
					</div>

					<div class="grid_16">
						<p class="submit">
							<a href="javascript:history.back()">Cancel</a>
							<input type="submit" value="Submit">
						</p>
					</div>		
					</form>';
				//</div>';


		return  $op;
	}

	public function reset_user($data){
		$email = '<div>
					<p>
						Your username/password has been reset to as follows : 
					</p>

					<table>
						<tr>
							<td>Your username : </td>
							<td>'.$data[0]->username.'<td>
						</tr>
						<tr>
							<td>Your password : </td>
							<td>'.$data[0]->password.'<td>
						</tr>
					</table>

					<p>
						You can reset your password by logging in and going into profiles and change password.
					</p>
				</div>';		
		return $email;
	}

	public function render_flash($msg){

		$op = 	'<div class="flash_msg">'.$msg.'<span class="flash_close">x</span></div>';
		return $op;
	}


	public function file_management($data){
		$this->ci->template->add_css(ADMINJSPATH.'jquery-ui.css');
		$this->ci->template->add_js(ADMINJSPATH.'jquery-ui.js');


		$this->ci->template->add_css(FILEMGNTCSS.'elfinder.min.css');
		$this->ci->template->add_js(FILEMGNTJS.'elfinder-nightly.full.js');

		$name = ucwords(preg_replace('/_/', ' ', $data['dir_name']));
		$type = ucwords(preg_replace('/_/', ' ', $data['dir_type']));


		if(empty($name) || empty($type)){
			redirect('admin/main');
		}

		$op = '';
		$op .=	'<h2>'
					.$name.
					' - '
					.$type.
					' File Management
				</h2>
				<script type="text/javascript" charset="utf-8">
					$().ready(function() {

						var elf = $(\'#elfinder\').elfinder({
							url : "'.site_url('admin/file_management/elfinder_init/contests/1').'",  // connector URL (REQUIRED)
							customData : {
											'.//$data['csrf_name'].': "'.$data['csrf_value'].'",
											'type: "'.gen_folder_name($type).'",
											name: "'.gen_folder_name($name).'",
										}
						}).elfinder(\'instance\');			
					
						$(document).ajaxStart(function(){
							$("#elfinder_spinner_bg").fadeIn(100);
							$("#elfinder_spinner").fadeIn(100);
						})
						$(document).ajaxStop(function(){
							$("#elfinder_spinner_bg").fadeOut(100);
							$("#elfinder_spinner").fadeOut(100);
						})
					});

				</script>
				<style type="text/css">
				#elfinder_spinner_bg{
					width: 100%; 
					height: 100%; 
					opacity: 0.5; 
					position: absolute; 
					background-color: black; 
					z-index: 1;
					display:none;
					top:0;
					left:0;
				}
				#elfinder_spinner{
					background: url('.base_url().IMGSPATH.'ajax-loader.gif) repeat scroll 0% 0% transparent; 
					position: absolute; 
					left: 50%; 
					width: 100px; 
					height: 100px; 
					top: 30%;
					display:none;
				}
				</style>

				<!-- Element where elFinder will be created (REQUIRED) -->
				<div id="elfinder">
				</div>
				<div id="elfinder_spinner_bg"></div>
				<div id="elfinder_spinner"></div>';

		return $op;
	}

}
