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
	public function get($ads=false,$order_by=false,$order_type=false){
		if($ads){
			foreach($ads as $key=>$value){
				$this->db->where($key,$value);
			}
		}

		if($order_by){
			$this->db->order_by($order_by.' '.$order_type);			
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
	 *  Insert new script ad
	 *  @param record array/object
	 *  @return the inserted/updated object
	 */
	private function _set_script($data){
		//insert new data
		$this->db->insert($this->table,$data);

		//unset the data & get tne new id
		unset($data);
		$data['id'] = $this->db->insert_id();

		//configure data for positioning & update db
		$data2 = array(
		               'position' => $this->db->count_all_results($this->table),
		            );
		$this->db->update($this->table, $data2, 'id = '.$data['id']); 

		//get the new inserted data
		return $this->get($data);
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
			return $this->update($data);

		//insert new data
		}else{

			//insert new script ad
			if($data->type=='script'){
				return $this->_set_script($data);
			}

			//else insert new image ad

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
				unset($data);
				$image_data = $this->upload->data();
				
				$data = array(
							'image' 		=> $image_data['file_name'],
							'title' 		=> $this->input->post('title'),
							'category'		=> $this->input->post('category'),
							'dimensions' 	=> $this->input->post('dimensions'),
							'link'			=> $this->input->post('link'),
							'position'		=> $this->db->count_all($this->table),
						);
				
				$data['image'] = $image_data['file_name'];

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
		//update existing script ad
		if($data->type=='script'){
			return $this->_update_script($data);
		}

		$id = $data->id;
		unset($data->id);
		unset($data->title);


		$this->db->where('id', $id);
		$this->db->update($this->table, $data); 

		return $this->get(array('id'=>$id));

		//$data->id = $id;
		//return $data;
	}


	/**
	 * update record's info
	 * @param record array/object
	 */
	private function _update_script($data){
		$id = $data->id;
		unset($data->id);
		unset($data->title);

		$this->db->where('id', $id);
		$this->db->update($this->table, $data); 

		return $this->get(array('id'=>$id));

		//$data->id = $id;
		//return $data;
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
	
			if($val->type == 'image'){
				unlink(ADDSPATH.$val->image);
			}

			$this->db->where('id',$val->id)
					 ->delete($this->table);

			//readjust the positions of the ads
			$update_position = array('position'=>'position - 1');
			$this->db->where('position > ',$val->position);
		 	$this->db->update($table,$update_position);
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


/* End of file ads_model.php */
/* Location: ./application/models/ads_model.php */
