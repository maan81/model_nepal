<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subjects extends MY_Controller {

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
		$this->load->model('subjects_model');
	}

	public function index(){
		$this->list_subjects();
	}
	
	public function list_subjects(){
		$data = $this->subjects_model->get();

		$subjects = $this->adminrender_library->render_adslist($data);

		$this->template->set_template('admin');

		$this->template->write('list',$subjects);
		
		$this->render_navigation();
		
		$this->template->render();
	}
    
    
    public function new_ads(){
		$data = null;
		if($data = $this->input->post()){
			$data = $this->subjects_model->set($data);
		}
	
		$new_ads = $this->adminrender_library->render_new_ads($data);
		$this->template->set_template('admin');
		$this->template->write('new_item',$new_ads);
		
		$this->render_navigation();
		
		$this->template->render();
	}
	
	public function del($id=null){

		//validate first .......
		
		$this->subjects_model->del($id);
		
		redirect('admin/ads');
	}
	
	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Models');
		$this->template->write('menu',$menu);
	}
}

/* End of file subjects.php */
/* Location: ./application/controllers/admin/subjects.php */
