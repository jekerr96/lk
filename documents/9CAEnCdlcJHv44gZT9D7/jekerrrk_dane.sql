-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 25 2018 г., 13:51
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `jekerrrk_dane`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth`
--
-- Создание: Май 08 2018 г., 04:51
--

DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `auth`
--

INSERT INTO `auth` (`id`, `token`) VALUES
(4, '1627d9920711ac544f31029f2a9020ce2972cf2f'),
(5, 'ad025456d3e0210a9360476b0a7bfb36b8ae446c'),
(6, '863fc3f04369eecce7e65c1543750224dcbd78b2'),
(7, '1c32f9b0d77f657b9a12872306ce1cdd303d5907');

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--
-- Создание: Май 08 2018 г., 05:10
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `fio` varchar(50) NOT NULL,
  `passport` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `fact_address` varchar(200) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `history` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `fio`, `passport`, `address`, `fact_address`, `phone`, `email`, `history`) VALUES
(1, 'Астанин Евгений Алексеевич', '434312 цкуекнк куек вап', 'Барнаул', 'Барнаул', '4546576874', 'jekerr96@gmail.com', 'rfrf'),
(2, 'Даниил', '434312 цкуекнк куек вап', 'Барнаул', 'Барнаул', '4546576874', 'куек@sdf.ru', 'Донька шелупонька'),
(3, 'Жуковский Марк Сергеевич', '', '', '', 'phone', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `hotel`
--
-- Создание: Май 25 2018 г., 10:48
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `reiting` double NOT NULL,
  `address` varchar(150) NOT NULL,
  `opisanie` varchar(200) NOT NULL,
  `img` varchar(255) NOT NULL,
  `id_nomer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mesta`
--
-- Создание: Май 25 2018 г., 10:46
--

DROP TABLE IF EXISTS `mesta`;
CREATE TABLE `mesta` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `opisanie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nomer`
--
-- Создание: Май 25 2018 г., 10:46
--

DROP TABLE IF EXISTS `nomer`;
CREATE TABLE `nomer` (
  `id` int(11) NOT NULL,
  `opisanie` varchar(200) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tur`
--
-- Создание: Май 25 2018 г., 10:47
--

DROP TABLE IF EXISTS `tur`;
CREATE TABLE `tur` (
  `id` int(11) NOT NULL,
  `price` double NOT NULL,
  `id_mesta` int(11) NOT NULL,
  `dlit` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `opisanie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nomer` (`id_nomer`);

--
-- Индексы таблицы `mesta`
--
ALTER TABLE `mesta`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nomer`
--
ALTER TABLE `nomer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tur`
--
ALTER TABLE `tur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hotel` (`id_hotel`),
  ADD KEY `id_mesta` (`id_mesta`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mesta`
--
ALTER TABLE `mesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nomer`
--
ALTER TABLE `nomer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tur`
--
ALTER TABLE `tur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`id_nomer`) REFERENCES `nomer` (`id`);

--
-- Ограничения внешнего ключа таблицы `tur`
--
ALTER TABLE `tur`
  ADD CONSTRAINT `tur_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id`),
  ADD CONSTRAINT `tur_ibfk_2` FOREIGN KEY (`id_mesta`) REFERENCES `mesta` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
