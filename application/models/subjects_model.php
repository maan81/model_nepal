<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subjects_model extends CI_Model{
	protected $table = 'subjects';

	public function __construct(){
		parent::__construct();
	}


	/**
	 * get ads [of selected parameter]
	 * @param array of selected parameter
	 * @return array of objects, or false 
	 */
	public function get($subjects=false){
print_r($subjects);
		if($subjects){
			foreach($subjects as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);
		return count($res->result())?$res->result():false;
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
			$this->update($data);

		//insert new data
		}else{
			$this->db->insert($this->table,$data);

			$data = $this->db->insert_id();
		}

		return $this->get($data);
	}

	/**
	 * update record's info
	 * @param record array/object
	 */
	private function update($data){
		unset($data->id);
	
		$this->db->where('id', $id);
		$this->db->update($this->table, $data); 
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
		$items = $this->get(array('id'=>$ids));
		
		foreach($items as $key=>$val){
			$this->db->where('id',$val->id)
					 ->delete($this->table);
		}
		return true;
	}
}

/* End of file subjects_model.php */
/* Location: ./application/models/subjects_model.php */
