<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Events extends MY_Controller {

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
			$data = array(
							'title'		=> $this->input->post('title'),
							'summary'	=> $this->input->post('sumary'),
						);
			
			$this->_validate_new($data);

			if($this->_validated){
				//input new data
				$data = $this->events_model->set($data);
				
				if($data){
					$this->session->set_flashdata('msg', 'Data saved.');			
				}else{
					$this->session->set_flashdata('err', 'Error saving data.');
				}

			}else{
				//err in validation....
			}

		}

		$new_events = $this->adminrender_library->render_new_events($data);
		$this->template->set_template('admin');
		$this->template->write('new_item',$new_events);
		
		$this->render_navigation();
		
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
			$this->events_model->del($data);
			$this->session->set_flashdata('msg', 'Data deleted.');			
			
		}else{
			$this->session->set_flashdata('err', 'Error saving data.');
		}
		redirect('admin/events');
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
							'summary'	=> $this->input->post('summary'),
						);

			$this->_validate_new($data);
			
			if($this->_validated){
				//input new data
				$data = $this->events_model->set($data);
				$this->session->set_flashdata('msg', 'Data saved.');			
			}else{
				//err in validation....
				$this->session->set_flashdata('err', 'Error saving data.');
			}
			
			unset($_POST);
		}

		$data = $this->events_model->get(array('id'=>$id));
		$this->new_events($data);
		$this->session->set_userdata('updated_id',$id);
	}

	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Events');
		$this->template->write('menu',$menu);
	}
}

/* End of file events.php */
/* Location: ./application/controllers/admin/events.php */
