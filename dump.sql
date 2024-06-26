-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.3.0 - MySQL Community Server - GPL
-- Операционная система:         Linux
-- HeidiSQL Версия:              12.7.0.6850
-- --------------------------------------------------------

CREATE DATABASE test;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп данных таблицы test.employee: ~10 rows (приблизительно)
REPLACE INTO `employee` (`id`, `firstname`, `surname`, `lastname`, `birthday`, `gender`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Алексей', 'Иванович', 'Смирнов', '1985-06-15', 0, 1, 1, 1717910871, 1718342871),
	(2, 'Мария', 'Петровна', 'Васильева', '1990-08-20', 1, 1, 1, 1717824471, 1718083671),
	(3, 'Дмитрий', 'Александрович', 'Кузнецов', '1982-11-12', 0, 1, 1, 1717910871, 1717997271),
	(4, 'Екатерина', 'Михайловна', 'Соколов', '1995-04-05', 1, 1, 1, 1717738071, 1718342871),
	(5, 'Сергей', 'Викторович', 'Попов', '1978-02-28', 0, 1, 1, 1717651671, 1718083671),
	(6, 'Анна', 'Юрьевна', 'Лебедева', '1988-12-10', 1, 1, 1, 1717738071, 1718429271),
	(7, 'Николай', 'Сергеевич', 'Морозов', '1975-01-22', 0, 1, 1, 1717738071, 1717824471),
	(8, 'Ольга', 'Владимировна', 'Павлова', '1992-09-18', 1, 1, 1, 1718083671, 1718170071),
	(9, 'Андрей', 'Игоревич', 'Киселёв', '1983-03-30', 0, 1, 1, 1717824471, 1718256471),
	(10, 'Елена', 'Анатольевна', 'Зайцева', '1991-07-14', 1, 1, 1, 1717910871, 1718083671);

-- Дамп данных таблицы test.employee_jobs: ~27 rows (приблизительно)
REPLACE INTO `employee_jobs` (`id`, `employee_id`, `begin_at`, `end_at`, `company`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 1, '2022-01-01', '2022-06-30', 'ООО Рога и Копыта', 1, 1, 1654041600, 1655251200),
	(2, 2, '2021-11-01', '2022-03-31', 'ЗАО Синтез', 1, 1, 1646092800, 1652140800),
	(3, 3, '2022-02-15', NULL, 'ПАО Урал', 1, 1, 1651363200, 1655683200),
	(4, 4, '2021-09-01', '2022-01-31', 'АО Лукойл', 1, 1, 1648771200, 1653436800),
	(5, 5, '2021-12-01', NULL, 'ОАО Газпром', 1, 1, 1643673600, 1654387200),
	(6, 6, '2021-10-01', '2022-04-30', 'ПАО Сбербанк', 1, 1, 1647302400, 1656547200),
	(7, 7, '2022-03-01', NULL, 'ООО Яндекс', 1, 1, 1653004800, 1654819200),
	(8, 8, '2021-08-15', '2022-02-28', 'АО Роснефть', 1, 1, 1647734400, 1652572800),
	(9, 9, '2021-11-15', NULL, 'ПАО Газпромнефть', 1, 1, 1640995200, 1654041600),
	(10, 10, '2022-01-01', '2022-05-31', 'ОАО Татнефть', 1, 1, 1654041600, 1655683200),
	(12, 6, '2021-10-01', NULL, 'ЗАО "Беларусь"', 1, 1, 1717653540, 1718085540),
	(13, 5, '2020-12-01', '2021-06-30', 'ИП Иванов', 1, 1, 1717739940, 1717826340),
	(14, 5, '2022-02-01', NULL, 'ООО "Ромашка"', 1, 1, 1717567140, 1718085540),
	(15, 5, '2021-09-01', '2022-01-31', 'ИП Сидоров', 1, 1, 1717567140, 1717653540),
	(16, 4, '2020-11-01', '2022-05-31', 'АО "ТрансНефть"', 1, 1, 1717653540, 1717739940),
	(17, 7, '2021-07-01', NULL, 'ЗАО "МетроСтрой"', 1, 1, 1717739940, 1718085540),
	(18, 5, '2020-08-01', '2021-12-31', 'ООО "Алмаз"', 1, 1, 1717653540, 1717739940),
	(20, 8, '2024-06-05', NULL, 'Mail.ru Group', 1, 1, 1717826787, 1717653987),
	(29, 1, '2024-06-01', NULL, 'ООО Рога и Копыта', 1, 1, 1348695301, 681514568),
	(30, 7, '2023-09-15', '2024-05-31', 'АО Сибирская Нефть', 1, 1, 882655815, 1627494365),
	(31, 3, '2023-02-10', '2023-08-30', 'ЗАО Металлургический Комбинат', 1, 1, 29492261, 1434001735),
	(32, 2, '2022-12-05', '2023-01-20', 'ПАО Газпром', 1, 1, 824419335, 1585177272),
	(33, 3, '2023-04-20', NULL, 'ИП Иванов И.И.', 1, 1, 1037284225, 130164831),
	(34, 6, '2022-11-01', '2023-03-31', 'ОАО РЖД (Российские Железные Дороги)', 1, 1, 1579675451, 938868124),
	(35, 10, '2024-01-10', NULL, 'НПО Энергомаш', 1, 1, 794932186, 1066563527),
	(36, 7, '2023-07-15', '2024-02-28', 'ООО МегаФон', 1, 1, 62285323, 1492813150),
	(37, 3, '2022-10-05', '2022-12-25', 'ПАО Сбербанк', 1, 1, 69488674, 1286987417);

-- Дамп данных таблицы test.migration: ~6 rows (приблизительно)
REPLACE INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1718082497),
	('m240606_120401_init', 1718082500),
	('m240606_120406_create_employee_table', 1718082500),
	('m240606_144810_create_admin_user', 1718082501),
	('m240608_101417_create_employee_jobs_table', 1718082501),
	('m240610_120138_add_blame_columns_to_employee_jobs_table', 1718082501);

-- Дамп данных таблицы test.user: ~1 rows (приблизительно)
REPLACE INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'f7G3CrscnK87R71p9jFBhTL6Q5a6Ht_b', '$2y$13$5s6oSKAe2INJaLmmZqU8Ju1e49Bc3fIhTeZlSDZ3msxgLJpfGS3jy', NULL, 'admin@localhost', 10, 1718082501, 1718082501);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
