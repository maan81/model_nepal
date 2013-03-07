<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {


	public function __construct(){
		parent::__construct();
		/**
		 * set headers to prevent back after login
		 */
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
//echo $this->session->userdata('usertype');die;
		if( ($this->session->userdata('usertype')!='administrator') && 
			($this->session->userdata('usertype')!='editor') ) {
			redirect('admin');
		}

		$this->load->library('adminrender_library');
		$this->load->model('users_model');
	}

	/**
	 * View profile of the current user
	 * @param void
	 * @return void
	 */
	public function view_profile(){
		$this->template->set_template('admin');

		$menu = $this->adminrender_library->render_navigation('User');
		$this->template->write('menu',$menu);
		
		$user_data = array(	'username'=>$this->session->userdata('username'),
							'usertype'=>$this->session->userdata('usertype') );
		$userlogged = $this->adminrender_library->render_userlogged($user_data);
		$this->template->write('userlogged',$userlogged);


		//------------
		$profile_data = $this->users_model->get($user_data);
		$profile_rendered = $this->adminrender_library->view_profile($profile_data);
		$this->template->write('new_item',$profile_rendered);
		//------------

		$this->template->render();
	}

	/**
	 * Change current user's password
	 * @param void
	 * @return void
	 */
	public function change_password(){
//echo '<pre>';
//print_r($this->session->userdata);
//echo '</pre>';	
//die;	
		if($this->input->post()){
			$data['old_password']=$this->input->post('old_password');
			$data['new_password']=$this->input->post('new_password');
			$data['new_password_reenter']=$this->input->post('new_password_reenter');

			$validated = $this->_chk_login($data['old_password'],$data['new_password'],$data['new_password_reenter']);

			if(! $validated){
				//invalid parameters
				$this->session->flashdata('password_update', 'Password Updated Failure');
		
			}else{
				$data = array(
							'id' 		=> $this->session->userdata('userid'),
							'username'	=> $this->session->userdata('username'),
							'password' 	=> $data['new_password']
						);
				$this->users_model->change_password($data);

				$this->session->flashdata('password_update', 'Password Updated Success');
			}
			redirect('admin/users/view_profile');
		}

		$this->template->set_template('admin');

		$menu = $this->adminrender_library->render_navigation('User');
		$this->template->write('menu',$menu);
		
		$user_data = array(	'username'=>$this->session->userdata('username'),
							'usertype'=>$this->session->userdata('usertype') );
		$userlogged = $this->adminrender_library->render_userlogged($user_data);
		$this->template->write('userlogged',$userlogged);


		//------------
		$profile_data = $this->users_model->get($user_data);
		$change_password = $this->adminrender_library->change_password($profile_data);
		$this->template->write('new_item',$change_password);
		//------------

		$this->template->render();
	}


	/**
	 * validate username,password //*,captcha/
	 * redirect to admin if successful
	 */
	private function _chk_login($old_password,$new_password,$new_password_reenter){
		return true;
	}



//---------------------------------------------------------------------------------
	/**
	 * flag for validated; for all new inputs ... 
	 */
	private $_validated=false;


	public function index(){
		if( ($this->session->userdata('usertype')!='administrator') ) {
			redirect('admin');
		}

		$this->list_users();
	}
	
	public function list_users(){
		if( ($this->session->userdata('usertype')!='administrator') ) {
			redirect('admin');
		}

		$data = $this->users_model->get();

		$users = $this->adminrender_library->render_userslist($data);

		$this->template->set_template('admin');

		$this->template->write('list',$users);
		
		$this->template->add_js(ADMINJSPATH.'jquery.dataTables.min.js');

		$this->template->add_css(ADMINCSSPATH.'jquery.dataTables.css');
		$this->template->add_css(ADMINCSSPATH.'jquery.dataTables_themeroller.css');
		$this->template->add_css(ADMINCSSPATH.'demo_page.css');
		$this->template->add_css(ADMINCSSPATH.'demo_table.css');
		$this->template->add_css(ADMINCSSPATH.'demo_table_jui.css');
		$this->template->add_css(ADMINCSSPATH.'dataTables_modifications.css');

		$this->render_navigation();
		$this->render_user_info();
		
		$this->template->render();
	}
    
    
    public function new_user($data = false){
		if( ($this->session->userdata('usertype')!='administrator') ) {
			redirect('admin');
		}
		
		if($this->input->post()){
//echo '<pre>';
//print_r($this->input->post());
//echo '</pre>';			
			$data = array(
							'username'	=> $this->input->post('username'),
							'password'	=> md5('password'.$this->input->post('username')),
							'email' 	=> $this->input->post('email'),
							'usertype'	=> $this->input->post('usertype'),
						);

			$this->_validate_new($data);
			
			if($this->_validated){
				//input new data
				$data = $this->users_model->set($data);
				$this->session->set_flashdata('msg', 'Data saved.');			
			}else{
				//err in validation....
				$this->session->set_flashdata('err', 'Error saving data.');
			}
		}
	
		$new_user = $this->adminrender_library->render_new_user($data);
		$this->template->set_template('admin');
		$this->template->write('new_item',$new_user);

		$this->render_navigation();
		$this->render_user_info();
		
		$this->template->render();
	}
	
	private function _validate_new($data){
		$this->_validated = true;
	}

	public function del($id=null){
		if( ($this->session->userdata('usertype')!='administrator') ) {
			redirect('admin');
		}

		$data = array('id'=>$id);

		//validate first .......
		$this->_validate_del($data);

		if($this->_validated){
			$this->users_model->del($data);
			$this->session->set_flashdata('msg', 'Data deleted.');			
			
		}else{
			$this->session->set_flashdata('err', 'Error saving data.');
		}
		redirect('admin/users');
	}

	private function _validate_del($data){
		$this->_validated = true;
	}
	
	public function edit($id=false){
		if( ($this->session->userdata('usertype')!='administrator') ) {
			redirect('admin');
		}

		// id error
		if(!$id){
			return false;
		}
		if($this->input->post()){
//echo '<pre>';
//print_r($this->input->post());
//echo '</pre>';			
			$id = $this->session->userdata('updated_id');
	
			$data = array(
							'username'	=> $this->input->post('username'),
							'password'	=> $this->input->post('password'),
							'email' 	=> $this->input->post('email'),
							'usertype'	=> $this->input->post('usertype'),
						);

			$this->_validate_new($data);
			
			if($this->_validated){
				//input new data
				$data = $this->users_model->set($data);
				$this->session->set_flashdata('msg', 'Data saved.');			
			}else{
				//err in validation....
				$this->session->set_flashdata('err', 'Error saving data.');
			}

			unset($_POST);
		}

		$data = $this->users_model->get(array('id'=>$id));
		$this->new_user($data);
		$this->session->set_userdata('updated_id',$id);
	}

	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Users');
		$this->template->write('menu',$menu);
	}
	private function render_user_info(){
		$user_data = array(	'username'=>$this->session->userdata('username'),
							'usertype'=>$this->session->userdata('usertype') );
		$userlogged = $this->adminrender_library->render_userlogged($user_data);
		$this->template->write('userlogged',$userlogged);
	}

//---------------------------------------------------------------------------------

}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */
