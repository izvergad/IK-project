<?php
/**
 * Модель обновления
 */
class Update_Model extends Model
{

    var $elapsed = 0;

    /**
     * Инициализация
     */
    function Update_Model()
    {
        parent::Model();
        $this->elapsed = time() - $this->User_Model->last_visit;
        $this->update_town($this->Town_Model->id);
        $this->update_user();
    }

    /**
     * Обучение: Переход к следующему обучению
     * @param <string> $action
     */
    function tutorials($action)
    {
        switch($action)
        {
            // следующий этап обучения
            case 'next':
                $this->User_Model->tutorial = $this->User_Model->tutorial + 1;
                $this->db->query('UPDATE `'.$this->session->userdata('universe').'_users'.'` SET `tutorial`=`tutorial`+1 WHERE `id`="'.$this->session->userdata('id').'"');
            break;
        }
    }

    /**
     * Обновляем пользователя
     */
    function update_user()
    {
        $this->db->set('last_visit', time());
        $this->db->set('gold', $this->User_Model->gold);
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
                $level = ($this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']] != false ) ? $this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']]['level'] : 0;
                $cost = $this->Data_Model->building_cost($this->Town_Model->build_line[0]['type'], $level);
                if (($this->Town_Model->build_start + $cost['time']) <= time())
                {
                    // Обучение - найм рабочих на лесопилку
                    if ($this->Town_Model->build_line[0]['type'] == 3 and $this->User_Model->tutorial == 5)
                    {
                        $this->tutorials('next');
                    }

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

                }
            }
            // Прирост жителей
            $this->Town_Model->peoples['free'] = $this->Town_Model->peoples['free'] + ((($this->Town_Model->good/50)/3600)*$this->elapsed);
            $this->db->set('peoples', $this->Town_Model->peoples['free']);
            // Прирост золота
            $this->User_Model->gold = $this->User_Model->gold + ((($this->Town_Model->peoples['free']*3)/3600)*$this->elapsed);
            // Прирост дерева
            $this->Town_Model->resources['wood'] = $this->Town_Model->resources['wood'] + (($this->Town_Model->peoples['workers']/3600)*$this->elapsed);
            $this->db->set('wood', $this->Town_Model->resources['wood']);

            $this->db->where(array('id' => $this->Town_Model->id));
            $this->db->update($this->session->userdata('universe').'_towns');
        }
    }

}

/* End of file update_model.php */
/* Location: ./system/application/models/update_model.php */