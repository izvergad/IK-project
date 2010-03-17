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
        //$this->elapsed = time() - $this->User_Model->last_visit;

        $this->CI =& get_instance();
        
        //$this->update_my_town($this->Town_Model->id);
        //$this->update_my_user();

        $this->update_user($this->session->userdata('id'));
        //$this->update_user(2);
    }

    /**
     * Обновление игрока
     * @param <int> $id
     */
    function update_user($id)
    {
       // Получаем данные игрока
       $this->CI->load->model('User_Model','Update_User');
       $this->CI->Update_User->Load_User($id);
       if(isset($id) and ($this->CI->Update_User->id > 0))
       {
           // Пробегаемся по городам
           for($i = 0; $i < sizeof ($this->CI->Update_User->towns); $i++)
           {
               $elapsed = time() - $this->CI->Update_User->towns[$i]->last_update;
               $this->db->set('last_update', time());
               // Строим здания в городах
               if ($this->CI->Update_User->towns[$i]->build_line != '')
               {
                   $ochered = 0;
                   // Если вообще что нибудь строится
                   // Загружаем очередь построек
                   $buildings = $this->Data_Model->load_build_line($this->CI->Update_User->towns[$i]->build_line);
                   $pos_text = 'pos'.$buildings[$ochered]['position'].'_level';
                   $type_text = 'pos'.$buildings[$ochered]['position'].'_type';
                   $level = $this->CI->Update_User->towns[$i]->$pos_text;
                   $cost = $this->Data_Model->building_cost($buildings[$ochered]['type'], $level);
                    if (($this->CI->Update_User->towns[$i]->build_start + $cost['time']) <= time())
                    {
                        // Обучение - постройка академии
                        if ($buildings[$ochered]['type'] == 3 and $this->CI->Update_User->tutorial <= 5)
                        {
                            $this->CI->Update_User->tutorial = 6;
                        }
                        // Обучение - постройка казармы
                        if ($buildings[$ochered]['type'] == 5 and $this->CI->Update_User->tutorial <= 9)
                        {
                            $this->CI->Update_User->tutorial = 10;
                        }
                        // Строим здание
                        $this->CI->Update_User->towns[$i]->$pos_text = $this->CI->Update_User->towns[$i]->$pos_text + 1;
                        $this->CI->Update_User->towns[$i]->$type_text = $buildings[$ochered]['type'];
                        // Если есть очередь
                        if (sizeof($buildings) > 1)
                        {
                            $this->CI->Update_User->towns[$i]->build_line = substr($this->CI->Update_User->towns[$i]->build_line, 3);
                            $this->CI->Update_User->towns[$i]->build_start = $this->CI->Update_User->towns[$i]->build_start + $cost['time'];
                            // Нужно ли????
                            $buildings = $this->Data_Model->load_build_line($this->CI->Update_User->towns[$i]->build_line);
                        }
                        else
                        {
                            $this->CI->Update_User->towns[$i]->build_line = '';
                            $this->CI->Update_User->towns[$i]->build_start = 0;
                            $buildings = array();
                        }
                        // Обновляем в базу
                        for ($a = 0; $a <= 14; $a++)
                        {
                            $level_text = 'pos'.$a.'_level';
                            $type_text = 'pos'.$a.'_type';
                            $this->db->set($type_text, $this->CI->Update_User->towns[$i]->$type_text);
                            $this->db->set($level_text, $this->CI->Update_User->towns[$i]->$level_text);
                        }
                        $this->db->set('build_line', $this->CI->Update_User->towns[$i]->build_line);
                        $this->db->set('build_start', $this->CI->Update_User->towns[$i]->build_start);

                    }
               }
               // Счастье
               $good = 196 - $this->CI->Update_User->towns[$i]->peoples;
               // Колодец - +50 счастья в столице
               if ($this->CI->Update_User->research->res3_1 > 0 and $this->CI->Update_User->towns[$i]->id == $this->CI->Update_User->capital) { $good = $good + 50; }
               // Утопия - +200 счастья в столице
               if ($this->CI->Update_User->research->res2_14 > 0 and $this->CI->Update_User->towns[$i]->id == $this->CI->Update_User->capital) { $good = $good + 200; }

               // Прирост жителей
               $workers = $this->CI->Update_User->towns[$i]->workers;
               $scientists = $this->CI->Update_User->towns[$i]->scientists;
               $max = $this->Data_Model->peoples_by_level($this->CI->Update_User->towns[$i]->pos0_level);
               // Колодец - +50 жилых мест в столице
               if ($this->CI->Update_User->research->res3_1 > 0 and $this->CI->Update_User->towns[$i]->id == $this->CI->Update_User->capital) { $max = $max + 50; }
               // Утопия - +200 жилых мест в столице
               if ($this->CI->Update_User->research->res2_14 > 0 and $this->CI->Update_User->towns[$i]->id == $this->CI->Update_User->capital) { $max = $max + 200; }
               $max_peoples = $max - $workers - $scientists;
               $this->CI->Update_User->towns[$i]->peoples = $this->CI->Update_User->towns[$i]->peoples + ((($good/50)/3600)*$elapsed);
               if ($this->CI->Update_User->towns[$i]->peoples < 0){ $this->CI->Update_User->towns[$i]->peoples = 0; }
               if ($this->CI->Update_User->towns[$i]->peoples > $max_peoples){ $this->CI->Update_User->towns[$i]->peoples = $max_peoples; }

               $this->db->set('peoples', $this->CI->Update_User->towns[$i]->peoples);
               // Почтовые трубы - на 3 золота меньше за ученых
               $scientists_gold_need = ($this->CI->Update_User->research->res3_13 > 0) ? 3 : 6 ;
               // Прирост золота
               $this->CI->Update_User->gold = $this->CI->Update_User->gold + (((($this->CI->Update_User->towns[$i]->peoples*3) - ($this->CI->Update_User->towns[$i]->scientists*$scientists_gold_need))/3600)*$elapsed);
               // Прирост дерева
               $this->CI->Update_User->towns[$i]->wood = $this->CI->Update_User->towns[$i]->wood + (($this->CI->Update_User->towns[$i]->workers/3600)*$elapsed);
               $this->db->set('wood', $this->CI->Update_User->towns[$i]->wood);
               // Увеличение баллов за исследования
               $plus_research = 1;
               // Бумага - на 2% больше баллов
               if ($this->CI->Update_User->research->res3_2 > 0){$plus_research = $plus_research + 0.02;}
               // Чернила - на 4% больше баллов
               if ($this->CI->Update_User->research->res3_5 > 0){$plus_research = $plus_research + 0.04;}
               // Механическая ручка - на 8% больше баллов
               if ($this->CI->Update_User->research->res3_11 > 0){$plus_research = $plus_research + 0.08;}
               // Будущее Науки - на 2% больше баллов за уровень
               if ($this->CI->Update_User->research->res3_16 > 0){$plus_research = $plus_research + (0.02*$this->CI->Update_User->research->res3_16);}
               // Баллы науки
               $add_points = $this->CI->Update_User->towns[$i]->scientists * $plus_research;
               $this->CI->Update_User->research->points = $this->CI->Update_User->research->points + (($add_points/3600)*$elapsed);
               
               $this->db->where(array('id' => $this->CI->Update_User->towns[$i]->id));
               $this->db->update($this->session->userdata('universe').'_towns');

           }
           
           // Пробегаемся по островам
           foreach ($this->CI->Update_User->islands as $island)
           {
                   // Цены для улучшения леса
                   $cost = $this->Data_Model->island_cost(0,$island->wood_level);
                   $need_wood = $cost['wood'] - $island->wood_count;
                   $need_wood = ($need_wood < 0) ? 0 : $need_wood;
                   if ($island->wood_start > 0)
                   {
                       $elapsed_wood = time() - $island->wood_start;
                       if ($elapsed_wood >= $cost['time'])
                       {
                           $this->CI->Update_User->islands[$island->id]->wood_level = $island->wood_level + 1;
                           $this->CI->Update_User->islands[$island->id]->wood_start = 0;
                           $this->db->set('wood_level', $this->CI->Update_User->islands[$island->id]->wood_level);
                           $this->db->set('wood_start', 0);
                           $this->db->where(array('id' => $this->CI->Update_User->islands[$island->id]->id));
                           $this->db->update($this->session->userdata('universe').'_islands');
                       }
                   }else{
                       // Если дерева достаточно
                       if ($need_wood == 0)
                       {
                           $this->CI->Update_User->islands[$island->id]->wood_start = time();
                           $this->CI->Update_User->islands[$island->id]->wood_count = $island->wood_count - $cost['wood'];
                           $this->db->set('wood_start', $this->CI->Update_User->islands[$island->id]->wood_start);
                           $this->db->set('wood_count', $this->CI->Update_User->islands[$island->id]->wood_count);
                           $this->db->where(array('id' => $this->CI->Update_User->islands[$island->id]->id));
                           $this->db->update($this->session->userdata('universe').'_islands');
                       }
                   }
           }
           // Последнее посещение
           $this->db->set('last_visit', time());
           // Если текущий игрок обновляем город
           if ($this->CI->Update_User->id == $this->User_Model->id)
           {
               $this->db->set('town', $this->User_Model->town);
           }
           // Обновляем золото
           $this->db->set('gold', $this->CI->Update_User->gold);
           //  Обучение
           $this->db->set('tutorial', $this->CI->Update_User->tutorial);
           $this->db->where(array('id' => $id));
           $this->db->update($this->session->userdata('universe').'_users');
           // Обновляем баллы науки
           $this->db->set('points', $this->CI->Update_User->research->points);
           $this->db->where(array('user' => $id));
           $this->db->update($this->session->userdata('universe').'_research');

       }
    }

}

/* End of file update_model.php */
/* Location: ./system/application/models/update_model.php */