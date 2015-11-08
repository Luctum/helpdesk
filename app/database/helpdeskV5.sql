-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 07 Octobre 2015 à 11:33
-- Version du serveur :  5.5.39
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `helpdesk`
--
CREATE DATABASE IF NOT EXISTS `helpdesk` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `helpdesk`;

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE IF NOT EXISTS `Categorie` (
`id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `idCategorie` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `Categorie`
--

INSERT INTO `Categorie` (`id`, `libelle`, `idCategorie`) VALUES
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
-- Structure de la table `Faq`
--

CREATE TABLE IF NOT EXISTS `Faq` (
`id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idCategorie` int(11) DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  `version` varchar(20) NOT NULL DEFAULT '1.0',
  `popularity` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `Faq`
--

INSERT INTO `Faq` (`id`, `titre`, `contenu`, `dateCreation`, `idCategorie`, `idUser`, `version`, `popularity`) VALUES
(1, 'Comment formuler une demande à partir de l''interface web ?\r\n', 'L''adresse de l''application est https://...\r\n\r\nL''accès à l''interface web du HelpDesk requiert votre connexion sur le service d''authentification.  Une fois connecté, vous retrouverez tout ce qui concerne votre demande : groupe attributaire, technicien chargé du traitement, suivis, solution, …\r\n\r\nPour formuler une nouvelle demande, vous devez commencer par utiliser l''entrée du menu ou l''icône associée à « Créer un Ticket ».\r\n\r\nDans le formulaire qui vous est alors proposé, seuls trois champs sont obligatoires :\r\n\r\nCatégorie : elle permet l''attribution de votre demande au groupe concerné ;\r\nTitre : il est utilisé pour afficher l''ensemble des demandes, aussi veillez à ce qu''il soit concis, à la fois synthétique et précis\r\nDescription : faites figurer ici toutes les informations que vous jugerez utiles pour permettre le traitement de votre demande.  Des informations complémentaires pourront vous être demandées si nécessaire.\r\nLes autres champs, bien qu''optionnels, peuvent être utiles voire nécessaires au traitement de votre demande :\r\n\r\nType : Incident (par défaut) en cas de dysfonctionnement, ou simple demande\r\nUrgence : Elle est croisée avec l''impact évalué par le technicien pour définir la priorité utilisée pour trier l''ensemble des demandes.\r\nSuivi par courriel : Choisissez « Non » si vous ne souhaitez pas recevoir d''information concernant votre demande par mél.\r\nÉlement associé : Si nécessaire et s''il est automatiquement identifié, vous pourrez ici associer votre poste de travail ou l''un de ses logiciels à votre demande.\r\nFichier : À utiliser pour joindre un fichier à votre demande.\r\nUne fois le formulaire rempli, créer votre Ticket en cliquant sur le bouton « Envoyer Message ».  Un compte-rendu apparaît alors dans lequel figure le numéro associé à votre demande – le Ticket – que vous pourrez utiliser pour obtenir des informations a posteriori.', '2015-05-10 17:43:47', 11, 1, '1.0', 0),
(2, 'À quoi sert le HelpDesk ?\r\n', 'Le HelpDesk correspond au projet 2 « Évolution de l''outil d''assistance » du programme 6 « Accompagner la consolidation et la transformation de la fonction SI au sein de notre établissement ».\r\n\r\nL''un des objectifs stratégiques à l''origine du projet est d''homogénéiser la prestation d''assistance sur tous les sites et pour tous les usagers afin d''offrir un niveau de service équitablement accessible.\r\n\r\nEn termes opérationnels, l''outil développé permet de disposer d’un guichet d’assistance unique, de mettre en œuvre des outils et des procédures communes et d''identifier les problèmes redondants.\r\n\r\nDu point de vue de l''usager, il apporte l''assurance d''un enregistrement formel des demandes et des fonctionnalités d''information et de suivi systématiques.', '2015-05-14 10:43:57', 11, 1, '1.0', 5),
(3, 'Procédure de changement de mot de passe', '<h2>Objet</h2>\r\n\r\nCette procédure a pour but de fournir des conseils et des recommandations pour la création d''un mot de passe fort.\r\n\r\n<h2>Domaine d''application</h2>\r\n\r\nCette procédure s''adresse à tous les utilisateurs disposant d''un compte d''accès au système d''information\r\n\r\n<h2>Descriptif</h2>\r\n\r\n<h3>Pré-requis :</h3>\r\n\r\nUn bon mot de passe est un mot de passe suffisamment long, facile à retenir et très difficile à deviner. Votre mot de passse doit être constitué d''au moins 8 caractères dont une majuscule et un chiffre. Il peut contenir des lettres non accentuées, des chiffres, et certains caractères spéciaux : _ ! @ # $ % - + = < > ( ) { } [ ] | : ; , . ? ~ &\r\n\r\n<h3>Quelques procédés ou comment faire ?</h3>\r\n<ul>\r\n<li>Accoler mots et chiffres : Faire3Pas</li>\r\n<li>Créer un rébus : 71fame3MAIC&O (c''est un fameux 3 mâts Hisse et Ho)</li>\r\n<li>Pensez à une chanson ou un poème et extrayez les premières lettres : ottoc4ocR! (one, two, three, o''clock, four o''clock, rock !)</li>\r\n<li>Choisissez un mot de passe en y insérant des caractères spéciaux g1M2p#DUtI1 (j''ai un mot de passe différent du tien)</li>\r\n<li>Ne pas utiliser de mot de passe ayant un rapport avec soi (noms, dates de naissance,..)</li>\r\n<li>Vous avez tout intérêt à mélanger les possibilités offertes : lettres, chiffres et caractères spéciaux.</li>\r\n</ul>\r\n<h3>Respectez les règles</h3>\r\n\r\nVous êtes responsable de l''usage qui est fait de votre compte d''accès au système d''information. Pour garantir la sécurité de votre mot de passe, nous vous invitons à suivre les conseils ci-dessous:\r\n<ul>\r\n<li>Ne le communiquez à personne (il garantit votre identité et vous identifie personnellement dans notre système d''information</li>\r\n<li>Ne le notez pas sur un post-it</li>\r\n<li>Verrouillez ou fermez systématiquement votre session en quittant votre poste de travail</li>\r\n<li>Changez-le régulièrement</li>\r\n<li>N''utilisez pas le mot de passe de votre compte d''accès au système d''information pour un autre compte</li>\r\n</ul>', '2015-05-14 09:36:17', 12, 1, '1.0', 22);

-- --------------------------------------------------------

--
-- Structure de la table `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
`id` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idUser` int(11) NOT NULL,
  `idTicket` int(11) NOT NULL,
  `lu` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Contenu de la table `Message`
--

INSERT INTO `Message` (`id`, `contenu`, `date`, `idUser`, `idTicket`, `lu`) VALUES
(70, '<p>Quel est le probl&egrave;me ?</p>\r\n', '2015-09-29 21:27:45', 1, 22, 0),
(71, '<p>Expliquez s&#39;ils vous plais</p>\r\n', '2015-09-29 21:27:53', 1, 22, 0),
(72, '<p>Quel est le logiciel ?</p>\r\n', '2015-09-29 21:28:09', 1, 24, 1),
(73, '<p>Photoshop, ca marche plus !</p>\r\n', '2015-09-29 21:28:27', 2, 24, 1),
(77, 'admin a modifié votre Statut en ''En attente''', '2015-10-05 06:43:08', 1, 22, 0),
(78, 'admin a modifié votre Statut en ''Nouveau''', '2015-10-05 06:43:25', 1, 25, 0),
(79, 'admin a modifié votre Statut en ''Nouveau''', '2015-10-05 06:49:50', 1, 25, 0),
(80, 'admin a modifié votre Statut en ''Nouveau''', '2015-10-05 06:54:34', 1, 25, 0),
(81, 'admin a modifié votre Statut en ''Nouveau''', '2015-10-05 07:44:31', 1, 26, 0),
(83, 'User a modifié votre Statut en ''Nouveau ou a modifié votre Ticket''', '2015-10-05 07:48:19', 2, 29, 0),
(84, 'Une modification à été effectué sur ce Ticket (concernant le Statut ou le titre)', '2015-10-05 07:52:09', 1, 26, 0),
(85, 'Une modification à été effectué sur ce Ticket (concernant le Statut ou le titre)', '2015-10-05 08:09:49', 1, 26, 0),
(86, 'Une modification à été effectué sur ce Ticket (concernant le Statut ou le titre)', '2015-10-05 09:29:00', 1, 22, 0),
(87, 'Une modification à été effectué sur ce Ticket (concernant le Statut ou le titre)', '2015-10-05 09:31:56', 1, 22, 0),
(88, 'Une modification à été effectué sur ce Ticket (concernant le Statut ou le titre)', '2015-10-05 09:34:20', 1, 22, 0),
(89, 'Une modification à été effectué sur ce Ticket (concernant le Statut ou le titre)', '2015-10-05 09:35:46', 1, 22, 0),
(90, 'Une modification à été effectué sur ce Ticket (concernant le Statut ou le titre)', '2015-10-05 09:36:17', 1, 22, 0),
(91, 'Une modification à été effectué sur ce Ticket (concernant le Statut ou le titre)', '2015-10-05 09:37:13', 1, 22, 0),
(92, 'Une modification à été effectué sur ce Ticket (concernant le Statut ou le titre)', '2015-10-05 09:38:51', 1, 25, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Notification`
--

CREATE TABLE IF NOT EXISTS `Notification` (
`id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idTicket` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `Notification`
--

INSERT INTO `Notification` (`id`, `idUser`, `idTicket`) VALUES
(10, 1, 22),
(11, 1, 22);

-- --------------------------------------------------------

--
-- Structure de la table `Statut`
--

CREATE TABLE IF NOT EXISTS `Statut` (
`id` int(11) NOT NULL,
  `libelle` varchar(30) NOT NULL,
  `ordre` int(11) NOT NULL,
  `icon` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `Statut`
--

INSERT INTO `Statut` (`id`, `libelle`, `ordre`, `icon`) VALUES
(1, 'Nouveau', 0, 'flag'),
(2, 'Attribué', 1, 'User'),
(3, 'En attente', 2, 'hourglass'),
(4, 'Résolu', 3, 'check'),
(5, 'Clos', 5, 'off');

-- --------------------------------------------------------

--
-- Structure de la table `Ticket`
--

CREATE TABLE IF NOT EXISTS `Ticket` (
`id` int(11) NOT NULL,
  `type` set('demande','incident') NOT NULL DEFAULT 'demande',
  `idCategorie` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `idStatut` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `Ticket`
--

INSERT INTO `Ticket` (`id`, `type`, `idCategorie`, `titre`, `description`, `idStatut`, `idUser`, `dateCreation`) VALUES
(22, 'demande', 1, 'Ticket 1 ', '<p>ezaeazeazeddyrtyrtyttert</p>\r\n', 5, 1, '2015-09-29 21:26:59'),
(23, '', 12, 'Ticket 2 2', '<p>ezarazrarrazrarrrrrrrrrrr</p>\r\n', 1, 2, '2015-09-29 21:27:08'),
(24, '', 9, 'Ticket 3 ', '<p>ezarazrar</p>\r\n', 1, 2, '2015-09-29 21:27:17'),
(25, 'demande', 9, 'Test Ticket', '<p>bonjour</p>\r\n', 3, 1, '2015-10-05 06:25:51'),
(26, '', 2, 'azrrazzararz', '<p>zaeazrzara</p>\r\n', 3, 1, '2015-10-05 07:41:38'),
(29, '', 2, 'TicketUser', '<p>eazeee</p>\r\n', 1, 2, '2015-10-05 07:48:06'),
(30, '', 11, 'bonjour', '<p>aze</p>\r\n', 1, 2, '2015-10-05 07:52:44'),
(31, '', 9, 'azeazeazarzarz', '<p>dsqsdqsddc</p>\r\n', 1, 2, '2015-10-05 07:53:18');

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
`id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`id`, `login`, `password`, `mail`, `admin`) VALUES
(1, 'admin', 'admin', 'adminz@local.fr', 1),
(2, 'User', 'User', 'User@local.fr', 0),
(3, 'autreUser', 'autreUser', 'autreUser@local.fr', 0),
(4, 'moi', '123456789', 'moi@local.fr', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
 ADD PRIMARY KEY (`id`), ADD KEY `idCategorie` (`idCategorie`);

--
-- Index pour la table `Faq`
--
ALTER TABLE `Faq`
 ADD PRIMARY KEY (`id`), ADD KEY `idCategorie` (`idCategorie`,`idUser`), ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `Message`
--
ALTER TABLE `Message`
 ADD PRIMARY KEY (`id`), ADD KEY `idUser` (`idUser`), ADD KEY `idTicket` (`idTicket`);

--
-- Index pour la table `notification`
--
ALTER TABLE `Notification`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_User` (`idUser`), ADD KEY `fk_Ticket` (`idTicket`);

--
-- Index pour la table `Statut`
--
ALTER TABLE `Statut`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Ticket`
--
ALTER TABLE `Ticket`
 ADD PRIMARY KEY (`id`), ADD KEY `idCategorie` (`idCategorie`), ADD KEY `idStatut` (`idStatut`,`idUser`), ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Categorie`
--
ALTER TABLE `Categorie`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `Faq`
--
ALTER TABLE `Faq`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `Message`
--
ALTER TABLE `Message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT pour la table `Notification`
--
ALTER TABLE `Notification`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `Statut`
--
ALTER TABLE `Statut`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `Ticket`
--
ALTER TABLE `Ticket`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Categorie`
--
ALTER TABLE `Categorie`
ADD CONSTRAINT `Categorie_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `Categorie` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `Faq`
--
ALTER TABLE `Faq`
ADD CONSTRAINT `Faq_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `Categorie` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `Faq_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`);

--
-- Contraintes pour la table `Message`
--
ALTER TABLE `Message`
ADD CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Message_ibfk_2` FOREIGN KEY (`idTicket`) REFERENCES `Ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Notification`
--
ALTER TABLE `Notification`
ADD CONSTRAINT `fk_Ticket` FOREIGN KEY (`idTicket`) REFERENCES `Ticket` (`id`),
ADD CONSTRAINT `fk_User` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`);

--
-- Contraintes pour la table `Ticket`
--
ALTER TABLE `Ticket`
ADD CONSTRAINT `Ticket_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `Categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Ticket_ibfk_2` FOREIGN KEY (`idStatut`) REFERENCES `Statut` (`id`),
ADD CONSTRAINT `Ticket_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
