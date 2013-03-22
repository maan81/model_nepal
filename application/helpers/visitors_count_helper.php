<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * get nu db's timestamp
 */
if ( ! function_exists('get_timestamp')) {

	function get_timestamp(){
		$CI =& get_instance();
		$timestamp = $CI->db->query('Select TIMESTAMP(NOW()) AS timestamp');
		$tmp = $timestamp->result();
	
		return $tmp[0]->timestamp;
	}
}



/**
 * Store count unique visiors
 * @param array [type=subjects|featured (table_name); model_id=id (row_id)]
 * @return void
 */
if ( ! function_exists('set_count_visitors')) {

	function set_count_visitors($data){
		$CI =& get_instance();
		
		$sql = 'INSERT IGNORE INTO `visitors_count` ( '.
													'`ip_address`, '.
													'`type`, '.
													'`model_id`'.
												') VALUES '.
												'('.
													'"'.$CI->input->ip_address().'", '.
													'"'.$data['type'].'", '.
													$data['model_id'].
												');';	

		$CI->db->query($sql);

		//update count only if is a unique visitor
		if($CI->db->affected_rows()==1){

			$sql = 	'UPDATE `'.$data['type'].'` '.
					'SET `profile_viewed` = `profile_viewed`+1 '.
					'WHERE id='.$data['model_id'].';';

			$CI->db->query($sql);
		}
	}
}



/**
 * Display count unique visitors
 * @return int
 */
if ( ! function_exists('get_count_visitors')) {

	function get_count_visitors($data){
/*		$CI =& get_instance();
	
		$sql = 'SELECT COUNT(*) FROM `visitors_count` WHERE (
													`ip_address`,
													`type`,
													`model_id`,
													`timestamp`
												) VALUES '.
												'("'.
													$CI->input->ip_address().', '.
													$data['type'].', '.
													$data['model_id'].', '.
													get_timestamp()
												'");';	
														$this->db->query()

		return $CI->db->count_all_results('visited_count');
*/	}
}


/* End of file visitors_count_helper.php */
/* Location: ./application/helper/visitors_count_helper.php */
