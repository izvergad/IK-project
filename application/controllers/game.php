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
        $this->show('city',0);
    }

    /**
     * Страница города
     */
    function city()
    {
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
        $this->show('renameCity', 0);
    }

    /**
     * Помощь
     * @param <int> $id
     */
    function informations($id = 6)
    {
        $this->show('informations', $id);
    }

    function academy($position = 0)
    {
        $position = ($position == 0) ? $this->Data_Model->get_position(3, $this->Town_Model->buildings) : $position;
        $this->show('academy', $position);
    }

    /**
     * Функция отображения страниц
     * @param <string> $location
     * @param <int> $position
     */
    function show($location, $position)
    {
        $bread = $this->load->view('bread_'.$location, null, true);
        $this->load->view('game',array('location' => $location, 'bread' => $bread, 'position' => $position));
    }
}

/* End of file game.php */
/* Location: ./system/application/controllers/game.php */