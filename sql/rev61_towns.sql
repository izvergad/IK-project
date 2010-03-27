ALTER TABLE alpha_towns ADD COLUMN `tradegood` varchar(255) character set utf8 NOT NULL default '0' AFTER `workers`;
ALTER TABLE alpha_towns ADD COLUMN `tradegood_wood` int(11) NOT NULL default '0' AFTER `workers_wood`;
