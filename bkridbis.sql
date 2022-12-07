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

-- Listage de la structure de table bkridbis. comptes
CREATE TABLE IF NOT EXISTS `comptes` (
  `id_compte` int unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `Numen` varchar(13) NOT NULL,
  `identifiant` varchar(40) NOT NULL,
  `MotDePasse` varchar(255) NOT NULL,
  `dateChangement` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_compte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bkridbis.comptes : ~0 rows (environ)

-- Listage de la structure de table bkridbis. eleve
CREATE TABLE IF NOT EXISTS `eleve` (
  `ID_ELEVE` int NOT NULL AUTO_INCREMENT,
  `nom_eleve` varchar(40) DEFAULT NULL,
  `prenom_eleve` varchar(40) DEFAULT NULL,
  `fk_ID_OPTION` int DEFAULT NULL,
  PRIMARY KEY (`ID_ELEVE`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bkridbis.eleve : ~31 rows (environ)
INSERT INTO `eleve` (`ID_ELEVE`, `nom_eleve`, `prenom_eleve`, `fk_ID_OPTION`) VALUES
	(1, 'Abiram', 'Raveendran', 1),
	(2, 'Angloma', 'Wesley', 1),
	(3, 'Anzala', 'Emeric', 1),
	(4, 'Astasie', 'Mounia', 2),
	(5, 'Bazes', 'Kévin', 1),
	(6, 'Cisse', 'Adam Bacongo', 2),
	(7, 'David', 'Tom', 1),
	(8, 'Dos Santos', 'David', 1),
	(9, 'Drame', 'Mouhamadou', 2),
	(10, 'El Bana', 'Ashraf', 1),
	(11, 'El Hafsi', 'Nizar', 1),
	(12, 'Goubin', 'Sylvain', 2),
	(13, 'Guerin', 'Nicolas', 1),
	(14, 'Hasnoui', 'Nassim', 1),
	(15, 'Hiaumet', 'Mattéo', 1),
	(16, 'Indralingam', 'Inthusan', 1),
	(17, 'La Sala', 'Milan', 1),
	(18, 'Mane', 'Malang', 2),
	(19, 'Martins', 'Guillaume', 2),
	(20, 'Mathieu', 'Emma', 1),
	(21, 'Mendes', 'Joaquim', 1),
	(22, 'Mesina', 'Cristian', 2),
	(23, 'Nadji', 'Rayan', 2),
	(24, 'Nazir', 'Toycan', 2),
	(25, 'Rihane', 'Inès', 2),
	(26, 'Sarmiento', 'Nijel', 2),
	(27, 'Savoie', 'Adrien', 2),
	(28, 'Yagoubi', 'Nabil', 1),
	(29, 'Yangui', 'Amani', 2),
	(30, 'Ye', 'Stéphane', 1),
	(31, 'Zhang', 'Christophe', 2);

-- Listage de la structure de table bkridbis. enseignant
CREATE TABLE IF NOT EXISTS `enseignant` (
  `ID_ENSEIGNANT` int NOT NULL AUTO_INCREMENT,
  `Nom_enseignant` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Prenom_enseignant` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Numen` char(13) DEFAULT NULL,
  PRIMARY KEY (`ID_ENSEIGNANT`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bkridbis.enseignant : ~5 rows (environ)
INSERT INTO `enseignant` (`ID_ENSEIGNANT`, `Nom_enseignant`, `Prenom_enseignant`, `Numen`) VALUES
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
  `code_option` varchar(10) DEFAULT NULL,
  `libelle_option` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ID_BTS`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bkridbis.liste_des_bts : ~9 rows (environ)
INSERT INTO `liste_des_bts` (`ID_BTS`, `code_bts`, `Libelle_bts`, `code_option`, `libelle_option`) VALUES
	(1, 'SIO', 'Services informatiques aux organisations', 'SISR', 'Solutions d’infrastructure, systèmes et réseaux'),
	(2, 'SIO', 'Services informatiques aux organisations', 'SLAM', 'Solutions logicielles et applications métiers'),
	(3, 'CI', 'Commerce international', '', ''),
	(4, 'COM', 'Communication', '', ''),
	(5, 'CG', 'Comptabilité et Gestion', '', ''),
	(6, 'NDRC', 'Négociation Digitalisation de la relation client', '', ''),
	(7, 'PI', 'Professions immobilières', '', ''),
	(8, 'SAM', 'Support à l\'action managériale', '', ''),
	(9, 'TOU', 'Tourisme', '', '');

-- Listage de la structure de table bkridbis. liste_epreuves_ccf
CREATE TABLE IF NOT EXISTS `liste_epreuves_ccf` (
  `ID_CCF` int NOT NULL AUTO_INCREMENT,
  `code_ccf` varchar(15) DEFAULT NULL,
  `Libelle_ccf` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ID_CCF`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bkridbis.liste_epreuves_ccf : ~3 rows (environ)
INSERT INTO `liste_epreuves_ccf` (`ID_CCF`, `code_ccf`, `Libelle_ccf`) VALUES
	(1, 'E4', 'Support et mise à disposition de services informatiques'),
	(2, 'E5SISR', 'Administration des systèmes et des réseaux'),
	(3, 'E5SLAM', '"Conception et développement d’applications"');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
