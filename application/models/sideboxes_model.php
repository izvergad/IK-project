<?php
/**
 * Модель боковой панели
 */
class SideBoxes_Model extends Model
{
    function SideBoxes_Model()
    {
        // Call the Model constructor
        parent::Model();
    }

    /**
     * Выбирает какие функции для каких страниц
     * @param <string> $location
     */
    function show($location = 'city', $position = 0)
    {
        switch($location)
        {
            case 'buildingGround': break;
            case 'townHall': $this->load->view('sb_update', array('type' => 1, 'position' => $position));
            case 'city':
            case 'island': 
            case 'resource':
            case 'renameCity':
                $this->load->view('sb_'.$location);
            break;
            default: break;
        }
    }

}

/* End of file sideboxes_model.php */
/* Location: ./system/application/models/sideboxes_model.php */