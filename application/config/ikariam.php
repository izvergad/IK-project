<?php

/**
 * Версия игры
 */
$config['game_version'] = '0.0.1';
/**
 * URL адреса
 */
$config['style_url'] = 'http://127.0.0.1/design/'; // URL сервера со скином
$config['style_version'] = $config['game_version']; // URL сервера со скином
$config['script_url'] = 'http://127.0.0.1/design/'; // URL сервера со скриптом
$config['script_version'] = $config['game_version']; // URL сервера со скриптом
$config['forum_url'] = 'http://127.0.0.1/forum/'; // URL сервера со скриптом
$config['easter'] = FALSE; // Активировать пасхальное оформление

/**
 * Настройки безопасности
 */
$config['game_email'] = TRUE;               // Разрешение на отправку писем (Настройте SMTP)
$config['email_from'] = 'hermes@game.ru';   // Разрешение на отправку писем (Настройте SMTP)

/**
 * Игровые настройки
 */
$config['standart_capacity'] = 1500; // Стандартная вместимость
$config['town_queue_size'] = 3;      // Длина очереди построек
$config['army_queue_size'] = 3;      // Длина очереди армии

?>