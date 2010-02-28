<?php
/**
 * Контроллер действий
 */
class Actions extends Controller
{

    function Actions()
    {
        parent::Controller();
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
     * Постройка здания
     * @param <int> $position
     * @param <int> $id
     * @param <bool> $redirect
     */
    function build($position, $id, $redirect = true)
    {
        $class = $this->Data_Model->building_class_by_type($id);
        // Заглушка build_text пока не будет готова очередь потроек
        if ($class != 'buildingGround' and $this->Town_Model->build_text == '' and $this->Town_Model->buildings[$position]['type'] == 0)
        {
            // Получаем цены
            $cost = $this->Data_Model->building_cost($id, 0);
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
        if ($redirect) { redirect('/game/', 'refresh'); }
    }

}

/* End of file actions.php */
/* Location: ./system/application/controllers/actions.php */