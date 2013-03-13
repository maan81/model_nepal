<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Featured extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('featured_model');
	}

	public function index(){



		$this->template->set_template('site');
		

		//-----------------------------------------------
		$op = $this->render_library->render_toplink(false);
		$this->template->write('toplink',$op);

		//-----------------------------------------------
		$this->load->model('ads_model');
		
		$tmp = $this->ads_model->get(array('dimensions'=>'h-ad'));
		$ads = array('ads'=>array($tmp[0]));

		$this->config->load('nav');
		$data = array(
					'nav'	=>	$this->config->item('nav'),
					'ads'=>array($tmp[0],$tmp[1])
				);

		$op = $this->render_library->render_header($data);
		$this->template->write('header',$op);


		//-----------------------------------------------
		$op = $this->render_library->render_footer(false);
		$this->template->write('footer',$op);

		//-----------------------------------------------

		$tmp = $this->ads_model->get(array('dimensions'=>'fullbanner'));
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads'));

		$featured = $this->featured_model->get();

//echo '<pre>';
//print_r($featured);
//die;
		$this->load->config('ethnicity');
		$data = array(
					'add'		=>	$tmp[0],
					'add2'		=>	$tmp2,
					'subject'	=> array(
										'img'	=>	'm4/m4.jpg',
										'url'	=>	'#'
									),
					'featured'	=> $featured,
					'render_right'	=>$tmp3,
					'ethnicity'	=> $this->config->item('ethnicity'),
				);


		$op = $this->load->view('site/featured.php',$data,true);
		$this->template->write('mainContents',$op);


		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();


	}

}

/* End of file featured.php */
/* Location: ./application/controllers/site/featured.php */
