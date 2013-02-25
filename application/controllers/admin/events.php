<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Events extends MY_Controller {

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
		$this->load->model('events_model');
	}

	public function index(){
		$this->list_events();
	}
	
	public function list_events(){
		$data = $this->events_model->get();

		$events = $this->adminrender_library->render_eventslist($data);

		$this->template->set_template('admin');

		$this->template->write('list',$events);
		
		$this->render_navigation();
		
		$this->template->render();
	}
    
    
    public function new_event($data = false){
		if($this->input->post()){
			$data = $this->input->post();
			
			$data = $this->events_model->set($data);
			
			if($data){
				$this->session->set_flashdata('msg', 'Data saved.');			
			}else{
				$this->session->set_flashdata('err', 'Error saving data.');
			}
		}
		$new_events = $this->adminrender_library->render_new_events($data);
		$this->template->set_template('admin');
		$this->template->write('new_item',$new_events);
		
		$this->render_navigation();
		
		$this->template->render();
	}
	
	public function del($id=null){

		if($this->events_model->del($id))
			$this->session->flashdata('msg','Sucessfuly deleted.');

		redirect('admin/events');
	}
	

	public function edit($id=null){
		$data = $this->events_model->get();
//print_r($data);die;		
		$this->new_events($data);
	}

	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Events');
		$this->template->write('menu',$menu);
	}
}

/* End of file events.php */
/* Location: ./application/controllers/admin/events.php */
