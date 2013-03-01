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


		$op =	'<div class="container_16 clearfix" id="content">
					'.form_open().'
					<div class="grid_16">
						<div class="grid_2" style="float: right;">
							<p>
								<a href="'.base_url('admin/subjects').'">Back</a>
							</p>
						</div>
						<h2>Model</h2>
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
					<div class="grid_16">
						<p class="submit">
							<a href="'.site_url('admin/subjects').'">Cancel</a>
							<input type="submit" value="Submit">
						</p>
					</div>	

					</form>
				</div>';


		return  $op;
	}
}
