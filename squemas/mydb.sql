-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2018 a las 21:20:15
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_modulo` (`_id` INT, `_titulo` TEXT, `_descripcion` TEXT)  begin
   UPDATE `modulo` SET `titulo` = _titulo , `descripcion` = _descripcion WHERE `id` = _id; 
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_progreso` (`_user` VARCHAR(255), `_idPregunta` INT)  begin
  DECLARE _existe  int;
  DECLARE _id int;
  DECLARE _idModulo int DEFAULT 0;
  DECLARE _cantidad int DEFAULT 0;

  SET _id = (
    SELECT `id` from `usuario` where `username` = _user
  );

  SET _existe = (
     SELECT COUNT(`id_pregunta`) as cantidad from `progreso` 
     where `id_usuario` = _id and `id_pregunta` = _idPregunta
  );

  IF _existe < 1 then
    INSERT INTO `progreso` (`id_usuario`, `id_pregunta`,`acierto`) VALUES
    (_id, _idPregunta, 1);

    set _idModulo = (
      SELECT unidad from `preguntas` where `id` = _idPregunta 
    );

    set _cantidad = 1 + (
      SELECT `cantidad_respondidas` from `completo`
       where `id_usuario` = _id  AND `unidad` = _idModulo 
    );

    UPDATE `completo` SET `cantidad_respondidas` = _cantidad;

  END IF;
  

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_puntaje` (`_user` VARCHAR(255), `_puntaje` INT)  begin
  DECLARE _puntajeActual int;
  
  DECLARE _id int;
  SET _id = (
    SELECT `id` from `usuario` where `username` = _user
  );

  SET _puntajeActual = _puntaje + (
    SELECT `puntaje` from `ranking` where `id_usuario` = _id
  );

  UPDATE `ranking` SET `puntaje` = _puntajeActual where `id_usuario` = _id;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `borrar_modulo` (`_id` INT)  begin
   DELETE FROM `modulo` WHERE `id` = _id; 
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cargar_modulos` ()  BEGIN

    SELECT * FROM modulo;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cargar_preguntas` (`_id` INT)  BEGIN

    SELECT * FROM preguntas where unidad = _id ORDER BY RAND();

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cargar_ranking` ()  begin
  SELECT usuario.username, ranking.puntaje from usuario 
  INNER JOIN ranking ON usuario.id = ranking.id_usuario ORDER BY ranking.puntaje DESC limit 20;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cargar_respuestas` (`_id` INT)  BEGIN

    SELECT * FROM respuestas where pregunta_id = _id ORDER BY RAND();

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_progreso` (`_user` VARCHAR(255))  begin
  DECLARE _id int;
  SET _id = (
    SELECT `id` from `usuario` where `username` = _user
  );

  SELECT * from `completo` where `id_usuario` = _id;


