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
    function show($location = 'city', $position)
    {
        switch($location)
        {
            case 'academy':
            case 'buildingGround':
            case 'city':
            case 'informations':
            case 'island':
            case 'renameCity':
            case 'resource':
            case 'townHall':
                $this->load->view('view_'.$location, array('position' => $position));
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
