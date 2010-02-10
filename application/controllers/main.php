<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();	
	}
	
	function index()
	{
                $page = $this->load->view('main_index', null, true);
		$this->load->view('main',array('page' => $page));
	}

        function register()
        {
                $page = $this->load->view('main_register', null, true);
		$this->load->view('main',array('page' => $page));
        }

        function tour($id = 1)
        {
                $page_id = $id > 5 ? 5 : $id;
                $page_id = $id < 1 ? 1 : $id;
                $page = $this->load->view('main_tour_'.$page_id, null, true);
		$this->load->view('main',array('page' => $page));
        }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */