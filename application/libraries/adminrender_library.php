<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* library to render page beside the main page
*/
 
 
class Adminrender_library{

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
			//<li><span class="active">Overview</span></li>
			//<li><a href="#">News</a></li>
		}
		$op .= '</ul>';
		
		return $op;
	}
	
	/**
	 * ads list
	 */
	public function render_adslist($data){
		
		$op = 	'<div class="grid_16">';
		$op .= '	<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Size</th>
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

		foreach($data as $key=>$val){
			$op .=	'<tr>'.
						'<td>'.$data['name'].'</td>'.
						'<td>'.$data['description'].'</td>'.
						'<td>'.$data['size'].'</td>'.
						'<td><a class="edit" href="#">Edit</a></td>'.
						'<td><a class="delete" href="#">Delete</a></td>'.
					'</tr>';
		}

		$op .=	'</table></div>';
		return $op;
	}
}
