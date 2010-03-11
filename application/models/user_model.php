<?php
/**
 * модель пользователя
 */
class User_Model extends Model
{
    var $id = 0;
    var $gold = 0;
    var $ambrosy = 0;
    var $tutorial = 0;
    var $capital = 0;
    var $last_visit = 0;
    var $town = 0;

    var $towns = array();
    var $islands = array();

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
            
            $query = $this->db->get_where($_POST['universe'].'_users', array('login' => $_POST['name'], 'password' => $_POST['password']));
            if ($query->num_rows() > 0)
            {
                $user = $query->row();
                
                $data = array();
                $data['id'] = $user->id;
                $data['universe'] = $_POST['universe'];
                $data['login'] = $_POST['name'];
                $data['password'] = $_POST['password'];

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
    function Error($error)
    {
                $this->session->set_userdata(array('error' => $error));
                redirect('/main/error/', 'refresh');
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
            if (isset($user))
            {
                $this->id = $user->id;
                $this->gold = $user->gold;
                $this->ambrosy = $user->ambrosy;
                $this->tutorial = $user->tutorial;
                $this->capital = $user->capital;
                $this->last_visit = $user->last_visit;
                $this->town = $user->town;
                // Загружаем города
                $query = $this->db->get_where($this->session->userdata('universe').'_towns', array('user' => $id));
                foreach ($query->result() as $row)
                {
                    $this->towns[] = $row;
                    $this->Data_Model->temp_towns_db[$row->id] = $row;
                    // Загружаем остров из базы
                    $this->Data_Model->Load_Island($row->island);
                    $this->islands[$row->island] =& $this->Data_Model->temp_islands_db[$row->island];
                }
            }
        }
    }
}

/* End of file user_model.php */
/* Location: ./system/application/models/user_model.php */