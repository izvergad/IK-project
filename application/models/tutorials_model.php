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
            // Найм рабочих
            case 1: $this->load->view('tut1',array('location' => $location, 'active' => true)); break;
            case 2: $this->load->view('tut1',array('location' => $location, 'active' => false)); break;
            // Постройка академии
            case 3: $this->load->view('tut2',array('location' => $location, 'active' => true)); break;
            case 4: $this->load->view('tut2',array('location' => $location, 'active' => false)); break;
            // Найм ученых
            case 5: $this->load->view('tut3',array('location' => $location, 'active' => true)); break;
            case 6: $this->load->view('tut3',array('location' => $location, 'active' => false)); break;
            // Постройка казарм
            case 7: $this->load->view('tut4',array('location' => $location, 'active' => true)); break;
            case 8: $this->load->view('tut4',array('location' => $location, 'active' => false)); break;
            // Найм копейщиков
            case 9: $this->load->view('tut5',array('location' => $location, 'active' => true)); break;
            case 10: $this->load->view('tut5',array('location' => $location, 'active' => false)); break;
            // Постройка стены
            case 11: $this->load->view('tut6',array('location' => $location, 'active' => false)); break;
            // Постройка порта
            case 12: $this->load->view('tut7',array('location' => $location, 'active' => true)); break;
            case 13: $this->load->view('tut7',array('location' => $location, 'active' => false)); break;
            // Апгрейд здания
            case 14: $this->load->view('tut8',array('location' => $location, 'active' => true)); break;
            case 15: $this->load->view('tut8',array('location' => $location, 'active' => false)); break;

        }
    }
    
}

/* End of file tutorials_model.php */
/* Location: ./system/application/models/tutorials_model.php */
