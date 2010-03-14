<?php
/**
 * Контроллер действий
 */
class Actions extends Controller
{

    function Actions()
    {
        parent::Controller();
        $this->load->model('User_Model');
        if (!$this->session->userdata('login'))
        {
            $this->User_Model->Error('Ваша сессия истекла, войдите снова!');
        }
        else
        {
            // Загружаем пользователя
            $this->User_Model->Load_User($this->session->userdata('id'));
        }
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
     * Повышение уровня здания
     * @param <int> $position
     */
    function upgrade($position)
    {
        $position = intval($position);
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        if ($this->Town_Model->buildings[$position] != false){
            $this->build($position, $this->Town_Model->buildings[$position]['type'], $this->Data_Model->building_class_by_type($this->Town_Model->buildings[$position]['type']));
        }
        else
        {
            redirect($this->config->item('base_url').'game/', 'refresh');
        }
    }

    /**
     * Понижение уровня здания
     * @param <int> $position
     */
    function demolition($position)
    {
        redirect($this->config->item('base_url').'game/', 'refresh');
    }

    /**
     * Постройка здания
     * @param <int> $position
     * @param <int> $id
     * @param <bool> $redirect
     */
    function build($position, $id, $redirect = 'city')
    {
        // Обучение - постройка академии
        if ($id == 3 and $this->User_Model->tutorial == 4)
        {
            $this->tutorials('next');
        }
        $id = intval($id);
        $position = intval($position);
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        $class = $this->Data_Model->building_class_by_type($id);
        // Заглушка build_text пока не будет готова очередь потроек
        if ($class != 'buildingGround' and $this->Town_Model->build_text == '' and ($this->Town_Model->buildings[$position]['type'] == 0 or $this->Town_Model->buildings[$position]['type'] == $id))
        {
            $level = ($this->Town_Model->buildings[$position] != false ) ? $this->Town_Model->buildings[$position]['level'] : 0;
            // Получаем цены
            $cost = $this->Data_Model->building_cost($id, $level);
            // Подсчитываем остаток
            $wood = $this->Town_Model->resources['wood'] - $cost['wood'];
            $wine = $this->Town_Model->resources['wine'] - $cost['wine'];
            $marble = $this->Town_Model->resources['marble'] - $cost['marble'];
            $crystal = $this->Town_Model->resources['crystal'] - $cost['crystal'];
            $sulfur = $this->Town_Model->resources['sulfur'] - $cost['sulfur'];
            // Если остаток приемлемый
            if ($wood >= 0 and $wine >= 0 and $marble >= 0 and $crystal >= 0 and $sulfur >= 0)
            {
                // Обновляем ресурсы в базе и в модели
                $this->db->set('wood', $wood); $this->Town_Model->resources['wood'] = $wood;
                $this->db->set('wine', $wine); $this->Town_Model->resources['wine'] = $wine;
                $this->db->set('marble', $marble); $this->Town_Model->resources['marble'] = $marble;
                $this->db->set('crystal', $crystal); $this->Town_Model->resources['crystal'] = $crystal;
                $this->db->set('sulfur', $sulfur); $this->Town_Model->resources['sulfur'] = $sulfur;
                // Строка текста прямо как в базе
                if ($this->Town_Model->build_text != '')
                {
                    $this->db->set('build_line', $this->Town_Model->build_text.';'.$position.','.$id);
                    $this->Town_Model->build_text = $this->Town_Model->build_text.';'.$position.','.$id;
                }
                else
                {
                    $this->db->set('build_line', $position.','.$id);
                    $this->Town_Model->build_text = $this->Town_Model->build_text.$position.','.$id;
                }
                // Устанавливаем время старта если его нету
                if ($this->Town_Model->build_start == 0)
                {
                    $this->db->set('build_start', time());
                    $this->Town_Model->build_start = time();
                }
                $this->db->where(array('id' => $this->Town_Model->id));
                $this->db->update($this->session->userdata('universe').'_towns');
                // Здание добавлено в очередь
            }
        }
        // Переход на страницу игры
        if ($redirect) { redirect($this->config->item('base_url').'game/'.$redirect.'/', 'refresh'); }
    }

    /**
     * Переименовать город
     */
    function rename()
    {
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        if (isset($_POST['name']) and strip_tags($_POST['name']) != '')
        {
           $this->db->set('name', strip_tags($_POST['name']));
           $this->db->where(array('id' => $this->Town_Model->id));
           $this->db->update($this->session->userdata('universe').'_towns');
        }
        redirect($this->config->item('base_url').'game/townHall/', 'refresh');
    }

    /**
     * Обновляем рабочих
     * @param <string> $type
     * @param <int> $id
     */
    function workers($type = 'resource', $id = 0)
    {
        // Обучение - найм рабочих на лесопилку
        if (($type == 'resource' and $this->User_Model->tutorial == 2) or ($type == 'academy' and $this->User_Model->tutorial == 7))
        {
            $this->tutorials('next');
        }
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);

        if (isset($_POST['rw']))
        {
            $level = $this->Town_Model->island->wood_level;
            $cost = $this->Data_Model->island_cost(0, $level);
            if ($cost['workers'] >= $_POST['rw'])
            {
                $all = $this->Town_Model->peoples['workers'] + $this->Town_Model->peoples['free'];
                if ($all >= $_POST['rw'])
                {
                    $this->Town_Model->peoples['workers'] = intval($_POST['rw']);
                    $this->Town_Model->peoples['free'] = $all - intval($_POST['rw']);
                    $this->db->set('workers', $this->Town_Model->peoples['workers']);
                    $this->db->set('peoples', $this->Town_Model->peoples['free']);
                    $this->db->where(array('id' => $this->Town_Model->id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                }
            }
        }

        if (isset($_POST['s']) and $id > 0 and $this->Town_Model->already_build[3])
        {
            $max_scientists = $this->Data_Model->scientists_by_level($this->Town_Model->buildings[$id]['level']);
            if ($max_scientists >= $_POST['s'])
            {
                $all = $this->Town_Model->peoples['research'] + $this->Town_Model->peoples['free'];
                if ($all >= $_POST['s'] )
                {
                    $this->Town_Model->peoples['research'] = intval($_POST['s']);
                    $this->Town_Model->peoples['free'] = $all - intval($_POST['s']);
                    $this->db->set('scientists', $this->Town_Model->peoples['research']);
                    $this->db->set('peoples', $this->Town_Model->peoples['free']);
                    $this->db->where(array('id' => $this->Town_Model->id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                }
            }
        }
        
        redirect($this->config->item('base_url').'game/'.$type.'/', 'refresh');
    }

    function resources($id = 0)
    {
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        
        $count = isset($_POST['donation']) ? floor($_POST['donation']) : 0;
        if($this->Town_Model->resources['wood'] >= $count and $count > 0 and $this->Town_Model->island->id == $id)
        {
            $this->Town_Model->workers_wood = $this->Town_Model->workers_wood + $count;
            $this->Town_Model->resources['wood'] = $this->Town_Model->resources['wood'] - $count;
            //$this->Island_Model->island->wood_count = $this->Island_Model->island->wood_count + $count;
            // Обновляем город
            $this->db->set('workers_wood', $this->Town_Model->workers_wood);
            $this->db->set('wood', $this->Town_Model->resources['wood']);
            $this->db->where(array('id' => $this->Town_Model->id));
            $this->db->update($this->session->userdata('universe').'_towns');
            // Обновляем остров
            $this->db->query('UPDATE `'.$this->session->userdata('universe').'_islands'.'` SET `wood_count`=`wood_count`+'.$count.' WHERE `id`="'.$id.'"');
        }
        redirect($this->config->item('base_url').'game/resource/'.$id.'/', 'refresh');
    }

    function doResearch($way = 0, $id = 0)
    {
        if($way > 0 and $way <= 4)
        {
            $parametr = 'res'.$way.'_'.$id;
            $data = $this->Data_Model->get_research($way,$id,$this->User_Model->research);
            if ($this->User_Model->research->points >= $data['points'])
            {
                $this->User_Model->research->points = $this->User_Model->research->points - $data['points'];
                $this->User_Model->research->$parametr = $this->User_Model->research->$parametr + 1;
                $this->db->set('points', $this->User_Model->research->points);
                $this->db->set($parametr, $this->User_Model->research->$parametr);
                $this->db->where(array('user' => $this->User_Model->id));
                $this->db->update($this->session->userdata('universe').'_research');
            }
        }
        redirect($this->config->item('base_url').'game/researchAdvisor/', 'refresh');
    }

}

/* End of file actions.php */
/* Location: ./system/application/controllers/actions.php */