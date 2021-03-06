-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE `auteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateNaissance` date NOT NULL,
  `sexe` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `auteur` (`id`, `nom`, `prenom`, `dateNaissance`, `sexe`) VALUES
(1,	'Vian',	'Boris',	'1920-03-10',	'M'),
(2,	'Christie',	'Agatha',	'1890-09-15',	'F'),
(3,	'K.Dick',	'Philip',	'1928-01-16',	'M'),
(4,	'Gibson',	'William',	'1948-03-17',	'M');

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1,	'Roman'),
(2,	'Nouvelles'),
(3,	'Policier'),
(4,	'Science fiction');

DROP TABLE IF EXISTS `livre`;
CREATE TABLE `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `couverture_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `couverture_alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AC634F99BCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_6DA2609DBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `livre` (`id`, `categorie_id`, `titre`, `description`, `couverture_url`, `couverture_alt`) VALUES
(2,	1,	'L\'écume des jours',	'L\'Écume des jours est un roman de Boris Vian, considéré aussi comme un conte. Publié le 20 mars 1947, il a été rédigé entre mars et mai 1946 au dos d’imprimés de l’AFNOR et dédié à sa première épouse Michelle. Écrit en grand secret par l\'auteur pour être présenté au prix de la Pléiade qu\'il n\'obtiendra pas en juin 1946, c\'est « sans doute la création romanesque la plus rapide de l\'après guerre. »',	'a721c8e6aa9963483c181ed3c4bda55d.jpeg',	'L\'écume des jours'),
(3,	4,	'Ubik',	'Ubik (titre original Ubik) est un roman de Philip K. Dick, écrit en 1966, publié aux États-Unis en 1969 et en France en 1970 dans une traduction d\'Alain Dorémieux. C\'est une œuvre classique de la littérature de science-fiction. En 2005, le magazine Time le classait parmi les 100 meilleurs romans écrits en anglais depuis 1923 ; le critique Lev Grossman a commenté ce livre comme une « histoire d\'horreur existentielle profondément troublante, un cauchemar dont vous ne serez jamais sûr de vous être réveillé. »',	'25dfdcb61dc7144af6038dd467285906.jpeg',	'couverture ubik'),
(4,	4,	'Neuromancien',	'Neuromancien (titre original : Neuromancer) est le premier roman de science-fiction de William Gibson. Publié en 1984, il est généralement considéré comme le roman fondateur du mouvement Cyberpunk ayant inspiré bon nombre d\'œuvres telles que les mangas Ghost in the Shell ou Akira et Matrix au cinéma.\r\nIl est suivi de Comte Zéro et de Mona Lisa s\'éclate.',	'da5a50ddb3f7dd2f267daaeed9cc11bd.jpeg',	'Neuromancien - William Gibson'),
(5,	4,	'Comte Zéro',	'Comte Zéro (titre original : Count Zero) est un roman de science-fiction écrit par William Gibson et publié pour la première fois en 1986.\r\nC\'est un représentant du genre cyberpunk, situé dans le même endroit que le précédent livre Neuromancien et est le deuxième volume de la trilogie de la cité tentaculaire, laquelle inclut Neuromancien, Comte Zéro, et Mona Lisa s\'éclate.',	'a45ca34cfa188819126cbaa92f2e88f3.jpeg',	'Compte Zéro - William Gibson');

DROP TABLE IF EXISTS `livre_auteur`;
CREATE TABLE `livre_auteur` (
  `livre_id` int(11) NOT NULL,
  `auteur_id` int(11) NOT NULL,
  PRIMARY KEY (`livre_id`,`auteur_id`),
  KEY `IDX_A11876B537D925CB` (`livre_id`),
  KEY `IDX_A11876B560BB6FE6` (`auteur_id`),
  CONSTRAINT `FK_A11876B537D925CB` FOREIGN KEY (`livre_id`) REFERENCES `livre` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A11876B560BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `auteur` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `livre_auteur` (`livre_id`, `auteur_id`) VALUES
(2,	1),
(3,	3),
(4,	4),
(5,	4);

-- 2018-02-11 18:17:47
