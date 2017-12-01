-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 01 2017 г., 10:36
-- Версия сервера: 5.7.20-0ubuntu0.16.04.1
-- Версия PHP: 7.1.11-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Sklad`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `REPORT` (`R_year` INT, `R_month` INT)  BEGIN
DECLARE id_p INT;
DECLARE name_p VARCHAR(30);
DECLARE sum_i DECIMAL(9,2);
DECLARE done INT DEFAULT 0;
DECLARE C1 CURSOR FOR SELECT p_id, pr_name, inv_S
                      FROM  product LEFT JOIN (SELECT p_id, SUM(inv_line.count*reserve.cost) inv_S
                                               FROM inv_line JOIN invoice USING(inv_id) JOIN reserve USING(res_id)
                                               WHERE YEAR(inv_date)=R_year AND MONTH(inv_date)=R_month
                                               GROUP BY p_id) T2 USING(p_id)
                      WHERE inv_S IS NOT NULL;
DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done=1;
OPEN C1;
REPEAT
   FETCH C1 INTO id_p, name_p, sum_i;
   IF done=0 THEN
      INSERT report VALUES (NULL, R_year, R_month, id_p, name_p, sum_i);
   END IF;
UNTIL (done=1) END REPEAT;
CLOSE C1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RES_UPDATE` ()  BEGIN
	DECLARE pr_id, pr_cost, pr_count INTEGER;
	DECLARE done INTEGER DEFAULT 0;
	DECLARE C1 CURSOR FOR
		SELECT p_id, cost, count FROM reserve
		WHERE res_date = (SELECT MAX(res_date) FROM reserve);
	DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done=1;
	OPEN C1;
	REPEAT
		IF(done = 0) THEN
			FETCH C1 INTO pr_id, pr_cost, pr_count;
			INSERT INTO `reserve` (`res_id`, `p_id`, `cost`, `count`, `res_date`) VALUES (NULL, pr_id, pr_cost, pr_count, CURDATE());
		END IF;
	UNTIL (done=1) END REPEAT;
	CLOSE C1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `ALL_USER`
--

CREATE TABLE `ALL_USER` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `u_pswd` varchar(255) NOT NULL,
  `u_group` varchar(30) NOT NULL,
  `db_pswd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ALL_USER`
--

INSERT INTO `ALL_USER` (`id`, `login`, `u_pswd`, `u_group`, `db_pswd`) VALUES
(1, 'user1', '1a1a9853f4bbfcbc7b65cb264e319cd3', 'sklad_manager', 'a123b'),
(2, 'user2', '1a1a9853f4bbfcbc7b65cb264e319cd3', 'sklad_director', 'a123b'),
(3, 'user3', '1a1a9853f4bbfcbc7b65cb264e319cd3', 'sklad_shop_assistant', 'a123b');

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `cl_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `contract_date` date DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`cl_id`, `name`, `city`, `contract_date`, `is_active`) VALUES
(1, 'Иванов', 'Москва', '2016-08-15', 1),
(2, 'Петров', 'Санкт-Петербург', '2016-12-04', 1),
(3, 'Самойлов', 'Уфа', '2015-10-11', 1),
(4, 'Гусев', 'Казань', '2016-04-20', 1),
(5, 'Попов', 'Екатеренбург', '2016-12-11', 1),
(6, 'Лебедев', 'Самара', '2017-02-01', 1),
(7, 'Волков', 'Челябинск', '2017-04-16', 1),
(8, 'Смит', 'Мехико', '2017-11-20', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `invoice`
--

CREATE TABLE `invoice` (
  `inv_id` int(11) NOT NULL,
  `cl_id` int(11) NOT NULL,
  `inv_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `invoice`
--

