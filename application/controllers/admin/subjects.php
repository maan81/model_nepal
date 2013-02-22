<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subjects extends MY_Controller {

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
		$this->load->model('ads_model');
	}

	public function index(){
		$this->list_ads();
	}
	
	public function list_ads(){
		$data = $this->ads_model->get();

		$ads = $this->adminrender_library->render_adslist($data);

		$this->template->set_template('admin');

		$this->template->write('list',$ads);
		
		$this->render_navigation();
		
		$this->template->render();
	}
    
    
    public function new_ads($data = false){
		if($this->input->post()){
			$data = $this->input->post();
			
			$data = $this->ads_model->set($data);
			
			if($data){
				$this->session->set_flashdata('msg', 'Data saved.');			
			}else{
				$this->session->set_flashdata('err', 'Error saving data.');
			}
		}
		$new_ads = $this->adminrender_library->render_new_ads($data);
		$this->template->set_template('admin');
		$this->template->write('new_item',$new_ads);
		
		$this->render_navigation();
		
		$this->template->render();
	}
	
	public function del($id=null){

		if($this->ads_model->del($id))
			$this->session->flashdata('msg','Sucessfuly deleted.');

		redirect('admin/ads');
	}
	

	public function edit($id=null){
/*
		if($this->input->post()){
			$data = $this->input->post();
			
			$data = $this->ads_model->update($data);
			
			if($data){
				$this->session->set_flashdata('msg', 'Data saved.');			
			}else{
				$this->session->set_flashdata('err', 'Error saving data.');
			}
		}

		$data = $this->ads_model->get();
//print_r($data);die;		
*/		$this->new_ads($data);
	}

	private function render_navigation(){
		$data = array(	'Home'		=> base_url().'admin',
						'Advertizements'=> base_url().'admin/ads',
						'Models'	=> base_url().'admin/models',
						'Events'	=> base_url().'admin/events',
						'Articles'	=> base_url().'admin/articles',
						'Gossip'	=> base_url().'admin/gossips',
						'Projects'	=> base_url().'admin/projects',
						'Services'	=> base_url().'admin/services',
						'Contact'	=> base_url().'admin/contact',
					);
		$menu = $this->adminrender_library->render_navigation($data);
		$this->template->write('menu',$menu);
	}
}

/* End of file ads.php */
/* Location: ./application/controllers/admin/ads.php */
