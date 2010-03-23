<?php
/**
 * Контроллер оболочки входа
 */
class Main extends Controller {

	function Main()
	{
		parent::Controller();	
	}

        /**
         * Страница по умолчанию
         */
	function index()
	{
            if (isset($_POST['action']))
            {
                if ($_POST['action'] == 'login')
                {
                    $this->load->model('User_Model');
                    $this->User_Model->User_Login();
                }
                if ($_POST['action'] == 'register')
                {
                    $this->load->library('email');
                    $this->load->helper('email');
                    
                    $config['mailtype'] = 'html';               // Тип письма text или html
                    $this->email->initialize($config);
                    
                    $this->CreateAvatar();
                }
            }
                $page = $this->load->view('main_index', null, true);
		$this->load->view('main',array('page' => $page));
	}

        /**
         * Страница регистрации
         */
        function register()
        {
                $page = $this->load->view('main_register', null, true);
		$this->load->view('main',array('page' => $page));
        }

        /**
         * Страница тура по игре
         * @param <int> $id
         */
        function tour($id = 1)
        {
                $page_id = $id > 5 ? 5 : $id;
                $page_id = $id < 1 ? 1 : $id;
                $page = $this->load->view('main_tour_'.$page_id, null, true);
		$this->load->view('main',array('page' => $page));
        }

        /**
         * Страница ошибки
         */
        function error()
        {
                $error = $this->session->flashdata('error');
                $page = $this->load->view('main_error', array('error' => $error), true);
		$this->load->view('main',array('page' => $page));
        }

        function CreateAvatar()
        {
            if (isset($_POST['universe']) and isset($_POST['name']) and $_POST['name'] != '' and isset($_POST['password']) and $_POST['password'] != '' and isset($_POST['email']) and valid_email($_POST['email']) and isset($_POST['agb']) and $_POST['agb'] and $_POST['universe'] == 'alpha')
            {
                $login = strip_tags($_POST['name']);
                $password = strip_tags($_POST['password']);
                
                $query = $this->db->get_where($_POST['universe'].'_users', array('login' => $login));
                // Если такого игркоа нету
                if ($query->num_rows == 0)
                {
                    $key = random_key(30);
                    // Добавляем данные игрока
                    $user_data = array(
                       'login' => $login,
                       'password' => md5($password),
                       'last_visit' => time(),
                       'register_key' => $key
                    );
                    $this->db->insert($_POST['universe'].'_users', $user_data);
                    // Находим игрока в базе
                    $query = $this->db->get_where($_POST['universe'].'_users', array('login' => $login));
                    $user = $query->row();
                    // Выбираем остров
                    $query = $this->db->query('SELECT * FROM `'.$_POST['universe'].'_islands'.'` WHERE `city0`=0 or `city2`=0 or `city4`=0 or `city6`=0 or `city8`=0 or `city10`=0 or `city12`=0 or `city14`=0');

                    if ($query->num_rows > 0)
                    {
                        $island = $query->row();
                        // Находим позицию
                        $position = -1;
                        for ($i = 0; $i <= 15; $i++)
                        {
                            $parametr = 'city'.$i;
                            if ($island->$parametr == 0){$position = $i;break;}
                        }
                        if ($position >= 0)
                        {
                            // Добавляем город
                            $city_data = array(
                                'user' => $user->id,
                                'island' => $island->id,
                                'last_update' => time()
                            );
                            $this->db->insert($_POST['universe'].'_towns', $city_data);
                            // Находим город в базе
                            $query = $this->db->get_where($_POST['universe'].'_towns', array('user' => $user->id));
                            $town = $query->row();
                            // Добавляем армию
                            $army_data = array(
                                'city' => $town->id
                            );
                            $this->db->insert($_POST['universe'].'_army', $army_data);
                            // Обновляем город в остров
                            $this->db->set('city'.$position, $town->id);
                            $this->db->where(array('id' => $island->id));
                            $this->db->update($_POST['universe'].'_islands');
                            // Добавляем исследования
                            $research_data = array(
                                'user' => $user->id
                            );
                            $this->db->insert($_POST['universe'].'_research', $research_data);
                            // Обновляем игрока
                            $this->db->set('town', $town->id);
                            $this->db->set('capital', $town->id);
                            $this->db->where(array('id' => $user->id));
                            $this->db->update($_POST['universe'].'_users');

                            // Пишем сессию
                            $data = array();
                            $data['id'] = $user->id;
                            $data['universe'] = $_POST['universe'];
                            $data['login'] = $user->login;
                            $data['password'] = md5($user->password);

                            //Отправляем письмо
                            if ($this->config->item('game_email'))
                            {
                                $message = '
                                    <html>
                                    <body>
                                     <p>Привет '.$user->login.', <br>
                                     <br>Вы решили создать империю в мире Икариам '.$_POST['universe'].'!<br>
                                     <br>Нажмите на ссылку, чтобы подтвердить Ваш аккаунт:<br>
                                     <br><a href="'.$this->config->item('base_url').'main/validate/'.$_POST['universe'].'/'.$key.'/" target="_blank">'.$this->config->item('base_url').'main/validate/'.$_POST['universe'].'/'.$key.'</a><br>
                                     <br>Ваша информация для доступа:
                                     <br>Имя игрока: '.$_POST['name'].'<br>Пароль: '.$_POST['password'].'
                                     <br>Сервер: '.$_POST['universe'].'<br>
                                     <br>Если Вам понадобится помощь, то Вы сможете найти ее на форуме Икариам ('.$this->config->item('forum_url').').<br><br>Удачи в игре,<br>Ваша команда Икариам.</p>
                                    </body>
                                    </html>';
                                $this->email->from($this->config->item('email_from'), 'Гермес');
                                $this->email->to($_POST['email']);

                                $this->email->subject($user->login.', Добро пожаловать в Икариам!');
                                $this->email->message($message);
                                $this->email->send();
                            }
                            $this->session->set_userdata($data);
                            redirect('/game/', 'refresh');
                        }
                        else
                        {
                            $this->db->query('DELETE FROM '.$_POST['universe'].'_users where `id`="'.$user->id.'"');
                            $this->session->set_flashdata(array('error' => 'В мире '.$_POST['universe'].' нет мест для заселения!'));
                            redirect('/main/error/', 'refresh');
                        }
                        
                    }else{
                        $this->db->query('DELETE FROM '.$_POST['universe'].'_users where `id`="'.$user->id.'"');
                        $this->session->set_flashdata(array('error' => 'В мире '.$_POST['universe'].' нет мест для заселения!'));
                        redirect('/main/error/', 'refresh');
                    }
                }
                else
                {
                    $this->session->set_flashdata(array('error' => 'Игрок с таким именем уже существует!'));
                    redirect('/main/error/', 'refresh');
                }

            }
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
                    
                    $data = array();
                    $data['id'] = $user->id;
                    $data['universe'] = $universe;
                    $data['login'] = $user->login;
                    $data['password'] = md5($user->password);
                    $this->session->set_userdata($data);
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
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */