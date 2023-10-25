-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2023 a las 01:08:20
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `checklistdb`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_agregar_tarea` (IN `p_titulo` VARCHAR(255), IN `p_descripcion` TEXT, IN `p_responsable` VARCHAR(255), IN `p_fecha_compromiso` DATE, IN `p_estado` ENUM('por hacer','en progreso','terminada'), IN `p_tipo_tarea` ENUM('tarea','taller','laboratorio','asignacion','investigacion','charla','proyecto','parcial','examen'))  BEGIN
	IF p_estado IS NULL OR p_estado = '' THEN
        SET p_estado = 'por hacer';
    END IF;
    
    INSERT INTO checklist (titulo, descripcion, responsable, fecha_compromiso, estado, tipo_tarea)
    VALUES (p_titulo, p_descripcion, p_responsable, p_fecha_compromiso, p_estado, p_tipo_tarea);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editar_tarea` (IN `p_idTarea` INT, IN `p_titulo` VARCHAR(255), IN `p_descripcion` TEXT, IN `p_responsable` VARCHAR(255), IN `p_fechaCompromiso` DATE, IN `p_estado` ENUM('por hacer','en progreso','terminada'), IN `p_tipoTarea` ENUM('tarea','taller','laboratorio','asignacion','investigacion','charla','proyecto','parcial','examem'))  BEGIN
    UPDATE checklist
    SET
        titulo = p_titulo,
        descripcion = p_descripcion,
        responsable = p_responsable,
        fecha_compromiso = p_fechaCompromiso,
        estado = p_estado,
        tipo_tarea = p_tipoTarea
    WHERE
        id = p_idTarea;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_tarea` (IN `p_id` INT)  BEGIN
    DELETE FROM checklist
    WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_mostrar_tareas` ()  BEGIN
    SELECT id, titulo, descripcion, responsable, fecha_compromiso, estado, tipo_tarea
    FROM checklist;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_mostrar_tareas_por_estado` (IN `p_estado` ENUM('por hacer','en progreso','terminada'))  BEGIN
    SELECT * FROM checklist WHERE estado = p_estado;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_tarea_por_id` (IN `tarea_id` INT)  BEGIN
    SELECT * FROM checklist WHERE id = tarea_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checklist`
--

CREATE TABLE `checklist` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text,
  `responsable` varchar(255) DEFAULT NULL,
  `fecha_compromiso` date DEFAULT NULL,
  `estado` enum('por hacer','en progreso','terminada') DEFAULT NULL,
  `tipo_tarea` enum('tarea','taller','laboratorio','asignacion','investigacion','charla','proyecto','parcial','examen') NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `checklist`
--

INSERT INTO `checklist` (`id`, `titulo`, `descripcion`, `responsable`, `fecha_compromiso`, `estado`, `tipo_tarea`, `fecha_creacion`) VALUES
(52, 'prueba', 'prueba', 'oscar', '2023-10-26', 'por hacer', 'tarea', '2023-10-25 22:28:28'),
(53, 'prueba', 'prueba', 'oscar', '2023-10-26', 'en progreso', 'taller', '2023-10-25 22:28:37'),
(54, 'prueba', 'prueba', 'oscar', '2023-10-26', 'terminada', 'parcial', '2023-10-25 22:28:52');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
