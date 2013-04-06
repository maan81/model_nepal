<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->render_skeleton();

		//-----------------------------------------------

		$this->load->model('ads_model');

		//get different dimensions of banner

		$tmp = $this->ads_model->get(array('dimensions'=>'fullbanner','category'=>'published'));
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense','category'=>'published'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');


		//-----------------------------------------------
		//get the featured data
		$this->load->model('featured_model');
		$this->load->helper('utilites_helper');

		$featured_data = $this->featured_model->get();
		$featured = array();
		$count=0;
		foreach($featured_data as $key=>$val){

			$tmp4 = get_profile_img($val);

			$featured[$count++] = array(
									'img'	=> $tmp4['cur_img'],
									'model'	=>$val,
									'link'	=>$tmp4['cur'],
								);
		};

		//sort featured to put latest at the first
		krsort($featured);


		//---------------------------------------------
		//get the news to be shown in the lower part
		$this->load->model('news_model');
		$news = $this->news_model->get();

		//---------------------------------------------



		$data = array(
					'add'		=>	$tmp[0],
					'add2'		=>	$tmp2,
					'subject'	=> array(
										'img'	=>	'm4/m4.jpg',
										'url'	=>	'#'
									),
					'featured'	=> $featured,
					'render_right'	=>$tmp3,
					'news'		=> $news,
				);



		//render
		$op = $this->render_library->render_mainContents($data);
		$this->template->write('mainContents',$op);

		$this->template->add_js(JSPATH.'slider.js');
		$this->template->add_js(JSPATH.'my_slider.js');
		$this->template->add_css(CSSPATH.'slider.css');
		//-----------------------------------------------
		//-----------------------------------------------

		$this->template->render();
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */