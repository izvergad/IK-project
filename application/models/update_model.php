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
       $town_messages = array();
       if(isset($id) and ($this->CI->Update_User->id > 0))
       {
           // Пробегаемся по городам
           for($i = 0; $i < sizeof ($this->CI->Update_User->towns); $i++)
           {
               $elapsed = time() - $this->CI->Update_User->towns[$i]->last_update;
               $this->db->set('last_update', time());
               
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
               // Почтовые трубы - на 3 золота меньше за ученых
               $scientists_gold_need = ($this->CI->Update_User->research->res3_13 > 0) ? 3 : 6 ;
               // Прирост золота
               $this->CI->Update_User->gold = $this->CI->Update_User->gold + (((($this->CI->Update_User->towns[$i]->peoples*3) - ($this->CI->Update_User->towns[$i]->scientists*$scientists_gold_need))/3600)*$elapsed);
               // Прирост дерева
               $this->CI->Update_User->towns[$i]->wood = $this->CI->Update_User->towns[$i]->wood + (($this->CI->Update_User->towns[$i]->workers/3600)*$elapsed);
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
               
               // Строим здания в городах
               if ($this->CI->Update_User->towns[$i]->build_line != '')
               {
                   // Псевдо постройки
                   $buildings = $this->Data_Model->load_build_line($this->CI->Update_User->towns[$i]->build_line);
                   // Псевдо очередь
                   $while_line = $this->CI->Update_User->towns[$i]->build_line;
                   // Счетчик цикла
                   $step = 0;
                   while (SizeOf($buildings) > 0)
                   {
                       // Переменные
                       $pos_text = 'pos'.$buildings[0]['position'].'_level';
                       $type_text = 'pos'.$buildings[0]['position'].'_type';
                       $level = $this->CI->Update_User->towns[$i]->$pos_text;
                       $cost = $this->Data_Model->building_cost($buildings[0]['type'], $level);
                       // Стоимость постройки
                       $wood = $this->CI->Update_User->towns[$i]->wood - $cost['wood'];
                       $wine = $this->CI->Update_User->towns[$i]->wine - $cost['wine'];
                       $marble = $this->CI->Update_User->towns[$i]->marble - $cost['marble'];
                       $crystal = $this->CI->Update_User->towns[$i]->crystal - $cost['crystal'];
                       $sulfur = $this->CI->Update_User->towns[$i]->sulfur - $cost['sulfur'];
                       // Если время строить
                       
                       if (($this->CI->Update_User->towns[$i]->build_start + $cost['time']) <= time())
                       {
                           if (($step == 0) or ($step > 0 and $wood >= 0 and $marble >= 0 and $wine >= 0 and $crystal >= 0 and $sulfur >= 0))
                           {
                                // Если не первое здание в очереди
                                if ($step > 0)
                                {
                                    $this->CI->Update_User->towns[$i]->wood = $wood;
                                    $this->CI->Update_User->towns[$i]->wine = $wine;
                                    $this->CI->Update_User->towns[$i]->marble = $marble;
                                    $this->CI->Update_User->towns[$i]->crystal = $crystal;
                                    $this->CI->Update_User->towns[$i]->sulfur = $sulfur;
                                }
                                    // Увеличиваем уровень
                                    $this->CI->Update_User->towns[$i]->$pos_text = $this->CI->Update_User->towns[$i]->$pos_text + 1;
                                    $this->CI->Update_User->towns[$i]->$type_text = $buildings[0]['type'];
                                    
                                    // пишем в БД
                                    $this->db->set($pos_text, $this->CI->Update_User->towns[$i]->$pos_text);
                                    $this->db->set($type_text, $this->CI->Update_User->towns[$i]->$type_text);
                                    // Отправляем сообщение
                                    //$message = ($this->CI->Update_User->towns[$i]->$pos_text == 1) ? 'Строительство "<a href="'.$this->config->item('base_url').'game/'.$this->Data_Model->building_class_by_type($buildings[0]['type']).'/'.$buildings[0]['position'].'/">'.$this->Data_Model->building_name_by_type($buildings[0]['type']).'</a>" завершено!' : 'Уровень здания "<a href="'.$this->config->item('base_url').'game/'.$this->Data_Model->building_class_by_type($buildings[0]['type']).'/'.$buildings[0]['position'].'/">'.$this->Data_Model->building_name_by_type($buildings[0]['type']).'</a>" увеличен до '.$this->CI->Update_User->towns[$i]->$pos_text.'!';
                                    $message = ($this->CI->Update_User->towns[$i]->$pos_text == 1) ? 'Строительство "'.$this->Data_Model->building_name_by_type($buildings[0]['type']).'" завершено!' : 'Уровень здания "'.$this->Data_Model->building_name_by_type($buildings[0]['type']).'" увеличен до '.$this->CI->Update_User->towns[$i]->$pos_text.'!';
                                    $town_message = array(
                                        'user' => $this->CI->Update_User->id,
                                        'town' => $sulfur = $this->CI->Update_User->towns[$i]->id,
                                        'date' => $this->CI->Update_User->towns[$i]->build_start + $cost['time'],
                                        'text' => $message
                                    );
                                    $town_messages[] = $town_message;
                                    // Если есть очередь
                                    if (SizeOf($buildings) > 1)
                                    {
                                        // уменьшаем настоящую очередь

                                        $this->CI->Update_User->towns[$i]->build_line = ($buildings[0]['type'] < 10) ? substr($this->CI->Update_User->towns[$i]->build_line, 4) : substr($this->CI->Update_User->towns[$i]->build_line, 5);
                                        $this->CI->Update_User->towns[$i]->build_start = $this->CI->Update_User->towns[$i]->build_start + $cost['time'];
                                        // и псевдо очередь
                                        $buildings = $this->Data_Model->load_build_line($this->CI->Update_User->towns[$i]->build_line);
                                        $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 4) : substr($while_line, 5);
                                    }
                                    else
                                    {
                                        // Обнуляем очередь
                                        $this->CI->Update_User->towns[$i]->build_line = '';
                                        $this->CI->Update_User->towns[$i]->build_start = 0;
                                        $buildings = array();
                                        break;
                                    }
                           }
                           else
                           {
                               // Если ресурсов не хватает уменьшаем настоящую и псевдо очереди
                               $this->CI->Update_User->towns[$i]->build_line = ($buildings[0]['type'] < 10) ? substr($this->CI->Update_User->towns[$i]->build_line, 4) : substr($this->CI->Update_User->towns[$i]->build_line, 5);
                               $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 4) : substr($while_line, 5);
                           }
                       }
                       else
                       {
                           // Если еще не время строить уменьшаем псевдо очередь построек
                           $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 4) : substr($while_line, 5);
                           $buildings = $this->Data_Model->load_build_line($while_line);
                           break;
                       }
                       // Снова загружаем псевдо постройки
                       $buildings = $this->Data_Model->load_build_line($while_line);
                       // Счетчик цикла
                       $step = $step + 1;
                   }
                        // Проверка данных, чтобы не писать в БД лишнего
                        if (strlen($this->CI->Update_User->towns[$i]->build_line) < 3){ $this->CI->Update_User->towns[$i]->build_line = ''; }
                        if ($this->CI->Update_User->towns[$i]->build_line == ''){ $this->CI->Update_User->towns[$i]->build_start = 0; }
                        // Пишем в БД очередь
                        $this->db->set('build_line', $this->CI->Update_User->towns[$i]->build_line);
                        $this->db->set('build_start', $this->CI->Update_User->towns[$i]->build_start);
               }
               // Обновляем в БД ресурсы города
               $this->db->set('peoples', $this->CI->Update_User->towns[$i]->peoples);
               $this->db->set('wood', $this->CI->Update_User->towns[$i]->wood);
               $this->db->set('wine', $this->CI->Update_User->towns[$i]->wine);
               $this->db->set('marble', $this->CI->Update_User->towns[$i]->marble);
               $this->db->set('crystal', $this->CI->Update_User->towns[$i]->crystal);
               $this->db->set('sulfur', $this->CI->Update_User->towns[$i]->sulfur);

               $this->db->where(array('id' => $this->CI->Update_User->towns[$i]->id));
               $this->db->update($this->session->userdata('universe').'_towns');

               // Строим армию в городах
               for ($army_type = 0; $army_type < 2; $army_type++)
               {
                   $army_type_line = ($army_type == 0) ? 'army_line' : 'ships_line';
                   $army_type_start = ($army_type == 0) ? 'army_start' : 'ships_start';

                   if ($this->CI->Update_User->armys[$this->CI->Update_User->towns[$i]->id]->$army_type_line != '')
                   {
                       // Загружаем очередь армии
                       $army_line = $this->CI->Update_User->armys[$this->CI->Update_User->towns[$i]->id]->$army_type_line;
                       $army = $this->Data_Model->load_army_line($this->CI->Update_User->armys[$this->CI->Update_User->towns[$i]->id]->$army_type_line);
                       $army_start = $this->CI->Update_User->armys[$this->CI->Update_User->towns[$i]->id]->$army_type_start;

                       while (SizeOf($army) > 0)
                       {
                           
                           // Переменные
                           $cost = $this->Data_Model->army_cost_by_type($army[0]['type']);
                           $ELAPSED_ARMY = time() - $army_start;
                           $count = floor($ELAPSED_ARMY/$cost['time']);
                           $class = $this->Data_Model->army_class_by_type($army[0]['type']);
                           // Если построен хотя бы один
                           if ($count >= $army[0]['count'])
                           {
                               // Если построены все
                               $this->CI->Update_User->armys[$this->CI->Update_User->towns[$i]->id]->$class = $this->CI->Update_User->armys[$this->CI->Update_User->towns[$i]->id]->$class + $army[0]['count'];
                               $army_line = ($army[0]['type'] < 10) ? substr($army_line, 4) : substr($army_line, 5);
                               $army = $this->Data_Model->load_army_line($army_line);
                               $army_start = $army_start + ($army[0]['count']*$cost['time']);
                           }
                           else
                           {
                               // Если построена часть
                               $this->CI->Update_User->armys[$this->CI->Update_User->towns[$i]->id]->$class = $this->CI->Update_User->armys[$this->CI->Update_User->towns[$i]->id]->$class + $count;
                               $army[0]['count'] = $army[0]['count'] - $count;
                               $army_line = ($army[0]['type'] < 10) ? substr($army_line, 4) : substr($army_line, 5);
                               $army_line = ($army_line != '') ? $army[0]['type'].','.$army[0]['count'].';'.$army_line : $army[0]['type'].','.$army[0]['count'] ;
                               $army_start = $army_start + ($count*$cost['time']);
                               break;
                           }
                           // Проверка данных, чтобы не писать в БД лишнего
                           if ($army_line == ''){ $army_start = 0; }
                           if ($army_line == 0){ $army_line = ''; }
                       }
                            // Обновляем армию в базу
                            for ($a = 1; $a <= 14; $a++)
                            {
                                $class = $this->Data_Model->army_class_by_type($a);
                                $this->db->set($class, $this->CI->Update_User->armys[$this->CI->Update_User->towns[$i]->id]->$class);
                            }
                            // Обновляем армию в базу
                            for ($a = 16; $a <= 22; $a++)
                            {
                                $class = $this->Data_Model->army_class_by_type($a);
                                $this->db->set($class, $this->CI->Update_User->armys[$this->CI->Update_User->towns[$i]->id]->$class);
                            }
                            // Обновляем очередь армии
                            $this->CI->Update_User->armys[$this->CI->Update_User->towns[$i]->id]->$army_type_line = $army_line;
                            $this->CI->Update_User->armys[$this->CI->Update_User->towns[$i]->id]->$army_type_start = $army_start;
                            $this->db->set($army_type_line, $army_line);
                            $this->db->set($army_type_start, $army_start);

                            $this->db->where(array('city' => $this->CI->Update_User->towns[$i]->id));
                            $this->db->update($this->session->userdata('universe').'_army');
                   }
               }
               // Вычисляем золото за армию
               $ARMY_GOLD = 0;
               for ($a = 1; $a <= 22; $a ++)
               {
                   $class = $this->Data_Model->army_class_by_type($a);
                   $cost = $this->Data_Model->army_cost_by_type($a);
                   $ARMY_GOLD = $ARMY_GOLD + ((($cost['gold'] * $this->CI->Update_User->armys[$this->CI->Update_User->towns[$i]->id]->$class)/3600)*$elapsed);
               }
               $this->CI->Update_User->gold = $this->CI->Update_User->gold - $ARMY_GOLD;
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
           if ($this->CI->Update_User->gold < 0) { $this->CI->Update_User->gold = 0; }
           $this->db->set('gold', $this->CI->Update_User->gold);
           // Обновляем премиумы
           if ($this->CI->Update_User->premium_account < time()){ $this->CI->Update_User->premium_account = 0; }
           if ($this->CI->Update_User->premium_wood < time()){ $this->CI->Update_User->premium_wood = 0; }
           if ($this->CI->Update_User->premium_wine < time()){ $this->CI->Update_User->premium_wine = 0; }
           if ($this->CI->Update_User->premium_marble < time()){ $this->CI->Update_User->premium_marble = 0; }
           if ($this->CI->Update_User->premium_crystal < time()){ $this->CI->Update_User->premium_crystal = 0; }
           if ($this->CI->Update_User->premium_sulfur < time()){ $this->CI->Update_User->premium_sulfur = 0; }
           if ($this->CI->Update_User->premium_capacity < time()){ $this->CI->Update_User->premium_capacity = 0; }
           $this->db->set('premium_account', $this->CI->Update_User->premium_account);
           $this->db->set('premium_wood', $this->CI->Update_User->premium_wood);
           $this->db->set('premium_wine', $this->CI->Update_User->premium_wine);
           $this->db->set('premium_marble', $this->CI->Update_User->premium_marble);
           $this->db->set('premium_crystal', $this->CI->Update_User->premium_crystal);
           $this->db->set('premium_sulfur', $this->CI->Update_User->premium_sulfur);
           $this->db->set('premium_capacity', $this->CI->Update_User->premium_capacity);
           //  Обучение
           $this->db->set('tutorial', $this->CI->Update_User->tutorial);
           $this->db->where(array('id' => $id));
           $this->db->update($this->session->userdata('universe').'_users');
           // Обновляем баллы науки
           $this->db->set('points', $this->CI->Update_User->research->points);
           $this->db->where(array('user' => $id));
           $this->db->update($this->session->userdata('universe').'_research');
           // Отправляем сообщения
           if (SizeOf($town_messages) > 0)
               foreach($town_messages as $message_data)
               {
                    $this->db->insert($this->session->userdata('universe').'_town_messages', $message_data);
               }
       }
    }

}

/* End of file update_model.php */
/* Location: ./system/application/models/update_model.php */