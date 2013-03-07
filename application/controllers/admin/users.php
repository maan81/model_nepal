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

		if($this->session->userdata('username')!='root'){	//<--- admin's username
			redirect('admin');
		}

		$this->load->library('adminrender_library');
		$this->load->model('users_model');
	}

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
	 * validate username,password,captcha
	 * redirect to admin if successful
	 */
	private function _chk_login($old_password,$new_password,$new_password_reenter){
		return true;
	}
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */
