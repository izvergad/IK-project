<?php
/**
 * Контроллер оболочки входа
 */
class Main extends Controller {

	function Main()
	{
		parent::Controller();	
	}

        /**
         * Страница по умолчанию
         */
	function index()
	{
                $this->User_Model->User_Login();
                $page = $this->load->view('main_index', null, true);
		$this->load->view('main',array('page' => $page));
	}

        /**
         * Страница регистрации
         */
        function register()
        {
                $page = $this->load->view('main_register', null, true);
		$this->load->view('main',array('page' => $page));
        }

        /**
         * Страница тура по игре
         * @param <int> $id
         */
        function tour($id = 1)
        {
                $page_id = $id > 5 ? 5 : $id;
                $page_id = $id < 1 ? 1 : $id;
                $page = $this->load->view('main_tour_'.$page_id, null, true);
		$this->load->view('main',array('page' => $page));
        }

        /**
         * Страница ошибки
         */
        function error()
        {
                $error = $this->session->userdata('error');
                $page = $this->load->view('main_error', array('error' => $error), true);
		$this->load->view('main',array('page' => $page));
        }
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */