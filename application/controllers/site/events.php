<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Events extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('events_model');
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

		$events = $this->events_model->get();

		$this->load->config('ethnicity');
		$data = array(
					'add'		=>	$tmp[0],
					'add2'		=>	$tmp2,
					'event'	=> array(
										'img'	=>	'm4/m4.jpg',
										'url'	=>	'#'
									),
					'events'	=> $events,
					'render_right'=>$tmp3,
					'ethnicity'	=> $this->config->item('ethnicity'),
				);


		$op = $this->load->view('site/events.php',$data,true);
		$this->template->write('mainContents',$op);

		$this->template->add_js(JSPATH.'events_search.js');
		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	/**
	 * Search events
	 *
	 * @param string (search parameter) , string (search value)
	 * @return string (html div)
	 */
	public function search($key=null,$val=null){

		if( ($key==null) || ($val==null) ){
			$this->load->view('site/events_search.php',array(
																'events' => false,
																'pagination' => false
																)
															);
			return;

		}

		$events = $this->events_model->get(array($key=>urldecode($val)));

		$this->load->helper('utilites_helper');

		if($events){
		foreach($events as $key=>$val){

			//--------------------------------------
			//folder of imgs of the event
			$full_path = dirname(BASEPATH).'/'.EVENTSPATH;	

			//create thumbs folder if reqd.
			make_dir($full_path.'/'.gen_folder_name($val->title),'thumbs');

			$full_path .= gen_folder_name($val->title);

			//imgs in that folder
			$imgs = scandir($full_path);								

			//1st img of the 1st folder
			foreach($imgs as $k=>$v){
				if($v!='.' && $v!='..' && $v!='thumbs' ){
					$preview_img = $v;
					break;
				}
			}
			$config['source_image']		= EVENTSPATH.gen_folder_name($val->title).'/'.$preview_img;		
			
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

			$val->thumbs = EVENTSPATH.gen_folder_name($val->title).'/thumbs/'.$preview_img;
		}
		}


		//------------------------------------------
		//pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url().'events';
		$config['total_rows'] = count($this->events_model->get());
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


		$this->load->view('site/events_search.php',array(
															'events' => $events,
															'pagination' => $pagination
															)
														);
	}


	/**
	 * Display selected event's preview imgs
	 * @param int [model id]
	 */
	private function _disp_gallery($model_id){
	}


	/**
	 *  The selected event
	 *  @param int[event id], int[selected img id]
	 *  @return void
	 */
	public function get($event_id=null,$img=null){
		//redirect to event search if not specified
		if($event_id==null){
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

//		//------------------------------------------------
//
//		$this->load->helper('visitors_count_helper');
//
//		set_count_visitors(array(
//								'type'	  => 'events',
//								'model_id'=> $event_id)
//							);
//
//		//------------------------------------------------

		//$events = $this->events_model->get(array('id' => $event_id));
		$events = $this->events_model->get(array('id' => $event_id));

		$events = $this->event_imgs($events[0],$img);

		//------------------------------------------------

		
		$data = array(
					'events'		=>	$events,
					'render_right'	=>	$tmp3,
					//'img_links'		=> 	$img_links,
					'add2'			=>	$tmp2,
					);

		$op = $this->load->view('site/events_selected.php',$data,true);
		$this->template->write('mainContents',$op);

		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}



	/**
	 *  Set the the currently displaying img & the next & previous images the event
	 *  @param object[event], int[currently displayed img]
	 *  @return object[configured event object]
	 */
	private function event_imgs($event=null,$img=null){

		if($event==null)
			return false;


		//--------------------------------------
		$this->load->helper('utilites_helper');
		$this->load->library('image_lib');
		$event->thumbs=array();


		//event's folders
		$folder = dirname(BASEPATH).'/'.EVENTSPATH.gen_folder_name($event->title);



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
				$event->cur_img = base_url().EVENTSPATH.gen_folder_name($event->title).'/'.$v;

				//previous img link
				if($count>1){
					$event->prev = site_url('events/get/'.$event->id.'/'.($count-1));
				}

				//next img link
				if($count<count($imgs)-3){
					$event->next = site_url('events/get/'.$event->id.'/'.($count+1));
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


			//thumbs & links of the other imgs event
			array_push($event->thumbs,
						array(
								'img'=> base_url().EVENTSPATH.gen_folder_name($event->title).'/thumbs/'.$v,
								'link'=>site_url('events/get/'.$event->id.'/'.($count)),
							)
						);	
		}		

		return $event;
	}
}

/* End of file events.php */
/* Location: ./application/controllers/site/events.php */
