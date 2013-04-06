<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ads extends MY_Controller {

	/**
	 * flag for validated; for all new inputs ... 
	 */
	private $_validated=false;

	public function __construct(){
		parent::__construct();

		/**
		 * set headers to prevent back after login
		 */
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');

		if(($this->session->userdata('usertype')!='administrator') &&
		   ($this->session->userdata('usertype')!='editor') ) {
			redirect('admin');
		}

		$this->load->model('ads_model');
	}

	public function index(){
		$this->list_ads();
	}
	

	/**
	 *  List the all ads in the system
	 */
	public function list_ads(){
		$data = $this->ads_model->get(false,'position','asc');

		$ads = $this->adminrender_library->render_adslist($data);

		$this->template->set_template('admin');

		$this->template->write('list',$ads);
		
		$this->template->add_js(ADMINJSPATH.'jquery.dataTables.min.js');
		$this->template->add_js(ADMINJSPATH.'functions.js');

		$this->template->add_css(ADMINCSSPATH.'jquery.dataTables.css');
		$this->template->add_css(ADMINCSSPATH.'jquery.dataTables_themeroller.css');
		$this->template->add_css(ADMINCSSPATH.'demo_page.css');
		$this->template->add_css(ADMINCSSPATH.'demo_table.css');
		$this->template->add_css(ADMINCSSPATH.'demo_table_jui.css');
		$this->template->add_css(ADMINCSSPATH.'dataTables_modifications.css');

		$this->render_navigation();
		$this->render_user_info();
		$this->render_flash();
		
		$this->template->render();
	}

    
	/**
	 * Validate adsence input
	 * @param array[string, string]
	 */
	private function _validate_src($data){
		$this->_validated_src = true;
	}


	/**
	 * Shift the given ad ID 1 setp up
	 * @param int -- ad id
	 * @return
	 */
	public function up($id=false){
		if(!$id){
			redirect('admin/ads');
		}

		$data = array(
						'id'		=> $id,
						'position'	=> '`position` + 1'
					);

		//validaton of the id & position.
		//currently used
		$this->_validated=true;


		if($this->_validated){
			//the data to be moved up
			$cur_data = $this->ads_model->get(array('id'=>$id));

			//the data to be moved down			
			$upper_data = $this->ads_model->get(array('position'=>$cur_data[0]->position - 1));

			//move the data down
			$this->ads_model->increment($upper_data[0]->id);

			//move the data up
			$this->ads_model->decrement($cur_data[0]->id);


			$this->session->set_flashdata('msg', 'Ads ID '.$id.' updated.');			
		}else{
			//err in validation....
			$this->session->set_flashdata('msg', 'Unable to update Ads ID '.$id.'.');
		}

		unset($_POST);
		redirect('admin/ads');
	}



	/**
	 * Shift the given ad ID 1 setp down
	 * @param int -- ad id
	 * @return
	 */
	public function down($id=false){
		if(!$id){
			redirect('admin/ads');
		}

		$data = array(
						'id'		=> $id,
						'position'	=> '`position` - 1'
					);
		
		//validaton of the id & position.
		//currently used
		$this->_validated=true;

		
		if($this->_validated){
			//the data to be moved down
			$cur_data = $this->ads_model->get(array('id'=>$id));

			//the data to be moved up			
			$lower_data = $this->ads_model->get(array('position'=>$cur_data[0]->position + 1 ));

			//move the data up
			$this->ads_model->decrement($lower_data[0]->id);

			//move the data down
			$this->ads_model->increment($cur_data[0]->id);

			$this->session->set_flashdata('msg', 'Ads ID '.$id.' updated.');			
		}else{
			//err in validation....
			$this->session->set_flashdata('msg', 'Unable to update Ads ID '.$id.'.');
		}

		unset($_POST);
		redirect('admin/ads');
	}



	/**
	 * Store new Adsence Ad
	 */
	private function new_adsence(){

		$data = array(
						'title'		=>	$this->input->post('title'),
						'category'	=>	$this->input->post('category'),
						'type'		=>	'script',
						'script'	=> 	$this->input->post('script'),
						'dimensions'=> 	$this->input->post('dimensions'),
					);

		$this->_validate_src($data);

		
		if($this->_validated_src){
			//input new data
			$data = $this->ads_model->set($data);
			$this->session->set_flashdata('msg', 'New Ads saved.');			
			redirect('admin/ads/edit/'.$data[0]->id);

		}else{
			//err in validation....
			$this->session->set_flashdata('msg', 'Unable to save New Ads.');
			redirect('admin/ads/new_ad');
		}

		return $data;
	}

	/**
	 * Store new advertizement
	 */
    public function new_ad($data = false){
		if($this->input->post('type')=='script'){
			$data = $this->new_adsence();

		}elseif($this->input->post()){
			$data = array(
							'title'		=> $this->input->post('title'),
							'category'	=> $this->input->post('category'),
							'dimensions'=> $this->input->post('dimensions'),
							'link'		=> $this->input->post('link'),
							'image'		=> $this->input->post('image'),
							'type'		=> $this->input->post('type'),
						);

			$this->_validate_new($data);

			
			if($this->_validated){
				//input new data
				$data = $this->ads_model->set($data);
				$this->session->set_flashdata('msg', 'New Ads saved.');			
				redirect('admin/ads/edit/'.$data[0]->id);
		
			}else{
				//err in validation....
				$this->session->set_flashdata('msg', 'Unable to save New Ads.');
				redirect('admin/ads/new_ad');
			}
		}

		$new_ads = $this->adminrender_library->render_new_ads($data);
		$this->template->set_template('admin');
		$this->template->write('new_item',$new_ads);
		$this->template->add_js(ADMINJSPATH.'functions.js');
		
		$this->render_navigation();
		$this->render_user_info();
		$this->render_flash();
		
		$this->template->render();
	}
	
	private function _validate_new($data){
		$this->_validated = true;
	}

	public function del($id=null){
		$data = array('id'=>$id);

		//validate first .......
		$this->_validate_del($data);
		if($this->_validated){
			$this->ads_model->del($data);
			$this->session->set_flashdata('msg', 'Ads ID '.$id.' deleted.');			

		}else{
			$this->session->set_flashdata('msg', 'Unable to delete Ads ID '.$id.'.');
		}
		redirect('admin/ads');
	}
	
	private function _validate_del($data){
		$this->_validated = true;
	}

	public function edit($id=false){
		// id error
		if(!$id){
			return false;
		}
		if($this->input->post()){
			$id = $this->session->userdata('updated_id');

			$data = array(
							'id'		=> $id,
							'title'		=> $this->input->post('title'),
							'category'	=> $this->input->post('category'),
							'dimensions'=> $this->input->post('dimensions'),
							'link'		=> $this->input->post('link'),
							'type'		=> $this->input->post('type')
						);

			$this->_validate_new($data);

			if($this->_validated){
				//input new data
					$data = $this->ads_model->set($data);
					$this->session->set_flashdata('msg', 'Ads ID '.$id.' updated.');			
				}else{
				//err in validation....
				$this->session->set_flashdata('msg', 'Unable to update Ads ID '.$id.'.');
			}

			unset($_POST);
			redirect('admin/ads/edit/'.$data[0]->id);
		}

		$data = $this->ads_model->get(array('id'=>$id));
//print_r($data);die;		
		$this->new_ad($data);
		$this->session->set_userdata('updated_id',$id);
	}

	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Advertizements');
		$this->template->write('menu',$menu);
	}
	private function render_user_info(){
		$user_data = array(	'username'=>$this->session->userdata('username'),
							'usertype'=>$this->session->userdata('usertype') );
		$userlogged = $this->adminrender_library->render_userlogged($user_data);
		$this->template->write('userlogged',$userlogged);
	}
	private function render_flash(){
		if($flash = $this->session->flashdata('msg')){
			$flash = $this->adminrender_library->render_flash($flash);

			$this->template->write('flash',$flash);
			$this->template->add_css(ADMINCSSPATH.'flash.css');
			//$this->template->add_js(ADMINJSPATH.'flash.js');
		}
	}
}

/* End of file ads.php */
/* Location: ./application/controllers/admin/ads.php */
