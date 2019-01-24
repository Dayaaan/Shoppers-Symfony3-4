-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 24 jan. 2019 à 15:28
-- Version du serveur :  5.7.24-0ubuntu0.16.04.1
-- Version de PHP :  7.2.13-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image_principale_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `image_principale_id`) VALUES
(1, 'Whey', 'Whey protein', NULL),
(2, 'bcaa', 'bcaa', NULL),
(4, 'adolescent', 'adolescent', NULL),
(5, 'femme', 'femme', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `states` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `charge_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paiement_status` tinyint(1) NOT NULL,
  `total_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `user_id`, `name`, `firstname`, `email`, `adress`, `city`, `states`, `zipcode`, `createdAt`, `charge_id`, `paiement_status`, `total_amount`) VALUES
(1, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-23 15:12:38', NULL, 0, 85.98),
(2, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-23 15:14:36', NULL, 0, 49.99),
(3, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'AZ', '44400', '2019-01-23 15:23:57', NULL, 0, 385.92),
(4, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'AG', '44400', '2019-01-23 15:27:41', NULL, 0, 49.99),
(5, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'AG', '44400', '2019-01-23 15:29:04', NULL, 0, 49.99),
(6, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-23 15:30:57', NULL, 0, 35.99),
(7, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'AZ', '44400', '2019-01-23 15:33:03', NULL, 0, 49.99),
(8, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'AW', '44400', '2019-01-23 15:35:02', NULL, 0, 49.99),
(9, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'AU', '44400', '2019-01-23 15:47:28', NULL, 0, 49.99),
(10, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'AL', '44400', '2019-01-23 16:54:39', NULL, 0, 49.99),
(11, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'AW', '44400', '2019-01-23 16:57:17', NULL, 0, 85.98),
(12, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'AU', '44400', '2019-01-23 17:08:10', NULL, 0, 85.98),
(13, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'AU', '44400', '2019-01-23 17:08:12', NULL, 0, 85.98),
(14, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'BS', '44400', '2019-01-23 17:09:15', NULL, 0, 85.98),
(15, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 09:34:29', NULL, 0, 49.99),
(16, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 09:36:23', NULL, 0, 49.99),
(17, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:18:13', NULL, 0, 49.99),
(18, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:26:18', NULL, 0, 49.99),
(19, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:29:10', NULL, 0, 99.98),
(20, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:30:20', NULL, 0, 99.98),
(21, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:31:23', NULL, 0, 99.98),
(22, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:32:57', NULL, 0, 99.98),
(23, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:34:17', NULL, 0, 99.98),
(24, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:37:48', 'ch_1Dw4efAFrFF1hfU9ktMokIwm', 1, 99.98),
(25, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:49:44', 'ch_1Dw4qDAFrFF1hfU93ZaOwX7S', 1, 99.98),
(26, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:51:12', 'ch_1Dw4rdAFrFF1hfU9JkXIYckS', 1, 99.98),
(27, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:52:05', NULL, 0, 99.98),
(28, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:56:13', 'ch_1Dw4wUAFrFF1hfU9JkKtwUoz', 1, 99.98),
(29, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:57:06', 'ch_1Dw4xLAFrFF1hfU9YMHBh3RB', 1, 99.98),
(30, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 10:58:19', 'ch_1Dw4yWAFrFF1hfU90IGabsfO', 1, 85.98),
(31, 1, 'admin', 'admin', 'admin@gmail.com', '3 rue des admins', 'Nantes', 'FR', '44400', '2019-01-24 11:13:42', 'ch_1Dw5DPAFrFF1hfU9yhKxhSZ8', 1, 49.99);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_size` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `produit_id`, `image_name`, `image_alt`, `image_size`, `updated_at`) VALUES
(1, 1, '10530943-1234625356041867.jpg', NULL, NULL, '2019-01-21 09:37:13'),
(2, 2, 'gainer.jpg', 'gainer2', NULL, '2019-01-21 10:44:47');

-- --------------------------------------------------------

--
-- Structure de la table `image_principale`
--

