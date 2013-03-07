<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gossips extends MY_Controller {

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

		if(($this->session->userdata('usertype')=='administrator') &&
		   ($this->session->userdata('usertype')=='editor') ) {
			redirect('admin');
		}

		$this->load->library('adminrender_library');
		$this->load->model('gossips_model');
	}

	public function index(){
		$this->list_gossips();
	}
	
	public function list_gossips(){
		$data = $this->gossips_model->get();

		$gossips = $this->adminrender_library->render_gossipslist($data);

		$this->template->set_template('admin');

		$this->template->write('list',$gossips);
		
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
    
    public function new_gossip($data = false){

		if($this->input->post()){
			$data = array(
							'content'		=> $this->input->post('content'),
							'title'	=> $this->input->post('title'),
							'summary'	=> $this->input->post('summary'),
						);
			
			$this->_validate_new($data);

			if($this->_validated){
				//input new data
				$data = $this->gossips_model->set($data);
				
				if($data){
					$this->session->set_flashdata('msg', 'Data saved.');			
				}else{
					$this->session->set_flashdata('err', 'Error saving data.');
				}

			}else{
				//err in validation....
				$this->session->set_flashdata('err','Error saving data.');
			}
		}


		//$data['generated_editor'] = $this->_ckeditor_conf();
		//$data['generated_editor'] = display_ckeditor($data['generated_editor']);

		$new_gossips = $this->adminrender_library->render_new_gossips($data);
		$this->template->set_template('admin');
		$this->template->write('new_item',$new_gossips);

		$this->render_navigation();
		$this->render_user_info();
		
		$this->template->render();
	}
	

	private function _validate_new($data){
		$this->_validated = true;
	}

	public function del($id=null){

		$data = array('id'=>$id);

		//validate first .......
		$this->_validated_del($data);
		if($this->_validated){
			$this->gossips_model->del($data);
			$this->session->set_flashdata('msg', 'Data deleted.');			
			
		}else{
			$this->session->set_flashdata('err', 'Error saving data.');
		}
		redirect('admin/gossips');
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
							'content'	=> $this->input->post('content'),
							'title'		=> $this->input->post('title'),
							'summary'	=> $this->input->post('summary'),
						);

			$this->_validate_new($data);
			
			if($this->_validated){
				//input new data
				$data = $this->gossips_model->set($data);
				$this->session->set_flashdata('msg', 'Data saved.');			
			}else{
				//err in validation....
				$this->session->set_flashdata('err', 'Error saving data.');
			}
			
			unset($_POST);
		}

		$data = $this->gossips_model->get(array('id'=>$id));
		$this->new_gossip($data);
		$this->session->set_userdata('updated_id',$id);
	}

	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Gossips');
		$this->template->write('menu',$menu);
	}


	/**
	 * ckEditor's configurations.
	 */
	private function _ckeditor_conf(){
		$this->config->load('ckeditor');
		$this->load->helper('ckeditor');

		$this->data['ckeditor'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	CKEDITOR,
			'config'=>	array(
							'toolbar' 	=> 	$this->config->item('ck_toolbar'),
						),
		);
	}
	private function render_user_info(){
		$user_data = array(	'username'=>$this->session->userdata('username'),
							'usertype'=>$this->session->userdata('usertype') );
		$userlogged = $this->adminrender_library->render_userlogged($user_data);
		$this->template->write('userlogged',$userlogged);
	}
}

/* End of file gossops.php */
/* Location: ./application/controllers/admin/gossipss.php */
