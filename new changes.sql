
/* factures fields */
ALTER TABLE `factures` ADD `pyts` DOUBLE NULL AFTER `reste` 
ALTER TABLE `factures` ADD `avance_beneficiaire` DOUBLE NULL DEFAULT '0' AFTER `bon_commande` 
ALTER TABLE `factures` ADD `debloquer` TINYINT( 4 ) NULL DEFAULT '0' AFTER `avance_beneficiaire` 

CREATE TABLE IF NOT EXISTS `vente_effaces` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `facture_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` double NOT NULL,
  `PU` double NOT NULL,
  `montant` double NOT NULL,
  `date` date NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `observation` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `types` ADD `categorie` INT NULL DEFAULT '1' AFTER `type` ;
ALTER TABLE `factures` ADD `aserb_date` DATE NULL AFTER `avance_beneficiaire` ;
ALTER TABLE `produits` ADD `description` TEXT NULL AFTER `actif` ;