INSERT INTO `invoice` (`inv_id`, `cl_id`, `inv_date`) VALUES
(1, 4, '2017-01-03'),
(2, 6, '2017-01-04'),
(3, 1, '2017-01-06'),
(4, 3, '2017-02-07'),
(5, 5, '2017-02-10'),
(6, 2, '2017-02-15'),
(7, 4, '2017-02-19'),
(8, 5, '2017-02-28'),
(9, 2, '2017-03-01'),
(10, 4, '2017-03-15'),
(12, 6, '2017-11-23'),
(13, 7, '2017-11-23'),
(14, 1, '2017-11-23'),
(15, 1, '2017-11-23'),
(16, 3, '2017-11-23'),
(17, 3, '2017-11-23'),
(18, 6, '2017-11-23'),
(19, 6, '2017-11-23'),
(20, 6, '2017-11-23'),
(21, 5, '2017-11-23'),
(22, 3, '2017-11-23'),
(23, 4, '2017-11-23'),
(24, 5, '2017-11-24'),
(25, 3, '2017-11-24'),
(26, 5, '2017-11-24'),
(27, 3, '2017-11-24'),
(28, 5, '2017-11-24'),
(29, 3, '2017-11-30'),
(30, 5, '2017-11-30'),
(31, 2, '2017-11-30'),
(32, 7, '2017-11-30'),
(33, 5, '2017-11-30'),
(34, 6, '2017-11-30'),
(35, 1, '2017-12-01');

-- --------------------------------------------------------

--
-- Структура таблицы `inv_line`
--

