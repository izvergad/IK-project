<?php

class Game extends Controller
{

    function Game()
    {
        parent::Controller();
        if (!$this->session->userdata('login'))
        {
            $this->User_Model->Error('���� ������ �������, ������� �����!');
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }
    
    function index()
    {
        
    }
}
?>