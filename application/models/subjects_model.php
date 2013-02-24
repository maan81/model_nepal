<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subjects_model extends CI_Model{
	protected $table = 'subjects';

	public function __construct(){
		parent::__construct();
	}


	/**
	 * get ads [of selected parameter]
	 */
	public function get($subjects=null){

		if(count($subjects)>0){
			foreach($subjects as $key=>$value){
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
	 * set/update subject's info
	 * returns the the inserted object
	 */
	public function set($data=null){

		$this->db->insert($this->table,$data);

		$data = $this->db->insert_id();

		$data = $this->get(array('id'=>$data));

		return $data;
	}



	/**
	 * delete ads
	 *
	 * @param array of enws ids to be deleted
	 * 		  OR int
	 * @return boolean
	 */
	public function del($ids){
		
		//~ $items = $this->get(array('id'=>$ids));
//~ //echo '<pre>';
//~ //print_r($items);
//~ //echo '</pre>';
//~ //die;
		//~ foreach($items as $item){
			//~ unlink(ADDSPATH.$item->image);
//~ 
			//~ $this->db->where('id',$item->id)
					//~ ->delete($this->table);
		//~ }
//~ 
//~ 
		//~ return true;
	}


	/**
	 * change the active vips
	 *
	 * @param id int
	 * @param active boolean
	 */
	public function change_active($ids=false,$active=false){
//~ 
		//~ $this->db->set(	'active',$active=='true'?1:0 )
				//~ ->where('id',$ids)
				//~ ->update($this->table);
//~ //echo $this->db->last_query();				
	//~ }
//~ 
//~ 
	//~ /**
	 //~ * download existing news
	 //~ */
	//~ private function download($data){
//~ 
		//~ $update = array(
					   //~ 'title' 		=> $data[0],
					   //~ 'content' 	=> $data[1],
					   //~ 'date_published' => $data[3],
					   //~ 'date_removed' => $data[4]
					//~ );
//~ 
		//~ $this->db->where('id', $data['id']);
		//~ $this->db->update('news', $update);
//~ 
		//~ return $data['id'];
	}
}

/* End of file ads_model.php */
/* Location: ./application/models/ads_model.php */
