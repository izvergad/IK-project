<?
class Game extends Controller {

	function Game()
	{
		parent::Controller();
                
                $this->load->model('Player_Model');
                if (!$this->session->userdata('login'))
                {
                    $this->Player_Model->Error('Ваша сессия истекла, войдите снова!');
                }
                else
                {
                    // Загружаем пользователя
                    $this->Player_Model->Load_Player($this->session->userdata('id'));
                    if (isset($_POST['cityId']) and isset($this->Data_Model->temp_towns_db[$_POST['cityId']]) and $_POST['cityId'] > 0)
                    {
                        $this->Player_Model->town_id = ($_POST['cityId'] > 0) ? intval($_POST['cityId']) : $this->Player_Model->town_id;
                        $this->Player_Model->now_town = $this->Player_Model->towns[$this->Player_Model->town_id];
                        $this->db->set('town', $this->Player_Model->town_id);
                        $this->db->where(array('id' => $this->Player_Model->user->id));
                        $this->db->update($this->session->userdata('universe').'_users');
                    }
                    $this->load->model('Update_Model');
                    // Отмечаем здания в очереди на карте
                    $this->Player_Model->correct_buildings();
                    $this->Player_Model->Load_New_Messages();
                    $this->load->model('View_Model');
                    
                }
	}


    /**
     * Выход из игры
     */
    function logout()
    {
        $this->session->unset_userdata('login');
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
    function city($id = 0, $relocation = 'city', $reposition = 0)
    {
        if ($id > 0 and $id != $this->Player_Model->town_id and isset($this->Data_Model->temp_towns_db[$id]) and $this->Data_Model->temp_towns_db[$id]->user == $this->Player_Model->user->id)
        {
            // Меняем город
            $this->Player_Model->town_id = $id;
            $this->Player_Model->now_town = $this->Player_Model->towns[$id];
            // Пишем в базу
            $this->db->set('town', $this->Player_Model->town_id);
            $this->db->where(array('id' => $this->Player_Model->user->id));
            $this->db->update($this->session->userdata('universe').'_users');
        }
        if ($relocation != 'city')
        {
            redirect('/game/'.$relocation.'/'.$reposition.'/', 'refresh');
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
    function island($id = 0, $town = -1)
    {
        if ($id == 0)
        {
            $id = $this->Player_Model->island_id;
        }
        $this->load->model('Island_Model');
        $this->Island_Model->Load_Island($id);
        $this->show('island', $id, $town);
    }

    /**
     * Лес
     * @param <int> $id
     */
    function resource($id = 0)
    {
        $town_id = 0;
        if ($id > 0 and $id != $this->Player_Model->island_id and isset($this->Data_Model->temp_islands_db[$id]))
        {
            foreach ($this->Player_Model->towns as $town)
                if ($town->island == $id) $town_id = $town->id;
            if ($town_id > 0 and isset($this->Player_Model->towns[$town_id]))
            {
                // Меняем город
                $this->Player_Model->town_id = $town_id;
                $this->Player_Model->now_town = $this->Player_Model->towns[$town_id];
                // Пишем в базу
                $this->db->set('town', $town_id);
                $this->db->where(array('id' => $this->Player_Model->user->id));
                $this->db->update($this->session->userdata('universe').'_users');
            }
        }
        if ($id == 0)
        {
            $id = $this->Player_Model->island_id;
        }
        $this->load->model('Island_Model');
        $this->Island_Model->Load_Island($id);
        $this->show('resource', $id);
    }

    function tradegood($id = 0)
    {
        if ($id == 0)
        {
            $id = $this->Player_Model->island_id;
        }
        $this->load->model('Island_Model');
        $this->Island_Model->Load_Island($id);
        $this->show('tradegood', $id);
    }

    /**
     * Ратуша
     * @param <int> $position
     */
    function townHall()
    {
        $this->show('townHall', 0);
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
    function academy()
    {
        $position = $this->Data_Model->get_position(3, $this->Player_Model->now_town);
        $this->show('academy', $position);
    }

    function port()
    {
        $position = $this->Data_Model->get_position(2, $this->Player_Model->now_town);
        $this->show('port', $position);
    }

    /**
     * Казармы
     * @param <int> $position
     */
    function barracks()
    {
        $position = $this->Data_Model->get_position(5, $this->Player_Model->now_town);
        $this->show('barracks', $position);
    }

    function tavern()
    {
        $position = $this->Data_Model->get_position(8, $this->Player_Model->now_town);
        $this->show('tavern', $position);
    }

    function shipyard()
    {
        $position = $this->Data_Model->get_position(4, $this->Player_Model->now_town);
        $this->show('shipyard', $position);
    }

    function palace($position = 0)
    {
        $position = $this->Data_Model->get_position(10, $this->Player_Model->now_town);
        $this->show('palace', $position);
    }

    function carpentering()
    {
        $position = $this->Data_Model->get_position(21, $this->Player_Model->now_town);
        $this->show('carpentering', $position);
    }

    function branchOffice($position = 0, $desc = 'ressDesc')
    {
        $position = $this->Data_Model->get_position(12, $this->Player_Model->now_town);
        $this->show('branchOffice', $position, $desc);
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

    function militaryAdvisorMilitaryMovements()
    {
        $this->show('militaryAdvisorMilitaryMovements');
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
        $id = $this->Player_Model->island_id;
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
        $position = $this->Data_Model->get_position(5, $this->Player_Model->now_town);
        $this->show('armyGarrisonEdit', $position);
    }

    function fleetGarrisonEdit()
    {
        $position = $this->Data_Model->get_position(4, $this->Player_Model->now_town);
        $this->show('fleetGarrisonEdit', $position);
    }

    function tradeAdvisor($message_id = 0)
    {
        // Загружаем сообщения
        $this->Player_Model->Load_Town_Messages();
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

    function warehouse($position = 0)
    {
        $this->show('warehouse', $position);
    }

    function options()
    {
        $this->show('options');
    }

    function wall()
    {
        $this->show('wall', 14);
    }

    function plunder($island = 0, $id = 0)
    {
       if ($island == 0)
       {
           $island = $this->Player_Model->island_id;
       }
       $this->load->model('Island_Model');
       $this->Island_Model->Load_Island($island);
       $this->show('plunder', $id);
    }

    function finances()
    {
        $this->show('finances');
    }

    function colonize($island = 0, $position = 0)
    {
        if ($island == 0)
        {
            $island = $this->Player_Model->island_id;
        }
        $this->load->model('Island_Model');
        $this->Island_Model->Load_Island($island);
        $this->show('colonize', $island, $position);
    }

    function merchantNavy()
    {
        $this->show('merchantNavy');
    }

    function transport($island = 0, $id = 0)
    {
        if ($island == 0)
        {
            $island = $this->Player_Model->island_id;
        }
        $this->load->model('Island_Model');
        $this->Island_Model->Load_Island($island);
        $this->Data_Model->Load_Town($id);
        $this->show('transport', $id);
    }

    function premiumTradeAdvisor($page = 'resources')
    {
        if($this->Player_Model->user->premium_account > 0)
        {
            $this->show('premiumTradeAdvisor', $page);
        }
        else
        {
            $this->tradeAdvisor();
        }
        
    }

    function takeOffer($town = 0, $type = 0, $resource = 0)
    {
        $this->show('takeOffer', $town, $type, $resource);
    }

        function show($location, $param1 = 0, $param2 = 0, $param3 = 0)
        {
            $this->load->view('game_index',array('page' => $location, 'param1' => $param1, 'param2' => $param2, 'param3' => $param3));
        }

}

/* End of file game.php */
/* Location: ./system/application/controllers/game.php */