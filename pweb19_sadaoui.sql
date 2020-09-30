-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 18 nov. 2019 à 14:28
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pweb19_sadaoui`
--

-- --------------------------------------------------------

--
-- Structure de la table `bilan`
--

DROP TABLE IF EXISTS `bilan`;
CREATE TABLE IF NOT EXISTS `bilan` (
  `id_bilan` int(11) NOT NULL AUTO_INCREMENT,
  `id_test` int(11) NOT NULL,
  `id_etu` int(11) NOT NULL,
  `note_test` int(11) NOT NULL,
  `date_bilan` date NOT NULL,
  PRIMARY KEY (`id_bilan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `bilan`
--

INSERT INTO `bilan` (`id_bilan`, `id_test`, `id_etu`, `note_test`, `date_bilan`) VALUES
(1, 2, 1, 15, '2019-11-08'),
(2, 2, 2, 20, '2019-11-20');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id_etu` int(11) NOT NULL AUTO_INCREMENT,
  `genre` text COLLATE utf8_bin NOT NULL,
  `nom` text COLLATE utf8_bin NOT NULL,
  `prenom` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `login_etu` text COLLATE utf8_bin NOT NULL,
  `pass_etu` text COLLATE utf8_bin NOT NULL,
  `matricule` text COLLATE utf8_bin NOT NULL,
  `num_grpe` text COLLATE utf8_bin NOT NULL,
  `date_etu` date NOT NULL,
  `bConnect` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_etu`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etu`, `genre`, `nom`, `prenom`, `email`, `login_etu`, `pass_etu`, `matricule`, `num_grpe`, `date_etu`, `bConnect`) VALUES
(1, 'M.', 'Tor', 'Michael', 'michael.tor@etu.parisdescartes.fr', 'tor', 'tor', '22701007', '203', '2017-09-01', 0),
(2, 'M.', 'Moustache', 'Félix', 'felix.moustache@etu.parisdescartes.fr', 'moustach', '', '22701011', '207', '2017-09-01', 1),
(3, 'M.', 'Nguyen', 'Rémi', 'paule.nguyen@etuparisdescartes.fr', 'nguyen1', '2aaaaaaa', '22701012', '208', '2017-09-01', 0),
(4, 'Melle.', 'Nguyen', 'Paule', 'paule.nguyen@etuparisdescartes.fr', 'nguyen2', '2aaaaaaa', '22701027', '208', '2017-09-01', 0),
(5, 'Melle.', 'Leroux', 'Clara', 'claraleroux2010@gmail.com', 'leroux', 'clara78', '12345678', '206', '2000-08-03', 0);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id_grpe` int(11) NOT NULL,
  `num_grpe` int(11) NOT NULL,
  PRIMARY KEY (`id_grpe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id_grpe`, `num_grpe`) VALUES
(0, 201),
(1, 202),
(2, 203),
(3, 204),
(4, 205),
(5, 206),
(6, 207);

-- --------------------------------------------------------

--
-- Structure de la table `grpetudiants`
--

