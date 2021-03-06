<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_management extends MY_Controller {

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

		if( !(($this->session->userdata('usertype')!='administrator') ||
		   ($this->session->userdata('usertype')!='editor') ) ){
			redirect('admin');
		}
		//$this->load->model('featured_model');
		$this->load->library('adminrender_library');
	}

	public function index($type,$name){
		$data = array(	'csrf_name'=> $this->security->get_csrf_token_name(),
						'csrf_value'=>$this->security->get_csrf_hash(),
						'dir_type'		=>$type,
						'dir_name'		=>$name
					);

		$this->template->set_template('admin');

		$op = $this->adminrender_library->file_management($data);
		$this->template->write('list',$op);

		$this->template->add_js(ADMINJSPATH.'jquery.dataTables.min.js');
		$this->template->add_js(ADMINJSPATH.'functions.js');

		$this->render_navigation();
		$this->render_user_info();
		$this->render_flash();
		
		$this->template->render();
	}

	function elfinder_init(){
		$this->load->helper('path');

		$dir_type=gen_folder_name($this->input->get('type'));
		$dir_name=gen_folder_name($this->input->get('name'));



		$opts = array(
					'debug' => array('error', 'warning', 'event-destroy'), 
					'roots' => array(
									array( 
										'driver' => 'LocalFileSystem', 
										//'path'   => dirname(BASEPATH).'/'.'public/'.$type.'/'.$name.'/',
										//'URL'    => site_url('public/'.$type.'/'.$name.'/'),
										'path'		=> set_realpath(dirname(BASEPATH).'/public/'.$dir_type.'/'.$dir_name),
										'URL'		=> base_url().'public/'.$dir_type.'/'.$dir_name,

										//array( // restrict access to jpg files
										//	'pattern' => '/\.jpg$/',
										//	'write' => false,
										//	'locked' => true
										//),
						                //array( // hide readmes
						                //    'pattern' => '/index\.html/',
						                //    'read' => false,
						                //    'write' => false,
						                //   'hidden' => true,
						                //    'locked' => false
						                //),
						            ), 
								),
				);

		$this->load->library('elfinder_lib', $opts);
	}


	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('File Management');
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

/* End of file file_management.php */
/* Location: ./application/controllers/admin/file_management.php */