end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_puntaje` (`_user` VARCHAR(255))  begin
  DECLARE _id int;
  SET _id = (
    SELECT `id` from `usuario` where `username` = _user
  );

  SELECT `puntaje` from `ranking` where `id_usuario` = _id;


end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_repuesta` (`_id` INT)  begin
  SELECT * FROM `respuestas` WHERE `id` = _id; 
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crear_modulo` (`_titulo` TEXT, `_descripcion` TEXT)  begin
   INSERT INTO `modulo`(`titulo`, `descripcion`) VALUES (_titulo, _descripcion); 
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `datos_usuario` (IN `_user` VARCHAR(255))  BEGIN
    SELECT u.id as `usuario_id` ,p.nombre, p.apellido, p.celular, p.correo, u.username, r.puntaje
    from personal as p
    inner join usuario as u on p.usuario_id = u.id
    inner join ranking as r on p.usuario_id = r.id_usuario  WHERE 
    u.username = _user OR p.cedula = _user OR p.correo = _user;

END$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `iniciar_sesion` (`_user` VARCHAR(255), `_password` VARCHAR(255))  begin
    SELECT  us.username
    FROM `usuario` AS us, `personal` as p WHERE us.password = _password 
    AND (us.username = _user OR p.cedula = _user OR p.correo = _user);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `logout` (`_idUser` VARCHAR(255))  BEGIN
  DECLARE _online int;
  DECLARE _id int;
  SET _id = (
    SELECT `id` from `usuario` where `username` = _idUser
  );

  SET _online = (
    SELECT `online` from `status` where `id_usuario` = _id
  );

  IF _online > 0 then
    UPDATE `status` SET `online`= 0 WHERE `id_usuario` = _id;
  ELSE
    UPDATE `status` SET `online`= 1 WHERE `id_usuario` = _id;
  
  END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nuevo_usuario` (IN `_nombre` VARCHAR(255), IN `_apellido` VARCHAR(255), IN `_sexo` CHAR(1), IN `_cedula` VARCHAR(255), IN `_celular` VARCHAR(255), IN `_correo` VARCHAR(255), IN `_fecha` DATE, IN `_username` VARCHAR(255), IN `_password` VARCHAR(255), OUT `_creado` BOOLEAN)  BEGIN

  DECLARE _user_exist varchar(255) DEFAULT "";
  DECLARE _idUser int DEFAULT 0;
  DECLARE _cantidad int DEFAULT 0;
  DECLARE _idModulo int DEFAULT 0;

  SET _user_exist = (  
    SELECT username   FROM `usuario`  where username = _username 
    );

  IF _user_exist = _username then
      set _creado = 0;
  ELSE 
    insert into `usuario`(`username`, `password`) values (_username, _password);
    
    SET _idUser = (
      SELECT id from `usuario` where `username` = _username
    );

    INSERT INTO `personal`
    (`nombre`, `apellido`, `sexo`, `cedula`, `celular`, `fecha`, `correo`, `usuario_id`) 
    VALUES (_nombre, _apellido, _sexo, _cedula, _celular, _fecha, _correo, _idUser);

    INSERT INTO `status` (`id_usuario`,`online`) VALUES (_idUser, 1);
    INSERT INTO `ranking` (`id_usuario`) VALUES(_idUser);

    set _idModulo = (
      SELECT id from modulo LIMIT 1
    );

    set _cantidad = (
      SELECT COUNT(`preguntas`) from preguntas WHERE unidad = _idModulo
    );

    INSERT INTO `completo` 
      (`id_usuario`, `unidad`, `cantidad_preguntas`, `cantidad_respondidas`)
      VALUES (_idUser, _idModulo, _cantidad, 0);
    SET _creado = 1;

  END if;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `respuestas` ()  begin
  SELECT `opcion`, `correcta`, `pregunta_id`, `id` FROM `respuestas` ;
end$$

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
-- Estructura de tabla para la tabla `completo`
--

CREATE TABLE IF NOT EXISTS `completo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `unidad` int(11) NOT NULL,
  `cantidad_preguntas` int(11) NOT NULL,
  `cantidad_respondidas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `completo`
--

INSERT INTO `completo` (`id`, `id_usuario`, `unidad`, `cantidad_preguntas`, `cantidad_respondidas`) VALUES
(1, 22, 1, 15, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE IF NOT EXISTS `modulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='contiene los nombre de los modulos';

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id`, `titulo`, `descripcion`) VALUES
(1, 'Modulo 1', ''),
(2, 'Modulo 2', ''),
(3, 'Modulo 3', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `sexo` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cedula` varchar(45) NOT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `correo` varchar(255) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula` (`cedula`),
  UNIQUE KEY `correo` (`correo`),
  KEY `fk_personal_usuario1_idx` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `nombre`, `apellido`, `sexo`, `cedula`, `celular`, `telefono`, `fecha`, `correo`, `usuario_id`) VALUES
