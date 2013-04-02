<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MY_Controller {

	public function __construct(){
		parent::__construct();
		/**
		 * set headers to prevent back after login
		 */
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');


		$this->load->library('adminrender_library');
	}

	public function index(){
		$this->session->sess_destroy();
		$this->session->flashdata('userlogged','You have just logged out.');
		redirect(base_url());
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */
