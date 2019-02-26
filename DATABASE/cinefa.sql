-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 25 fév. 2019 à 17:44
-- Version du serveur :  8.0.15
-- Version de PHP :  7.1.23

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

CREATE TABLE `actors` (
  `id_actor` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `picture` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `actors`
--

INSERT INTO `actors` (`id_actor`, `name`, `gender`, `date_of_birth`, `picture`) VALUES
(1, 'arnold schwarzenegger', 'male', '1947-06-30', 'https://m.media-amazon.com/images/M/MV5BMTI3MDc4NzUyMV5BMl5BanBnXkFtZTcwMTQyMTc5MQ@@._V1_.jpg'),
(2, 'sigourney weaser', 'female', '1949-10-08', 'https://m.media-amazon.com/images/M/MV5BMTk1MTcyNTE3OV5BMl5BanBnXkFtZTcwMTA0MTMyMw@@._V1_UY317_CR12,0,214,317_AL_.jpg'),
(3, 'edward furlong', 'male', '1977-08-02', 'https://m.media-amazon.com/images/M/MV5BMTI1MzgxODkyMl5BMl5BanBnXkFtZTcwNTc1NDIzMQ@@._V1_UY317_CR6,0,214,317_AL_.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `creation_date` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_category`, `title`, `creation_date`, `id_user`) VALUES
(1, 'test', '2019-06-18', 1),
(10, 'prout', '2019-02-24', 1),
(12, 'lol', '2019-02-24', 4);

-- --------------------------------------------------------

--
-- Structure de la table `category_content`
--

CREATE TABLE `category_content` (
  `id_movie` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category_content`
--

INSERT INTO `category_content` (`id_movie`, `id_category`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `directors`
--

CREATE TABLE `directors` (
  `id_director` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `picture` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `directors`
--

INSERT INTO `directors` (`id_director`, `name`, `gender`, `date_of_birth`, `picture`) VALUES
(1, 'john mctiernan', 'male', '1951-01-08', 'https://m.media-amazon.com/images/M/MV5BMjE4MTIwODY2Ml5BMl5BanBnXkFtZTYwMTk5MDQ3._V1_.jpg'),
(2, 'james cameron', 'male', '1954-08-16', 'https://m.media-amazon.com/images/M/MV5BMjI0MjMzOTg2MF5BMl5BanBnXkFtZTcwMTM3NjQxMw@@._V1_UX214_CR0,0,214,317_AL_.jpg'),
(3, 'paul verhoeven', 'male', '1938-07-18', 'https://m.media-amazon.com/images/M/MV5BMTU5NTc4OTU0Nl5BMl5BanBnXkFtZTYwMDU2MDc0._V1_UY317_CR2,0,214,317_AL_.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id_movie` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `release_date` date NOT NULL,
  `poster` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_director` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id_movie`, `title`, `release_date`, `poster`, `id_director`) VALUES
(1, 'predator', '1987-08-19', 'https://m.media-amazon.com/images/M/MV5BY2QwYmFmZTEtNzY2Mi00ZWMyLWEwY2YtMGIyNGZjMWExOWEyXkEyXkFqcGdeQXVyNjUwNzk3NDc@._V1_UX182_CR0,0,182,268_AL_.jpg', 1),
(2, 'last action hero', '1993-08-11', 'https://m.media-amazon.com/images/M/MV5BNjdhOGY1OTktYWJkZC00OGY5LWJhY2QtZmQzZDA2MzY5MmNmXkEyXkFqcGdeQXVyNDk3NzU2MTQ@._V1_UX182_CR0,0,182,268_AL_.jpg', 1),
(3, 'terminator 2', '1991-10-16', 'https://m.media-amazon.com/images/M/MV5BMGU2NzRmZjUtOGUxYS00ZjdjLWEwZWItY2NlM2JhNjkxNTFmXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_UX182_CR0,0,182,268_AL_.jpg', 2),
(4, 'aliens', '1986-10-08', 'https://m.media-amazon.com/images/M/MV5BZGU2OGY5ZTYtMWNhYy00NjZiLWI0NjUtZmNhY2JhNDRmODU3XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_UX182_CR0,0,182,268_AL_.jpg', 2),
(5, 'total recall', '1990-10-17', 'https://m.media-amazon.com/images/M/MV5BYzU1YmJjMGEtMjY4Yy00MTFlLWE3NTUtNzI3YjkwZTMxZjZmXkEyXkFqcGdeQXVyNDc2NjEyMw@@._V1_UX182_CR0,0,182,268_AL_.jpg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `movie_notes`
--

CREATE TABLE `movie_notes` (
  `id_movie` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movie_notes`
--

INSERT INTO `movie_notes` (`id_movie`, `id_user`, `note`) VALUES
(1, 1, 3),
(1, 4, 4),
(2, 4, 4),
(3, 4, 4),
(3, 6, 3),
(4, 4, 4),
(5, 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `plays_in`
--

CREATE TABLE `plays_in` (
  `id_movie` int(11) NOT NULL,
  `id_actor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `plays_in`
--

INSERT INTO `plays_in` (`id_movie`, `id_actor`) VALUES
(1, 1),
(2, 1),
(3, 1),
(5, 1),
(4, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `pseudo`, `address`, `email`, `phone`, `password`) VALUES
(1, 'toto', '', 'toto@yopmail.com', '', '08d2569d06c10b9da10b619df1074c43fae11a8f'),
(4, 'test', '', 'test@yomail.com', '0323435654', '6887b87a23d0355d72c024997e0ddda4ee70f3e3'),
(6, 'MisuFTW', 'Metz Noire', 'ftwmisu@yopmail.com', '0666666666', '37ec445fd8c263d619270fad62c13cb5ad06c189');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id_actor`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `category_content`
--
ALTER TABLE `category_content`
  ADD PRIMARY KEY (`id_movie`,`id_category`),
  ADD KEY `id_category` (`id_category`);

--
-- Index pour la table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id_director`);

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_movie`),
  ADD KEY `id_director` (`id_director`);

--
-- Index pour la table `movie_notes`
--
ALTER TABLE `movie_notes`
  ADD PRIMARY KEY (`id_movie`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `plays_in`
--
ALTER TABLE `plays_in`
  ADD PRIMARY KEY (`id_movie`,`id_actor`),
  ADD KEY `id_actor` (`id_actor`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actors`
--
ALTER TABLE `actors`
  MODIFY `id_actor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `directors`
--
ALTER TABLE `directors`
  MODIFY `id_director` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_movie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `category_content`
--
ALTER TABLE `category_content`
  ADD CONSTRAINT `category_content_ibfk_1` FOREIGN KEY (`id_movie`) REFERENCES `movies` (`id_movie`),
  ADD CONSTRAINT `category_content_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`);

--
-- Contraintes pour la table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`id_director`) REFERENCES `directors` (`id_director`);

--
-- Contraintes pour la table `movie_notes`
--
ALTER TABLE `movie_notes`
  ADD CONSTRAINT `movie_notes_ibfk_1` FOREIGN KEY (`id_movie`) REFERENCES `movies` (`id_movie`),
  ADD CONSTRAINT `movie_notes_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `plays_in`
--
ALTER TABLE `plays_in`
  ADD CONSTRAINT `plays_in_ibfk_1` FOREIGN KEY (`id_movie`) REFERENCES `movies` (`id_movie`),
  ADD CONSTRAINT `plays_in_ibfk_2` FOREIGN KEY (`id_actor`) REFERENCES `actors` (`id_actor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
