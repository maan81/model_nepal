<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gossips_model extends CI_Model{
	protected $table = 'gossips';

	public function __construct(){
		parent::__construct();
	}


	/**
	 * get gossips [of selected parameter]
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
		$data = array(
					'title'		=> $this->input->post('title'),
					'summary'	=> $this->input->post('summary'),
					'content'	=> $this->input->post('content')
				);
		$this->db->insert($this->table,$data);
		return (object)$data;
	}



	/**
	 * delete gossips
	 *
	 * @param array of enws ids to be deleted
	 * 		  OR int
	 * @return boolean
	 */
	public function del($ids){
		
		$items = $this->get(array('id'=>$ids));
		foreach($items as $item){
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

/* End of file gossips_model.php */
/* Location: ./application/models/gossips_model.php */
