ALTER TABLE `services` DROP FOREIGN KEY `services_tier` ;
ALTER TABLE `reservations` CHANGE `arrivee` `checked_in` DATE NOT NULL;
ALTER TABLE `locations` CHANGE `arrivee` `checked_in` DATE NOT NULL;
ALTER TABLE `paiements` ADD `tier_id` INT NULL AFTER `id` ;
ALTER TABLE `paiements` ADD `type` VARCHAR( 50 ) NULL DEFAULT 'normal' AFTER `created` ;
ALTER TABLE `paiements` CHANGE `facture_id` `facture_id` BIGINT( 11 ) NULL ;
ALTER TABLE `journals` ADD UNIQUE( `numero`, `date`, `personnel_id`);
ALTER TABLE `journals` CHANGE `closed` `closed` TINYINT(1) NOT NULL DEFAULT '0';

ALTER TABLE `historiques` CHANGE `invoice_no` `invoice_no` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `supplier` `supplier` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `historiques` CHANGE `stock_id` `stock_id` BIGINT(11) NULL DEFAULT '1', CHANGE `produit_id` `produit_id` BIGINT(11) NULL, CHANGE `date` `date` DATE NULL, CHANGE `shift` `shift` INT(11) NULL DEFAULT '1';
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
ALTER TABLE `historiques` ADD `comments` TEXT NULL AFTER `personnel_id` ;

CREATE TABLE IF NOT EXISTS `recouvrements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` int(11) DEFAULT NULL,
  `done_by_id` int(10) unsigned DEFAULT NULL,
  `factures` text,
  `montant` double DEFAULT NULL,
  `comments` text,
  `date` date DEFAULT NULL,
  `personnel_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

