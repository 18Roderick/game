-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2018 a las 22:23:26
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydb`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `existe_correo` (IN `_correo` VARCHAR(255), OUT `_existe` INT)  BEGIN
  SET _existe = (
    SELECT count(`correo`) FROM personal WHERE `correo` = _correo
  );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `existe_usuario` (IN `_username` VARCHAR(255), OUT `_existe` INT)  BEGIN
  SET _existe = 0;
  SET _existe = (
    SELECT count(`username`) FROM `usuario` WHERE `username` = _username
  );

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nuevo_usuario` (IN `_nombre` VARCHAR(255), IN `_apellido` VARCHAR(255), IN `_sexo` CHAR(1), IN `_cedula` VARCHAR(255), IN `_celular` VARCHAR(255), IN `_correo` VARCHAR(255), IN `_fecha` DATE, IN `_username` VARCHAR(255), IN `_password` VARCHAR(255), OUT `_creado` BOOLEAN)  BEGIN

  DECLARE _user_exist varchar(255) DEFAULT "";
  DECLARE _idUser int DEFAULT 0;

  SET _user_exist = (  
    SELECT username   FROM `usuario`  where username = _username 
    );

  IF _user_exist = _username then
      set _creado = FALSE;
  ELSE 
    insert into `usuario`(`username`, `password`) values (_username, _password);
    
    SET _idUser = (
      SELECT id from `usuario` where `username` = _username
    );

    INSERT INTO `personal`
    (`nombre`, `apellido`, `sexo`, `cedula`, `celular`, `fecha`, `correo`, `usuario_id`) 
    VALUES (_nombre, _apellido, _sexo, _cedula, _celular, _fecha, _correo, _idUser);

    SET _creado = TRUE;

  END if;


END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `fnIniciarSesion` (`_user` VARCHAR(255), `_password` VARCHAR(255)) RETURNS TINYINT(1) begin
  declare _existe boolean default false;
  declare cantidad int default 0;

  set cantidad = (
    SELECT  COUNT(DISTINCT(us.username)) 
    FROM `usuario` AS us, `personal` as p WHERE us.password = _password 
    AND (us.username = _user OR p.cedula = _user OR p.correo = _user)

    ); 
  
  return cantidad;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fnValidarCedula` (`_cedula` VARCHAR(255)) RETURNS TINYINT(1) begin
  declare _existe boolean default false;
  declare cantidad int default 0;

  set cantidad = (
    SELECT count(`cedula`) FROM `personal` WHERE `cedula` = _cedula
    ); 
  
  if cantidad < 1 then
    set _existe = false;
  else
    set _existe = true;
  end if;
  return _existe;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fnValidarCorreo` (`_correo` VARCHAR(255)) RETURNS TINYINT(1) begin
  declare _existe boolean default false;
  declare cantidad int default 0;

  set cantidad = (
    SELECT count(`correo`) FROM `personal` WHERE `correo` = _correo
    ); 
  
  if cantidad < 1 then
    set _existe = false;
  else
    set _existe = true;
  end if;
  return _existe;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fnValidarUsuario` (`_user` VARCHAR(255)) RETURNS TINYINT(1) begin
  declare _existe boolean default false;
  declare cantidad int default 0;

  set cantidad = (
    SELECT count(`username`) FROM `usuario` WHERE `username` = _user
    ); 
  
  if cantidad < 1 then
    set _existe = false;
  else
    set _existe = true;
  end if;
  return _existe;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `unidad_comp` int(11) DEFAULT NULL,
  `puntaje` int(11) DEFAULT NULL,
  `logro_comp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logros`
--

CREATE TABLE `logros` (
  `id` int(11) NOT NULL,
  `logros` varchar(45) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logros_has_calificacion`
--

CREATE TABLE `logros_has_calificacion` (
  `logros_id` int(11) NOT NULL,
  `calificacion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='contiene los nombre de los modulos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `sexo` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cedula` varchar(45) NOT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `correo` varchar(255) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `nombre`, `apellido`, `sexo`, `cedula`, `celular`, `telefono`, `fecha`, `correo`, `usuario_id`) VALUES
(13, 'roderick', 'romero', 'M', '8-910-498', '6593-2892', NULL, '1996-09-21', 'rjrr507@gmail.com', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `unidad` int(11) NOT NULL,
  `preguntas` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `opcion` varchar(45) NOT NULL,
  `correcta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `tipo` char(1) NOT NULL DEFAULT 'B',
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `tipo`, `username`, `password`) VALUES
(13, 'B', 'rjrr507', 'go3dlnYJ6v2jM');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_calificacion_usuario1_idx` (`usuario_id`),
  ADD KEY `fk_calificacion_pregunta1_idx` (`pregunta_id`);

--
-- Indices de la tabla `logros`
--
ALTER TABLE `logros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_logros_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `logros_has_calificacion`
--
ALTER TABLE `logros_has_calificacion`
  ADD PRIMARY KEY (`logros_id`,`calificacion_id`),
  ADD KEY `fk_logros_has_calificacion_calificacion1_idx` (`calificacion_id`),
  ADD KEY `fk_logros_has_calificacion_logros1_idx` (`logros_id`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_personal_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_respuesta_pregunta_idx` (`pregunta_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `logros`
--
ALTER TABLE `logros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `fk_calificacion_pregunta1` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_calificacion_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logros`
--
ALTER TABLE `logros`
  ADD CONSTRAINT `fk_logros_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logros_has_calificacion`
--
ALTER TABLE `logros_has_calificacion`
  ADD CONSTRAINT `fk_logros_has_calificacion_calificacion1` FOREIGN KEY (`calificacion_id`) REFERENCES `calificacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logros_has_calificacion_logros1` FOREIGN KEY (`logros_id`) REFERENCES `logros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `fk_personal_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `fk_respuesta_pregunta` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
