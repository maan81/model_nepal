<?php

class MY_Input extends CI_Input {

	public function __construct()
    {
		parent::__construct();

    }

    function post($index = '', $xss_clean = TRUE)
    {
        return parent::post($index, $xss_clean);
    }
}

/* End of file MY_input.php */
/* Location: ./application/core/My_input.php */
