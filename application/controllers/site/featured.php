<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Featured extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('featured_model');
	}

	public function index(){

		$this->render_skeleton();

		//-----------------------------------------------

		$this->load->model('ads_model');

		$tmp = $this->ads_model->get(array('dimensions'=>'fullbanner','category'=>'published'));
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense','category'=>'published'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');

		//-----------------------------------------------
		//get the featured in order of their names
		$featured = $this->featured_model->get(false,array(
														'order_by'=>array(
																		'coln'=>'name',
																		'dir'=>'asc')
														)
												);

		$pop_params = array(
							'limit'		=> array('start'=>0,'size'=>5),
							'order_by'	=> array('coln'	=>'profile_viewed','dir'=>'desc'),
						);
		$popular_featured = $this->featured_model->get(false,$pop_params);
		$popular_featured = $this->popular_img($popular_featured);

		$latest_params = array(
							'limit'		=> array('start'=>0,'size'=>1),
							'order_by'	=> array('coln'	=>'id','dir'=>'desc'),
						);
		$latest_featured  = $this->featured_model->get(false,$latest_params);
		$latest_featured = $this->latest_featured($latest_featured);

		//-----------------------------------------------
		//get the date's dropdown
		$this->load->helper('date_helper');
		$date_dropdown = date_dropdown();		

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
					'latest_featured'=> $latest_featured,
					'date_dropdown'	=>	$date_dropdown,
				);


		$op = $this->load->view('site/featured.php',$data,true);
		$this->template->write('mainContents',$op);

		//---------------------------------------------
		//generate meta tags
		$meta = array(
		        array('name' => 'keywords', 'content' => 'nepal, college, featured models'),
		        array('name' => 'description', 'content' => 'College Featured Models of Nepal'),
		        array('name' => 'author', 'content' => 'The Fashion Plus'),
		    );
		$this->template->add_meta($meta);


		$this->template->add_js(JSPATH.'search.js');
		$this->template->add_js(JSPATH.'my_slider.js');
		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	/**
	 * Resize img. to display on latest ing & its links.
	 * @param array of object of latest models
	 * @return array of objects of latest models with formatted.
	 */
	private function latest_featured($latest_featured){

		//folder of imgs of the featured model
		$full_path = dirname(BASEPATH).'/'.FEATUREDPATH.gen_folder_name($latest_featured[0]->name);	

		//imgs in that folder
		$search_img = 'search_img.jpg';


		$latest_featured[0]->latest_img = base_url().FEATUREDPATH.gen_folder_name($latest_featured[0]->name).'/'.$search_img;
		$latest_featured[0]->link 	 =  site_url('featured/'.$latest_featured[0]->id);


		//set empty if no suitable img found
		if(!isset($latest_featured[0]->latest_img)){
			$latest_featured[0]->latest_img = '';
		}

		return $latest_featured;		
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
			$full_path = dirname(BASEPATH).'/'.FEATUREDPATH.gen_folder_name($sel_featured->name);	

			//create thumbs folder inside the gallery folder if reqd.
			make_dir($full_path,'thumbs');

			//imgs in that folder
			$popular_img = 'popular_img.jpg';


			$sel_featured->popular_img = base_url().FEATUREDPATH.gen_folder_name($sel_featured->name).'/'.$popular_img;
			$sel_featured->link 	 =  site_url('featured/'.$sel_featured->id);


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

		$featured = $this->featured_model->get(
												array(	$key	  => urldecode($val),
													), 
												array(	'order_by'=> array(
																		'coln'=>'name',
																		'dir'=>'asc'
																		)
													)
												);

		$this->load->helper('utilites_helper');

		if($featured){
		foreach($featured as $key=>$val){

			//--------------------------------------
			//search imgs of the selected featured model
			$full_path = dirname(BASEPATH).'/'.FEATUREDPATH.gen_folder_name($val->name).'/search_img.jpg';	

		/*
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
		*/
			
			$val->thumbs = base_url().FEATUREDPATH.gen_folder_name($val->name).'/search_img.jpg';
		}
		}


		$this->load->library('pagination');

		$config['base_url'] = base_url().'featured';
		$config['total_rows'] = count($this->featured_model->get());
		$config['per_page'] = 100000;

		$config['prev_tag_open'] = '<a href="#"><img src="'.IMGSPATH.'prev.png" alt="Previous" title="Previous" />';
		$config['prev_tag_close'] = '</a>';

		$config['next_tag_open'] = '<a href="#"><img src="'.IMGSPATH.'next.png" alt="Next" title="Next" />';
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
		//goto search featured if no featured id is present
		if($model==null || $model=='search'){
			return $this->search($gallery,$img);
		}

		//goto listing 1st gallery's img's preview if no gallery 
		//and/or imgs is specified
		if($img==null){
			return $this->_disp_gallery($model,$gallery);
		}
		//-----------------------------------------------

		$this->render_skeleton();

		//-----------------------------------------------

		$this->load->model('ads_model');

		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense','category'=>'published'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');
		$rtbbox = $this->ads_model->get(array('dimensions'=>'rtbbox','category'=>'published'));
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
					'rtbbox'		=>  $rtbbox,
					'add2'			=>	$tmp2,
					);

		$img_dim = getimagesize($img_links['cur_img']);
		//landscape img
		if($img_dim[0] > $img_dim[1]){
			$op = $this->load->view('site/featured_selected_horizontal.php',$data,true);

		//potrait img
		}else{
			$op = $this->load->view('site/featured_selected.php',$data,true);
		}
		$this->template->write('mainContents',$op);

		//---------------------------------------------
		//generate meta tags
		$meta = array(
		        array('name' => 'keywords', 'content' => 'nepal, college, model'),
		        array('name' => 'description', 'content' => 'College Models Events in Nepal'),
		        array('name' => 'description', 'content' => $featured[0]->name),
		        array('name' => 'author', 'content' => 'The Fashion Plus'),
		    );

		$this->template->add_meta($meta);

		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	/**
	 * Display selected gallery's preview imgs
	 * @param int [model id], string [gallery id] 
	 */
	private function _disp_gallery($model,$gallery){
		$this->render_skeleton();

		//-----------------------------------------------

		$this->load->model('ads_model');

		
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');
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

			if ( ! $this->image_lib->resize()){
			    echo $this->image_lib->display_errors();
			}			

			$img_dim = getimagesize(base_url().$config['source_image']);
			//landscape img
			if($img_dim[0] > $img_dim[1]){
				array_push(	$imgs_preview['landscape'],
							array('img' => FEATUREDPATH.gen_folder_name($featured[0]->name).'/'.$gallery.'/thumbs/'.$v,
								  'link'=> site_url('featured/'.$featured[0]->id.'/'.$gallery.'/'.$count_link)
							  )
						);

			//potrait img
			}else{
				array_push(	$imgs_preview['potrait'],
							array('img'=>FEATUREDPATH.gen_folder_name($featured[0]->name).'/'.$gallery.'/thumbs/'.$v,
								  'link'=>site_url('featured/'.$featured[0]->id.'/'.$gallery.'/'.$count_link)
								)
							);
			}

			$count_link++;
		}

		//--------------------------------------


		//-----------------------------------------------
		//
		//$this->load->helper('utilites_helper');
		//$img_links = get_img($featured[0],$gallery,$img);
		////-----------------------------------------------

		
		$data = array(
					'featured'		=>	$featured,
					'render_right'	=>	$tmp3,
					'galleries'		=> 	$galleries,
					//'img_links'		=> 	$img_links,
					'imgs_preview'	=> 	$imgs_preview,
					);

		$op = $this->load->view('site/featured_selected_gallery.php',$data,true);

		$this->template->write('mainContents',$op);

		$this->template->add_css(CSSPATH.'/custom.css');

		//---------------------------------------------
		//generate meta tags
		$meta = array(
		        array('name' => 'keywords', 'content' => 'nepal, college, model'),
		        array('name' => 'description', 'content' => 'College Models Events in Nepal'),
		        array('name' => 'description', 'content' => $featured[0]->name),
		        array('name' => 'author', 'content' => 'The Fashion Plus'),
		    );

		$this->template->add_meta($meta);

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

			if($val === "." || $val == ".." || is_dir($val) || $val=='thumbs')
				continue;
			

			$is_dir = dirname(BASEPATH).'/'.FEATUREDPATH.gen_folder_name($featured->name).'/'.$val;

			if(is_dir($is_dir)){
				$albums[$val] = dirname(BASEPATH).'/'.FEATUREDPATH.gen_folder_name($featured->name).'/'.$val;
			}
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
