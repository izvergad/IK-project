CREATE TABLE `alpha_double_login` (
  `id` int(11) NOT NULL auto_increment,
  `account_from` int(11) NOT NULL,
  `account_to` int(11) NOT NULL,
  `login_time` int(11) NOT NULL,
  `ip_address` varchar(15) character set utf8 NOT NULL,
  PRIMARY KEY  (`id`,`account_from`,`account_to`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
