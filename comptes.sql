CREATE TABLE `comptes` (
   `id_compte` int unsigned NOT NULL auto_increment,
   `nom` varchar(40) NOT NULL,
   `prenom` varchar(40) NOT NULL,
   `email` varchar(40) NOT NULL,
   `telephone` varchar(10) NOT NULL,
   `Numen` varchar(13) NOT NULL,
   `identifiant` varchar(40) NOT NULL,
   `MotDePasse` VARCHAR(255) NOT NULL,
   `dateChangement` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
   PRIMARY KEY (`id_compte`)
);