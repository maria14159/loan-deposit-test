-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 07 2022 г., 19:35
-- Версия сервера: 8.0.15
-- Версия PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bank_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `deposit`
--

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `open_date` date NOT NULL,
  `close_date` date NOT NULL,
  `time` tinyint(4) NOT NULL,
  `rate` tinyint(4) NOT NULL,
  `capitalization` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `deposit`
--

INSERT INTO `deposit` (`id`, `person_id`, `open_date`, `close_date`, `time`, `rate`, `capitalization`) VALUES
(6, 20, '0456-03-12', '0456-03-12', 12, 12, 'В конце срока');

-- --------------------------------------------------------

--
-- Структура таблицы `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `open_date` date NOT NULL,
  `close_date` date NOT NULL,
  `sum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `loan`
--

INSERT INTO `loan` (`id`, `person_id`, `open_date`, `close_date`, `sum`) VALUES
(21, 20, '0456-03-12', '0456-03-12', 1234456);

-- --------------------------------------------------------

--
-- Структура таблицы `organization`
--

CREATE TABLE `organization` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `inn` text NOT NULL,
  `ogrn` text NOT NULL,
  `kpp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `organization`
--

INSERT INTO `organization` (`id`, `name`, `address`, `inn`, `ogrn`, `kpp`) VALUES
(1, 'sgdgfgdgdg', 'sgdgdhgdhg', '12345678', '12345567', '123456');

-- --------------------------------------------------------

--
-- Структура таблицы `passport`
--

CREATE TABLE `passport` (
  `id` int(11) NOT NULL,
  `series` smallint(6) NOT NULL,
  `number` mediumint(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `passport`
--

INSERT INTO `passport` (`id`, `series`, `number`, `date`) VALUES
(36, 9412, 331830, '0045-03-12'),
(37, 9412, 331830, '0045-03-12'),
(38, 9412, 331830, '0045-03-12');

-- --------------------------------------------------------

--
-- Структура таблицы `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `inn` text NOT NULL,
  `birth_date` date DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `passport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `person`
--

INSERT INTO `person` (`id`, `fio`, `inn`, `birth_date`, `organization_id`, `passport_id`) VALUES
(20, 'Миронова Мария Станиславовна', '12345678', NULL, 1, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- Индексы таблицы `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- Индексы таблицы `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `passport`
--
ALTER TABLE `passport`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `passport_id` (`passport_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `passport`
--
ALTER TABLE `passport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `deposit_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `person_ibfk_2` FOREIGN KEY (`passport_id`) REFERENCES `passport` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
