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

		if($this->session->userdata('username')!='root'){	//<--- admin's username
			redirect('admin');
		}

		$this->load->library('adminrender_library');
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
		
		$this->render_navigation();
		
		$this->template->render();
	}
    
    
    public function new_featured(){
		$data = null;

		if($this->input->post()){
			$data = array(
							'name'		=> $this->input->post('name'),
							'gender'	=> $this->input->post('gender'),
							'ethnicity'	=> $this->input->post('ethnicity'),
						);

			$this->_validate_new($data);
			
			if($this->_validated){
				//input new data
				$data = $this->featured_model->set($data);

			}else{
				//err in validation....
			}
		}
	
		$new_featured = $this->adminrender_library->render_new_featured($data);
		$this->template->set_template('admin');
		$this->template->write('new_item',$new_featured);
		
		$this->render_navigation();
		
		$this->template->render();
	}
	
	private function _validate_new($data){
		$this->_validated = true;
	}

	public function del($id=null){

		$data = array('id'=>$id);

		//validate first .......
		if($this->_validated($data)){
			$this->featured_model->del($data);
			$this->session->set_flashdata('msg', 'Data deleted.');			
			
		}else{
			$this->session->set_flashdata('err', 'Error saving data.');
		}
		redirect('admin/featured');
	}
	
	public function edit($id=null){
		array('id',$id)
	}
	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Featured Models');
		$this->template->write('menu',$menu);
	}
}

/* End of file featured.php */
/* Location: ./application/controllers/admin/featured.php */
