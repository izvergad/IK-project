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
     * Выбирает какие функции для каких страниц
     * @param <string> $location
     * @param <int> $position
     */
    function show($location = 'city', $position)
    {
        switch($location)
        {
            case 'buildingGround': $this->buildingGround($position); break;
            case 'island': $this->island($position); break;

            default: $this->city(); break;
        }
    }

    /**
     * Страница города
     */
    function city()
    {
        $this->load->view('view_city');
    }

    /**
     * Страница построек
     * @param <int> $position
     */
    function buildingGround($position)
    {
        $this->load->view('view_buildingGround', array('position' => $position));
    }

    /**
     * Страница острова
     * @param <int> $id
     */
    function island($id)
    {
        //$this->Island->Load_Island($id);
        $this->load->view('view_island');
    }

}

/* End of file view_model.php */
/* Location: ./system/application/models/view_model.php */
