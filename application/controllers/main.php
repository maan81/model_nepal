<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){

		$this->template->set_template('site');
		

		$op = $this->render_library->render_toplink(false);
		$this->template->write('toplink',$op);

		$op = $this->render_library->render_header(false);
		$this->template->write('header',$op);


		$op = $this->render_library->render_footer(false);
		$this->template->write('footer',$op);


		$op = $this->render_library->render_mainContents(false);
		$this->template->write('mainContents',$op);


		$this->template->render();
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */