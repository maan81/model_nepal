<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  Search controller
 */
class Search extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('events_model');
	}

	public function index(){

		$this->render_skeleton();


		//-----------------------------------------------

		$this->load->model('ads_model');

		//get different dimensions of ads 
		$tmp = $this->ads_model->get(array('dimensions'=>'fullbanner','category'=>'published'));
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense','category'=>'published'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');

		//---------------------------------------------
		//get the featured links
		$this->load->model('flinks_model');
		$flinks = $this->flinks_model->get();

		$data = array(
					'add'			=>	$tmp[0],
					'add2'			=>	$tmp2,
					'render_right'	=>	$tmp3,
					'flinks'		=>	$flinks,
				);




		$op = $this->load->view('site/search.php',$data,true);
		$this->template->write('mainContents',$op);

		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}

}

/* End of file search.php */
/* Location: ./application/controllers/site/search.php */
