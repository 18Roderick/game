USE mydb;
CREATE PROCEDURE `nuevo_usuario`(
  IN _nombre varchar(255),
  IN _apellido varchar(255),
  IN _username varchar(255),
  IN _sexo CHAR(1),
  IN _fecha DATE
  IN _correo varchar(255),
  IN _celular varchar(255),
  IN _password varchar(255),   
  
)
BEGIN
 INSERT INTO usuario (`nombre`, `apellido`, `username`, `correo`, `clave`)
values(_nombre, _apellido, _username, _correo, _password);
END;

