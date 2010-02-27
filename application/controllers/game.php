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
        else
        {
            $this->load->model('Update_Model');
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }
    
    function index()
    {
        $this->show('city',0);
    }

    function city()
    {
        $this->index();
    }

    function buildingGround($position)
    {
        if ($position > 0)
        {
            $this->show('buildingGround', $position);
        }
        else
        {
            $this->city();
        }
    }

    function show($location, $position)
    {
        $bread = $this->load->view('bread_'.$location, null, true);
        $this->load->view('game',array('location' => $location, 'bread' => $bread, 'position' => $position));
    }
}
?>