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
            case 'informations': $this->load->view('sb_'.$location, array('id' => $position)); break;
            case 'academy':
            case 'townHall': $this->load->view('sb_update', array('type' => $this->Data_Model->building_type_by_class($location), 'position' => $position));
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