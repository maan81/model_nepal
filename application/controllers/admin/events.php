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

		if(($this->session->userdata('usertype')!='administrator') &&
		   ($this->session->userdata('usertype')!='editor') ) {
			redirect('admin');
		}

		$this->load->model('events_model');
	}

	public function index(){
		$this->list_events();
	}
	
	public function list_events(){
		$data = $this->events_model->get();

		$this->template->set_template('admin');

		$events = $this->adminrender_library->render_eventslist($data);

		$this->template->write('list',$events);
		
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
    
    
    public function new_event($data = false){

		if($this->input->post('type')){
			$data = array(
							'title'		=> $this->input->post('title'),
							'summary'	=> $this->input->post('summary'),
							'type'		=> $this->input->post('type'),
							'location'	=> $this->input->post('location'),
							'date_created'	=> $this->input->post('date_created'),
							'upcomming'	=> $this->input->post('upcomming'),
							'featured'	=> $this->input->post('featured'),
							'created_by'=>  $this->session->userdata('username'),
						);

			if($this->input->post('upcomming')=='1'){
				//$data['date'] = $this->input->post('date');
				$data['time'] = $this->input->post('time');
				$data['details'] = $this->input->post('details');
			}


			$this->_validate_new($data);

			if($this->_validated){
				//input new data
				$data = $this->events_model->set($data);
				
				if($data){
					$this->session->set_flashdata('msg','New Events saved.');
					redirect('admin/events/edit/'.$data[0]->id);
				}else{
					$this->session->set_flashdata('msg','Unable to save New Events.');
					redirect('admin/events/new_event');
				}

			}else{
				//err in validation....
				$this->session->set_flashdata('msg','Unable to save New Events.');
				redirect('admin/events/new_event');
			}

		}

		$this->template->set_template('admin');
		$new_events = $this->adminrender_library->render_new_events($data);
		$this->template->write('new_item',$new_events);
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
			$this->events_model->del($data);
			$this->session->set_flashdata('msg', 'Event ID '.$id.' deleted.');			
			
		}else{
			$this->session->set_flashdata('msg', 'Unable to delete Event ID '.$id.'.');
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
		if($this->input->post('type')){
			$id = $this->session->userdata('updated_id');
	
			$data = array(
							'id'		=> $id,
							//'title'	=> $this->input->post('title'),
							'summary'	=> $this->input->post('summary'),
							'type'		=> $this->input->post('type'),
							'location'	=> $this->input->post('location'),
							'date_created'	=> $this->input->post('date_created'),
							'upcomming'	=> $this->input->post('upcomming'),
							'featured'	=> $this->input->post('featured'),
						);

			if($this->input->post('upcomming')=='1'){
				//$data['date'] = $this->input->post('date');
				$data['time'] = $this->input->post('time');
				$data['details'] = $this->input->post('details');
			}

			$this->_validate_new($data);
			
			if($this->_validated){
				//input new data
				$data = $this->events_model->set($data);
				$this->session->set_flashdata('msg', 'Event ID '.$id.' updated.');			

			}else{
				//err in validation....
				$this->session->set_flashdata('err', 'Error saving data.');
				$this->session->set_flashdata('msg', 'Unable to update Event ID '.$id.'.');
			}
			unset($_POST);
			redirect('admin/events/edit/'.$id);
		}

		$data = $this->events_model->get(array('id'=>$id));
		$this->new_event($data);
		$this->session->set_userdata('updated_id',$id);
	}

	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Events');
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

/* End of file events.php */
/* Location: ./application/controllers/admin/events.php */
