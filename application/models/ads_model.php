<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads_model extends CI_Model{
	protected $table = 'ads';

	public function __construct(){
		parent::__construct();
	}


	/**
	 * get ads [of selected parameter]
	 */
	public function get($ads=null){

		if(count($ads)>0){
			foreach($ads as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);

		return $res->result();
	}


	/**
	 * count records
	 */
	public function record_count(){
		return $this->db->count_all($this->table);
	}


	/**
	 * store & upload nu file
	 * returns the id
	 */
	public function upload($type=null){
//echo '<pre>';
//print_r($_FILES);
//print_r($_POST);
//echo '</pre>';

		$tmp = $_FILES['file']['name'];
		$ext =  end(explode('.',$tmp));
		$mtime = microtime(true).'.'.$ext;
//echo $mtime.'<br/>';
		$config = array(
					  'allowed_types' => 'jpg|jpeg|gif|png|txt|pdf|doc|docx',
					  'upload_path' => DOCUMENTS,
					  'maintain_ratio' => true,
					  'max-size' => 20000,
					  'width' => 2000,
					  'height' => 1500,
					  'overwrite' => true,
					  'file_name' => $mtime
					);
//echo '<pre>';
//print_r($config);
//echo '</pre>';


		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('file')){
			echo $this->upload->display_errors();

		}else{

			$image_data = $this->upload->data();

			$data = array(
						'filename' 		=> $_FILES['file']['name'],
						'title' 		=> $this->input->post('title'),
						'description'	=> $this->input->post('description'),
						'title_np' 		=> $this->input->post('title_np'),
						'description_np'=> $this->input->post('description_np'),
						'timestamp'		=> $mtime,
						'created_by'	=> $this->ion_auth->get_user()->username,
						'date_created'	=> $this->session->userdata('date_created'),
					//	'file_type'		=> $type
					);

//print_r($_POST);
//print_r($data);die;
			$this->db->insert($this->table,$data);

			$data = array_merge($data,array('id'=>$this->db->insert_id()));

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
		$vip = $this->get($ids);
//print_r($files);
		foreach($vip as $file){
			unlink(DOCUMENTS.$file->timestamp);
		}


		$this->db->where('id',$ids['id'])
				->delete($this->table);

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
