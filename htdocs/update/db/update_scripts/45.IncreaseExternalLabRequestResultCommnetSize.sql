ALTER TABLE `blis_revamp_prod`.`external_lab_request` 
CHANGE COLUMN `result` `result` VARCHAR(2000) NULL DEFAULT NULL ,
CHANGE COLUMN `comments` `comments` VARCHAR(2000) NULL DEFAULT NULL ;