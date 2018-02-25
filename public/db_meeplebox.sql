-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 25 fév. 2018 à 19:13
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_meeplebox`
--

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_creator_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` decimal(10,3) NOT NULL,
  `longitude` decimal(10,3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5387574AC645C84A` (`user_creator_id`),
  KEY `IDX_5387574AE48FD905` (`game_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `user_creator_id`, `game_id`, `title`, `description`, `date`, `start_time`, `duration`, `address`, `city`, `latitude`, `longitude`) VALUES
(1, 1, 1, 'Soirée Viking !', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.', '22/03/2018', '18h', '4h', '38a Boulevard Laurent Gérin', 'Lyon', '45.770', '4.830'),
(2, 1, 2, 'Journée TdF tcg !', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '25/03/2018', '10h', '12h', 'sdfd', 'Lyon', '45.760', '4.840'),
(3, 1, 3, 'Week End Pathfinder', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '28/03/2018', '14h', '48h', 'qsd', 'Lyon', '45.750', '4.860'),
(4, 1, 4, 'Journée Warhammer Quest', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '12/03/2018', '15h', '6h', 'qsd', 'Lyon', '45.780', '4.840'),
(5, 1, 5, 'Soirée Echecs', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '15/04/2018', '18h', '5h', 'qsdqs', 'Lyon', '45.773', '4.838'),
(6, 1, 6, 'Au looooup !', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '25/03/2018', '15h', '5h', 'qsd', 'Lyon', '45.778', '4.856'),
(7, 1, 7, 'Time\'s Up Parttttyyy', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ise en page avant impression. ', '24/04/2018', '14h', '8h', 'qsdq', 'Lyon', '45.756', '4.847'),
(8, 1, 8, 'Aprem Tarot', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '15/03/2018', '16h', '9h', 'sqdqd', 'Lyon', '45.754', '4.866'),
(9, 1, 9, 'Tournois de Belote ', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '15/03/2018', '15h', '12h', 'qsdqd', 'Lyon', '45.782', '4.847'),
(10, 1, 10, 'Soirée V-commandos', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '18/03/2018', '16h', '8h', 'qsd', 'Lyon', '45.743', '4.849'),
(11, 1, 11, 'Soirée This War of Mine', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '24/03/2018', '18h', '4h', 'sqds', 'Lyon', '45.763', '4.847'),
(12, 1, 12, 'Soirée DoW ! ', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '14/03/2018', '19h', '7h', 'qsdsq', 'Lyon', '45.753', '4.837'),
(13, 1, 13, 'Aprem Flamme Rouge !', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '14/03/2018', '19h', '5h', 'qsd', 'Lyon', '45.756', '4.847'),
(14, 1, 14, 'Aprem Diiiiice !', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '15/03/2018', '16h', '8h', 'qsdq', 'Lyon', '45.757', '4.843'),
(15, 1, 15, 'Aprem Yams', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '11/03/2018', '14h', '9h', 'sqdqsd', 'Lyon', '45.784', '4.837'),
(16, 1, 1, 'Aprem Blood Rage !', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. ', '15/03/2018', '17h', '8h', 'qsdqsdqsdqsd', 'Lyon', '45.775', '4.845');

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_type_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pict` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FF232B31508EF3BC` (`game_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `games`
--

INSERT INTO `games` (`id`, `game_type_id`, `title`, `pict`) VALUES
(1, 1, 'Blood Rage', 'img/game_pict/blood-rage-vf.jpg'),
(2, 5, 'Le Trône de Fer JCE - Seconde Édition', 'img/game_pict/le-trone-de-fer-jce-seconde-edition.jpg'),
(3, 8, 'Pathfinder - Le Régent de Jade : Pack Dragon', 'img/game_pict/pathfinder-le-regent-de-jade-pack-dragon.jpg'),
(4, 7, 'Warhammer Quest - Silver Tower VF', 'img/game_pict/warhammer-quest-silver-tower-vf.jpg'),
(5, 4, 'Echecs', 'img/game_pict/jeu-echecs-40-cm.jpg'),
(6, 2, 'Le Pacte des Loups-Garous de Thiercelieux', 'img/game_pict/le-pacte-des-loups-garous-de-thiercelieux.jpg'),
(7, 2, 'Time\'s Up : Party !', 'img/game_pict/time-s-up-party-2.jpg'),
(8, 6, 'Tarot', 'img/game_pict/tarot-grimaud-de-luxe.jpg'),
(9, 6, 'Belote', 'img/game_pict/coffret-belote.jpg'),
(10, 1, 'V-Commandos', 'img/game_pict/v-commandos.jpg'),
(11, 1, 'This War of Mine', 'img/game_pict/this-war-of-mine-le-jeu-de-plateau.jpg'),
(12, 1, 'Dead of Winter - A la croisée des chemins', 'img/game_pict/dead-of-winter-a-la-croisee-des-chemins.jpg'),
(13, 1, 'Flamme Rouge VF', 'img/game_pict/flamme-rouge-vf.jpg'),
(14, 3, 'Dice Forge VF', 'img/game_pict/dice-forge.jpg'),
(15, 3, 'Yams', 'img/game_pict/coffret-yams-cuir.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `games_pref`
--

DROP TABLE IF EXISTS `games_pref`;
CREATE TABLE IF NOT EXISTS `games_pref` (
  `users_id` int(11) NOT NULL,
  `game_types_id` int(11) NOT NULL,
  PRIMARY KEY (`users_id`,`game_types_id`),
  KEY `IDX_BE2D54E867B3B43D` (`users_id`),
  KEY `IDX_BE2D54E825F6CC71` (`game_types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `games_pref`
--

INSERT INTO `games_pref` (`users_id`, `game_types_id`) VALUES
(1, 1),
(1, 4),
(1, 5),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(3, 1),
(3, 3),
(3, 6),
(4, 3),
(4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `game_types`
--

DROP TABLE IF EXISTS `game_types`;
CREATE TABLE IF NOT EXISTS `game_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `game_types`
--

INSERT INTO `game_types` (`id`, `type_code`, `type_text`) VALUES
(1, 'plateau', 'de plateau'),
(2, 'ambiance', 'd\'ambiance'),
(3, 'des', 'de dés'),
(4, 'classiques', 'classiques'),
(5, 'tcg', 'de cartes à collectionner'),
(6, 'cartes', 'de cartes traditionnelles'),
(7, 'figurines', 'de figurines'),
(8, 'roles', 'de rôle');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `password`, `birthday`, `email`) VALUES
(1, 'SixtyNuts', '$2y$10$EHEtASYoDkrrsildb54I9OeTB3MBxUSA/tWT4IbnJkXyECU6giMFy', '1970-01-01', 'sixty.nuts@gmail.com'),
(2, 'Maurice69', '$2y$10$EJU2xz/kQVjDWpjKszgRDeab69gp5rZYitBrGm2W68l3Unf21KAVq', '1970-01-01', 'maurice69@gmail.com'),
(3, 'Helene69', '$2y$10$CeaFQwjqJxQqtoD7caY12efaGv1kE.RMuFqRIQo0PdtFm26rZtawO', '2006-09-03', 'sixty.nts@gmail.com'),
(4, 'Marta69', '$2y$10$uSKhIQ2..cWMLb6NYi4pceu4lJEThVk0y76IU.H5Yn1wtabRGQLym', '1970-01-01', 'marta69@gmail.com');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK_5387574AC645C84A` FOREIGN KEY (`user_creator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_5387574AE48FD905` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);

--
-- Contraintes pour la table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `FK_FF232B31508EF3BC` FOREIGN KEY (`game_type_id`) REFERENCES `game_types` (`id`);

--
-- Contraintes pour la table `games_pref`
--
ALTER TABLE `games_pref`
  ADD CONSTRAINT `FK_BE2D54E825F6CC71` FOREIGN KEY (`game_types_id`) REFERENCES `game_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_BE2D54E867B3B43D` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
