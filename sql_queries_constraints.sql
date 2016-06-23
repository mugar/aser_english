/*sql queries to run on aser database in order to setup constraints*/

ALTER TABLE `reductions` CHANGE `produit_id` `produit_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `reductions` CHANGE `tier_id` `tier_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `tiers` CHANGE `id` `id` BIGINT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ;
ALTER TABLE `tiers` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `reductions` ADD CONSTRAINT `reduction_tier` FOREIGN KEY ( `tier_id` ) REFERENCES `aser`.`tiers` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `produits` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `reductions` ADD CONSTRAINT `reduction_produit` FOREIGN KEY ( `produit_id` ) REFERENCES `aser`.`produits` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `historiques` ADD INDEX ( `stock_id` ) ;
ALTER TABLE `historiques` ADD INDEX ( `produit_id` ) ;
ALTER TABLE `historiques` CHANGE `produit_id` `produit_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `historiques` ADD CONSTRAINT `historique_produit` FOREIGN KEY ( `produit_id` ) REFERENCES `aser`.`produits` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `stocks` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `historiques` CHANGE `stock_id` `stock_id` BIGINT( 11 ) NOT NULL DEFAULT '1';
ALTER TABLE `historiques` ADD CONSTRAINT `historique_stock` FOREIGN KEY ( `stock_id` ) REFERENCES `aser`.`stocks` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `entrees` CHANGE `stock_id` `stock_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `entrees` ADD INDEX ( `stock_id` ) ;
ALTER TABLE `entrees` CHANGE `produit_id` `produit_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `entrees` ADD INDEX ( `produit_id` ) ;
ALTER TABLE `entrees` ADD CONSTRAINT `entree_stock` FOREIGN KEY ( `stock_id` ) REFERENCES `aser`.`stocks` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `entrees` ADD CONSTRAINT `entree_produit` FOREIGN KEY ( `produit_id` ) REFERENCES `aser`.`produits` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `entrees` CHANGE `tier_id` `tier_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `entrees` ADD INDEX ( `tier_id` ) ;
ALTER TABLE `entrees` CHANGE `tier_id` `tier_id` BIGINT( 11 ) NULL ;
ALTER TABLE `entrees` ADD CONSTRAINT `entree_tier` FOREIGN KEY ( `tier_id` ) REFERENCES `aser`.`tiers` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `factures` CHANGE `tier_id` `tier_id` BIGINT( 11 ) NULL DEFAULT NULL ;
ALTER TABLE `factures` ADD INDEX ( `tier_id` ) ;
ALTER TABLE `factures` ADD CONSTRAINT `facture_tier` FOREIGN KEY ( `tier_id` ) REFERENCES `aser`.`tiers` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `journals` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `factures` CHANGE `journal_id` `journal_id` BIGINT( 11 ) NULL DEFAULT NULL ;
ALTER TABLE `factures` ADD INDEX ( `journal_id` ) ;
ALTER TABLE `factures` ADD CONSTRAINT `facture_journal` FOREIGN KEY ( `journal_id` ) REFERENCES `aser`.`journals` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `ventes` ADD INDEX ( `produit_id` ) ;
 `id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `ventes` DROP FOREIGN KEY `facture_ventes` ;
ALTER TABLE `factures` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `ventes` CHANGE `facture_id` `facture_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `ventes` ADD CONSTRAINT `vente_facture` FOREIGN KEY ( `facture_id` ) REFERENCES `aser`.`factures` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `paiements` CHANGE `journal_id` `journal_id` BIGINT( 11 ) NULL DEFAULT NULL ;
ALTER TABLE `paiements` ADD INDEX ( `journal_id` ) ;
ALTER TABLE `paiements` CHANGE `facture_id` `facture_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `paiements` ADD INDEX ( `facture_id` ) ;
ALTER TABLE `paiements` ADD CONSTRAINT `paiement_journal` FOREIGN KEY ( `journal_id` ) REFERENCES `aser`.`journals` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `paiements` ADD CONSTRAINT `paiement_facture` FOREIGN KEY ( `facture_id` ) REFERENCES `aser`.`factures` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `reservations` CHANGE `tier_id` `tier_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `reservations` ADD INDEX ( `tier_id` ) ;
ALTER TABLE `reservations` CHANGE `facture_id` `facture_id` BIGINT( 11 ) NULL DEFAULT NULL ;
ALTER TABLE `reservations` CHANGE `chambre_id` `chambre_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `chambres` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `reservations` ADD INDEX ( `chambre_id` ) ;
ALTER TABLE `reservations` ADD INDEX ( `facture_id` ) ;
ALTER TABLE `reservations` ADD CONSTRAINT `reservation_tier` FOREIGN KEY ( `tier_id` ) REFERENCES `aser`.`tiers` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `reservations` ADD CONSTRAINT `reservation_facture` FOREIGN KEY ( `facture_id` ) REFERENCES `aser`.`factures` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `reservations` ADD CONSTRAINT `reservation_chambre` FOREIGN KEY ( `chambre_id` ) REFERENCES `aser`.`chambres` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `caisses` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `services` CHANGE `tier_id` `tier_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `services` CHANGE `facture_id` `facture_id` BIGINT( 11 ) NULL DEFAULT NULL ;
ALTER TABLE `services` CHANGE `type_service_id` `type_service_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `services` ADD INDEX ( `tier_id` ) ;
ALTER TABLE `services` ADD INDEX ( `facture_id` ) ;
ALTER TABLE `services` ADD INDEX ( `type_service_id` ) ;
DELETE FROM `services` WHERE tier_id =0;
ALTER TABLE `services` ADD CONSTRAINT `services_tier` FOREIGN KEY ( `tier_id` ) REFERENCES `aser`.`tiers` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `services` ADD CONSTRAINT `service_facture` FOREIGN KEY ( `facture_id` ) REFERENCES `aser`.`factures` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `type_services` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `services` ADD CONSTRAINT `service_type` FOREIGN KEY ( `type_service_id` ) REFERENCES `aser`.`type_services` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `locations` CHANGE `tier_id` `tier_id` BIGINT( 11 ) NULL DEFAULT NULL ;
ALTER TABLE `locations` CHANGE `facture_id` `facture_id` BIGINT( 11 ) NULL DEFAULT NULL ;
ALTER TABLE `locations` CHANGE `salle_id` `salle_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `salles` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `locations` ADD INDEX ( `tier_id` ) ;
ALTER TABLE `locations` ADD INDEX ( `facture_id` ) ;
ALTER TABLE `locations` ADD INDEX ( `salle_id` ) ;
ALTER TABLE `locations` ADD CONSTRAINT `location_tier` FOREIGN KEY ( `tier_id` ) REFERENCES `aser`.`tiers` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `locations` CHANGE `facture_id` `facture_id` BIGINT( 11 ) NOT NULL ;
DELETE FROM `locations` WHERE facture_id =0;
ALTER TABLE `locations` ADD CONSTRAINT `location_facture` FOREIGN KEY ( `facture_id` ) REFERENCES `aser`.`factures` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `locations` ADD CONSTRAINT `location_salle` FOREIGN KEY ( `salle_id` ) REFERENCES `aser`.`salles` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `locations` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `location_extras` CHANGE `location_id` `location_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `location_extras` ADD INDEX ( `location_id` ) ;
ALTER TABLE `location_extras` ADD CONSTRAINT `location_location_extra` FOREIGN KEY ( `location_id` ) REFERENCES `aser`.`locations` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE `fonctions` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `personnels` CHANGE `fonction_id` `fonction_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `personnels` ADD INDEX ( `fonction_id` ) ;
ALTER TABLE `fonctions` DROP `personnel_id` ;
INSERT INTO `aser`.`fonctions` (
`id` ,
`name` ,
`description` ,
`created` ,
`modified`
)
VALUES (
'8', 'Point de Vente', 'aaa', '2015-09-23 00:00:00', '2015-09-23 00:00:00'
);
ALTER TABLE `personnels` ADD CONSTRAINT `fonction_personel` FOREIGN KEY ( `fonction_id` ) REFERENCES `aser`.`fonctions` (
`id`
) ON DELETE RESTRICT ON UPDATE CASCADE ;
ALTER TABLE `sections` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `groupes` CHANGE `id` `id` BIGINT( 11 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `groupes` CHANGE `section_id` `section_id` BIGINT( 11 ) NOT NULL ;
ALTER TABLE `groupes` ADD INDEX ( `section_id` ) ;
ALTER TABLE `sortis` CHANGE `tier_id` `tier_id` BIGINT( 11 ) NULL ;