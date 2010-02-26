<?php

class User_Model extends Model
{
    var $gold = 0;
    var $ambrosy = 0;
    var $tutorial = 0;
    
    function User_Model()
    {
        // Call the Model constructor
        parent::Model();
        $this->Load_User($this->session->userdata('id'));
    }

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
                $data['town'] = $user->town;

                $this->session->set_userdata($data);
                redirect('/game/', 'refresh');
            }
            else
            {
                $this->Error('Неверные логин или пароль.');
            }
        }
    }

    function Error($error)
    {
                $this->session->set_userdata(array('error' => $error));
                redirect('/main/error/', 'refresh');
    }

    function Load_User($id)
    {
        if ($id > 0)
        {
            $query = $this->db->get_where($this->session->userdata('universe').'_users', array('id' => $id));
            if ($query->num_rows() > 0)
            {
                $user = $query->row();
                $this->gold = $user->gold;
                $this->ambrosy = $user->ambrosy;
                $this->tutorial = $user->tutorial;
            }
        }
    }
}
?>