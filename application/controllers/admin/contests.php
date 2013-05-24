<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contests extends MY_Controller {

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

		$this->load->model('contests_model');
	}

	public function index(){
		$this->list_contests();
	}
	
	public function list_contests(){
		$data = $this->contests_model->get();

		$this->template->set_template('admin');

		$contests = $this->adminrender_library->render_contestslist($data);

		$this->template->write('list',$contests);
		
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
    
    
    public function new_contest($data = false){

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
				$data = $this->contests_model->set($data);
				
				if($data){
					$this->session->set_flashdata('msg','New contests saved.');
					redirect('admin/contests/edit/'.$data[0]->id);
				}else{
					$this->session->set_flashdata('msg','Unable to save New contests.');
					redirect('admin/contests/new_contest');
				}

			}else{
				//err in validation....
				$this->session->set_flashdata('msg','Unable to save New contests.');
				redirect('admin/contests/new_contest');
			}

		}

		$this->template->set_template('admin');
		$new_contests = $this->adminrender_library->render_new_contests($data);
		$this->template->write('new_item',$new_contests);
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
			$this->contests_model->del($data);
			$this->session->set_flashdata('msg', 'contest ID '.$id.' deleted.');			
			
		}else{
			$this->session->set_flashdata('msg', 'Unable to delete contest ID '.$id.'.');
		}
		redirect('admin/contests');
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
				$data = $this->contests_model->set($data);
				$this->session->set_flashdata('msg', 'contest ID '.$id.' updated.');			

			}else{
				//err in validation....
				$this->session->set_flashdata('err', 'Error saving data.');
				$this->session->set_flashdata('msg', 'Unable to update contest ID '.$id.'.');
			}
			unset($_POST);
			redirect('admin/contests/edit/'.$id);
		}

		$data = $this->contests_model->get(array('id'=>$id));
		$this->new_contest($data);
		$this->session->set_userdata('updated_id',$id);
	}


	/**
	 * Shift the given contests ID 1 setp up
	 * @param int -- contests id
	 * @return
	 */
	public function up($id=false){
		if(!$id){
			redirect('admin/contests');
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
			$cur_data = $this->contests_model->get(array('id'=>$id));

			//the data to be moved down			
			$upper_data = $this->contests_model->get(array('position'=>$cur_data[0]->position - 1));

			//move the data down
			$this->contests_model->increment($upper_data[0]->id);

			//move the data up
			$this->contests_model->decrement($cur_data[0]->id);


			$this->session->set_flashdata('msg', 'contests ID '.$id.' updated.');			
		}else{
			//err in validation....
			$this->session->set_flashdata('msg', 'Unable to update contests ID '.$id.'.');
		}

		unset($_POST);
		redirect('admin/contests');
	}

public function file_management($type,$id){
	redirect('admin/file_management/')
}

	/**
	 * Shift the given contests ID 1 setp down
	 * @param int -- contests id
	 * @return
	 */
	public function down($id=false){
		if(!$id){
			redirect('admin/contests');
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
			$cur_data = $this->contests_model->get(array('id'=>$id));

			//the data to be moved up			
			$lower_data = $this->contests_model->get(array('position'=>$cur_data[0]->position + 1 ));

			//move the data up
			$this->contests_model->decrement($lower_data[0]->id);

			//move the data down
			$this->contests_model->increment($cur_data[0]->id);

			$this->session->set_flashdata('msg', 'contests ID '.$id.' updated.');			
		}else{
			//err in validation....
			$this->session->set_flashdata('msg', 'Unable to update contests ID '.$id.'.');
		}

		unset($_POST);
		redirect('admin/contests');
	}

	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Contests');
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

/* End of file contests.php */
/* Location: ./application/controllers/admin/contests.php */