CREATE TABLE `inv_line` (
  `line_id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `inv_line`
--

INSERT INTO `inv_line` (`line_id`, `inv_id`, `res_id`, `count`) VALUES
(1, 1, 4, 2),
(2, 1, 12, 50),
(3, 1, 2, 50),
(4, 2, 5, 3),
(5, 3, 7, 4),
(6, 3, 10, 1),
(7, 4, 1, 15),
(8, 4, 9, 2),
(9, 5, 11, 1),
(10, 5, 3, 20),
(11, 6, 2, 100),
(12, 7, 12, 200),
(13, 7, 2, 50),
(14, 8, 9, 5),
(15, 8, 4, 4),
(16, 9, 10, 5),
(17, 10, 8, 5),
(18, 10, 6, 2),
(19, 3, 4, 1),
(20, 12, 20, 2),
(21, 12, 21, 2),
(22, 12, 22, 1),
(23, 12, 23, 1),
(24, 13, 21, 2),
(25, 13, 20, 102),
(26, 13, 22, 153),
(27, 14, 20, 1),
(28, 15, 20, 1),
(29, 15, 21, 1),
(30, 16, 20, 200),
(31, 16, 21, 50),
(32, 16, 22, 25),
(33, 16, 23, 1),
(34, 17, 16, 3),
(35, 18, 17, 9),
(36, 18, 21, 3),
(37, 18, 20, 5),
(38, 18, 16, 3),
(39, 18, 14, 4),
(40, 18, 22, 1),
(41, 18, 23, 2),
(42, 18, 18, 5),
(43, 19, 17, 9),
(44, 19, 21, 3),
(45, 19, 20, 5),
(46, 19, 16, 3),
(47, 19, 14, 4),
(48, 19, 22, 1),
(49, 19, 23, 2),
(50, 19, 18, 5),
(51, 20, 17, 9),
(52, 20, 21, 3),
(53, 20, 20, 5),
(54, 20, 16, 3),
(55, 20, 14, 4),
(56, 20, 22, 1),
(57, 20, 23, 2),
(58, 20, 18, 5),
(59, 21, 17, 10),
(60, 21, 16, 5),
(61, 21, 14, 4),
(62, 21, 18, 2),
(63, 21, 20, 4),
(64, 21, 21, 6),
(65, 21, 22, 7),
(66, 21, 23, 6),
(67, 22, 21, 1),
(68, 22, 14, 2),
(69, 22, 17, 100),
(70, 23, 14, 6),
(71, 24, 17, 2),
(72, 24, 21, 1),
(73, 24, 20, 5),
(74, 25, 56, 3),
(75, 25, 44, 2),
(76, 25, 49, 1),
(77, 25, 48, 1),
(78, 25, 51, 2),
(79, 25, 46, 1),
(80, 25, 50, 1),
(81, 26, 45, 100),
(82, 27, 57, 10),
(83, 28, 58, 50),
(84, 29, 62, 1),
(85, 30, 63, 1),
(86, 30, 67, 1),
(87, 31, 67, 3),
(88, 32, 63, 3),
(89, 33, 73, 4),
(90, 34, 68, 2),
(91, 34, 65, 1),
(92, 34, 66, 1),
(93, 35, 81, 3);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `inv_sum`
--
CREATE TABLE `inv_sum` (
`month` int(2)
,`year` int(4)
,`sum` decimal(19,2)
);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `line_sum`
--
CREATE TABLE `line_sum` (
`month` int(2)
,`year` int(4)
,`inv_id` int(11)
,`sum` decimal(19,2)
);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `max_sum`
--
CREATE TABLE `max_sum` (
`id` int(11)
,`days` date
,`name` varchar(20)
,`summa` decimal(41,2)
);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `pr_name` varchar(20) NOT NULL,
  `gr_id` int(11) NOT NULL,
  `measure` varchar(10) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`p_id`, `pr_name`, `gr_id`, `measure`, `is_active`) VALUES
(1, 'Гвоздь', 6, 'кг', 1),
(2, 'Цемент', 1, 'кг', 1),
(3, 'Кирпич', 1, 'шт', 1),
(4, 'White Paint', 3, 'кг', 1),
(5, 'Blue Paint', 3, 'кг', 1),
(6, 'Желтая краска', 3, 'кг', 1),
(7, 'Green Paint', 3, 'кг', 0),
(8, 'Gray Paint', 3, 'кг', 1),
(9, 'Лопата', 2, 'шт', 1),
(10, 'Топор', 2, 'шт', 0),
(11, 'Молоток', 2, 'шт', 1),
(12, 'Электрический провод', 4, 'м', 0),
(13, 'Труба', 7, 'м', 1),
(20, 'Винт М6', 6, 'шт', 1),
(21, 'Саморез 3,5х5', 6, 'шт', 1),
(22, 'Саморез 3,5х5', 6, 'шт', 1),
(23, 'Гайка М8', 6, 'шт', 1),
(24, 'Краска (голубая)', 3, 'кг', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `provider`
--

CREATE TABLE `provider` (
  `id_prov` int(11) NOT NULL,
  `city` varchar(15) NOT NULL,
  `name` varchar(15) NOT NULL,
  `bank_name` varchar(15) NOT NULL,
  `bank_account` varchar(20) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `provider`
--

INSERT INTO `provider` (`id_prov`, `city`, `name`, `bank_name`, `bank_account`, `is_active`) VALUES
(1, 'Москва', 'СтройИнвест', 'The Best BANK', '12341234123412341234', 1),
(2, 'Уфа', 'Три шурупа', 'Uralsib', '10210210210210210216', 1),
(3, 'Казань', 'СтройАрсенал', 'Ak Bars Bank', '11611611611611611602', 1),
(4, 'Самара', 'ХимПром', 'Sberbank', '16316316316316316302', 1),
(5, 'Липецк', 'ГлобалБилдинг', 'VTB Bank', '11121314151617181910', 1),
(6, 'New York', 'BuildersCo', 'WCB', '11111111111111111111', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_group`
--

CREATE TABLE `pr_group` (
  `gr_id` int(11) NOT NULL,
  `gr_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pr_group`
--

INSERT INTO `pr_group` (`gr_id`, `gr_name`) VALUES
(1, 'Стройматериалы'),
(2, 'Инструменты'),
(3, 'Краски'),
(4, 'Электротовары'),
(5, 'Запчасти'),
(6, 'Крепёж'),
(7, 'Прокат');

-- --------------------------------------------------------

--
-- Структура таблицы `report`
--

CREATE TABLE `report` (
  `r_id` int(11) NOT NULL,
  `r_year` int(11) NOT NULL,
  `r_month` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `pr_name` varchar(30) NOT NULL,
  `invoice_sum` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `report`
--

INSERT INTO `report` (`r_id`, `r_year`, `r_month`, `p_id`, `pr_name`, `invoice_sum`) VALUES
(309, 2017, 2, 1, 'Гвоздь', '2000.00'),
(310, 2017, 2, 2, 'Цемент', '1500.00'),
(311, 2017, 2, 3, 'Кирпич', '1400.00'),
(312, 2017, 2, 4, 'White Paint', '720.00'),
(313, 2017, 2, 9, 'Лопата', '630.00'),
(314, 2017, 2, 11, 'Молоток', '100.00'),
(315, 2017, 2, 12, 'Электрический провод', '375.00'),
(322, 2017, 1, 2, 'Цемент', '500.00'),
(323, 2017, 1, 3, 'Кирпич', '350.00'),
(324, 2017, 1, 4, 'White Paint', '540.00'),
(325, 2017, 1, 5, 'Blue Paint', '480.00'),
(326, 2017, 1, 7, 'Green Paint', '680.00'),
(327, 2017, 1, 10, 'Топор', '300.00'),
(328, 2017, 3, 6, 'Yellow Paint', '380.00'),
(329, 2017, 3, 8, 'Gray Paint', '800.00'),
(330, 2017, 3, 10, 'Топор', '1500.00');

-- --------------------------------------------------------

--
-- Структура таблицы `reserve`
--

CREATE TABLE `reserve` (
  `res_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `cost` decimal(9,2) NOT NULL,
  `count` int(11) NOT NULL,
  `res_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reserve`
--

INSERT INTO `reserve` (`res_id`, `p_id`, `cost`, `count`, `res_date`) VALUES
(1, 12, '25.00', 100, '2017-11-20'),
(2, 2, '10.00', 1000, '2017-11-20'),
(3, 1, '100.00', 50, '2017-01-01'),
(4, 4, '180.00', 20, '2017-11-20'),
(5, 5, '160.00', 15, '2017-11-20'),
(6, 6, '190.00', 10, '2017-01-01'),
(7, 7, '170.00', 17, '2017-01-01'),
(8, 8, '160.00', 15, '2017-01-01'),
(9, 9, '90.00', 30, '2017-11-20'),
(10, 10, '300.00', 50, '2017-01-01'),
(11, 11, '100.00', 20, '2017-11-20'),
(12, 3, '7.00', 5000, '2017-11-20'),
(13, 13, '60.00', 90, '2016-11-20'),
(14, 6, '90.00', 12, '2017-11-20'),
(15, 10, '60.00', 8, '2017-11-20'),
(16, 7, '5.00', 4, '2017-11-20'),
(17, 8, '95.00', 14, '2017-11-20'),
(18, 1, '8.00', 10, '2017-11-20'),
(20, 20, '1.00', 100, '2017-11-20'),
(21, 22, '0.50', 250, '2017-11-20'),
(22, 23, '1.50', 50, '2017-11-20'),
(23, 24, '190.00', 12, '2017-11-20'),
(44, 12, '25.00', 100, '2017-11-24'),
(45, 2, '10.00', 900, '2017-11-24'),
(46, 4, '180.00', 20, '2017-11-24'),
(47, 5, '160.00', 15, '2017-11-24'),
(48, 9, '90.00', 30, '2017-11-24'),
(49, 11, '100.00', 20, '2017-11-24'),
(50, 3, '7.00', 5000, '2017-11-24'),
(51, 6, '90.00', 12, '2017-11-24'),
(52, 10, '60.00', 8, '2017-11-24'),
(53, 7, '5.00', 4, '2017-11-24'),
(54, 8, '95.00', 14, '2017-11-24'),
(55, 1, '8.00', 10, '2017-11-24'),
(56, 20, '1.00', 100, '2017-11-24'),
(57, 22, '1.00', 240, '2017-11-24'),
(58, 23, '2.00', 0, '2017-11-24'),
(60, 24, '190.00', 12, '2017-11-24'),
(61, 12, '25.00', 100, '2017-11-30'),
(62, 2, '10.00', 899, '2017-11-30'),
(63, 4, '180.00', 16, '2017-11-30'),
(64, 5, '160.00', 15, '2017-11-30'),
(65, 9, '90.00', 29, '2017-11-30'),
(66, 11, '100.00', 19, '2017-11-30'),
(67, 3, '7.00', 4996, '2017-11-30'),
(68, 6, '90.00', 10, '2017-11-30'),
(69, 10, '60.00', 8, '2017-11-30'),
(70, 7, '5.00', 4, '2017-11-30'),
(71, 8, '95.00', 14, '2017-11-30'),
(72, 1, '8.00', 10, '2017-11-30'),
(73, 20, '1.00', 96, '2017-11-30'),
(74, 22, '1.00', 240, '2017-11-30'),
(75, 23, '2.00', 0, '2017-11-30'),
(76, 24, '190.00', 12, '2017-11-30'),
(77, 24, '190.00', 12, '2017-11-30'),
(78, 12, '25.00', 100, '2017-12-01'),
(79, 2, '10.00', 899, '2017-12-01'),
(80, 4, '180.00', 16, '2017-12-01'),
(81, 5, '160.00', 12, '2017-12-01'),
(82, 9, '90.00', 29, '2017-12-01'),
(83, 11, '100.00', 19, '2017-12-01'),
(84, 3, '7.00', 4996, '2017-12-01'),
(85, 6, '90.00', 10, '2017-12-01'),
(86, 10, '60.00', 8, '2017-12-01'),
(87, 7, '5.00', 4, '2017-12-01'),
(88, 8, '95.00', 14, '2017-12-01'),
(89, 1, '8.00', 10, '2017-12-01'),
(90, 20, '1.00', 96, '2017-12-01'),
(91, 22, '1.00', 240, '2017-12-01'),
(92, 23, '2.00', 0, '2017-12-01'),
(93, 24, '190.00', 12, '2017-12-01'),
(94, 24, '190.00', 12, '2017-12-01'),
(95, 24, '190.00', 12, '2017-12-01');

-- --------------------------------------------------------

--
-- Структура таблицы `supply`
--

CREATE TABLE `supply` (
  `id_sup` int(11) NOT NULL,
  `date_sup` date NOT NULL,
  `id_p` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `cost` decimal(9,2) NOT NULL,
  `id_prov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `supply`
--

INSERT INTO `supply` (`id_sup`, `date_sup`, `id_p`, `count`, `cost`, `id_prov`) VALUES
(1, '2016-08-09', 2, 1000, '10.00', 5),
(2, '2016-10-05', 3, 5000, '7.00', 5),
(3, '2016-01-12', 1, 50, '100.00', 2),
(4, '2016-07-19', 4, 20, '180.00', 4),
(5, '2016-08-21', 5, 15, '160.00', 4),
(6, '2016-08-21', 6, 10, '190.00', 4),
(7, '2016-06-27', 7, 17, '170.00', 4),
(8, '2016-05-17', 8, 25, '160.00', 4),
(9, '2016-04-15', 9, 30, '90.00', 3),
(10, '2016-05-17', 10, 50, '300.00', 3),
(11, '2016-03-16', 11, 20, '100.00', 3),
(12, '2016-06-12', 12, 100, '25.00', 1),
(13, '2017-01-10', 5, 10, '50.00', 3),
(14, '2017-01-16', 10, 5, '40.00', 4),
(15, '2017-01-20', 5, 5, '40.00', 5),
(16, '2017-01-21', 11, 2, '20.00', 1),
(17, '2017-01-29', 2, 10, '10.00', 3);

-- --------------------------------------------------------

--
-- Структура для представления `inv_sum`
--
DROP TABLE IF EXISTS `inv_sum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inv_sum`  AS  select month(`invoice`.`inv_date`) AS `month`,year(`invoice`.`inv_date`) AS `year`,(`reserve`.`cost` * `inv_line`.`count`) AS `sum` from ((`inv_line` join `invoice` on((`inv_line`.`inv_id` = `invoice`.`inv_id`))) join `reserve` on((`inv_line`.`res_id` = `reserve`.`res_id`))) ;

-- --------------------------------------------------------

--
-- Структура для представления `line_sum`
--
DROP TABLE IF EXISTS `line_sum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `line_sum`  AS  select month(`invoice`.`inv_date`) AS `month`,year(`invoice`.`inv_date`) AS `year`,`inv_line`.`inv_id` AS `inv_id`,(`reserve`.`cost` * `inv_line`.`count`) AS `sum` from ((`inv_line` join `invoice` on((`inv_line`.`inv_id` = `invoice`.`inv_id`))) join `reserve` on((`inv_line`.`res_id` = `reserve`.`res_id`))) ;

-- --------------------------------------------------------

--
-- Структура для представления `max_sum`
--
DROP TABLE IF EXISTS `max_sum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `max_sum`  AS  select `invoice`.`cl_id` AS `id`,`invoice`.`inv_date` AS `days`,`client`.`name` AS `name`,sum((`reserve`.`cost` * `inv_line`.`count`)) AS `summa` from (((`invoice` join `inv_line` on((`invoice`.`inv_id` = `inv_line`.`inv_id`))) join `reserve` on((`inv_line`.`res_id` = `reserve`.`res_id`))) join `client` on((`invoice`.`cl_id` = `client`.`cl_id`))) group by year(`invoice`.`inv_date`),month(`invoice`.`inv_date`),`invoice`.`cl_id` ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ALL_USER`
--
ALTER TABLE `ALL_USER`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cl_id`);

--
-- Индексы таблицы `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`inv_id`),
  ADD KEY `FK_4` (`cl_id`);

--
-- Индексы таблицы `inv_line`
--
ALTER TABLE `inv_line`
  ADD PRIMARY KEY (`line_id`),
  ADD KEY `FK_5` (`inv_id`),
  ADD KEY `FK_7` (`res_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `FK_1` (`gr_id`);

--
-- Индексы таблицы `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id_prov`);

--
-- Индексы таблицы `pr_group`
--
ALTER TABLE `pr_group`
  ADD PRIMARY KEY (`gr_id`);

--
-- Индексы таблицы `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `FK_R1` (`p_id`);

--
-- Индексы таблицы `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `FK_6` (`p_id`);

--
-- Индексы таблицы `supply`
--
ALTER TABLE `supply`
  ADD PRIMARY KEY (`id_sup`),
  ADD KEY `FK_2` (`id_p`),
  ADD KEY `FK_3` (`id_prov`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ALL_USER`
--
ALTER TABLE `ALL_USER`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `invoice`
--
ALTER TABLE `invoice`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT для таблицы `inv_line`
--
ALTER TABLE `inv_line`
  MODIFY `line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `provider`
--
ALTER TABLE `provider`
  MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `pr_group`
--
ALTER TABLE `pr_group`
  MODIFY `gr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `report`
--
ALTER TABLE `report`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;
--
-- AUTO_INCREMENT для таблицы `reserve`
--
ALTER TABLE `reserve`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT для таблицы `supply`
--
ALTER TABLE `supply`
  MODIFY `id_sup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `FK_4` FOREIGN KEY (`cl_id`) REFERENCES `client` (`cl_id`);

--
-- Ограничения внешнего ключа таблицы `inv_line`
--
ALTER TABLE `inv_line`
  ADD CONSTRAINT `FK_5` FOREIGN KEY (`inv_id`) REFERENCES `invoice` (`inv_id`),
  ADD CONSTRAINT `FK_7` FOREIGN KEY (`res_id`) REFERENCES `reserve` (`res_id`);

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_1` FOREIGN KEY (`gr_id`) REFERENCES `pr_group` (`gr_id`);

--
-- Ограничения внешнего ключа таблицы `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `FK_R1` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`);

--
-- Ограничения внешнего ключа таблицы `reserve`
--
ALTER TABLE `reserve`
  ADD CONSTRAINT `FK_6` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`);

--
-- Ограничения внешнего ключа таблицы `supply`
--
ALTER TABLE `supply`
  ADD CONSTRAINT `FK_2` FOREIGN KEY (`id_p`) REFERENCES `product` (`p_id`),
  ADD CONSTRAINT `FK_3` FOREIGN KEY (`id_prov`) REFERENCES `provider` (`id_prov`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
