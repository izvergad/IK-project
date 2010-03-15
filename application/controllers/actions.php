<?php
/**
 * Контроллер действий
 */
class Actions extends Controller
{

    function Actions()
    {
        parent::Controller();
        $this->load->model('User_Model');
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
    function tutorials($action, $id = 0)
    {
        $id = intval($id);
        switch($action)
        {
            // следующий этап обучения
            case 'next':
                $this->User_Model->tutorial = $this->User_Model->tutorial + 1;
                $this->db->query('UPDATE `'.$this->session->userdata('universe').'_users'.'` SET `tutorial`=`tutorial`+1 WHERE `id`="'.$this->session->userdata('id').'"');
            break;
            case 'set':
                $this->User_Model->tutorial = $id;
                $this->db->query('UPDATE `'.$this->session->userdata('universe').'_users'.'` SET `tutorial`='.$id.' WHERE `id`="'.$this->session->userdata('id').'"');
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
        $id = intval($id);
        $position = intval($position);
        $redirect = strip_tags($redirect);
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
                // Обновляем обучения если есть
                        if ($id == 3 and $this->User_Model->tutorial <= 4)
                        {
                            // Построили академию
                            $this->tutorials('set', 5);
                        }
                        if ($id == 5 and $this->User_Model->tutorial <= 9)
                        {
                            // Построили казарму
                            $this->tutorials('set', 10);
                        }
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
        if ($type == 'resource' and $this->User_Model->tutorial <= 2)
        {
            $this->tutorials('set', 3);
        }    
        if ($type == 'academy' and $this->User_Model->tutorial <= 7)
        {
            $this->tutorials('set', 8);
        }
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);

        if (isset($_POST['rw']))
        {
            $level = $this->Town_Model->island->wood_level;
            $cost = $this->Data_Model->island_cost(0, $level);
            if ($cost['workers'] >= $_POST['rw'])
            {
                $all = $this->Town_Model->peoples['workers'] + $this->Town_Model->peoples['free'];
                if ($all >= $_POST['rw'])
                {
                    $this->Town_Model->peoples['workers'] = intval($_POST['rw']);
                    $this->Town_Model->peoples['free'] = $all - intval($_POST['rw']);
                    $this->db->set('workers', $this->Town_Model->peoples['workers']);
                    $this->db->set('peoples', $this->Town_Model->peoples['free']);
                    $this->db->where(array('id' => $this->Town_Model->id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                }
            }
        }

        if (isset($_POST['s']) and $id > 0 and $this->Town_Model->already_build[3])
        {
            $max_scientists = $this->Data_Model->scientists_by_level($this->Town_Model->buildings[$id]['level']);
            if ($max_scientists >= $_POST['s'])
            {
                $all = $this->Town_Model->peoples['research'] + $this->Town_Model->peoples['free'];
                if ($all >= $_POST['s'] )
                {
                    $this->Town_Model->peoples['research'] = intval($_POST['s']);
                    $this->Town_Model->peoples['free'] = $all - intval($_POST['s']);
                    $this->db->set('scientists', $this->Town_Model->peoples['research']);
                    $this->db->set('peoples', $this->Town_Model->peoples['free']);
                    $this->db->where(array('id' => $this->Town_Model->id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                }
            }
        }
        
        redirect($this->config->item('base_url').'game/'.$type.'/', 'refresh');
    }

    function resources($id = 0)
    {
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        
        $count = isset($_POST['donation']) ? intval($_POST['donation']) : 0;
        if($this->Town_Model->resources['wood'] >= $count and $count > 0 and $this->Town_Model->island->id == $id)
        {
            $this->Town_Model->workers_wood = $this->Town_Model->workers_wood + $count;
            $this->Town_Model->resources['wood'] = $this->Town_Model->resources['wood'] - $count;
            //$this->Island_Model->island->wood_count = $this->Island_Model->island->wood_count + $count;
            // Обновляем город
            $this->db->set('workers_wood', $this->Town_Model->workers_wood);
            $this->db->set('wood', $this->Town_Model->resources['wood']);
            $this->db->where(array('id' => $this->Town_Model->id));
            $this->db->update($this->session->userdata('universe').'_towns');
            // Обновляем остров
            $this->db->query('UPDATE `'.$this->session->userdata('universe').'_islands'.'` SET `wood_count`=`wood_count`+'.$count.' WHERE `id`="'.$id.'"');
        }
        redirect($this->config->item('base_url').'game/resource/'.$id.'/', 'refresh');
    }

    function doResearch($way = 0, $id = 0)
    {
        $way = intval($way);
        $id = intval($id);
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        if($way > 0 and $way <= 4)
        {
            $parametr = 'res'.$way.'_'.$id;
            $data = $this->Data_Model->get_research($way,$id,$this->User_Model->research);
            if ($this->User_Model->research->points >= $data['points'])
            {
                $this->User_Model->research->points = $this->User_Model->research->points - $data['points'];
                $this->User_Model->research->$parametr = $this->User_Model->research->$parametr + 1;
                $this->db->set('points', $this->User_Model->research->points);
                $this->db->set($parametr, $this->User_Model->research->$parametr);
                $this->db->where(array('user' => $this->User_Model->id));
                $this->db->update($this->session->userdata('universe').'_research');
                // Благосостояние
                if($way == 2 and $id == 3)
                {
                    $this->Town_Model->resources['wood'] = $this->Town_Model->resources['wood'] + 130;
                    $this->Town_Model->resources['marble'] = $this->Town_Model->resources['marble'] + 130;
                    $this->Town_Model->resources['wine'] = $this->Town_Model->resources['wine'] + 130;
                    $this->Town_Model->resources['crystal'] = $this->Town_Model->resources['crystal'] + 130;
                    $this->Town_Model->resources['sulfur'] = $this->Town_Model->resources['sulfur'] + 130;
                    $this->db->set('wood', $this->Town_Model->resources['wood']);
                    $this->db->set('marble', $this->Town_Model->resources['marble']);
                    $this->db->set('wine', $this->Town_Model->resources['wine']);
                    $this->db->set('crystal', $this->Town_Model->resources['crystal']);
                    $this->db->set('sulfur', $this->Town_Model->resources['sulfur']);
                    $this->db->where(array('id' => $this->Town_Model->id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                }
            }
        }
        redirect($this->config->item('base_url').'game/researchAdvisor/', 'refresh');
    }

    function getJSONIsland($x = 0, $y = 0)
    {
        //echo '{"request":{"x":'.$x.',"y":'.$y.'},"data":[]}';
        echo '{"request":{"x":1,"y":2},"data":[{"name":"\u0431\u0443\u0431\u0443","avatar_id":"76025","avatar_name":"BOB"},{"name":"\u041d\u043e\u0432\u0430\u044f-\u041a\u0430\u0434\u0430","avatar_id":"19807","avatar_name":"\u041c\u0430\u0442\u0440\u0438\u0446\u0430"},{"name":"\u30c4\u0412\u0438\u043b\u043b\u0430\u0431\u0430\u0434\u0436\u043e","avatar_id":"28324","avatar_name":"\u0411\u0435\u0448\u0435\u043d\u0430\u044f \u0448\u0443\u0431\u0430"},{"name":"\u30c4\u043a\u043e\u043b\u0445\u043e\u0437 \u0417\u0430\u0440\u044f","avatar_id":"13438","avatar_name":"\u041d\u0435\u0437\u043d\u0430\u044e"},{"name":"\u30c4 Stella","avatar_id":"59637","avatar_name":"\u0421\u0435\u0432\u0435\u0440\u043d\u0430\u044f"},{"name":"Magic Sity","avatar_id":"55848","avatar_name":"Jokercity"},{"name":"\u041f\u043e\u043b\u0438\u0441","avatar_id":"95020","avatar_name":"DimXmiD"},{"name":"\u041f\u043e\u043b\u0438\u0441","avatar_id":"89128","avatar_name":"RedFox"},{"name":"\u041f\u043e\u043b\u0438\u0441","avatar_id":"91385","avatar_name":"nexus2009"},{"name":"\u041f\u043e\u043b\u0438\u0441","avatar_id":"94323","avatar_name":"kdr174"}]}';
    }

    function getJSONArea($xmin = 0, $xmax = 0, $ymin = 0, $ymax = 0)
    {
        //echo '{"request":{"x_min":'.$xmin.',"x_max":'.$xmax.',"y_min":'.$ymin.',"y_max":'.$ymax.'},"data":[]}';
        //echo '{"request":{"x_min":-13,"x_max":15,"y_min":-13,"y_max":15},"data":{"1":{"13":["5228","Torautia","2","6","451","5","9","1"],"14":["5224","Lolios","1","5","451","4","8","1"],"15":["5221","Bratuios","3","7","451","1","5","0"]},"2":{"2":["5488","Rezios","1","3","474","6","18","10"],"3":["5486","Eritia","2","5","474","4","20","11"],"4":["5484","Luirios","1","3","474","1","24","11"],"5":["5482","Thromoos","3","5","474","6","23","6"],"6":["5480","Hatios","1","5","474","7","15","2"],"10":["5232","Peretia","2","8","452","10","4","0"],"11":["5230","Onitia","1","5","452","4","1","0"],"13":["5227","Ackytia","3","4","451","6","2","0"],"14":["5223","Craeliios","4","1","451","6","5","0"],"15":["5222","Schakios","2","7","451","1","11","5"]},"3":{"2":["5487","Ackeos","4","1","474","9","20","10"],"3":["5485","Loruos","3","7","474","10","16","10"],"4":["5483","Vesauos","4","8","474","3","21","6"],"5":["5481","Smotios","2","2","474","5","22","12"],"6":["5479","Claekaios","4","6","474","2","4","0"],"8":["5236","Perotia","2","6","452","5","14","1"],"9":["5235","Hockoos","1","3","452","7","1","0"],"10":["5231","Orios","3","6","452","6","7","0"],"11":["5229","Shilaos","4","7","452","2","5","0"],"13":["5226","Roilios","2","8","451","4","1","0"],"14":["5225","Tomoos","1","6","451","8","17","1"]},"4":{"2":["5489","Whubios","1","7","474","10","3","1"],"3":["5490","Noghios","2","6","474","10","16","2"],"8":["5237","Thraboos","3","6","452","1","1","0"],"9":["5234","Treetios","4","5","452","1","1","0"],"10":["5233","Banutia","2","6","452","10","11","0"]},"5":{"5":["5464","Strurios","1","3","472","5","14","0"],"6":["5462","Reypios","3","6","472","6","13","0"],"8":["5239","Uskaos","2","6","452","8","1","1"],"9":["5238","Sairdeios","1","8","452","1","7","1"],"12":["5216","Voroetia","2","6","450","5","19","6"],"13":["5205","Rothitia","3","6","450","10","21","4"],"14":["5204","Ometia","2","5","450","2","9","1"]},"6":{"3":["5467","Threucios","4","8","472","10","1","0"],"4":["5465","Ougheytia","2","5","472","3","1","0"],"5":["5463","Broseios","4","1","472","1","14","0"],"6":["5461","Stidaios","2","6","472","8","21","10"],"8":["5241","Leuthuos","3","8","452","4","11","0"],"9":["5240","Smysios","4","8","452","10","11","0"],"11":["5207","Essoos","1","7","450","2","24","9"],"12":["5206","Tineaos","4","1","450","2","25","11"],"13":["5203","Sackuios","1","3","450","1","22","11"],"14":["5202","Hausios","4","5","450","5","17","2"]},"7":{"3":["5468","Moreos","1","3","472","10","1","0"],"4":["5466","Delutia","3","5","472","3","2","1"],"11":["5209","Droijios","3","6","450","2","21","6"],"12":["5208","Tonietia","2","2","450","1","23","15"]},"8":{"3":["5469","Atoios","2","7","472","7","7","2"],"4":["5470","Kivios","4","8","472","3","7","1"],"6":["5453","Caxiios","1","3","471","3","15","2"],"7":["5452","Radetia","4","7","471","7","15","1"],"9":["5213","Raduios","3","7","450","7","1","0"],"10":["5212","Clearios","2","6","450","4","21","3"],"11":["5211","Ranios","1","3","450","8","11","1"],"12":["5210","Soltyios","4","1","450","3","6","1"],"14":["5173","Treidios","3","4","447","9","21","9"],"15":["5172","Omytia","2","6","447","4","16","1"]},"9":{"6":["5454","Ineietia","2","7","471","6","1","0"],"7":["5451","Peroitia","3","5","471","2","8","1"],"9":["5215","Demios","1","5","450","7","1","0"],"10":["5214","Choiduios","4","7","450","7","1","0"],"14":["5171","Stregios","1","7","447","4","10","2"],"15":["5170","Lobios","4","7","447","3","9","2"]},"10":{"1":["5478","Mybiios","1","5","473","4","17","10"],"2":["5472","Kulios","2","5","473","4","18","10"],"3":["5471","Rynyos","1","6","473","1","16","6"],"5":["5457","Pheusios","1","7","471","9","13","1"],"6":["5455","Dytios","3","5","471","5","3","0"],"12":["5175","Latios","1","6","447","7","1","0"],"13":["5174","Riatios","4","7","447","1","1","1"],"14":["5169","Kalootia","3","4","447","4","1","0"],"15":["5168","Dariaos","2","7","447","4","8","2"]},"11":{"1":["5477","Tebios","3","4","473","7","12","3"],"2":["5474","Kalitia","4","7","473","8","18","10"],"3":["5473","Deliaos","3","5","473","9","18","7"],"5":["5458","Sleleos","2","7","471","10","6","0"],"6":["5456","Koloos","4","7","471","5","1","0"],"8":["5253","Ageoetia","1","5","453","6","6","1"],"9":["5252","Warutia","4","8","453","2","7","2"],"11":["5180","Oughitia","2","2","447","8","21","1"],"12":["5177","Ituos","3","7","447","2","1","0"],"13":["5176","Fayleos","2","2","447","1","1","0"],"14":["5167","Smaeryos","1","7","447","2","1","0"],"15":["5166","Nyetia","4","6","447","10","1","0"]},"12":{"2":["5476","Tiaotia","2","6","473","2","18","10"],"3":["5475","Toneos","1","7","473","6","17","6"],"5":["5459","Smourios","3","6","471","6","1","1"],"6":["5460","Aleauos","1","7","471","8","1","1"],"8":["5251","Feadeios","3","7","453","4","8","2"],"9":["5250","Endootia","2","7","453","5","17","11"],"11":["5179","Mocaios","1","7","447","8","1","0"],"12":["5178","Lyeeaos","4","5","447","2","1","0"]},"13":{"8":["5249","Crahiios","1","8","453","3","16","10"],"9":["5248","Sadios","4","6","453","2","16","10"],"14":["4812","Verooos","2","5","414","10","2","0"],"15":["4813","Badaos","3","8","414","2","1","0"]},"14":{"3":["5450","Motoos","4","6","470","4","10","2"],"4":["5448","Slauxeos","2","6","470","10","15","10"],"5":["5446","Talios","4","7","470","8","13","1"],"6":["5444","Croloos","2","7","470","8","6","1"],"8":["5247","Ougheos","3","7","453","10","17","14"],"9":["5246","Rotheutia","2","2","453","10","21","16"],"11":["4804","Echuitia","3","5","413","7","14","4"],"12":["4806","Burootia","1","5","413","6","17","7"],"14":["4811","Elmeos","1","6","414","9","1","0"],"15":["4809","Neabios","4","8","414","7","8","1"]},"15":{"3":["5449","Ormios","3","7","470","9","11","2"],"4":["5447","Bexuos","1","5","470","9","16","4"],"5":["5445","Cruiseos","3","7","470","6","4","1"],"6":["5443","Keloutia","1","7","470","3","1","0"],"8":["5245","Yaireios","1","5","453","5","20","16"],"9":["5244","Toreios","4","1","453","2","18","14"],"11":["4803","Yimios","4","1","413","6","14","2"],"12":["4805","Ageotia","2","5","413","4","16","10"],"15":["4807","Pyloos","2","6","414","3","9","2"]}}}';
        $data = '{"request":{"x_min":'.$xmin.',"x_max":'.$xmax.',"y_min":'.$ymin.',"y_max":'.$ymax.'},"data":{';
        for ($i = $xmin; $i <= $xmax; $i++)
        {
            $query_x = $this->db->query('SELECT * FROM '.$this->session->userdata('universe').'_islands WHERE x='.$i.' and y>'.$ymin.' and y<'.$ymax);
                $data .= '"'.$i.'":{';
                $j = 1;
                foreach ($query_x->result() as $island)
                {
                    $towns = 0;
                    for ($p = 0; $p <= 15; $p++)
                    {
                        $parametr = 'city'.$p;
                        if ($island->$parametr > 0){ $towns = $towns + 1; }
                    }
                    $data .= '"'.$island->y.'":["'.$island->id.'","'.$island->name.'","'.$island->trade_resource.'","'.$island->wonder.'","0","'.$island->type.'","0","'.$towns.'"]';
                    $data .= ($j == $query_x->num_rows) ? '' : ',' ;
                    $j = $j + 1;
                }
                $data .= ($i == $xmax) ? '}' : '},' ;
        }
        $data .= '}}';
        echo $data;
        //echo '{"request":{"x_min":-13,"x_max":15,"y_min":-13,"y_max":15},"data":{"2":{"2":["5488","Rezios","1","3","474","6","18","10"]}}}';
    }

}

/* End of file actions.php */
/* Location: ./system/application/controllers/actions.php */