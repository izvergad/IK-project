<?php
class Player_Model extends Model
{
    
    function Player_Model()
    {
        // Call the Model constructor
        parent::Model();
    }

    function Error($error = '')
    {
                $this->session->set_flashdata(array('error' => $error));
                redirect('/main/error/', 'refresh');
    }

    function Game_Error($error = '')
    {
                $this->session->set_flashdata(array('game_error' => $error));
                redirect('/game/error/', 'refresh');
    }

    function Load_Player($id = 0)
    {
        if ($id > 0)
        {
                // Загружаем пользователя из Базы
                $this->Data_Model->Load_User($id);
                $this->user =& $this->Data_Model->temp_users_db[$id];
                $this->user_id =& $this->user->id;
                $this->town_id =& $this->user->town;
                $this->capital_id =& $this->user->capital;
                // Загружаем исследования
                $this->Data_Model->Load_Research($id);
                $this->research =& $this->Data_Model->temp_research_db[$id];
                // Всего ученых
                $this->scientists = 0;
                // Notes
                $notes_query = $this->db->get_where($this->session->userdata('universe').'_notes', array('user' => $id));
                $this->notes = $notes_query->row();
                // Загружаем города
                    $towns_query = $this->db->get_where($this->session->userdata('universe').'_towns', array('user' => $id));
                    foreach ($towns_query->result() as $town)
                    {
                        $this->capacity[$town->id] = 1500;
                        $this->tavern_level[$town->id] = 0;
                        $this->armys[$town->id] = array();
                        $this->warehouses[$town->id] = 0;
                        $this->army_gold_need[$town->id] = 0;
                        $this->corruption[$town->id] = 0;
                        $this->palace_level[$town->id] = 0;
                        // Загружаем город
                        $this->Data_Model->temp_towns_db[$town->id] = $town;
                        $this->towns[$town->id] =& $this->Data_Model->temp_towns_db[$town->id];
                        // Загружаем остров из базы
                        $this->Data_Model->Load_Island($town->island);
                        $this->islands[$town->island] =& $this->Data_Model->temp_islands_db[$town->island];
                        // Загружаем армию
                        $this->Data_Model->Load_Army($town->id);
                        $this->armys[$town->id] =& $this->Data_Model->temp_army_db[$town->id];
                        // Количество жителей
                        $this->peoples[$town->id] = $town->peoples + $town->scientists + $town->workers + $town->tradegood;
                        // Всего ученых
                        $this->scientists = $this->scientists + $town->scientists;
                        // Заполняем построенные типы зданий нулями
                        for ($i = 0; $i <= 26; $i++)
                        {
                            $this->already_build[$town->id][$i] = false;
                        }
                        // Вместимость
                        for ($i = 0; $i <= 14; $i++)
                        {
                            $pos_type = 'pos'.$i.'_type'; $pos_level = 'pos'.$i.'_level';
                            if ($town->$pos_type == 6){ $this->capacity[$town->id] = $this->capacity[$town->id] + ($town->$pos_level*8000); $this->warehouses[$town->id]++; $this->warehouses_levels[$town->id] = $town->$pos_level; }
                            // Уровни таверн
                            if($town->$pos_type == 8){ $this->tavern_level[$town->id] = $town->$pos_level; }
                            // Уровни дворцов и резиденций
                            if($town->$pos_type == 10 or $town->$pos_type == 15){ $this->palace_level[$town->id] = $town->$pos_level; }
                            // Если здание построено заносим в построенные
                            if ($town->$pos_level > 0){ $this->already_build[$town->id][$town->$pos_type] = true; }
                        }
                        // Строящиеся здания
                        $this->build_line[$town->id] = $this->Data_Model->load_build_line($town->build_line);
                        // Лимит гарнизона
                        $this->garisson_limit[$town->id] = 250 + (($town->pos0_level + $town->pos14_level) * 50);
                        // Вычисляем сальдо
                        // Каждый житель дает 3 золота
                        $this->saldo[$town->id] = $town->peoples*3;
                        $this->scientists_gold_need = ($this->research->res3_13 > 0) ? 3 : 6;
                        $this->saldo[$town->id] = $this->saldo[$town->id] - $town->scientists*$this->scientists_gold_need;
                        $this->peoples_gold[$town->id] = $this->saldo[$town->id];
                        // Вычитаем из сальдо содержание
                        for ($a = 1; $a <= 22; $a ++)
                        {
                            $class = $this->Data_Model->army_class_by_type($a);
                            if ($this->armys[$town->id]->$class > 0)
                            {
                                $cost = $this->Data_Model->army_cost_by_type($a, $this->research);
                                $this->saldo[$town->id] = $this->saldo[$town->id] - ($cost['gold']*$this->armys[$town->id]->$class);
                                $this->army_gold_need[$town->id] = $this->army_gold_need[$town->id] + ($cost['gold']*$this->armys[$town->id]->$class);
                            }
                        }
                        // Максимум жителей
                        $this->max_peoples[$town->id] = $this->Data_Model->peoples_by_level($town->pos0_level);
                        // Уровень счастья
                        $this->good[$town->id] = 0;
                        $this->plus[$town->id]['base'] = 196;
                        $this->minus[$town->id]['peoples'] = $town->peoples + $town->scientists + $town->workers + $town->tradegood;
                        $this->plus[$town->id]['capital'] = 0;
                        $this->plus[$town->id]['research'] = 0;
                        // Исследования
                        if ($this->research->res3_1 > 0 and $this->capital_id == $town->id)
                        {
                            $this->max_peoples[$town->id] = $this->max_peoples[$town->id] + 50;
                            $this->good[$town->id] = $this->good[$town->id] + 50;
                            $this->plus[$town->id]['capital'] = $this->plus[$town->id]['capital'] + 50;
                        }
                        if ($this->research->res2_8 > 0)
                        {
                            $this->good[$town->id] = $this->good[$town->id] + 25;
                            $this->plus[$town->id]['research'] = $this->plus[$town->id]['research'] + 25;
                        }
                        if ($this->research->res2_14 > 0 and $this->capital_id == $town->id)
                        {
                            $this->max_peoples[$town->id] = $this->max_peoples[$town->id] + 200;
                            $this->good[$town->id] = $this->good[$town->id] + 200;
                            $this->plus[$town->id]['capital'] = $this->plus[$town->id]['capital'] + 200;
                        }
                        if ($this->research->res2_15 > 0)
                        {
                            $this->max_peoples[$town->id] = $this->max_peoples[$town->id] + (20*$this->research->res2_15);
                            $this->good[$town->id] = $this->good[$town->id] + (10*$this->research->res2_15);
                            $this->plus[$town->id]['research'] = $this->plus[$town->id]['research'] + (10*$this->research->res2_15);
                        }
                        $this->plus[$town->id]['tavern'] = $this->tavern_level[$town->id];
                        $this->plus[$town->id]['wine'] = $town->tavern_wine*60;
                        $this->good[$town->id] = ($this->plus[$town->id]['base'] + $this->plus[$town->id]['capital'] + $this->plus[$town->id]['research'] + $this->plus[$town->id]['tavern'] + $this->plus[$town->id]['wine']) - ($this->minus[$town->id]['peoples']);
                        // Очереди армии и флота
                        $this->army_line[$town->id] = $this->Data_Model->load_army_line($this->armys[$town->id]->army_line);
                        $this->ships_line[$town->id] = $this->Data_Model->load_army_line($this->armys[$town->id]->ships_line);
                    }
                    // Вычисляем коррупцию
                    foreach($this->towns as $town)
                    {
                        $colonys = SizeOf($this->towns) - 1;
                        if ($colonys > 0)
                        {
                            $this->corruption[$town->id] = (1 - ($this->palace_level[$town->id] + 1) / ($colonys + 1));
                            if ($this->corruption[$town->id] > 0)
                            {
                                $this->good[$town->id] = $this->good[$town->id] - (($town->peoples + $this->good[$town->id]) * $this->corruption[$town->id] );
                            }
                        }
                    }
                $this->plus_research = 1;
                // Бумага - на 2% больше баллов
                if ($this->research->res3_2 > 0){$this->plus_research = $this->plus_research + 0.02;}
                // Чернила - на 4% больше баллов
                if ($this->research->res3_5 > 0){$this->plus_research = $this->plus_research + 0.04;}
                // Механическая ручка - на 8% больше баллов
                if ($this->research->res3_11 > 0){$this->plus_research = $this->plus_research + 0.08;}
                // Будущее Науки - на 2% больше баллов за уровень
                if ($this->research->res3_16 > 0){$this->plus_research = $this->plus_research + (0.02*$this->research->res3_16);}

                $this->island_id = $this->towns[$this->town_id]->island;
                $this->now_town = $this->towns[$this->town_id];
                $this->now_island = $this->islands[$this->island_id];
            }
            $this->Data_Model->temp_players[$id] =& $this->Player_Model;
    }

