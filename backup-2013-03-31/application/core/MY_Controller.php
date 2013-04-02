<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct(){
        parent::__construct();

//		$this->output->enable_profiler(true);
//		$this->ci->db->cache_on();
        
		/**
		 * count the no. of times unique client ip 
		 * address accesses the site
		 * 
		 */
//		set_count_visitors();		

		/**
		 * load the render library
		 */
		$this->load->library('render_library');
		$this->load->library('adminrender_library');
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
