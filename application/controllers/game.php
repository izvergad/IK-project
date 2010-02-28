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
            $this->load->model('Update_Model');
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
            $id = $this->Town_Model->island;
        }
        $this->load->model('Island_Model');
        $this->Island_Model->Load_Island($id);
        $this->show('island', $id);
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