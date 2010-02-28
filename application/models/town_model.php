<?
/**
 * Модель города
 */
class Town_Model extends Model
{
    var $id = 0;
    var $resources = array();
    var $capacity = array();
    var $name = 'Полис';
    var $buildings = array();
    var $level = 0;
    var $island = 0;
    var $island_name = 'Остров';
    var $x = 0;
    var $y = 0;
    var $trade_resource = 0;
    var $peoples = array();
    var $actions = 0;
    var $build_line = array();
    var $build_text = '';
    var $build_start = 0;
    var $already_build = array();

    function Town_Model()
    {
        // Call the Model constructor
        parent::Model();
        $this->Town_Load($this->session->userdata('town'));
    }

    /**
     * Загрузка данных города
     * @param <int> $id
     */
    function Town_Load($id)
    {
        if ($id > 0)
        {
            $query = $this->db->get_where($this->session->userdata('universe').'_towns', array('id' => $id));
            $town = $query->row();
            $this->id = $town->id;
            $this->island = $town->island;
            // Загружаем ресурсы
            $this->resources['wood'] = $town->wood;
            $this->resources['wine'] = $town->wine;
            $this->resources['marble'] = $town->marble;
            $this->resources['crystal'] = $town->crystal;
            $this->resources['sulfur'] = $town->sulfur;
            // Устанавливаем вместимость
            $this->capacity['wood'] = $this->config->item('standart_capacity');
            $this->capacity['wine'] = $this->config->item('standart_capacity');
            $this->capacity['marble'] = $this->config->item('standart_capacity');
            $this->capacity['crystal'] = $this->config->item('standart_capacity');
            $this->capacity['sulfur'] = $this->config->item('standart_capacity');
            // Название города
            $this->name = $town->name;
            // Заполняем список построенных типов зданий нулями
            for ($i = 0; $i <= 26; $i++)
            {
                $this->already_build[$i] = false;
            }
            // Загружаем готовые постройки
            $buildings_data_1 = explode(";", $town->buildings);
            for ($i = 0; $i <= 14; $i++)
            {
                $temp_data = explode(",", $buildings_data_1[$i]);
                $this->buildings[$i]['type'] = $temp_data[0];
                $this->buildings[$i]['level'] = $temp_data[1];
                // Отмечаем что данный тип здания уже построен
                if ($temp_data[1] > 0){ $this->already_build[$temp_data[0]] = true; }
            }
            $this->level = $this->buildings[0]['level'];
            // Загружаем список текущих построек
            $this->load_build_line($town->build_line);

            $this->build_start = $town->build_start;
            // Население
            $this->peoples['all'] = $town->peoples;
            $this->peoples['free'] = $town->peoples;
            // очки действий
            $this->actions = $town->actions;

            $query = $this->db->get_where($this->session->userdata('universe').'_islands', array('id' => $this->island));
            $island = $query->row();
            $this->trade_resource = $island->trade_resource;
            $this->x = $island->x;
            $this->y = $island->y;
            $this->island_name = $island->name;
        }
    }

    /**
     * Очередь построек
     * @param <string> $text
     */
    function load_build_line($text)
    {
            $this->build_text = $text;
            $this->build_line = array();
            if ($text != '')
            {
                $build_line = explode(";", $text);
                for ($i = 0; $i < count($build_line); $i++)
                {
                    if ($build_line[$i] != '')
                    {
                        $temp_data = explode(",", $build_line[$i]);
                        $this->build_line[$i] = array();
                        $this->build_line[$i]['position'] = $temp_data[0];
                        $this->build_line[$i]['type'] = $temp_data[1];
                        $this->already_build[$temp_data[1]] = true;
                    }
                }
            }   
    }

    /**
     * Все здания города в строке
     * @return <string>
     */
    function get_buildings_text()
    {
        $return = '';
            for ($i = 0; $i <= 14; $i++)
            {
                $return .= $this->buildings[$i]['type'].','.$this->buildings[$i]['level'];
                if ($i < 14) { $return .= ';'; }
            }
            return $return;
    }

    /*function get_build_line_text()
    {
        $return = '';
        if ($this->build_text != '')
        {
            for ($i = 1; $i <= count($this->build_line); $i++)
            {
                $return .= $this->build_line[$i-1]['position'].','.$this->build_line[$i-1]['type'];
                if ($i < count($this->build_line)){ $return .= ';'; }
            }
        }
        return $return;
    }*/

}

/* End of file town_model.php */
/* Location: ./system/application/models/town_model.php */