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
					'render_right'=>$tmp3,
					'ethnicity'	=> $this->config->item('ethnicity'),
				);


		$op = $this->load->view('site/featured.php',$data,true);
		$this->template->write('mainContents',$op);

		$this->template->add_js(JSPATH.'search.js');
		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	/**
	 * Search Featured models
	 *
	 * @param string (search parameter) , string (search value)
	 * @return string (html div)
	 */
	public function search($key=null,$val=null){

		if( ($key==null) || ($val==null) ){
			$this->load->view('site/featured_search.php',array(
																'featured' => false,
																'pagination' => false
																)
															);

		}

		$featured = $this->featured_model->get(array($key=>urldecode($val)));

		$this->load->helper('utilites_helper');

		if($featured){
		foreach($featured as $key=>$val){

			//--------------------------------------
			$full_path = dirname(BASEPATH).'/'.FEATUREDPATH.gen_folder_name($val->name).'/01';	//1st folder of imgs of the featuerd model

			$imgs = scandir($full_path);									//imgs in that folder

			$config['image_library']	= 'gd2';



			$config['source_image']		= FEATUREDPATH.gen_folder_name($val->name).'/01/'.$imgs[2];		//1st img of the 1st folder
			

			$config['new_image'] 		= $full_path.'/thumbs/'.$imgs[2];		//thumbs of that img 
			$config['thumb_marker']		= '';


			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width'] 			= 323;
			$config['height'] 			= 152;

			$this->load->library('image_lib', $config);

			if ( ! $this->image_lib->resize()){
			    echo $this->image_lib->display_errors();
			}			
			//--------------------------------------

			$val->thumbs = FEATUREDPATH.gen_folder_name($val->name).'/01/thumbs/'.$imgs[2];
		}
		}


$this->load->library('pagination');

$config['base_url'] = base_url().'featured';
$config['total_rows'] = count($this->featured_model->get());
$config['per_page'] = 6;

$config['prev_tag_open'] = '<a href="#"><img src="'.IMGSPATH.'prev.png" alt="Previous" />';
$config['prev_tag_close'] = '</a>';

$config['next_tag_open'] = '<a href="#"><img src="'.IMGSPATH.'next.png" alt="Next" />';
$config['next_tag_close'] = '</a>';

$config['full_tag_open'] = '<div class="pagina">';
$config['full_tag_close'] = '</div>';



$this->pagination->initialize($config);

$pagination =  $this->pagination->create_links();


		$this->load->view('site/featured_search.php',array(
															'featured' => $featured,
															'pagination' => $pagination
															)
														);
	}
}

/* End of file featured.php */
/* Location: ./application/controllers/site/featured.php */
