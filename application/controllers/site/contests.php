<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Contests extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('contests_model');
	}

	public function index(){

		$this->render_skeleton();

		//-----------------------------------------------
		$this->load->model('ads_model');

		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense','category'=>'published'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');

		$contests = $this->contests_model->get(false,array(
														'order_by'=>array(
																		'coln'=>'title',
																		'dir'=>'asc')
														)
												);
		$contests_slideshow = $this->contests_model->get(array('upcomming'=>'1'),
															array(
																	'order_by'=>array(
																				'coln'=>'title',
																				'dir'=>'asc')
																)
														);
		//---------------------------------------------
		//generate meta tags
		$contests_list = '';
		foreach($contests as $key=>$val){
			$contests_list .= $val->title.', ';
		}
		$meta = array(
		        //array('name' => 'robots', 'content' => 'no-cache'),
		        array('name' => 'keywords', 'content' => 'nepal, college, model, contests'),
		        array('name' => 'description', 'content' => 'College Models Contests in Nepal'),
		        array('name' => 'description', 'content' => $contests_list),
		        array('name' => 'author', 'content' => 'The Fashion Plus'),
		    );
		$this->template->add_meta($meta);

		//-----------------------------------------------
		//get the date's dropdown
		$this->load->helper('date_helper');
		$date_dropdown = date_dropdown();		

		//---------------------------------------------
		//get the featured links
		$this->load->model('flinks_model');
		$flinks = $this->flinks_model->get();

		//-----------------------------------------------

		$this->load->config('ethnicity');
		$this->load->config('eventstype');
		$data = array(
					//'add'				=> $tmp[0],
					'add2'				=> $tmp2,
					'contests'			=> $contests,
					'contests_slideshow'=> $contests_slideshow,
					'render_right'		=> $tmp3,
					'flinks'			=> $flinks,
					'ethnicity'			=> $this->config->item('ethnicity'),
					'date_dropdown'		=> $date_dropdown,
					'types'				=> $this->config->item('eventstype'),
				);


		$op = $this->load->view('site/contests.php',$data,true);
		$this->template->write('mainContents',$op);

		$this->template->add_js(JSPATH.'default_search.js');
		$this->template->add_js(JSPATH.'events_search.js');
		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	/**
	 * Search contests
	 *
	 * @param string (search parameter) , string (search value)
	 * @return string (html div)
	 */
	public function search($key=null,$val=null){
		/*
		if( ($key==null) || ($val==null) ){
			$this->load->view('site/events_search.php',array(
																'events' => false,
																'pagination' => false
																)
															);
			return;

		}
		*/

		if( ($key==null) || ($val==null) ){
			$contests = $this->contests_model->get(	array(	'upcomming'=>'0'), 
													array(	'order_by'=> array(
																			'coln'=>'title',
																			'dir'=>'asc'
																			)
														)
													);
		}else{
			
			$contests = $this->contests_model->get(
													array(	$key	  => urldecode($val),
															'upcomming'=> '0',
														), 
													array(	'order_by'=> array(
																			'coln'=>'title',
																			'dir'=>'asc'
																			)
														)
													);
		}



		$this->load->helper('utilites_helper');

		if($contests){
		foreach($contests as $key=>$val){

			//--------------------------------------
			//folder of imgs of the event
			$full_path = dirname(BASEPATH).'/'.CONTESTSPATH;	
			/*
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
			*/
			$val->thumbs = CONTESTSPATH.gen_folder_name($val->title).'/search_img.jpg';
			if($val->featured=='1'){
				$val->featured = '<img src="'.base_url().IMGSPATH.'featured_events.png" alt="'.$val->title.'" title="'.$val->title.'" class="featured_event" />';
			}else{
				$val->featured = '';
			}
		}
		}


		//------------------------------------------
		//pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url().'events';
		$config['total_rows'] = count($this->contests_model->get());
		$config['per_page'] = 100000;

		$config['prev_tag_open'] = '<a href="#"><img src="'.IMGSPATH.'prev.png" alt="Previous" title="Previous" />';
		$config['prev_tag_close'] = '</a>';

		$config['next_tag_open'] = '<a href="#"><img src="'.IMGSPATH.'next.png" alt="Next" title="Next"/>';
		$config['next_tag_close'] = '</a>';

		$config['full_tag_open'] = '<div class="pagina">';
		$config['full_tag_close'] = '</div>';
		//------------------------------------------


		$this->pagination->initialize($config);

		$pagination =  $this->pagination->create_links();


		$this->load->view('site/contests_search.php',array(
															'contests' => $contests,
															'pagination' => $pagination
															)
														);
	}


	/**
	 * List selected contest's preview imgs
	 * @param int [model id]
	 */
	private function _list_imgs($contest_id){

		$this->render_skeleton();

		//-----------------------------------------------

		$this->load->model('ads_model');
		
		$tmp = $this->ads_model->get(array('dimensions'=>'fullbanner','category'=>'published'));	
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');
		$contests = $this->contests_model->get(array('link' => $contest_id));

		//---------------------------------------------
		//get the featured links
		$this->load->model('flinks_model');
		$flinks = $this->flinks_model->get();
		//---------------------------------------------

		$updated_contests = array();
		foreach($contests as $key=>$val){
			array_push($updated_contests,$this->contests_imgs($val,1));
		}

		$data = array(
					'contests'		=>	$contests,
					'render_right'	=>	$tmp3,
					'flinks'		=> 	$flinks,
					'add'			=>	$tmp[0],
					//'galleries'		=> 	$galleries,
					//'img_links'		=> 	$img_links,
					//'imgs_preview'	=> 	$imgs_preview,
					);

		$op = $this->load->view('site/contests_selected_gallery.php',$data,true);

		$this->template->write('mainContents',$op);

		//---------------------------------------------
		//generate meta tags
		$meta = array(
		        array('name' => 'keywords', 'content' => 'nepal, college, model, events'),
		        array('name' => 'description', 'content' => 'College Models Contests in Nepal'),
		        array('name' => 'description', 'content' => $contests[0]->title),
		        array('name' => 'description', 'content' => $contests[0]->summary),
		        array('name' => 'author', 'content' => 'The Fashion Plus'),
		    );

		$this->template->add_meta($meta);
		$this->template->add_css(CSSPATH.'/custom.css');
		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	public function contest_upcomming($contests){

		$this->render_skeleton();

		//-----------------------------------------------
		$this->load->model('ads_model');
		
		$tmp1 = $this->ads_model->get(array('dimensions'=>'fullbanner','category'=>'published'));
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense','category'=>'published'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');

		//---------------------------------------------
		//get the featured links
		$this->load->model('flinks_model');
		$flinks = $this->flinks_model->get();

		//------------------------------------------------
		$contests = $this->contest_imgs($contests,1);
		//------------------------------------------------

		$data = array(
					'contests'		=>	$contests,
					'render_right'	=>	$tmp3,
					'flinks'		=>	$flinks,
					//'img_links'		=> 	$img_links,
					'add'			=>	$tmp1[0],
					'add2'			=>	$tmp2,
					);

		$op = $this->load->view('site/contests_upcomming.php',$data,true);

		$this->template->write('mainContents',$op);

		//---------------------------------------------
		//generate meta tags
		$this->load->helper('text');
		$meta = array(
		        array('name' => 'keywords', 'content' => 'nepal, college, model, contests'),
		        array('name' => 'description', 'content' => 'College Models Contests in Nepal'),
		        array('name' => 'description', 'content' => $contests->title),
		        array('name' => 'description', 'content' => word_limiter($contests->summary),5),
		        array('name' => 'author', 'content' => 'The Fashion Plus'),
		    );

		$this->template->add_meta($meta);

		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();

	}


	/**
	 *  The selected contest
	 *  @param varchar[contest link], int[selected img id]
	 *  @return void
	 */
	public function get($contests_link=null,$img=null,$param2=null){
		//redirect to event search if not specified
		if($contests_link==null || $contests_link=='search'){
			return $this->search($img,$param2);
		}

		//----------------------------------------------

		$contests = $this->contests_model->get(array('link' => $contests_link));

		//goto upcomming contests function
		if($contests[0]->upcomming=='1'){
			return $this->contest_upcomming($contests[0]);
		}

		//add image & previous & next links
		$contests = $this->contests_imgs($contests[0],$img);

		//------------------------------------------------

		//redirect to get the imgs. of the specified contests
		if($img==null){
			return $this->_list_imgs($contests_link);
		}
die;
		$this->render_skeleton();

		//-----------------------------------------------
		$this->load->model('ads_model');

		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense','category'=>'published'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');
		$rtbbox = $this->ads_model->get(array('dimensions'=>'rtbbox','category'=>'published'));


		//---------------------------------------------
		//get the featured links
		$this->load->model('flinks_model');
		$flinks = $this->flinks_model->get();

		//------------------------------------------------


		$data = array(
					'contests'		=>	$contests,
					'render_right'	=>	$tmp3,
					'flinks'		=>	$flinks,
					//'img_links'		=> 	$img_links,
					'add2'			=>	$tmp2,
					'rtbbox'		=> $rtbbox,
					);

		if($contests->img_type=='potrait'){
			$op = $this->load->view('site/contests_selected.php',$data,true);

		}else{
			$op = $this->load->view('site/contests_selected_hor.php',$data,true);
		}

		$this->template->write('mainContents',$op);

		//---------------------------------------------
		//generate meta tags
		$this->load->helper('text');
		$meta = array(
		        array('name' => 'keywords', 'content' => 'nepal, college, model, contests'),
		        array('name' => 'description', 'content' => 'College Models Contests in Nepal'),
		        array('name' => 'description', 'content' => $contests->title),
		        array('name' => 'description', 'content' => word_limiter($contests->summary),5),
		        array('name' => 'author', 'content' => 'The Fashion Plus'),
		    );

		$this->template->add_meta($meta);

		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}



	/**
	 *  Set the the currently displaying img & the next & previous images the contest
	 *  @param object[contest], int[currently displayed img]
	 *  @return object[configured contest object]
	 */
	private function contests_imgs($contest=null,$img=null){

		if($contest==null)
			return false;


		//--------------------------------------
		$this->load->helper('utilites_helper');
		$this->load->library('image_lib');
		$contest->thumbs=array();

		//contest's folders
		$folder = dirname(BASEPATH).'/'.CONTESTSPATH.$contest->link;



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
				$contest->cur_img = base_url().CONTESTSPATH.$contest->link.'/'.$v;

				$dim = getimagesize($contest->cur_img);
				if($dim[0]>$dim[1]){
					$img_type = 'landscape';
				}else{
					$img_type = 'potrait'; 
				}

				$contest->img_type=$img_type;

				//previous img link
				if($count>1){
					$contest->prev = site_url('contests/'.$contest->link.'/'.($count-1));
				}

				//next img link
				if($count<count($imgs)-3){
					$contest->next = site_url('contests/'.$contest->link.'/'.($count+1));
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

			//thumbs & links & name of the other imgs contest
			$names = explode('.', $v);
			$full_name='';
			foreach(explode('_',$names[0]) as $key=>$val){
				$full_name .= ucfirst($val).' ';
			}
			array_push($contest->thumbs,

						array(
								'img'=> base_url().CONTESTSPATH.$contest->link.'/thumbs/'.$v,
								'link'=>site_url('contests/'.$contest->link.'/'.$names[0]),
								'type'=>$img_type,
								'name'=>$full_name,
							)
						);	
		}		

		return $contest;
	}
}

/* End of file contests.php */
/* Location: ./application/controllers/site/contests.php */
