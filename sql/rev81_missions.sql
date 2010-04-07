ALTER TABLE alpha_missions ADD COLUMN `loading_start` int(11) NOT NULL AFTER `to`;
ALTER TABLE alpha_missions ADD COLUMN `return_start` int(11) NOT NULL AFTER `mission_start`;
ALTER TABLE alpha_missions ADD COLUMN `gold` int(11) NOT NULL default '0' AFTER `sulfur`;
ALTER TABLE alpha_missions ADD COLUMN `peoples` int(11) NOT NULL AFTER `gold`;
ALTER TABLE alpha_missions ADD COLUMN `percent` varchar(11) character set utf8 NOT NULL default '0' AFTER `ship_transport`;
