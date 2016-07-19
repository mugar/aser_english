ALTER TABLE `services` DROP FOREIGN KEY `services_tier` ;
ALTER TABLE `reservations` CHANGE `arrivee` `checked_in` DATE NOT NULL;
ALTER TABLE `locations` CHANGE `arrivee` `checked_in` DATE NOT NULL;