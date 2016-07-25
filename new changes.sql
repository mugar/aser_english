ALTER TABLE `services` DROP FOREIGN KEY `services_tier` ;
ALTER TABLE `reservations` CHANGE `arrivee` `checked_in` DATE NOT NULL;
ALTER TABLE `locations` CHANGE `arrivee` `checked_in` DATE NOT NULL;
ALTER TABLE `paiements` ADD `tier_id` INT NULL AFTER `id` ;
ALTER TABLE `paiements` ADD `type` VARCHAR( 50 ) NULL DEFAULT 'normal' AFTER `created` ;
ALTER TABLE `paiements` CHANGE `facture_id` `facture_id` BIGINT( 11 ) NULL ;
ALTER TABLE `journals` ADD UNIQUE( `numero`, `date`, `personnel_id`);
ALTER TABLE `journals` CHANGE `closed` `closed` TINYINT(1) NOT NULL DEFAULT '0';

CREATE TABLE IF NOT EXISTS `final_stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `quantite` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `stock_manager_id` int(11) DEFAULT NULL,
  `controler_id` int(11) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
ALTER TABLE `historiques` ADD `final_stock_id` BIGINT NULL AFTER `invoice_no` ;
ALTER TABLE `final_stocks` ADD `exit_quantite` DOUBLE NULL AFTER `quantite` ;
ALTER TABLE `historiques` ADD UNIQUE (
`libelle` ,
`final_stock_id`
);
