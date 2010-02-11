<?php

class User_Model extends Model
{
    
    function User_Model()
    {
        // Call the Model constructor
        parent::Model();
        
    }

    function User_Login()
    {
        if (isset($_POST['name']) & isset($_POST['password']))
        {
            
            $query = $this->db->get_where($_POST['universe'].'_users', array('login' => $_POST['name'], 'password' => $_POST['password']));
            if ($query->num_rows() > 0)
            {
                $data = array();
                $data['universe'] = $_POST['universe'];
                $data['login'] = $_POST['name'];
                $data['password'] = $_POST['password'];

                $this->session->set_userdata($data);
                redirect('/game/', 'refresh');
            }
            else
            {
                $this->Error('Неверное имя или пароль.');
            }
        }
    }

    function Error($error)
    {
                $this->session->set_userdata(array('error' => $error));
                redirect('/main/error/', 'refresh');
    }
}
?>