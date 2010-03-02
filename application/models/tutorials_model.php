<?php
/**
 * Модель обучения
 */
class Tutorials_Model extends Model
{

    function Tutorials_Model()
    {
        parent::Model();
    }

    /**
     * Отображение обучения
     * @param <string> $location
     */
    function show($location)
    {
        switch($this->User_Model->tutorial)
        {
            // Приветствие
            case 0: $this->load->view('tut0',array('location' => $location)); break;
            // Посетите лесопилку
            case 1: $this->load->view('tut1',array('location' => $location, 'active' => true)); break;
            case 2: $this->load->view('tut1',array('location' => $location, 'active' => false)); break;
            // Постройте академию
            case 3: $this->load->view('tut2',array('location' => $location, 'active' => true)); break;
            case 4: $this->load->view('tut2',array('location' => $location, 'active' => false)); break;
            case 6: $this->load->view('tut3',array('location' => $location, 'active' => true)); break;
            case 7: $this->load->view('tut3',array('location' => $location, 'active' => false)); break;

        }
    }
    
}

/* End of file tutorials_model.php */
/* Location: ./system/application/models/tutorials_model.php */
