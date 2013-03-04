<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* library to render page beside the main page
*/
 
 
class Adminrender_library{
	
	private $ci = null;
	protected $ethnicity = array();

	/**
	 * __construct
	 *
	 * @return void
	 **/
	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->database();
		
		array_push( $this->ethnicity,
						'brahmin',		'gurung',
						'limbu',		'magar',
						'newar',		'rai',
						'rana',			'sherpa',
						'tamang',		'thakali',
						'thakuri',		'tibetan Origin'
					);
	}
	
	/**
	 * admin menu
	 */
	public function render_navigation($selected){
//echo $selected;		
		$data = array(	'Home'			=> base_url().'admin',
						'Advertizements'=> base_url().'admin/ads',
						'Featured Models'=>base_url().'admin/featured',
						'Models'		=> base_url().'admin/subjects',
						'Gossips'		=> base_url().'admin/gossips',
						'Events'		=> base_url().'admin/events',
						'Articles'		=> base_url().'admin/articles',
						'Projects'		=> base_url().'admin/projects',
						'Services'		=> base_url().'admin/services',
						'Contact'		=> base_url().'admin/contact',
					);

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
	 * ads list
	 */
	public function render_adslist($data){
//print_r($data);die;		
		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/ads/new_ad').'">New</a>
					</p>
				</div>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';

		if($data)
		foreach($data as $key=>$val){
			$op .=	'["'.$val->id.'", "'.$val->category.'", "'.$val->title.'", "'.$val->dimensions.'", "<a class=\"edit\" href=\"'.site_url('admin/ads/edit/'.$val->id).'\">Edit</a>","<a class=\"delete\" href=\"'.site_url('admin/ads/del/'.$val->id).'\">Delete</a>"], ';
		}

		$op .=  '],"aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Category" },
			            { "sTitle": "Title" },
			            { "sTitle": "Dimensions"},
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
	 * new ads form
	 */
	public function render_new_ads($data){
		$this->ci->load->helper('form');
//echo '<pre>';
//print_r($data);
//echo '</pre>';
//die;
		$op =	'<div class="container_16 clearfix" id="content">
					'.form_open_multipart().'
					<div class="grid_16">
						<div class="grid_2" style="float: right;">
							<p>
								<a href="'.base_url('admin/ads').'">Back</a>
							</p>
						</div>

						<h2>New Advertizement</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_5">
						<p>
							<label for="title">Title <small>Alpha-numeric characters without spaces.</small></label>
							<input type="text" name="title" value="'.($data?$data[0]->title:'').'" />
						</p>
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
							<label for="image">Image<small>The required Advertizement image..</small></label>
							<input type="file" name="image">
						</p>
					</div>
					<div class="grid_6">
						<p>
							<label for="dimensions">Dimensions <small>( width x height )</small></label>
							<select name="dimensions">
								<option value="248x117" '.
									($data?($data[0]->dimensions=='248x117'?'selected="selected"':''):'').'>248x117</option>
								<option value="249x162" '.
									($data?($data[0]->dimensions=='249x162'?'selected="selected"':''):'').'>249x162</option>
								<option value="250x223" '.
									($data?($data[0]->dimensions=='250x223'?'selected="selected"':''):'').'>250x223</option>
								<option value="341x81"  '.
									($data?($data[0]->dimensions=='341x81'?'selected="selected"':''):'').'>341x81</option>
								<option value="686x107" '.
									($data?($data[0]->dimensions=='686x107'?'selected="selected"':''):'').'>686x107</option>
								<option value="306x78"  '.
									($data?($data[0]->dimensions=='306x78'?'selected="selected"':''):'').'>306x78</option>
							</select>
						</p>
					</div>
					<div class="grid_16">
						<p>
							<label for="link">Link<small>Must contain alpha-numeric characters.</small></label>
							<input type="text" name="link" value="'.($data?$data[0]->link:'').'">
						</p>
						<p class="submit">
							<a href="'.site_url('admin/ads').'">Cancel</a>
							<input type="submit" value="Submit">
						</p>
					</div>		
					</form>
				</div>';


		return  $op;
	}


	/**
	 * featured list
	 */
	public function render_featuredlist($data){
//print_r($data);die;		
		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/featured/new_featured').'">New</a>
					</p>
				</div>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';

		if($data)
		foreach($data as $key=>$val){
			$op .=	'[ '.
						'"'.$val->id.'", '.
						'"'.$val->name.'", '.
						'"'.($val->gender==1?'Male':'Female').'", '.
						'"'.$val->wardrobe.'", '.
						'"'.$val->location.'", '.
						'"'.$val->make_up.'", '.
						'"'.$val->photographer.'", '.
						'"'.$val->model_by.'", '.
						'"'.ucfirst($val->ethnicity).'", '.
						'"<a class=\"edit\" href=\"'.site_url('admin/featured/edit/'.$val->id).'\">Edit</a>", '.
						'"<a class=\"delete\" href=\"'.site_url('admin/featured/del/'.$val->id).'\">Delete</a>"'.
					'],';
		}

		$op .=  '],"aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Name" },
			            { "sTitle": "Gender" },

			            { "sTitle": "Wardrobe"},
			            { "sTitle": "Location"},
			            { "sTitle": "Make-Up"},
			            { "sTitle": "Photographer"},
			            { "sTitle": "Model By"},

			            { "sTitle": "Ethnicity"},
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
	 * new featured form
	 */
	public function render_new_featured($data){
		$this->ci->load->helper('form');
//echo '<pre>';
//print_r($data);
//echo '</pre>';
//die;


		$op =	'<div class="container_16 clearfix" id="content">
					'.form_open().'
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
							<label for="name">Name <small>Alpha-numeric characters without spaces.</small></label>
							<input type="text" name="name" value="'.($data?$data[0]->name:'').'" />
						</p>
					</div>

					<div class="grid_5">
						<p>
							<label for="gender">Gender</label>
							<select name="gender">
								<option value="1" '.($data?($data[0]->gender=='1'?'selected="selected"':''):'').' >Male</option>
								<option value="0" '.($data?($data[0]->gender=='0'?'selected="selected"':''):'').'>Female</option>
								
							</select>
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
				
				$op .=		'</select>
						</p>
					</div>
					<div class="grid_12"></div>
					<div class="grid_6">
						<p>
							<label for="wardrobe">Wardrobe<small>Alpha-numeric characters without spaces.</small></label>
							<input type="text" name="wardrobe" value="'.($data?$data[0]->wardrobe:'').'">
						</p>
					</div>
					<div class="grid_6">
						<p>
							<label for="location">Location<small>Alpha-numeric characters without spaces.</small></label>
							<input type="text" name="location" value="'.($data?$data[0]->location:'').'">
						</p>
					</div>
					<div class="grid_6">
						<p>
							<label for="make_up">Make Up<small>Alpha-numeric characters without spaces.</small></label>
							<input type="text" name="make_up" value="'.($data?$data[0]->make_up:'').'">
						</p>
					</div>
					<div class="grid_6">
						<p>
							<label for="model_by">Model By<small>Alpha-numeric characters without spaces.</small></label>
							<input type="text" name="model_by" value="'.($data?$data[0]->model_by:'').'">
						</p>
					</div>
					<div class="grid_6">
						<p>
							<label for="photographer">Photographer<small>Alpha-numeric characters without spaces.</small></label>
							<input type="text" value="'.($data?$data[0]->photographer:'').'" name="photographer">
						</p>
					</div>
					<div class="grid_16">
						<p class="submit">
							<a href="'.site_url('admin/featured').'">Cancel</a>
							<input type="submit" value="Submit">
						</p>
					</div>	

					<div class="grid_16">
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

					</form>
				</div>';


		return  $op;
	}



	/**
	 * gossips list
	 */
	public function render_gossipslist($data){
//print_r($data);die;		
		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/gossips/new_gossip').'">New</a>
					</p>
				</div>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';

		if($data)
		foreach($data as $key=>$val){
			$op .=	'["'.$val->id.'", "'.$val->title.'", "'.$val->summary.'", "<a class=\"edit\" href=\"'.site_url('admin/gossips/edit/'.$val->id).'\">Edit</a>", "<a class=\"delete\" href=\"'.site_url('admin/gossips/del/'.$val->id).'\">Delete</a>"], ';
		}

		$op .=  '],"aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Title" },
			            { "sTitle": "Summary" },
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
	 * new gossip form
	 */
	public function render_new_gossips($data){
		$this->ci->load->helper('form');
//echo '<pre>';
//print_r($data);
//echo '</pre>';
//die;

		$op =	'<div class="container_16 clearfix" id="content">
					'.form_open_multipart().'
					<div class="grid_16">
						<div class="grid_2" style="float: right;">
							<p>
								<a href="'.base_url('admin/gossips').'">Back</a>
							</p>
						</div>

						<h2>Gossip</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_5">
						<p>
							<label for="title">Title <small>Alpha-numeric characters without spaces.</small></label>
							<input type="text" name="title" value="'.($data?$data[0]->title:'').'" />
						</p>
					</div>

					<div class="grid_16">
						<p>
							<label>Summary <small>Will be displayed in search engine results.</small></label>
							<textarea class="area_small" name="summary">'.
								($data?$data[0]->summary:'').
							'</textarea>
						</p>
					</div>

					<div class="grid_16">
						<p>
							<label>Article <small>Markdown Syntax.</small></label>
							<textarea class="area_medium" name="content">'.
								($data?$data[0]->content:'').
							'</textarea>
						</p>
						<p class="submit">
							<a href="'.site_url('admin/gossips').'">Cancel</a>
							<input type="submit" value="Submit">
						</p>
					</div>	

					</form>
				</div>';//.$generated_editor;


		return  $op;
	}


	/**
	 * events list
	 */
	public function render_eventslist($data){
//print_r($data);die;		
		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/events/new_event').'">New</a>
					</p>
				</div>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';

		if($data)
		foreach($data as $key=>$val){
			$op .=	'['.$val->id.'", "'.$val->title.'", "'.$val->summary.'", "<a class=\"edit\" href=\"'.site_url('admin/events/edit/'.$val->id).'\">Edit</a>", "<a class=\"delete\" href=\"'.site_url('admin/events/del/'.$val->id).'\">Delete</a>"], ';
		}

		$op .=  '],"aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Title" },
			            { "sTitle": "Summary" },
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
	 * new events form
	 */
	public function render_new_events($data){
		$this->ci->load->helper('form');
//echo '<pre>';
//print_r($data);
//echo '</pre>';
//die;

		$op =	'<div class="container_16 clearfix" id="content">
					'.form_open().'
					<div class="grid_16">
						<div class="grid_2" style="float: right;">
							<p>
								<a href="'.base_url('admin/events').'">Back</a>
							</p>
						</div>
						<h2>New Events</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_5">
						<p>
							<label for="title">Title <small>Alpha-numeric characters without spaces.</small></label>
							<input type="text" name="title" value="'.($data?$data[0]->title:'').'" />
						</p>
					</div>

					<div class="grid_16">
						<p>
							<label>Summary <small>Will be displayed in search engine results.</small></label>
							<textarea class="area_small" name="summary">'.
								($data?$data[0]->summary:'').
							'</textarea>
						</p>

						<p class="submit">
							<a href="'.site_url('admin/events').'">Cancel</a>
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
					</form>
				</div>';


		return  $op;
	}




	/**
	 * articles list
	 */
	public function render_articleslist($data){
//print_r($data);die;		
		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/articles/new_article').'">New</a>
					</p>
				</div>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';
		if($data)
		foreach($data as $key=>$val){
			$op .=	'[ "'.$val->id.'", "'.$val->title.'", "'.$val->summary.'", "<a class=\"edit\" href=\"'.site_url('admin/articles/edit/'.$val->id).'\">Edit</a>", "<a class=\"delete\" href=\"'.site_url('admin/articles/del/'.$val->id).'\">Delete</a>" ], ';
		}

		$op .=  '],"aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Title" },
			            { "sTitle": "Summary" },
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
	 * new article form
	 */
	public function render_new_article($data){
		$this->ci->load->helper('form');
//echo '<pre>';
//print_r($data);
//echo '</pre>';
//die;

		$op =	'<div class="container_16 clearfix" id="content">
					'.form_open().'
					<div class="grid_16">
						<div class="grid_2" style="float: right;">
							<p>
								<a href="'.base_url('admin/articles').'">Back</a>
							</p>
						</div>
						<h2>New Article</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_5">
						<p>
							<label for="title">Title <small>Alpha-numeric characters without spaces.</small></label>
							<input type="text" name="title" value="'.($data?$data[0]->title:'').'" />
						</p>
					</div>

					<div class="grid_16">
						<p>
							<label>Summary <small>Will be displayed in search engine results.</small></label>
							<textarea class="area_small" name="summary">'.
								($data?$data[0]->summary:'').
							'</textarea>
						</p>
					</div>

					<div class="grid_16">
						<p>
							<label>Article <small>Markdown Syntax.</small></label>
							<textarea class="area_medium" name="content">'.
								($data?$data[0]->content:'').
							'</textarea>
						</p>
						<p class="submit">
							<a href="'.site_url('admin/articles').'">Cancel</a>
							<input type="submit" value="Submit">
						</p>
					</div>	
					</form>
				</div>';


		return  $op;
	}



	/**
	 * subjects list
	 */
	public function render_subjectslist($data){
//print_r($data);die;		
		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/subjects/new_subject').'">New</a>
					</p>
				</div>'.
				'<script type="text/javascript">
				$(function() {
				    $(\'#list_data\').dataTable( {
				        "aaData": [';
				if($data)
				foreach($data as $key=>$val){
			        $op .= '[ "'.$val->id.'", "'.$val->name.'", "'.($val->gender==1?'Male':'Female').'", "'.ucfirst($val->ethnicity).'", "<a class=\"edit\" href=\"'.site_url('admin/subjects/edit/'.$val->id).'\">Edit</a>", "<a class=\"delete\" href=\"'.site_url('admin/subjects/del/'.$val->id).'\">Delete</a>" ],';
		        }
		$op .=  '],"aoColumns": [
			            { "sTitle": "ID" },
			            { "sTitle": "Name" },
			            { "sTitle": "Gender" },
			            { "sTitle": "Ethnicity"},
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
	 * new subjects form
	 */
	public function render_new_subjects($data){
		$this->ci->load->helper('form');
//echo '<pre>';
//print_r($data);
//echo '</pre>';
//die;

		$op ='<style>
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
						$(document).scrollTop()
					})
					$("#prev_btn").on("click",function(e){
						e.preventDefault();
						$(this)
							.closest(".page")
							.slideUp(250)
							.prev()
							.slideDown(250)
						$(document).scrollTop()
					})
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
								<label for="name">Name <small>Alpha-numeric characters without spaces.</small></label>
								<input type="text" name="name" value="'.($data?$data[0]->name:'').'">
							</p>
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
							</p>x
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
						<div class="grid_12">
							<p>
								<label for="additional">Additional Info<small>Alpha-numeric characters without spaces.</small></label>
								<textarea style="height: 36px; resize: vertical; min-height: 100px;" name="additional">'.
									($data?$data[0]->additional:'').'
								</textarea>
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
									<a href="#">Back</a>
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
									($data?$data[0]->experience:'').'
								</textarea>
							</p>
						</div>
						
						<div class="grid_16">
							<p class="submit">
								<a id="prev_btn" href="#">Previous</a>
								<a href="http://localhost/model_nepal/admin/subjects">Cancel</a>
								<input type="submit" value="Submit">
							</p>
						</div>	
					</div>
				</form>
				';
		return  $op;
	}
}
