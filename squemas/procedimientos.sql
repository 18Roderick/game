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

    SELECT * FROM usuario as us, personal as p WHERE 
    us.username = _user OR p.cedula = _user OR p.correo = _user;

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

end;

/*cargar ranking */
use mydb;

drop PROCEDURE if exists cargar_ranking;

CREATE PROCEDURE cargar_ranking()
begin
  SELECT DISTINCT(u.username), r.puntaje  FROM `ranking` as r, `usuario` as u ORDER BY r.puntaje ASC;
end;






