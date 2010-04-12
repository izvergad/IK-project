ALTER TABLE `alpha_users` ADD COLUMN   `double_login` int(11) NOT NULL default '0' AFTER `last_visit`;
ALTER TABLE `alpha_users` ADD COLUMN   `blocked_time` int(11) NOT NULL default '0' AFTER `double_login`;
ALTER TABLE `alpha_users` ADD COLUMN   `blocked_why` text character set utf8 NOT NULL AFTER `blocked_time`;
