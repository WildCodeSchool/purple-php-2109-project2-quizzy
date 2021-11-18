-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 03 nov. 2021 à 09:19
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quizzy`
--

-- --------------------------------------------------------

--
-- Structure de la table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `id_question` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_question` (`id_question`)
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `answer`
--

INSERT INTO `answer` (`id`, `title`, `is_correct`, `id_question`) VALUES
(1, 'Vin', 0, 1),
(2, 'Pain', 0, 1),
(3, 'Hamburger', 0, 1),
(4, 'Miel', 1, 1),
(5, 'Au chalumeau', 0, 2),
(6, 'Avec un fil', 1, 2),
(7, 'A la pince', 1, 2),
(8, 'A la glue', 0, 2),
(9, 'Le French Tocard', 0, 3),
(10, 'Le Top Gourmet', 0, 3),
(11, 'Monsieur Paul', 1, 3),
(12, 'La Poêle de Fer', 0, 3),
(13, 'De l\'agar agar', 0, 4),
(14, 'Des arêtes bouillies', 1, 4),
(15, 'De la pectine', 0, 4),
(16, 'De la maïzena', 0, 4),
(17, 'Link', 0, 5),
(18, 'Peach', 0, 5),
(19, 'Zelda', 1, 5),
(20, 'Jade', 0, 5),
(21, '15', 1, 6),
(22, '16', 0, 6),
(23, '14', 0, 6),
(24, '17', 0, 6),
(25, 'Citrouille', 0, 7),
(26, 'Butternut', 0, 7),
(27, 'Courge', 0, 7),
(28, 'Potiron', 1, 7),
(29, 'L\'Allemagne', 1, 8),
(30, 'La Bosnie', 0, 8),
(31, 'La République Tchèque', 0, 8),
(32, 'La Serbie', 1, 8),
(33, '1960', 0, 9),
(34, '1965', 1, 9),
(35, '1970', 0, 9),
(36, '1975', 0, 9),
(37, 'Tranchante', 0, 10),
(38, 'Pique', 0, 10),
(39, 'Vengeuse', 0, 10),
(40, 'Aiguille', 1, 10),
(41, 'Le lion et la souris', 0, 11),
(42, 'Le chat et le corbeau', 0, 11),
(43, 'Le coq et la perle', 1, 11),
(44, 'La besace', 1, 11),
(45, 'Charles Trenet', 1, 12),
(46, 'Michel Sardou', 0, 12),
(47, 'Claude François', 0, 12),
(48, 'Matt Pokora', 0, 12),
(49, 'Bourg Palette', 1, 13),
(50, 'Carmin sur Mer', 0, 13),
(51, 'Cramois\'île', 0, 13),
(52, 'Lavanville', 0, 13),
(53, 'Rouge ', 0, 14),
(54, 'Jaune', 1, 14),
(55, 'Bleu', 1, 14),
(56, 'Vert', 0, 14),
(57, 'Descendre aux Enfers et enchaîner Cerbère', 0, 15),
(58, 'Retrouver la tablette d\'argent de la maison de la folie', 1, 15),
(59, 'Nettoyer les écuries d\'Augias', 0, 15),
(60, 'Rapporter les pommes d\'or du jardin des Hespérides', 0, 15),
(61, 'Vente d\'alcool illégale', 0, 16),
(62, 'Corruption de politique', 0, 16),
(63, 'Faux permis de construire', 0, 16),
(64, 'Fraude fiscal', 1, 16),
(65, 'Arthur', 0, 17),
(66, 'Alain Chabat', 0, 17),
(67, 'Bruno Solo', 0, 17),
(68, 'Alexandre Astier', 1, 17),
(69, 'Harry Potter', 1, 18),
(70, 'Le seigneur des anneaux', 0, 18),
(71, 'Star Wars', 0, 18),
(72, 'Watchmen', 0, 18),
(73, 'Harry Potter', 0, 19),
(74, 'Le seigneur des anneaux', 1, 19),
(75, 'Star Wars', 0, 19),
(76, 'Watchmen', 0, 19),
(77, 'Harry Potter', 0, 20),
(78, 'Le seigneur des anneaux', 0, 20),
(79, 'Star Wars', 1, 20),
(80, 'Watchmen', 0, 20),
(81, 'Harry Potter', 0, 21),
(82, 'Le seigneur des anneaux', 0, 21),
(83, 'Star Wars', 0, 21),
(84, 'Watchmen', 1, 21),
(85, 'Pénélope', 1, 22),
(86, 'Circé', 0, 22),
(87, 'Calypso', 0, 22),
(88, 'Scylla', 0, 22),
(89, '5 minutes', 1, 23),
(90, '10 minutes', 0, 23),
(91, '15 minutes', 0, 23),
(92, '20 minutes', 0, 23),
(93, 'Nutdealer', 0, 24),
(94, 'Tundra Eel', 0, 24),
(95, 'Deltarune', 1, 24),
(96, 'Elderaunt', 0, 24),
(97, 'Jane Austen', 0, 25),
(98, 'Emily Brontë', 1, 25),
(99, 'Charlotte Brontë', 0, 25),
(100, 'Ann Radcliffe', 0, 25),
(101, 'J.R.R. Tolkien', 0, 26),
(102, 'Neil Gaiman', 0, 26),
(103, 'Terry Pratchett', 1, 26),
(104, 'George R. Martin', 0, 26),
(105, 'Won', 1, 27),
(106, 'Yen', 0, 27),
(107, 'Kim', 0, 27),
(108, 'Seung', 0, 27),
(109, 'Grazie', 0, 28),
(110, 'Gràcies', 0, 28),
(111, 'Gracias', 1, 28),
(112, 'Grazas', 0, 28),
(113, 'Venezuela', 0, 29),
(114, 'Nigeria', 0, 29),
(115, 'Timor oriental', 1, 29),
(116, 'Angola', 1, 29),
(117, '6', 1, 30),
(118, '9', 0, 30),
(119, '12', 0, 30),
(120, '18', 0, 30),
(121, 'Landes', 0, 31),
(122, 'Mayenne', 0, 31),
(123, 'Gironde', 1, 31),
(124, 'Ardèche', 0, 31),
(125, '12', 0, 32),
(126, '40', 1, 32),
(127, '1000', 0, 32),
(128, '10000', 0, 32),
(129, '13', 1, 33),
(130, '25', 0, 33),
(131, '32', 0, 33),
(132, '33', 0, 33),
(133, '1', 0, 34),
(134, '10', 1, 34),
(135, '12', 0, 34),
(136, '100', 0, 34),
(137, 'Gai', 1, 35),
(138, 'Bouleversé', 0, 35),
(139, 'Désolé', 0, 35),
(140, 'Navré', 0, 35),
(141, '1 an', 0, 36),
(142, '1 an et demi', 1, 36),
(143, '2 ans', 0, 36),
(144, '3 ans', 0, 36),
(145, '90°', 0, 37),
(146, '180°', 1, 37),
(147, '360°', 0, 37),
(148, '720°', 0, 37),
(149, 'Connaîtrait', 0, 38),
(150, 'Connaîtriont', 0, 38),
(151, 'Aurez connu', 0, 38),
(152, 'Connaîtra', 1, 38),
(153, 'Estonie', 0, 39),
(154, 'Lettonie', 0, 39),
(155, 'Hongrie', 0, 39),
(156, 'Russie', 1, 39);

