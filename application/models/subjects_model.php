<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subjects_model extends CI_Model{
	protected $table = 'subjects';
	protected $visitors_count = 'visitors_count';

	public function __construct(){
		parent::__construct();

		$this->load->helper('file');
	}


	/**
	 * get subjects [of selected parameter]
	 * @param array of selected parameter
	 * @return array of objects, or false 
	 */
	public function get($subjects=false){
//print_r($subjects);
		if($subjects){
			foreach($subjects as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);
		return count($res->result())?$res->result():false;
	}


	/**
	 * corrected get
	 */
	public function corrected_get($subjects=false){
		$data=$this->get($subjects);
		
		if($data){
		foreach($data as $key=>$val){
			if($val->editorial){
				$val->fashion_type['editorial']	= true;
			}
			if($val->runaway){
				$val->fashion_type['runaway']	= true;
			}
			if($val->catalog){
				$val->fashion_type['catalog']	= true;
			}
			if($val->print){
				$val->fashion_type['print']		= true;
			}
			if($val->showroom){
				$val->fashion_type['showroom']	= true;
			}
			if($val->fitness){
				$val->fashion_type['fitness']	= true;
			}
			if($val->fit){
				$val->fashion_type['fit']		= true;
			}
			if($val->tearoom){
				$val->fashion_type['tearoom']	= true;
			}
			if($val->body_part){
				$val->fashion_type['body_part']	= true;
			}
			if($val->lingerie){
				$val->fashion_type['lingerie']	= true;
			}



			if($val->product_modelling){
				$val->commercial_type['product_modelling']		= true;
			}
			if($val->lifestyle_modelling){
				$val->commercial_type['lifestyle_modelling']	= true;
			}
			if($val->coorporate_modelling){
				$val->commercial_type['coorporate_modelling']	= true;
			}
			if($val->product_demo){
				$val->commercial_type['product_demo']			= true;
			}
			if($val->tradeshow){
				$val->commercial_type['tradeshow']				= true;
			}



			if($val->lingrie){
				$val->glamour['lingrie']		= true;
			}
			if($val->art){
				$val->glamour['art']			= true;
			}

		}
		}

		return $data;
	}


	/**
	 * count records
	 * @param records array/object
	 * @return integer
	 */
	public function record_count($data=false){
		if($data){
			foreach($data as $key=>$val){
				$this->db->where($key,$val);
			}
		}
		return $this->db->count_all_records($this->table);
	}


	/**
	 * set/update record's info
	 * @param record array/object
	 * @return the inserted/updated object
	 */
	public function set($data=false){
//echo '<pre>';
//print_r($data);
//echo '</pre>';
//die;
		if(!$data)
			return false;

		$data = (object)$data;

		//update data
		if(isset($data->id)){
			$data = $this->update($data);

		//insert new data
		}else{
			$this->load->helper('utilites_helper');
			$folder_name = gen_folder_name($data->name);

			$this->db->insert($this->table,$data);

			$data = array('id'=>$this->db->insert_id());

			//create new folder -- by subject model's name -- to place imgs
			$this->load->helper('utilites_helper');
			make_dir(SUBJECTSPATH, $folder_name);
			make_dir(SUBJECTSPATH.'/'.$folder_name,'thumbs');
		}

		return $this->get($data);
	}

	/**
	 * update record's info
	 * @param record array/object
	 */
	private function update($data){
		$this->load->helper('utilites_helper');
		$id = $data->id;
		unset($data->id);
	
		$old_data = $this->get(array('id'=>$id));
		$old_folder_name = gen_folder_name($old_data[0]->name);

		$this->db->where('id', $id);
		$this->db->update($this->table, $data); 
		$new_folder_name = gen_folder_name($data->name);

		rename(SUBJECTSPATH.$old_folder_name, SUBJECTSPATH.$new_folder_name);

		return $data;
	}

	/**
	 * delete objects
	 *
	 * @param array of objects ids to be deleted
	 * @return boolean
	 */
	public function del($data=false){

		if(!$data){
			return false;
		}
		$items = $this->get($data);
		
		$this->load->helper('utilites_helper');

		foreach($items as $key=>$val){
			$folder_name = gen_folder_name($val->name);

			//delete the directory & all the ones in it.
			delete_files(SUBJECTSPATH.$folder_name, true);
			rmdir(SUBJECTSPATH.$folder_name);

			$this->db->where('id',$val->id)
					 ->delete($this->table);

		 	$this->db->where('type','featured')
		 			->where('model_id',$val->id)
		 			->delete($this->visitors_count);
		}
		return true;
	}
}

/* End of file subjects_model.php */
/* Location: ./application/models/subjects_model.php */
