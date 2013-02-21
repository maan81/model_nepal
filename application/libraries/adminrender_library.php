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
	
	public function render_navigation($data){
		$op = '<ul id="navigation">';
		
		foreach($data as $key=>$val){
			$op .= '<li><a href="'.$val['link'].'">'.$val['name'].'</a></li>';
//<li><span class="active">Overview</span></li>
//<li><a href="#">News</a></li>
//<li><a href="#">Users</a></li>
		}
		$op .= '</ul>';
		
		return $op;
	}
}
