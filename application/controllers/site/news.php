<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class News extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('news_model');
	}

	public function index(){

		$this->render_skeleton();

		//-----------------------------------------------

		$this->load->model('ads_model');

 		$tmp  = $this->ads_model->get(array('dimensions'=>'fullbanner','category'=>'published'));
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense','category'=>'published'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');
		$news = $this->news_model->get();

		//-------------------------------------------------
		$data = array(
					'add'		=>	$tmp[0],
					'add2'		=>	$tmp2,
					//'event'		=> array(
					//					'img'	=>	'm4/m4.jpg',
					//					'url'	=>	'#'
					//				),
					'news'		=> $news,
					'render_right'=>$tmp3,
				);

		$op = $this->load->view('site/news.php',$data,true);
		$this->template->write('mainContents',$op);

		$this->template->add_js(JSPATH.'news_search.js');
		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	/**
	 * Search news
	 *
	 * @param string (search parameter) , string (search value)
	 * @return string (html div)
	 */
	public function search($key=null,$val=null){

		if( ($key==null) || ($val==null) ){
			$this->load->view('site/news_search.php',array(
																'news' => false,
																'pagination' => false
																)
															);
			return;

		}

		$news = $this->news_model->get(array($key=>urldecode($val)));

		$this->load->helper('utilites_helper');

		if($news){
		foreach($news as $key=>$val){

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
	 * List selected event's preview imgs
	 * @param int [model id]
	 */
	private function _list_imgs($model_id){
		$this->render_skeleton();

		//-----------------------------------------------

		$this->load->model('ads_model');

		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','desc');
		$news = $this->news_model->get(array('id' => $model_id));

		$updated_news = array();
		foreach($news as $key=>$val){
			array_push($updated_news,$this->event_imgs($val,1));
		}

		$data = array(
					'news'		=>	$news,
					'render_right'	=>	$tmp3,
//					'galleries'		=> 	$galleries,
//					'img_links'		=> 	$img_links,
//					'imgs_preview'	=> 	$imgs_preview,
					);


//print_r($data);die;
		$op = $this->load->view('site/news_selected_gallery.php',$data,true);
//echo $op;die;
//$op='';
		$this->template->write('mainContents',$op);

		$this->template->add_css(CSSPATH.'/custom.css');
		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	public function event_upcomming($news){

		$this->render_skeleton();

		//-----------------------------------------------

		$this->load->model('ads_model');

		
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense','category'=>'published'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');

		//------------------------------------------------
		$news = $this->event_imgs($news,1);
//print_r($news);die;
		//------------------------------------------------

		$data = array(
					'news'		=>	$news,
					'render_right'	=>	$tmp3,
					//'img_links'		=> 	$img_links,
					'add'			=>	$tmp1[0],
					'add2'			=>	$tmp2,
					);
//print_r($news->img_type);die;

		$op = $this->load->view('site/news_upcomming.php',$data,true);

		$this->template->write('mainContents',$op);

		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();

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

		//----------------------------------------------

		$news = $this->news_model->get(array('id' => $event_id));

		//goto upcomming news function
		if($news[0]->type=='upcomming'){
			return $this->event_upcomming($news[0]);
		}

		//add image & previous & next links
		$news = $this->event_imgs($news[0],$img);

		//------------------------------------------------

		//redirect to get the imgs. of the specified event
		if($img==null){
			return $this->_list_imgs($event_id);
		}

		$this->render_skeleton();

		//-----------------------------------------------

		$this->load->model('ads_model');

		
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense','category'=>'published'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');

		//------------------------------------------------


		$data = array(
					'news'		=>	$news,
					'render_right'	=>	$tmp3,
					//'img_links'		=> 	$img_links,
					'add2'			=>	$tmp2,
					);
//print_r($news->img_type);die;
		if($news->img_type=='potrait'){
			$op = $this->load->view('site/news_selected.php',$data,true);

		}else{
			$op = $this->load->view('site/news_selected_hor.php',$data,true);
		}

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

				$dim = getimagesize($event->cur_img);
				if($dim[0]>$dim[1]){
					$img_type = 'landscape';
				}else{
					$img_type = 'potrait'; 
				}

				$event->img_type=$img_type;

				//previous img link
				if($count>1){
					$event->prev = site_url('news/get/'.$event->id.'/'.($count-1));
				}

				//next img link
				if($count<count($imgs)-3){
					$event->next = site_url('news/get/'.$event->id.'/'.($count+1));
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


			$dim = getimagesize($folder.'/'.$v);
			if($dim[0]>$dim[1]){
				$img_type = 'landscape';
			}else{
				$img_type = 'potrait'; 
			}

			//thumbs & links of the other imgs event
			array_push($event->thumbs,
						array(
								'img'=> base_url().EVENTSPATH.gen_folder_name($event->title).'/thumbs/'.$v,
								'link'=>site_url('news/get/'.$event->id.'/'.($count)),
								'type'=>$img_type
							)
						);	
		}		

		return $event;
	}
}

/* End of file news.php */
/* Location: ./application/controllers/site/news.php */
