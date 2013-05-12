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


		/**
		 * turn cache on for if not going into admin area
		 */
		if(!in_array('admin', $this->uri->segment_array())){

		   $this->output->cache(60*24*365);
		   $this->db->cache_on();


		/**
		 * clear cache if going into admin area
		 */
		}else{

		   $this->load->helper('file');

		   $path = dirname(BASEPATH).'/application/';
		   $index_html = $path.'index.html';

		   delete_files($path.'cache', TRUE);
		   $this->db->cache_delete_all();


		   //reenter the forbidden page    
		   copy($path.'index.html', $path.'cache/index.html');

		}

	}



	/**
	 * Generates the basic skeleton of the site's webpage.
	 * Is same for every page on the SITE
	 */
	public function render_skeleton(){
		$this->template->set_template('site');

		//add right featured links vertical slider jquery
		$this->template->add_js(JSPATH.'my_slider.js');

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
