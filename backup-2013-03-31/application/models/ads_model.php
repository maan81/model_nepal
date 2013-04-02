<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads_model extends CI_Model{
	protected $table = 'ads';

	public function __construct(){
		parent::__construct();

		$this->load->helper('file');
	}


	/**
	 * get ads 
	 * @param array of selected parameter
	 * @return array of objects, or false 
	 */
	public function get($ads=false){
		if($ads){
			foreach($ads as $key=>$value){
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
		if(!$data)
			return false;

		$data = (object)$data;

		//update data
		if(isset($data->id)){
			$data = $this->update($data);

		//insert new data
		}else{

			$tmp = $_FILES['image']['name'];
			$ext =  end(explode('.',$tmp));
			$mtime = microtime(true).'.'.$ext;

			$config = array(
						  'allowed_types' => 'jpg|jpeg|gif|png',
						  'upload_path' => ADDSPATH,
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
				$data = array(
							'image' 		=> $image_data['file_name'],
							'title' 		=> $this->input->post('title'),
							'category'		=> $this->input->post('category'),
							'dimensions' 	=> $this->input->post('dimensions'),
							'link'			=> $this->input->post('link'),
						);

				$this->db->insert($this->table,$data);
				
				unset($data);
				$data['id'] = $this->db->insert_id();

				return $this->get($data);
			}
		}
	}

	/**
	 * update record's info
	 * @param record array/object
	 */
	private function update($data){
		$id = $data->id;
		unset($data->id);
//print_r($data);die;	
		$this->db->where('id', $id);
		$this->db->update($this->table, $data); 

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
		foreach($items as $key=>$val){
			unlink(ADDSPATH.$val->image);
 
			$this->db->where('id',$val->id)
					 ->delete($this->table);
		}
		return true;
	}
}

/* End of file ads_model.php */
/* Location: ./application/models/ads_model.php */
