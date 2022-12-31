-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour bkridbis
CREATE DATABASE IF NOT EXISTS `bkridbis` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bkridbis`;

-- Listage de la structure de table bkridbis. classes
CREATE TABLE IF NOT EXISTS `classes` (
  `ID_Classe` int unsigned NOT NULL AUTO_INCREMENT,
  `Nom_classe` varchar(40) NOT NULL,
  `fk_ID_BTS` varchar(40) NOT NULL,
  `Annee_scolaire_1` year NOT NULL,
  `Annee_scolaire_2` year NOT NULL,
  PRIMARY KEY (`ID_Classe`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bkridbis.classes : ~8 rows (environ)
INSERT INTO `classes` (`ID_Classe`, `Nom_classe`, `fk_ID_BTS`, `Annee_scolaire_1`, `Annee_scolaire_2`) VALUES
	(1, 'SIO2', '1', '2022', '2023'),
	(3, 'CI2', '2', '2022', '2023'),
	(5, 'COM2', '3', '2022', '2023'),
	(7, 'CG2', '4', '2022', '2023'),
	(9, 'NDRC2', '5', '2022', '2023'),
	(11, 'PI2', '6', '2022', '2023'),
	(13, 'SAM2', '7', '2022', '2023'),
	(15, 'TOU2', '8', '2022', '2023');

-- Listage de la structure de table bkridbis. comptes
CREATE TABLE IF NOT EXISTS `comptes` (
  `id_compte` int unsigned NOT NULL AUTO_INCREMENT,
  `fk_id_enseignant` int unsigned NOT NULL,
  `nom` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenom` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telephone` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Numen` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `identifiant` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `MotDePasse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dateChangement` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_compte`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bkridbis.comptes : ~2 rows (environ)
INSERT INTO `comptes` (`id_compte`, `fk_id_enseignant`, `nom`, `prenom`, `email`, `telephone`, `Numen`, `identifiant`, `MotDePasse`, `dateChangement`) VALUES
	(1, 3, 'D amico', 'Grégory', 'dami@co.gr', '9999999999', 'aaaaaaaaaaaaa', 'Damico', '$2y$10$zRPpGOI6Au9oXJJZcCglVOkAK0QeYDOpLJnXK5AFJZU5/ig2pzouG', '2022-12-30 18:15:58'),
	(2, 2, 'Carissant', 'Christian', 'ab@cd.ef', '9999999999', 'EEEEEEEEEEEEE', 'Carissant123', '$2y$10$uLzQXKghJ6XRVSKLIJOIBu7DBF2WT3UwZp4mEbAMEWiNMa5/T1Koi', '2022-12-31 01:11:36');

-- Listage de la structure de table bkridbis. eleves
CREATE TABLE IF NOT EXISTS `eleves` (
  `ID_ELEVE` int NOT NULL AUTO_INCREMENT,
  `nom_eleve` varchar(40) DEFAULT NULL,
  `prenom_eleve` varchar(40) DEFAULT NULL,
  `N_Candidat` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fk_ID_OPTION` int DEFAULT NULL,
  `fk_ID_classe` int DEFAULT NULL,
  PRIMARY KEY (`ID_ELEVE`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bkridbis.eleves : ~31 rows (environ)
INSERT INTO `eleves` (`ID_ELEVE`, `nom_eleve`, `prenom_eleve`, `N_Candidat`, `fk_ID_OPTION`, `fk_ID_classe`) VALUES
	(1, 'Abiram', 'Raveendran', '525512818', 1, 1),
	(2, 'Angloma', 'Wesley', '1148888888888', 1, 1),
	(3, 'Anzala', 'Emeric', '0', 1, 1),
	(4, 'Astasie', 'Mounia', '88474741', 2, 1),
	(5, 'Bazes', 'Kévin', '0', 1, 1),
	(6, 'Cisse', 'Adam Bacongo', '0', 2, 1),
	(7, 'David', 'Tom', '0', 1, 1),
	(8, 'Dos Santos', 'David', '0', 1, 1),
	(9, 'Drame', 'Mouhamadou', '0', 2, 1),
	(10, 'El Bana', 'Ashraf', '0', 1, 1),
	(11, 'El Hafsi', 'Nizar', '0', 1, 1),
	(12, 'Goubin', 'Sylvain', '0', 2, 1),
	(13, 'Guerin', 'Nicolas', '0', 1, 1),
	(14, 'Hasnoui', 'Nassim', '0', 1, 1),
	(15, 'Hiaumet', 'Mattéo', '0', 1, 1),
	(16, 'Indralingam', 'Inthusan', '0', 1, 1),
	(17, 'La Sala', 'Milan', '0', 1, 1),
	(18, 'Mane', 'Malang', '0', 2, 1),
	(19, 'Martins', 'Guillaume', '0', 2, 1),
	(20, 'Mathieu', 'Emma', '0', 1, 1),
	(21, 'Mendes', 'Joaquim', '0', 1, 1),
	(22, 'Mesina', 'Cristian', '0', 2, 1),
	(23, 'Nadji', 'Rayan', '0', 2, 1),
	(24, 'Nazir', 'Toycan', '0', 2, 1),
	(25, 'Rihane', 'Inès', '0', 2, 1),
	(26, 'Sarmiento', 'Nijel', '0', 2, 1),
	(27, 'Savoie', 'Adrien', '0', 2, 1),
	(28, 'Yagoubi', 'Nabil', '0', 1, 1),
	(29, 'Yangui', 'Amani', '0', 2, 1),
	(30, 'Ye', 'Stéphane', '0', 1, 1),
	(31, 'Zhang', 'Christophe', '0', 2, 1);

-- Listage de la structure de table bkridbis. enseignants
CREATE TABLE IF NOT EXISTS `enseignants` (
  `ID_ENSEIGNANT` int NOT NULL AUTO_INCREMENT,
  `Nom_enseignant` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Prenom_enseignant` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Numen` char(13) DEFAULT NULL,
  PRIMARY KEY (`ID_ENSEIGNANT`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bkridbis.enseignants : ~5 rows (environ)
INSERT INTO `enseignants` (`ID_ENSEIGNANT`, `Nom_enseignant`, `Prenom_enseignant`, `Numen`) VALUES
	(1, 'Bauras', 'Roberte', 'DDDDDDDDDDDDD'),
	(2, 'Carissant', 'Christian', 'EEEEEEEEEEEEE'),
	(3, 'D amico', 'Grégory', 'AAAAAAAAAAAAA'),
	(4, 'Robert', 'Timothée', 'ABC123ABC1234'),
	(5, 'Roubeau', 'Dominique', 'BBBBBBBBBBBBB');

-- Listage de la structure de table bkridbis. liste_des_bts
CREATE TABLE IF NOT EXISTS `liste_des_bts` (
  `ID_BTS` int NOT NULL AUTO_INCREMENT,
  `code_bts` varchar(10) DEFAULT NULL,
  `Libelle_bts` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ID_BTS`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bkridbis.liste_des_bts : ~8 rows (environ)
INSERT INTO `liste_des_bts` (`ID_BTS`, `code_bts`, `Libelle_bts`) VALUES
	(1, 'SIO', 'Services informatiques aux organisations'),
	(2, 'CI', 'Commerce international'),
	(3, 'COM', 'Communication'),
	(4, 'CG', 'Comptabilité et Gestion'),
	(5, 'NDRC', 'Négociation Digitalisation de la relation client'),
	(6, 'PI', 'Professions immobilières'),
	(7, 'SAM', "Support à l\'action managériale"),
	(8, 'TOU', 'Tourisme');

-- Listage de la structure de table bkridbis. liste_epreuves_ccf
CREATE TABLE IF NOT EXISTS `liste_epreuves_ccf` (
  `ID_CCF` int NOT NULL AUTO_INCREMENT,
  `code_ccf` varchar(15) DEFAULT NULL,
  `Libelle_ccf` varchar(150) DEFAULT NULL,
  `fk_ID_BTS` int DEFAULT NULL,
  `coefficient` float DEFAULT NULL,
  PRIMARY KEY (`ID_CCF`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bkridbis.liste_epreuves_ccf : ~3 rows (environ)
INSERT INTO `liste_epreuves_ccf` (`ID_CCF`, `code_ccf`, `Libelle_ccf`, `fk_ID_BTS`, `coefficient`) VALUES
	(1, 'E4', 'Support et mise à disposition de services informatiques', 1, 5),
	(2, 'E5SISR', 'Administration des systèmes et des réseaux', 1, 7),
	(3, 'E5SLAM', '"Conception et développement d’applications"', 1, 7);

-- Listage de la structure de table bkridbis. notes_ccf
CREATE TABLE IF NOT EXISTS `notes_ccf` (
  `ID_NOTE` int unsigned NOT NULL AUTO_INCREMENT,
  `fk_ID_CCF` int NOT NULL,
  `fk_ID_ELEVE` int NOT NULL,
  `NOTE` float NOT NULL,
  `DATE_EVAL` date NOT NULL,
  `DUREE_EVAL` time NOT NULL,
  `HEURE_EVAL` time NOT NULL,
  `fk_ID_ENSEIGNANT` int NOT NULL,
  `Nom_Intervenant` varchar(50) NOT NULL,
  `Commentaire` longtext NOT NULL,
  PRIMARY KEY (`ID_NOTE`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bkridbis.notes_ccf : ~62 rows (environ)
INSERT INTO `notes_ccf` (`ID_NOTE`, `fk_ID_CCF`, `fk_ID_ELEVE`, `NOTE`, `DATE_EVAL`, `DUREE_EVAL`, `HEURE_EVAL`, `fk_ID_ENSEIGNANT`, `Nom_Intervenant`, `Commentaire`) VALUES
	(1, 1, 1, 0.75, '2022-01-26', '05:00:00', '04:00:00', 3, 'Moi', 'Bonne chance'),
	(2, 1, 2, 0, '2022-01-01', '02:00:00', '00:00:00', 1, 'rien', 'rien'),
	(3, 1, 3, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(4, 1, 4, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(5, 1, 5, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(6, 1, 6, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(7, 1, 7, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(8, 1, 8, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(9, 1, 9, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(10, 1, 10, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(11, 1, 11, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(12, 1, 12, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(13, 1, 13, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(14, 1, 14, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(15, 1, 15, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(16, 1, 16, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(17, 1, 17, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(18, 1, 18, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(19, 1, 19, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(20, 1, 20, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(21, 1, 21, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(22, 1, 22, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(23, 1, 23, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(24, 1, 24, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(25, 1, 25, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(26, 1, 26, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(27, 1, 27, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(28, 1, 28, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(29, 1, 29, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(30, 1, 30, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(31, 1, 31, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(32, 3, 4, 0.5, '2022-01-12', '03:02:00', '06:01:00', 2, 'Moi', 'Bonne chance'),
	(33, 3, 6, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(34, 3, 9, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(35, 3, 12, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(36, 3, 18, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(37, 3, 19, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(38, 3, 22, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(39, 3, 23, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(40, 3, 24, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(41, 3, 25, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(42, 3, 26, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(43, 3, 27, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(44, 3, 29, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(45, 3, 31, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(46, 2, 1, 0.25, '2022-02-27', '22:26:00', '20:05:00', 5, 'Moi', 'rien'),
	(47, 2, 2, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(48, 2, 3, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(49, 2, 5, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(50, 2, 7, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(51, 2, 8, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(52, 2, 10, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(53, 2, 11, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(54, 2, 13, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(55, 2, 14, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(56, 2, 15, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(57, 2, 16, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(58, 2, 17, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(59, 2, 20, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(60, 2, 21, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(61, 2, 28, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien'),
	(62, 2, 30, 0, '2022-01-01', '00:00:00', '00:00:00', 1, 'rien', 'rien');

-- Listage de la structure de table bkridbis. options_bts
CREATE TABLE IF NOT EXISTS `options_bts` (
  `ID_OPTION` int unsigned NOT NULL,
  `code_option` varchar(10) NOT NULL,
  `libelle_option` varchar(150) NOT NULL,
  `fk_ID_BTS` int NOT NULL,
  PRIMARY KEY (`ID_OPTION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bkridbis.options_bts : ~2 rows (environ)
INSERT INTO `options_bts` (`ID_OPTION`, `code_option`, `libelle_option`, `fk_ID_BTS`) VALUES
	(1, 'SISR', 'Solutions d’infrastructure, systèmes et réseaux', 1),
	(2, 'SLAM', 'Solutions logicielles et applications métiers', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
