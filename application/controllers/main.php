<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();	
	}
	
	function index()
	{
            if (isset($_POST['action']))
            {
                switch($_POST['action'])
                {
                    case 'register':
                        $this->load->model('Player_Model');
                        $this->register();
                    break;
                    case 'login':
                        $this->load->model('Player_Model');
                        $this->Player_Model->User_Login();
                    break;
                    case 'sendPassword':
                        $this->send_password();
                    break;
                }
            }
            else
            {
		$this->load->view('main_index', array('page' => 'index'));
            }
	}

        function error()
        {
                $this->session->keep_flashdata('error');
                $this->load->view('main_index', array('page' => 'error'));
        }

        function xd_receiver()
        {
            $this->load->view('main/xd_receiver');
        }

        function page($page = 'index')
        {
            $errors = array();
            $this->session->set_flashdata(array('errors' => $errors));
            $this->load->view('main/'.$page);
        }

        function register()
        {
            // Переменная ошибок
            $errors = array();
            // Загружаем модули
            $this->load->library('email');
            $this->load->helper('email');
            // Тип письма text или html
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            //if (isset($_POST['universe']) and isset($_POST['name']) and $_POST['name'] != '' and isset($_POST['password']) and $_POST['password'] != '' and isset($_POST['email']) and valid_email($_POST['email']) and isset($_POST['agb']) and $_POST['agb'] and $_POST['universe'] == 'alpha')
            if (!isset($_POST['universe'])){ $errors[] = 'Не выбрана вселенная!'; }
            if (!isset($_POST['name']) or (isset($_POST['name']) and (strip_tags($_POST['name']) == '' or strlen(strip_tags($_POST['name'])) < 3 or strlen(strip_tags($_POST['name'])) > 30 ))){ $errors[] = 'Имя игрока должно содержать от 3 до 30 символов.'; }
            if (!isset($_POST['password']) or (isset($_POST['password']) and (strip_tags($_POST['password']) == '' or strlen(strip_tags($_POST['password'])) < 8 or strlen(strip_tags($_POST['password'])) > 30 ))){ $errors[] = 'Пароль должен содержать от 8 до 30 символов.'; }
            if (!isset($_POST['email']) or !valid_email($_POST['email'])){ $errors[] = 'Неверный e-mail.'; }
            if (!isset($_POST['agb']) or (isset($_POST['agb']) and !$_POST['agb'])){ $errors[] = 'Вы должны принять Основные Положения для игры в Икариам!'; }
            // Регистрируем
            if (count($errors) == 0)
            {
                $login = strip_tags($_POST['name']);
                $password = strip_tags($_POST['password']);

                $user_query = $this->db->get_where($_POST['universe'].'_users', array('login' => $login));
                // Если такого игркоа нету
                if ($user_query->num_rows == 0)
                {
                    $key = random_key(30);
                    // Добавляем данные игрока
                    $this->db->insert($_POST['universe'].'_users', array('login' => $login,'password' => md5($password),'email' => $_POST['email'], 'last_visit' => time(),'register_key' => $key));
                    // Находим игрока в базе
                    $user_query = $this->db->get_where($_POST['universe'].'_users', array('login' => $login));
                    $user = $user_query->row();
                    // Выбираем остров
                    $island_query = $this->db->query('SELECT * FROM `'.$_POST['universe'].'_islands'.'` WHERE `city0`=0 or `city2`=0 or `city4`=0 or `city6`=0 or `city8`=0 or `city10`=0 or `city12`=0 or `city14`=0 ORDER BY RAND() LIMIT 1');

                    if ($island_query->num_rows > 0)
                    {
                        $island = $island_query->row();
                        // Находим позицию
                        $position = -1;
                        for ($i = 0; $i <= 15; $i++)
                        {
                            if ($i == 0 or $i == 2 or $i == 4 or $i == 6 or $i == 8 or $i == 10 or $i == 12 or $i == 14)
                            {
                                $parametr = 'city'.$i;
                                if ($island->$parametr == 0){$position = $i;break;}
                            }
                        }
                        if ($position >= 0)
                        {
                            // Добавляем город
                            $this->db->insert($_POST['universe'].'_towns', array('user' => $user->id,'island' => $island->id,'last_update' => time(), 'position' => $position));
                            // Находим город в базе
                            $town_query = $this->db->get_where($_POST['universe'].'_towns', array('user' => $user->id));
                            $town = $town_query->row();
                            // Добавляем армию
                            $this->db->insert($_POST['universe'].'_army', array('city' => $town->id));
                            // Обновляем город в остров
                            $this->db->set('city'.$position, $town->id);
                            $this->db->where(array('id' => $island->id));
                            $this->db->update($_POST['universe'].'_islands');
                            // Добавляем исследования
                            $this->db->insert($_POST['universe'].'_research', array('user' => $user->id));
                            // Notes
                            $this->db->insert($_POST['universe'].'_notes', array('user' => $user->id));
                            // Обновляем игрока
                            $this->db->set('town', $town->id);
                            $this->db->set('capital', $town->id);
                            $this->db->where(array('id' => $user->id));
                            $this->db->update($_POST['universe'].'_users');
                            //Отправляем письмо
                            if ($this->config->item('game_email'))
                            {
                                $message = '<html><body><p>Привет '.$user->login.',<br><br>Вы решили создать империю в мире Икариам '.$_POST['universe'].'!<br><br>Нажмите на ссылку, чтобы подтвердить Ваш аккаунт:<br><br><a href="'.$this->config->item('base_url').'main/validate/'.$_POST['universe'].'/'.$key.'/" target="_blank">'.$this->config->item('base_url').'main/validate/'.$_POST['universe'].'/'.$key.'</a><br><br>Ваша информация для доступа:<br>Имя игрока: '.$user->login.'<br>Пароль: '.$password.'<br>Сервер: '.$_POST['universe'].'<br><br>Если Вам понадобится помощь, то Вы сможете найти ее на форуме Икариам ('.$this->config->item('forum_url').').<br><br>Удачи в игре,<br>Ваша команда Икариам.</p></body></html>';
                                $this->email->from($this->config->item('email_from'), 'Гермес');
                                $this->email->to($_POST['email']);
                                $this->email->subject($user->login.', Добро пожаловать в Икариам!');
                                $this->email->message($message);
                                $this->email->send();
                            }
                            // Пишем сессию
                            $this->Player_Model->Check_Double_Login($user, $_POST['universe']);
                            if($user->blocked_time > 0)
                            {
                                $this->Error('Ваш аккаунт заблокирован до '.date("m.d.y H:i:s", $user->blocked_time).'!<br>Причина: '.$user->blocked_why);
                            }
                            $this->session->set_userdata(array('id' => $user->id, 'universe' => $_POST['universe'], 'login' => $user->login, 'password' => md5($user->password)));
                            redirect('/game/', 'refresh');
                        }
                        else
                        {
                            $this->db->query('DELETE FROM '.$_POST['universe'].'_users where `id`="'.$user->id.'"');
                            $errors[] = 'В мире '.$_POST['universe'].' нет мест для заселения!';
                        }

                    }
                    else
                    {
                        $this->db->query('DELETE FROM '.$_POST['universe'].'_users where `id`="'.$user->id.'"');
                        $errors[] = 'В мире '.$_POST['universe'].' нет мест для заселения!';
                    }
                }
                else
                {
                    $errors[] = 'Такое имя уже используется!';
                }
            }
            $this->session->set_flashdata(array('errors' => $errors));
            $this->load->view('main_index', array('page' => 'register'));
        }

        /**
         * Активация аккуанта
         * @param <string> $universe
         * @param <string> $key
         */
        function validate($universe = '', $key = '')
        {
            if ($universe == 'alpha')
            {
                $query = $this->db->get_where($universe.'_users', array('register_key' => $key, 'register_complete' => 0));
                if ($query->num_rows() == 1)
                {
                    $user = $query->row();
                    $this->db->set('register_complete', time());
                    $this->db->where(array('register_key' => $key, 'register_complete' => 0));
                    $this->db->update($universe.'_users');
                    $this->session->set_userdata(array('id' => $user->id, 'universe' => $universe, 'login' => $user->login, 'password' => md5($user->password)));
                    redirect('/game/', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata(array('error' => 'Неверный ключ активации!'));
                    redirect('/main/error/', 'refresh');
                }
            }
            else
            {
                redirect('/', 'refresh');
            }
        }

        function send_password()
        {
            // Переменная ошибок
            $errors = array();
            $sended = false;
            // Загружаем модули
            $this->load->library('email');
            $this->load->helper('email');
            // Тип письма text или html
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            if (!isset($_POST['universe'])){ $errors[] = 'Не выбрана вселенная!'; }
            if (!isset($_POST['email']) or !valid_email($_POST['email'])){ $errors[] = 'Неверный e-mail.'; }
            if (count($errors) == 0)
            {
                $user_query = $this->db->get_where($_POST['universe'].'_users', array('email' => $_POST['email']));
                if ($user_query->num_rows == 0)
                {
                    $errors[] = 'E-mail не зарегистрирован!';
                }
                else
                {
                    $user = $user_query->row();
                    $password = $key = random_key(8);
                    $this->db->set('password', md5($password));
                    $this->db->where(array('id' => $user->id));
                    $this->db->update($_POST['universe'].'_users');
                    //Отправляем письмо
                                $message = '<html><body><p>Привет '.$user->login.',<br><br>Ваш новый пароль для Икариам ('.$_POST['universe'].'):<br><br>'.$password.'<br><br>Вы можете войти на странице <a href="'.$this->config->item('base_url').'" target="_blank">'.$this->config->item('base_url').'</a><br><br>Удачи в игре,<br>Ваша команда Икариам.</p></body></html>';
                                $this->email->from($this->config->item('email_from'), 'Гермес');
                                $this->email->to($_POST['email']);
                                $this->email->subject('Ваш новый пароль для Икариам!');
                                $this->email->message($message);
                                $this->email->send();
                    $sended = true;
                }
            }
            $this->session->set_flashdata(array('errors' => $errors));
            $this->session->set_flashdata(array('sended' => $sended));
            $this->load->view('main_index', array('page' => 'password', 'errors' => $errors));
        }
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */