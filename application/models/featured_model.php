<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Featured_model extends CI_Model{
	protected $table = 'featured';
	protected $visitors_count = 'visitors_count';

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
	 * @param array of selected parameter, array of sql's parameters other than 'WHERE'
	 * @return array of objects, or false 
	 */
	public function get($featured=false,$sql_params=false){
		if($featured){
			foreach($featured as $key=>$value){
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


	public function corrected_get($featured=false,$sql_params=false){
		$data = $this->get($featured,$sql_params);
		if(count($data))
		foreach($data as $key=>$val){
			if($val->wardrobe_link){
				$val->wardrobe_link = anchor(	urldecode($val->wardrobe_link),
												$val->wardrobe,
												'class="link" target="_blank"'
											);
			}else{
				$val->wardrobe_link = $val->wardrobe;
			}
			if($val->location_link){
				$val->location_link = anchor(	urldecode($val->location_link),
												$val->location,
												'class="link" target="_blank"'
											);
			}else{
				$val->location_link = $val->location;
			}
			if($val->make_up_link){
				$val->make_up_link = anchor(	urldecode($val->make_up_link),
												$val->make_up,
												'class="link" target="_blank"'
											);
			}else{
				$val->make_up_link = $val->make_up;
			}
			if($val->photographer_link){
				$val->photographer_link = anchor(urldecode($val->photographer_link),
												$val->photographer,
												'class="link" target="_blank"'
											);
			}else{
				$val->photographer_link = $val->photographer;
			}
			if($val->model_by_link){
				$val->model_by_link = anchor(	urldecode($val->model_by_link),
												$val->model_by,
												'class="link" target="_blank"'
											);
			}else{
				$val->model_by_link = $val->model_by;
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
			$data = $this->update($data);
		
		//insert new data
		}else{
			$this->load->helper('utilites_helper');
			$folder_name = $data->link;

			//configure data for positioning & update db
			$data->position = $this->db->count_all_results($this->table);

			$this->db->insert($this->table,$data);

			$data = array('id'=>$this->db->insert_id());

			//create new folder -- by featured model's name -- to place galleries & imgs.
			$this->load->helper('utilites_helper');
			make_dir(FEATUREDPATH, $folder_name);
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

		//$new_folder_name = gen_folder_name($data->name);
		//
		//rename(FEATUREDPATH.$old_folder_name, FEATUREDPATH.$new_folder_name);

		//$data->id = $data;

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
		$this->load->helper('utilites_helper');

		foreach($items as $key=>$val){
			$folder_name = gen_folder_name($val->name);

			//delete the directory & all the ones in it.
			delete_files(FEATUREDPATH.$folder_name, true);
			rmdir(FEATUREDPATH.$folder_name);

			$this->db->where('id',$val->id)
					 ->delete($this->table);

		 	$this->db->where('type','featured')
		 			->where('model_id',$val->id)
		 			->delete($this->visitors_count);

			//readjust the positions of the ads
			$update_position = array('position'=>'position - 1');
			$this->db->where('position > ',$val->position);
		 	$this->db->update($this->table,$update_position);
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

/* End of file featured_model.php */
/* Location: ./application/models/featured_model.php */
