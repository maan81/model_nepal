<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book_model extends CI_Model{
	protected $table = 'book';

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
	 * get booked [of selected parameter]
	 * @param array of selected parameter, array of sql's parameters other than 'WHERE'
	 * @return array of objects, or false 
	 */
	public function get($booked=false,$sql_params=false){
		if($booked){
			foreach($booked as $key=>$value){
				if($key=='date_created'){
					$this->db->where($key.' >=',$value.'-01');
					$this->db->where($key.' <=',$value.'-31');

					continue;
				}

				$this->db->where($key,$value);
			}
		}
		if($sql_params){
			if(isset($sql_params['order_by'])){
				$this->db->order_by($sql_params['order_by']['coln'],$sql_params['order_by']['dir']);
			}
			if(isset($sql_params['limit'])){
				$this->db->limit($sql_params['limit']['size'],$sql_params['limit']['start']);
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
		$this->load->helper('utilites_helper');
		$id = $data->id;
		unset($data->id);
		unset($data->name);
	
		//$old_data = $this->get(array('id'=>$id));
		//$old_folder_name = gen_folder_name($old_data[0]->name);
		//
		$this->db->where('id', $id);
		
		if($this->db->update($this->table, $data)){
			return (object) array('id'=>$id);
		}
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


	/**
	 * Book the selected subject
	 * @param array of data to be booked.
	 */
	public function book($data){
		
		return $this->set($data);
	}
}

/* End of file featured_model.php */
/* Location: ./application/models/featured_model.php */
