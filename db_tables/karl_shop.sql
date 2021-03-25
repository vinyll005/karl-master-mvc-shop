-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 25 2021 г., 15:58
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `karl_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `finalPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `description`, `color`, `size`, `price`, `discount`, `finalPrice`) VALUES
(5, 'testName2', 'woman', 'alalallblablalala', 'blue', 's', 65, 0, 65),
(6, 'testName', 'woman', 'alalallblablalala', 'blue', 'm', 59, 15, 50),
(7, 'Ivan', 'children', 'test', 'blue', 'xl', 59, 20, 47),
(8, 'Jumper in blue', 'man', 'ASOS DESIGN Van Gogh jacquard knit jumper in blue', 'blue', 'l', 79, 0, 79),
(9, 'Jumper in space', 'children', 'Knitted oversized jumper in space dye yarn', 'gray', 's', 35, 5, 33),
(10, 'Jumper', 'man', 'Knitted oversized floral jumper in grey', 'gray', 'm', 49, 0, 49),
(11, 'Jumper', 'man', 'Knitted oversized jumper with carrot design in peach', 'red', 'l', 59, 0, 59),
(12, 'Trainers', 'children', 'Adidas Originals ZX 8000 trainers in pink', 'red', 's', 74, 10, 66),
(13, 'Trainers', 'woman', 'Adidas Originals Rivalry Low trainers in off white', 'white', 'xs', 49, 0, 49),
(14, 'Jean', 'woman', 'High rise \'slouchy\' mom jean in mushroom with knee rips', 'white', 'm', 34, 0, 34),
(15, 'Jeans', 'woman', 'Topshop split hem jeans in washed black', 'Black', 'm', 55, 0, 55);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`) VALUES
(22, 'Kirill', 'levkirilll@yandex.ru', '$2y$10$tNDdTK23uvXSxAzFXqis5eBaQy6LT6ISVgO6u/r4vsf9yvsuWuRJe', 1),
(24, 'user23', 'levkkk@yandex.ru', '$2y$10$97xJB17R8B1XHKHhAg33L.XjifVhq7S9ImEaRqT6CfcTBqevBSZnC', NULL),
(25, 'user25', 'levkirilll111@yandex.ru', '$2y$10$AEpSVn229DT/OtjD99esOu99g/2LN15DxpwSu3JH.87XUILmJ2EGq', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
