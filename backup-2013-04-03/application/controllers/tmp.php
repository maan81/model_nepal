<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tmp extends CI_Controller {

	public function count($int){

		$sql = 'INSERT IGNORE INTO `tmp` (`count`) VALUES ("'.$int.'");';

		$this->db->query($sql);

		if($this->db->affected_rows()==1){
			//insert took place
			echo 'inserted';
		}else{
			//no insert
			echo 'not inserted';
		}
	}
}