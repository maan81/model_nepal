<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Subjects extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('subjects_model');
	}

	public function index(){

		$this->render_skeleton();

		//-----------------------------------------------

		$this->load->model('ads_model');


		//$tmp  = $this->ads_model->get(array('dimensions'=>'fullbanner','category'=>'published'));
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense','category'=>'published'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');

		$subjects = $this->subjects_model->get(false,array(
														'order_by'=>array(
																		'coln'=>'name',
																		'dir'=>'asc')
														)
												);

		//---------------------------------------------
		//get the featured links
		$this->load->model('flinks_model');
		$flinks = $this->flinks_model->get();

		//-----------------------------------------------
		//get the date's dropdown
		$this->load->helper('date_helper');
		$date_dropdown = date_dropdown();		

		//-----------------------------------------------

		$this->load->config('ethnicity');
		$data = array(
					//'add'		=>	$tmp[0],
					'add2'		=>	$tmp2,
					'subject'	=> array(
										'img'	=>	'm4/m4.jpg',
										'url'	=>	'#'
									),
					'subjects'	=> $subjects,
					'render_right'=>$tmp3,
					'flinks'	=>	$flinks,
					'ethnicity'	=> $this->config->item('ethnicity'),
					'date_dropdown'	=>	$date_dropdown,
				);


		$op = $this->load->view('site/subjects.php',$data,true);
		$this->template->write('mainContents',$op);

		//---------------------------------------------
		//generate meta tags
		$meta = array(
		        array('name' => 'keywords', 'content' => 'nepal, college, model'),
		        array('name' => 'description', 'content' => 'College Models in Nepal'),
		        array('name' => 'author', 'content' => 'The Fashion Plus'),
		    );

		$this->template->add_meta($meta);

		//-----------------------------------------------
		$this->template->add_js(JSPATH.'default_search.js');
		$this->template->add_js(JSPATH.'subjects_search.js');
		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	/**
	 * Search Subjects
	 *
	 * @param string (search parameter) , string (search value)
	 * @return string (html div)
	 */
	public function search(){
		$data = $this->input->get();
		$key = $data['key'];$val=$data['val'];$get_id = $data['page'];

		$this->load->config('search');
		if( ($key==null) || ($val==null) ){
			$subjects_count = count($this->subjects_model->get());
			$subjects = $this->subjects_model->corrected_get(	false,
													array(	'order_by'=> array(
																			'coln'=>'name',
																			'dir'=>'asc'
																			)
														)
												);
		
		}else{
			$subjects_count = count($this->subjects_model->get(array($key=>urldecode($val))));
			$subjects = $this->subjects_model->corrected_get(
													array(	$key	  => urldecode($val),
														), 
													array(	'order_by'=> array(
																			'coln'=>'name',
																			'dir'=>'asc'
																			),
															'limit'	=> array(
																	'size'=>$this->config->item('search_per_page'),
																	'start'=>$get_id,
																	),
														)
													);
		}

		$this->load->helper('utilites_helper');

		//array to hold search results
		$subjects_search_results=array();

		if($subjects){
		foreach($subjects as $key=>$val){

			//--------------------------------------
			//folder of imgs of the subject
			$full_path = dirname(BASEPATH).'/'.SUBJECTSPATH;	

			//create thumbs folder if reqd.
			make_dir($full_path.'/'.gen_folder_name($val->name),'thumbs');

			$full_path .= gen_folder_name($val->name);

			//imgs in that folder
			$imgs = scandir($full_path);								

			//1st img of the 1st folder
			foreach($imgs as $k=>$v){
				if($v!='.' && $v!='..' && $v!='thumbs' ){
					$preview_img = $v;
					break;
				}
			}
			$config['source_image']		= SUBJECTSPATH.gen_folder_name($val->name).'/'.$preview_img;		
			
			//thumbs of that img 
			$config['new_image'] 		= $full_path.'/thumbs/'.$preview_img;		

			
			$config['thumb_marker']		= '';
			$config['image_library']	= 'gd2';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width'] 			= 323;
			$config['height'] 			= 152;

			$this->load->library('image_lib', $config);

			if ( ! $this->image_lib->resize()){
			    echo $this->image_lib->display_errors();
			}			
			//--------------------------------------

			$val->thumbs = SUBJECTSPATH.gen_folder_name($val->name).'/thumbs/'.$preview_img;


			//add search results into the array holding search results
			array_push(	$subjects_search_results, 
						array(
								'link'	=> $val->link,
								'id'	=> $val->id
							)
					);

		}
		}

		//add search results into the session.
		$this->session->set_userdata('subjects_search_results',$subjects_search_results);

		//------------------------------------------
		//pagination
		$this->load->library('pagination');

		$config = array(
					'base_url' 		=> site_url('models'),
					'total_rows' 	=> $subjects_count,
					'per_page' 		=> $this->config->item('search_per_page'),
					'cur_page' 		=> $get_id,

					'prev_tag_open' => '<a href="#">',
					'prev_link' 	=> '<img src="'.IMGSPATH.'prev.png" alt="Previous" />',
					'prev_tag_close'=> '</a>',

					'next_tag_open' => '<a href="#">',
					'next_link' 	=> '<img src="'.IMGSPATH.'next.png" alt="Next" />',
					'next_tag_close'=> '</a>',

					'full_tag_open' => '<div class="pagina">',
					'full_tag_close'=> '</div>',
				);
		//------------------------------------------


		$this->pagination->initialize($config);

		$pagination =  $this->pagination->create_links();


		$this->load->view('site/subjects_search.php',array(
															'subjects' => $subjects,
															'pagination' => $pagination
															)
														);
	}


	/**
	 * Display selected subject's preview imgs
	 * @param int [model id]
	 */
	private function _list_imgs($model_id){

		$this->render_skeleton();

		//-----------------------------------------------

		$this->load->model('ads_model');
		$this->load->model('flinks_model');

		$flinks = $this->flinks_model->get();
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');
		$subjects = $this->subjects_model->get(array('id' => $model_id));

		$updated_subjects = array();
		foreach($subjects as $key=>$val){
			array_push($updated_subjects,$this->subject_imgs($val,1));
		}

		$data = array(
					'subjects'		=>	$updated_subjects,
					'render_right'	=>	$tmp3,
					'flinks'		=>	$flinks,
					//'galleries'		=> 	$galleries,
					//'img_links'		=> 	$img_links,
					//'imgs_preview'	=> 	$imgs_preview,
					);


		$op = $this->load->view('site/subjects_selected_gallery.php',$data,true);

		$this->template->write('mainContents',$op);

		$this->template->add_css(CSSPATH.'/custom.css');
		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	/**
	 *  The selected subject
	 *  @param int[subject id], int[selected img id]
	 *  @return void
	 */
	public function get($subject_link=null,$img=null,$param2=null){
		//redirect to subject search if not specified
		if($subject_link==null || $subject_link=='search'){
			return $this->search($img,$param2);
		}

		//redirect to get the 1st img. if not specified
		if($img==null){
			//return $this->_list_imgs($subject_id);
			redirect($this->uri->uri_string().'/1');
		}

		$this->render_skeleton();

		//-----------------------------------------------

		$this->load->model('ads_model');

		
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense','category'=>'published'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');

		//---------------------------------------------
		//get the featured links
		$this->load->model('flinks_model');
		$flinks = $this->flinks_model->get();

		//------------------------------------------------

		$this->load->helper('visitors_count_helper');

		//set_count_visitors(array(
		//						'type'	  => 'subjects',
		//						'model_id'=> $subject_id)
		//					);

		//------------------------------------------------

		//$subjects = $this->subjects_model->get(array('id' => $subject_id));
		$subjects = $this->subjects_model->corrected_get(array('link' => $subject_link));

		$subjects = $this->subject_imgs($subjects[0],$img);

		//------------------------------------------------

		
		$data = array(
					'subjects'		=>	$subjects,
					'render_right'	=>	$tmp3,
					'flinks'		=>	$flinks,
					//'img_links'	=> 	$img_links,
					'add2'			=>	$tmp2,
					);

		$op = $this->load->view('site/subjects_selected.php',$data,true);
		$this->template->write('mainContents',$op);

		//---------------------------------------------
		//generate meta tags
		$meta = array(
		        array('name' => 'keywords', 'content' => 'nepal, college, model'),
		        array('name' => 'description', 'content' => 'College Models in Nepal'),
		        array('name' => 'description', 'content' => $subjects->name),
		        array('name' => 'author', 'content' => 'The Fashion Plus'),
		    );

		$this->template->add_meta($meta);

		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}



	/**
	 *  Set the the currently displaying img & the next & previous images the subject
	 *  @param object[subject], int[currently displayed img]
	 *  @return object[configured subject object]
	 */
	private function subject_imgs($subject=null,$img=null){

		if($subject==null)
			return false;


		//--------------------------------------
		$this->load->helper('utilites_helper');
		$this->load->library('image_lib');
		$subject->thumbs=array();


		//subject's folders
		$folder = dirname(BASEPATH).'/'.SUBJECTSPATH.gen_folder_name($subject->name);



		//imgs in that folder
		$imgs = scandir($folder);	

		//get & process the img.
		$count=0;
		foreach($imgs as $k=>$v){
			if($v=='.' || $v=='..' || $v=='thumbs'){
				continue;
			}

			$count++;

			//the current selected img
			if($count==$img){
				$subject->cur_img = base_url().SUBJECTSPATH.gen_folder_name($subject->name).'/'.$v;

				$dim = getimagesize($subject->cur_img);
				if($dim[0]>$dim[1]){
					$img_type = 'landscape';
				}else{
					$img_type = 'potrait'; 
				}

				$subject->img_type=$img_type;

				//previous-next subjects' link
				$subject = $this->prev_next($subject);
			}
			


			//the generation of thumbs of imgs ...

			$config['source_image']		= $folder.'/'.$v;			//img
			$config['new_image'] 		= $folder.'/thumbs/'.$v;	//thumbs of that img 

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

			$dim = getimagesize($folder.'/'.$v);
			if($dim[0]>$dim[1]){
				$img_type = 'landscape';
			}else{
				$img_type = 'potrait'; 
			}

			//thumbs & links of the other imgs subject
			array_push($subject->thumbs,
						array(
								'img'=> base_url().SUBJECTSPATH.gen_folder_name($subject->name).'/thumbs/'.$v,
								'link'=>site_url('models/'.$subject->link.'/'.($count)),
								'type'=>$img_type
							)
						);	
		}		

		return $subject;
	}


	/**
	 * Set previous-next subject's link
	 */
	private function prev_next($subject){

		$subjects_search_results = $this->session->userdata('subjects_search_results');

		foreach($subjects_search_results as $key=>$val){
			if($subject->id == $val['id']){
				//previous subject's id
				if(array_key_exists(($key-1), $subjects_search_results)){
					$url = site_url('models/'.$subjects_search_results[$key-1]['link']);
					$subject->prev = $url;
				}

				//next subject's id
				if(array_key_exists(($key+1), $subjects_search_results)){
					$url = site_url('models/'.$subjects_search_results[$key+1]['link']);
					$subject->next = $url;
				}

				break;
			}
		}

		return $subject;
	}


}

/* End of file subjects.php */
/* Location: ./application/controllers/site/subjects.php */
