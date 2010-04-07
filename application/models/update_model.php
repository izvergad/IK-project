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
        $this->CI =& get_instance();
        $this->Update_Player($this->session->userdata('id'));
    }

    /**
     * Обновление игрока
     * @param <int> $id
     */
    function Update_Player($id)
    {
       // Получаем данные игрока
       $this->CI->load->model('Player_Model','Update_Player');
            if (isset($this->Data_Model->temp_players[$id]))
            {
                $this->CI->Update_Player =& $this->Data_Model->temp_players[$id];
            }
            else
            {
                $this->CI->Update_Player->Load_Player($id);
            }
       $towns_messages = array();
       if(isset($id) and ($id > 0))
       {
           // Пробегаемся по городам
           foreach($this->CI->Update_Player->towns as $town)
           {
               $i = $town->id;
               $elapsed = time() - $this->CI->Update_Player->towns[$i]->last_update;
               $this->db->set('last_update', time());
               // Вычитаем виноград за вино
               $wine_need = $this->Data_Model->wine_by_tavern_level($this->CI->Update_Player->towns[$i]->tavern_wine);
               $this->CI->Update_Player->towns[$i]->wine = $this->CI->Update_Player->towns[$i]->wine - (($wine_need/3600)*$elapsed);
               if ($this->CI->Update_Player->towns[$i]->wine < 0){ $this->CI->Update_Player->towns[$i]->wine = 0; $this->CI->Update_Player->towns[$i]->tavern_wine = 0; }
               // Прирост жителей
               if ($this->CI->Update_Player->peoples[$i] < $this->CI->Update_Player->max_peoples[$i])
               {
                   $this->CI->Update_Player->towns[$i]->peoples = $this->CI->Update_Player->towns[$i]->peoples + ((($this->CI->Update_Player->good[$i]/50)/3600)*$elapsed);
                   $this->CI->Update_Player->peoples[$i] = $this->CI->Update_Player->towns[$i]->peoples + $this->CI->Update_Player->towns[$i]->scientists + $this->CI->Update_Player->towns[$i]->workers + $this->CI->Update_Player->towns[$i]->tradegood;
               }
               if ($this->CI->Update_Player->towns[$i]->peoples < 0){ $this->CI->Update_Player->towns[$i]->peoples = 0; }
               if ($this->CI->Update_Player->peoples[$i] > $this->CI->Update_Player->max_peoples[$i])
               {
                   $this->CI->Update_Player->towns[$i]->peoples = $this->CI->Update_Player->max_peoples[$i] - ($this->CI->Update_Player->peoples[$i] - $this->CI->Update_Player->towns[$i]->peoples);
                   $this->CI->Update_Player->peoples[$i] = $this->CI->Update_Player->towns[$i]->peoples + $this->CI->Update_Player->towns[$i]->scientists + $this->CI->Update_Player->towns[$i]->workers + $this->CI->Update_Player->towns[$i]->tradegood;
               }
               // Прирост золота
               $this->CI->Update_Player->user->gold = $this->CI->Update_Player->user->gold + (($this->CI->Update_Player->saldo[$i]/3600)*$elapsed);
               // Прирост дерева
               $this->CI->Update_Player->towns[$i]->wood = $this->CI->Update_Player->towns[$i]->wood + (($this->CI->Update_Player->towns[$i]->workers/3600)*$elapsed)*(1-$this->CI->Update_Player->corruption[$i])*($this->CI->Update_Player->plus_wood);
               // Прирост другого ресурса
               switch($this->CI->Update_Player->islands[$town->island]->trade_resource)
               {
                   case 1:$this->CI->Update_Player->towns[$i]->wine = $this->CI->Update_Player->towns[$i]->wine + (($this->CI->Update_Player->towns[$i]->tradegood/3600)*$elapsed)*(1-$this->CI->Update_Player->corruption[$i])*($this->CI->Update_Player->plus_wine);
                   break;
                   case 2:$this->CI->Update_Player->towns[$i]->marble = $this->CI->Update_Player->towns[$i]->marble + (($this->CI->Update_Player->towns[$i]->tradegood/3600)*$elapsed)*(1-$this->CI->Update_Player->corruption[$i])*($this->CI->Update_Player->plus_marble);
                   break;
                   case 3:$this->CI->Update_Player->towns[$i]->crystal = $this->CI->Update_Player->towns[$i]->crystal + (($this->CI->Update_Player->towns[$i]->tradegood/3600)*$elapsed)*(1-$this->CI->Update_Player->corruption[$i])*($this->CI->Update_Player->plus_crystal);
                   break;
                   case 4:$this->CI->Update_Player->towns[$i]->sulfur = $this->CI->Update_Player->towns[$i]->sulfur + (($this->CI->Update_Player->towns[$i]->tradegood/3600)*$elapsed)*(1-$this->CI->Update_Player->corruption[$i])*($this->CI->Update_Player->plus_sulfur);
                   break;
               }
               // Проверяем не вышли ли мы за пределы вместимости
               if ($this->CI->Update_Player->towns[$i]->wood > $this->CI->Update_Player->capacity[$i]) {$this->CI->Update_Player->towns[$i]->wood = $this->CI->Update_Player->capacity[$i];}
               if ($this->CI->Update_Player->towns[$i]->wine > $this->CI->Update_Player->capacity[$i]) {$this->CI->Update_Player->towns[$i]->wine = $this->CI->Update_Player->capacity[$i];}
               if ($this->CI->Update_Player->towns[$i]->marble > $this->CI->Update_Player->capacity[$i]) {$this->CI->Update_Player->towns[$i]->marble = $this->CI->Update_Player->capacity[$i];}
               if ($this->CI->Update_Player->towns[$i]->crystal > $this->CI->Update_Player->capacity[$i]) {$this->CI->Update_Player->towns[$i]->crystal = $this->CI->Update_Player->capacity[$i];}
               if ($this->CI->Update_Player->towns[$i]->sulfur > $this->CI->Update_Player->capacity[$i]) {$this->CI->Update_Player->towns[$i]->sulfur = $this->CI->Update_Player->capacity[$i];}
               // Баллы науки
               $add_points = $this->CI->Update_Player->towns[$i]->scientists * $this->CI->Update_Player->plus_research;
               $this->CI->Update_Player->research->points = $this->CI->Update_Player->research->points + (($add_points/3600)*$elapsed);
               // Строим здания в городах
               if ($this->CI->Update_Player->towns[$i]->build_line != '')
               {
                   // Псевдо постройки
                   $buildings = $this->Data_Model->load_build_line($this->CI->Update_Player->towns[$i]->build_line);
                   // Псевдо очередь
                   $while_line = $this->CI->Update_Player->towns[$i]->build_line;
                   // Счетчик цикла
                   $step = 0;
                   while (SizeOf($buildings) > 0)
                   {
                       // Переменные
                       $level_text = 'pos'.floor($buildings[0]['position']).'_level';
                       $type_text = 'pos'.floor($buildings[0]['position']).'_type';
                       $level = $this->CI->Update_Player->towns[$i]->$level_text;
                       $type = $this->CI->Update_Player->towns[$i]->$type_text;
                       $cost = $this->Data_Model->building_cost($buildings[0]['type'], $level, $this->CI->Update_Player->research);
                       // Стоимость постройки
                       $wood = $this->CI->Update_Player->towns[$i]->wood - $cost['wood'];
                       $wine = $this->CI->Update_Player->towns[$i]->wine - $cost['wine'];
                       $marble = $this->CI->Update_Player->towns[$i]->marble - $cost['marble'];
                       $crystal = $this->CI->Update_Player->towns[$i]->crystal - $cost['crystal'];
                       $sulfur = $this->CI->Update_Player->towns[$i]->sulfur - $cost['sulfur'];
                       // Если время строить
                       if (($this->CI->Update_Player->towns[$i]->build_start + $cost['time']) <= time())
                       {
                           if (($step == 0) or ($step > 0 and $wood >= 0 and $marble >= 0 and $wine >= 0 and $crystal >= 0 and $sulfur >= 0))
                           {
                                // Если не первое здание в очереди
                                if ($step > 0)
                                {
                                    $this->CI->Update_Player->towns[$i]->wood = $wood;
                                    $this->CI->Update_Player->towns[$i]->wine = $wine;
                                    $this->CI->Update_Player->towns[$i]->marble = $marble;
                                    $this->CI->Update_Player->towns[$i]->crystal = $crystal;
                                    $this->CI->Update_Player->towns[$i]->sulfur = $sulfur;
                                }
                                    // Увеличиваем уровень
                                    $this->CI->Update_Player->towns[$i]->$level_text = $this->CI->Update_Player->towns[$i]->$level_text + 1;
                                    $this->CI->Update_Player->towns[$i]->$type_text = $buildings[0]['type'];
                                    // пишем в БД
                                    $this->db->set($level_text, $this->CI->Update_Player->towns[$i]->$level_text);
                                    $this->db->set($type_text, $this->CI->Update_Player->towns[$i]->$type_text);
                                    // Отправляем сообщение
                                    $message = ($this->CI->Update_Player->towns[$i]->$level_text == 1) ? 'Строительство "<a href="'.$this->config->item('base_url').'game/city/'.$i.'/'.$this->Data_Model->building_class_by_type($buildings[0]['type']).'/'.$buildings[0]['position'].'/">'.$this->Data_Model->building_name_by_type($buildings[0]['type']).'</a>" завершено!' : 'Уровень здания "<a href="'.$this->config->item('base_url').'game/city/'.$i.'/'.$this->Data_Model->building_class_by_type($buildings[0]['type']).'/'.$buildings[0]['position'].'/">'.$this->Data_Model->building_name_by_type($buildings[0]['type']).'</a>" увеличен до '.$this->CI->Update_Player->towns[$i]->$level_text.'!';
                                    //$message = ($this->CI->Update_Player->towns[$i]->$level_text == 1) ? 'Строительство "'.$this->Data_Model->building_name_by_type($buildings[0]['type']).'" завершено!' : 'Уровень здания "'.$this->Data_Model->building_name_by_type($buildings[0]['type']).'" увеличен до '.$this->CI->Update_Player->towns[$i]->$level_text.'!';
                                    $town_message = array(
                                        'user' => $this->CI->Update_Player->user->id,
                                        'town' => $i,
                                        'date' => $this->CI->Update_Player->towns[$i]->build_start + $cost['time'],
                                        'text' => $message
                                    );
                                    $towns_messages[] = $town_message;
                                    // Если есть очередь
                                    if (SizeOf($buildings) > 1)
                                    {
                                        // уменьшаем настоящую очередь
                                        
                                        if ($buildings[0]['position'] < 10)
                                        {
                                            $this->CI->Update_Player->towns[$i]->build_line = ($buildings[0]['type'] < 10) ? substr($this->CI->Update_Player->towns[$i]->build_line, 4) : substr($this->CI->Update_Player->towns[$i]->build_line, 5);
                                        }
                                        else
                                        {
                                            $this->CI->Update_Player->towns[$i]->build_line = ($buildings[0]['type'] < 10) ? substr($this->CI->Update_Player->towns[$i]->build_line, 5) : substr($this->CI->Update_Player->towns[$i]->build_line, 6);
                                        }
                                        $this->CI->Update_Player->towns[$i]->build_start = $this->CI->Update_Player->towns[$i]->build_start + $cost['time'];
                                        // и псевдо очередь
                                        if ($buildings[0]['position'] < 10)
                                        {
                                            $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 4) : substr($while_line, 5);
                                        }
                                        else
                                        {
                                            $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 5) : substr($while_line, 6);
                                        }
                                        $buildings = $this->Data_Model->load_build_line($this->CI->Update_Player->towns[$i]->build_line);
                                    }
                                    else
                                    {
                                        // Обнуляем очередь
                                        $this->CI->Update_Player->towns[$i]->build_line = '';
                                        $this->CI->Update_Player->towns[$i]->build_start = 0;
                                        $buildings = array();
                                        break;
                                    }
                           }
                           else
                           {
                               // Если ресурсов не хватает уменьшаем настоящую и псевдо очереди
                               if ($buildings[0]['position'] < 10)
                               {
                                   $this->CI->Update_Player->towns[$i]->build_line = ($buildings[0]['type'] < 10) ? substr($this->CI->Update_Player->towns[$i]->build_line, 4) : substr($this->CI->Update_Player->towns[$i]->build_line, 5);
                                   $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 4) : substr($while_line, 5);
                               }
                               else
                               {
                                   $this->CI->Update_Player->towns[$i]->build_line = ($buildings[0]['type'] < 10) ? substr($this->CI->Update_Player->towns[$i]->build_line, 5) : substr($this->CI->Update_Player->towns[$i]->build_line, 6);
                                   $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 5) : substr($while_line, 6);
                               }
                           }
                       }
                       else
                       {
                           // Если еще не время строить уменьшаем псевдо очередь построек
                           if ($buildings[0]['position'] < 10)
                           {
                               $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 4) : substr($while_line, 5);
                           }
                           else
                           {
                               $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 5) : substr($while_line, 6);
                           }
                           $buildings = $this->Data_Model->load_build_line($while_line);
                           break;
                       }
                       // Снова загружаем псевдо постройки
                       $buildings = $this->Data_Model->load_build_line($while_line);
                       // Счетчик цикла
                       $step = $step + 1;
                       
                   }
                        // Проверка данных, чтобы не писать в БД лишнего
                        if (strlen($this->CI->Update_Player->towns[$i]->build_line) < 3){ $this->CI->Update_Player->towns[$i]->build_line = ''; }
                        if ($this->CI->Update_Player->towns[$i]->build_line == ''){ $this->CI->Update_Player->towns[$i]->build_start = 0; }
                        // Пишем в БД очередь
                        $this->db->set('build_line', $this->CI->Update_Player->towns[$i]->build_line);
                        $this->db->set('build_start', $this->CI->Update_Player->towns[$i]->build_start);
               }
               // Обновляем в БД ресурсы города
               $this->db->set('peoples', $this->CI->Update_Player->towns[$i]->peoples);
               $this->db->set('wood', $this->CI->Update_Player->towns[$i]->wood);
               $this->db->set('wine', $this->CI->Update_Player->towns[$i]->wine);
               $this->db->set('marble', $this->CI->Update_Player->towns[$i]->marble);
               $this->db->set('crystal', $this->CI->Update_Player->towns[$i]->crystal);
               $this->db->set('sulfur', $this->CI->Update_Player->towns[$i]->sulfur);
               // Вино в таверне
               $this->db->set('tavern_wine', $this->CI->Update_Player->towns[$i]->tavern_wine);

               $this->db->where(array('id' => $i));
               $this->db->update($this->session->userdata('universe').'_towns');

               // Строим армию в городах
               for ($army_type = 0; $army_type < 2; $army_type++)
               {
                   $army_type_line = ($army_type == 0) ? 'army_line' : 'ships_line';
                   $army_type_start = ($army_type == 0) ? 'army_start' : 'ships_start';

                   if ($this->CI->Update_Player->armys[$i]->$army_type_line != '')
                   {
                       // Загружаем очередь армии
                       $army_line = $this->CI->Update_Player->armys[$i]->$army_type_line;
                       $army = $this->Data_Model->load_army_line($this->CI->Update_Player->armys[$i]->$army_type_line);
                       $army_start = $this->CI->Update_Player->armys[$i]->$army_type_start;

                       while (SizeOf($army) > 0)
                       {
                           
                           // Переменные
                           $cost = $this->Data_Model->army_cost_by_type($army[0]['type'], $this->CI->Update_Player->research);
                           $ELAPSED_ARMY = time() - $army_start;
                           $count = floor($ELAPSED_ARMY/$cost['time']);
                           $class = $this->Data_Model->army_class_by_type($army[0]['type']);
                           // Если построен хотя бы один
                           if ($count >= $army[0]['count'])
                           {
                               // Если построены все
                               $this->CI->Update_Player->armys[$i]->$class = $this->CI->Update_Player->armys[$i]->$class + $army[0]['count'];
                               if($army[0]['count'] < 10)
                               {
                                   $army_line = ($army[0]['type'] < 10) ? substr($army_line, 4) : substr($army_line, 5);
                               }
                               else
                               {
                                   $army_line = ($army[0]['type'] < 10) ? substr($army_line, 5) : substr($army_line, 6);
                               }
                               $army = $this->Data_Model->load_army_line($army_line);
                               $army_start = $army_start + ($army[0]['count']*$cost['time']);
                           }
                           else
                           {
                               // Если построена часть
                               $this->CI->Update_Player->armys[$i]->$class = $this->CI->Update_Player->armys[$i]->$class + $count;
                               $army[0]['count'] = $army[0]['count'] - $count;
                               if($army[0]['count'] < 10)
                               {
                                   $army_line = ($army[0]['type'] < 10) ? substr($army_line, 4) : substr($army_line, 5);
                               }
                               else
                               {
                                   $army_line = ($army[0]['type'] < 10) ? substr($army_line, 5) : substr($army_line, 6);
                               }
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
                                $this->db->set($class, $this->CI->Update_Player->armys[$i]->$class);
                            }
                            // Обновляем армию в базу
                            for ($a = 16; $a <= 22; $a++)
                            {
                                $class = $this->Data_Model->army_class_by_type($a);
                                $this->db->set($class, $this->CI->Update_Player->armys[$i]->$class);
                            }
                            // Обновляем очередь армии
                            $this->CI->Update_Player->armys[$i]->$army_type_line = $army_line;
                            $this->CI->Update_Player->armys[$i]->$army_type_start = $army_start;
                            $this->db->set($army_type_line, $army_line);
                            $this->db->set($army_type_start, $army_start);

                            $this->db->where(array('city' => $i));
                            $this->db->update($this->session->userdata('universe').'_army');
                   }
               }
               // Вычисляем золото за армию
               $ARMY_GOLD = 0;
               for ($a = 1; $a <= 22; $a ++)
               {
                   $class = $this->Data_Model->army_class_by_type($a);
                   $cost = $this->Data_Model->army_cost_by_type($a, $this->CI->Update_Player->research);
                   $ARMY_GOLD = $ARMY_GOLD + ((($cost['gold'] * $this->CI->Update_Player->armys[$i]->$class)/3600)*$elapsed);
               }
               $this->CI->Update_Player->user->gold = $this->CI->Update_Player->user->gold - $ARMY_GOLD;
           }
           // Пробегаемся по островам
           foreach ($this->CI->Update_Player->islands as $island)
           {
               for ($is = 0; $is <= 1; $is++)
               {
                   $res_level = ($is == 0) ? 'wood_level' : 'trade_level';
                   $res_count = ($is == 0) ? 'wood_count' : 'trade_count';
                   $res_start = ($is == 0) ? 'wood_start' : 'trade_start';
                   // Цены для улучшения леса
                   $cost = $this->Data_Model->island_cost($is,$island->$res_level);
                   $need_wood = $cost['wood'] - $island->$res_count;
                   $need_wood = ($need_wood < 0) ? 0 : $need_wood;
                   if ($island->$res_start > 0)
                   {
                       $elapsed_wood = time() - $island->$res_start;
                       if ($elapsed_wood >= $cost['time'])
                       {
                           $this->CI->Update_Player->islands[$island->id]->$res_level = $island->$res_level + 1;
                           $this->CI->Update_Player->islands[$island->id]->$res_start = 0;
                           $this->db->set($res_level, $this->CI->Update_Player->islands[$island->id]->$res_level);
                           $this->db->set($res_start, 0);
                           $this->db->where(array('id' => $this->CI->Update_Player->islands[$island->id]->id));
                           $this->db->update($this->session->userdata('universe').'_islands');
                       }
                   }else{
                       // Если дерева достаточно
                       if ($need_wood == 0)
                       {
                           $this->CI->Update_Player->islands[$island->id]->$res_start = time();
                           $this->CI->Update_Player->islands[$island->id]->$res_count = $island->$res_count - $cost['wood'];
                           $this->db->set($res_start, $this->CI->Update_Player->islands[$island->id]->$res_start);
                           $this->db->set($res_count, $this->CI->Update_Player->islands[$island->id]->$res_count);
                           $this->db->where(array('id' => $this->CI->Update_Player->islands[$island->id]->id));
                           $this->db->update($this->session->userdata('universe').'_islands');
                       }
                   }
               }
           }

           foreach($this->CI->Update_Player->missions as $mission)
           {
               // Проверяем загрузку

               if ($mission->mission_start == 0)
               {
                    $all_resources = $mission->wood + $mission->marble + $mission->wine + $mission->crystal + $mission->sulfur;
                    $speed = $this->Data_Model->speed_by_port_level($this->CI->Update_Player->port_level[$mission->from]);
                    $per_sec = $speed / 60;
                    $all_time = $all_resources/$per_sec;
                    $elapsed_mission = time() - $mission->loading_start - $all_time;
                    // Если загрузили
                    if ($elapsed_mission >= 0)
                    {
                        $this->CI->Update_Player->missions[$mission->id]->mission_start = $mission->loading_start + $all_time;
                        $this->db->set('mission_start', $mission->loading_start + $all_time);
                        $this->db->where(array('id' => $mission->id));
                        $this->db->update($this->session->userdata('universe').'_missions');
                    }
               }
               if ($mission->mission_start > 0)
               {
                   include('mission_data.php');
                   if($ostalos == 0 or $return_time == 0)
                   {
                       // Приплыли
                       if ($mission->return_start == 0)
                       {
                           if($mission->mission_type == 1)
                           {
                               // Колонизация
                               $this->CI->Data_Model->temp_towns_db[$mission->to]->pos0_level = 1;
                               $this->db->set('pos0_level', 1);
                               $this->db->set('wood', $mission->wood-1000);
                               $this->db->set('wine', $mission->wine);
                               $this->db->set('marble', $mission->marble);
                               $this->db->set('crystal', $mission->crystal);
                               $this->db->set('sulfur', $mission->sulfur);
                               $this->db->set('last_update', $mission->mission_start + $time);
                               $this->db->where(array('id' => $mission->to));
                               $this->db->update($this->session->userdata('universe').'_towns');
                               // Добавляем армию
                               $this->db->insert($_POST['universe'].'_army', array('city' => $mission->to));
                               // возвращаем сухогрузы
                               $this->CI->Update_Player->user->transports =  $this->CI->Update_Player->user->transports + $mission->ship_transport;
                               $this->db->query('DELETE FROM '.$this->session->userdata('universe').'_missions where `id`="'.$mission->id.'"');
                               // Сообщение
                               $text = 'Мы основали новый город (<a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->to]->island.'/'.$mission->to.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->to]->name.'</a>). Ваш торговый флот выгрузил: <ul class="resources">';
                               $text .= '<li class="wood"><span class="textLabel">Стройматериалы: </span>'.($mission->wood-1000).'</li>';
                               if ($mission->wine > 0){$text .= '<li class="wine"><span class="textLabel">Виноград: </span>'.($mission->wine).'</li>';}
                               if ($mission->marble > 0){$text .= '<li class="marble"><span class="textLabel">Мрамор: </span>'.($mission->marble).'</li>';}
                               if ($mission->crystal > 0){$text .= '<li class="glass"><span class="textLabel">Хрусталь: </span>'.($mission->crystal).'</li>';}
                               if ($mission->sulfur > 0){$text .= '<li class="sulfur"><span class="textLabel">Сера: </span>'.($mission->sulfur).'</li>';}
                               $text .= '</ul>';
                               $town_message = array(
                                            'user' => $this->CI->Update_Player->user->id,
                                            'town' => $mission->from,
                                            'date' => $mission->mission_start + $time,
                                            'text' => $text
                                        );
                               $towns_messages[] = $town_message;
                               unset($this->CI->Update_Player->missions[$mission->id]);
                           }
                           if ($mission->mission_type == 2)
                           {
                               // Транспортировка
                               $this->db->set('wood', $this->CI->Data_Model->temp_towns_db[$mission->to]->wood + $mission->wood);
                               $this->db->set('wine', $this->CI->Data_Model->temp_towns_db[$mission->to]->wine + $mission->wine);
                               $this->db->set('marble', $this->CI->Data_Model->temp_towns_db[$mission->to]->marble + $mission->marble);
                               $this->db->set('crystal', $this->CI->Data_Model->temp_towns_db[$mission->to]->crystal + $mission->crystal);
                               $this->db->set('sulfur', $this->CI->Data_Model->temp_towns_db[$mission->to]->sulfur + $mission->sulfur);
                               $this->db->set('last_update', $mission->mission_start + $time);
                               $this->db->where(array('id' => $mission->to));
                               $this->db->update($this->session->userdata('universe').'_towns');
                               // Сообщение
                               $text = 'Ваш торговый флот из <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->from]->island.'/'.$mission->from.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->from]->name.'</a> прибыл в <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->to]->island.'/'.$mission->to.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->to]->name.'</a> и привез следующие товары: <ul class="resources">';
                               if ($mission->wood > 0){ $text .= '<li class="wood"><span class="textLabel">Стройматериалы: </span>'.($mission->wood).'</li>';}
                               if ($mission->wine > 0){$text .= '<li class="wine"><span class="textLabel">Виноград: </span>'.($mission->wine).'</li>';}
                               if ($mission->marble > 0){$text .= '<li class="marble"><span class="textLabel">Мрамор: </span>'.($mission->marble).'</li>';}
                               if ($mission->crystal > 0){$text .= '<li class="glass"><span class="textLabel">Хрусталь: </span>'.($mission->crystal).'</li>';}
                               if ($mission->sulfur > 0){$text .= '<li class="sulfur"><span class="textLabel">Сера: </span>'.($mission->sulfur).'</li>';}
                               $text .= '</ul>';
                               $town_message = array(
                                            'user' => $this->CI->Update_Player->user->id,
                                            'town' => $mission->from,
                                            'date' => $mission->mission_start + $time,
                                            'text' => $text
                                        );
                               $towns_messages[] = $town_message;
                               
                               if ($this->CI->Data_Model->temp_towns_db[$mission->to]->user == $mission->user)
                               {
                                   // возвращаем сухогрузы
                                   $this->CI->Update_Player->user->transports =  $this->CI->Update_Player->user->transports + $mission->ship_transport;
                                   $this->db->query('DELETE FROM '.$this->session->userdata('universe').'_missions where `id`="'.$mission->id.'"');
                               }
                               else
                               {
                                   if($mission->return_start == 0)
                                   {
                                        $this->db->set('return_start', $mission->mission_start + $time);
                                        $this->db->set('percent', 1);
                                        $this->db->set('wood', 0);
                                        $this->db->set('wine', 0);
                                        $this->db->set('marble', 0);
                                        $this->db->set('crystal', 0);
                                        $this->db->set('sulfur', 0);
                                        $this->db->where(array('id' => $mission->id));
                                        $this->db->update($this->session->userdata('universe').'_missions');
                                   }
                               }
                               unset($this->CI->Update_Player->missions[$mission->id]);
                           }
                       }
                       else
                       {
                           if ($this->CI->Data_Model->temp_towns_db[$mission->to]->user == $mission->user or $return_time == 0)
                           {
                               if ($mission->mission_type == 1)
                               {
                                    $this->db->set('city'.$this->CI->Data_Model->temp_towns_db[$mission->to]->position, 0);
                                    $this->db->where(array('id' => $this->CI->Data_Model->temp_towns_db[$mission->to]->island));
                                    $this->db->update($this->session->userdata('universe').'_islands');
                                    $this->db->query('DELETE FROM '.$this->session->userdata('universe').'_towns where `id`="'.$mission->to.'"');
                               }
                               if ($mission->wood > 0 or $mission->wine > 0 or $mission->marble > 0 or $mission->crystal > 0 or $mission->sulfur > 0 or $mission->peoples > 0)
                               {
                                   // Возвращаем флот
                                   $this->CI->Update_Player->towns[$mission->from]->wood = $this->CI->Update_Player->towns[$mission->from]->wood +  $mission->wood;
                                   $this->CI->Update_Player->towns[$mission->from]->wine = $this->CI->Update_Player->towns[$mission->from]->wine +  $mission->wine;
                                   $this->CI->Update_Player->towns[$mission->from]->marble = $this->CI->Update_Player->towns[$mission->from]->marble +  $mission->marble;
                                   $this->CI->Update_Player->towns[$mission->from]->crystal = $this->CI->Update_Player->towns[$mission->from]->crystal +  $mission->crystal;
                                   $this->CI->Update_Player->towns[$mission->from]->sulfur = $this->CI->Update_Player->towns[$mission->from]->sulfur +  $mission->sulfur;
                                   $this->CI->Update_Player->towns[$mission->from]->peoples = $this->CI->Update_Player->towns[$mission->from]->peoples +  $mission->peoples;
                                   $this->db->set('wood', $this->CI->Update_Player->towns[$mission->from]->wood);
                                   $this->db->set('wine', $this->CI->Update_Player->towns[$mission->from]->wine);
                                   $this->db->set('marble', $this->CI->Update_Player->towns[$mission->from]->marble);
                                   $this->db->set('crystal', $this->CI->Update_Player->towns[$mission->from]->crystal);
                                   $this->db->set('sulfur', $this->CI->Update_Player->towns[$mission->from]->sulfur);
                                   $this->CI->Update_Player->user->gold = $this->CI->Update_Player->user->gold + $mission->gold;
                                   $this->db->set('peoples', $this->CI->Update_Player->towns[$mission->from]->peoples);
                                   $this->db->where(array('id' => $mission->from));
                                   $this->db->update($this->session->userdata('universe').'_towns');
                                   // Отправляем сообщение
                                   $text = 'Ваш торговый флот из <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->from]->island.'/'.$mission->from.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->from]->name.'</a> вернулся и выгрузил следующие товары: <ul class="resources">';
                                   if ($mission->wood > 0){ $text .= '<li class="wood"><span class="textLabel">Стройматериалы: </span>'.($mission->wood).'</li>';}
                                   if ($mission->wine > 0){$text .= '<li class="wine"><span class="textLabel">Виноград: </span>'.($mission->wine).'</li>';}
                                   if ($mission->marble > 0){$text .= '<li class="marble"><span class="textLabel">Мрамор: </span>'.($mission->marble).'</li>';}
                                   if ($mission->crystal > 0){$text .= '<li class="glass"><span class="textLabel">Хрусталь: </span>'.($mission->crystal).'</li>';}
                                   if ($mission->sulfur > 0){$text .= '<li class="sulfur"><span class="textLabel">Сера: </span>'.($mission->sulfur).'</li>';}
                                   $text .= '</ul>';
                                   $town_message = array(
                                    'user' => $this->CI->Update_Player->user->id,
                                    'town' => $mission->from,
                                    'date' => $mission->mission_start + $time,
                                    'text' => $text
                                   );
                                   $towns_messages[] = $town_message;
                               }
                               // возвращаем сухогрузы
                               $this->CI->Update_Player->user->transports =  $this->CI->Update_Player->user->transports + $mission->ship_transport;
                               $this->db->query('DELETE FROM '.$this->session->userdata('universe').'_missions where `id`="'.$mission->id.'"');

                               unset($this->CI->Update_Player->missions[$mission->id]);
                           }
                       }
                   }
               }
           }
           // Последнее посещение
           $this->db->set('last_visit', time());
           // Если текущий игрок обновляем город
           if ($this->CI->Update_Player->user->id == $this->session->userdata('id'))
           {
               $this->db->set('town', $this->CI->Update_Player->town_id);
           }
           // Обновляем золото
           if ($this->CI->Update_Player->user->gold < 0) { $this->CI->Update_Player->user->gold = 0; }
           $this->db->set('gold', $this->CI->Update_Player->user->gold);
           // Обновляем сухогрузы
           $this->db->set('transports', $this->CI->Update_Player->user->transports);
           // Обновляем премиумы
           if ($this->CI->Update_Player->user->premium_account < time()){ $this->CI->Update_Player->user->premium_account = 0; }
           if ($this->CI->Update_Player->user->premium_wood < time()){ $this->CI->Update_Player->user->premium_wood = 0; }
           if ($this->CI->Update_Player->user->premium_wine < time()){ $this->CI->Update_Player->user->premium_wine = 0; }
           if ($this->CI->Update_Player->user->premium_marble < time()){ $this->CI->Update_Player->user->premium_marble = 0; }
           if ($this->CI->Update_Player->user->premium_crystal < time()){ $this->CI->Update_Player->user->premium_crystal = 0; }
           if ($this->CI->Update_Player->user->premium_sulfur < time()){ $this->CI->Update_Player->user->premium_sulfur = 0; }
           if ($this->CI->Update_Player->user->premium_capacity < time()){ $this->CI->Update_Player->user->premium_capacity = 0; }
           $this->db->set('premium_account', $this->CI->Update_Player->user->premium_account);
           $this->db->set('premium_wood', $this->CI->Update_Player->user->premium_wood);
           $this->db->set('premium_wine', $this->CI->Update_Player->user->premium_wine);
           $this->db->set('premium_marble', $this->CI->Update_Player->user->premium_marble);
           $this->db->set('premium_crystal', $this->CI->Update_Player->user->premium_crystal);
           $this->db->set('premium_sulfur', $this->CI->Update_Player->user->premium_sulfur);
           $this->db->set('premium_capacity', $this->CI->Update_Player->user->premium_capacity);
           //  Обучение
           $this->db->set('tutorial', $this->CI->Update_Player->user->tutorial);
           $this->db->where(array('id' => $id));
           $this->db->update($this->session->userdata('universe').'_users');
           // Обновляем баллы науки
           $this->db->set('points', $this->CI->Update_Player->research->points);
           $this->db->where(array('user' => $id));
           $this->db->update($this->session->userdata('universe').'_research');
           // Отправляем сообщения
           if (SizeOf($towns_messages) > 0)
               foreach($towns_messages as $message_data)
               {
                    $this->db->insert($this->session->userdata('universe').'_town_messages', $message_data);
               }
           $this->CI->Update_Player->now_town = $this->CI->Update_Player->towns[$this->CI->Update_Player->town_id];
           $this->CI->Update_Player->now_island = $this->CI->Update_Player->islands[$this->CI->Update_Player->island_id];
       }
    }

}

/* End of file update_model.php */
/* Location: ./system/application/models/update_model.php */