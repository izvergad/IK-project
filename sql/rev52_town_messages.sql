CREATE TABLE `alpha_town_messages` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(11) NOT NULL,
  `town` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `text` text character set utf8 NOT NULL,
  `checked` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`,`user`,`town`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;