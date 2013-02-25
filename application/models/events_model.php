<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events_model extends CI_Model{
	protected $table = 'events';

	public function __construct(){
		parent::__construct();
	}


	/**
	 * get events [of selected parameter]
	 */
	public function get($events=false){
		if($events){
			foreach($events as $key=>$value){
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
	 * set & nu event
	 * returns the id
	 */
	public function set($data=null){
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// die;

		$data = array(
					'title'		=> $this->input->post('title'),
					'summary' 	=> $this->input->post('summary'),
				);

// //print_r($_POST);
// //print_r($data);die;
		$this->db->insert($this->table,$data);
		
		$nu_id = $this->db->insert_id();

		return $this->get(array('id'=>$nu_id));
	}



	/**
	 * delete events
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
			//unlink(EVENTSPATH.$item->title.$item->image);

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

/* End of file events_model.php */
/* Location: ./application/models/events_model.php */
