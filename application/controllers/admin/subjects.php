<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subjects extends MY_Controller {

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

		$this->load->model('subjects_model');
	}

	public function index(){
		$this->list_subjects();
	}
	
	public function list_subjects(){
		$data = $this->subjects_model->get();

		$this->template->set_template('admin');

		$subjects = $this->adminrender_library->render_subjectslist($data);

		$this->template->write('list',$subjects);
		
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
    
    
    public function new_subject($data = false){
		
		if($this->input->post('professional')){

			$data = array(
							'name'			=> $this->input->post('name'),
							'gender'		=> $this->input->post('gender'),
							'ethnicity'		=> $this->input->post('ethnicity'),
							'age' 			=> $this->input->post('age'),
							'address'		=> $this->input->post('address'),
							'contact_no'	=> $this->input->post('contact_no'),
							'email' 		=> $this->input->post('email'),
							'height'		=> $this->input->post('height'),
							'weight' 		=> $this->input->post('weight'),
							'bust' 			=> $this->input->post('bust'),
							'waist' 		=> $this->input->post('waist'),
							'hips' 			=> $this->input->post('hips'),
							'shoe' 			=> $this->input->post('shoe'),
							'dress' 		=> $this->input->post('dress'),
							'hair_color' 	=> $this->input->post('hair_color'),
							'hair_length'	=> $this->input->post('hair_length'),
							'skin'			=> $this->input->post('skin'),
							'eyes' 			=> $this->input->post('eyes'),
							'teeth' 		=> $this->input->post('teeth'),
							'professional' 	=> $this->input->post('professional'),
							'additional'	=> $this->input->post('additional'),
							'travelling_area'=>$this->input->post('travelling_area'),
							'travelling_duration'=>$this->input->post('travelling_duration'), 
							'editorial'		=>$this->input->post('editorial'),
							'runaway' 		=> $this->input->post('runaway'),
							'catalog' 		=> $this->input->post('catalog'),
							'print' 		=> $this->input->post('print'),
							'showroom' 		=> $this->input->post('showroom'),
							'fitness'		=> $this->input->post('fitness'),
							'fit' 			=> $this->input->post('fit'),
							'tearoom' 		=> $this->input->post('tearoom'),
							'body_part' 	=> $this->input->post('body_part'),
							'lingerie'		=> $this->input->post('lingerie'),
							'product_modelling'=>$this->input->post('product_modelling'),
							'lifestyle_modelling'=>$this->input->post('lifestyle_modelling'),
							'coorporate_modelling'=>$this->input->post('coorporate_modelling'),
							'product_demo'	=> $this->input->post('product_demo'),
							'tradeshow'		=> $this->input->post('tradeshow'),
							'lingrie' 		=> $this->input->post('lingrie'),
							'art' 			=> $this->input->post('art'),
							'experience' 	=> $this->input->post('experience'),
							'date_created'	=> $this->input->post('date_created'),
							'created_by'	=> $this->session->userdata('username'),
						);

			$this->_validate_new($data);
			
			if($this->_validated){
				//input new data
				$data = $this->subjects_model->set($data);
				$this->session->set_flashdata('msg','New Agency Model saved.');
				redirect('admin/subjects/edit/'.$data[0]->id);

			}else{
				//err in validation....
				$this->session->set_flashdata('msg','Unable to save New Agency Model.');
				redirect('admin/subjects/new_subject');
			}
		}
	
		$this->template->set_template('admin');
		$new_subjects = $this->adminrender_library->render_new_subjects($data);
		$this->template->write('new_item',$new_subjects);
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
			$this->subjects_model->del($data);
			$this->session->set_flashdata('msg', 'Agency Model ID '.$id.' deleted.');			
			
		}else{
			$this->session->set_flashdata('msg', 'Unable to delete Agency Model ID '.$id.'.');
		}
		redirect('admin/subjects');
	}

	private function _validate_del($data){
		$this->_validated = true;
	}
	
	public function edit($id=false){
		// id error
		if(!$id){
			return false;
		}
		if($this->input->post('professional')){

			$id = $this->session->userdata('updated_id');
	
			$data = array(
							'id'			=> $id,
							'name'			=> $this->input->post('name'),
							'gender'		=> $this->input->post('gender'),
							'ethnicity'		=> $this->input->post('ethnicity'),
							'age' 			=> $this->input->post('age'),
							'address'		=> $this->input->post('address'),
							'contact_no'	=> $this->input->post('contact_no'),
							'email' 		=> $this->input->post('email'),
							'height'		=> $this->input->post('height'),
							'weight' 		=> $this->input->post('weight'),
							'bust' 			=> $this->input->post('bust'),
							'waist' 		=> $this->input->post('waist'),
							'hips' 			=> $this->input->post('hips'),
							'shoe' 			=> $this->input->post('shoe'),
							'dress' 		=> $this->input->post('dress'),
							'hair_color' 	=> $this->input->post('hair_color'),
							'hair_length'	=> $this->input->post('hair_length'),
							'skin'			=> $this->input->post('skin'),
							'eyes' 			=> $this->input->post('eyes'),
							'teeth' 		=> $this->input->post('teeth'),
							'professional' 	=> $this->input->post('professional'),
							'additional'	=> $this->input->post('additional'),
							'travelling_area'=>$this->input->post('travelling_area'),
							'travelling_duration'=>$this->input->post('travelling_duration'), 
							'editorial'		=>$this->input->post('editorial'),
							'runaway' 		=> $this->input->post('runaway'),
							'catalog' 		=> $this->input->post('catalog'),
							'print' 		=> $this->input->post('print'),
							'showroom' 		=> $this->input->post('showroom'),
							'fitness'		=> $this->input->post('fitness'),
							'fit' 			=> $this->input->post('fit'),
							'tearoom' 		=> $this->input->post('tearoom'),
							'body_part' 	=> $this->input->post('body_part'),
							'lingerie'		=> $this->input->post('lingerie'),
							'product_modelling'=>$this->input->post('product_modelling'),
							'lifestyle_modelling'=>$this->input->post('lifestyle_modelling'),
							'coorporate_modelling'=>$this->input->post('coorporate_modelling'),
							'product_demo'	=> $this->input->post('product_demo'),
							'tradeshow'		=> $this->input->post('tradeshow'),
							'lingrie' 		=> $this->input->post('lingrie'),
							'art' 			=> $this->input->post('art'),
							'experience' 	=> $this->input->post('experience'),
							'date_created'	=> $this->input->post('date_created'),
						);

			$this->_validate_new($data);
			
			if($this->_validated){
				//input new data
				$data = $this->subjects_model->set($data);
				$this->session->set_flashdata('msg', 'Agency Model ID '.$id.' updated.');			
			}else{
				//err in validation....
				$this->session->set_flashdata('msg', 'Unable to update Agency Model ID '.$id.'.');
			}

			unset($_POST);
			redirect('admin/subjects/edit/'.$data[0]->id);
		}

		$data = $this->subjects_model->get(array('id'=>$id));
		$this->new_subject($data);
		$this->session->set_userdata('updated_id',$id);
	}

	/**
	 * Shift the given ad ID 1 setp up
	 * @param int -- subject id
	 * @return
	 */
	public function up($id=false){
		if(!$id){
			redirect('admin/subjects');
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
			$cur_data = $this->subjects_model->get(array('id'=>$id));

			//the data to be moved down			
			$upper_data = $this->subjects_model->get(array('position'=>$cur_data[0]->position - 1));

			//move the data down
			$this->subjects_model->increment($upper_data[0]->id);

			//move the data up
			$this->subjects_model->decrement($cur_data[0]->id);


			$this->session->set_flashdata('msg', 'Subject ID '.$id.' updated.');			
		}else{
			//err in validation....
			$this->session->set_flashdata('msg', 'Unable to update Subject ID '.$id.'.');
		}

		unset($_POST);
		redirect('admin/subjects');
	}



	/**
	 * Shift the given subject ID 1 step down
	 * @param int -- subject id
	 * @return
	 */
	public function down($id=false){
		if(!$id){
			redirect('admin/subjects');
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
			$cur_data = $this->subjects_model->get(array('id'=>$id));

			//the data to be moved up			
			$lower_data = $this->subjects_model->get(array('position'=>$cur_data[0]->position + 1 ));

			//move the data up
			$this->subjects_model->decrement($lower_data[0]->id);

			//move the data down
			$this->subjects_model->increment($cur_data[0]->id);

			$this->session->set_flashdata('msg', 'Subject ID '.$id.' updated.');			
		}else{
			//err in validation....
			$this->session->set_flashdata('msg', 'Unable to update Subject ID '.$id.'.');
		}

		unset($_POST);
		redirect('admin/subjects');
	}
	private function render_navigation(){
		$menu = $this->adminrender_library->render_navigation('Models');
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
		}
	}
}

/* End of file subjects.php */
/* Location: ./application/controllers/admin/subjects.php */
