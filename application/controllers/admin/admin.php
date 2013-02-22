<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends MY_Controller {

	public function __construct(){
		parent::__construct();
		/**
		 * set headers to prevent back after login
		 */
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');

		if($this->session->userdata('username')!='admin'){
			//$this->login();
			//return false;
		}

		$this->load->library('adminrender_library');
	}

	public function index(){

		if($this->session->userdata('username')=='root'){	//<--- admin's username
			redirect('admin/main');
		}else{
			$this->login();
		}
	}
    
    /**
     * Admin Login fn
     */
    public function login(){

		//----------------------------
		//if admin is trying to login ...
		if($this->input->post('username')){
			//check & login
			//redirect to admin/main if succces
			//else return err msg array
			
			//$data['errors'] = $this->_chk_login();
			$data['errors'] = $this->_chk_login_tmp($this->input->post());
			
			$data['username']=$this->input->post('username');
			$data['password']=$this->input->post('password');
		}
		//----------------------------


		//$this->load->template('admin');
		//$template['active_group'] = 'default';
		$this->template->set_template('admin-login');
		$this->template->render();
    }

	public function main(){
		
		$this->template->set_template('admin');
		
		$this->render_navigation();
		
		$this->template->render();
	}

	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation();
		$this->template->write('menu',$menu);
	}

	/**
	 * validate username,password,captcha
	 * redirect to admin if successful
	 */
	private function _chk_login_tmp($data){		
		//username = root, password= password
		if(($data['username']=='root') && ($data['password']=='password')){ //<--- admin's username + password
			$this->session->set_userdata('username',$data['username']);
				//redirect to admin's main page
				redirect('/admin/main');
			return true;
		}
		return false;
	}
//	private function _chk_login(){
//		$err = array();
//		$this->load->model('users_model');
//
//		if(!$this->captcha_model->check_captcha()){
//			$err['captcha_err'] = 'Invalid Captcha';
//
//		}else{
//			//if admin's login is invalid ...
//			if(! $this->check_login()){
//				$err['login_err'] = 'Invalid Login';
//
//			}else{
//				//redirect to admin's main page
//				redirect('/admin/main');
//			}
//		}
//
//		return $err;
//	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */
