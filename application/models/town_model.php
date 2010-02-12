<?

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

    function Town_Model()
    {
        // Call the Model constructor
        parent::Model();
        $this->Town_Load($this->session->userdata('town'));
    }

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
            // Загружаем постройки
            $buildings_data_1 = explode(";", $town->buildings);
            for ($i = 0; $i <= 14; $i++)
            {
                $temp_data = explode(",", $buildings_data_1[$i]);
                $this->buildings[$i]['type'] = $temp_data[0];
                $this->buildings[$i]['level'] = $temp_data[1];
            }
            $this->level = $this->buildings[0]['level'];
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

}
?>