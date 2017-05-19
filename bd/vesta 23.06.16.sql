-- phpMyAdmin SQL Dump
-- version 4.4.15.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 23 2016 г., 04:16
-- Версия сервера: 10.0.22-MariaDB
-- Версия PHP: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `vesta`
--

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL,
  `fio` varchar(256) DEFAULT NULL,
  `id_otdel` int(11) DEFAULT NULL,
  `id_doljn` int(11) DEFAULT NULL,
  `tel` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `kabinet` varchar(64) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `fio`, `id_otdel`, `id_doljn`, `tel`, `email`, `kabinet`) VALUES
(15, 'Чижова Ирина Викторовна', 99, 1, '180', 'bug1@nggti.ru', '7'),
(16, 'Медянская Лариса Сергеевна', 5, 4, '121', 'lmedanska@nggti.ru', '118'),
(17, 'Уваров Андрей Александрович', 3, 3, '-', 'auvarov@nggti.ru', 'Автокласс'),
(18, 'Пейрута Олег Михайлович', 100, 8, '31796', 'stolov1@nggti.ru', 'Столовая колледж'),
(19, 'Иванчихин Андрей Александрович', 3, 5, '-', 'transport@nggti.ru', 'Гараж'),
(20, 'Федько Иван Алексеевич', 101, 7, 'доб 196', 'usmu@nggti.ru', '-');

-- --------------------------------------------------------

--
-- Структура таблицы `doljn`
--

CREATE TABLE IF NOT EXISTS `doljn` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `doljn`
--

INSERT INTO `doljn` (`id`, `name`) VALUES
(1, 'Бухалтер'),
(2, 'Рабочий по комплексному обслуживанию и ремонту'),
(3, 'Водитель'),
(4, 'Юрист'),
(5, 'Диспетчер'),
(6, 'Методист'),
(7, 'Слесарь'),
(8, 'Повар');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL,
  `theme` varchar(256) DEFAULT NULL,
  `msg` text,
  `date_create` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `theme`, `msg`, `date_create`) VALUES
(1, 'Сокращённый рабочий день', 'В связи с прекращением элекроснабжения 14.06.2016 рабочий день сокращается на один час.', '2016-06-17 17:27:38'),
(3, 'Отдел маркетинга', 'Отдел маркетинка сменил кабинет с 17 на 9.', '2016-06-17 21:18:11'),
(4, 'Всем зайти в кабинет 202 общ1', 'Проведена специальная оценка труда, всем сотрудникам, срочно подписаться в полученых документах.', '2016-06-17 21:23:15'),
(5, 'Отключение сети', '17.06.2016 с 13:00 по 16:00 сеть будет отключена.', '2016-06-17 21:24:35');

-- --------------------------------------------------------

--
-- Структура таблицы `otdel`
--

CREATE TABLE IF NOT EXISTS `otdel` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `otdel`
--

INSERT INTO `otdel` (`id`, `name`) VALUES
(3, 'Транспортный отдел'),
(4, 'Приёмная'),
(5, 'Юридический отдел'),
(6, 'УМУ'),
(88, 'Отдел Кадров'),
(99, 'Бухгалтерия'),
(100, 'Столовая'),
(101, 'УСМУ'),
(102, 'Общий отдел');

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL,
  `user_create_id` int(11) DEFAULT NULL,
  `user_to_id` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `theme` varchar(256) DEFAULT NULL,
  `msg` text,
  `id_client` int(11) DEFAULT NULL,
  `id_otdel` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `prioritet` int(11) DEFAULT NULL,
  `arch` int(11) DEFAULT NULL,
  `date_ok` datetime DEFAULT NULL,
  `history` varchar(512) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`id`, `user_create_id`, `user_to_id`, `date_create`, `theme`, `msg`, `id_client`, `id_otdel`, `status`, `prioritet`, `arch`, `date_ok`, `history`, `last_update`) VALUES
