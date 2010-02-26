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
        }
    }
    
}
?>
