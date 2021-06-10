use mydb;

drop function if exists fnValidarUsuario;

DELIMITER //
CREATE FUNCTION fnValidarUsuario( _user varchar(255) ) returns boolean
 
begin
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
end; 

DELIMITER //







/*  funcion que valida si el correo ya esta en uso*/


drop function if exists fnValidarCorreo;

DELIMITER //
create function fnValidarCorreo( _correo varchar(255) ) returns boolean

begin
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
end;

DELIMITER //



/*Validar si existe la cedula*/
drop function if exists fnValidarCedula;

DELIMITER //
create function fnValidarCedula( _cedula varchar(255) ) returns boolean

begin
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
end;

DELIMITER // 
/*Validar  iniciar sesion

*/



drop function if exists fnIniciarSesion;

DELIMITER //
create function fnIniciarSesion( _user varchar(255), _password varchar(255) ) returns boolean

begin
  declare _existe boolean default false;
  declare cantidad int default 0;

  set cantidad = (
    SELECT  COUNT(DISTINCT(us.username)) 
    FROM `usuario` AS us, `personal` as p WHERE us.password = _password 
    AND (us.username = _user OR p.cedula = _user OR p.correo = _user)

    ); 
  
  return cantidad;
end;
DELIMITER //

SELECT fnIniciarSesion('8-910-498', 'rj3wmlDjxFM02');



