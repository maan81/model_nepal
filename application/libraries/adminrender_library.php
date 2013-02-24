<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* library to render page beside the main page
*/
 
 
class Adminrender_library{
	
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
	
	/**
	 * admin menu
	 */
	public function render_navigation($selected){
		$data = array(	'Home'		=> base_url().'admin',
						'Advertizements'=> base_url().'admin/ads',
						'Models'	=> base_url().'admin/subjects',
						'Gossips'	=> base_url().'admin/gossips',
						//'Events'	=> base_url().'admin/events',
						'Articles'	=> base_url().'admin/articles',
						'Projects'	=> base_url().'admin/projects',
						'Services'	=> base_url().'admin/services',
						'Contact'	=> base_url().'admin/contact',
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
						<a href="'.site_url('admin/ads/new_ads').'">New</a>
					</p>
				</div>';
		$op .= 	'<div class="grid_16">';
		$op .= '	<table>
						<thead>
							<tr>
								<th>Category</th>
								<th>Title</th>
								<th>Dimensions</th>
								<th width="10%" colspan="2">Actions</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td class="pagination" colspan="5">
									<span class="active curved">1</span><a class="curved" href="#">2</a><a class="curved" href="#">3</a><a class="curved" href="#">4</a> ... <a class="curved" href="#">10 million</a>
								</td>
							</tr>
						</tfoot>';

		if($data)
		foreach($data as $key=>$val){
			$op .=	'<tr>'.
						'<td>'.$val->category.'</td>'.
						'<td>'.$val->name.'</td>'.
						'<td>'.$val->dimensions.'</td>'.
						'<td>
							<a class="edit" href="'.site_url('admin/ads/edit/'.$val->id).'">Edit</a>
						</td>'.
						'<td>
							<a class="delete" href="'.site_url('admin/ads/del/'.$val->id).'">Delete</a>
						</td>'.
					'</tr>';
		}

		$op .=	'</table></div>';
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
						<h2>New Advertizement</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_5">
						<p>
							<label for="name">Title <small>Alpha-numeric characters without spaces.</small></label>
							<input type="text" name="name" value="'.($data?$data[0]->name:'').'" />
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
							<label for="title">Link<small>Must contain alpha-numeric characters.</small></label>
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
	 * subjects list
	 */
	public function render_subjectslist($data){
//print_r($data);die;		
		$op =	'<div class="grid_2" style="float:right;">
					<p>
						<a href="'.site_url('admin/subjects/new_subject').'">New</a>
					</p>
				</div>';
		$op .= 	'<div class="grid_16">';
		$op .= '	<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Gender</th>
								<th>Ethinicity</th>
								<th width="10%" colspan="2">Actions</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td class="pagination" colspan="5">
									<span class="active curved">1</span><a class="curved" href="#">2</a><a class="curved" href="#">3</a><a class="curved" href="#">4</a> ... <a class="curved" href="#">10 million</a>
								</td>
							</tr>
						</tfoot>';

		if($data)
		foreach($data as $key=>$val){
			$op .=	'<tr>'.
						'<td>'.$val->name.'</td>'.
						'<td>'.$val->gender.'</td>'.
						'<td>'.$val->ethinicity.'</td>'.
						'<td>
							<a class="edit" href="'.site_url('admin/subjectsw/edit/'.$val->id).'">Edit</a>
						</td>'.
						'<td>
							<a class="delete" href="'.site_url('admin/subjects/del/'.$val->id).'">Delete</a>
						</td>'.
					'</tr>';
		}

		$op .=	'</table></div>';
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
							<label for="ethinicity">Ethinicity </label>
							<select name="ethinicity">
								<option value="248x117" '.
									($data?($data[0]->ethinicity=='248x117'?'selected="selected"':''):'').'>248x117</option>
								<option value="249x162" '.
									($data?($data[0]->ethinicity=='249x162'?'selected="selected"':''):'').'>249x162</option>
								<option value="250x223" '.
									($data?($data[0]->ethinicity=='250x223'?'selected="selected"':''):'').'>250x223</option>
								<option value="341x81"  '.
									($data?($data[0]->ethinicity=='341x81'?'selected="selected"':''):'').'>341x81</option>
								<option value="686x107" '.
									($data?($data[0]->ethinicity=='686x107'?'selected="selected"':''):'').'>686x107</option>
								<option value="306x78"  '.
									($data?($data[0]->ethinicity=='306x78'?'selected="selected"':''):'').'>306x78</option>
							</select>
						</p>
					</div>
					<div class="grid_16">
						<p class="submit">
							<a href="'.site_url('admin/subjects').'">Cancel</a>
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
				</div>';
		$op .= 	'<div class="grid_16">';
		$op .= '	<table>
						<thead>
							<tr>
								<th>Title</th>
								<th>Summary</th>
								<th width="10%" colspan="2">Actions</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td class="pagination" colspan="5">
									<span class="active curved">1</span><a class="curved" href="#">2</a><a class="curved" href="#">3</a><a class="curved" href="#">4</a> ... <a class="curved" href="#">10 million</a>
								</td>
							</tr>
						</tfoot>';

		if($data)
		foreach($data as $key=>$val){
			$op .=	'<tr>'.
						'<td>'.$val->title.'</td>'.
						'<td>'.$val->summary.'</td>'.
						'<td>
							<a class="edit" href="'.site_url('admin/gossips/edit/'.$val->id).'">Edit</a>
						</td>'.
						'<td>
							<a class="delete" href="'.site_url('admin/gossips/del/'.$val->id).'">Delete</a>
						</td>'.
					'</tr>';
		}

		$op .=	'</table></div>';
		return $op;
	}
	
	
	/**
	 * new gossip form
	 */
	public function render_new_gossips($data){
		$this->ci->load->helper('form');
echo '<pre>';
print_r($data);
echo '</pre>';
//die;

		$op =	'<div class="container_16 clearfix" id="content">
					'.form_open_multipart().'
					<div class="grid_16">
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
}
