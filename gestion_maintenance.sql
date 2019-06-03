-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 03 juin 2019 à 14:21
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion_maintenance`
--

-- --------------------------------------------------------

--
-- Structure de la table `gm_maintenance`
--

DROP TABLE IF EXISTS `gm_maintenance`;
CREATE TABLE IF NOT EXISTS `gm_maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `sujet` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `vehicule_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicule-id` (`vehicule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gm_maintenance`
--

INSERT INTO `gm_maintenance` (`id`, `date_debut`, `date_fin`, `sujet`, `description`, `vehicule_id`) VALUES
(1, '2019-05-31', '2019-05-31', 'Entretien', 'Vidange filtre à huile', 4),
(2, '2019-06-03', '2019-06-07', 'Remplacement embrayage', 'test', 5),
(3, '2019-05-31', '2019-06-01', 'Plaquettes de freins', 'Remplacement des plaquettes de freins avants', 4),
(4, '2019-06-12', '2019-06-12', 'Contrôle technique', 'contrôle complet', 4),
(5, '2019-06-01', '2019-06-08', 'Remplacement ciel de toit', 'Poser un ciel de toit noir à la demande du client.', 4),
(6, '2019-06-18', '2019-06-20', 'Remplacement balais essuie glace avants', '', 4);

-- --------------------------------------------------------

--
-- Structure de la table `gm_notes`
--

DROP TABLE IF EXISTS `gm_notes`;
CREATE TABLE IF NOT EXISTS `gm_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tech_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `maintenance_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tech-id` (`tech_id`),
  KEY `maintenance-id` (`maintenance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gm_notes`
--

INSERT INTO `gm_notes` (`id`, `tech_id`, `note`, `maintenance_id`) VALUES
(1, 22, 'Prévoir complet du véhicule avant de l\'envoyer au CT', 4),
(2, 20, 'Prévoir outils spécifiques au modèle', 2),
(3, 22, 'Prévoir des clips en plus !', 5);

-- --------------------------------------------------------

--
-- Structure de la table `gm_photos`
--

DROP TABLE IF EXISTS `gm_photos`;
CREATE TABLE IF NOT EXISTS `gm_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(150) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `maintenance_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `maintenance-id` (`maintenance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gm_photos`
--

INSERT INTO `gm_photos` (`id`, `photo`, `titre`, `maintenance_id`) VALUES
(1, 'embrayage.jpg', 'Kit embrayage', 2),
(3, 'balais.jpg', 'BEG avts', 6),
(4, 'ciel-de-toit.jpg', 'Ciel de toit', 5);

-- --------------------------------------------------------

--
-- Structure de la table `gm_pieces`
--

DROP TABLE IF EXISTS `gm_pieces`;
CREATE TABLE IF NOT EXISTS `gm_pieces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `quantite` decimal(10,0) NOT NULL,
  `maintenance_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `maintenance-id` (`maintenance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gm_pieces`
--

INSERT INTO `gm_pieces` (`id`, `nom`, `quantite`, `maintenance_id`) VALUES
(1, 'kit embrayage', '1', 2),
(3, 'Jeu de plaquettes avants', '1', 3),
(4, 'Ciel de toit noir', '1', 5),
(5, 'Balais essuie glace avant', '1', 6);

-- --------------------------------------------------------

--
-- Structure de la table `gm_roles`
--

DROP TABLE IF EXISTS `gm_roles`;
CREATE TABLE IF NOT EXISTS `gm_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gm_roles`
--

INSERT INTO `gm_roles` (`id`, `role`) VALUES
(1, 'administrateur'),
(2, 'gestionnaire'),
(3, 'technicien');

-- --------------------------------------------------------

--
-- Structure de la table `gm_users`
--

DROP TABLE IF EXISTS `gm_users`;
CREATE TABLE IF NOT EXISTS `gm_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(250) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role-id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gm_users`
--

INSERT INTO `gm_users` (`id`, `nom`, `prenom`, `email`, `mdp`, `role_id`) VALUES
(2, 'PICHON', 'Laurent', 'contact@devlawper.com', '$2y$10$N8tAjjKlLYPNM/P40IPl5.qlhxw9VhPhs.9PpzjOWJ7YCVmbbucAm', 1),
(13, 'DURAND', 'Pierre', 'pierredurand@gmail.com', '$2y$10$khmwkD1WsSGaYVD57N0TC.b8yK8Lf2xvPfWBNnwtu.uTgC4RB6o8u', 2),
(14, 'DUPONT', 'Jean', 'jeandupont@gmail.com', '$2y$10$ZoT549taJ3ikikq0lseCoOlQa.94XH6Q0qMY0A/o5cuSB60FsvyH.', 2),
(17, 'FRERO', 'Nicolas', 'nicolasfrero@gmail.com', '$2y$10$P2oIfyJBOGB7n.iQskufzO4A06Lu7.4Skr9raV02hL2Bz3i1uTGq.', 2),
(18, 'BONNET', 'Matthieu', 'matthieubonnet@gmail.com', '$2y$10$Qw6sxKDKWjDlup5Jv1YCsuYbJNcS82nyqw1JmdqSO5RpN4A0rDDd6', 3),
(20, 'BALLART', 'Jerome', 'jeromeballart@gmail.com', '$2y$10$XV83PVeNEUtzPWoceOtCMePbGQembru7btTwh/./If.c833n5Xy0W', 3),
(21, 'BARDAL', 'Sébastien', 'sebastienbardal@gmail.com', '$2y$10$/T14fAWPAziVGGLR03tfRe4qb7/o884y/.Esb577ifz/K0Qn.d3gW', 3),
(22, 'FORET', 'Daniel', 'danielforet@gmail.com', '$2y$10$MsUqmWQihbWAqg0ZNrztSOGx5pRCu/DKhfwHwNyieTGBCwaCTiFru', 3);

-- --------------------------------------------------------

--
-- Structure de la table `gm_vehicules`
--

DROP TABLE IF EXISTS `gm_vehicules`;
CREATE TABLE IF NOT EXISTS `gm_vehicules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(150) NOT NULL,
  `marque` varchar(50) NOT NULL,
  `modele` varchar(50) NOT NULL,
  `date_achat` date NOT NULL,
  `probleme` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gm_vehicules`
--

INSERT INTO `gm_vehicules` (`id`, `type`, `marque`, `modele`, `date_achat`, `probleme`) VALUES
(4, 'vp', 'Ford', 'Focus', '2019-05-01', NULL),
(5, 'vp', 'Ford', 'Fiesta', '2019-02-15', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `gm_maintenance`
--
ALTER TABLE `gm_maintenance`
  ADD CONSTRAINT `gm_maintenance_ibfk_1` FOREIGN KEY (`vehicule_id`) REFERENCES `gm_vehicules` (`id`);

--
-- Contraintes pour la table `gm_notes`
--
ALTER TABLE `gm_notes`
  ADD CONSTRAINT `gm_notes_ibfk_1` FOREIGN KEY (`maintenance_id`) REFERENCES `gm_maintenance` (`id`),
  ADD CONSTRAINT `gm_notes_ibfk_2` FOREIGN KEY (`tech_id`) REFERENCES `gm_users` (`id`);

--
-- Contraintes pour la table `gm_photos`
--
ALTER TABLE `gm_photos`
  ADD CONSTRAINT `gm_photos_ibfk_1` FOREIGN KEY (`maintenance_id`) REFERENCES `gm_maintenance` (`id`);

--
-- Contraintes pour la table `gm_pieces`
--
ALTER TABLE `gm_pieces`
  ADD CONSTRAINT `gm_pieces_ibfk_1` FOREIGN KEY (`maintenance_id`) REFERENCES `gm_maintenance` (`id`);

--
-- Contraintes pour la table `gm_users`
--
ALTER TABLE `gm_users`
  ADD CONSTRAINT `gm_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `gm_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
