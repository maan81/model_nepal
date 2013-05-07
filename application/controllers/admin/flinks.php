<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Flinks extends MY_Controller {

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

		$this->load->model('flinks_model');
	}

	public function index(){
		$this->list_flinks();
	}
	
	public function list_flinks(){
		$data = $this->flinks_model->get();

		$this->template->set_template('admin');

		$flinks = $this->adminrender_library->render_flinkslist($data);

		$this->template->write('list',$flinks);
		
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
    
    
    public function new_flink($data = false){

		if($this->input->post('title')){
			$data = array(
							'link'		=> $this->input->post('link'),
							'image'		=> $this->input->post('image'),
							'title'		=> $this->input->post('title'),
							'summary'	=> $this->input->post('summary'),
							'enabled'	=> $this->input->post('enabled'),
							'date_created'=>$this->input->post('date_created'),
							'created_by'=> $this->session->userdata('username'),
						);


			$this->_validate_new($data);

			if($this->_validated){
				//input new data
				$data = $this->flinks_model->set($data);
				
				if($data){
					$this->session->set_flashdata('msg','New Featured Link saved.');
					redirect('admin/flinks/edit/'.$data[0]->id);
				}else{
					$this->session->set_flashdata('msg','Unable to save New Featured Link.');
					redirect('admin/flinks/new_flink');
				}

			}else{
				//err in validation....
				$this->session->set_flashdata('msg','Unable to save New Featured Links.');
				redirect('admin/flinks/new_flink');
			}

		}

		$this->template->set_template('admin');
		$new_flinks = $this->adminrender_library->render_new_flinks($data);
		$this->template->write('new_item',$new_flinks);
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
			$this->flinks_model->del($data);
			$this->session->set_flashdata('msg', 'Featured Link ID '.$id.' deleted.');			
			
		}else{
			$this->session->set_flashdata('msg', 'Unable to delete Featured Link ID '.$id.'.');
		}
		redirect('admin/flinks');
	}
	
	private function _validate_del($data){
		$this->_validated = true;
	}

	public function edit($id=false){

		// id error
		if(!$id){
			return false;
		}
		if($this->input->post('link')){
			$id = $this->session->userdata('updated_id');

			$data = array(
							'id'		=> $id,
							'link'		=> $this->input->post('link'),
							'image'		=> $this->input->post('image'),
							//'title'		=> $this->input->post('title'),
							'summary'	=> $this->input->post('summary'),
							'enabled'	=> $this->input->post('enabled'),
							'date_created'=>$this->input->post('date_created'),
							'created_by'=> $this->session->userdata('username'),
						);



			$this->_validate_new($data);
			
			if($this->_validated){
				//input new data
				$data = $this->flinks_model->set($data);
				$this->session->set_flashdata('msg', 'Featured Link ID '.$id.' updated.');			

			}else{
				//err in validation....
				$this->session->set_flashdata('err', 'Error saving data.');
				$this->session->set_flashdata('msg', 'Unable to update flink ID '.$id.'.');
			}
			unset($_POST);
			redirect('admin/flinks/edit/'.$id);
		}

		$data = $this->flinks_model->get(array('id'=>$id));
		$this->new_flink($data);
		$this->session->set_userdata('updated_id',$id);
	}


	/**
	 * Shift the given flinks ID 1 setp up
	 * @param int -- flinks id
	 * @return
	 */
	public function up($id=false){
		if(!$id){
			redirect('admin/flinks');
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
			$cur_data = $this->flinks_model->get(array('id'=>$id));

			//the data to be moved down			
			$upper_data = $this->flinks_model->get(array('position'=>$cur_data[0]->position - 1));

			//move the data down
			$this->flinks_model->increment($upper_data[0]->id);

			//move the data up
			$this->flinks_model->decrement($cur_data[0]->id);


			$this->session->set_flashdata('msg', 'Featured Link ID '.$id.' updated.');			
		}else{
			//err in validation....
			$this->session->set_flashdata('msg', 'Unable to update Featured Link ID '.$id.'.');
		}

		unset($_POST);
		redirect('admin/flinks');
	}



	/**
	 * Shift the given flinks ID 1 setp down
	 * @param int -- flinks id
	 * @return
	 */
	public function down($id=false){
		if(!$id){
			redirect('admin/flinks');
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
			$cur_data = $this->flinks_model->get(array('id'=>$id));

			//the data to be moved up			
			$lower_data = $this->flinks_model->get(array('position'=>$cur_data[0]->position + 1 ));

			//move the data up
			$this->flinks_model->decrement($lower_data[0]->id);

			//move the data down
			$this->flinks_model->increment($cur_data[0]->id);

			$this->session->set_flashdata('msg', 'Featured Link ID '.$id.' updated.');			
		}else{
			//err in validation....
			$this->session->set_flashdata('msg', 'Unable to update Featured Link ID '.$id.'.');
		}

		unset($_POST);
		redirect('admin/flinks');
	}

	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Featured Link');
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

/* End of file flinks.php */
/* Location: ./application/controllers/admin/flinks.php */
