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

		$tmp = $this->ads_model->get(array('dimensions'=>'fullbanner','category'=>'published'));
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
					'add'				=> $tmp[0],
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
	public function search(){
		$data = $this->input->get();
		$key = $data['key'];$val=$data['val'];$get_id = $data['page'];

		$this->load->config('search');
		if( ($key==null) || ($val==null) ){
			$contests_count = count($this->contests_model->get(array('upcomming'=>'0')));
			$contests = $this->contests_model->get(	array(	'upcomming'=>'0'), 
													array(	'order_by'=> array(
																			'coln'=>'title',
																			'dir'=>'asc'
																			),
															'limit'=>array(
																'size'=>$this->config->item('search_per_page'),
																'start'=>$get_id,
																)
														)
													);
		}else{
			$featured_count = count($this->featured_model->get(array('upcomming'=>'0', $key=>urldecode($val))));
			$contests = $this->contests_model->get(
													array(	$key	  => urldecode($val),
															'upcomming'=> '0',
														), 
													array(	'order_by'=> array(
																			'coln'=>'title',
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

		if($contests){
		foreach($contests as $key=>$val){

			//--------------------------------------
			//folder of imgs of the event
			$full_path = dirname(BASEPATH).'/'.CONTESTSPATH;	
			$val->thumbs = CONTESTSPATH.gen_folder_name($val->title).'/search_img.jpg';
			if($val->featured=='1'){
				$val->featured = '<img src="'.base_url().IMGSPATH.'featured_events.png" alt="'.$val->title.'" title="'.$val->title.'" class="featured_event" />';
			}else{
				$val->featured = '';
			}

			$val->link = gen_folder_name($val->title);
		}
		}


		//------------------------------------------
		//pagination
		$this->load->library('pagination');

		$config = array(
					'base_url' 		=> site_url('contests'),
					'total_rows' 	=> $contests_count,
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
	 *  The selected contestent
	 *  @param varchar[contest link], varchar[selected contestnant]
	 *  @return void
	 */
	public function get($contests_link=null,$img=null,$param2=null){
		//redirect to contest search if not specified
		if($contests_link==null || $contests_link=='search'){
			return $this->search($img,$param2);
		}

		//----------------------------------------------

			//$contests = $this->contests_model->get(array('link' => $contests_link));

			//goto upcomming contests function
			//if($contests[0]->upcomming=='1'){
			//	return $this->contest_upcomming($contests[0]);
			//}

			//add image & previous & next links
			//$contests = $this->contests_imgs($contests[0],$img);
		//------------------------------------------------
		//get specified contest's contestentant
		$contestants = $this->get_contestants($contests_link,$img);
		//------------------------------------------------

		//redirect to get the imgs. of the specified contests
		if($img==null){
			return $this->_list_imgs($contests_link);
		}

		$this->render_skeleton();

		//-----------------------------------------------
		$this->load->model('ads_model');

		$tmp = $this->ads_model->get(array('dimensions'=>'fullbanner','category'=>'published'));
		$tmp2 = $this->ads_model->get(array('dimensions'=>'rightadsense','category'=>'published'));
		$tmp3 = $this->ads_model->get(array('dimensions'=>'rads','category'=>'published'),'position','asc');
		$rtbbox = $this->ads_model->get(array('dimensions'=>'rtbbox','category'=>'published'));


		//---------------------------------------------
		//get the featured links
		$this->load->model('flinks_model');
		$flinks = $this->flinks_model->get();

		//------------------------------------------------


		$data = array(
					//'contests'		=>	$contests,
					'contestants'	=>	$contestants,
					'render_right'	=>	$tmp3,
					'flinks'		=>	$flinks,
					//'img_links'		=> 	$img_links,
					'add'			=> $tmp[0],
					'add2'			=>	$tmp2,
					'rtbbox'		=> $rtbbox,
					);

		$op = $this->load->view('site/contests_contestant.php',$data,true);

		$this->template->write('mainContents',$op);

		//---------------------------------------------
		//generate meta tags
		$this->load->helper('text');
		$meta = array(
		        array('name' => 'keywords', 'content' => 'nepal, college, model, contests'),
		        array('name' => 'description', 'content' => 'College Models Contests in Nepal'),
		        //array('name' => 'description', 'content' => $contests->title),
		        //array('name' => 'description', 'content' => word_limiter($contests->summary),5),
		        array('name' => 'author', 'content' => 'The Fashion Plus'),
		    );

		$this->template->add_meta($meta);

		//-----------------------------------------------
		//-----------------------------------------------
		$this->template->render();
	}


	/**
	 * get/generate specified contestant's reqd. info.
	 */
	private function get_contestants($contest,$contestant){
		$data = new stdClass();
		
		if(empty($contestant))return;
		$img = dirname(BASEPATH).'/'.CONTESTSPATH.$contest.'/'.$contestant.'-detail.jpg';
		$data->img = base_url().CONTESTSPATH.$contest.'/'.$contestant.'-detail.jpg';
		//contest's folders
		$folder = dirname(BASEPATH).'/'.CONTESTSPATH.$contest;

		//imgs in that folder
		$imgs = glob($folder.'/*-detail.{jpeg,jpg}', GLOB_BRACE);
		$end = end($imgs);
		$first = reset($imgs);
		$cur = $first;

		while($end!=$cur){

			//reqd. data found
			if($cur==$img){
	
				$data->next = next($imgs);
				$data->next = explode('/',$data->next);
				$data->next = explode('-',end($data->next));
				$data->next = site_url('contests/'.$contest.'/'.$data->next[0]);

				prev($imgs);

				if($cur!=$first){
					$data->prev = prev($imgs);
					$data->prev = explode('/',$data->prev);
					$data->prev = explode('-',end($data->prev));
					$data->prev = site_url('contests/'.$contest.'/'.$data->prev[0]);

					next($imgs);
				}
				break;
			}

			$cur = next($imgs);
		}
	
		if($cur=prev($imgs)){
			$data->prev = $cur;
			$data->prev = explode('/',$data->prev);
			$data->prev = explode('-',end($data->prev));
			$data->prev = site_url('contests/'.$contest.'/'.$data->prev[0]);
		}

		$data->name = implode(' ',explode('_',$contestant));

		//$data->like;
		//$data->send;
		//$data->comment;

		return $data;
	}
	private function get_contestants_1($contest,$contestant){
		$data = null;

		$data->img = dirname(BASEPATH).'/'.CONTESTSPATH.$contest.'/'.$contestant.'-detail.jpg';

		//contest's folders
		$folder = dirname(BASEPATH).'/'.CONTESTSPATH.$contest;

		//imgs in that folder
		//$imgs = scandir($folder);	
		$imgs = glob($folder.'/*-detail.{jpeg,jpg}', GLOB_BRACE);
		$end = end($imgs);
		$first = reset($imgs);
		$cur = $first;

		while($end!=$cur){

			//reqd. data found
			if($cur==$data->img){
	
				$data->next = next($imgs);
				prev($imgs);

				if($cur!=$first){
					$data->prev = prev($imgs);
					next($imgs);
				}
				break;
			}

			$cur = next($imgs);
		}
	
		if($cur=prev($imgs)){
			$data->prev = $cur;
		}

		//$data->like;
		//$data->send;
		//$data->comment;

		return $data;
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
			make_dir($folder, 'thumbs');

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
