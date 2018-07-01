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

/* use mydb;
drop PROCEDURE IF exists nueva_pregunta;

CREATE PROCEDURE nueva_pregunta(

)
BEGIN

END;
 */


use mydb;
drop PROCEDURE IF EXISTS datos_usuario;
CREATE PROCEDURE `datos_usuario`(
  IN _user VARCHAR(255),
  IN _password varchar(255)
)
BEGIN

    SELECT * FROM usuario as us, personal as p WHERE us.password = _password 
    AND (us.username = _user OR p.cedula = _user OR p.correo = _user);

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

    SELECT * FROM preguntas where unidad = _id ;

END;

use mydb;
drop PROCEDURE IF EXISTS cargar_respuestas;
CREATE PROCEDURE `cargar_respuestas`(
  _id int
)
BEGIN

    SELECT * FROM respuestas where pregunta_id = _id ;

END;