-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 15 fév. 2019 à 07:37
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cinefa`
--

-- --------------------------------------------------------

--
-- Structure de la table `actors`
--

DROP TABLE IF EXISTS `actors`;
CREATE TABLE IF NOT EXISTS `actors` (
  `id_actor` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  PRIMARY KEY (`id_actor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=UTF8;

--
-- Déchargement des données de la table `actors`
--

INSERT INTO `actors` (`id_actor`, `name`, `gender`, `date_of_birth`) VALUES
(1, 'arnold schwarzenegger', 'male', '1947-06-30'),
(2, 'sigourney weaser', 'female', '1949-10-08'),
(3, 'edward furlong', 'male', '1977-08-02');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `creation_date` date DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_category`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

-- --------------------------------------------------------

--
-- Structure de la table `category_content`
--

DROP TABLE IF EXISTS `category_content`;
CREATE TABLE IF NOT EXISTS `category_content` (
  `id_movie` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id_movie`,`id_category`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

-- --------------------------------------------------------

--
-- Structure de la table `directors`
--

DROP TABLE IF EXISTS `directors`;
CREATE TABLE IF NOT EXISTS `directors` (
  `id_director` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  PRIMARY KEY (`id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=UTF8;

--
-- Déchargement des données de la table `directors`
--

INSERT INTO `directors` (`id_director`, `name`, `gender`, `date_of_birth`) VALUES
(1, 'john mctiernan', 'male', '1951-01-08'),
(2, 'james cameron', 'male', '1954-08-16'),
(3, 'paul verhoeven', 'male', '1938-07-18');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id_movie` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `release_date` date NOT NULL,
  `id_director` int(11) NOT NULL,
  PRIMARY KEY (`id_movie`),
  KEY `id_director` (`id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=UTF8;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id_movie`, `title`, `release_date`, `id_director`) VALUES
(1, 'predator', '1987-08-19', 1),
(2, 'last action hero', '1993-08-11', 1),
(3, 'terminator 2', '1991-10-16', 2),
(4, 'aliens', '1986-10-08', 2),
(5, 'total recall', '1990-10-17', 3);

-- --------------------------------------------------------

--
-- Structure de la table `movie_notes`
--

DROP TABLE IF EXISTS `movie_notes`;
CREATE TABLE IF NOT EXISTS `movie_notes` (
  `id_movie` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `note` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_movie`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

-- --------------------------------------------------------

--
-- Structure de la table `plays_in`
--

DROP TABLE IF EXISTS `plays_in`;
CREATE TABLE IF NOT EXISTS `plays_in` (
  `id_movie` int(11) NOT NULL,
  `id_actor` int(11) NOT NULL,
  PRIMARY KEY (`id_movie`,`id_actor`),
  FOREIGN KEY (`id_movie`) REFERENCES MOVIES(`id_movie`),
  FOREIGN KEY (`id_actor`) REFERENCES ACTORS(`id_actor`)
  KEY `id_actor` (`id_actor`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

--
-- Déchargement des données de la table `plays_in`
--

INSERT INTO `plays_in` (`id_movie`, `id_actor`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 3),
(4, 2),
(5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
