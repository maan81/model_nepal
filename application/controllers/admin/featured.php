<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Featured extends MY_Controller {

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
    
    
    public function new_subject(){
		$data = null;
		if($data = $this->input->post()){
			$data = $this->featured_model->set($data);
		}
	
		$new_featured = $this->adminrender_library->render_new_featured($data);
		$this->template->set_template('admin');
		$this->template->write('new_item',$new_featured);
		
		$this->render_navigation();
		
		$this->template->render();
	}
	
	public function del($id=null){

		//validate first .......
		
		$this->featured_model->del($id);
		
		redirect('admin/featured');
	}
	
	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Featured Models');
		$this->template->write('menu',$menu);
	}
}

/* End of file featured.php */
/* Location: ./application/controllers/admin/featured.php */
