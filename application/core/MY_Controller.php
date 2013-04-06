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



	/**
	 * Generates the basic skeleton of the site's webpage.
	 * Is same for every page on the SITE
	 */
	public function render_skeleton(){
		$this->template->set_template('site');
		

		//-----------------------------------------------
		// render the upper most bar
		$op = $this->render_library->render_toplink(false);
		$this->template->write('toplink',$op);

		//-----------------------------------------------
		//render header ads
		$this->load->model('ads_model');
		$tmp = $this->ads_model->get(array('dimensions'=>'h-ad','category'=>'published'),'position','desc');

		$ads = array('ads'=>array($tmp[0]));


		//-----------------------------------------------
		//render navigation menu
		$this->config->load('nav');
		$data = array(
					'nav'	=>	$this->config->item('nav'),
					'ads'=>array($tmp[0],$tmp[1])
				);

		$op = $this->render_library->render_header($data);
		$this->template->write('header',$op);


		//-----------------------------------------------
		//render footer ads & copywrite
		$op = $this->render_library->render_footer(false);
		$this->template->write('footer',$op);
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
