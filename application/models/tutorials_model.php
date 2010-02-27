<?php

class Tutorials_Model extends Model
{

    function Tutorials_Model()
    {
        parent::Model();
    }

    function show($location)
    {
        switch($this->User_Model->tutorial)
        {
            case 0: $this->load->view('tut0',array('location' => $location)); break;
            case 1: $this->load->view('tut1',array('location' => $location)); break;
        }
    }
    
}
?>
