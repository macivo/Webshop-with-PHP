-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 20. Jan 2021 um 00:43
-- Server-Version: 10.4.8-MariaDB
-- PHP-Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `macbobby-shop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phonenumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `firstname`, `lastname`, `street`, `zip`, `city`, `phonenumber`) VALUES
(2, 1, 'Mac', 'Müller', 'Zihlmattweg 42', '6005', 'Luzern', '79');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `product_id` int(10) NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `option_des` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `options`
--

INSERT INTO `options` (`id`, `product_id`, `type`, `option_des`, `price`) VALUES
(1, 2, 'color', 'black', 0),
(2, 2, 'color', 'red', 50),
(3, 2, 'memory', '128', 0),
(4, 2, 'memory', '256', 200),
(5, 1, 'color', 'black', 0),
(6, 1, 'color', 'red', 50),
(7, 1, 'memory', '128', 0),
(8, 1, 'memory', '256', 200),
(9, 3, 'color', 'black', 0),
(10, 3, 'color', 'red', 50),
(11, 3, 'memory', '128', 0),
(12, 3, 'memory', '256', 200),
(13, 4, 'color', 'black', 0),
(14, 4, 'color', 'red', 50),
(15, 4, 'memory', '256', 200),
(16, 4, 'memory', '128', 0),
(17, 1, 'color', 'blue', 50),
(18, 1, 'color', 'yellow', 20),
(19, 5, 'color', 'black', 0),
(20, 5, 'memory', '128', 0),
(21, 6, 'color', 'black', 0),
(22, 6, 'memory', '128', 0),
(23, 7, 'color', 'black', 0),
(24, 7, 'memory', '128', 0),
(25, 8, 'color', 'black', 0),
(26, 8, 'memory', '128', 0),
(27, 9, 'color', 'black', 0),
(28, 9, 'memory', '128', 0),
(29, 10, 'color', 'black', 0),
(30, 10, 'memory', '128', 0),
(31, 11, 'color', 'black', 0),
(32, 11, 'memory', '128', 0),
(33, 12, 'color', 'black', 0),
(34, 12, 'memory', '128', 0),
(35, 13, 'color', 'black', 0),
(36, 13, 'memory', '128', 0),
(37, 14, 'color', 'black', 0),
(38, 14, 'memory', '128', 0),
(39, 15, 'color', 'black', 0),
(40, 15, 'memory', '128', 0),
(41, 16, 'color', 'black', 0),
(42, 16, 'memory', '128', 0),
(43, 17, 'color', 'black', 0),
(44, 17, 'memory', '128', 0),
(45, 18, 'color', 'black', 0),
(46, 18, 'memory', '128', 0),
(47, 19, 'color', 'black', 0),
(48, 19, 'memory', '128', 0),
(49, 20, 'color', 'black', 0),
(50, 20, 'memory', '128', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `order_number` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) NOT NULL,
  `address_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `option_color_id` int(10) NOT NULL,
  `option_ram_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `done` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Daten für Tabelle `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `address_id`, `product_id`, `option_color_id`, `option_ram_id`, `quantity`, `done`, `date`) VALUES
(1, '1.2021.01.19.11.49.29', 1, 2, 2, 1, 3, 1, 'no', '2021-01-19 22:49:29');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `desc_de` text COLLATE utf8_unicode_ci NOT NULL,
  `desc_en` text COLLATE utf8_unicode_ci NOT NULL,
  `manufacture` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`id`, `name`, `desc_de`, `desc_en`, `manufacture`, `image`, `price`) VALUES
(1, 'Galaxy s20', 'Galaxy s20 DE', 'Galaxy s20 En', 'Samsung', 's20', 999),
(2, 'I-Phone 12', 'I-Phone 12 de', 'I-Phone 12 en', 'Apple', 'iphone12', 988),
(3, 'Galaxy s21', 'Galaxy s21 Des DE', 'Galaxy s21 EN', 'Samsung', 's21', 1999),
(4, 'iPhone 11', 'iphone De', 'iphone11 en', 'Apple', 'iphone11', 799),
(5, 'Asus Zenfone 7', 'Asus Zenfone 7 De', 'Asus Zenfone 7 en', 'ASUS', 'AsusZenfone7', 799),
(6, 'Google Pixel 5', 'Google Pixel 5 De', 'Google Pixel 5 en', 'Google', 'GooglePixel5', 799),
(7, 'Huawei Mate 20', 'Huawei Mate 20 De', 'Huawei Mate 20 en', 'Huawei', 'HuaweiMate20', 799),
(8, 'Huawei P30 Pro', 'Huawei P30 Pro De', 'Huawei P30 Pro en', 'Huawei', 'HuaweiP30Pro', 799),
(9, 'Huawei P40', 'Huawei P40 De', 'Huawei P40 en', 'Huawei', 'HuaweiP40', 799),
(10, 'Huawei P40 Pro', 'Huawei P40 Pro De', 'Huawei P40 Pro en', 'Huawei', 'HuaweiP40Pro', 799),
(11, 'LG Wing', 'LG Wing De', 'LG Wing en', 'LG', 'LGWing', 799),
(12, 'Xiaomi MI 10P', 'Xiaomi MI 10P De', 'Xiaomi MI 10P en', 'Xiaomi', 'MI10P', 799),
(13, 'One Plus 8', 'One Plus 8 De', 'One Plus 8 en', 'OnePlus', 'OP8', 799),
(14, 'ASUS ROG 2', 'ASUS ROG 2 De', 'ASUS ROG 2 en', 'ASUS', 'ROG2', 799),
(15, 'ASUS ROG 3', 'ASUS ROG 3 De', 'ASUS ROG 3 en', 'ASUS', 'ROG3', 799),
(16, 'Samsung S10', 'Samsung S10 De', 'Samsung S10 en', 'Samsung', 'S10', 799),
(17, 'Samsung S10e', 'Samsung S10e De', 'Samsung S10e en', 'Samsung', 'S10e', 799),
(18, 'Samsung S10 Plus', 'Samsung S10 Plus De', 'Samsung S10 Plus en', 'Samsung', 'S10Plus', 799),
(19, 'Xiaomi Mi Note 10 Pro', 'Xiaomi Mi Note 10 Pro De', 'Xiaomi Mi Note 10 Pro en', 'Xiaomi', 'XiaomiMiNote10Pro', 799),
(20, 'Sony Xperia 1 II', 'Sony Xperia 1 II De', 'Sony Xperia 1 II en', 'Sony', 'Xperia1II', 799);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `function` enum('Admin','User') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `function`) VALUES
(1, 'mac', 'Mac', 'Müller', 'mac.mueller@test.de', '098f6bcd4621d373cade4e832627b4f6', 'Admin'),
(2, 'bobby', '', '', 'vienphatbobby.lien@students.bfh.ch', '12345', 'Admin'),
(3, 'user', 'User Name', 'User Lastname', 'user@bfh.ch', '12345', 'User'),
(4, 'admin', '', '', 'admin@bfh.ch', '12345', 'Admin');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
