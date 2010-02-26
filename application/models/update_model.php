<?php

class Update_Model extends Model
{

    function Update_Model()
    {
        parent::Model();

        $this->db->set('last_visit', time());
        $this->db->where(array('id' => $this->session->userdata('id')));
        $this->db->update($this->session->userdata('universe').'_users');
        
    }
}
?>
