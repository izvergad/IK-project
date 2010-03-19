<?php
/**
 * Модель центрального отображения
 */
class View_Model extends Model
{
    function View_Model()
    {
        // Call the Model constructor
        parent::Model();
    }

    /**
     * Главное отображение
     * @param <string> $location
     * @param <int> $position
     */
    function show($location = 'city', $param1, $param2)
    {
        switch($location)
        {
            case 'worldmap_iso': $this->load->view('view_'.$location, array('x' => $param1, 'y' => $param2)); break;
            case 'academy':
            case 'buildingGround':
            case 'city':
            case 'informations':
            case 'buildingDetail':
            case 'island':
            case 'renameCity':
            case 'resource':
            case 'townHall':
            case 'premium':
            case 'premiumPayment':
            case 'researchAdvisor':
            case 'researchDetail':
            case 'barracks':
            case 'demolition':
            case 'armyGarrisonEdit':
                $this->load->view('view_'.$location, array('position' => $param1));
            break;
            default: $this->not_found(); break;
        }
    }

    /**
     * Страница не найдена
     */
    function not_found()
    {
        $this->load->view('view_city');
    }

}

/* End of file view_model.php */
/* Location: ./system/application/models/view_model.php */
