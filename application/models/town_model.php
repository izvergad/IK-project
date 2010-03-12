<?
/**
 * Модель города
 */
class Town_Model extends Model
{
    var $id = 0;
    var $is_capital = false;
    var $resources = array();
    var $capacity = array();
    var $name = 'Полис';
    var $buildings = array();
    var $level = 0;
    
    var $island = array();

    var $peoples = array();
    var $actions = 0;
    
    var $build_line = array();
    var $build_text = '';
    var $build_start = 0;
    var $already_build = array();

    var $garrison_limit = 0;

    var $minus = array();
    var $plus = array();
    var $good = 0;

    var $workers_wood = 0;
    
    var $last_update = 0;

    function Town_Model()
    {
        // Call the Model constructor
        parent::Model();
    }

    /**
     * Загрузка данных города
     * @param <int> $id
     */
    function Town_Load($id)
    {
        if ($id > 0)
        {
            // Загружаем город из Базы
            $this->Data_Model->Load_Town($id);
            $town =& $this->Data_Model->temp_towns_db[$id];
            // Загружаем пользователя из Базы
            $this->Data_Model->Load_User($town->user);
            $user =& $this->Data_Model->temp_users_db[$town->user];
            // Загружаем остров из Базы
            $this->Data_Model->Load_Island($town->island);
            $this->island =& $this->Data_Model->temp_islands_db[$town->island];
            // Заполняем класс данными
            $this->id = $town->id;
            // проверка на столицу
            $this->is_capital = ($user->capital == $this->id) ? true : false;
            
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
            // Счетчик
            $this->last_update = $town->last_update;
            // Заполняем список построенных типов зданий нулями
            for ($i = 0; $i <= 26; $i++)
            {
                $this->already_build[$i] = false;
            }
            // Загружаем готовые постройки
                $this->buildings[0]['type'] = $town->pos0_type;
                $this->buildings[0]['level'] = $town->pos0_level;
                $this->buildings[1]['type'] = $town->pos1_type;
                $this->buildings[1]['level'] = $town->pos1_level;
                $this->buildings[2]['type'] = $town->pos2_type;
                $this->buildings[2]['level'] = $town->pos2_level;
                $this->buildings[3]['type'] = $town->pos3_type;
                $this->buildings[3]['level'] = $town->pos3_level;
                $this->buildings[4]['type'] = $town->pos4_type;
                $this->buildings[4]['level'] = $town->pos4_level;
                $this->buildings[5]['type'] = $town->pos5_type;
                $this->buildings[5]['level'] = $town->pos5_level;
                $this->buildings[6]['type'] = $town->pos6_type;
                $this->buildings[6]['level'] = $town->pos6_level;
                $this->buildings[7]['type'] = $town->pos7_type;
                $this->buildings[7]['level'] = $town->pos7_level;
                $this->buildings[8]['type'] = $town->pos8_type;
                $this->buildings[8]['level'] = $town->pos8_level;
                $this->buildings[9]['type'] = $town->pos9_type;
                $this->buildings[9]['level'] = $town->pos9_level;
                $this->buildings[10]['type'] = $town->pos10_type;
                $this->buildings[10]['level'] = $town->pos10_level;
                $this->buildings[11]['type'] = $town->pos11_type;
                $this->buildings[11]['level'] = $town->pos11_level;
                $this->buildings[12]['type'] = $town->pos12_type;
                $this->buildings[12]['level'] = $town->pos12_level;
                $this->buildings[13]['type'] = $town->pos13_type;
                $this->buildings[13]['level'] = $town->pos13_level;
                $this->buildings[14]['type'] = $town->pos14_type;
                $this->buildings[14]['level'] = $town->pos14_level;
                // Отмечаем что данный тип здания уже построен
                for ($i = 0; $i <= 14; $i++)
                {
                    if ($this->buildings[$i]['level'] > 0){ $this->already_build[$this->buildings[$i]['type']] = true; }
                }
            $this->level = $this->buildings[0]['level'];
            // Загружаем список текущих построек
            $this->build_text = $town->build_line;
            $this->build_line = $this->Data_Model->load_build_line($town->build_line);

            $this->build_start = $town->build_start;
            // Население
            $this->peoples['free'] = $town->peoples;
            $this->peoples['workers'] = $town->workers;
            $this->peoples['special'] = 0;
            $this->peoples['research'] = 0;
            $this->peoples['templer'] = 0;
            $this->peoples['max'] = $this->Data_Model->peoples_by_level($this->level);
            $this->peoples['all'] = $this->peoples['free'] + $this->peoples['workers'] + $this->peoples['special'] + $this->peoples['research'] + $this->peoples['templer'];
            // очки действий
            $this->actions = $town->actions;
            // лимит гарнизона
            $wall_level = 0;
            $this->garrison_limit = 250 + (($this->buildings[0]['level'] + $wall_level) * 50);
            // Счастье
            $this->minus['peoples'] = $this->peoples['all'];
            $this->plus['base'] = 196;
            $this->plus['capital'] = ($this->is_capital) ? 250 : 0;
            $this->plus['capital'] = 0;
            $this->plus['research'] = 0;
            $this->good = ($this->plus['base'] + $this->plus['capital']) - ($this->minus['peoples']);
            
            $this->workers_wood = $town->workers_wood;
        }
    }

    /**
     * Счастье города
     * @param <int> $peoples
     * @return <int>
     */
    function get_good($peoples = 0)
    {
        $good = 196;
        $good = $good - $peoples;
        return $good;
    }

    /**
     * Золото в секунду
     * @param <array> $peoples
     * @return <float>
     */
    function add_gold_on_sec($peoples)
    {
        return ($peoples['free']*3)/3600;
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