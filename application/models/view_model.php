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
     * Отображение обучения
     * @param <string> $location
     */
    function show_tutorial($location, $id)
    {
        switch($this->Player_Model->user->tutorial)
        {
            // Приветствие
            case 0: $this->load->view('tut/0',array('location' => $location)); break;
            // Найм рабочих
            case 1: $this->load->view('tut/1',array('location' => $location, 'active' => true, 'id' => $id)); break;
            case 2: $this->load->view('tut/1',array('location' => $location, 'active' => false, 'id' => $id)); break;
            // Постройка академии
            case 3: $this->load->view('tut/2',array('location' => $location, 'active' => true, 'id' => $id)); break;
            case 4: $this->load->view('tut/2',array('location' => $location, 'active' => false, 'id' => $id)); break;
            // Найм ученых
            case 5: $this->load->view('tut/3',array('location' => $location, 'active' => true, 'id' => $id)); break;
            case 6: $this->load->view('tut/3',array('location' => $location, 'active' => false, 'id' => $id)); break;
            // Постройка казарм
            case 7: $this->load->view('tut/4',array('location' => $location, 'active' => true, 'id' => $id)); break;
            case 8: $this->load->view('tut/4',array('location' => $location, 'active' => false, 'id' => $id)); break;
            // Найм копейщиков
            case 9: $this->load->view('tut/5',array('location' => $location, 'active' => true, 'id' => $id)); break;
            case 10: $this->load->view('tut/5',array('location' => $location, 'active' => false, 'id' => $id)); break;
            // Постройка стены
            case 11: $this->load->view('tut/6',array('location' => $location, 'active' => false, 'id' => $id)); break;
            // Постройка порта
            case 12: $this->load->view('tut/7',array('location' => $location, 'active' => true, 'id' => $id)); break;
            case 13: $this->load->view('tut/7',array('location' => $location, 'active' => false, 'id' => $id)); break;
            // Апгрейд здания
            case 14: $this->load->view('tut/8',array('location' => $location, 'active' => true, 'id' => $id)); break;
            case 15: $this->load->view('tut/8',array('location' => $location, 'active' => false, 'id' => $id)); break;
            // Нападение на варваров
            case 16: $this->load->view('tut/9',array('location' => $location, 'active' => true, 'id' => $id)); break;
            case 17: $this->load->view('tut/9',array('location' => $location, 'active' => false, 'id' => $id)); break;

        }
    }

    /**
     * Главное отображение
     * @param <string> $location
     * @param <int> $position
     */
    function show_view($location = 'city', $param1, $param2)
    {
        switch($location)
        {
            case 'worldmap_iso': $this->load->view('view/'.$location, array('x' => $param1, 'y' => $param2)); break;
            case 'colonize': $this->load->view('view/'.$location, array('id' => $param1, 'position' => $param2)); break;
            case 'academy':
            case 'buildingGround':
            case 'city':
            case 'informations':
            case 'buildingDetail':
            case 'island':
            case 'renameCity':
            case 'resource':
            case 'tradegood':
            case 'townHall':
            case 'premium':
            case 'premiumPayment':
            case 'researchAdvisor':
            case 'researchDetail':
            case 'barracks':
            case 'shipyard':
            case 'demolition':
            case 'armyGarrisonEdit':
            case 'tradeAdvisor':
            case 'error':
            case 'fleetGarrisonEdit':
            case 'cityMilitary':
            case 'warehouse':
            case 'options':
            case 'wall':
            case 'tavern':
            case 'palace':
            case 'plunder':
            case 'finances':
            case 'port':
            case 'merchantNavy':
            case 'militaryAdvisorMilitaryMovements':
            case 'transport':
            case 'premiumTradeAdvisor':
                $this->load->view('view/'.$location);
            break;
            default: $this->load->view('view/city'); break;
        }
    }

    /**
     * Отображение левой части
     * @param <string> $location
     */
    function show_sidebox($location = 'city', $param1, $param2)
    {
        switch($location)
        {
            case 'demolition': $this->load->view('sidebox/'.$location, array('position' => $param1)); break;
            case 'worldmap_iso': $this->load->view('sidebox/'.$location, array('x' => $param1, 'y' => $param2)); break;
            case 'researchDetail':
            case 'buildingDetail':
            case 'informations': $this->load->view('sidebox/'.$location, array('id' => $param1)); break;
            case 'cityMilitary':
                $this->load->view('sidebox/cityMilitary', array('type' => $param1)); break;
            case 'academy':
            case 'barracks':
            case 'shipyard':
            case 'townHall':
            case 'warehouse':
            case 'wall':
            case 'tavern':
            case 'palace':
            case 'port':
                $this->load->view('sidebox/update', array('type' => $this->Data_Model->building_type_by_class($location), 'position' => $param1));
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
            case 'finances':
            case 'merchantNavy':
            case 'militaryAdvisorMilitaryMovements':
            case 'premiumTradeAdvisor':
                $this->load->view('sidebox/'.$location);
            break;
            case 'plunder':
            case 'colonize':
            case 'transport':
                $this->load->view('sidebox/back_to_island');
            default: break;
        }
    }

    function show_bread($location = 'city', $param1, $param2)
    {
        switch($location)
        {
            case 'armyGarrisonEdit': $location = 'barracks'; break;
            case 'fleetGarrisonEdit': $location = 'shipyard'; break;
        }
        $caption = $this->Data_Model->building_name_by_type($this->Data_Model->building_type_by_class($location));
        $type = $this->Data_Model->building_type_by_class($location);
        switch($location)
        {
            case 'demolition': $file = 'building';break;
            case 'academy':
            case 'barracks':
            case 'buildingGround':
            case 'palace':
            case 'port':
            case 'shipyard':
            case 'tavern':
            case 'townHall':
            case 'wall':
            case 'warehouse': $file = 'town'; break;
            case 'cityMilitary': $caption = 'Военный обзор'; $file = 'town'; break;
            case 'renameCity': $caption = 'Переименовать город'; $file = 'town'; break;
            case 'buildingDetail': $caption = 'Информация о здании'; $file = 'world'; break;
            case 'researchAdvisor': $caption = 'Советник по исследованиям'; $file = 'world'; break;
            case 'tradeAdvisor': $caption = 'Мэр'; $file = 'world'; break;
            case 'militaryAdvisorMilitaryMovements': $caption = 'Военный советник'; $file = 'world'; break;
            case 'error': $caption = 'Ошибка!'; $file = 'null'; break;
            case 'options': $caption = 'Настройки'; $file = 'null'; break;
            case 'finances': $caption = 'Сводный отчет по финансам'; $file = 'null'; break;
            case 'premium':
            case 'premiumPayment': $caption = 'Икариам ПЛЮС'; $file = 'null'; break;
            case 'researchDetail': $caption = 'Подробно об исследовании'; $file = 'null'; break;
            case 'merchantNavy': $caption = 'Торговый флот'; $file = 'null'; break;
            case 'transport': $caption = 'Транспорт'; $file = '_island'; break;
            case 'colonize': $caption = 'Колонизация'; $file = '_island'; break;
            case 'premiumTradeAdvisor': $caption = 'Обзор построек'; $file = 'tradeAdvisor'; break;
            default:
                 $file = $location; break;
            break;
        }
        $this->load->view('bread/'.$file, array('caption' => $caption, 'type' => $type));
    }

}

/* End of file view_model.php */
/* Location: ./system/application/models/view_model.php */
