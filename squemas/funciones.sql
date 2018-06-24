use mydb;

drop function if exists fnValidarUsuario;

create function fnValidarUsuario( _user varchar(255) ) returns boolean

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

select fnValidarUsuario('rjrr507');

/*  funcion que valida si el correo ya esta en uso*/


drop function if exists fnValidarCorreo;

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


select fnValidarCorreo('rjrr507@gmail.com');