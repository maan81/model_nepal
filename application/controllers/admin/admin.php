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
	}

	/**
	 * flag for validated; for all new inputs ... 
	 */
	private $_validated=false;

	/**
	 * email validation
	 * @param string email
	 * @return void
	 */
	private function _validate_email($email){
		$this->_validated = true;
	}

	/**
	 * Forgot username/password
	 * @param void
	 * @return void
	 */
	public function reset_user(){
		$data = array();

		if($this->input->post()){
			$email = $this->input->post('email');
			//validate email
			$this->_validate_email($email);

			if($this->_validated){

				$this->load->helper('string');
				$this->load->library('email');
				
				//get reqd. data
				$this->load->model('users_model');
				$data = $this->users_model->get(array('email'=>$email));

				//generate nu rand. password & reset in db
				$data[0]->password = random_string().$data[0]->username;
				$this->users_model->set(array(	'id' 		=> $data[0]->id,
												'password'	=> md5($data[0]->password.$data[0]->username)
												)
										);

				//generate html for email
				$reset_user = $this->adminrender_library->reset_user($data);

				$this->load->library('email');

				$this->email->from('Model Nepal','moletest123456@gmail.com');//gmail reqd ......

				$this->email->to($data[0]->email);

				$this->email->subject('Model Nepal Account');
				$this->email->message($reset_user);

				$this->email->set_newline("\r\n");


				if($this->email->send()){
					$this->session->flashdata('sending_email','Email has been send.');
				}else{
					$this->session->flashdata('sending_email','There was an error while sending email.');
				};

/*
SELECT update_time
FROM information_schema.tables
WHERE table_schema='mydb'
AND table_name='mytable';
*/			}
		}

		//render form
		$this->template->set_template('reset_user');
		$this->template->render();
	}

	public function index(){
		if(($this->session->userdata('usertype')=='administrator') ||
		   ($this->session->userdata('usertype')=='editor') ) {
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
			$data['username']=$this->input->post('username');
			$data['password']=$this->input->post('password');

			$data['errors'] = $this->_chk_login($data['username'],$data['password']);
			//$data['errors'] = $this->_chk_login_tmp($this->input->post());

			$this->session->set_flashdata('msg',$data['errors']['login_err']);
			redirect($this->uri->uri_string());
		}
		//----------------------------


		//$this->load->template('admin');
		//$template['active_group'] = 'default';
		$this->template->set_template('admin-login');
		$this->render_flash();
		$this->template->render();
    }

	public function main(){
		if( ($this->session->userdata('usertype')!='administrator') && 
			($this->session->userdata('usertype')!='editor') ){
			$this->login();
			return;
		}
		
		$this->template->set_template('admin');

		$menu = $this->adminrender_library->render_navigation('Home');
		$this->template->write('menu',$menu);
		
		$this->render_user_info();

		$this->template->render();
	}

	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation();
		$this->template->write('menu',$menu);
	}

//	/**
//	 * validate username,password,captcha
//	 * redirect to admin if successful
//	 */
//	// tmp fn........... 
//	private function _chk_login_tmp($data){		
//		//username = root, password= password
//		if(($data['username']=='root') && ($data['password']=='password')){ //<--- admin's username + password
//			$this->session->set_userdata('username',$data['username']);
//				//redirect to admin's main page
//				redirect('/admin/main');
//			return true;
//		}
//		return false;
//	}

	/**
	 * validate username,password,captcha
	 * redirect to admin if successful
	 */
	private function _chk_login($username,$password){
		$err = array();
		$this->load->model('users_model');

//		if(!$this->captcha_model->check_captcha()){
//			$err['captcha_err'] = 'Invalid Captcha';
//
//		}else{
//print_r($this->users_model->check_login($username,$password));
//die;		
			//if admin's login is invalid ...
			if(! $this->users_model->check_login($username,$password)){
				$err['login_err'] = 'Invalid Login';
//die('a');				

			}else{
//die('b');				
				//redirect to admin's main page
				redirect('admin/main');
			}
//		}
//
		return $err;
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
			$this->template->add_js(ADMINJSPATH.'functions.js');
		}
	}
		
	//default
	//username : root
	//unencoded password : password
	//password : 1fd185ec2e46a16240b7544dff37aa65
	public function tmp($username='root',$password='password'){
		$data = array('username'=>$username,'password'=>md5($password.$username));
		print_r($data);die;
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */
