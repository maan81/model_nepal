<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model{
	protected $table = 'news';

	public function __construct(){
		parent::__construct();
	}


	/**
	 * get news [of selected parameter]
	 * @param array of selected parameter
	 * @return array of objects, or false 
	 */
	public function get($news=false){
		if($news){
			foreach($news as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);

		if(count($res->result())){
			//return the processed result
			return $this->_process($res->result());

		}else{
			return false;
		}
	}


	/**
	 * Process obained data to include the news type array
	 * @param array of objects [news array]
	 * @return array of objects [news array with processed news type]
	 */
	private function _process($data){
		$this->config->load('news_type');

		$type = $this->config->item('news_type');

		foreach($data as $key=>$val){
			$val->type = $type[$val->type];
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
		if(!$data)
			return false;

		$data = (object)$data;

		//update data
		if(isset($data->id)){
			$this->update($data);
		
		//insert new data
		}else{

			$tmp = $_FILES['image']['name'];
			$ext =  end(explode('.',$tmp));
			$mtime = microtime(true).'.'.$ext;

			$config = array(
						  'allowed_types' => 'jpg|jpeg|gif|png',
						  'upload_path' => NEWSSPATH,
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

				$image_data = (array)$this->upload->data();
				/*
				$data = array(
							'image' 		=> $image_data['file_name'],
							'title' 		=> $this->input->post('title'),
							'category'		=> $this->input->post('category'),
							'dimensions' 	=> $this->input->post('dimensions'),
							'link'			=> $this->input->post('link'),
						);
				*/
//print_r($image_data);die;
				$data->image = $image_data['file_name'];

				$this->db->insert($this->table,$data);
				
				unset($data);
				$data->id = $this->db->insert_id();

				return $this->get($data);
			}
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
	public function del($data){
		
		if(!$data){
			return false;
		}
		$items = $this->get($data);
		foreach($items as $key=>$val){

			unlink(NEWSSPATH.$val->image);

			$this->db->where('id',$val->id)
					 ->delete($this->table);
		}
		return true;
	}
}

/* End of file news_model.php */
/* Location: ./application/models/news_model.php */