<?php

require_once 'connection.php';

class Usuario extends Connection
{
    // A $db bariable que contiene la conexion a la base de datos
    public function __construct()
    {
        parent::__construct();
    }
    public function nuevo_usuario($nombre1, $apellido1, $sexo1, $cedula1, $celular1, $correo1, $fecha1, $username1, $password1)
    {
        //nombre, apellido, sexo, cedula, celular, correo, year,, user, password
        $nombre = $this->db->real_escape_string($nombre1);
        $apellido = $this->db->real_escape_string($apellido1);
        $sexo = $this->db->real_escape_string($sexo1);
        $cedula = $this->db->real_escape_string($cedula1);
        $celular = $this->db->real_escape_string($celular1);
        $correo = $this->db->real_escape_string($correo1);
        $fecha = $this->db->real_escape_string($fecha1);
        $username = $this->db->real_escape_string($username1);
        $password = $this->db->real_escape_string($password1);

        $instruccion = "CALL nuevo_usuario(
            '" . $nombre . "','" . $apellido . "','" . $sexo . "',
            '" . $cedula . "','" . $celular . "','" . $correo . "',
            '" . $fecha . "','" . $username . "','" . $password . "', @p)";

        $consulta = $this->db->query($instruccion);
        if (!$consulta) {
            echo "Error al realizar consulta <br>" . $this->db->error . "<br>";
            echo $instruccion;
            $this->db->close();
            return false;

        }
        $this->db->close();
        return $consulta;

        

    }

    public function existe_usuario($user)
    {
        $user = $this->db->real_escape_string($user);
        $function = "fnValidarUsuario";
        $instruccion = "SELECT " . $function . "('" . $user . "')";

        $consulta = $this->db->query($instruccion);

        if (!$consulta) {
            echo "Error al realizar consulta <br>" . $this->db->error . "<br>";
            echo $instruccion;

        }

        $data = $consulta->fetch_assoc();
        $this->db->close();
        return $data[$function . "('" . $user . "')"];

    }

    public function existe_correo($correo)
    {
        $correo = $this->db->real_escape_string($correo);
        $function = "fnValidarCorreo";
        $instruccion = "SELECT " . $function . "('" . $correo . "') as alias";

        $consulta = $this->db->query($instruccion);

        if (!$consulta) {
            echo "Error al realizar consulta <br>" . $this->db->error . "<br>";
            echo $instruccion;

        }

        $data = $consulta->fetch_assoc();
        $this->db->close();
        return $data["alias"];

    }

    public function existe_cedula($cedula)
    {
        $cedula = $this->db->real_escape_string($cedula);
        $function = "fnValidarCedula";
        $instruccion = "SELECT " . $function . "('" . $cedula . "') as alias";

        $consulta = $this->db->query($instruccion);

        if (!$consulta) {
            echo "Error al realizar consulta <br>" . $this->db->error . "<br>";
            echo $instruccion;

        }

        $data = $consulta->fetch_assoc();
        $this->db->close();
        return $data["alias"];

    }

    
    public function iniciar_sesion($user, $password)
    {
        $user = $this->db->real_escape_string($user);
        $password = $this->db->real_escape_string($password);
        $function = "iniciar_sesion";
        $instruccion = "CALL " . $function . "('" . $user . "', '".$password."')";

        $consulta = $this->db->query($instruccion);

        if (!$consulta) {
            echo "Error al realizar consulta <br>" . $this->db->error . "<br>";
            echo $instruccion;

        }

        $data = $consulta->fetch_all(MYSQLI_ASSOC);
        $this->db->close();
        return $data;

    }


    public function logout($idUser){
        $user = $this->db->real_escape_string($idUser);
        $function = "logout";
        $instruccion = "CALL " . $function . "('" . $idUser . "')";

        $consulta = $this->db->query($instruccion);

        if (!$consulta) {
            echo "Error al realizar consulta <br>" . $this->db->error . "<br>";
            echo $instruccion;
            $this->db->close();
            return false;

        }

        $this->db->close();
        return true;

    }

    public function datos_usuario($correo){
        $user = $this->db->real_escape_string($correo);
        $function = "datos_usuario";
        $instruccion = "CALL " . $function . "('" . $correo . "')";

        $consulta = $this->db->query($instruccion);

        if (!$consulta) {
            echo "Error al realizar consulta <br>" . $this->db->error . "<br>";
            echo $instruccion;

        }

        $data = $consulta->fetch_all(MYSQLI_ASSOC);
        $this->db->close();
        return $data;
    }

    
    public function cargar_ranking(){

        $function = "cargar_ranking";
        $instruccion = "CALL " . $function . "()";

        $consulta = $this->db->query($instruccion);

        if (!$consulta) {
            echo "Error al realizar consulta <br>" . $this->db->error . "<br>";
            echo $instruccion;

        }

        $data = $consulta->fetch_all(MYSQLI_ASSOC);
        $this->db->close();
        return $data;
    }

    public function injection($data)
    {
        return $this->db->real_escape_string($data);
    }

}
