<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gossips_model extends CI_Model{
	protected $table = 'gossips';

	public function __construct(){
		parent::__construct();
	}


	/**
	 * get gossips
	 * @param array of selected parameter
	 * @return array of objects, or false 
	 */
	public function get($gossips=false){
		if($gossips){
			foreach($gossips as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);
		return count($res->result())?$res->result():false;
	}


	/**
	 * count records
	 * @param subject array/object
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
		}

		return $this->get($data);
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
	public function del($data=false){

		if(!$data){
			return false;
		}
		$items = $this->get($data);
		
		foreach($items as $key=>$val){
			$this->db->where('id',$val->id)
					 ->delete($this->table);
		}
		return true;
	}
}

/* End of file gossips_model.php */
/* Location: ./application/models/gossips_model.php */
