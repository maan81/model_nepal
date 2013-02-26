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

		if($this->session->userdata('username')!='root'){	//<--- admin's username
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
		
		$this->render_navigation();
		
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
			}
		}


		//$data['generated_editor'] = $this->_ckeditor_conf();
		//$data['generated_editor'] = display_ckeditor($data['generated_editor']);

		$new_gossips = $this->adminrender_library->render_new_gossips($data);
		$this->template->set_template('admin');
		$this->template->write('new_item',$new_gossips);

		$this->render_navigation();
		
		$this->template->render();
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

	public function del($id=null){

		$data = array('id'=>$id);

		//validate first .......
		if($this->_validated($data)){
			$this->gossips_model->del($data);
			$this->session->set_flashdata('msg', 'Data deleted.');			
			
		}else{
			$this->session->set_flashdata('err', 'Error saving data.');
		}
		redirect('admin/gossips');
	}
	

	public function edit($id=false){
print_r($id);
die('in gossip editing ...');		
		if($this->input->post()){
			$data = $this->input->post();
			
			$data = $this->gossips_model->set($data);
print_r($data);
echo $this->db->insert_id();
die;			
			if($data){
				$this->session->set_flashdata('msg', 'Data saved.');			
			}else{
				$this->session->set_flashdata('err', 'Error saving data.');
			}
		}


		if($id)
			$id = array('id'=>$id);
		$data = $this->gossips_model->get($id);
//echo '<pre>';
//print_r($data);
//echo '</pre>';
//die;		
		$this->new_gossip(array($data));
	}

	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Gossips');
		$this->template->write('menu',$menu);
	}
}

/* End of file gossops.php */
/* Location: ./application/controllers/admin/gossipss.php */
