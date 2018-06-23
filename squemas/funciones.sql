use mydb;

drop function if exists fnValidarUsuario;

create function fnValidarUsuario(
  _user varchar(255)
)
returns boolean

begin
  select username into @user from usuario where username = _user
end;