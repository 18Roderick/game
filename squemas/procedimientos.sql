USE mydb;
drop PROCEDURE if exists nuevo_usuario;
CREATE PROCEDURE `nuevo_usuario`(
  IN _nombre varchar(255),
  IN _apellido varchar(255),
  IN _sexo CHAR(1),
  IN _cedula varchar(255),
  IN _celular varchar(255),
  IN _correo varchar(255),
  IN _fecha DATE,
  IN _username varchar(255),
  IN _password varchar(255),
  OUT _creado BOOLEAN   
)
BEGIN

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


END;

/* validar que el correo ingresado sea unico*/
use mydb;
drop PROCEDURE IF EXISTS existe_correo;
CREATE PROCEDURE `existe_correo`(
  IN _correo VARCHAR(255),
  OUT _existe INT
)
BEGIN
  SET _existe = (
    SELECT count(`correo`) FROM personal WHERE `correo` = _correo
  );
END;


/* validar que el nombre de usuario ingresado sea unico*/
use mydb;
drop PROCEDURE IF EXISTS existe_usuario;
CREATE PROCEDURE `existe_usuario`(
  IN _username VARCHAR(255),
  OUT _existe INT
)
BEGIN
  SET _existe = 0;
  SET _existe = (
    SELECT count(`username`) FROM `usuario` WHERE `username` = _username
  );

END;



use mydb;
drop PROCEDURE IF EXISTS datos_usuario;
CREATE PROCEDURE `datos_usuario`(
  IN _user VARCHAR(255)
)
BEGIN
    SELECT u.id as `usuario_id` ,p.nombre, p.apellido, p.celular, p.correo, u.username, r.puntaje
    from personal as p
    inner join usuario as u on p.usuario_id = u.id
    inner join ranking as r on p.usuario_id = r.id_usuario  WHERE 
    u.username = _user OR p.cedula = _user OR p.correo = _user;

END;


use mydb;
drop PROCEDURE IF EXISTS cargar_modulos;
CREATE PROCEDURE `cargar_modulos`()
BEGIN

    SELECT * FROM modulo;

END;

use mydb;
drop PROCEDURE IF EXISTS cargar_preguntas;
CREATE PROCEDURE `cargar_preguntas`(
  _id int
)
BEGIN

    SELECT * FROM preguntas where unidad = _id ORDER BY RAND();

END;

use mydb;
drop PROCEDURE IF EXISTS cargar_respuestas;
CREATE PROCEDURE `cargar_respuestas`(
  _id int
)
BEGIN

    SELECT * FROM respuestas where pregunta_id = _id ORDER BY RAND();

END;


use mydb;
drop PROCEDURE IF EXISTS iniciar_sesion;
CREATE PROCEDURE  iniciar_sesion( _user varchar(255), _password varchar(255) ) 

begin
    SELECT  us.username
    FROM `usuario` AS us, `personal` as p WHERE us.password = _password 
    AND (us.username = _user OR p.cedula = _user OR p.correo = _user);
end;


/*  creacion de modulo*/
use mydb;
drop PROCEDURE IF EXISTS crear_modulo;
CREATE PROCEDURE  crear_modulo( _titulo text, _descripcion text ) 

begin
   INSERT INTO `modulo`(`titulo`, `descripcion`) VALUES (_titulo, _descripcion); 
end;

/* update modulo de modulo*/
use mydb;
drop PROCEDURE IF EXISTS actualizar_modulo;
CREATE PROCEDURE  actualizar_modulo(_id int, _titulo text, _descripcion text ) 

begin
   UPDATE `modulo` SET `titulo` = _titulo , `descripcion` = _descripcion WHERE `id` = _id; 
end;

/* borrar modulo */
use mydb;
drop PROCEDURE IF EXISTS borrar_modulo;
CREATE PROCEDURE  borrar_modulo(_id int) 

begin
   DELETE FROM `modulo` WHERE `id` = _id; 
end;



/*  */

use mydb;
drop PROCEDURE IF EXISTS consultar_repuesta;
CREATE PROCEDURE  consultar_repuesta(_id int) 

begin
  SELECT * FROM `respuestas` WHERE `id` = _id; 
end;


use mydb;
drop PROCEDURE IF EXISTS respuestas;
CREATE PROCEDURE  respuestas() 

begin
  SELECT `opcion`, `correcta`, `pregunta_id`, `id` FROM `respuestas` ;
end;


use mydb;

drop PROCEDURE if exists actualizar_puntaje;

CREATE PROCEDURE actualizar_puntaje(
  _user VARCHAR(255),
  _puntaje int
  
  )
begin
  DECLARE _puntajeActual int;
  
  DECLARE _id int;
  SET _id = (
    SELECT `id` from `usuario` where `username` = _user
  );

  SET _puntajeActual = _puntaje + (
    SELECT `puntaje` from `ranking` where `id_usuario` = _id
  );

  UPDATE `ranking` SET `puntaje` = _puntajeActual where `id_usuario` = _id;

end;


use mydb; 
drop PROCEDURE if exists consultar_puntaje;

CREATE PROCEDURE consultar_puntaje(_user VARCHAR(255))
begin
  DECLARE _id int;
  SET _id = (
    SELECT `id` from `usuario` where `username` = _user
  );

  SELECT `puntaje` from `ranking` where `id_usuario` = _id;


end;


/* consultar progreso*/
use mydb; 
drop PROCEDURE if exists consultar_progreso;

CREATE PROCEDURE consultar_progreso(_user VARCHAR(255))
begin
  DECLARE _id int;
  SET _id = (
    SELECT `id` from `usuario` where `username` = _user
  );

  SELECT * from `completo` where `id_usuario` = _id;


end;

/* actualizar la tabla progreso*/

use mydb;

drop PROCEDURE if exists actualizar_progreso;

CREATE PROCEDURE actualizar_progreso(
  _user VARCHAR(255),
  _idPregunta int
  
  )
begin
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
  

end;



/*cargar ranking */
use mydb;

drop PROCEDURE if exists cargar_ranking;

CREATE PROCEDURE cargar_ranking()
begin
  SELECT usuario.username, ranking.puntaje from usuario 
  INNER JOIN ranking ON usuario.id = ranking.id_usuario ORDER BY ranking.puntaje DESC limit 20;
end;


/* log out de usuario*/
use mydb;

drop PROCEDURE if exists logout;

CREATE PROCEDURE logout(_idUser varchar(255))
BEGIN
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

END;



/* log out de usuario*/
use mydb;

drop PROCEDURE if exists porcentaje;

CREATE PROCEDURE porcentaje(_user varchar(255), _idModulo int)
BEGIN
  DECLARE _totalPreguntas int ;

  set _totalPreguntas = (
    SELECT COUNT(`preguntas`) from preguntas where `unidad` = _idModulo
  );
  
END;


