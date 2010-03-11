<?php
/**
 * Модель острова
 */
class Island_Model extends Model
{
    var $towns = array();
    var $users = array();
    var $island = array();
    var $levels = array();
    var $resources = array();

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
        if (!isset($id) or !($id > 0)){ $id = $this->Town_Model->island->id; }
        // Загружаем остров из базы
        $this->Data_Model->Load_Island($id);
        $this->island =& $this->Data_Model->temp_islands_db[$id];

        // Загружаем города
        $this->Data_Model->Load_Town($this->island->city0);
        $this->Data_Model->Load_Town($this->island->city1);
        $this->Data_Model->Load_Town($this->island->city2);
        $this->Data_Model->Load_Town($this->island->city3);
        $this->Data_Model->Load_Town($this->island->city4);
        $this->Data_Model->Load_Town($this->island->city5);
        $this->Data_Model->Load_Town($this->island->city6);
        $this->Data_Model->Load_Town($this->island->city7);
        $this->Data_Model->Load_Town($this->island->city8);
        $this->Data_Model->Load_Town($this->island->city9);
        $this->Data_Model->Load_Town($this->island->city10);
        $this->Data_Model->Load_Town($this->island->city11);
        $this->Data_Model->Load_Town($this->island->city12);
        $this->Data_Model->Load_Town($this->island->city13);
        $this->Data_Model->Load_Town($this->island->city14);
        $this->Data_Model->Load_Town($this->island->city15);
        // Добавляем в массив
        $this->towns[0] =& $this->Data_Model->temp_towns_db[$this->island->city0];
        $this->towns[1] =& $this->Data_Model->temp_towns_db[$this->island->city1];
        $this->towns[2] =& $this->Data_Model->temp_towns_db[$this->island->city2];
        $this->towns[3] =& $this->Data_Model->temp_towns_db[$this->island->city3];
        $this->towns[4] =& $this->Data_Model->temp_towns_db[$this->island->city4];
        $this->towns[5] =& $this->Data_Model->temp_towns_db[$this->island->city5];
        $this->towns[6] =& $this->Data_Model->temp_towns_db[$this->island->city6];
        $this->towns[7] =& $this->Data_Model->temp_towns_db[$this->island->city7];
        $this->towns[8] =& $this->Data_Model->temp_towns_db[$this->island->city8];
        $this->towns[9] =& $this->Data_Model->temp_towns_db[$this->island->city9];
        $this->towns[10] =& $this->Data_Model->temp_towns_db[$this->island->city10];
        $this->towns[11] =& $this->Data_Model->temp_towns_db[$this->island->city11];
        $this->towns[12] =& $this->Data_Model->temp_towns_db[$this->island->city12];
        $this->towns[13] =& $this->Data_Model->temp_towns_db[$this->island->city13];
        $this->towns[14] =& $this->Data_Model->temp_towns_db[$this->island->city14];
        $this->towns[15] =& $this->Data_Model->temp_towns_db[$this->island->city15];
        // Заружаем пользователей
        for($i = 0; $i <= 15; $i++)
        {
            if (isset($this->towns[$i]))
            {
                $this->Data_Model->Load_User($this->towns[$i]->user);
                $this->users[$i] =& $this->Data_Model->temp_users_db[$this->towns[$i]->user];
            }
        }
        // Уровни шахт
        $this->levels[0] = $this->island->wood_level;
        $this->levels[1] = $this->island->trade_level;
        // Пожертвований
        $this->resources[0] = $this->island->wood_count;
        $this->resources[1] = $this->island->trade_count;
    }

}
/* End of file island_model.php */
/* Location: ./system/application/models/island_model.php */