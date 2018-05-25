<?php

require 'connection.php';

class Usuarios extends Connection
{
    // A $db bariable que contiene la conexion a la base de datos
    public function __construct()
    {
        parent::__construct();
    }
    public function nuevo_usuario($nombre, $apellido, $sexo, $fecha, $username, $correo, $password)
    {

        $instruccion = "CALL nuevo_usuario('" . $nombre . "','" . $apellido . "','" . $sexo . "','" . $fecha . "'
											,'" . $username . "','" . $correo . "','" . $password . "')";

        $consulta = $this->db->query($instruccion);
        $this->db->close();

    }

    public function existe_usuario($correo)
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