DROP TABLE IF EXISTS `grpetudiants`;
CREATE TABLE IF NOT EXISTS `grpetudiants` (
  `id_grpe` int(11) NOT NULL,
  `id_etu` int(11) NOT NULL,
  PRIMARY KEY (`id_grpe`,`id_etu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `grpetudiants`
--

INSERT INTO `grpetudiants` (`id_grpe`, `id_etu`) VALUES
(0, 0),
(1, 1),
(2, 2),
(3, 3),
(4, 0),
(4, 1),
(5, 2),
(5, 3),
(6, 0),
(6, 1),
(6, 2),
(6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `id_prof` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_bin NOT NULL,
  `prenom` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `login_prof` text COLLATE utf8_bin NOT NULL,
  `pass_prof` text COLLATE utf8_bin NOT NULL,
  `date_prof` date NOT NULL,
  `bConnect` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_prof`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`id_prof`, `nom`, `prenom`, `email`, `login_prof`, `pass_prof`, `date_prof`, `bConnect`) VALUES
(1, 'FOUGHALI', 'Karim', 'kfoughali@parisdescartes.fr', 'foughali', 'foughali', '1965-10-09', 0),
(2, 'CARATY', 'Marie-Jo', 'mjcaraty@parisdescartes.fr', 'caraty', 'cara', '1966-10-01', 0),
(3, 'DARCHE', 'Philippe', 'pdarche@parisdescartes.fr', 'darche', 'isi', '1962-04-05', 1),
(4, 'ILLIE', 'Jean-Michel', 'jmillie@parisdescartes.fr', 'illie', 'pweb', '1960-05-21', 0),
(5, 'OLIVIERO', 'Philippe', 'poliviero@parisdescartes.fr', 'oliviero', 'com', '1959-12-02', 0),
(6, 'FOUILLEUL', 'Nina', 'nfouilleul@parisdescartes.fr', 'fouilleul', 'anglais', '1972-11-01', 0);

-- --------------------------------------------------------

--
-- Structure de la table `qcm`
--

DROP TABLE IF EXISTS `qcm`;
CREATE TABLE IF NOT EXISTS `qcm` (
  `id_qcm` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `id_quest` int(11) NOT NULL,
  `bAutorise` tinyint(1) NOT NULL,
  `bBloque` tinyint(1) NOT NULL,
  `bAnnule` int(11) NOT NULL,
  PRIMARY KEY (`id_qcm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `qcm`
--

INSERT INTO `qcm` (`id_qcm`, `id_test`, `id_quest`, `bAutorise`, `bBloque`, `bAnnule`) VALUES
(1, 1, 1, 1, 0, 0),
(2, 13, 1, 1, 1, 0),
(3, 14, 3, 0, 1, 0),
(4, 1, 4, 0, 0, 0),
(5, 2, 5, 1, 0, 0),
(8, 1, 8, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id_quest` int(11) NOT NULL AUTO_INCREMENT,
  `id_theme` int(11) NOT NULL,
  `titre` text COLLATE utf8_bin NOT NULL,
  `texte` text COLLATE utf8_bin NOT NULL,
  `bmultiple` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_quest`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id_quest`, `id_theme`, `titre`, `texte`, `bmultiple`) VALUES
(1, 1, 'PWEB', 'Que veut dire MVC ?', 0),
(2, 4, 'Maths', '1*2=', 0),
(3, 3, 'Informatique générale', 'Le cerveau de tout système informatique est :', 0),
(4, 3, 'Informatique générale', 'Le système binaire utilise la base : ', 0),
(5, 3, 'Informatique générale', 'Laquelle de ces mémoires est non-volatile ?', 0),
(6, 2, 'AAV', 'Quel language?', 0),
(7, 4, 'Maths', '2*2=', 1),
(8, 1, 'PWEB', 'Quelle organisation définit les standards Web?', 0),
(9, 1, 'PWEB', 'HTML utilise des ______?', 0),
(10, 2, 'Java', 'Lequel des éléments suivants n’est pas un concept POO en Java?', 0),
(11, 2, 'Java', 'Quels keywords sont utilisés pour spécifier la visibilité des propriétés et des méthodes ?', 1),
(12, 4, 'Probabilités', 'Charlotte a obtenu trois fois un 5 en jetant un dé à 6 faces. La probabilité d obtenir 5 en jetant le dé à nouveau est :', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id_rep` int(11) NOT NULL AUTO_INCREMENT,
  `id_quest` int(11) NOT NULL,
  `texte_rep` text COLLATE utf8_bin NOT NULL,
  `bvalide` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_rep`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id_rep`, `id_quest`, `texte_rep`, `bvalide`) VALUES
(1, 1, 'Modèle Contrôle Vue', 1),
(2, 1, 'Modélisation Conception Vue', 0),
(3, 1, 'Modélisation Contrôle Vérification', 0),
(4, 2, '1', 0),
(5, 2, '2', 1),
(6, 2, '2.1', 0),
(7, 3, 'Unité de contrôle', 0),
(8, 3, 'CPU', 1),
(9, 3, 'Mémoire', 0),
(10, 4, '1', 0),
(11, 4, '2', 1),
(12, 4, '10', 0),
(13, 5, 'SRAM', 0),
(14, 5, 'DRAM', 0),
(15, 5, 'ROM', 1),
(16, 6, 'c++', 0),
(17, 6, 'html', 0),
(18, 6, 'java', 1),
(19, 7, '2', 0),
(20, 7, '4', 1),
(21, 7, '2^2', 0),
(22, 8, 'IBM Corporation', 0),
(23, 8, 'World Wide Web Consortium', 1),
(24, 8, 'Microsoft Corporation', 0),
(25, 9, 'Balises définis par l’utilisateur', 0),
(26, 9, 'Balises fixes définis par le langage', 1),
(27, 9, 'Balises prédéfinis', 0),
(28, 10, 'Compilation', 1),
(29, 10, 'Héritage', 0),
(30, 10, 'Polymorphisme', 0),
(31, 11, 'final', 0),
(32, 11, 'protected', 1),
(33, 11, 'public', 1);

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

DROP TABLE IF EXISTS `resultat`;
CREATE TABLE IF NOT EXISTS `resultat` (
  `id_res` int(11) NOT NULL AUTO_INCREMENT,
  `id_test` int(11) NOT NULL,
  `id_etu` int(11) NOT NULL,
  `id_quest` int(11) NOT NULL,
  `date_res` date NOT NULL,
  `id_rep` int(11) NOT NULL,
  PRIMARY KEY (`id_res`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `resultat`
--

INSERT INTO `resultat` (`id_res`, `id_test`, `id_etu`, `id_quest`, `date_res`, `id_rep`) VALUES
(1, 1, 2, 1, '2017-10-17', 1),
(2, 1, 2, 8, '2018-12-12', 23);

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id_test` int(11) NOT NULL AUTO_INCREMENT,
  `id_prof` int(11) NOT NULL,
  `num_grpe` text COLLATE utf8_bin NOT NULL,
  `titre_test` text COLLATE utf8_bin NOT NULL,
  `date_test` date NOT NULL,
  `bActif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_test`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `test`
--

INSERT INTO `test` (`id_test`, `id_prof`, `num_grpe`, `titre_test`, `date_test`, `bActif`) VALUES
(1, 2, '203', 'Test de PWEB niveau 1', '0000-00-00', 0),
(2, 1, '206', 'Test Septembre', '2019-09-01', 1),
(5, 1, '207', 'Test Octobre', '2019-10-01', 0),
(6, 1, '208', 'Test Novembre', '2019-11-01', 0),
(10, 1, '202', 'Test Décembre', '2019-12-01', 0),
(11, 1, '201', 'Test Janvier', '2020-01-01', 0),
(13, 1, '203', 'Test Février', '2020-02-01', 0),
(14, 1, '204', 'Test Mars', '2020-03-01', 1),
(15, 2, '206', 'Test Exemple', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id_theme` int(11) NOT NULL AUTO_INCREMENT,
  `titre_theme` text COLLATE utf8_bin NOT NULL,
  `desc_theme` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_theme`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id_theme`, `titre_theme`, `desc_theme`) VALUES
(1, 'PWEB', 'Connaissance du cours'),
(2, 'Programmation en Java', 'Connaissance théorique'),
(3, 'Informatique générale', 'Connaissances générales'),
(4, 'Mathématiques', 'Connaissances du cours et calculs'),
(5, 'PSE', 'Connaissances du cours et calculs'),
(6, 'CDIN', 'Connaissances du cours et calculs');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
