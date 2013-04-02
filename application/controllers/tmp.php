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

	public function set_flashdata($msg=null){
		$this->session->set_flashdata('msg',$msg);
		echo 'msg : '.$msg;
		echo '<br/>';
		echo '<a href="'.site_url('tmp/chk_flashdata').'">'.site_url('tmp/chk_flashdata').'</a>';
	}
	public function chk_flashdata(){
		echo '<div class="flash_msg">'.$this->session->flashdata('msg').'</div>';
	}
}