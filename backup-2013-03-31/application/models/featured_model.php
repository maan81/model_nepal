<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Featured_model extends CI_Model{
	protected $table = 'featured';

	public function __construct(){
		parent::__construct();
		
		$this->load->helper('file');
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
	 * get featured [of selected parameter]
	 * @param array of selected parameter
	 * @return array of objects, or false 
	 */
	public function get($featured=false){

		if($featured){
			foreach($featured as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);
		return count($res->result())?$res->result():false;
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
			$data = $this->update($data);
		
		//insert new data
		}else{
			$this->load->helper('utilites_helper');
			$folder_name = gen_folder_name($data->name);

			$this->db->insert($this->table,$data);

			$data = array('id'=>$this->db->insert_id());

			//create new folder -- by featured model's name -- to place galleries & imgs.
			mkdir(FEATUREDPATH.$folder_name);
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
		$data = $this->db->update($this->table, $data); 
		$new_folder_name = gen_folder_name($data->name);

		rename(FEATUREDPATH.$old_folder_name, FEATUREDPATH.$new_folder_name);

		$data->id = $id;

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
			delete_files(FEATUREDPATH.$folder_name, true);
			rmdir(FEATUREDPATH.$folder_name);

			$this->db->where('id',$val->id)
					 ->delete($this->table);
		}
		return true;
	}
}

/* End of file featured_model.php */
/* Location: ./application/models/featured_model.php */
