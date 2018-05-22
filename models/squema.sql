DROP DATABASE game; 
CREATE DATABASE IF NOT EXISTS game CHARACTER SET utf8 COLLATE utf8_general_ci;
USE game;

CREATE TABLE IF NOT EXISTS usuario
(
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(255),
  apellido varchar(255),
  sexo char (1),
  fecha DATE,
  username varchar(255) NOT NULL,
  correo varchar(255) NOT NULL,
  clave varchar(255) NOT NULL

);

TRUNCATE TABLE usuario;


/* procedimientos almacenados */

CREATE PROCEDURE `nuevo_usuario`(
  IN _nombre varchar(255),
  IN _apellido varchar(255),
  IN _sexo char(1),
  IN _fecha date,
  IN _username varchar(255),
  IN _correo varchar(255),
  IN _password varchar(255)
)
BEGIN
 INSERT INTO usuario (`nombre`, `apellido`, `sexo`,`fecha`, `username`, `correo`, `clave`)
values(_nombre, _apellido, _sexo, _fecha, _username, _correo, _password);
END;

CALL nuevo_usuario('Roderick', 'Romero','m','1996-09-21', 'rkey507', 'rjrr507@gmail.com', '1234');


