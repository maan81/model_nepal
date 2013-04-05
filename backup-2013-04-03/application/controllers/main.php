<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

	public function __construct(){
		parent::__construct();
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
//echo '<pre>';
//print_r($tmp);
//die;
//echo '<pre>';
//print_r($tmp[0]);die;

		$this->config->load('nav');
		$data = array(
					'nav'	=>	$this->config->item('nav'),
					'ads'=>array($tmp[0],$tmp[1])
				);
//echo '<pre>';		
//print_r($data);die;
		$op = $this->render_library->render_header($data);
		$this->template->write('header',$op);


		//-----------------------------------------------
		$op = $this->render_library->render_footer(false);
		$this->template->write('footer',$op);




		//-----------------------------------------------
		$tmp = $this->ads_model->get(array('dimensions'=>'fullbanner'));
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads'));

		//-----------------------------------------------
		$this->load->model('featured_model');
		$this->load->helper('utilites_helper');

		$featured_data = $this->featured_model->get();
		$featured = array();
		$count=0;
		foreach($featured_data as $key=>$val){
			//$featured[$count++] = get_img($val,'01');

			$tmp4 = get_img($val,'01');
//print_r($tmp);
			$featured[$count++] = array(
									'img'	=> $tmp4['cur_img'],
									//'title'	=>,
									//'desc'	=>,
									'model'	=>$val,
									'link'	=>$tmp4['cur'],
								);
		};

		//---------------------------------------------

		$this->load->model('news_model');
		$news = $this->news_model->get();
		//---------------------------------------------


//echo '<pre>';
//print_r($featured);
//print_r($img_links);
//die;

		$data = array(
					'add'		=>	$tmp[0],
					'add2'		=>	$tmp2,
					'subject'	=> array(
										'img'	=>	'm4/m4.jpg',
										'url'	=>	'#'
									),
					'featured'	=> $featured,
/*					'featured' 	=> array(
										0 	=> array(
													'img'	=> 'first_model/01/m1.jpg',
													'title'	=> 'The Night',
													'desc'	=> 'Top Cat! The most effectual Top Cat! Who$#39;s intellectual close friends get to call him T.C., providing it&#39;s with dignity.Top Cat! The indisputable leader!'
												),
										1 	=> array(
													'img'	=> 'first_model/01/m1.jpg',
													'title'	=> 'The Night',
													'desc'	=> 'Top Cat! The most effectual Top Cat! Who$#39;s intellectual close friends get to call him T.C., providing it&#39;s with dignity.Top Cat! The indisputable leader!'
												),
										2 	=> array(
													'img'	=> 'first_model/01/m1.jpg',
													'title'	=> 'The Night',
													'desc'	=> 'Top Cat! The most effectual Top Cat! Who$#39;s intellectual close friends get to call him T.C., providing it&#39;s with dignity.Top Cat! The indisputable leader!'
												),
										3 	=> array(
													'img'	=> 'first_model/01/m1.jpg',
													'title'	=> 'The Night',
													'desc'	=> 'Top Cat! The most effectual Top Cat! Who$#39;s intellectual close friends get to call him T.C., providing it&#39;s with dignity.Top Cat! The indisputable leader!'
												),
										4 	=> array(
													'img'	=> 'first_model/01/m1.jpg',
													'title'	=> 'The Night',
													'desc'	=> 'Top Cat! The most effectual Top Cat! Who$#39;s intellectual close friends get to call him T.C., providing it&#39;s with dignity.Top Cat! The indisputable leader!'
												),
									),
*/					'render_right'	=>$tmp3,
					'news'		=> $news,
				);


		$op = $this->render_library->render_mainContents($data);
		$this->template->write('mainContents',$op);

		$this->template->add_js(JSPATH.'slider.js');
		$this->template->add_css(CSSPATH.'slider.css');
		$this->template->add_js(JSPATH.'my_slider.js');
		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */