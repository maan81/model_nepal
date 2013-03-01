<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Misc. Utilites helper 
 */

/**
 * Generate folder names from person's name
 *
 * @param string $name
 * @return string -- adjusted name
 */
if ( ! function_exists('gen_folder_name')){

	function gen_folder_name($name = false) {
		
		if(!$name)
			return false;

		return strtolower(str_replace(" ","_",trim($name)));
	}
}

/* End of file utilites_helper.php */
/* Location: ./application/helpers/utilites_helper.php */