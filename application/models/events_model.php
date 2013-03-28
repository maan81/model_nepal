<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events_model extends CI_Model{
	protected $table = 'events';

	public function __construct(){
		parent::__construct();
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
	 * get events
	 * @param array of selected parameter
	 * @return array of objects, or false 
	 */
	public function get($events=false){
		if($events){
			foreach($events as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);

		return count($res->result())?$res->result():false;
	}

	/**
	 * corrected get
	 */
	public function corrected_get($events=false){
		$data=$this->get($events);
		
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
	 * set/update record's info
	 * @param record array/object
	 * @return the inserted/updated object
	 */
	public function set($data=false){
		if(!$data)
			return false;

		$data = (object)$data;

		//update data
		if(isset($data->id)){
			$this->update($data);
		
		//insert new data
		}else{
			$this->db->insert($this->table,$data);

			$data = array('id'=>$this->db->insert_id());
			$data = $this->get($data);

			//create new folder -- by event title's name
			$this->load->helper('utilites_helper');
			$folder_name = gen_folder_name($data[0]->title);
			make_dir(EVENTSPATH, $folder_name);
		}

		return $data;
	}



	/**
	 * update record's info
	 * @param record array/object
	 */
	private function update($data){
		$id = $data->id;
		unset($data->id);
	
		$this->db->where('id', $id);
		$this->db->update($this->table, $data); 
		return true;
	}



	/**
	 * delete objects
	 *
	 * @param array of objects ids to be deleted
	 * @return boolean
	 */
	public function del($data){
		
		if(!$data){
			return false;
		}
		$items = $this->get($data);

		$this->load->helper(array('utilites_helper','file'));
		foreach($items as $key=>$val){

			//delete the directory & all the ones in it.
			delete_files(EVENTSPATH.gen_folder_name($val->title), true);
			rmdir(EVENTSPATH.gen_folder_name($val->title));

			$this->db->where('id',$val->id)
					 ->delete($this->table);
		}
		return true;
	}
}

/* End of file events_model.php */
/* Location: ./application/models/events_model.php */
