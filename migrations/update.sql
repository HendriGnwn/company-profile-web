
INSERT INTO `config` (`name`, `value`, `label`, `notes`)
	VALUES 
	('counter_visitor', '500', 'Website Visitors', null),
	('counter_website_age', '500', 'Website Age', null),
	('statistics_disk_usage', '60', 'Disk Usage', '180,000 / 250,000 (60%)'),
	('statistics_bandwidth', '60', 'Bandwidth', '180,000 / 250,000 (60%)'),
	('statistics_cpu_usage', '60', 'CPU Usage', '180,000 / 250,000 (60%)'),
	('statistics_ram_usage', '60', 'RAM Usage', '180,000 / 250,000 (60%)');

UPDATE `config` SET
`id` = '15',
`name` = 'counter_year_of_experience',
`value` = '15',
`label` = 'Website Age',
`notes` = NULL
WHERE `id` = '15';