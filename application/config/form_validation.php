<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(

			//validation rules for booking a featured model
			'book' => 
				array(
					array(
							'field'=>'purpose', 
							'label'=>'purpose', 
							'rules'=>'required|alpha_dash'
						),
					array(
							'field'=>'other', 
							'label'=>'Other', 
							'rules'=>'xss_clean'
						),
					array(
							'field'=>'local', 
							'label'=>'Local', 
							'rules'=>'integer'
						),
					array(
							'field'=>'national', 
							'label'=>'National', 
							'rules'=>'integer'
						),
					array(
							'field'=>'international', 
							'label'=>'International', 
							'rules'=>'integer'
						),
					array(
							'field'=>'duration', 
							'label'=>'Duration', 
							'rules'=>'alpha_dash'
						),
					array(
							'field'=>'renumeration', 
							'label'=>'Renumeration', 
							'rules'=>'integer'
						),
					array(
							'field'=>'element_2', 
							'label'=>'Name', 
							'rules'=>'required|xss_clean'
						),
					array(
							'field'=>'element_3', 
							'label'=>'Email', 
							'rules'=>'required|valid_email'
						),
					array(
							'field'=>'element_4', 
							'label'=>'Contact Number', 
							'rules'=>'xss_clean|min_length[5]'
						)
				)
		);
