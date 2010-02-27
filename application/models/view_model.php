<?php

class View_Model extends Model
{
    function View_Model()
    {
        // Call the Model constructor
        parent::Model();
    }

    function show($location = 'city', $position)
    {
        switch($location)
        {
            case 'buildingGround': $this->buildingGround($position); break;
            default: $this->city(); break;
        }
    }

    function city()
    {
        $this->load->view('view_city');
    }

    function buildingGround($position)
    {
        $this->load->view('view_buildingGround', array('position' => $position));
    }
}
?>