(22, 'roderick', 'romero', 'M', '8-910-498', '6593-2892', NULL, '1996-09-21', 'rjrr507@gmail.com', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE IF NOT EXISTS `preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad` int(11) NOT NULL,
  `preguntas` text,
  PRIMARY KEY (`id`),
  KEY `fk_modulo_pregunta` (`unidad`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `unidad`, `preguntas`) VALUES
(1, 1, '¿Qué es una metodología ágil?'),
(2, 1, 'Pilares fundamentales de las metodologías ágiles:'),
(3, 1, 'Enfoque de desarrollo de las metodologías agiles:'),
(4, 1, '¿La definición moderna de desarrollo ágil de software evolucionó a mediados de la década de:?'),
(5, 1, '¿En qué año se adoptó el nombre de \"métodos ágiles\"?'),
(6, 1, '¿Qué es la \"Alianza Ágil\"?'),
(7, 1, 'Principal prioridad de las metodologías ágiles:'),
(8, 1, 'Las metodologías ágiles son tolerantes a:'),
(9, 1, 'En las metodologías ágiles el cliente está involucrado:'),
(10, 1, 'Las entregas parciales se realizan en promedio entre:'),
(11, 1, '¿En qué año se firmó el Manifiesto Ágil y los principios ágiles?'),
(12, 1, '¿Cuántos valores o postulados tiene el Manifiesto Ágil?'),
(13, 1, '¿Cuántos principios tiene el Manifiesto Ágil?'),
(14, 1, '¿Qué es el Manifiesto Ágil?'),
(15, 1, 'Valorar el software que funciona:'),
(16, 2, '¿Cuál es la metodología ágil que exponemos en este sitio?'),
(17, 2, '¿Quién propuso la metodología DAS?'),
(18, 2, '¿En qué año se propuso la metodología DAS?'),
(19, 2, '¿Qué significa DAS?'),
(20, 2, '¿En qué año se propuso la metodología DAS?'),
(21, 2, '¿Qué significa DAS?'),
(22, 2, 'Filosofía en la qué se centra esta metodología:'),
(23, 2, 'Marco que proporciona DAS:'),
(24, 2, '¿Qué fomenta el método DAS?'),
(25, 2, '¿Qué es DAS?'),
(26, 2, 'Guiado por los riesgos:'),
(27, 2, 'DAS culmina cada ciclo con:'),
(28, 2, 'Iterativo.'),
(29, 2, 'El resultado de las reuniones al final de cada ciclo:'),
(30, 2, 'Tolerante a los cambios.'),
(31, 3, '¿Cuántas fases tiene el ciclo de vida DAS?'),
(32, 3, 'Fases de DAS'),
(33, 3, 'Primera fase de DAS'),
(34, 3, 'Segunda fase de DAS'),
(35, 3, 'Tercera fase de DAS'),
(36, 3, 'En DAS el término planificar se reemplaza por el término:'),
(37, 3, '¿En qué fase se establecen objetivos y metas del proyecto?'),
(38, 3, 'Fase donde se centra la mayor parte del desarrollo:'),
(39, 3, 'Según DAS las aplicaciones complejas:'),
(40, 3, 'En la fase de colaboración se busca que en el equipo haya:'),
(41, 3, 'Fase que consiste en capturar lo que se ha aprendido:'),
(42, 3, 'Se decide el número de iteraciones:'),
(43, 3, 'Calidad del producto desde un punto de vista del cliente:');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso`
--

CREATE TABLE IF NOT EXISTS `progreso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pregunta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `acierto` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `progreso`
--

INSERT INTO `progreso` (`id`, `id_pregunta`, `id_usuario`, `acierto`) VALUES
(14, 5, 22, 1),
(15, 1, 22, 1),
(16, 11, 22, 1),
(17, 14, 22, 1),
(18, 8, 22, 1),
(19, 6, 22, 1),
(20, 2, 22, 1),
(21, 7, 22, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ranking`
--

CREATE TABLE IF NOT EXISTS `ranking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `puntaje` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_ranking_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='tabla de puntaje del jugador';

--
-- Volcado de datos para la tabla `ranking`
--

INSERT INTO `ranking` (`id`, `id_usuario`, `puntaje`) VALUES
(4, 22, 360);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE IF NOT EXISTS `respuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta_id` int(11) NOT NULL,
  `opcion` text COLLATE utf16_bin NOT NULL,
  `correcta` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pregunta_respuesta` (`pregunta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `pregunta_id`, `opcion`, `correcta`) VALUES
(1, 1, 'Metodología que permite adaptar el desarrollo del proyecto a la forma de trabajo.', 0),
(2, 1, 'Metodología que permite adaptar el desarrollo del proyecto a las peticiones del cliente.', 0),
(3, 1, 'Metodología que permite el desarrollo de software siguiendo un patró de diseño.', 0),
(4, 1, 'Metodología que permite adaptar la forma de trabajo al contexto y naturaleza de un proyecto.', 1),
(5, 2, 'Trabajo colaborativo y en equipo', 1),
(6, 2, 'Comunicación continua con el cliente', 0),
(7, 2, 'Desarrollo basado en iteraciones y contrucción de prototipos', 0),
(8, 2, 'Satisfacción de los requerimientos y necesidades del cliente', 0),
(9, 3, 'Desarrollo iterativo e incremental', 1),
(10, 3, 'Desarrollo iterativo y en espiral', 0),
(11, 3, 'Desarrollo incremental en cascada', 0),
(12, 3, 'Desarrollo iterativo y lógico', 0),
(13, 4, '1990', 1),
(14, 4, '1980', 0),
(15, 4, '1970', 0),
(16, 4, '2000', 0),
(17, 5, '2001', 1),
(18, 5, '2000', 0),
(19, 5, '1998', 0),
(20, 5, '1990', 0),
(21, 6, 'Organización sin fines de lucro que promueve el desarrollo ágil de aplicaciones.', 1),
(22, 6, 'Organización craedora de las principales metodologías ágiles.', 0),
(23, 6, 'Organización con fines de lucro que promueve el desarrollo ágil.', 0),
(24, 6, 'Conjunto de empresas que aplican las metodologís ágiles.', 0),
(25, 7, 'El cliente', 1),
(26, 7, 'El proyecto', 0),
(27, 7, 'El equipo de trabajo', 0),
(28, 7, 'Los requerimientos', 0),
(29, 8, 'Cambios de requisitos', 1),
(30, 8, 'Incremento de riesgos', 0),
(31, 8, 'Incremento de costos', 0),
(32, 8, 'Reducción de costos', 0),
(33, 9, 'En todo el desarrollo del proyecto', 1),
(34, 9, 'En las entregas parciales del proyecto.', 0),
(35, 9, 'En la determinación de objetivos del proyecto.', 0),
(36, 9, 'En la etapa de prueba del producto.', 0),
(37, 10, '15 a 60 días', 1),
(38, 10, '10 a 20 días', 0),
(39, 10, '20 a 40 días', 0),
(40, 10, '60 a 90 días', 0),
(41, 11, '2001', 1),
(42, 11, '2000', 0),
(43, 11, '1998', 0),
(44, 11, '2005', 0),
(45, 12, '4', 1),
(46, 12, '5', 0),
(47, 12, '3', 0),
(48, 12, '7', 0),
(49, 13, '12', 1),
(50, 13, '10', 0),
(51, 13, '8', 0),
(52, 13, '6', 0),
(53, 14, 'Es la expresión de las ideas fundamentales de las metodologías ágiles.', 1),
(54, 14, 'Un diccionario de metodologías ágiles.', 0),
(55, 14, 'Un diccionario de metodologías ágiles.', 0),
(56, 14, 'Metodología de la cual se derivan las otras metodologías ágiles.', 0),
(57, 15, 'Es un postulado del Manifiesto Ágil.', 1),
(58, 15, 'Es un principio del Manifiesto Ágil.', 0),
(59, 15, 'Es un beneficio de las metodologías ágiles.', 0),
(60, 15, 'Es una ventaja de las metodologías ágiles.', 0),
(61, 16, 'Desarrollo Adaptativo de Software', 1),
(62, 16, 'Programación Extrema', 0),
(63, 16, 'Lean', 0),
(64, 16, 'Departamento adminstrativo de seguridad', 0),
(65, 17, 'Jim Highsmith y Sam Bayer', 1),
(66, 17, 'Jeff Sutherland', 0),
(67, 17, 'Taiichi Ohno', 0),
(68, 17, 'Bill Opdyke', 0),
(69, 18, '1998', 1),
(70, 18, '1974', 0),
(71, 18, '1992', 0),
(72, 18, '1993', 0),
(73, 19, 'Desarrollo Adaptativo de Software', 1),
(74, 19, 'Desarrollo Avanzado de Software', 0),
(75, 19, 'Desarrollo Ágil de Software', 0),
(76, 19, 'Dominio Avanzado de Software', 0),
(77, 20, 'Colaboración humana y la organización del equipo', 1),
(78, 20, 'El cliente como prioridad', 0),
(79, 20, 'Reestructuración de piezas de código existente', 0),
(80, 20, 'Desarrollo iterativo e incremental', 0),
(81, 21, 'Un marco para el desarrollo iterativo de sistemas grandes y complejos.', 1),
(82, 21, 'Un marco para el desarrollo iterativo de sistemas pequeños.', 0),
(83, 21, 'Un ambiente colaborativo de desarrollo', 0),
(84, 21, 'Un método tolerante a cambios', 0),
(85, 22, 'El desarrollo iterativo e incremental con el uso de prototipos.', 1),
(86, 22, 'La organización del equipo', 0),
(87, 22, 'El desarrollo iterativo en cascada', 0),
(88, 22, 'El desarrollo iterativo estructurado', 0),
(89, 23, 'Una metodología ágil de desarrollo', 1),
(90, 23, 'Una metodología de arquitectura de software', 0),
(91, 23, 'Un patrón de desarrollo', 0),
(92, 23, 'Una metodología de control de programación', 0),
(93, 24, 'Característica de DAS.', 1),
(94, 24, 'Desventaja de DAS.', 0),
(95, 24, 'Principio de DAS', 0),
(96, 24, 'Parte de la filosofía de DAS', 0),
(97, 25, 'Una revisión en grupo, enfocada al cliente.', 1),
(98, 25, 'Un tipo de aprendizaje', 0),
(99, 25, 'Una evaluación de requerimientos', 0),
(100, 25, 'Una motivacion al grupo de desarrollo', 0),
(101, 26, 'Característica de DAS.', 1),
(102, 26, 'Beneficio de DAS', 0),
(103, 26, 'Parte de la filosofía de DAS', 0),
(104, 26, 'Principio de DAS', 0),
(105, 27, 'Son peticiones de cambio documentadas.', 1),
(106, 27, 'Se le comunica a todo el equipo involucrado en el proyecto.', 0),
(107, 27, 'Se le comunica al cliente.', 0),
(108, 27, 'Es la evaluación del producto por parte del cliente.', 0),
(109, 28, 'Característica de DAS.', 1),
(110, 28, 'DAS lo permite en la etapa de especulción.', 0),
(111, 28, 'Parte de la filosofía de DAS', 0),
(112, 28, 'Principio de DAS', 0),
(113, 29, '3 fases', 1),
(114, 29, '5 fases', 0),
(115, 29, '4 fases', 0),
(116, 29, '7 fases', 0),
(117, 30, 'Especulación, Colaboración, Aprendizaje.', 1),
(118, 30, 'Requerimientos, Diseño, Desarrollo, Validación.', 0),
(119, 30, 'Definición, Colaboración, Aprendizaje.', 0),
(120, 30, 'Planeación, Definición, Validación', 0),
(121, 31, 'Especulación ', 1),
(122, 31, 'Requerimientos', 0),
(123, 31, 'Colaboración', 0),
(124, 31, 'Codificación', 0),
(125, 32, 'Colaboración', 1),
(126, 32, 'Especulación', 0),
(127, 32, 'Codificación', 0),
(128, 32, 'Integración', 0),
(129, 33, 'Aprendizaje', 1),
(130, 33, 'Pruebas', 0),
(131, 33, 'Colaboración', 0),
(132, 33, 'Especulación', 0),
(133, 34, 'Especular', 1),
(134, 34, 'Adaptar', 0),
(135, 34, 'Organizar', 0),
(136, 34, 'Priorizar', 0),
(137, 35, 'Fase de especulación', 1),
(138, 35, 'Fase de definición', 0),
(139, 35, 'Fase de colaboración', 0),
(140, 35, 'Fase de organización', 0),
(141, 36, 'Fase de colaboración ', 1),
(142, 36, 'Fase de desarrollo', 0),
(143, 36, 'Fase de definición', 0),
(144, 36, 'Fase de pruebas', 0),
(145, 37, 'No se construyen, evolucionan', 1),
(146, 37, 'Se dividen en pequeñas partes manejables', 0),
(147, 37, 'Se construyen', 0),
(148, 37, 'Se construyen y se dividen', 0),
(149, 38, 'Confianza para realizar críticas ', 1),
(150, 38, 'Compromiso para terminar el proyecto', 0),
(151, 38, 'Un coordinador para cada grupo de trabajo', 0),
(152, 38, 'Interacción con el cliente', 0),
(153, 39, 'Fase de aprendizaje', 1),
(154, 39, 'Fase de pruebas', 0),
(155, 39, 'Fase de colaboración', 0),
(156, 39, 'Todas la fases', 0),
(157, 40, 'Fase de especulación', 1),
(158, 40, 'Fase de colaboración', 0),
(159, 40, 'Fase de planificación', 0),
(160, 40, 'No hay número específico de iteraciones', 0),
(161, 41, 'Es un tipo de aprendizaje', 1),
(162, 41, 'Forma parte de la fase de colaboración', 0),
(163, 41, 'Evaluación final en DAS', 0),
(164, 41, 'Característica de DAS', 0),
(165, 42, '4 tipos', 1),
(166, 42, '5 tipos', 0),
(167, 42, '7 tipos', 0),
(168, 42, '2 tipos', 0),
(169, 43, 'Calidad del producto desde un punto de vista del cliente.', 1),
(170, 43, 'La gestión del rendimiento. ', 0),
(171, 43, 'Calidad del producto desde un punto de vista de los desarrolladores. ', 0),
(172, 43, 'La entrega a tiempo del producto', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_status` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `id_usuario`, `online`) VALUES
(8, 22, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` char(1) NOT NULL DEFAULT 'B',
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `tipo`, `username`, `password`) VALUES
(22, 'B', 'rjrr507@gmail.com', 'go3dlnYJ6v2jM');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `fk_personal_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `fk_modulo_pregunta` FOREIGN KEY (`unidad`) REFERENCES `modulo` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ranking`
--
ALTER TABLE `ranking`
  ADD CONSTRAINT `fk_ranking_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `fk_pregunta_respuesta` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `fk_status` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
