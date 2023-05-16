-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Máj 16. 13:27
-- Kiszolgáló verziója: 8.0.32
-- PHP verzió: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `vegleges`
--
CREATE DATABASE IF NOT EXISTS `vegleges` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `vegleges`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log`
--

CREATE TABLE `log` (
  `ID` int UNSIGNED NOT NULL,
  `U_ID` int NOT NULL,
  `TYPE` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `MESSAGE` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IP` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `log`
--

INSERT INTO `log` (`ID`, `U_ID`, `TYPE`, `MESSAGE`, `DATE`, `IP`) VALUES
(1, 1, 'registration', 'Admin létrehozva!', '2023-05-16 13:22:23', '127.0.0.1'),
(2, 2, 'registration', '#2 Dummy user létrehozva installból!', '2023-05-16 13:22:26', '127.0.0.1'),
(3, 3, 'registration', '#3 Dummy user létrehozva installból!', '2023-05-16 13:22:26', '127.0.0.1'),
(4, 4, 'registration', '#4 Dummy user létrehozva installból!', '2023-05-16 13:22:26', '127.0.0.1'),
(5, 5, 'registration', '#5 Dummy user létrehozva installból!', '2023-05-16 13:22:26', '127.0.0.1'),
(6, 2, 'login', '', '2023-05-16 13:23:02', '127.0.0.1'),
(7, 1, 'login', '', '2023-05-16 13:23:15', '127.0.0.1'),
(8, 1, 'update', 'User #2 admin által módosítva!', '2023-05-16 13:23:37', '127.0.0.1'),
(9, 1, 'update', 'User #2 admin által módosítva!', '2023-05-16 13:23:39', '127.0.0.1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `role`
--

CREATE TABLE `role` (
  `R_ID` tinyint UNSIGNED NOT NULL,
  `R_NAME` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `role`
--

INSERT INTO `role` (`R_ID`, `R_NAME`) VALUES
(1, 'Adminisztrátor'),
(2, 'Felhasználó');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `U_ID` int UNSIGNED NOT NULL,
  `PASSWORD` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `EMAIL` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ROLE` tinyint UNSIGNED NOT NULL DEFAULT '2',
  `ENABLED` tinyint UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`U_ID`, `PASSWORD`, `EMAIL`, `ROLE`, `ENABLED`) VALUES
(1, '$2y$10$zN9DYJT.bUa43UrpoZqV7OjGGE2BQui1aqvmB.u8.tblPd/kSBDXK', 'email@domain.hu', 1, 1),
(2, '$2y$10$zN9DYJT.bUa43UrpoZqV7OjGGE2BQui1aqvmB.u8.tblPd/kSBDXK', 'teszt2@teszt.hu', 2, 1),
(3, '$2y$10$zN9DYJT.bUa43UrpoZqV7OjGGE2BQui1aqvmB.u8.tblPd/kSBDXK', 'teszt3@teszt.hu', 2, 1),
(4, '$2y$10$zN9DYJT.bUa43UrpoZqV7OjGGE2BQui1aqvmB.u8.tblPd/kSBDXK', 'teszt4@teszt.hu', 2, 1),
(5, '$2y$10$zN9DYJT.bUa43UrpoZqV7OjGGE2BQui1aqvmB.u8.tblPd/kSBDXK', 'teszt5@teszt.hu', 2, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_data`
--

CREATE TABLE `user_data` (
  `U_ID` int UNSIGNED NOT NULL,
  `FIRST_NAME` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `LAST_NAME` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PHONE_NUMBER` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `user_data`
--

INSERT INTO `user_data` (`U_ID`, `FIRST_NAME`, `LAST_NAME`, `PHONE_NUMBER`) VALUES
(1, 'Tóth', 'Balázs', '+36200000000'),
(2, 'Richard', 'Wagner', '+36200000000'),
(3, 'Ludwig van', 'Beethoven', '+36200000000'),
(4, 'Franz', 'Schubert', '+36200000000'),
(5, 'Richard', 'Strauss', '+36200000000');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_photo`
--

CREATE TABLE `user_photo` (
  `ID` int UNSIGNED NOT NULL,
  `U_ID` int UNSIGNED NOT NULL,
  `FILE_NAME` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `user_photo`
--

INSERT INTO `user_photo` (`ID`, `U_ID`, `FILE_NAME`) VALUES
(1, 1, 'default.png'),
(2, 2, 'default.png'),
(3, 3, 'default.png'),
(4, 4, 'default.png'),
(5, 5, 'default.png');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`R_ID`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`U_ID`);

--
-- A tábla indexei `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`U_ID`);

--
-- A tábla indexei `user_photo`
--
ALTER TABLE `user_photo`
  ADD PRIMARY KEY (`ID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `log`
--
ALTER TABLE `log`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `role`
--
ALTER TABLE `role`
  MODIFY `R_ID` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `U_ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `user_photo`
--
ALTER TABLE `user_photo`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `user_data`
--
ALTER TABLE `user_data`
  ADD CONSTRAINT `user_data_ibfk_1` FOREIGN KEY (`U_ID`) REFERENCES `user` (`U_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
