<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class flinks_model extends CI_Model{
	protected $table = 'flinks';

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
	 * get flinks
	 * @param array of selected parameter
	 * @return array of objects, or false 
	 */
	public function get($flinks=false,$sql_params=false){
		if($flinks){
			foreach($flinks as $key=>$value){
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
				$this->db->limit( $sql_params['limit']['size'], $sql_params['limit']['start'] );
			}
		}

		$res = $this->db->get($this->table);

		return count($res->result())?$res->result():false;
	}


	/**
	 * corrected get
	 */
	public function corrected_get($flinks=false){
		$data=$this->get($flinks);
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
			if($updated_id=$this->update($data)){
				$data = array('id'=>$updated_id);
				$data = $this->get($data);
			}
		
		//insert new data
		}else{

			$tmp = $_FILES['image']['name'];
			$ext =  end(explode('.',$tmp));
			$mtime = microtime(true).'.'.$ext;

			$config = array(
						  'allowed_types' => 'jpg|jpeg|gif|png',
						  'upload_path' => FLINKSPATH,
						  'maintain_ratio' => true,
						  'max-size' => 20000,
						  'overwrite' => true,
						  'file_name' => $mtime
						);	

			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if(!$this->upload->do_upload('image')){
				echo $this->upload->display_errors();

			}else{
				$image_data = $this->upload->data();
				

				$data->image = $image_data['file_name'];
				$data->position	= $this->db->count_all($this->table)+1;

				$this->db->insert($this->table,$data);
				
				unset($data);

				$data = $this->get(array(
									'id'=>$this->db->insert_id()
										)
									);
			}
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
			unlink(FLINKSPATH.$val->image);

			$this->db->where('id',$val->id)
					 ->delete($this->table);

			//readjust the positions of the flinks
			$this->db->set('position', 'position-1', FALSE);
			$this->db->where('position > ',$val->position);
		 	$this->db->update($this->table);
		}
		return true;
	}


	/**
	 * Decrement the position of the selected id
	 * @param int id ofthe ad
	 * @return boolean
	 */
	public function decrement($id=false){

		if(!$id){
			return false;
		}

		$this->db->set('position', 'position - 1', FALSE);
		$this->db->where('id', $id);
		$this->db->update($this->table);

		return true;
	}


	/**
	 * Increment the position of the selected id
	 * @param int id ofthe ad
	 * @return boolean
	 */
	public function increment($id=false){

		if(!$id){
			return false;
		}

		$this->db->set('position', 'position + 1', FALSE);
		$this->db->where('id', $id);
		$this->db->update($this->table);

		return true;
	}
}

/* End of file flinks_model.php */
/* Location: ./application/models/flinks_model.php */
