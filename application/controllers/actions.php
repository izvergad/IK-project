<?php

class Actions extends Controller
{

    function Actions()
    {
        parent::Controller();
    }

    function tutorials($action)
    {
        switch($action)
        {
            case 'next': 
                $this->db->query('UPDATE `'.$this->session->userdata('universe').'_users'.'` SET `tutorial`=`tutorial`+1 WHERE `id`="'.$this->session->userdata('id').'"');
                $this->User_Model->tutorial = $this->User_Model->tutorial + 1;
            break;
        }
    }

}

?>
