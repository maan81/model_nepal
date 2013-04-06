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



/**
 * Create new folder if not exists
 *
 *	@param string [path], string[dir_name]
 *	@return void
 */
if( ! function_exists('make_dir')){

	function make_dir($path, $name){

		if( ! is_dir($path.'/'.$name)) {

			$old = umask(0);
			mkdir($path.'/'.$name, 0777);
			umask($old);
		}
	}
}



/**
 * Get the server path of the specified img.
 *
 * @param string [model], int [gallery_name], string [img_name]
 * @return string [path to selected img]
 */
if(! function_exists('get_img')){
	function get_img($model,$gallery=null,$img=null,$is_featured=true){
	
		if($is_featured){
			//set the relative model path
			$path = FEATUREDPATH.gen_folder_name($model->name).'/';
		}else{
			//set the relative model path
			$path = SUBJECTSPATH.gen_folder_name($model->name).'/';
		}

		//include gallery path
		if($gallery!=null){
			$path .= $gallery.'/';
		}

		//get the reqd. gallery's imgs
		$arr = scandir(dirname(BASEPATH).'/'.$path);
		$gallery = '/'.$gallery;

		array_shift($arr);	//remove .
		array_shift($arr);	//remove ..

		//remove thumbs if exists
		if(($key=array_search('thumbs', $arr) )!==false) {
			unset($arr[$key]);
		}

		//set the default values
		$imgs['prev']	= false;
		$imgs['cur']	= site_url('featured/get/'.$model->id.$gallery.'/'.($img));
		$imgs['cur_img']= base_url().$path.reset($arr);

		if(next($arr)!==false){
			$imgs['next'] 	= site_url('featured/get/'.$model->id.$gallery.'/'.($img+1));

		}else{
			$imgs['next']	= false;
		}

		//if no specific img mentioned, return the default values
		if($img == null){
			return $imgs;
		}


		$img_no = 0;
		//recursive to select the select img
		for($i=0;$i<count($arr);$i++){
			$img_no++;

			//current position reached ...
			if($img == $img_no){
				break;
			}
			
			//set variables ...
			$imgs['prev'] = site_url('featured/get/'.$model->id.$gallery.'/'.($img-1));
			$imgs['cur']  = $imgs['next'];
			$imgs['cur_img'] = base_url().$path.current($arr);

			//increment ...
			if(next($arr)){
				$imgs['next'] 	= site_url('featured/get/'.$model->id.$gallery.'/'.($img+1));
			}else{
				$imgs['next'] = false;
			}
		}
		
		//return the selectd img & the previous & next links
		return $imgs;
	}
}













/**
 * Get the server path of profile img forthe specified featured
 *
 * @param object [model]
 * @return array of string [path to selected img, link to selected featured]
 */
if(! function_exists('get_profile_img')){
	function get_profile_img($model){
	
		//set the relative model path + profile img
		$path = FEATUREDPATH.gen_folder_name($model->name).'/profile_img.jpg';

		//set the default values
		$imgs['cur']	= site_url('featured/get/'.$model->id);
		$imgs['cur_img']= base_url().$path;

		//return the selectd img & the previous & next links
		return $imgs;
	}
}















if(! function_exists('get_img_old')){
	function get_img_old($model,$gallery=null,$img=null){
		$imgs = array();	// links to the previous, current, next imgs

		//set the relative model path
		$path = FEATUREDPATH.gen_folder_name($model).'/';

		//set the gallery path
		if($gallery!=null){
			$path .= $gallery.'/';
		}

		//set selected img path
		if($img!=null){
			$path .= strtolower(str_replace(" ","_",trim($img))).'.jpg';
			$imgs['cur'] =  base_url().$path;
			$imgs['prev']= false;

		//set the default img's path
		}else{

			//get the selected img. & the prev & next links
			foreach(scandir(dirname(BASEPATH).'/'.$path) as $key=>$val){
				if($val === "." || $val == "..")
					continue;

				$imgs['cur'] = base_url().FEATUREDPATH.gen_folder_name($model).'/'.$gallery.'/'.$val;
			}
		}

		return $imgs;

	}
}

/* End of file utilites_helper.php */
/* Location: ./application/helpers/utilites_helper.php */