(39, 34, 36, '2016-06-13 20:15:35', 'Принтер', 'Не печатает, возможно отвалилась сеть.', 16, 5, 2, 1, 0, NULL, '36', NULL),
(40, 38, 35, '2016-06-20 21:19:25', 'ЭЦП Криста', 'Активировать новый ключ для кристы, до 26.06.2016.', 15, 99, 1, 1, 0, NULL, '35', NULL),
(41, 38, 35, '2016-06-20 21:20:11', 'Сканер не работает', 'Настроить работу сканера', 16, 5, 1, 1, 0, NULL, '35', NULL),
(42, 38, 35, '2016-06-20 21:21:12', 'Сеть', 'Уже день не работает сеть и общие документы.', 17, 3, 2, 1, 0, NULL, '35', NULL),
(43, 38, 35, '2016-06-20 21:22:23', 'Камера', 'Не работает камера на трассире, возможно надо обновить ключ.', 19, 3, 0, 0, 0, NULL, '35', NULL),
(44, 38, 35, '2016-06-20 21:23:37', 'Шлюз', 'Сервер 1С с обеда не работает.', 15, 99, 2, 0, 0, NULL, '35', NULL),
(45, 38, 35, '2016-06-20 21:24:11', 'Права доступа', 'Нет прав доступа на общие документы', 16, 5, 1, 2, 0, NULL, '35', NULL),
(46, 35, 36, '2016-06-20 22:00:13', 'ЦДПО', 'Заменить картридж кабинет 12', 15, 99, 2, 1, 0, NULL, '36', NULL),
(47, 35, 36, '2016-06-20 22:01:50', 'Lync', 'Настроить юристам Lync.', 16, 5, 0, 1, 0, NULL, '36', NULL),
(48, 35, 36, '2016-06-22 20:25:02', 'Тест', 'Firefox не может установить соединение с сервером bootstrap-3.ru.\r\n\r\n    Возможно, сайт временно недоступен или перегружен запросами. Подождите некоторое время и попробуйте снова.\r\n    Если вы не можете загрузить ни одну страницу – проверьте настройки соединения с Интернетом.\r\n    Если ваш компьютер или сеть защищены межсетевым экраном или прокси-сервером – убедитесь, что Firefox разрешён выход в Интернет.', 16, 5, 2, 1, 0, NULL, '35', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `fio` varchar(256) DEFAULT NULL,
  `login` varchar(64) DEFAULT NULL,
  `pass` varchar(64) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `priv` int(1) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `tel` varchar(32) DEFAULT NULL,
  `last_time` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `login`, `pass`, `status`, `priv`, `email`, `tel`, `last_time`) VALUES
(34, 'Администратор', 'admin', '356a192b7913b04c54574d18c28d46e6395428ab', 1, 0, 'sabashlive@gmail.com', '----', '2016-06-23 06:59:11'),
(35, 'Сергеев Артём Николаевич', 'U2', '356a192b7913b04c54574d18c28d46e6395428ab', 1, 2, 'sabashlive@gmail.com', '123', '2016-06-23 07:01:50'),
(36, 'Каплин Сергей Вячеславович', 'U', '356a192b7913b04c54574d18c28d46e6395428ab', 1, 2, 'sabashlive@gmail.com', '123', '2016-06-23 00:38:06'),
(38, 'Координатор', 'K', '356a192b7913b04c54574d18c28d46e6395428ab', 1, 1, 'sabashlive@gmail.com', '123', '2016-06-20 21:18:03'),
(42, 'Гришкова Алла Михайловна', 'U3', '356a192b7913b04c54574d18c28d46e6395428ab', 1, 2, 'sabashlive@gmail.com', '123', '2016-06-08 11:21:52'),
(44, 'Исполнитель', 'I', '0822e8ed92c42f678825aa67e6b1f8e130941230', 1, 2, 'sabashlive@gmail.com', '123', '2016-05-30 11:58:21');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_otdel` (`id_otdel`) USING BTREE,
  ADD KEY `id_doljn` (`id_doljn`);

--
-- Индексы таблицы `doljn`
--
ALTER TABLE `doljn`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `otdel`
--
ALTER TABLE `otdel`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_create_id` (`user_create_id`),
  ADD KEY `user_to_id` (`user_to_id`),
  ADD KEY `id_client` (`id_client`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `doljn`
--
ALTER TABLE `doljn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `otdel`
--
ALTER TABLE `otdel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`id_otdel`) REFERENCES `otdel` (`id`),
  ADD CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`id_doljn`) REFERENCES `doljn` (`id`);

--
-- Ограничения внешнего ключа таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_create_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`user_to_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
