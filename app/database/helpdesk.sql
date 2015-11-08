-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 08 Novembre 2015 à 16:55
-- Version du serveur :  5.6.26
-- Version de PHP :  5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `helpdesk`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `idCategorie` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`, `idCategorie`) VALUES
(1, 'Réseau', NULL),
(2, 'Routage', 1),
(3, 'Serveurs', 1),
(4, 'Poste de travail', NULL),
(8, 'Système', NULL),
(9, 'Logiciels', NULL),
(10, 'Assistance', NULL),
(11, 'Helpdesk', 10),
(12, 'Identité et droits d''accès', 10);

-- --------------------------------------------------------

--
-- Structure de la table `custom`
--

CREATE TABLE IF NOT EXISTS `custom` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `affiche` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idCategorie` int(11) DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  `version` varchar(20) NOT NULL DEFAULT '1.0',
  `popularity` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `faq`
--

INSERT INTO `faq` (`id`, `titre`, `contenu`, `dateCreation`, `idCategorie`, `idUser`, `version`, `popularity`) VALUES
(2, 'À quoi sert le HelpDesk ?', '<p>Le HelpDesk correspond au projet 2 &laquo; &Eacute;volution de l&#39;outil d&#39;assistance &raquo; du programme 6 &laquo; Accompagner la consolidation et la transformation de la fonction SI au sein de notre &eacute;tablissement &raquo;. L&#39;un des objectifs strat&eacute;giques &agrave; l&#39;origine du projet est d&#39;homog&eacute;n&eacute;iser la prestation d&#39;assistance sur tous les sites et pour tous les usagers afin d&#39;offrir un niveau de service &eacute;quitablement accessible. En termes op&eacute;rationnels, l&#39;outil d&eacute;velopp&eacute; permet de disposer d&rsquo;un guichet d&rsquo;assistance unique, de mettre en &oelig;uvre des outils et des proc&eacute;dures communes et d&#39;identifier les probl&egrave;mes redondants. Du point de vue de l&#39;usager, il apporte l&#39;assurance d&#39;un enregistrement formel des demandes et des fonctionnalit&eacute;s d&#39;information et de suivi syst&eacute;matiques. test</p>\r\n', '2015-10-22 23:15:39', 11, 1, '1.0', 5),
(3, 'Procédure de changement de mot de passe', '<h2>Objet</h2>\r\n\r\n<p>Cette proc&eacute;dure a pour but de fournir des conseils et des recommandations pour la cr&eacute;ation d&#39;un mot de passe fort.</p>\r\n\r\n<h2>Domaine d&#39;application</h2>\r\n\r\n<p>Cette proc&eacute;dure s&#39;adresse &agrave; tous les utilisateurs disposant d&#39;un compte d&#39;acc&egrave;s au syst&egrave;me d&#39;information</p>\r\n\r\n<h2>Descriptif</h2>\r\n\r\n<h3>Pr&eacute;-requis :</h3>\r\n\r\n<p>Un bon mot de passe est un mot de passe suffisamment long, facile &agrave; retenir et tr&egrave;s difficile &agrave; deviner. Votre mot de passse doit &ecirc;tre constitu&eacute; d&#39;au moins 8 caract&egrave;res dont une majuscule et un chiffre. Il peut contenir des lettres non accentu&eacute;es, des chiffres, et certains caract&egrave;res sp&eacute;ciaux : _ ! @ # $ % - + = &lt; &gt; ( ) { } [ ] | : ; , . ? ~ &amp;</p>\r\n\r\n<h3>Quelques proc&eacute;d&eacute;s ou comment faire ?</h3>\r\n\r\n<ul>\r\n	<li>Accoler mots et chiffres : Faire3Pas</li>\r\n	<li>Cr&eacute;er un r&eacute;bus : 71fame3MAIC&amp;O (c&#39;est un fameux 3 m&acirc;ts Hisse et Ho)</li>\r\n	<li>Pensez &agrave; une chanson ou un po&egrave;me et extrayez les premi&egrave;res lettres : ottoc4ocR! (one, two, three, o&#39;clock, four o&#39;clock, rock !)</li>\r\n	<li>Choisissez un mot de passe en y ins&eacute;rant des caract&egrave;res sp&eacute;ciaux g1M2p#DUtI1 (j&#39;ai un mot de passe diff&eacute;rent du tien)</li>\r\n	<li>Ne pas utiliser de mot de passe ayant un rapport avec soi (noms, dates de naissance,..)</li>\r\n	<li>Vous avez tout int&eacute;r&ecirc;t &agrave; m&eacute;langer les possibilit&eacute;s offertes : lettres, chiffres et caract&egrave;res sp&eacute;ciaux.</li>\r\n</ul>\r\n\r\n<h3>Respectez les r&egrave;gles</h3>\r\n\r\n<p>Vous &ecirc;tes responsable de l&#39;usage qui est fait de votre compte d&#39;acc&egrave;s au syst&egrave;me d&#39;information. Pour garantir la s&eacute;curit&eacute; de votre mot de passe, nous vous invitons &agrave; suivre les conseils ci-dessous:</p>\r\n\r\n<ul>\r\n	<li>Ne le communiquez &agrave; personne (il garantit votre identit&eacute; et vous identifie personnellement dans notre syst&egrave;me d&#39;information</li>\r\n	<li>Ne le notez pas sur un post-it</li>\r\n	<li>Verrouillez ou fermez syst&eacute;matiquement votre session en quittant votre poste de travail</li>\r\n	<li>Changez-le r&eacute;guli&egrave;rement</li>\r\n	<li>N&#39;utilisez pas le mot de passe de votre compte d&#39;acc&egrave;s au syst&egrave;me d&#39;information pour un autre compte</li>\r\n</ul>\r\n', '2015-10-22 23:31:32', 12, 1, '1.0', 22),
(9, 'rzaea', '<p>salut1</p>\r\n', '2015-10-22 23:24:09', 4, 1, '1.0', 0),
(10, 'salut', '<p>raz</p>\r\n', '2015-10-27 12:22:33', 10, 1, '1.0', 0),
(11, 'ezae', '<p>razr</p>\r\n', '2015-10-30 14:59:20', 4, 1, '1.0', 0),
(12, 'ezae', '<p>razr</p>\r\n', '2015-10-30 15:12:34', 4, 1, '1.0', 0),
(13, 'aaaaaaaaaa', '<p>a</p>\r\n', '2015-11-08 00:20:47', 3, 2, '1.0', 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idUser` int(11) NOT NULL,
  `idTicket` int(11) NOT NULL,
  `lu` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `contenu`, `date`, `idUser`, `idTicket`, `lu`) VALUES
(99, '<p>Bonjour</p>\r\n', '2015-11-03 12:58:57', 1, 37, 1),
(100, '<p>ezaezaee</p>\r\n', '2015-11-07 22:34:16', 1, 37, 1),
(101, '<p>eaze</p>\r\n', '2015-11-07 22:36:45', 1, 37, 1),
(104, '<p>123</p>\r\n', '2015-11-07 22:49:44', 1, 40, 1),
(105, 'Une modification à été effectué sur ce ticket (concernant le statut ou le titre)', '2015-11-07 22:50:02', 1, 40, 1),
(106, 'Une modification à été effectué sur ce ticket (concernant le statut ou le titre)', '2015-11-07 23:36:39', 1, 38, 0),
(107, 'Une modification à été effectué sur ce ticket (concernant le statut ou le titre)', '2015-11-07 23:39:09', 1, 38, 0),
(108, 'Une modification à été effectué sur ce ticket (concernant le statut ou le titre)', '2015-11-07 23:39:37', 1, 38, 0),
(109, 'Une modification à été effectué sur ce ticket (concernant le statut ou le titre)', '2015-11-07 23:39:52', 1, 38, 0),
(110, 'Une modification à été effectué sur ce ticket (concernant le statut ou le titre)', '2015-11-08 00:35:38', 1, 40, 1),
(112, 'Une modification à été effectué sur ce ticket (concernant le statut ou le titre)', '2015-11-08 00:38:36', 1, 40, 1),
(113, 'Une modification à été effectué sur ce ticket (concernant le statut ou le titre)', '2015-11-08 00:40:02', 1, 40, 1),
(114, 'Une modification à été effectué sur ce ticket (concernant le statut ou le titre)', '2015-11-08 00:41:15', 1, 38, 0),
(115, 'Une modification à été effectué sur ce ticket (concernant le statut ou le titre)', '2015-11-08 00:47:27', 1, 38, 0);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idTicket` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `notification`
--

INSERT INTO `notification` (`id`, `idUser`, `idTicket`, `date`) VALUES
(7, 1, 38, '2015-11-07 23:36:40'),
(8, 1, 38, '2015-11-07 23:39:09'),
(9, 1, 38, '2015-11-07 23:39:37'),
(10, 1, 38, '2015-11-07 23:39:53'),
(15, 1, 38, '2015-11-08 00:41:15'),
(16, 1, 38, '2015-11-08 00:47:27');

-- --------------------------------------------------------

--
-- Structure de la table `rang`
--

CREATE TABLE IF NOT EXISTS `rang` (
  `id` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `rang`
--

INSERT INTO `rang` (`id`, `libelle`) VALUES
(1, 'Administrateur'),
(2, 'Technicien'),
(3, 'Utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE IF NOT EXISTS `statut` (
  `id` int(11) NOT NULL,
  `libelle` varchar(30) NOT NULL,
  `ordre` int(11) NOT NULL,
  `icon` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `statut`
--

INSERT INTO `statut` (`id`, `libelle`, `ordre`, `icon`) VALUES
(1, 'Nouveau', 0, 'flag'),
(2, 'Attribué', 1, 'User'),
(3, 'En attente', 2, 'hourglass'),
(4, 'Résolu', 3, 'check'),
(5, 'Clos', 5, 'off');

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL,
  `type` set('demande','incident') NOT NULL DEFAULT 'demande',
  `idCategorie` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `idStatut` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `attribuer` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ticket`
--

INSERT INTO `ticket` (`id`, `type`, `idCategorie`, `titre`, `description`, `idStatut`, `idUser`, `dateCreation`, `attribuer`) VALUES
(37, '', 2, 'Ticket user modif', '<p>ezaeaze</p>\r\n', 3, 2, '2015-10-31 21:07:47', 1),
(38, '', 2, 'dsqd', '<p>dsqdsq</p>\r\n', 3, 1, '2015-11-07 22:31:37', 1),
(40, '', 4, 'ezae', '<p>rzaraz</p>\r\n', 1, 2, '2015-11-07 22:48:16', 3),
(45, '', 2, 'auyio', '<p>rrs</p>\r\n', 3, 1, '2015-11-08 00:54:34', NULL),
(50, '', 8, 'zer', '<p>zerrz</p>\r\n', 1, 1, '2015-11-08 01:00:30', NULL),
(51, '', 4, 'ezae', '<p>ezae</p>\r\n', 1, 6, '2015-11-08 15:50:45', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `idRang` int(11) NOT NULL,
  `notifie` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `mail`, `idRang`, `notifie`) VALUES
(1, 'admin', '$2y$10$JcCy2P.RgdBfS2St4kb/L.uiAD26zQ5nUxD0JVEDIFxb3/gmabaM2', 'adminz@local.fr', 1, 1),
(2, 'user', '$2y$10$CERtFz627gtB6ASB6kCK1uPQpetwrQYLZScMlAAkyXmyEtcbbTgMC', 'user1@local.fr', 3, 1),
(3, 'autreUser', '$2y$10$r9kagO0vE9O7bR0fBtWJd.2/xVjQRmlgx1FDkfwm0L4uscJ6KGI0u', 'autreUser@local.fr', 2, 0),
(4, 'moi', '$2y$10$JPJ/vmUL9nPFVUtkZZXywOo95fJe54F3LTQoaYAnT4PCmLdA3n/1m', 'moi@local.fr', 2, 0),
(5, 'pomme', '$2y$10$m8FvAmVSBf2qxAsqe8kSpu7l1s7l7cuvaIzxIJV2GSGpVtFGZDlaG', 'pomme@pomme.fr', 3, 0),
(6, 'tech', '$2y$10$kzeangy4vGfLN9AjUOKxLOraxxSx5PvuF5ZOTygvGG9UyhgA5bHx2', 'tech@yopmail.com', 2, 0),
(9, 'yolo', '$2y$10$UgiYi9yIOYEJov9fhVw32Oo./WZGHg.B3LxDKJyLUaWwLpK6PvBHi', 'yoloswag@zae.fr', 3, 0),
(10, 'ezar', '$2y$10$3sCtB..3eIJCYQ.8FrwgCedx9iwNTOO7BP62La6FnPbx61NOcSeDW', 'yoloswag@zaae.fr', 1, 0),
(11, 'eazeaze', '$2y$10$i3xU3rr7wfWqMzNRxI7OeO1DY2ptdgZKAM9FgU4sXyXqQFID6twuq', 'ezaeazea@aeaz.fr', 3, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCategorie` (`idCategorie`);

--
-- Index pour la table `custom`
--
ALTER TABLE `custom`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCategorie` (`idCategorie`,`idUser`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idTicket` (`idTicket`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_User` (`idUser`),
  ADD KEY `fk_Ticket` (`idTicket`);

--
-- Index pour la table `rang`
--
ALTER TABLE `rang`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCategorie` (`idCategorie`),
  ADD KEY `idStatut` (`idStatut`,`idUser`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `fk_attribuer` (`attribuer`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `fk_rang` (`idRang`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `custom`
--
ALTER TABLE `custom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `rang`
--
ALTER TABLE `rang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `Categorie_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `Faq_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Faq_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Message_ibfk_2` FOREIGN KEY (`idTicket`) REFERENCES `ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_Ticket` FOREIGN KEY (`idTicket`) REFERENCES `ticket` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_User` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `Ticket_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ticket_ibfk_2` FOREIGN KEY (`idStatut`) REFERENCES `statut` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Ticket_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_attribuer` FOREIGN KEY (`attribuer`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_rang` FOREIGN KEY (`idRang`) REFERENCES `rang` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
