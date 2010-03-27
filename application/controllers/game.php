<?php
/**
 * Игровой контроллер
 */
class Game extends Controller
{

    /**
     * Инициализация, загрузка моделей
     */
    function Game()
    {
        parent::Controller();
        $this->load->model('User_Model');
        if (!$this->session->userdata('login'))
        {
            $this->User_Model->Error('Ваша сессия истекла, войдите снова!');
        }
        else
        {
            // Загружаем пользователя
            $this->User_Model->Load_User($this->session->userdata('id'));
            // Смена города
            if (isset($_POST['cityId']) and isset($this->Data_Model->temp_towns_db[$_POST['cityId']]) and $_POST['cityId'] > 0)
            {
                $this->User_Model->town = ($_POST['cityId'] > 0) ? intval($_POST['cityId']) : $this->User_Model->town;
            }

            $this->load->model('Update_Model');

            $this->load->model('Town_Model');
            $this->Town_Model->Town_Load($this->User_Model->town);

            
            $this->load->model('Tutorials_Model');
            $this->load->model('SideBoxes_Model');
            $this->load->model('View_Model');
            // Загружаем сообщения
            $this->User_Model->Load_Town_Messages();
        }
    }

    /**
     * Выход из игры
     */
    function logout()
    {
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }

    /**
     * Страница по умолчанию
     */
    function index()
    {
        $this->show('city');
    }

    /**
     * Страница города
     */
    function city($id = 0)
    {
        if ($id > 0 and $id != $this->Town_Model)
        {
            // Меняем город
            $this->User_Model->town = $id;
            $this->Town_Model->Town_Load($this->User_Model->town);
            // Пишем в базу
            $this->db->set('town', $this->User_Model->town);
            $this->db->where(array('id' => $this->User_Model->id));
            $this->db->update($this->session->userdata('universe').'_users');
        }
        $this->index();
    }

    /**
     * Страница построек
     * @param <int> $position
     */
    function buildingGround($position)
    {
        if ($position > 0)
        {
            $this->show('buildingGround', $position);
        }
        else
        {
            $this->city();
        }
    }

    /**
     * Страница острова
     * @param <int> $id
     */
    function island($id = 0)
    {
        if ($id == 0)
        {
            $id = $this->Town_Model->island->id;
        }
        $this->load->model('Island_Model');
        $this->Island_Model->Load_Island($id);
        $this->show('island', $id);
    }

    /**
     * Лес
     * @param <int> $id
     */
    function resource($id = 0)
    {
        if ($id == 0)
        {
            $id = $this->Town_Model->island->id;
        }
        $this->load->model('Island_Model');
        $this->Island_Model->Load_Island($id);
        $this->show('resource', $id);
    }

    function tradegood($id = 0)
    {
        if ($id == 0)
        {
            $id = $this->Town_Model->island->id;
        }
        $this->load->model('Island_Model');
        $this->Island_Model->Load_Island($id);
        $this->show('tradegood', $id);
    }

    /**
     * Ратуша
     * @param <int> $position
     */
    function townHall($position = 0)
    {
        $this->show('townHall', $position);
    }

    /**
     * Переименовать город
     */
    function renameCity()
    {
        $this->show('renameCity');
    }

    /**
     * Помощь
     * @param <int> $id
     */
    function informations($id = 6)
    {
        $this->show('informations', $id);
    }

    /**
     * Академия
     * @param <int> $position
     */
    function academy($position = 0)
    {
        $position = $this->Data_Model->get_position(3, $this->Town_Model->buildings);
        //$position = ($this->Town_Model->buildings[$position]['type'] == 0 and $this->Town_Model->build_line[0]['type'] == 3) ? $this->Town_Model->build_line[0]['position'] : $position;
        //echo $position; die();
        $this->show('academy', $position);
    }

    /**
     * Казармы
     * @param <int> $position
     */
    function barracks($position = 0)
    {
        $position = $this->Data_Model->get_position(5, $this->Town_Model->buildings);
        $this->show('barracks', $position);
    }

    function shipyard($position = 0)
    {
        $position = $this->Data_Model->get_position(4, $this->Town_Model->buildings);
        $this->show('shipyard', $position);
    }

    /**
     * Премиум-возможности
     */
    function premium()
    {
        $this->show('premium');
    }

    /**
     * Получение амброзии
     */
    function premiumPayment()
    {
        $this->show('premiumPayment');
    }

    /**
     * Заметки
     */
    function avatarNotes()
    {
        $this->load->helper('cookie');
        $this->load->view('avatarNotes');
    }

    /**
     * Советник по исследованиям
     */
    function researchAdvisor()
    {
        $this->show('researchAdvisor');
    }

    /**
     * Информация по исследованиям
     * @param <int> $way
     * @param <int> $id
     */
    function researchDetail($way = 1, $id = 1)
    {
        if ($way == 2){$id = $id + 14;}
        if ($way == 3){$id = $id + 14+15;}
        if ($way == 4){$id = $id + 14+15+16;}
        $this->show('researchDetail', $id);
    }

    /**
     * Карта мира
     * @param <int> $x
     * @param <int> $y
     */
    function worldmap_iso($x = 0, $y = 0)
    {
        $id = $this->Town_Model->island->id;
        $this->load->model('Island_Model');
        $this->Island_Model->Load_Island($id);
        $x = ($x == 0) ? $this->Island_Model->island->x : $x ;
        $y = ($y == 0) ? $this->Island_Model->island->y : $y ;
        $this->show('worldmap_iso', $x, $y);
    }

    /**
     * Подтверждление сноса
     * @param <int> $position
     */
    function demolition($position = 0)
    {
        $this->show('demolition', $position);
    }

    /**
     * Информация о здании
     * @param <int> $id
     */
    function buildingDetail($id = 1)
    {
        $this->show('buildingDetail', $id);
    }

    /**
     * Роспуск войск
     */
    function armyGarrisonEdit()
    {
        $this->show('armyGarrisonEdit');
    }

    function fleetGarrisonEdit()
    {
        $this->show('fleetGarrisonEdit');
    }

    function tradeAdvisor($message_id = 0)
    {
        $this->load->library('pagination');
        $this->show('tradeAdvisor', $message_id);
    }

    function error()
    {
        $this->show('error');
    }

    function cityMilitary($type = 'army')
    {
        $this->show('cityMilitary', $type);
    }
    
    /**
     * Функция отображения страниц
     * @param <string> $location
     * @param <int> $position
     */
    function show($location, $param1 = 0, $param2 = 0)
    {
        $bread = $this->load->view('bread_'.$location, array('position' => $param1), true);
        $this->load->view('game',array('location' => $location, 'bread' => $bread, 'param1' => $param1, 'param2' => $param2));
    }
}

/* End of file game.php */
/* Location: ./system/application/controllers/game.php */