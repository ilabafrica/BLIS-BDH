ALTER TABLE blis_revamp_prod.lab_config 
ADD COLUMN `force_verify` INT NULL DEFAULT 0,
ADD COLUMN `start_time` VARCHAR(10) NULL DEFAULT "9:00" , 
ADD COLUMN `end_time` VARCHAR(10) NULL DEFAULT "5:00"  ,
ADD COLUMN `force_verify_on_weekends` INT DEFAULT 0 ;
