<?php

require_once ('connection.php');

class Usuario extends Connection
{
    // A $db bariable que contiene la conexion a la base de datos
    public function __construct()
    {
        parent::__construct();
    }
    public function nuevo_usuario($nombre1, $apellido1, $sexo1, $cedula1, $celular1, $correo1, $fecha1, $username1, $password1) {
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
        $out = @p;
        $instruccion = "CALL nuevo_usuario(
            '".$nombre."','". $apellido."','".$sexo."',
            '".$cedula."','". $celular."','".$correo."',
            '".$fecha."','".$username."','".$password."', @p)";

        $consulta = $this->db->query($instruccion);
        if(!$consulta){
            echo "Error al realizar consulta <br>". $this->db->error ."<br>";
            echo $instruccion;
            
        }
        $this->db->close();
        return $consulta;
        

        echo "Despues del cierre de consulta";

    }


    public function existe_usuario( $user)
    {
        $user = $this->db->real_escape_string($user);
        $instruccion = "CALL existe_usuario('" . $user . "')";

        $consulta = $this->db->query($instruccion);


        if ($consulta == 0) {
            echo "sin problemas ".$consulta;
            $this->db->close();
            
            return $consulta;
        }
        echo "talvez haya problemas";
        $this->db->close();
    }
    

    public function injection($data)
    {
        return $this->db->real_escape_string($data);
    }

}
