<?php
/**
 * Контроллер действий
 */
class Actions extends Controller
{

    function Actions()
    {
        parent::Controller();
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
        if ($this->User_Model->tutorial == 2)
        {
            $this->tutorials('next');
        }
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        if (isset($_POST['rw']) and $this->Town_Model->peoples['free'] >= $_POST['rw'])
        {
            $level = $this->Town_Model->island->wood_level;
            $cost = $this->Data_Model->island_cost(0, $level);
            if ($cost['workers'] >= $_POST['rw'])
            {
                $all = $this->Town_Model->peoples['workers'] + $this->Town_Model->peoples['free'];
                $this->Town_Model->peoples['workers'] = intval($_POST['rw']);
                $this->Town_Model->peoples['free'] = $all - intval($_POST['rw']);
                $this->db->set('workers', $this->Town_Model->peoples['workers']);
                $this->db->set('peoples', $this->Town_Model->peoples['free']);
                $this->db->where(array('id' => $this->Town_Model->id));
                $this->db->update($this->session->userdata('universe').'_towns');
            }
        }
        redirect($this->config->item('base_url').'game/'.$type.'/', 'refresh');
    }

}

/* End of file actions.php */
/* Location: ./system/application/controllers/actions.php */