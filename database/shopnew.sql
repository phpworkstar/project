-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 03, 2023 at 02:25 AM
-- Server version: 10.7.5-MariaDB
-- PHP Version: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopnew`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getcat` (IN `cid` INT)   SELECT * FROM categories WHERE cat_id=cid$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(300) NOT NULL,
  `admin_password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'info@produkti.by', '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Минская марка'),
(2, 'Савушкин Продукт'),
(3, 'Минскхлебпром'),
(4, 'Белпродукт'),
(5, 'Белбакалея'),
(6, 'Белрыба'),
(7, 'Другой производитель');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Хлебобулочные изделия'),
(2, 'Молочные продукты'),
(3, 'Крупы'),
(4, 'Рыба'),
(5, 'Чипсы и снеки'),
(6, 'Кондитерские изделия'),
(7, 'Напитки');

-- --------------------------------------------------------

--
-- Table structure for table `email_info`
--

CREATE TABLE `email_info` (
  `email_id` int(100) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_info`
--

INSERT INTO `email_info` (`email_id`, `email`) VALUES
(4, 'info@produkti.by'),
(10, 'support@produkti.by');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `p_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders_info`
--

CREATE TABLE `orders_info` (
  `order_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(10) NOT NULL,
  `cardname` varchar(255) NOT NULL,
  `cardnumber` varchar(20) NOT NULL,
  `expdate` varchar(255) NOT NULL,
  `prod_count` int(15) DEFAULT NULL,
  `total_amount` int(15) DEFAULT NULL,
  `cvv` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_info`
--

INSERT INTO `orders_info` (`order_id`, `user_id`, `f_name`, `email`, `address`, `city`, `state`, `zip`, `cardname`, `cardnumber`, `expdate`, `prod_count`, `total_amount`, `cvv`) VALUES
(1, 29, 'name surname', 'namesurname@produkti.by', 'adres', 'minsk', 'minsk', 111111, 'name', '2222222', '07/26', 1, 1000, 222),
(2, 29, 'name surname', 'namesurname@produkti.by', 'adres', 'minsk', 'minsk', 220110, 'name surname', '2222', '07/26', 2, 2420, 222),
(3, 29, 'name surname', 'namesurname@produkti.by', 'adres', 'minsk', 'minsk', 222111, 'surname name', '2222', '07/26', 1, 2, 222),
(4, 29, 'name surname', 'namesurname@produkti.by', 'adres', 'minsk', 'minsk', 220221, 'surname name', '2222', '07/26', 1, 1000, 222),
(5, 29, 'name surname', 'namesurname@produkti.by', 'adres', 'minsk', 'minsk', 222222, 'name', '2222', '07/26', 1, 2, 222);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_pro_id` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(15) DEFAULT NULL,
  `amt` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`order_pro_id`, `order_id`, `product_id`, `qty`, `amt`) VALUES
(135, 1, 6, 1000, 1000),
(136, 2, 1, 1000, 2000),
(137, 2, 30, 20, 420),
(138, 3, 18, 1, 2),
(139, 4, 6, 1000, 1000),
(140, 5, 7, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_pr` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_pr`) VALUES
(1, 1, 3, 'Ржаной хлеб', 2, 'Свежий ржаной хлеб 1 кг', '1675819841_hleb.jpg', 'Вкусный только с хлебозавода'),
(2, 6, 3, 'Торт Вечерняя зорька', 31, 'Торт слоёный со сметанным кремом 2 кг', '1675469157_cake1.JPG', 'Вкусный торт для вашего праздничного стола'),
(3, 1, 7, 'Хлеб ржано-пшеничный Майский', 2, 'Хлеб 900 г  ', '1675630123_hleb2.jpg', 'Вкусный хлеб, который подходит ко всем блюдам'),
(4, 4, 6, 'Рыба Дорада 1кг', 26, 'Свежая рыба Дорада 1 кг', '1675469316_fish.jpg', 'Всегда свежая рыба к вашему столу'),
(5, 3, 7, 'Крупа манная 1кг', 2, 'Крупа манная 1кг', '1675647374_krupa2.png', 'урожай 2022'),
(6, 3, 7, 'Картофель 1кг', 1, 'Картофель урожай 2022 года ', '1675471267_kartofan.jpg', 'Вкусный картофель идеально подходит для любых блюд'),
(7, 3, 7, 'Крупа гречневая 1кг', 2, 'Крупа гречневая 1кг', '1675647364_krupa1.png', 'урожай 2022г.'),
(8, 7, 5, 'Напиток безалкогольный Росинка', 2, 'Газированый сладкий напиток Росинка', '1675647447_rosinka.jpg', 'Вкусный сладкий напиток'),
(9, 1, 3, 'Хлеб ржаной Знатный водар', 1, 'Хлеб 860 г', '1675630248_hleb3.jpg', 'Вкусный мягкий хлеб уже порезнный для простоты использования'),
(10, 1, 3, 'Хлеб Столичный', 2, 'Хлеб пшеничный 700 г', '1675630778_hleb4.jpg', 'Вкусный хлеб'),
(11, 1, 5, 'Хлеб Пшеничка', 1, 'Хлеб пшеничный 600 г', '1675630952_hleb5.jpg', 'Вкусный белый хлеб'),
(12, 1, 3, 'Багет Белорусочка', 2, 'Пшеничный хлеб 500 г', '1675632094_hleb7.jpg', 'Вкусный хлеб'),
(13, 1, 7, 'Фитохлеб цельнозерновой', 5, 'Хлеб цельнозерновой 200 г', '1675647593_hleb6.jpg', 'Здоровое питание'),
(14, 1, 7, 'Хлеб Даниловский', 2, 'Хлеб ржано-пшеничный 1 кг', '1675632723_hleb9.JPG', 'Старинный хлеб'),
(15, 1, 7, 'Хлеб пшеничный Домохозяйка', 2, 'Хлеб пшеничный нарезанный 420 г', '1675647557_hleb8.jpg', 'Хлеб к столу'),
(16, 1, 7, 'Хлеб Праздничный', 5, 'Пшеничный сладкий хлеб 1кг', '1675632845_hleb10.jpg', 'Вкусный хлеб для праздничного стола'),
(17, 1, 7, 'Хлеб ржаной Щедрый водар ', 2, 'Хлеб ржаной 1 кг', '1675633294_hleb11.jpg', 'Вкусный хлеб'),
(18, 2, 1, 'Молоко Минская марка', 2, 'Молоко 6%', '1675647502_Moloko.jpg', 'Вкусное отборное пастеризованое молоко'),
(19, 2, 1, 'Славянские традиции', 2, 'Молоко 2.5%', '1675640610_moloko1.jpg', 'Вкусное пастеризованное молоко'),
(20, 2, 2, 'Молоко Савушкин продукт', 3, 'Молоко 3.1%', '1675640649_moloko3.jpg', 'Вкусное пастеризованное молоко'),
(21, 2, 1, 'Кефир Славянские традиции', 2, 'Кефир 2.5%', '1675640854_kefir.jpg', 'Вкусный кефир'),
(22, 2, 1, 'Кефир депи', 1, 'Детский кефир Депи 3.2%', '1675641029_kefir2.jpg', 'кефир для малышей '),
(23, 2, 2, 'Кефир Савушкин продукт', 2, 'Кефир 2.5%', '1675641147_kefir4.jpg', 'Вкусный кефир '),
(24, 2, 1, 'Сметана Славянские традиции', 3, 'Сметана Славянские традиции 20%', '1675642001_smetana4.jpg', 'Вкусная сметана'),
(25, 2, 1, 'Йогурт Черничный', 2, 'Йогурт Черника', '1675644856_yogurt2.png', 'Йогурт без консевантов'),
(26, 2, 1, 'Йогурт Персиковый', 1, 'Йогурт персиковый', '1675645208_yogurt1.png', 'Вкусный йогурт'),
(27, 6, 3, 'Торт Столичный', 20, 'Сметанковый торт 2 кг', '1675813748_cake2.jpg', 'Вкусный торт'),
(28, 6, 3, 'Торт Услада', 22, 'Торт Услада 2кг', '1675815291_cake3.jpg', 'Вкусный торт'),
(29, 6, 3, 'Торт Праздничный', 34, 'Торт Праздничный 2 кг', '1675815099_cake4.jpg', 'Праздничный торт'),
(30, 6, 3, 'Торт Медовый спас', 21, 'Торт Медовый спас 2кг', '1675815222_cake5.jpg', 'Вкусный торт'),
(31, 6, 3, 'Торт Сказка', 11, 'Торт сказка 1 кг', '1675815479_cake6.jpg', 'Вкусный торт'),
(32, 7, 5, 'Напиток безалкогольный Березовик', 2, 'Напиток безалкогольный Березовик 1л', '1675817204_napitki1.png', 'Сладкий вкусный напиток'),
(33, 7, 5, 'Безалкогольный напиток Вейнянский родник', 2, 'Безалкогольный напиток Вейнянский родник 1.5л', '1675817261_napitki2.jpg', 'Экзотик'),
(34, 7, 5, 'Квас Аливарский', 2, 'Безалкогольный напиток Аливарский квас 1.5л', '1675817336_napitki4.jpg', 'Вкусный квас'),
(35, 7, 5, 'Квас Лидский', 2, 'Квас Лидский 1.5л', '1675817501_napitki.jpg', 'Вкусный хлебный квас'),
(36, 7, 5, 'Минеральная вода Дарида', 1, 'Минеральная вода Дарида 1.5л', '1675817565_napitki5.jpg', 'Полезная Минеральная вода'),
(37, 5, 4, 'Чипсы картофельные', 1, 'Чипсы картофельные разные вкусы на выбор', '1675817681_chipsi.jpg', 'Чипсы из натурального картофеля'),
(38, 5, 4, 'Чипсы картофельные Премьер', 2, 'Чипсы картофельные Премьер разные вкусы', '1675817884_chipsi2.jpg', 'Чипсы из нутрального картофеля'),
(39, 5, 4, 'Чипсы картофельные Бульба', 2, 'Чипсы картофельные Бульба разные вкусы', '1675817946_chipsi3.jpg', 'Чипсы из натурального картофеля'),
(40, 5, 4, 'Чипсы картофельные Бульба элитные', 2, 'Чипсы картофельные Бульба элитные', '1675818002_chipsi4.jpg', 'Чипсы из натурального картофеля'),
(41, 5, 4, 'Снеки луковые колечки Премьер ', 2, 'Чипсы Премьер Луковые колечки', '1675818070_chipsi5.jpg', 'Снеки из натурального картофеля'),
(42, 5, 4, 'Чипсы картофельные Мега', 2, 'Чипсы картофельные Мега', '1675818253_chipsi6.png', 'Чипсы из натурального картофеля'),
(43, 5, 4, 'Чипсы картофельные Онега', 2, 'Чипсы картофельные Онега', '1675818390_chipsi7.png', 'Чипсы из натурального картофеля'),
(44, 3, 7, 'Крупа гречневая', 1, 'Крупа гречневая 0.8кг', '1675818507_krupa3.jpg', 'Гречневая крупа первый сорт'),
(45, 3, 7, 'Горох шлифованный 1 кг', 2, 'Горох шлифованный 1 кг', '1675818564_krupa4.jpg', 'Горох первый сорт'),
(46, 3, 7, 'Крупа пшённая', 1, 'Крупа пшённая 0.8 кг', '1675818677_krupa5.jpg', 'Крупа пшённая первый сорт'),
(47, 3, 7, 'Крупа кукурузная', 1, 'Крупа кукурузная 0.7 кг', '1675818719_krupa7.jpg', 'Крупа кукурузная первый сорт'),
(48, 3, 7, 'Крупа овсяная', 1, 'Крупа овсяная 0.9 кг', '1675818771_krupa9.jpg', 'Крупа овсяная первый сорт'),
(49, 3, 7, 'Крупа киноа', 2, 'Крупа киноа 1кг', '1675818858_krupa11.jpg', 'Крупа киноа первый сорт'),
(50, 4, 6, 'Рыба Лосось 1 кг', 46, 'Свежая рыба лосось 1кг', '1675819646_riba2.jpeg', 'Только свежий лосось'),
(51, 4, 6, 'Рыба Форель 1кг', 40, 'Рыба Форель 1кг', '1675819724_riba3.jpg', 'Всегда свежая форель'),
(52, 4, 6, 'Рыба тунец 1 кг', 54, 'Свежий тунец 1 кг', '1675819405_riba4.jpg', 'Всегда свежий тунец'),
(53, 4, 6, 'Рыба скумбрия 1 кг', 10, 'Скумбрия свежая 1 кг', '1675819498_riba6.jpg', 'Всегда свежая скумбрия'),
(54, 4, 6, 'Рыба морской окунь ', 31, 'Свежий морской окунь 1 кг', '1675819581_riba7.jpg', 'Всегда свежий морской окунь'),
(55, 4, 6, 'Рыба сардина 1кг', 10, 'Свежая сардина 1кг', '1675820228_riba5.jpg', 'Всегда свежая Сардина'),
(56, 3, 7, 'Крупа пшеничная Столичная', 2, 'Крупа пшеничная Столичная 1кг', '1675995646_krupa6.jpg', 'Крупа пшеничная 1 сорт'),
(57, 7, 5, 'Вода артезианская негазированная', 1, 'Вода артезианская негазированная 1л.', '1675995785_napitki7.jpg', 'Вкусная вода');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `review` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `rating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `name`, `email`, `review`, `datetime`, `rating`) VALUES
(23, 1, 'name', 'name@produkti.by', 'Всегда вкусный хлеб у них', '2023-03-31 18:24:48', 5),
(24, 36, 'Любитель Воды', 'lovewater@produkti.by', 'Лучшая минеральная вода', '2023-03-31 23:38:08', 5),
(25, 37, 'surname', 'surname@produkti.by', 'Любимые чипсы', '2023-03-31 23:55:55', 5),
(29, 1, 'names', 'names@produkti.by', 'Да,полностью с вами согласен. Хлеб вкуснейший', '2023-04-02 05:22:46', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(29, 'name', 'surname', 'namesurname@produkti.by', '123456789', '1234567890', 'adres', 'minsk');

--
-- Triggers `user_info`
--
DELIMITER $$
CREATE TRIGGER `after_user_info_insert` AFTER INSERT ON `user_info` FOR EACH ROW BEGIN 
INSERT INTO user_info_backup VALUES(new.user_id,new.first_name,new.last_name,new.email,new.password,new.mobile,new.address1,new.address2);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_info_backup`
--

CREATE TABLE `user_info_backup` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info_backup`
--

INSERT INTO `user_info_backup` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(25, 'user', 'user', 'info@produkti.by', 'support', '123456789', 'Minsk', 'Belarus'),
(32, 'new', 'name', 'newname@produkti.by', '123456789', '2392393223', 'adres', 'minsk'),
(33, 'new', 'name', 'newnames@produkti.by', '123456789', '2392393223', 'adres', 'minsk'),
(34, 'names', 'surnames', 'names@produkti.by', '123456789', '1234567890', 'minsk', 'minsk'),
(35, 'Name', 'Surname', 'name@produkti.by', '123456789', '1234567890', 'Minsk', 'Minsk'),
(36, 'name', 'surnames', 'namesurnames@name.by', '123456789', '2233344224', 'minsk', 'minsk');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `email_info`
--
ALTER TABLE `email_info`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders_info`
--
ALTER TABLE `orders_info`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_pro_id`),
  ADD KEY `order_products` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_info_backup`
--
ALTER TABLE `user_info_backup`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=380;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `email_info`
--
ALTER TABLE `email_info`
  MODIFY `email_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_info`
--
ALTER TABLE `orders_info`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `order_pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_info_backup`
--
ALTER TABLE `user_info_backup`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_info`
--
ALTER TABLE `orders_info`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
