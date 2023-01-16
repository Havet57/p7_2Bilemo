-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 16 jan. 2023 à 09:39
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `p7_2bilemo`
--

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `email`, `roles`, `password`, `name`) VALUES
(1, 'sfrr@phoneapi.com', '[]', '$2y$13$oYd69HnwRWnU5F/9roDCL.a1FXUDIY2QCClFpyaAmkWBxc5NEP63m', 'Sfrr'),
(2, 'bouyguo@phoneapi.com', '[]', '$2y$13$29HPWUk/TJ9n9SBI4yYxluJnFs2FXK.XLUxa05Sop9HKx0PwXuuca', 'Bouyguo'),
(3, 'fraa@phoneapi.com', '[]', '$2y$13$Tb25JWsthiPJnCdM8pHdxuMdx7PSRRV7LFGJedqWiJTZVeac0H4yK', 'fraa'),
(4, 'sitch@phoneapi.com', '[]', '$2y$13$j7sXCbzMm74TI8Wbw4msEerVXNzKOm6Z6RykyICFZF.nAzCHTATYC', 'sitch');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`) VALUES
(1, 'ophone', 'nian nian nian ce produit nian nian', '685.00'),
(2, 'sumsung', ' tip top nian nian nian ce produit tip top nian nian', '1300.00');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `customer_id`, `email`, `roles`, `password`, `name`) VALUES
(1, 1, 'jeanlouis@hotmail.fr', '[]', '$2y$13$boGgMj9s8/GsPW.3mIUWPOs3cN0BvDLNkWUFmD0G8Qaxe91PJBnVK', 'Jean louis'),
(2, 2, 'kevino@hotmail.fr', '[]', 'kevin12345', 'kevino'),
(3, 1, 'carrelage@hotmail.fr', '[]', '$2y$13$boGgMj9s8/GsPW.3mIUWPOs3cN0BvDLNkWUFmD0G8Qaxe91PJBnVK', 'carrelage'),
(4, 2, 'jojo@hotmail.com', '[]', 'jojo12345', 'jojo'),
(5, 4, 'teo@hotmail.fr', '[]', '$2y$13$1rChowBNF5wczZsXNz52e.bT5wgAE3MY.TYVNLfY99Bm6rOwm/4/i', 'teo'),
(6, 2, 'lino@hotmail.fr', '[]', '$2y$13$pl8YRmmbVRaNf.nbd3lXsuR0BKetX5NVnkHmUf30rrwLnCay0zvK2', 'parquet');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_81398E09E7927C74` (`email`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D6499395C3F3` (`customer_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6499395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
