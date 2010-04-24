<?php

/**
 * Версия игры
 */
$config['game_version'] = '0.0.1';                   // Версия игры
/**
 * URL адреса
 */
$config['style_url'] = 'http://127.0.0.1/design/';   // URL сервера со скином
$config['style_version'] = $config['game_version'];  // URL сервера со скином
$config['script_url'] = 'http://127.0.0.1/design/';  // URL сервера со скриптом
$config['script_version'] = $config['game_version']; // URL сервера со скриптом
$config['forum_url'] = 'http://127.0.0.1/forum/';    // URL сервера со скриптом
$config['easter'] = FALSE;                           // Активировать пасхальное оформление

/**
 * Настройки почты
 */
$config['game_email'] = FALSE;            // Разрешение на отправку писем (Настройте SMTP)
$config['email_from'] = 'hermes@game.ru'; // Адрес, с которого приходит письмо

/**
 * Безопасность
 */
$config['double_login'] = FALSE;     // Активировать проверку на мультоводство

/**
 * Игровые настройки
 * Рекомендуется не изменять их
 */
$config['standart_capacity'] = 1500;  // Стандартная вместимость склада
$config['transport_capacity'] = 500;  // Стандартная вместимость сухогруза
$config['town_queue_size'] = 3;       // Длина очереди построек
$config['army_queue_size'] = 3;       // Длина очереди армии
$config['notes_default'] = 200;       // Длина заметок в символах
$config['notes_premium'] = 8192;      // Длина заметок с премиум аккуантом
$config['trade_route_time'] = 604800; // Длительность торгового маршрута

?>