CREATE TABLE `image_principale` (
  `id` int(11) NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_size` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `image_principale`
--

INSERT INTO `image_principale` (`id`, `image_name`, `image_alt`, `image_size`, `updated_at`) VALUES
(1, 'final-mass_l-main.86383.jpg', 'protein', NULL, '2019-01-21 09:37:13'),
(2, 'gainer.jpg', 'protein', NULL, '2019-01-21 10:44:47');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `image_principale_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `image_principale_id`, `name`, `description`, `price`, `quantity`) VALUES
(1, 1, 'Impact Whey Protein', 'Protéine de lactosérum de première qualité contenant 21 g de protéine par portion, elle vous fournit les protéines dont vous avez besoin à partir d\'une source de qualité ; c\'est à dire les mêmes vaches qui produisent votre lait et votre formage. Le lait est simplement filtré et séché par pulvérisation pour produire des nutriments entièrement naturels.\r\n\r\nApprouvée par Cologne List®, notre Impact Whey Protein a passé des tests de qualité et de pureté rigoureux. C\'est officiellement l\'une des meilleures poudres de protéine sur le marché.\r\n\r\nChoisissez votre préférée parmi 40 saveurs incluant les délicieux Chocolat Naturel, marzipan et Stracciatella.', 49.99, 1000),
(2, 2, 'Hard Gainer Extremes', 'Notre mélange contient 35 g de protéines et 61 g de glucides, pour un total de 446 calories par portion, ce qui vous aidera à atteindre vos objectifs de prise de muscles.1\r\n\r\nÉlaboré à partir d\'ingrédients spécifiquement choisis pour vous aider à atteindre vos objectifs de gain de volume important, notre mélange Extreme Gainer est le choix idéal pour toutes les personnes qui souhaitent prendre du muscle.', 35.99, 50);

-- --------------------------------------------------------

--
-- Structure de la table `produit_category`
--

CREATE TABLE `produit_category` (
  `produit_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produit_category`
--

INSERT INTO `produit_category` (`produit_id`, `category_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit_commande`
--

CREATE TABLE `produit_commande` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `commande_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produit_commande`
--

INSERT INTO `produit_commande` (`id`, `produit_id`, `commande_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 49.99),
(2, 2, 1, 1, 35.99),
(3, 1, 2, 1, 49.99),
(4, 1, 3, 7, 49.99),
(5, 2, 3, 1, 35.99),
(6, 1, 4, 1, 49.99),
(7, 1, 5, 1, 49.99),
(8, 2, 6, 1, 35.99),
(9, 1, 7, 1, 49.99),
(10, 1, 8, 1, 49.99),
(11, 1, 9, 1, 49.99),
(12, 1, 10, 1, 49.99),
(13, 1, 11, 1, 49.99),
(14, 2, 11, 1, 35.99),
(15, 1, 12, 1, 49.99),
(16, 2, 12, 1, 35.99),
(17, 1, 13, 1, 49.99),
(18, 2, 13, 1, 35.99),
(19, 1, 14, 1, 49.99),
(20, 2, 14, 1, 35.99),
(21, 1, 15, 1, 49.99),
(22, 1, 16, 1, 49.99),
(23, 1, 17, 1, 49.99),
(24, 1, 18, 1, 49.99),
(25, 1, 19, 2, 49.99),
(26, 1, 20, 2, 49.99),
(27, 1, 21, 2, 49.99),
(28, 1, 22, 2, 49.99),
(29, 1, 23, 2, 49.99),
(30, 1, 24, 2, 49.99),
(31, 1, 25, 2, 49.99),
(32, 1, 26, 2, 49.99),
(33, 1, 27, 2, 49.99),
(34, 1, 28, 2, 49.99),
(35, 1, 29, 2, 49.99),
(36, 1, 30, 1, 49.99),
(37, 2, 30, 1, 35.99),
(38, 1, 31, 1, 49.99);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `states` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `name`, `firstname`, `adress`, `city`, `states`, `zipcode`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin@gmail.com', 1, NULL, '$2y$13$4uP3kddZ8eXE3z1/YteRV.L0hzUwjjoVx0kKz5nnIamVk.h0dETZW', '2019-01-24 09:32:27', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 'admin', 'admin', '3 rue des admins', 'Nantes', 'FR', '44400');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_64C19C191F8D062` (`image_principale_id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67DA76ED395` (`user_id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C53D045FF347EFB` (`produit_id`);

--
-- Index pour la table `image_principale`
--
ALTER TABLE `image_principale`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_29A5EC2791F8D062` (`image_principale_id`);

--
-- Index pour la table `produit_category`
--
ALTER TABLE `produit_category`
  ADD PRIMARY KEY (`produit_id`,`category_id`),
  ADD KEY `IDX_2F532BD2F347EFB` (`produit_id`),
  ADD KEY `IDX_2F532BD212469DE2` (`category_id`);

--
-- Index pour la table `produit_commande`
--
ALTER TABLE `produit_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_47F5946EF347EFB` (`produit_id`),
  ADD KEY `IDX_47F5946E82EA2E54` (`commande_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `image_principale`
--
ALTER TABLE `image_principale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `produit_commande`
--
ALTER TABLE `produit_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `FK_64C19C191F8D062` FOREIGN KEY (`image_principale_id`) REFERENCES `image_principale` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC2791F8D062` FOREIGN KEY (`image_principale_id`) REFERENCES `image_principale` (`id`);

--
-- Contraintes pour la table `produit_category`
--
ALTER TABLE `produit_category`
  ADD CONSTRAINT `FK_2F532BD212469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2F532BD2F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produit_commande`
--
ALTER TABLE `produit_commande`
  ADD CONSTRAINT `FK_47F5946E82EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `FK_47F5946EF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