-- --------------------------------------------------------

--
-- Structure de la table `goodanswer`
--

DROP TABLE IF EXISTS `goodanswer`;
CREATE TABLE IF NOT EXISTS `goodanswer` (
  `id_user` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  KEY `id_user` (`id_user`),
  KEY `id_question` (`id_question`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `title`) VALUES
(1, 'Stuff'),
(3, 'jkdbnfkjb');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `timelimit` tinyint(4) DEFAULT NULL,
  `explanation` text,
  `is_admitted` tinyint(1) DEFAULT NULL,
  `id_theme` int(11) DEFAULT NULL,
  `id_author` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_theme` (`id_theme`),
  KEY `id_author` (`id_author`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `title`, `timelimit`, `explanation`, `is_admitted`, `id_theme`, `id_author`) VALUES
(1, 'Quel est le seul aliment à ne pas pourrir ?', 60, NULL, 1, 1, NULL),
(2, 'Donne une bonne méthode d\'épilation ?', 60, NULL, 1, 1, NULL),
(3, 'Quel était le surnom le plus répandu de Paul Bocuse ?', 60, NULL, 1, 1, NULL),
(4, 'Qu\'utilisaient les recettes les plus anciennes de Panna Cotta à la place de la gélatine ?', 60, NULL, 1, 1, NULL),
(5, 'Comment s\'appelle la princesse du jeu Zelda ?', 60, NULL, 1, 1, NULL),
(6, 'Combien de saisons dure la série Urgences ?', 60, NULL, 1, 1, NULL),
(7, 'Comment s\'appelle l\'ami de Oui Oui ?', 60, NULL, 1, 1, NULL),
(8, 'Quel pays traverse le Danube ?', 60, NULL, 1, 1, NULL),
(9, 'En quelle année a été diffusé le premier épisode des Chiffres et des Lettres ?', 60, NULL, 1, 1, NULL),
(10, 'Comment s\'appelle l\'épée d\'Arya Stark dans Game of Thrones', 60, NULL, 1, 1, NULL),
(11, 'Quelle fable a été écrite par Jean de la Fontaine ?', 60, NULL, 1, 1, NULL),
(12, 'Qui n\'a pas chanté \"Comme d\'habitude\" ?', 60, NULL, 1, 1, NULL),
(13, 'Où vit Sacha de la franchise Pokémon ?', 60, NULL, 1, 1, NULL),
(14, 'Quelle couleur figure sur le drapeau du Kosovo ?', 60, NULL, 1, 1, NULL),
(15, 'Laquelle de ces tâches ne fait pas partie des douze travaux d\'Héraclès ?', 60, NULL, 1, 1, NULL),
(16, 'Pour quel crime Al Capone s\'est fait inculpé ?', 60, NULL, 1, 1, NULL),
(17, 'Qui est le réalisateur du film Kaamelott, qui joue aussi le roi Arthur ?', 60, NULL, 1, 1, NULL),
(18, 'Dans quelle franchise existent les moldus ?', 60, NULL, 1, 1, NULL),
(19, 'Dans quelle franchise existent les hobbits ?', 60, NULL, 1, 1, NULL),
(20, 'Dans quelle franchise existent les wookiees ?', 60, NULL, 1, 1, NULL),
(21, 'Dans quelle franchise un groupe a pour symbole un smiley ensanglanté.', 60, NULL, 1, 1, NULL),
(22, 'Qui est la femme d\'Ulysse, connue pour avoir fait semblant de coudre une toison ?', 60, NULL, 1, 1, NULL),
(23, 'Quel est le record du monde pour battre le jeu Super Mario Bros ?', 60, NULL, 1, 1, NULL),
(24, 'Quel est le nom de la \"suite\" du jeu d\'Undertale crée par Toby Fox ?', 60, NULL, 1, 1, NULL),
(25, 'Qui a écrit \"les Hauts de Hurlevent\" ?', 60, NULL, 1, 1, NULL),
(26, 'Qui a écrit \"Les annales du Disque Monde\" ?', 60, NULL, 1, 1, NULL),
(27, 'Comment se nomme la monnaie coréenne ?', 60, NULL, 1, 1, NULL),
(28, 'Comment dit-on merci en espagnol ?', 60, NULL, 1, 1, NULL),
(29, 'Quel pays se situe dans l\'hémisphère sud ?', 60, NULL, 1, 1, NULL),
(30, 'Quelle est la racine carrée de 36 ?', 60, NULL, 1, 1, NULL),
(31, 'Quel département français a pour chef-lieu Bordeaux ?', 60, NULL, 1, 1, NULL),
(32, 'Combien de voleurs accompagnaient Ali Baba ?', 60, NULL, 1, 1, NULL),
(33, 'Lequel de ces nombres est un nombre premier ?', 60, NULL, 1, 1, NULL),
(34, 'Combien d\'années compte-t-on dans une décennie ?', 60, NULL, 1, 1, NULL),
(35, 'Lequel de ces termes est synonyme de joyeux ?', 60, NULL, 1, 1, NULL),
(36, 'Quel âge a un enfant de 18 mois ?', 60, NULL, 1, 1, NULL),
(37, 'La somme des angles d\'un triangle est égale à ?', 60, NULL, 1, 1, NULL),
(38, 'Comment conjugue-t-on au futur le verbe connaître à la troisième personne du singulier ?', 60, NULL, 1, 1, NULL),
(39, 'Lequel de ces pays a une frontière commune avec la Pologne ?', 60, NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id`, `title`) VALUES
(1, 'Divers');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` VARCHAR(255),
  `is_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `is_admin`) VALUES
(1, 'Admin', '$2y$10$woU.SkWoX0S7pcRBhQ974O587ctF3I/BhhQ45O7aBL5h9xMZWLzQ6', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
