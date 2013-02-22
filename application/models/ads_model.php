<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads_model extends CI_Model{
	protected $table = 'ads';

	public function __construct(){
		parent::__construct();
	}


	/**
	 * get ads [of selected parameter]
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
	 */
	public function record_count(){
		return $this->db->count_all($this->table);
	}

	//not running yet
	public function update($data=null){
	}

	/**
	 * set & upload nu file
	 * returns the id
	 */
	public function set($data=null){
//echo '<pre>';
//print_r($_FILES);
//print_r($_POST);
//echo '</pre>';
//die;
		$tmp = $_FILES['image']['name'];
		$ext =  end(explode('.',$tmp));
		$mtime = microtime(true).'.'.$ext;
//echo $mtime.'<br/>';
		$config = array(
					  'allowed_types' => 'jpg|jpeg|gif|png',
					  'upload_path' => ADDSPATH,
					  'maintain_ratio' => true,
					  'max-size' => 20000,
					  'overwrite' => true,
					  'file_name' => $mtime
					);
//echo '<pre>';
//print_r($config);
//echo '</pre>';
//die;

		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('image')){
			echo $this->upload->display_errors();

		}else{

			$image_data = $this->upload->data();
//echo '<pre>';
//print_r($image_data);
//echo '</pre>';
			$data = array(
						'image' 		=> $image_data['file_name'],
						'name' 			=> $this->input->post('name'),
						'category'		=> $this->input->post('category'),
						'dimensions' 	=> $this->input->post('dimensions'),
						'link'			=> $this->input->post('link'),
					//	'timestamp'		=> $mtime,
					//	'date_created'	=> $this->session->userdata('date_created'),
					//	'file_type'		=> $type
					);

//print_r($_POST);
//print_r($data);die;
			$this->db->insert($this->table,$data);

			$data = array_merge($data,array('id'=>$this->db->insert_id()));
//echo '<pre>';
//print_r($data);
//echo '</pre>';
//die;
			return $data;
		}
	}



	/**
	 * delete ads
	 *
	 * @param array of enws ids to be deleted
	 * 		  OR int
	 * @return boolean
	 */
	public function del($ids){
		
		$items = $this->get(array('id'=>$ids));
//echo '<pre>';
//print_r($items);
//echo '</pre>';
//die;
		foreach($items as $item){
			unlink(ADDSPATH.$item->image);

			$this->db->where('id',$item->id)
					->delete($this->table);
		}


		return true;
	}


	/**
	 * change the active vips
	 *
	 * @param id int
	 * @param active boolean
	 */
	public function change_active($ids=false,$active=false){

		$this->db->set(	'active',$active=='true'?1:0 )
				->where('id',$ids)
				->update($this->table);
//echo $this->db->last_query();				
	}


	/**
	 * download existing news
	 */
	private function download($data){

		$update = array(
					   'title' 		=> $data[0],
					   'content' 	=> $data[1],
					   'date_published' => $data[3],
					   'date_removed' => $data[4]
					);

		$this->db->where('id', $data['id']);
		$this->db->update('news', $update);

		return $data['id'];
	}
}

/* End of file ads_model.php */
/* Location: ./application/models/ads_model.php */