    function User_Login()
    {
        if (isset($_POST['name']) & isset($_POST['password']))
        {
            $query = $this->db->get_where($_POST['universe'].'_users', array('login' => $_POST['name'], 'password' => md5($_POST['password'])));
            if ($query->num_rows() > 0)
            {
                $user = $query->row();
                $this->session->set_userdata(array('id' => $user->id, 'universe' => $_POST['universe'], 'login' => $_POST['name'], 'password' => md5($_POST['password'])));
                redirect('/game/', 'refresh');
            }
            else
            {
                $this->Error('Неверные логин или пароль.');
            }
        }
    }

    function Load_Town_Messages()
    {
        // Загрузка сообщений
        $this->db->order_by("date", "desc");
        $where_array = array();
            $town_messages = $this->db->get_where($this->session->userdata('universe').'_town_messages', array('user' => $this->session->userdata('id')));
            if ($town_messages->num_rows() > 0)
                foreach ($town_messages->result() as $row)
                    $this->towns_messages[] = $row;
    }

    function Load_New_Messages()
    {
            $town_messages = $this->db->get_where($this->session->userdata('universe').'_town_messages', array('user' => $this->session->userdata('id'), 'checked' => 0));
            $this->new_towns_messages = $town_messages->num_rows;
    }

    function correct_buildings()
    {
        for ($i = 0; $i < sizeof($this->build_line[$this->town_id]); $i++)
        {
            $pos_type = 'pos'.$this->build_line[$this->town_id][$i]['position'].'_type';
            $pos_level = 'pos'.$this->build_line[$this->town_id][$i]['position'].'_level';
            if ($this->now_town->$pos_type == 0)
            {
                $this->already_build[$this->town_id][$this->build_line[$this->town_id][$i]['type']] = true;
                $this->now_town->$pos_type = $this->build_line[$this->town_id][$i]['type'];
            }
        }
    }


}

/* End of file player_model.php */
/* Location: ./system/application/models/player_model.php */