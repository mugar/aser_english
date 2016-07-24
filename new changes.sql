ALTER TABLE `services` DROP FOREIGN KEY `services_tier` ;
ALTER TABLE `reservations` CHANGE `arrivee` `checked_in` DATE NOT NULL;
ALTER TABLE `locations` CHANGE `arrivee` `checked_in` DATE NOT NULL;
ALTER TABLE `paiements` ADD `tier_id` INT NULL AFTER `id` ;
ALTER TABLE `paiements` ADD `type` VARCHAR( 50 ) NULL DEFAULT 'normal' AFTER `created` ;
ALTER TABLE `paiements` CHANGE `facture_id` `facture_id` BIGINT( 11 ) NULL ;
ALTER TABLE `journals` ADD UNIQUE( `numero`, `date`, `personnel_id`);
ALTER TABLE `journals` CHANGE `closed` `closed` TINYINT(1) NOT NULL DEFAULT '0';