-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2020 a las 19:12:38
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mitienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audits`
--

CREATE TABLE `audits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` int(10) UNSIGNED NOT NULL,
  `auditable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci,
  `new_values` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `audits`
--

INSERT INTO `audits` (`id`, `user_type`, `user_id`, `event`, `auditable_id`, `auditable_type`, `old_values`, `new_values`, `url`, `ip_address`, `user_agent`, `tags`, `created_at`, `updated_at`) VALUES
(1, 'App\\User', 1, 'created', 5, 'App\\PerfilUsuarioModel', '[]', '{\"nombre\":\"\",\"apellido\":\"\",\"telefono_1\":\"\",\"telefono_2\":\"\",\"direccion\":\"\",\"cedula\":\"\",\"municipios_id\":\"553\",\"entidad_municipal_id\":\"2\",\"foto\":\"\",\"users_id\":5}', 'http://localhost/ruta_girardot/public/login?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', NULL, '2019-01-24 02:20:48', '2019-01-24 02:20:48'),
(2, 'App\\User', 1, 'created', 6, 'App\\PerfilUsuarioModel', '[]', '{\"nombre\":\"\",\"apellido\":\"\",\"telefono_1\":\"\",\"telefono_2\":\"\",\"direccion\":\"\",\"cedula\":\"\",\"municipios_id\":\"553\",\"entidad_municipal_id\":\"2\",\"foto\":\"\",\"users_id\":6}', 'http://localhost/ruta_girardot/public/login?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', NULL, '2019-01-24 02:21:57', '2019-01-24 02:21:57'),
(3, 'App\\User', 1, 'created', 7, 'App\\PerfilUsuarioModel', '[]', '{\"nombre\":\"\",\"apellido\":\"\",\"telefono_1\":\"\",\"telefono_2\":\"\",\"direccion\":\"\",\"cedula\":\"\",\"municipios_id\":\"553\",\"entidad_municipal_id\":\"2\",\"foto\":\"\",\"users_id\":7}', 'http://localhost/ruta_girardot/public/login?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', NULL, '2019-01-24 02:45:22', '2019-01-24 02:45:22'),
(4, 'App\\User', 1, 'updated', 1, 'App\\ImageneModel', '{\"descripcion\":\"como esta\"}', '{\"descripcion\":\"como esta tu\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/1?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', NULL, '2019-01-29 03:39:11', '2019-01-29 03:39:11'),
(5, 'App\\User', 1, 'updated', 1, 'App\\Punto_ImagenesModel', '{\"tipo_archivo\":\"jpg\"}', '{\"tipo_archivo\":\"jpgs\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/1?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', NULL, '2019-01-29 03:59:31', '2019-01-29 03:59:31'),
(6, 'App\\User', 1, 'updated', 2, 'App\\Punto_ImagenesModel', '{\"icono_punto_id\":null}', '{\"icono_punto_id\":\"3\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/2?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', NULL, '2019-01-29 08:16:12', '2019-01-29 08:16:12'),
(7, 'App\\User', 1, 'updated', 5, 'App\\Punto_ImagenesModel', '{\"icono_punto_id\":null}', '{\"icono_punto_id\":\"1\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/5?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', NULL, '2019-01-29 08:18:00', '2019-01-29 08:18:00'),
(8, 'App\\User', 1, 'updated', 4, 'App\\Punto_ImagenesModel', '{\"icono_punto_id\":null}', '{\"icono_punto_id\":\"2\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/4?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', NULL, '2019-01-29 08:19:17', '2019-01-29 08:19:17'),
(9, 'App\\User', 1, 'updated', 3, 'App\\Punto_ImagenesModel', '{\"icono_punto_id\":null}', '{\"icono_punto_id\":\"1\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/3?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', NULL, '2019-01-29 08:20:00', '2019-01-29 08:20:00'),
(10, 'App\\User', 1, 'updated', 1, 'App\\Punto_ImagenesModel', '{\"icono_punto_id\":null}', '{\"icono_punto_id\":\"2\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/1?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', NULL, '2019-01-30 01:26:18', '2019-01-30 01:26:18'),
(11, 'App\\User', 1, 'updated', 6, 'App\\Punto_ImagenesModel', '{\"icono_punto_id\":null}', '{\"icono_punto_id\":\"2\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/6?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', NULL, '2019-01-30 01:26:32', '2019-01-30 01:26:32'),
(12, 'App\\User', 1, 'updated', 7, 'App\\Punto_ImagenesModel', '{\"icono_punto_id\":null}', '{\"icono_punto_id\":\"2\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/7?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', NULL, '2019-01-30 01:26:44', '2019-01-30 01:26:44'),
(13, 'App\\User', 1, 'updated', 4, 'App\\RecursoModel', '{\"descripcion\":\"ddd\"}', '{\"descripcion\":\"dddsss\"}', 'http://localhost/ruta_girardot/public/Recurso/editar/4?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-01-31 19:05:58', '2019-01-31 19:05:58'),
(14, 'App\\User', 1, 'updated', 2, 'App\\RecursoModel', '{\"descripcion\":\"ddd\"}', '{\"descripcion\":\"dddddss\"}', 'http://localhost/ruta_girardot/public/Recurso/editar/2?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-01-31 19:06:42', '2019-01-31 19:06:42'),
(15, 'App\\User', 1, 'updated', 6, 'App\\ImageneModel', '{\"archivo\":\"C:\\\\xampp\\\\tmp\\\\php6AC8.tmp\"}', '{\"archivo\":\"1548946860YKQJl.png\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/6?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-01-31 20:01:00', '2019-01-31 20:01:00'),
(16, 'App\\User', 1, 'updated', 7, 'App\\ImageneModel', '{\"archivo\":\"C:\\\\xampp\\\\tmp\\\\php47FC.tmp\"}', '{\"archivo\":\"1548946868DStD8.jpg\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/7?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-01-31 20:01:08', '2019-01-31 20:01:08'),
(17, 'App\\User', 1, 'updated', 8, 'App\\ImageneModel', '{\"archivo\":\"C:\\\\xampp\\\\tmp\\\\phpDB63.tmp\"}', '{\"archivo\":\"1548946876g04TV.png\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/8?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-01-31 20:01:16', '2019-01-31 20:01:16'),
(18, 'App\\User', 1, 'updated', 4, 'App\\ImageneModel', '{\"archivo\":\"1548641201js7kE.jpg\",\"orden\":45}', '{\"archivo\":\"1548946922gqh6J.png\",\"orden\":\"2\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/4?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-01-31 20:02:03', '2019-01-31 20:02:03'),
(19, 'App\\User', 1, 'updated', 7, 'App\\ImageneModel', '{\"archivo\":\"1548946868DStD8.jpg\",\"orden\":45}', '{\"archivo\":\"1548946929jeYwh.png\",\"orden\":\"32\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/7?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-01-31 20:02:09', '2019-01-31 20:02:09'),
(20, 'App\\User', 1, 'updated', 1, 'App\\Sitio_TuristicoModel', '{\"nombre\":\"comote\"}', '{\"nombre\":\"la locomotora\"}', 'http://localhost/ruta_girardot/public/Sitio_Turistico/editar/1?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 00:20:55', '2019-02-01 00:20:55'),
(21, 'App\\User', 1, 'updated', 2, 'App\\Sitio_TuristicoModel', '{\"nombre\":\"comote\"}', '{\"nombre\":\"puente ferreo\"}', 'http://localhost/ruta_girardot/public/Sitio_Turistico/editar/2?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 00:21:07', '2019-02-01 00:21:07'),
(22, 'App\\User', 1, 'created', 3, 'App\\Sitio_TuristicoModel', '[]', '{\"nombre\":\"puente ospina\",\"descripcion\":\"estado\",\"estado_id\":\"1\",\"users_id\":1,\"id\":3}', 'http://localhost/ruta_girardot/public/Sitio_Turistico?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 00:21:28', '2019-02-01 00:21:28'),
(23, 'App\\User', 1, 'updated', 3, 'App\\Sitio_TuristicoModel', '{\"imagen\":\"\"}', '{\"imagen\":\"1548962548L972u.jpg\"}', 'http://localhost/ruta_girardot/public/Sitio_Turistico/editar/3?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 00:22:28', '2019-02-01 00:22:28'),
(24, 'App\\User', 1, 'updated', 2, 'App\\Sitio_TuristicoModel', '{\"imagen\":\"15486441078R0I2.jpg\"}', '{\"imagen\":\"15489625872YsFc.jpg\"}', 'http://localhost/ruta_girardot/public/Sitio_Turistico/editar/2?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 00:23:08', '2019-02-01 00:23:08'),
(25, 'App\\User', 1, 'updated', 4, 'App\\ImageneModel', '{\"archivo\":\"1548946922gqh6J.png\"}', '{\"archivo\":\"15489677089r4VA.png\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/4?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 01:48:28', '2019-02-01 01:48:28'),
(26, 'App\\User', 1, 'updated', 6, 'App\\ImageneModel', '{\"archivo\":\"1548946860YKQJl.png\"}', '{\"archivo\":\"1548967734IHblF.png\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/6?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 01:48:54', '2019-02-01 01:48:54'),
(27, 'App\\User', 1, 'updated', 7, 'App\\ImageneModel', '{\"archivo\":\"1548946929jeYwh.png\"}', '{\"archivo\":\"1548967760mipZ3.png\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/7?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 01:49:20', '2019-02-01 01:49:20'),
(28, 'App\\User', 1, 'updated', 8, 'App\\ImageneModel', '{\"archivo\":\"1548946876g04TV.png\"}', '{\"archivo\":\"1548967813wnKfh.jpg\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/8?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 01:50:13', '2019-02-01 01:50:13'),
(29, 'App\\User', 1, 'updated', 1, 'App\\ImageneModel', '{\"archivo\":\"1548539414iqtsb.jpg\"}', '{\"archivo\":\"1548971071AMXwe.jpg\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/1?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 02:44:31', '2019-02-01 02:44:31'),
(30, 'App\\User', 1, 'updated', 2, 'App\\ImageneModel', '{\"archivo\":\"1548539634bmLZ8.jpg\"}', '{\"archivo\":\"1548971077lPbGz.jpg\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/2?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 02:44:37', '2019-02-01 02:44:37'),
(31, 'App\\User', 1, 'updated', 3, 'App\\ImageneModel', '{\"archivo\":\"1548539724qUbdB.jpg\"}', '{\"archivo\":\"1548971088e1DPC.jpg\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/3?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 02:44:48', '2019-02-01 02:44:48'),
(32, 'App\\User', 1, 'updated', 5, 'App\\ImageneModel', '{\"archivo\":\"1548456080dtqeD.jpg\"}', '{\"archivo\":\"1548971097dtGSE.jpg\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/5?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 02:44:57', '2019-02-01 02:44:57'),
(33, 'App\\User', 1, 'updated', 9, 'App\\ImageneModel', '{\"archivo\":\"15484566500ML2E.png\"}', '{\"archivo\":\"1548971107UofYY.jpg\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/9?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 02:45:07', '2019-02-01 02:45:07'),
(34, 'App\\User', 1, 'updated', 3, 'App\\ImageneModel', '{\"archivo\":\"1548971088e1DPC.jpg\"}', '{\"archivo\":\"1548971293int9W.jpg\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/3?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36', NULL, '2019-02-01 02:48:13', '2019-02-01 02:48:13'),
(35, 'App\\User', 1, 'deleted', 4, 'App\\ImageneModel', '{\"id\":4,\"descripcion\":\"como\",\"archivo\":\"15489677089r4VA.png\",\"orden\":2,\"titulo\":\"como\",\"users_id\":1}', '[]', 'http://localhost/ruta_girardot/public/Imagene/4?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 06:46:14', '2019-03-06 06:46:14'),
(36, 'App\\User', 1, 'deleted', 10, 'App\\ImageneModel', '{\"id\":10,\"descripcion\":\"como esta\",\"archivo\":\"1548456658TJ01v.png\",\"orden\":45,\"titulo\":\"como\",\"users_id\":1}', '[]', 'http://localhost/ruta_girardot/public/Imagene/10?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 06:46:19', '2019-03-06 06:46:19'),
(37, 'App\\User', 1, 'deleted', 8, 'App\\ImageneModel', '{\"id\":8,\"descripcion\":\"como esta\",\"archivo\":\"1548967813wnKfh.jpg\",\"orden\":45,\"titulo\":\"como\",\"users_id\":1}', '[]', 'http://localhost/ruta_girardot/public/Imagene/8?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 06:46:24', '2019-03-06 06:46:24'),
(38, 'App\\User', 1, 'deleted', 3, 'App\\ImageneModel', '{\"id\":3,\"descripcion\":\"como\",\"archivo\":\"1548971293int9W.jpg\",\"orden\":45,\"titulo\":\"como esta\",\"users_id\":1}', '[]', 'http://localhost/ruta_girardot/public/Imagene/3?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 06:46:31', '2019-03-06 06:46:31'),
(39, 'App\\User', 1, 'updated', 1, 'App\\ImageneModel', '{\"descripcion\":\"como esta tu\",\"archivo\":\"1548971071AMXwe.jpg\",\"orden\":34,\"titulo\":\"ti\"}', '{\"descripcion\":\"Parque de la locomotora\",\"archivo\":\"1551837282B6rzY.jpg\",\"orden\":\"1\",\"titulo\":\"Parque de la locomotora\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/1?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 06:54:43', '2019-03-06 06:54:43'),
(40, 'App\\User', 1, 'updated', 2, 'App\\ImageneModel', '{\"descripcion\":\"como\",\"archivo\":\"1548971077lPbGz.jpg\",\"titulo\":\"como\"}', '{\"descripcion\":\"Vista de la plaza de Mercado\",\"archivo\":\"1551837344N5qZI.png\",\"titulo\":\"Plaza de mercado\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/2?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 06:55:44', '2019-03-06 06:55:44'),
(41, 'App\\User', 1, 'updated', 5, 'App\\ImageneModel', '{\"descripcion\":\"como\",\"archivo\":\"1548971097dtGSE.jpg\",\"titulo\":\"como\"}', '{\"descripcion\":\"Conozca la historia de los ferrocarriles\",\"archivo\":\"1551837389VyesJ.png\",\"titulo\":\"Historia de los ferrocarriles\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/5?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 06:56:29', '2019-03-06 06:56:29'),
(42, 'App\\User', 1, 'updated', 5, 'App\\ImageneModel', '{\"archivo\":\"1551837389VyesJ.png\"}', '{\"archivo\":\"15518374291X5tF.jpg\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/5?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 06:57:10', '2019-03-06 06:57:10'),
(43, 'App\\User', 1, 'updated', 6, 'App\\ImageneModel', '{\"descripcion\":\"como\",\"archivo\":\"1548967734IHblF.png\",\"titulo\":\"como\"}', '{\"descripcion\":\"Embarcadero\",\"archivo\":\"1551837560RGrtb.jpg\",\"titulo\":\"Embarcadero\"}', 'http://localhost/ruta_girardot/public/Imagene/editar/6?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 06:59:20', '2019-03-06 06:59:20'),
(44, 'App\\User', 1, 'deleted', 7, 'App\\ImageneModel', '{\"id\":7,\"descripcion\":\"como\",\"archivo\":\"1548967760mipZ3.png\",\"orden\":32,\"titulo\":\"como\",\"users_id\":1}', '[]', 'http://localhost/ruta_girardot/public/Imagene/7?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 06:59:24', '2019-03-06 06:59:24'),
(45, 'App\\User', 1, 'deleted', 9, 'App\\ImageneModel', '{\"id\":9,\"descripcion\":\"como esta\",\"archivo\":\"1548971107UofYY.jpg\",\"orden\":45,\"titulo\":\"como\",\"users_id\":1}', '[]', 'http://localhost/ruta_girardot/public/Imagene/9?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 06:59:27', '2019-03-06 06:59:27'),
(46, 'App\\User', 1, 'updated', 7, 'App\\Punto_ImagenesModel', '{\"descripcion\":\"como\"}', '{\"descripcion\":\"puente ferreo\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/7?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 07:39:27', '2019-03-06 07:39:27'),
(47, 'App\\User', 1, 'updated', 6, 'App\\Punto_ImagenesModel', '{\"descripcion\":\"como\"}', '{\"descripcion\":\"puente ospina\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/6?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 07:39:43', '2019-03-06 07:39:43'),
(48, 'App\\User', 1, 'updated', 5, 'App\\Punto_ImagenesModel', '{\"descripcion\":\"como\"}', '{\"descripcion\":\"inglesa san migue\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/5?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 07:40:07', '2019-03-06 07:40:07'),
(49, 'App\\User', 1, 'updated', 4, 'App\\Punto_ImagenesModel', '{\"descripcion\":\"como\"}', '{\"descripcion\":\"parque sucre\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/4?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 07:40:23', '2019-03-06 07:40:23'),
(50, 'App\\User', 1, 'updated', 3, 'App\\Punto_ImagenesModel', '{\"descripcion\":\"como\"}', '{\"descripcion\":\"locomotora\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/3?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 07:40:32', '2019-03-06 07:40:32'),
(51, 'App\\User', 1, 'updated', 2, 'App\\Punto_ImagenesModel', '{\"descripcion\":\"como\"}', '{\"descripcion\":\"v\\u00edas f\\u00e9rreas\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/2?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-06 07:40:48', '2019-03-06 07:40:48'),
(52, 'App\\User', 1, 'updated', 7, 'App\\PerfilUsuarioModel', '{\"nombre\":\"dd\"}', '{\"nombre\":\"jimmy alexander\"}', 'http://localhost/ruta_girardot/public/Perfil/Usuario_perfil/Edit/7?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-12 07:08:39', '2019-03-12 07:08:39'),
(53, 'App\\User', 1, 'updated', 7, 'App\\PerfilUsuarioModel', '{\"foto\":\"\"}', '{\"foto\":\"1552356639LB3lv.png\"}', 'http://localhost/ruta_girardot/public/Perfil/Usuario_perfil/Edit/7?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-12 07:10:39', '2019-03-12 07:10:39'),
(54, 'App\\User', 1, 'updated', 7, 'App\\PerfilUsuarioModel', '{\"foto\":\"1552356639LB3lv.png\"}', '{\"foto\":\"1552359159CfDfk.png\"}', 'http://localhost/ruta_girardot/public/Perfil/Usuario_perfil/Edit/7?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-12 07:52:39', '2019-03-12 07:52:39'),
(55, 'App\\User', 1, 'updated', 3, 'App\\Punto_ImagenesModel', '{\"imagen\":\"1548539724qUbdB.jpg\"}', '{\"imagen\":\"1552402353QwelL.png\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/3?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-12 19:52:33', '2019-03-12 19:52:33'),
(56, 'App\\User', 1, 'deleted', 2, 'App\\Punto_ImagenesModel', '{\"id\":2,\"descripcion\":\"v\\u00edas f\\u00e9rreas\",\"latitud\":\"4.30028216132194\",\"longitud\":\"-74.81022135761418\",\"imagen\":\"1548539724qUbdB.jpg\",\"tipo_archivo\":\"jpg\",\"estado_id\":1,\"users_id\":1,\"sitio_turistico_id\":0,\"icono_punto_id\":3}', '[]', 'http://localhost/ruta_girardot/public/Punto_Imagenes/2?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-12 20:42:29', '2019-03-12 20:42:29'),
(57, 'App\\User', 1, 'deleted', 1, 'App\\Punto_ImagenesModel', '{\"id\":1,\"descripcion\":\"como\",\"latitud\":\"4.3019083516286525\",\"longitud\":\"-74.81052176502385\",\"imagen\":\"1548539724qUbdB.jpg\",\"tipo_archivo\":\"jpgs\",\"estado_id\":1,\"users_id\":1,\"sitio_turistico_id\":0,\"icono_punto_id\":2}', '[]', 'http://localhost/ruta_girardot/public/Punto_Imagenes/1?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-12 20:42:45', '2019-03-12 20:42:45'),
(58, 'App\\User', 1, 'updated', 4, 'App\\Punto_ImagenesModel', '{\"sitio_turistico_id\":0}', '{\"sitio_turistico_id\":\"4\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/4?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-12 20:43:23', '2019-03-12 20:43:23'),
(59, 'App\\User', 1, 'updated', 3, 'App\\Punto_ImagenesModel', '{\"sitio_turistico_id\":0}', '{\"sitio_turistico_id\":\"2\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/3?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-12 21:39:08', '2019-03-12 21:39:08'),
(60, 'App\\User', 1, 'updated', 5, 'App\\Punto_ImagenesModel', '{\"sitio_turistico_id\":0}', '{\"sitio_turistico_id\":\"4\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/5?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-12 21:39:16', '2019-03-12 21:39:16'),
(61, 'App\\User', 1, 'updated', 6, 'App\\Punto_ImagenesModel', '{\"sitio_turistico_id\":0}', '{\"sitio_turistico_id\":\"3\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/6?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-12 21:39:24', '2019-03-12 21:39:24'),
(62, 'App\\User', 1, 'updated', 7, 'App\\Punto_ImagenesModel', '{\"sitio_turistico_id\":0}', '{\"sitio_turistico_id\":\"2\"}', 'http://localhost/ruta_girardot/public/Punto_Imagenes/editar/7?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', NULL, '2019-03-12 21:39:32', '2019-03-12 21:39:32'),
(63, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-02 19:09:39\",\"valor_pagado\":\"0\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:15:00.623734\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":90500}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:15:01', '2019-04-03 15:15:01'),
(64, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:18:06', '2019-04-03 15:18:06'),
(65, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:15:00\",\"valor_pagado\":\"90500\",\"estado_vehiculo\":2}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:18:06.795148\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":90800,\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:18:06', '2019-04-03 15:18:06'),
(66, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:18:06\",\"valor_pagado\":\"90800\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:20:42.912524\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":91100}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:20:42', '2019-04-03 15:20:42'),
(67, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:20:42\",\"valor_pagado\":\"91100\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:21:46.635227\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":91200}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:21:46', '2019-04-03 15:21:46'),
(68, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:21:46\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:22:11.400349\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"}}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:22:11', '2019-04-03 15:22:11'),
(69, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:22:11\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:22:14.907945\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"}}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:22:14', '2019-04-03 15:22:14'),
(70, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:22:14\",\"valor_pagado\":\"91200\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:22:48.673166\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":91300}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:22:48', '2019-04-03 15:22:48'),
(71, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:22:48\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:23:10.038532\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"}}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:23:10', '2019-04-03 15:23:10'),
(72, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:23:10\",\"valor_pagado\":\"91300\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:23:27.381010\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":91400}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:23:27', '2019-04-03 15:23:27'),
(73, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:23:27\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:23:39.205292\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"}}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:23:39', '2019-04-03 15:23:39'),
(74, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:23:39\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:23:48.824862\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"}}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:23:48', '2019-04-03 15:23:48'),
(75, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:23:48\",\"valor_pagado\":\"91400\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:25:15.946988\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":91500}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:25:16', '2019-04-03 15:25:16'),
(76, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:31:27', '2019-04-03 15:31:27'),
(77, 'App\\User', 1, 'created', 34, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 10:31:27.992474\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":9,\"id\":34}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:31:28', '2019-04-03 15:31:28'),
(78, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:41:49', '2019-04-03 15:41:49'),
(79, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:25:15\",\"valor_pagado\":\"91500\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:41:49.490108\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":93200}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:41:49', '2019-04-03 15:41:49'),
(80, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:41:49\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:42:00.442861\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"}}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:42:00', '2019-04-03 15:42:00'),
(81, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:42:00\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:42:17.284958\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"}}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:42:17', '2019-04-03 15:42:17'),
(82, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:42:17\",\"valor_pagado\":\"93200\",\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 10:43:38.111137\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":93400,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 15:43:38', '2019-04-03 15:43:38'),
(83, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:01:41', '2019-04-03 16:01:41'),
(84, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 10:43:38\",\"valor_pagado\":\"93400\",\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 11:01:41.134891\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":95200,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:01:41', '2019-04-03 16:01:41'),
(85, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:02:29', '2019-04-03 16:02:29'),
(86, 'App\\User', 1, 'updated', 11, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:05:53', '2019-04-03 16:05:53'),
(87, 'App\\User', 1, 'updated', 11, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:08:19', '2019-04-03 16:08:19'),
(88, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:08:44', '2019-04-03 16:08:44'),
(89, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:09:56', '2019-04-03 16:09:56'),
(90, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:10:23', '2019-04-03 16:10:23'),
(91, 'App\\User', 1, 'created', 35, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 11:10:23.345204\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":9,\"id\":35}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:10:23', '2019-04-03 16:10:23'),
(92, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:10:33', '2019-04-03 16:10:33'),
(93, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:13:12', '2019-04-03 16:13:12'),
(94, 'App\\User', 1, 'created', 36, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 11:13:12.151374\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":10,\"id\":36}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:13:12', '2019-04-03 16:13:12'),
(95, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:13:40', '2019-04-03 16:13:40'),
(96, 'App\\User', 1, 'created', 37, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 11:13:41.027761\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":9,\"id\":37}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:13:41', '2019-04-03 16:13:41'),
(97, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:35:41', '2019-04-03 16:35:41'),
(98, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:35:54', '2019-04-03 16:35:54'),
(99, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:36:06', '2019-04-03 16:36:06'),
(100, 'App\\User', 1, 'created', 38, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 11:36:06.845777\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":10,\"id\":38}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:36:06', '2019-04-03 16:36:06'),
(101, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:36:13', '2019-04-03 16:36:13'),
(102, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:37:02', '2019-04-03 16:37:02'),
(103, 'App\\User', 1, 'created', 39, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 11:37:02.091746\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":10,\"id\":39}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:37:02', '2019-04-03 16:37:02'),
(104, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:40:23', '2019-04-03 16:40:23'),
(105, 'App\\User', 1, 'created', 40, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 11:40:23.825752\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":9,\"id\":40}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:40:23', '2019-04-03 16:40:23'),
(106, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:40:30', '2019-04-03 16:40:30'),
(107, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 11:01:41\",\"valor_pagado\":\"95200\"}', '{\"fecha_salida\":{\"date\":\"2019-04-03 11:40:30.877457\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":99100}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:40:30', '2019-04-03 16:40:30'),
(108, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:41:00', '2019-04-03 16:41:00'),
(109, 'App\\User', 1, 'updated', 36, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null}', '{\"fecha_salida\":{\"date\":\"2019-04-03 11:41:00.359766\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":2700,\"precio_estacionamiento\":100,\"user_id\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:41:00', '2019-04-03 16:41:00'),
(110, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:42:27', '2019-04-03 16:42:27'),
(111, 'App\\User', 1, 'created', 41, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 11:42:27.869120\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":9,\"id\":41}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:42:27', '2019-04-03 16:42:27'),
(112, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:43:09', '2019-04-03 16:43:09'),
(113, 'App\\User', 1, 'updated', 33, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 11:40:30\",\"valor_pagado\":\"99100\",\"estado_vehiculo\":2}', '{\"fecha_salida\":{\"date\":\"2019-04-03 11:43:09.461292\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":99300,\"estado_vehiculo\":3}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:43:09', '2019-04-03 16:43:09'),
(114, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:47:26', '2019-04-03 16:47:26'),
(115, 'App\\User', 1, 'created', 42, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 11:47:26.128915\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":9,\"id\":42}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:47:26', '2019-04-03 16:47:26'),
(116, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:47:34', '2019-04-03 16:47:34'),
(117, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:51:01', '2019-04-03 16:51:01');
INSERT INTO `audits` (`id`, `user_type`, `user_id`, `event`, `auditable_id`, `auditable_type`, `old_values`, `new_values`, `url`, `ip_address`, `user_agent`, `tags`, `created_at`, `updated_at`) VALUES
(118, 'App\\User', 1, 'created', 43, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 11:51:01.791969\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":10,\"id\":43}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:51:01', '2019-04-03 16:51:01'),
(119, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:51:09', '2019-04-03 16:51:09'),
(120, 'App\\User', 1, 'created', 44, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 11:51:09.955209\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":9,\"id\":44}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-03 16:51:10', '2019-04-03 16:51:10'),
(121, 'App\\User', 1, 'updated', 32, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-02 18:05:19\",\"valor_pagado\":\"8300\",\"user_id\":null,\"estado_vehiculo\":2}', '{\"fecha_salida\":{\"date\":\"2019-04-03 20:42:41.751459\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":168000,\"user_id\":1,\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 01:42:41', '2019-04-04 01:42:41'),
(122, 'App\\User', 1, 'updated', 11, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 01:45:10', '2019-04-04 01:45:10'),
(123, 'App\\User', 1, 'created', 45, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 20:45:10.261262\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":11,\"id\":45}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 01:45:10', '2019-04-04 01:45:10'),
(124, 'App\\User', 1, 'updated', 32, 'App\\RegistroModel', '{\"fecha_salida\":\"2019-04-03 20:42:41\",\"valor_pagado\":\"168000\",\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 20:54:32.005289\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":169200,\"estado_vehiculo\":3}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 01:54:32', '2019-04-04 01:54:32'),
(125, 'App\\User', 1, 'updated', 45, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 21:04:25.914158\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":1900,\"precio_estacionamiento\":100,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:04:25', '2019-04-04 02:04:25'),
(126, 'App\\User', 1, 'updated', 42, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 21:09:40.069910\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":56200,\"precio_estacionamiento\":100,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:09:40', '2019-04-04 02:09:40'),
(127, 'App\\User', 1, 'updated', 41, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 21:09:58.807080\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":56700,\"precio_estacionamiento\":100,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:09:58', '2019-04-04 02:09:58'),
(128, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:10:08', '2019-04-04 02:10:08'),
(129, 'App\\User', 1, 'updated', 38, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 21:10:09.036614\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":86100,\"precio_estacionamiento\":150,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:10:09', '2019-04-04 02:10:09'),
(130, 'App\\User', 1, 'updated', 39, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 21:10:11.952070\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":85950,\"precio_estacionamiento\":150,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:10:12', '2019-04-04 02:10:12'),
(131, 'App\\User', 1, 'updated', 40, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 21:10:14.381788\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":56900,\"precio_estacionamiento\":100,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:10:14', '2019-04-04 02:10:14'),
(132, 'App\\User', 1, 'updated', 43, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 21:10:16.246719\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":83850,\"precio_estacionamiento\":150,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:10:16', '2019-04-04 02:10:16'),
(133, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:11:32', '2019-04-04 02:11:32'),
(134, 'App\\User', 1, 'created', 46, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 21:11:32.190184\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":9,\"estado_vehiculo\":1,\"id\":46}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:11:32', '2019-04-04 02:11:32'),
(135, 'App\\User', 1, 'updated', 9, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:11:40', '2019-04-04 02:11:40'),
(136, 'App\\User', 1, 'updated', 46, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 21:11:40.437892\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":0,\"precio_estacionamiento\":100,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:11:40', '2019-04-04 02:11:40'),
(137, 'App\\User', 1, 'updated', 11, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:11:55', '2019-04-04 02:11:55'),
(138, 'App\\User', 1, 'created', 47, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 21:11:55.623460\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":11,\"estado_vehiculo\":1,\"id\":47}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:11:55', '2019-04-04 02:11:55'),
(139, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:12:00', '2019-04-04 02:12:00'),
(140, 'App\\User', 1, 'created', 48, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 21:12:00.999577\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":10,\"estado_vehiculo\":1,\"id\":48}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:12:01', '2019-04-04 02:12:01'),
(141, 'App\\User', 1, 'updated', 11, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:12:18', '2019-04-04 02:12:18'),
(142, 'App\\User', 1, 'updated', 47, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 21:12:19.014976\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":0,\"precio_estacionamiento\":100,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:12:19', '2019-04-04 02:12:19'),
(143, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:14:09', '2019-04-04 02:14:09'),
(144, 'App\\User', 1, 'updated', 48, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 21:14:09.563645\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":300,\"precio_estacionamiento\":150,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:14:09', '2019-04-04 02:14:09'),
(145, 'App\\User', 1, 'created', 12, 'App\\ParqueaderoVehiculoModel', '[]', '{\"codigo\":\"P1-GA-4 \",\"numero\":\"4\",\"categoria_parqueadero_id\":\"5\",\"tipo_vehiculo_id\":\"4\",\"estado_id\":\"1\",\"id\":12}', 'http://localhost/parqueadero_marcos_alberto/public/ParqueaderoVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:20:31', '2019-04-04 02:20:31'),
(146, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:21:12', '2019-04-04 02:21:12'),
(147, 'App\\User', 1, 'created', 49, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-03 21:21:12.536016\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":10,\"estado_vehiculo\":1,\"id\":49}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:21:12', '2019-04-04 02:21:12'),
(148, 'App\\User', 1, 'created', 3, 'App\\SitiosParqueaderoModel', '[]', '{\"nombre\":\"centro mercurio\",\"direccion\":\"autopista sur\",\"id\":3}', 'http://localhost/parqueadero_marcos_alberto/public/SitiosParqueadero?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:33:18', '2019-04-04 02:33:18'),
(149, 'App\\User', 1, 'created', 3, 'App\\ZonaParqueaderoModel', '[]', '{\"nombre\":\"subteraneo\",\"sitios_parqueadero_id\":\"2\",\"estado_id\":\"1\",\"id\":3}', 'http://localhost/parqueadero_marcos_alberto/public/ZonaParqueadero?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:35:03', '2019-04-04 02:35:03'),
(150, 'App\\User', 1, 'created', 4, 'App\\NivelesModel', '[]', '{\"nombre\":\"SU1\",\"codigo\":\"SU1\",\"zona_parqueadero_id\":\"3\",\"estado_id\":\"1\",\"id\":4}', 'http://localhost/parqueadero_marcos_alberto/public/Niveles?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:45:15', '2019-04-04 02:45:15'),
(151, 'App\\User', 1, 'updated', 4, 'App\\NivelesModel', '{\"nombre\":\"SU1\"}', '{\"nombre\":\"SU1-\"}', 'http://localhost/parqueadero_marcos_alberto/public/Niveles/4?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:45:53', '2019-04-04 02:45:53'),
(152, 'App\\User', 1, 'updated', 4, 'App\\NivelesModel', '{\"nombre\":\"SU1-\"}', '{\"nombre\":\"SU1\"}', 'http://localhost/parqueadero_marcos_alberto/public/Niveles/4?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 02:46:00', '2019-04-04 02:46:00'),
(153, 'App\\User', 1, 'created', 6, 'App\\CategoriaParqueaderoModel', '[]', '{\"letra\":\"S\",\"zona_parqueadero_id\":\"3\",\"niveles_id\":\"4\",\"estado_id\":\"1\",\"zona_parqueadero_sitios_parqueadero_id\":2,\"id\":6}', 'http://localhost/parqueadero_marcos_alberto/public/CategoriaParqueadero?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 03:05:08', '2019-04-04 03:05:08'),
(154, 'App\\User', 1, 'created', 7, 'App\\CategoriaParqueaderoModel', '[]', '{\"letra\":\"SS\",\"zona_parqueadero_id\":\"3\",\"niveles_id\":\"4\",\"estado_id\":\"1\",\"zona_parqueadero_sitios_parqueadero_id\":2,\"id\":7}', 'http://localhost/parqueadero_marcos_alberto/public/CategoriaParqueadero?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 03:05:37', '2019-04-04 03:05:37'),
(155, 'App\\User', 1, 'updated', 6, 'App\\CategoriaParqueaderoModel', '{\"letra\":\"S\"}', '{\"letra\":\"SB\"}', 'http://localhost/parqueadero_marcos_alberto/public/CategoriaParqueadero/6?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 03:09:31', '2019-04-04 03:09:31'),
(156, 'App\\User', 1, 'updated', 7, 'App\\CategoriaParqueaderoModel', '{\"letra\":\"SS\"}', '{\"letra\":\"SC\"}', 'http://localhost/parqueadero_marcos_alberto/public/CategoriaParqueadero/7?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 03:09:39', '2019-04-04 03:09:39'),
(157, 'App\\User', 1, 'created', 13, 'App\\ParqueaderoVehiculoModel', '[]', '{\"codigo\":\"SU1-SB-1 \",\"numero\":\"1\",\"categoria_parqueadero_id\":\"6\",\"tipo_vehiculo_id\":\"3\",\"estado_id\":\"1\",\"id\":13}', 'http://localhost/parqueadero_marcos_alberto/public/ParqueaderoVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 03:10:27', '2019-04-04 03:10:27'),
(158, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 03:12:25', '2019-04-04 03:12:25'),
(159, 'App\\User', 1, 'updated', 49, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-03 22:12:25.067508\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":7650,\"precio_estacionamiento\":150,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 03:12:25', '2019-04-04 03:12:25'),
(160, 'App\\User', 1, 'updated', 11, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 12:15:06', '2019-04-04 12:15:06'),
(161, 'App\\User', 1, 'created', 50, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-04 07:15:06.593664\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":11,\"estado_vehiculo\":1,\"id\":50}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 12:15:06', '2019-04-04 12:15:06'),
(162, 'App\\User', 1, 'updated', 6, 'App\\CategoriaParqueaderoModel', '{\"letra\":\"SB\",\"zona_parqueadero_id\":3,\"niveles_id\":4}', '{\"letra\":\"GA\",\"zona_parqueadero_id\":\"2\",\"niveles_id\":\"3\"}', 'http://localhost/parqueadero_marcos_alberto/public/CategoriaParqueadero/6?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 12:22:09', '2019-04-04 12:22:09'),
(163, 'App\\User', 1, 'updated', 7, 'App\\CategoriaParqueaderoModel', '{\"letra\":\"SC\"}', '{\"letra\":\"SA\"}', 'http://localhost/parqueadero_marcos_alberto/public/CategoriaParqueadero/7?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 12:22:34', '2019-04-04 12:22:34'),
(164, 'App\\User', 1, 'created', 4, 'App\\SitiosParqueaderoModel', '[]', '{\"nombre\":\"centro\",\"direccion\":\"centro de conversiones\",\"id\":4}', 'http://localhost/parqueadero_marcos_alberto/public/SitiosParqueadero?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 12:28:42', '2019-04-04 12:28:42'),
(165, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 12:35:21', '2019-04-04 12:35:21'),
(166, 'App\\User', 1, 'created', 51, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-04 07:35:21.743221\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":10,\"estado_vehiculo\":1,\"id\":51}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 12:35:21', '2019-04-04 12:35:21'),
(167, 'App\\User', 3, 'updated', 11, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 12:43:07', '2019-04-04 12:43:07'),
(168, 'App\\User', 3, 'updated', 50, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-04 07:43:07.774365\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":2800,\"precio_estacionamiento\":100,\"user_id\":3,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 12:43:07', '2019-04-04 12:43:07'),
(169, 'App\\User', 1, 'updated', 11, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 13:13:10', '2019-04-04 13:13:10'),
(170, 'App\\User', 1, 'created', 52, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-04 08:13:10.244323\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":11,\"estado_vehiculo\":1,\"id\":52}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 13:13:10', '2019-04-04 13:13:10'),
(171, 'App\\User', 1, 'updated', 11, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 13:16:40', '2019-04-04 13:16:40'),
(172, 'App\\User', 1, 'updated', 52, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-04 08:16:40.249156\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":300,\"precio_estacionamiento\":100,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 13:16:40', '2019-04-04 13:16:40'),
(173, 'App\\User', 1, 'updated', 11, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 13:20:27', '2019-04-04 13:20:27'),
(174, 'App\\User', 1, 'created', 53, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-04 08:20:27.308331\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":11,\"estado_vehiculo\":1,\"id\":53}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 13:20:27', '2019-04-04 13:20:27'),
(175, 'App\\User', 1, 'updated', 10, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 13:47:49', '2019-04-04 13:47:49'),
(176, 'App\\User', 1, 'updated', 51, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-04 08:47:49.496919\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":10800,\"precio_estacionamiento\":150,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 13:47:49', '2019-04-04 13:47:49'),
(177, 'App\\User', 1, 'updated', 11, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":2}', '{\"estado_vehiculo\":1}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 13:48:15', '2019-04-04 13:48:15'),
(178, 'App\\User', 1, 'updated', 53, 'App\\RegistroModel', '{\"fecha_salida\":null,\"valor_pagado\":\"\",\"precio_estacionamiento\":\"\",\"user_id\":null,\"estado_vehiculo\":1}', '{\"fecha_salida\":{\"date\":\"2019-04-04 08:48:15.966098\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"valor_pagado\":2700,\"precio_estacionamiento\":100,\"user_id\":1,\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo/cobro?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 13:48:16', '2019-04-04 13:48:16'),
(179, 'App\\User', 1, 'updated', 11, 'App\\ParqueaderoVehiculoModel', '{\"estado_vehiculo\":1}', '{\"estado_vehiculo\":2}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 13:48:21', '2019-04-04 13:48:21'),
(180, 'App\\User', 1, 'created', 54, 'App\\RegistroModel', '[]', '{\"sitios_parqueadero_id\":2,\"fecha_ingreso\":{\"date\":\"2019-04-04 08:48:21.570665\",\"timezone_type\":3,\"timezone\":\"America\\/Bogota\"},\"parqueadero_vehiculo_id\":11,\"estado_vehiculo\":1,\"id\":54}', 'http://localhost/parqueadero_marcos_alberto/public/EntradaSalidaVehiculo?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-04 13:48:21', '2019-04-04 13:48:21'),
(181, 'App\\User', 1, 'created', 4, 'App\\punto', '[]', '{\"id\":4,\"title\":\"aaaa\",\"body\":\"aaaa\"}', 'http://localhost/boya-2/public/punto?', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', NULL, '2019-05-30 17:14:34', '2019-05-30 17:14:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ayuda`
--

CREATE TABLE `ayuda` (
  `id` int(11) NOT NULL,
  `nombre` varchar(191) NOT NULL,
  `descricion` varchar(191) NOT NULL,
  `fuente_codigo` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ayuda`
--

INSERT INTO `ayuda` (`id`, `nombre`, `descricion`, `fuente_codigo`, `created_at`, `updated_at`) VALUES
(1, 'crear un Crub en laravel', 'se deber ingresa por consola en la raiz de proyecto y escribir el siguiente comando', 'php artisan Newconto_2:new', '2019-04-25 15:18:28', '2019-04-25 15:11:17'),
(2, 'URL en laravel ', 'crear una url con laravel sin y con datos ', '{{assect(\'\')}}', '2019-04-25 15:19:29', '2019-04-25 02:56:00'),
(7, 'múltiples lenguajes ', 'se puede trabaja con multiples lenguajes \r\nlos archivos se configura en la siguiente\r\n\r\n', '{{ trans(\'welcome.salir\') }}\r\n\r\nlos archivos se configura en la siguiente direccion resource/lang', '2019-04-25 15:25:46', '2019-04-25 14:48:57'),
(8, 'corre vue en laravel', 'ejercuta vue en laravel', 'https://www.youtube.com/watch?v=UzegdHgNEF4\r\nse deber ingresa por consola y escribir el siguiente comando \r\nnpm run watch', '2019-05-02 01:21:57', '2019-04-25 14:48:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_dispositivo_bolla`
--

CREATE TABLE `datos_dispositivo_bolla` (
  `id` int(11) NOT NULL,
  `nivel_rio` varchar(45) DEFAULT NULL,
  `velocidad_corriente` varchar(45) DEFAULT NULL,
  `temperatura` varchar(45) DEFAULT NULL,
  `dispositivo_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_dispositivo_bolla`
--

INSERT INTO `datos_dispositivo_bolla` (`id`, `nivel_rio`, `velocidad_corriente`, `temperatura`, `dispositivo_id`, `created_at`, `updated_at`) VALUES
(1, '12', '24', '34', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(2, '12', '34', '34', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(3, '12', '34', '34', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(4, '12', '34', '34', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(5, '13', '33', '34', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(6, '14', '32', '37', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(7, '12', '34', '34', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(8, '13', '33', '34', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(9, '16', '32', '37', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(10, '17', '38', '34', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(11, '18', '39', '32', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(12, '19', '40', '33', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(13, '20', '41', '34', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(14, '23', '42', '35', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(15, '15', '40', '36', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(16, '15', '39', '38', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(17, '16', '37', '39', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(18, '17', '35', '40', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(19, '17', '34', '42', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(20, '16', '33', '45', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(21, '15', '32', '36', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(22, '16', '31', '58', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(23, '17', '31', '54', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(24, '14', '21', '60', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(25, '13', '22', '45', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(26, '12', '20', '23', 2, '2019-04-23 02:16:04', '2019-04-10 13:23:00'),
(27, '12', '34', '24', 2, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(28, '12', '34', '34', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(29, '13', '33', '34', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(30, '14', '32', '37', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(31, '12', '34', '34', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(32, '13', '33', '34', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(33, '16', '32', '37', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(34, '17', '38', '34', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(35, '18', '39', '32', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(36, '19', '40', '33', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(37, '20', '41', '34', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(38, '23', '42', '35', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(39, '15', '40', '36', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(40, '15', '39', '38', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(41, '16', '37', '39', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(42, '17', '35', '40', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(43, '17', '34', '42', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(44, '16', '33', '45', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(45, '15', '32', '36', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(46, '16', '31', '58', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(47, '17', '31', '54', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(48, '14', '21', '60', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(49, '13', '22', '45', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(50, '12', '20', '23', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(51, '15', '31', '34', 3, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(52, '12', '34', '34', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(53, '13', '33', '34', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(54, '14', '32', '37', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(55, '12', '34', '37', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(56, '13', '33', '30', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(57, '16', '32', '40', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(58, '17', '38', '38', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(59, '18', '39', '34', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(60, '19', '40', '36', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(61, '20', '41', '32', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(62, '23', '42', '40', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(63, '15', '40', '33', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(64, '15', '39', '34', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(65, '16', '37', '35', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(66, '17', '35', '43', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(67, '17', '34', '40', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(68, '16', '33', '43', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(69, '15', '32', '30', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(70, '16', '31', '54', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(71, '17', '31', '57', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(72, '14', '21', '55', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(73, '13', '22', '40', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(74, '12', '20', '27', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00'),
(75, '16', '29', '28', 1, '2019-04-23 02:16:23', '2019-04-10 13:23:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivo`
--

CREATE TABLE `dispositivo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(191) NOT NULL,
  `latitud` varchar(45) NOT NULL,
  `logitud` varchar(45) NOT NULL,
  `descricion` varchar(191) NOT NULL,
  `tipo_dispositivo_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dispositivo`
--

INSERT INTO `dispositivo` (`id`, `nombre`, `latitud`, `logitud`, `descricion`, `tipo_dispositivo_id`, `users_id`, `created_at`, `updated_at`, `estado_id`) VALUES
(1, 'bolla sumapaz', '4.289061996552311', '-74.79581304186974', 'bolla de sumapaz', 1, 1, '2019-04-11 16:30:14', '2019-04-11 16:30:14', 1),
(2, 'bolla de magdalena', '4.286639988724446', '-74.80798036726407', 'bolla de', 1, 1, '2019-04-11 14:10:12', '2019-04-11 01:14:44', 1),
(3, 'bolla ricaurte', '4.284690622159137', '-74.78371964667053', 'bolla de ricaurte', 1, 1, '2019-04-11 14:10:14', '2019-04-11 01:21:04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `nombre`, `created_at`, `update_at`) VALUES
(1, 'Activo', '2019-01-06 17:21:58', '2019-01-08 05:00:00'),
(2, 'Inactivo', '2019-01-06 17:22:02', '2019-01-01 05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_01_02_221802_create_products_table', 1),
(4, '2017_01_24_112847_create_orders_table', 1),
(5, '2017_02_01_154943_create_categories_table', 1),
(6, '2017_02_04_172640_create_brands_table', 1),
(7, '2017_02_04_175220_create_brand_product_table', 1),
(8, '2017_02_04_190821_create_brand_categories', 1),
(9, '2017_02_08_205424_create_images_table', 1),
(10, '2017_02_22_000948_update_users_table', 1),
(11, '2017_02_22_001133_create_subscriptions_table', 1),
(12, '2017_02_23_171727_create_social_providers_table', 1),
(13, '2019_01_05_154546_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 1),
(3, 'App\\User', 1),
(3, 'App\\User', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(62, 'SitiosParqueadero Add', 'web', '2019-04-02 14:26:52', '2019-04-02 14:27:01'),
(63, 'SitiosParqueadero Editar', 'web', '2019-04-02 14:27:24', '2019-04-02 14:27:24'),
(64, 'SitiosParqueadero Show', 'web', '2019-04-02 14:27:37', '2019-04-02 14:27:37'),
(65, 'ZonaParqueadero Add', 'web', '2019-04-02 14:30:56', '2019-04-02 14:30:56'),
(66, 'ZonaParqueadero Editar', 'web', '2019-04-02 14:31:09', '2019-04-02 14:31:09'),
(67, 'ZonaParqueadero  Show', 'web', '2019-04-02 14:31:31', '2019-04-02 14:31:31'),
(68, 'ZonaParqueadero Eliminar', 'web', '2019-04-02 14:31:56', '2019-04-02 14:31:56'),
(69, 'CategoriaParqueadero Add', 'web', '2019-04-02 14:41:07', '2019-04-02 14:41:32'),
(70, 'CategoriaParqueadero Show', 'web', '2019-04-02 14:41:53', '2019-04-02 14:41:53'),
(71, 'CategoriaParqueadero Editar', 'web', '2019-04-02 14:42:05', '2019-04-02 14:42:05'),
(72, 'CategoriaParqueadero Eliminar', 'web', '2019-04-02 14:42:18', '2019-04-02 14:42:18'),
(73, 'Niveles Show', 'web', '2019-04-02 14:51:43', '2019-04-02 14:51:43'),
(74, 'Niveles Editar', 'web', '2019-04-02 14:51:55', '2019-04-02 14:51:55'),
(75, 'Niveles Add', 'web', '2019-04-02 14:52:06', '2019-04-02 14:52:06'),
(76, 'ParqueaderoVehiculo Show', 'web', '2019-04-02 18:59:37', '2019-04-02 18:59:37'),
(77, 'ParqueaderoVehiculo Editar', 'web', '2019-04-02 18:59:49', '2019-04-02 19:00:03'),
(78, 'ParqueaderoVehiculo Add', 'web', '2019-04-02 19:00:14', '2019-04-02 19:00:14'),
(79, 'TipoVehiculo Add', 'web', '2019-04-02 19:04:22', '2019-04-02 19:04:32'),
(80, 'TipoVehiculo Show', 'web', '2019-04-02 19:04:42', '2019-04-02 19:04:42'),
(81, 'TipoVehiculo Editar', 'web', '2019-04-02 19:04:56', '2019-04-02 19:04:56'),
(82, 'ParqueaderoVehiculo cobra', 'web', '2019-04-02 21:47:28', '2019-04-02 21:47:28'),
(83, 'TipoDispositivo add', 'web', '2019-04-10 23:47:39', '2019-04-10 23:47:39'),
(84, 'TipoDispositivo Editar', 'web', '2019-04-10 23:47:54', '2019-04-10 23:47:54'),
(85, 'TipoDispositivo Show', 'web', '2019-04-10 23:48:04', '2019-04-10 23:48:04'),
(86, 'TipoDispositivo  Eliminar', 'web', '2019-04-10 23:48:14', '2019-04-10 23:48:14'),
(87, 'TipoDispositivo Eliminar', 'web', '2019-04-10 23:52:33', '2019-04-10 23:52:33'),
(88, 'Dispositivo Show', 'web', '2019-04-11 00:19:26', '2019-04-11 00:19:26'),
(89, 'Dispositivo Editar', 'web', '2019-04-11 00:19:41', '2019-04-11 00:19:41'),
(90, 'Dispositivo Add', 'web', '2019-04-11 00:19:50', '2019-04-11 00:19:50'),
(91, 'Dispositivo Eliminar', 'web', '2019-04-11 00:19:59', '2019-04-11 00:19:59'),
(92, 'Producto Add', 'web', '2019-05-04 16:14:17', '2019-05-04 16:14:17'),
(93, 'Producto Editar', 'web', '2019-05-04 16:14:41', '2019-05-04 16:14:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre_proveedor` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `imagen` varchar(45) NOT NULL,
  `precio_caja` int(11) NOT NULL,
  `cantidad_caja` int(11) NOT NULL,
  `precio_unidad` int(11) NOT NULL,
  `iva` int(11) NOT NULL,
  `porcentaje_ganacia` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `ganacia` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre_proveedor`, `nombre`, `imagen`, `precio_caja`, `cantidad_caja`, `precio_unidad`, `iva`, `porcentaje_ganacia`, `precio_venta`, `ganacia`, `proveedor_id`, `created_at`, `updated_at`) VALUES
(3, 'bocadillo veleño', 'bocadillo veleño', 'EE', 7800, 36, 217, 19, 60, 388, 171, 1, '2019-05-06 17:20:15', '2019-05-06 22:20:15'),
(4, 'vive 100', 'vive 100', 'EE', 35464, 24, 1478, 19, 50, 2501, 1023, 1, '2019-05-06 17:22:10', '2019-05-06 22:22:10'),
(5, 'schon cerveroni zenu 1.2kg', 'schon cerveroni zenu 1.2kg', 'EE', 13787, 1, 13787, 19, 30, 20543, 6756, 1, '2019-05-06 19:52:21', '2019-05-07 00:52:21'),
(6, 'schon cervec rica 950g', 'schon cervec rica 950g', 'EE', 7636, 1, 7636, 19, 30, 11378, 3742, 1, '2019-05-06 19:53:48', '2019-05-07 00:53:48'),
(7, 'pañuelo normal chicx12x10', 'pañuelo normal chicx12x10', 'EE', 7193, 10, 719, 19, 48, 1201, 481, 1, '2019-05-30 16:25:56', '2019-05-30 21:25:56'),
(8, 'yogurt original', 'yogurt original', 'no tiene', 1145, 1, 1145, 19, 56, 2000, 855, 1, '2019-05-31 19:52:27', '2019-05-31 19:52:27'),
(9, 'aguadiente necta club tetra 1500cc', 'aguadiente necta club 1500cc', 'notiene', 47594, 1, 47594, 5, 30, 64252, 16658, 1, '2019-05-31 20:09:42', '2019-05-31 20:09:42'),
(10, 'coca cola 400ml pet', 'cocacola 400ml', 'hh', 14790, 12, 1233, 19, 43, 2000, 768, 1, '2019-05-31 20:37:08', '2019-05-31 20:37:08'),
(11, 'coca cola 1.5lt', 'cocacola 400ml', 'hh', 29580, 12, 2465, 19, 43, 4001, 1536, 1, '2019-05-31 20:38:22', '2019-05-31 20:38:22'),
(12, 'coca cola 3lt', 'coca cola 3 litros', 'hh', 26219, 6, 4370, 19, 41, 7000, 2631, 1, '2019-05-31 20:42:45', '2019-05-31 20:42:45'),
(13, 'coca cola 6.5oz vir', 'coca cola 250ml', 'hh', 16723, 30, 557, 19, 61, 1003, 446, 1, '2019-05-31 20:50:56', '2019-05-31 20:50:56'),
(14, 'coca cola 20oz pet', 'coca cola 600ml', 'hh', 29832, 15, 1989, 19, 32, 3000, 1011, 1, '2019-05-31 21:05:03', '2019-05-31 21:05:03'),
(15, 'Agua brisa pet 600ml', 'agua brisa pet 600ml', 'ff', 27900, 24, 1163, 19, 96, 2501, 1338, 1, '2019-05-31 21:08:43', '2019-05-31 21:08:43'),
(16, 'jumbo mani 12', 'jumbo mani mini 18gm', 'ff', 11324, 24, 472, 19, 30, 703, 231, 1, '2019-05-31 21:54:46', '2019-05-31 21:54:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descricion` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre`, `descricion`, `created_at`, `updated_at`) VALUES
(1, 'COCA COLA', 'NO TR', '2019-05-05 20:50:38', '2019-05-02 05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto`
--

CREATE TABLE `punto` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` varchar(200) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `punto`
--

INSERT INTO `punto` (`id`, `title`, `body`, `updated_at`, `created_at`) VALUES
(1, 'como esta tu', 'aqui esta los demas', '2019-05-30 16:56:36', '0000-00-00 00:00:00'),
(2, 'como esta tu', 'aqui esta los demas', '2019-05-30 16:56:36', '0000-00-00 00:00:00'),
(3, 'como esta tu', 'aqui esta los demas', '2019-05-30 16:56:36', '0000-00-00 00:00:00'),
(4, 'aaaa', 'aaaa', '2019-05-30 17:14:33', '2019-05-30 17:14:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2019-01-05 21:03:14', '2019-01-05 21:03:14'),
(2, 'Administrador', 'web', '2019-01-24 02:32:21', '2019-01-24 02:32:21'),
(3, 'Super Administrador', 'web', '2019-04-02 14:22:39', '2019-04-02 14:22:39'),
(4, 'taquillero', 'web', '2019-04-04 12:18:28', '2019-04-04 12:18:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(59, 2),
(60, 1),
(60, 2),
(61, 1),
(61, 2),
(62, 3),
(63, 3),
(64, 3),
(65, 2),
(65, 3),
(66, 2),
(66, 3),
(67, 2),
(67, 3),
(68, 3),
(69, 2),
(69, 3),
(70, 2),
(70, 3),
(71, 2),
(71, 3),
(72, 2),
(72, 3),
(73, 2),
(73, 3),
(74, 2),
(74, 3),
(75, 2),
(75, 3),
(76, 2),
(76, 3),
(76, 4),
(77, 2),
(77, 3),
(77, 4),
(78, 2),
(78, 3),
(78, 4),
(79, 3),
(80, 3),
(81, 3),
(82, 2),
(82, 3),
(82, 4),
(83, 3),
(84, 3),
(85, 3),
(86, 3),
(87, 3),
(88, 3),
(89, 3),
(90, 3),
(91, 3),
(92, 1),
(92, 2),
(92, 3),
(92, 4),
(93, 2),
(93, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_dispositivo`
--

CREATE TABLE `tipo_dispositivo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_dispositivo`
--

INSERT INTO `tipo_dispositivo` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'bolla', '2019-04-11 00:15:51', '2019-04-11 00:15:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_productos`
--

CREATE TABLE `tipo_productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_productos_has_producto`
--

CREATE TABLE `tipo_productos_has_producto` (
  `id` int(11) NOT NULL,
  `tipo_productos_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://placehold.it/88x88',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` int(11) NOT NULL,
  `correo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `celular` int(11) NOT NULL,
  `telefono_fijo` int(11) NOT NULL,
  `direccion_correo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `nickname`, `avatar`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`, `nombre`, `apellido`, `cedula`, `correo`, `celular`, `telefono_fijo`, `direccion_correo`) VALUES
(1, 'marcos alberto saavedra', 'once.marcos.alberto@gmail.com', '$2y$10$7ULrAbLcMD8BiPyZ3UqcEOAU2944pzdvDORQiL7RGyYdiM5n7lF36', NULL, '1555985093pH0j7.jpg', 'bkWb1oA7r82WsuFujobP8cwmWflppdf41brbHBmzhuBMvwg4tbqwqNnUut7H', '2019-01-05 03:53:36', '2019-04-23 02:04:53', NULL, NULL, NULL, NULL, 'marcus', 'saavedra', 1069176309, 'once.marcos.alberto@gmail.com', 2147483647, 32456, 'como esta tu'),
(2, 'marcos alberto', 'once.marcos@gmail.com', '$2y$10$7ULrAbLcMD8BiPyZ3UqcEOAU2944pzdvDORQiL7RGyYdiM5n7lF36', NULL, '', NULL, '2019-02-06 01:29:23', '2019-02-06 01:29:23', NULL, NULL, NULL, NULL, '', '', 0, '', 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `ventas_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audits_auditable_id_auditable_type_index` (`auditable_id`,`auditable_type`),
  ADD KEY `audits_user_id_user_type_index` (`user_id`,`user_type`);

--
-- Indices de la tabla `ayuda`
--
ALTER TABLE `ayuda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_dispositivo_bolla`
--
ALTER TABLE `datos_dispositivo_bolla`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_datos_dispositivo_dispositivo1_idx` (`dispositivo_id`);

--
-- Indices de la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dispositivo_tipo_dispositivo_idx` (`tipo_dispositivo_id`),
  ADD KEY `fk_dispositivo_users1_idx` (`users_id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_proveedor1_idx` (`proveedor_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `punto`
--
ALTER TABLE `punto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `tipo_dispositivo`
--
ALTER TABLE `tipo_dispositivo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_productos_has_producto`
--
ALTER TABLE `tipo_productos_has_producto`
  ADD PRIMARY KEY (`id`,`tipo_productos_id`,`producto_id`),
  ADD KEY `fk_tipo_productos_has_producto_producto1_idx` (`producto_id`),
  ADD KEY `fk_tipo_productos_has_producto_tipo_productos1_idx` (`tipo_productos_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `audits`
--
ALTER TABLE `audits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT de la tabla `ayuda`
--
ALTER TABLE `ayuda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `datos_dispositivo_bolla`
--
ALTER TABLE `datos_dispositivo_bolla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `punto`
--
ALTER TABLE `punto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_dispositivo`
--
ALTER TABLE `tipo_dispositivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_productos_has_producto`
--
ALTER TABLE `tipo_productos_has_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos_dispositivo_bolla`
--
ALTER TABLE `datos_dispositivo_bolla`
  ADD CONSTRAINT `fk_datos_dispositivo_dispositivo1` FOREIGN KEY (`dispositivo_id`) REFERENCES `dispositivo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD CONSTRAINT `fk_dispositivo_tipo_dispositivo` FOREIGN KEY (`tipo_dispositivo_id`) REFERENCES `tipo_dispositivo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dispositivo_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tipo_productos_has_producto`
--
ALTER TABLE `tipo_productos_has_producto`
  ADD CONSTRAINT `fk_tipo_productos_has_producto_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo_productos_has_producto_tipo_productos1` FOREIGN KEY (`tipo_productos_id`) REFERENCES `tipo_productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
