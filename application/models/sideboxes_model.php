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
    function show($location = 'city', $param1, $param2)
    {
        switch($location)
        {
            case 'demolition': $this->load->view('sb_'.$location, array('position' => $param1)); break;
            case 'worldmap_iso': $this->load->view('sb_'.$location, array('x' => $param1, 'y' => $param2)); break;
            case 'buildingGround': break;
            case 'researchDetail':
            case 'buildingDetail':
            case 'informations': $this->load->view('sb_'.$location, array('id' => $param1)); break;
            case 'cityMilitary':
                $this->load->view('sb_cityMilitary', array('type' => $param1)); break;
            case 'academy':
            case 'barracks':
            case 'shipyard':
            case 'townHall':
            case 'warehouse':
            case 'wall':
            case 'tavern':
                $this->load->view('sb_update', array('type' => $this->Data_Model->building_type_by_class($location), 'position' => $param1));
            case 'city':
            case 'island': 
            case 'resource':
            case 'tradegood':
            case 'renameCity':
            case 'premium':
            case 'premiumPayment':
            case 'researchAdvisor':
            case 'tradeAdvisor':
            case 'armyGarrisonEdit':
            case 'fleetGarrisonEdit':
                $this->load->view('sb_'.$location);
            break;
            default: break;
        }
    }

}

/* End of file sideboxes_model.php */
/* Location: ./system/application/models/sideboxes_model.php */