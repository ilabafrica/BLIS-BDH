ALTER TABLE `rejection_reasons` ADD `disabled` INT(1) NOT NULL AFTER `description`;
ALTER TABLE `rejection_phases` ADD `disabled` INT(1) NOT NULL AFTER `description`;
