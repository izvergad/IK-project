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
    function show($location = 'city')
    {
        switch($location)
        {
            case 'island': $this->island(); break;
            case 'buildingGround': break;
            default: $this->city(); break;
        }
    }

    /**
     * Панель города
     */
    function city()
    {
        $this->load->view('sb_city');
    }

    /**
     * Панель острова
     */
    function island()
    {
        $this->load->view('sb_island');
    }

}

/* End of file sideboxes_model.php */
/* Location: ./system/application/models/sideboxes_model.php */