<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Featured extends MY_Controller {

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

		$this->load->model('featured_model');
	}

	public function index(){
		$this->list_featured();
	}
	
	public function list_featured(){
		$data = $this->featured_model->get();

		$featured = $this->adminrender_library->render_featuredlist($data);

		$this->template->set_template('admin');

		$this->template->write('list',$featured);
		
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
	 * Shift the given ad ID 1 setp up
	 * @param int -- ad id
	 * @return
	 */
	public function up($id=false){
		if(!$id){
			redirect('admin/featured');
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
			$cur_data = $this->featured_model->get(array('id'=>$id));

			//the data to be moved down			
			$upper_data = $this->featured_model->get(array('position'=>$cur_data[0]->position - 1));

			//move the data down
			$this->featured_model->increment($upper_data[0]->id);

			//move the data up
			$this->featured_model->decrement($cur_data[0]->id);


			$this->session->set_flashdata('msg', 'Featured ID '.$id.' updated.');			
		}else{
			//err in validation....
			$this->session->set_flashdata('msg', 'Unable to update Featured ID '.$id.'.');
		}

		unset($_POST);
		redirect('admin/featured');
	}



	/**
	 * Shift the given ad ID 1 setp down
	 * @param int -- ad id
	 * @return
	 */
	public function down($id=false){
		if(!$id){
			redirect('admin/featured');
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
			$cur_data = $this->featured_model->get(array('id'=>$id));

			//the data to be moved up			
			$lower_data = $this->featured_model->get(array('position'=>$cur_data[0]->position + 1 ));

			//move the data up
			$this->featured_model->decrement($lower_data[0]->id);

			//move the data down
			$this->featured_model->increment($cur_data[0]->id);

			$this->session->set_flashdata('msg', 'Featured ID '.$id.' updated.');			
		}else{
			//err in validation....
			$this->session->set_flashdata('msg', 'Unable to update Featured ID '.$id.'.');
		}

		unset($_POST);
		redirect('admin/featured');
	}


    public function new_featured($data = false){
		
		if($this->input->post('ethnicity')){
			$this->load->helper('utilites_helper');
			$data = array(
							'name'			=> $this->input->post('name'),
							'link'			=> gen_folder_name($this->input->post('name')),
							'gender'		=> $this->input->post('gender'),
							'ethnicity'		=> $this->input->post('ethnicity'),
							'wardrobe'		=> $this->input->post('wardrobe'),
							'wardrobe_link'	=> urlencode($this->input->post('wardrobe_link')),
							'location'		=> $this->input->post('location'),
							'location_link'	=> urlencode($this->input->post('location_link')),
							'make_up'		=> $this->input->post('make_up'),
							'make_up_link'	=> urlencode($this->input->post('make_up_link')),
							'photographer'	=> $this->input->post('photographer'),
							'photographer_link'=>urlencode($this->input->post('photographer_link')),
							'model_by'		=> $this->input->post('model_by'),
							'model_by_link'	=> urlencode($this->input->post('model_by_link')),
							'date_created'	=> $this->input->post('date_created'),
							'created_by'	=> $this->session->userdata('username'),
						);

			$this->_validate_new($data);
			
			if($this->_validated){
				//input new data
				$data = $this->featured_model->set($data);
				$this->session->set_flashdata('msg','New Featured Model saved.');
				redirect('admin/featured/edit/'.$data[0]->id);
			}else{
				//err in validation....
				$this->session->set_flashdata('msg','Unable to save New Featured Model.');
				redirect('admin/featured/new_featured');
			}
		}
	
		$this->template->set_template('admin');
		$new_featured = $this->adminrender_library->render_new_featured($data);
		$this->template->write('new_item',$new_featured);
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
			$this->featured_model->del($data);
			$this->session->set_flashdata('msg', 'Featured Model ID '.$id.' deleted.');			
			
		}else{
			$this->session->set_flashdata('msg', 'Unable to delete Featured Model ID '.$id.'.');
		}
		redirect('admin/featured');
	}
	
	private function _validate_del($data){
		$this->_validated = true;
	}

	public function edit($id=false){
		// id error
		if(!$id){
			return false;
		}
		if($this->input->post('ethnicity')){
			$id = $this->session->userdata('updated_id');
	
			$data = array(
							'id'			=> $id,
							'name'			=> $this->input->post('name'),
							'gender'		=> $this->input->post('gender'),
							'ethnicity'		=> $this->input->post('ethnicity'),
							'wardrobe'		=> $this->input->post('wardrobe'),
							'wardrobe_link'	=> urlencode($this->input->post('wardrobe_link')),
							'location'		=> $this->input->post('location'),
							'location_link'	=> urlencode($this->input->post('location_link')),
							'make_up'		=> $this->input->post('make_up'),
							'make_up_link'	=> urlencode($this->input->post('make_up_link')),
							'photographer'	=> $this->input->post('photographer'),
							'photographer_link'=>urlencode($this->input->post('photographer_link')),
							'model_by'		=> $this->input->post('model_by'),
							'model_by_link'	=> urlencode($this->input->post('model_by_link')),
							'date_created'	=> $this->input->post('date_created'),
						);
			$this->_validate_new($data);
			
			if($this->_validated){
				//input new data
				$data = $this->featured_model->set($data);
				$this->session->set_flashdata('msg', 'Featured Model ID '.$id.' updated.');			
			}else{
				//err in validation....
				$this->session->set_flashdata('msg', 'Unable to update Featured Model ID '.$id.'.');
			}
			
			unset($_POST);
			redirect('admin/featured/edit/'.$data[0]->id);
		}

		$data = $this->featured_model->get(array('id'=>$id));
		$this->new_featured($data);
		$this->session->set_userdata('updated_id',$id);
	}


	public function browse($name=false){
		$this->session->set_flashdata('dir_type','featured');
		$this->session->set_flashdata('dir_name',$name);

		redirect('admin/file_management/index/featured/'.$name);
	}

	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Featured Models');
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

/* End of file featured.php */
/* Location: ./application/controllers/admin/featured.php */
