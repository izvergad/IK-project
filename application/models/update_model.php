<?php
/**
 * Модель обновления
 */
class Update_Model extends Model
{

    /**
     * Инициализация
     */
    function Update_Model()
    {
        parent::Model();
        $this->update_town($this->Town_Model->id);
        $this->update_user();
    }

    /**
     * Обновляем пользователя
     */
    function update_user()
    {
        $this->db->set('last_visit', time());
        $this->db->set('tutorial', floor($this->User_Model->tutorial));
        $this->db->where(array('id' => $this->session->userdata('id')));
        $this->db->update($this->session->userdata('universe').'_users');
    }

    /**
     * Обновляем город
     * @param <int> $id
     */
    function update_town($id)
    {
        // Если выбранный город не нужно загружать данные
        if ($id == $this->Town_Model->id)
        {
            // Строится ли вообще что нибудь?
            if ($this->Town_Model->build_text != '')
            {
                $cost = $this->Data_Model->building_cost($this->Town_Model->build_line[0]['type']);
                if (($this->Town_Model->build_start + $cost['time']) <= time())
                {
                    // Строим здание
                    if ($this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']]['type'] == $this->Town_Model->build_line[0]['type'])
                    {
                        $this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']]['level'] = $this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']]['level'] + 1;
                    }
                    else
                    {
                        $this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']]['type'] = $this->Town_Model->build_line[0]['type'];
                        $this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']]['level'] = 1;
                    }
                    // Если есть очередь
                    if (count($this->Town_Model->build_line) > 1)
                    {
                        $this->Town_Model->build_text = substr($this->Town_Model->build_text, 3);
                        $this->Town_Model->build_start = $this->Town_Model->build_start + $cost['time'];
                        $this->Town_Model->load_build_line($this->Town_Model->build_text);
                    }
                    else
                    {
                        $this->Town_Model->build_text = '';
                        $this->Town_Model->build_start = 0;
                        $this->Town_Model->build_line = array();
                    }
                    // Обновляем в базу
                    $this->db->set('buildings', $this->Town_Model->get_buildings_text());
                    $this->db->set('build_line', $this->Town_Model->build_text);
                    $this->db->set('build_start', $this->Town_Model->build_start);
                    $this->db->where(array('id' => $this->Town_Model->id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                }
            }
        }
    }

}

/* End of file update_model.php */
/* Location: ./system/application/models/update_model.php */