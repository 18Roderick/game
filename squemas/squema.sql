DROP DATABASE game; 
CREATE DATABASE IF NOT EXISTS game CHARACTER SET utf8 COLLATE utf8_general_ci;
USE game;

CREATE TABLE IF NOT EXISTS usuario
(
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(255),
  apellido varchar(255),
  username varchar(255) NOT NULL,
  correo varchar(255) NOT NULL,
  clave varchar(255) NOT NULL

);

TRUNCATE TABLE usuario;


/* procedimientos almacenados */

CREATE PROCEDURE `nuevo_usuario`(
  IN _nombre varchar(255),
  IN _apellido varchar(255),
  IN _username varchar(255),
  IN _correo varchar(255),
  IN _password varchar(255)
)
BEGIN
 INSERT INTO usuario (`nombre`, `apellido`, `username`, `correo`, `clave`)
values(_nombre, _apellido, _username, _correo, _password);
END;

CALL nuevo_usuario('Roderick', 'Romero', 'rkey507', 'rjrr507@gmail.com', '1234');


