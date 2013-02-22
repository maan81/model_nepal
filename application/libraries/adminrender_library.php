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
	public function render_navigation($data){

		$op = '<ul id="navigation">';
		foreach($data as $key=>$val){
			$op .= '<li><a href="'.$val.'">'.$key.'</a></li>';
			//<li><span class="active">Overview</span></li>//for selected poriton
			//<li><a href="#">News</a></li>					//for rest
		}
		$op .= '</ul>';
		
		return $op;
	}
	
	/**
	 * ads list
	 */
	public function render_adslist($data){
		
		$op =	'<div class="grid_2">
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
echo '<pre>';
print_r($data);
echo '</pre>';
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
	public function render_new_ads($data=null){
		$this->ci->load->helper('form');
		
		$op =	'<div class="container_16 clearfix" id="content">
					'.form_open_multipart().'
					<div class="grid_16">
						<h2>New Advertizement</h2>
						<p class="error">Something went wrong.</p>
					</div>

					<div class="grid_5">
						<p>
							<label for="name">Title <small>Alpha-numeric characters without spaces.</small></label>
							<input type="text" name="name">
						</p>
					</div>

					<div class="grid_6">
						<p>
							<label for="category">Category</label>
							<select name="category">
								<option value="draft">Draft</option>
								<option value="published">Published</option>
								<option value="private">Private</option>
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
								<option value="248x117">248x117</option>
								<option value="249x162">249x162</option>
								<option value="250x223">250x223</option>
								<option value="341x81" >341x81</option>
								<option value="686x107">686x107</option>
								<option value="306x78" >306x78</option>
							</select>
						</p>
					</div>
					<div class="grid_16">
						<p>
							<label for="title">Link<small>Must contain alpha-numeric characters.</small></label>
							<input type="text" name="link">
						</p><p class="submit">
							<a href="'.site_url('admin/ads').'">Cancel</a>
							<input type="submit" value="Submit">
						</p>
					</div>		
					</form>
				</div>';


		return  $op;
	}
}
