<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subjects extends MY_Controller {

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
		$this->load->model('subjects_model');
	}

	public function index(){
		$this->list_subjects();
	}
	
	public function list_subjects(){
		$data = $this->subjects_model->get();

		$subjects = $this->adminrender_library->render_subjectslist($data);

		$this->template->set_template('admin');

		$this->template->write('list',$subjects);
		
		$this->template->add_js(ADMINJSPATH.'jquery.dataTables.min.js');

		$this->template->add_css(ADMINCSSPATH.'jquery.dataTables.css');
		$this->template->add_css(ADMINCSSPATH.'jquery.dataTables_themeroller.css');
		$this->template->add_css(ADMINCSSPATH.'demo_page.css');
		$this->template->add_css(ADMINCSSPATH.'demo_table.css');
		$this->template->add_css(ADMINCSSPATH.'demo_table_jui.css');
		$this->template->add_css(ADMINCSSPATH.'dataTables_modifications.css');

		$this->render_navigation();
		
		$this->template->render();
	}
    
    
    public function new_subject($data = false){
		
		if($this->input->post()){
			$data = array(
							'name'		=> $this->input->post('name'),
							'gender'	=> $this->input->post('gender'),
							'ethnicity'	=> $this->input->post('ethnicity'),
						);

			$this->_validate_new($data);
			
			if($this->_validated){
				//input new data
				$data = $this->subjects_model->set($data);
				$this->session->set_flashdata('msg', 'Data saved.');			
			}else{
				//err in validation....
				$this->session->set_flashdata('err', 'Error saving data.');
			}
		}
	
		$new_subjects = $this->adminrender_library->render_new_subjects($data);
		$this->template->set_template('admin');
		$this->template->write('new_item',$new_subjects);

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
			$this->subjects_model->del($data);
			$this->session->set_flashdata('msg', 'Data deleted.');			
			
		}else{
			$this->session->set_flashdata('err', 'Error saving data.');
		}
		redirect('admin/subjects');
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
							'name'		=> $this->input->post('name'),
							'gender'	=> $this->input->post('gender'),
							'ethnicity'	=> $this->input->post('ethnicity'),
						);

			$this->_validate_new($data);
			
			if($this->_validated){
				//input new data
				$data = $this->subjects_model->set($data);
				$this->session->set_flashdata('msg', 'Data saved.');			
			}else{
				//err in validation....
				$this->session->set_flashdata('err', 'Error saving data.');
			}

			unset($_POST);
		}

		$data = $this->subjects_model->get(array('id'=>$id));
		$this->new_subject($data);
		$this->session->set_userdata('updated_id',$id);
	}

	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Models');
		$this->template->write('menu',$menu);
	}
}

/* End of file subjects.php */
/* Location: ./application/controllers/admin/subjects.php */
