<?php

class View_Model extends Model
{
    function View_Model()
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
        $this->load->view('view_city');
    }
}
?>
