<?php
/**
 * Модель острова
 */
class Island_Model extends Model
{
    var $towns = array();
    var $users = array();
    var $island = array();
    
    function Island_Model()
    {
        // Call the Model constructor
        parent::Model();
    }

    /**
     * Загрузка данных острова
     * @param <int> $id
     */
    function Load_Island($id = 0)
    {
        // Выбираем остров по умолчанию
        if ($id == 0 or $id == ''){ $id = $this->Town_Model->island; }
        // Загружаем остров из базы
        $query = $this->db->get_where($this->session->userdata('universe').'_islands', array('id' => $id));
        $this->island = $query->row();
        // Загружаем города
        $this->Load_Towns($this->island->towns);
    }

    /**
     * Загрузка городов острова
     * @param <string> $text
     */
    function Load_Towns($text)
    {
        if ($text != '')
        {
            $towns = explode(" ", $text);
            for ($i = 0; $i < count($towns); $i++)
            {
                if ($towns[$i] > 0)
                {
                    $query = $this->db->get_where($this->session->userdata('universe').'_towns', array('id' => $towns[$i]));
                    $this->towns[$i] = $query->row();
                    $query = $this->db->get_where($this->session->userdata('universe').'_users', array('id' => $this->towns[$i]->user));
                    $this->users[$i] = $query->row();
                }
                else
                {
                    $this->towns[$i] = false;
                }
            }
        }
    }
    
}

/* End of file island_model.php */
/* Location: ./system/application/models/island_model.php */