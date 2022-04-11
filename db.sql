SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `si2022_susi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `si2022_susi`;

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `lecturer` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `type` enum('Задължително избираем','Свободно избираем') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO `courses` (`id`, `name`, `lecturer`, `description`, `type`) VALUES
(1, 'Компютърна графика с WebGl', 'доц. П. Бойчев', 'Текст текст тест', 'Задължително избираем'),
(2, 'Програмиране на Go', 'доц. Непознатко', 'Текст текст тест', 'Задължително избираем'),
(3, 'Програмиране на Ruby', 'доц. П. Бойчев', 'Друг текст', 'Свободно избираем'),
(4, 'Agile', 'проф. Калинка Калоянова', 'Текст текст тест', 'Задължително избираем');
COMMIT;
