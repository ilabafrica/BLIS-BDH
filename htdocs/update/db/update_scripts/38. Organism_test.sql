DROP table `drug_test`;

CREATE TABLE IF NOT EXISTS `organism_test` (
  `test_type_id` int(11) unsigned NOT NULL DEFAULT '0',
  `organism_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `test_type_id` (`test_type_id`),
  KEY `organism_id` (`organism_id`)
);
