-- --------------------------------------------------------

--
-- Table structure for table `organism_drug`
--

CREATE TABLE IF NOT EXISTS `organism_drug` (
  `organism_id` int(11) unsigned NOT NULL DEFAULT '0',
  `drug_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `organism_id` (`organism_id`),
  KEY `drug_id` (`drug_id`)
);
