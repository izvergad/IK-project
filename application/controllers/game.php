<?php

class Game extends Controller
{

    function Game()
    {
        parent::Controller();
        if (!$this->session->userdata('login'))
        {
            $this->User_Model->Error('Ваша сессия истекла, войдите снова!');
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }
    
    function index()
    {
        $location = 'city';
        $bread = $this->load->view('bread_'.$location, null, true);
        $this->load->view('game',array('location' => $location, 'bread' => $bread));
    }

    function city()
    {
        $this->index();
    }
    
    function show()
    {
        
    }
}
?>