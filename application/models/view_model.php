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
            case 'buildingGround': $this->buildingGround(); break;
            default: $this->city(); break;
        }
    }

    function city()
    {
        $this->load->view('view_city');
    }

    function buildingGround()
    {
        $this->load->view('view_buildingGround');
    }
}
?>
