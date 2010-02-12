<?php

class SideBoxes_Model extends Model
{
    function SideBoxes_Model()
    {
        // Call the Model constructor
        parent::Model();
    }

    function show($location = 'city')
    {
        switch($location)
        {
            default: $this->city(); break;
        }
    }

    function city()
    {
        $this->load->view('sb_city');
    }
}
?>
