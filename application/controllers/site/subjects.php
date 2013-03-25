<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Subjects extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('subjects_model');
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

		$tmp  = $this->ads_model->get(array('dimensions'=>'fullbanner'));
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads'));

		$subjects = $this->subjects_model->get();

		$this->load->config('ethnicity');
		$data = array(
					'add'		=>	$tmp[0],
					'add2'		=>	$tmp2,
					'subject'	=> array(
										'img'	=>	'm4/m4.jpg',
										'url'	=>	'#'
									),
					'subjects'	=> $subjects,
					'render_right'=>$tmp3,
					'ethnicity'	=> $this->config->item('ethnicity'),
				);


		$op = $this->load->view('site/subjects.php',$data,true);
		$this->template->write('mainContents',$op);

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
	public function search($key=null,$val=null){

		if( ($key==null) || ($val==null) ){
			$this->load->view('site/subjects_search.php',array(
																'subjects' => false,
																'pagination' => false
																)
															);
			return;

		}

		$subjects = $this->subjects_model->get(array($key=>urldecode($val)));

		$this->load->helper('utilites_helper');

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
print_r($imgs);

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
		}
		}


		//------------------------------------------
		//pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url().'subjects';
		$config['total_rows'] = count($this->subjects_model->get());
		$config['per_page'] = 6;

		$config['prev_tag_open'] = '<a href="#"><img src="'.IMGSPATH.'prev.png" alt="Previous" />';
		$config['prev_tag_close'] = '</a>';

		$config['next_tag_open'] = '<a href="#"><img src="'.IMGSPATH.'next.png" alt="Next" />';
		$config['next_tag_close'] = '</a>';

		$config['full_tag_open'] = '<div class="pagina">';
		$config['full_tag_close'] = '</div>';
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
	 *  The selected subject
	 *  @param int[subject id], int[selected ing id]
	 *  @return void
	 */
	public function get($subject_id=null,$img=null){
		//redirect to subject search if not specified
		if($subject_id==null){
			return $this->search();
		}

		//redirect to get the 1st img. if not specified
		if($img==null){
			redirect(current_url().'/1');
		}

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
		
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads'));

		//------------------------------------------------

		$this->load->helper('visitors_count_helper');

		set_count_visitors(array(
								'type'	  => 'subjects',
								'model_id'=> $subject_id)
							);

		//------------------------------------------------

		//$subjects = $this->subjects_model->get(array('id' => $subject_id));
		$subjects = $this->subjects_model->corrected_get(array('id' => $subject_id));

		$subjects = $this->subject_imgs($subjects[0],$img);

		//------------------------------------------------

		
		$data = array(
					'subjects'		=>	$subjects,
					'render_right'	=>	$tmp3,
					//'img_links'		=> 	$img_links,
					'add2'			=>	$tmp2,
					);

		$op = $this->load->view('site/subjects_selected.php',$data,true);
		$this->template->write('mainContents',$op);

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

				//previous img link
				if($count>1){
					$subject->prev = site_url('subjects/get/'.$subject->id.'/'.($count-1));
				}

				//next img link
				if($count<count($imgs)-3){
					$subject->next = site_url('subjects/get/'.$subject->id.'/'.($count+1));
				}
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


			//thumbs & links of the other imgs subject
			array_push($subject->thumbs,
						array(
								'img'=> base_url().SUBJECTSPATH.gen_folder_name($subject->name).'/thumbs/'.$v,
								'link'=>site_url('subjects/get/'.$subject->id.'/'.($count)),
							)
						);	
		}		

		return $subject;
	}
}

/* End of file subjects.php */
/* Location: ./application/controllers/site/subjects.php */
