-- MySQL dump 10.13  Distrib 5.6.39, for FreeBSD11.1 (i386)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.6.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

INSERT INTO `statpage` (`name`, `sysname`, `url`, `locale`, `title`, `keywords`, `description`, `tpl`, `page_type`, `content`, `lastmod`, `seo_options`, `layout`) VALUES 
  ('USER_RESET_PASSWORD', 'RESET_PASSWORD', 'RESET_PASSWORD', 'ru_RU', '', '', '', '', 3, '<p>Это письмо на почту</p>\r\n\r\n<p>сервер - {SERVER}</p>\r\n\r\n<p>временный пароль - {PASSWORD}</p>\r\n', '2019-01-21 08:56:46', 'a:2:{s:6:\"robots\";s:0:\"\";s:9:\"canonical\";s:0:\"\";}', ''),
  ('USER_REGISTRATION', 'USER_REGISTRATION', 'USER_REGISTRATION', 'ru_RU', '', '', '', '', 3, '<p>Успешная регистрация</p>\r\n\r\n<p>для подтверждения перейдите по ссылке {CONFIRM}</p>\r\n', '2019-01-18 19:20:39', 'a:2:{s:6:\"robots\";s:0:\"\";s:9:\"canonical\";s:0:\"\";}', ''),
  ('USER_CONFIRMED', 'USER_CONFIRMED', 'USER_CONFIRMED', 'ru_RU', '', '', '', '', 3, '<p>Спасибо за регистрацию на нашем сайте</p>\r\n', '2019-01-21 09:37:55', 'a:2:{s:6:\"robots\";s:0:\"\";s:9:\"canonical\";s:0:\"\";}', '');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
