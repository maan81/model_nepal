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

		//-----------------------------------------------
		$featured = $this->featured_model->get();

		$pop_params = array(
							'limit'		=> array('start'=>0,'size'=>5),
							'order_by'	=> array('coln'	=>'profile_viewed','dir'=>'desc'),
						);
		$popular_featured = $this->featured_model->get(false,$pop_params);
		$popular_featured = $this->popular_img($popular_featured);
		//-----------------------------------------------
		
		$this->load->config('ethnicity');
		$data = array(
					'add'			=>	$tmp[0],
					'add2'			=>	$tmp2,
					'subject'		=> 	array(
											'img'	=>	'm4/m4.jpg',
											'url'	=>	'#'
										),
					'featured'		=>	$featured,
					'render_right'	=>	$tmp3,
					'ethnicity'		=> 	$this->config->item('ethnicity'),
					'popular_featured'=>$popular_featured,
				);


		$op = $this->load->view('site/featured.php',$data,true);
		$this->template->write('mainContents',$op);

		$this->template->add_js(JSPATH.'search.js');
		$this->template->add_js(JSPATH.'my_slider.js');
		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	/**
	 * Resize img. to display on popular links.
	 * @param array of objects of popular models
	 * @return array of objects of popular models with resized img
	 */
	private function popular_img($featured){
		//load image ligrary
		$this->load->library('image_lib');

		foreach($featured as $sel_featured){
			//folder of imgs of the featured model
			$full_path = dirname(BASEPATH).'/'.FEATUREDPATH.gen_folder_name($sel_featured->name).'/01';	

			//create thumbs folder inside the gallery folder if reqd.
			make_dir($full_path,'thumbs');

			//imgs in that folder
			$imgs = scandir($full_path);

			foreach($imgs as $k=>$v){
				if($v=='.' || $v=='..' || $v=='thumbs' ){
					continue;
				}


				//the current original img
				$config['source_image']		= FEATUREDPATH.gen_folder_name($sel_featured->name).'/01/'.$v;	

				//thumbs of that img 
				$config['new_image'] 		= $full_path.'/thumbs/'.$v;

				$config['image_library']	= 'gd2';
				$config['thumb_marker']		= '';
				$config['create_thumb'] 	= TRUE;
				$config['maintain_ratio'] 	= TRUE;
				$config['width'] 			= 323;
				$config['height'] 			= 152;

				$img_dim = getimagesize(base_url().$config['source_image']);
				
				//dont use landscape img
				if($img_dim[0] > $img_dim[1]){
					continue;
				}

				$sel_featured->popular_img = FEATUREDPATH.gen_folder_name($sel_featured->name).'/01/thumbs/'.$v;


				$this->image_lib->initialize($config);
			//print_r($config);
				if ( ! $this->image_lib->resize()){
				    echo $this->image_lib->display_errors();
				}
				break;			
			}
			$sel_featured->link 	 =  site_url('featured/get/'.$sel_featured->id);

			//set empty if no suitable img found
			if(!isset($sel_featured->popular_img)){
				$sel_featured->popular_img = '';
			}
		}
		return $featured;		
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
			return;

		}

		$featured = $this->featured_model->get(array($key=>urldecode($val)));

		$this->load->helper('utilites_helper');

		if($featured){
		foreach($featured as $key=>$val){

			//--------------------------------------
			//1st folder of imgs of the featured model
			$full_path = dirname(BASEPATH).'/'.FEATUREDPATH.gen_folder_name($val->name).'/01';	

			//create thumbs folder if reqd.
			make_dir($full_path,'thumbs');

			$imgs = scandir($full_path);									//imgs in that folder
			foreach($imgs as $k=>$v){
				if($v!='.' && $v!='..' && $v!='thumbs' ){
					$preview_img = $v;
					break;
				}
			}

			$config['image_library']	= 'gd2';



			$config['source_image']		= FEATUREDPATH.gen_folder_name($val->name).'/01/'.$preview_img;		//1st img of the 1st folder
			

			$config['new_image'] 		= $full_path.'/thumbs/'.$preview_img;		//thumbs of that img 
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

			$val->thumbs = FEATUREDPATH.gen_folder_name($val->name).'/01/thumbs/'.$preview_img;
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




	public function get($model=null,$gallery='01',$img=null){
		if($model==null){
			return $this->search();
		}

		//disp selected gallery's preview imgs
		if($img==null){
			//redirect(current_url().'/1');
			return $this->_disp_gallery($model,$gallery);
		}
		//-----------------------------------------------

		$this->template->set_template('site');

		//------------------------------------------------
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
		$this->load->model('ads_model');
		
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads'));
		$featured = $this->featured_model->get(array('id' => $model));


		//================
		$galleries = array();

		foreach($featured as $key=>$val){
	    	$imgs = array(
		    			'gallery_cover'	=> $this->gallery_cover($val)
					);

	        array_push($galleries,$imgs);
		}
		//=================

		//-----------------------------------------------

		$this->load->helper('visitors_count_helper');

		set_count_visitors(array(
								'type'	  => 'featured',
								'model_id'=> $model)
							);

		//-----------------------------------------------

		$this->load->helper('utilites_helper');
		$img_links = get_img($featured[0],$gallery,$img);
		//-----------------------------------------------

		
		$data = array(
					'featured'		=>	$featured,
					'render_right'	=>	$tmp3,
					'galleries'		=> 	$galleries,
					'img_links'		=> 	$img_links,
					);
//echo '<pre>';
//print_r($data);
//echo '</pre>';
//print_r( getimagesize($img_links['cur_img']));
//echo '<img src="'.$img_links['cur_img'].'" alt="" height="600" width="400" />';
//die;
		$img_dim = getimagesize($img_links['cur_img']);
		//landscape img
		if($img_dim[0] > $img_dim[1]){
			$op = $this->load->view('site/featured_selected_horizontal.php',$data,true);

		//potrait img
		}else{
			$op = $this->load->view('site/featured_selected.php',$data,true);
		}
		$this->template->write('mainContents',$op);

		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	/**
	 * Display selected gallery's preview imgs
	 * @param int [model id], string [gallery id] 
	 */
	private function _disp_gallery($model,$gallery){
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
		$this->load->model('ads_model');
		
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads'));
		$featured = $this->featured_model->get(array('id' => $model));


		//================
		$galleries = array();

		foreach($featured as $key=>$val){
	    	$imgs = array(
		    			'gallery_cover'	=> $this->gallery_cover($val)
					);

	        array_push($galleries,$imgs);
		}
		//=================


//--------------------------------------
//array to keep thumbs
$imgs_preview = array('landscape'=>array(),'potrait'=>array());

//folder of imgs of the featured model
$full_path = dirname(BASEPATH).'/'.FEATUREDPATH.gen_folder_name($featured[0]->name).'/'.$gallery;	

//create thumbs folder inside the gallery folder if reqd.
make_dir($full_path,'thumbs');

//load image ligrary
$this->load->library('image_lib');

//imgs in that folder
$imgs = scandir($full_path);

$count_link=1;
foreach($imgs as $k=>$v){
	if($v=='.' || $v=='..' || $v=='thumbs' ){
		continue;
	}

	//the current original img
	$config['source_image']		= FEATUREDPATH.gen_folder_name($featured[0]->name).'/'.$gallery.'/'.$v;	

	//thumbs of that img 
	$config['new_image'] 		= $full_path.'/thumbs/'.$v;

	$config['image_library']	= 'gd2';
	$config['thumb_marker']		= '';
	$config['create_thumb'] 	= TRUE;
	$config['maintain_ratio'] 	= TRUE;
	$config['width'] 			= 323;
	$config['height'] 			= 152;

	$this->image_lib->initialize($config);
//print_r($config);
	if ( ! $this->image_lib->resize()){
	    echo $this->image_lib->display_errors();
	}			

	$img_dim = getimagesize(base_url().$config['source_image']);
	//landscape img
	if($img_dim[0] > $img_dim[1]){
		array_push(	$imgs_preview['landscape'],
					array('img' => FEATUREDPATH.gen_folder_name($featured[0]->name).'/'.$gallery.'/thumbs/'.$v,
						  'link'=> site_url('featured/get/'.$featured[0]->id.'/'.$gallery.'/'.$count_link)
					  )
				);

	//potrait img
	}else{
		array_push(	$imgs_preview['potrait'],
					array('img'=>FEATUREDPATH.gen_folder_name($featured[0]->name).'/'.$gallery.'/thumbs/'.$v,
						  'link'=>site_url('featured/get/'.$featured[0]->id.'/'.$gallery.'/'.$count_link)
						)
					);
	}

	$count_link++;
}

//--------------------------------------


//		//-----------------------------------------------
//
//		$this->load->helper('utilites_helper');
//		$img_links = get_img($featured[0],$gallery,$img);
//		//-----------------------------------------------

		
		$data = array(
					'featured'		=>	$featured,
					'render_right'	=>	$tmp3,
					'galleries'		=> 	$galleries,
//					'img_links'		=> 	$img_links,
					'imgs_preview'	=> 	$imgs_preview,
					);
//echo '<pre>';
//print_r($data);
//echo '</pre>';
//print_r( getimagesize($img_links['cur_img']));
//echo '<img src="'.$img_links['cur_img'].'" alt="" height="600" width="400" />';
//die;
		$op = $this->load->view('site/featured_selected_gallery.php',$data,true);

		$this->template->write('mainContents',$op);

		$this->template->add_css(CSSPATH.'/custom.css');
		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	private function gallery_cover($featured=null){
		if($featured==null)
			return false;


		//--------------------------------------
		$this->load->helper('utilites_helper');

		//folders of imgs of the featured model
		$albums = array();


		foreach(scandir(dirname(BASEPATH).'/'.FEATUREDPATH.gen_folder_name($featured->name)) as $key=>$val){
			if($val === "." || $val == "..")
				continue;

			$albums[$val] = dirname(BASEPATH).'/'.FEATUREDPATH.gen_folder_name($featured->name).'/'.$val;
		}

		$this->load->library('image_lib');


		foreach($albums as $key=>$val){
			$full_path = $val;

			//imgs in that folder
			$imgs = scandir($full_path);									

			//create folder for thumbs if reqd
			make_dir($full_path, 'thumbs');

			//1st img of the folder
			$config['source_image']		= $full_path.'/'.$imgs[2];		
			

			$config['new_image'] 		= $full_path.'/thumbs/'.$imgs[2];		//thumbs of that img 
			$config['thumb_marker']		= '';


			$config['image_library']	= 'gd2';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width'] 			= 323;
			$config['height'] 			= 152;

			$this->image_lib->initialize($config);


			if ( ! $this->image_lib->resize()){
			    echo $this->image_lib->display_errors();
			}			

			$val = FEATUREDPATH.gen_folder_name($featured->name).'/'.array_pop(explode('/',$full_path)).'/thumbs/'.$imgs[2];
			$albums[$key] = $val;

		}

		return (object)$albums;
	}
}

/* End of file featured.php */
/* Location: ./application/controllers/site/featured.php */
