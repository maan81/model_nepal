<?php

$opt = '<select>';

$m = array(
			'1'	=> 'January',
			'2'	=> 'February',
			'3'	=> 'March',
			'4'	=> 'April',
			'5'	=> 'May',
			'6'	=> 'June',
			'7'	=> 'July',
			'8'	=> 'August',
			'9'	=> 'September',
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


for($y=$end_y;$y>=$start_y;$y--){

	foreach ($m as $k=>$v) {
		if($y==$end_y && $k>$cur_m){
			continue;
		}
		$opt .= '<option value="'.$y.' - '.$k.'"';

		//select the current month - year
		if(($k==$cur_m) && ($y==$cur_y)){
			$opt .= ' selected="selected" ';
		}

		$text = $v.' - '.$y;
		$opt .= '>'.$text.'</option>'; 
	} 

}
$opt .= '</select>';

echo $opt;
