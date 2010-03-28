<?php
/**
 * модель пользователя
 */
class User_Model extends Model
{
    var $id = 0;
    var $login = '';
    var $password = '';
    var $gold = 0;
    var $ambrosy = 0;
    var $tutorial = 0;
    var $capital = 0;
    var $last_visit = 0;
    var $town = 0;
    var $register_complete = 0;
    var $register_key = '';
    var $email = '';
    var $options = array();

    var $towns = array();
    var $armys = array();
    var $islands = array();

    var $research = array();
    var $scientists = 0;

    var $premium_account = 0;
    var $premium_wood = 0;
    var $premium_wine = 0;
    var $premium_marble = 0;
    var $premium_crystal = 0;
    var $premium_sulfur = 0;
    var $premium_capacity = 0;

    var $town_messages = array();
    var $new_town_messages = 0;
    /**
     * Инициализация
     */
    function User_Model()
    {
        // Call the Model constructor
        parent::Model();
    }

    /**
     * Вход в игру
     */
    function User_Login()
    {
        if (isset($_POST['name']) & isset($_POST['password']))
        {
            
            $query = $this->db->get_where($_POST['universe'].'_users', array('login' => $_POST['name'], 'password' => md5($_POST['password'])));
            if ($query->num_rows() > 0)
            {
                $user = $query->row();
                
                $data = array();
                $data['id'] = $user->id;
                $data['universe'] = $_POST['universe'];
                $data['login'] = $_POST['name'];
                $data['password'] = md5($_POST['password']);

                $this->session->set_userdata($data);
                redirect('/game/', 'refresh');
            }
            else
            {
                $this->Error('Неверные логин или пароль.');
            }
        }
    }

    /**
     * Переход на страницу ошибок
     * @param <string> $error
     */
    function Error($error = '')
    {
                $this->session->set_flashdata(array('error' => $error));
                redirect('/main/error/', 'refresh');
    }

    function Game_Error($error = '')
    {
        $this->session->set_flashdata(array('game_error' => $error));
        redirect('/game/error/', 'refresh');
    }

    /**
     * Загрузка пользователя
     * @param <int> $id
     */
    function Load_User($id)
    {
        if ($id > 0)
        {
            // Загружаем пользователя из Базы
            $this->Data_Model->Load_User($id);
            $user =& $this->Data_Model->temp_users_db[$id];
            // Загружаем исследования
            $this->Data_Model->Load_Research($id);
            $this->research =& $this->Data_Model->temp_research_db[$id];
            // Загружаем остальное
            if (isset($user))
            {
                $this->id = $user->id;
                $this->login = $user->login;
                $this->password = $user->password;
                $this->gold = $user->gold;
                $this->ambrosy = $user->ambrosy;
                $this->premium_account = $user->premium_account;
                $this->premium_wood = $user->premium_wood;
                $this->premium_wine = $user->premium_wine;
                $this->premium_marble = $user->premium_marble;
                $this->premium_crystal = $user->premium_crystal;
                $this->premium_sulfur = $user->premium_sulfur;
                $this->premium_capacity = $user->premium_capacity;

                $this->tutorial = $user->tutorial;
                $this->capital = $user->capital;
                $this->last_visit = $user->last_visit;
                $this->town = $user->town;

                $this->register_key = $user->register_key;
                $this->register_complete = $user->register_complete;
                $this->email = $user->email;

                $this->options['city_select'] = $user->options_select;

                // Загружаем города
                $query = $this->db->get_where($this->session->userdata('universe').'_towns', array('user' => $id));
                foreach ($query->result() as $row)
                {
                    $this->towns[] = $row;
                    $this->Data_Model->temp_towns_db[$row->id] = $row;
                    $this->scientists = $this->scientists + $row->scientists;
                    // Загружаем остров из базы
                    $this->Data_Model->Load_Island($row->island);
                    $this->islands[$row->island] =& $this->Data_Model->temp_islands_db[$row->island];
                    // Загружаем армию
                    $this->Data_Model->Load_Army($row->id);
                    $this->armys[$row->id] =& $this->Data_Model->temp_army_db[$row->id];
                }
            }
        }
    }

    function Load_Town_Messages()
    {
        // Загрузка сообщений
        $this->db->order_by("date", "desc");
        $where_array = array();
            $town_messages = $this->db->get_where($this->session->userdata('universe').'_town_messages', array('user' => $this->id));
            if ($town_messages->num_rows() > 0)
            {
                foreach ($town_messages->result() as $row)
                {
                    $this->town_messages[] = $row;
                    if ($row->checked == 0){ $this->new_town_messages++; }
                }
            }
        //rsort($this->town_messages);
    }
}

/* End of file user_model.php */
/* Location: ./system/application/models/user_model.php */