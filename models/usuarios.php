<?php

require 'connection.php';

class Usuarios extends Connection
{
    // A $db bariable que contiene la conexion a la base de datos
    public function __construct()
    {
        parent::__construct();
    }
    public function nuevo_usuario($nombre, $apellido, $username, $correo, $password)
    {
        $nombre = mysql_real_escape_string($nombre);
        $apellido = mysql_real_escape_string($apellido);
        $username = mysql_real_escape_string($username);
        $correo = mysql_real_escape_string($correo);
        $password = mysql_real_escape_string($password);

        $instruccion = "CALL nuevo_usuario('" . $nombre . "','" . $apellido . "','" . $username . "','" . $correo . "','" . $password . "')";

        $consulta = $this->db->query($instruccion);
        $this->db->close();

    }

    public function existe_usuario($correo, $cedula, $user)
    {

        $instruccion = "CALL existe_usuario('" . $correo . "')";

        $consulta = $this->db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

        if ($resultado) {
            return $resultado;
        }

        $this->db->close();
    }

}
