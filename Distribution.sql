-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 19-10-2019 a les 19:52:31
-- Versió del servidor: 5.7.21-0ubuntu0.16.04.1
-- Versió de PHP: 7.2.2-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `Distribution`
--
CREATE DATABASE IF NOT EXISTS `Distribution` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Distribution`;

-- --------------------------------------------------------

--
-- Estructura de la taula `Categories`
--

CREATE TABLE `Categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `Categories`
--

INSERT INTO `Categories` (`id`, `name`, `description`) VALUES
(1, 'Begudes', 'Tot tipus de begudes'),
(2, 'Menjar', 'Productes comestibles'),
(3, 'Bateries', 'Tot tipus de bateries'),
(4, 'Joguets', 'Tot tipus de jogets');

-- --------------------------------------------------------

--
-- Estructura de la taula `OrderLines`
--

CREATE TABLE `OrderLines` (
  `idOrder` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `Orders`
--

CREATE TABLE `Orders` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `send` binary(1) DEFAULT NULL,
  `idShop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `Products`
--

CREATE TABLE `Products` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `idCategory` int(11) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `Products`
--

INSERT INTO `Products` (`id`, `name`, `description`, `stock`, `idCategory`, `price`, `image`) VALUES
(3, 'rollito', 'Rollito de primavera', 99, 2, 6, ''),
(4, 'aigua', 'Ampolla d\'aigua', 1000, 1, 0.45, ''),
(5, 'pistola', 'Pistola d\'aigua', 200, 4, 3.5, ''),
(6, 'cafe licor', '1L', 95, 1, 5.99, ''),
(7, 'Pilas AAA', 'piles xicotetes', 1000, 3, 3.4, ''),
(8, 'Quicos', 'Paquete 50gr', 1000, 2, 0.6, '');

-- --------------------------------------------------------

--
-- Estructura de la taula `Shops`
--

CREATE TABLE `Shops` (
  `id` int(11) NOT NULL,
  `mailAdress` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `adress` varchar(90) DEFAULT NULL,
  `postalCode` varchar(5) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `Shops`
--

INSERT INTO `Shops` (`id`, `mailAdress`, `password`, `adress`, `postalCode`, `country`) VALUES
(1, 'alcoi@tenda.es', '1234', 'Mossen Torregorsa, 2', '03802', 'Espanya'),
(2, 'barcelona@tenda.es', '1234', 'Balmes,340', '46023', 'Catalunya');

--
-- Indexos per taules bolcades
--

--
-- Index de la taula `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`id`);

--
-- Index de la taula `OrderLines`
--
ALTER TABLE `OrderLines`
  ADD PRIMARY KEY (`idOrder`,`idProduct`),
  ADD KEY `fk_Comanda_has_Producte_Producte1_idx` (`idProduct`),
  ADD KEY `fk_Comanda_has_Producte_Comanda1_idx` (`idOrder`);

--
-- Index de la taula `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Comanda_Tenda1_idx` (`idShop`);

--
-- Index de la taula `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`id`,`idCategory`),
  ADD KEY `fk_Producte_categoria1_idx` (`idCategory`);

--
-- Index de la taula `Shops`
--
ALTER TABLE `Shops`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `Categories`
--
ALTER TABLE `Categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la taula `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la taula `Products`
--
ALTER TABLE `Products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT per la taula `Shops`
--
ALTER TABLE `Shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `OrderLines`
--
ALTER TABLE `OrderLines`
  ADD CONSTRAINT `fk_Comanda_has_Producte_Comanda1` FOREIGN KEY (`idOrder`) REFERENCES `Orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Comanda_has_Producte_Producte1` FOREIGN KEY (`idProduct`) REFERENCES `Products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restriccions per la taula `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `fk_Comanda_Tenda1` FOREIGN KEY (`idShop`) REFERENCES `Shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restriccions per la taula `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `fk_Producte_categoria1` FOREIGN KEY (`idCategory`) REFERENCES `Categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
