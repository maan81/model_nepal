<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Date Dropdown generator
 */

/**
 * Generate options for date to put inside 
 * <select>....</select>
 *
 */
if ( ! function_exists('date_dropdown')){

	function date_dropdown() {
		
		$m = array(
					'01'=> 'January',
					'02'=> 'February',
					'03'=> 'March',
					'04'=> 'April',
					'05'=> 'May',
					'06'=> 'June',
					'07'=> 'July',
					'08'=> 'August',
					'09'=> 'September',
					'10'=> 'October',
					'11'=> 'November',
					'12'=> 'December',
				);
		
		//to list date in reverse order
		$m = array_reverse($m,true);
		
		
		$cur_m=date('n');//current month
		$cur_y=date('Y');//current year

		$start_y = 2013;//starting year
		$end_y = $cur_y;//ending year

		$opt = '';

		for($y=$end_y;$y>=$start_y;$y--){

			foreach ($m as $k=>$v) {
				if($y==$end_y && $k>$cur_m){
					continue;
				}
				$opt .= '<option value="'.$y.'-'.$k.'"';

				////select the current month - year
				//if(($k==$cur_m) && ($y==$cur_y)){
				//	$opt .= ' selected="selected" ';
				//}

				$text = $v.' - '.$y;
				$opt .= '>'.$text.'</option>'; 
			} 

		}

		return $opt;
	}
}

