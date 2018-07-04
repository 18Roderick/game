<?php
/** algo que hacer */
require_once 'connection.php';

class Pregunta extends Connection
{
    // A $db bariable que contiene la conexion a la base de datos
    public function __construct()
    {
        parent::__construct();
    }
    public function nueva_pregunta($modulo, $preguntas, $respuestas)
    {
        //nombre, apellido, sexo, cedula, celular, correo, year,, user, password
        $nombre = $this->db->real_escape_string($nombre1);



        $instruccion = "CALL ";

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

    public function cargar_modulos(){
        $instruccion = "CALL cargar_modulos";

        $consulta = $this->db->query($instruccion);

        if (!$consulta) {
            echo "Error al realizar consulta <br>" . $this->db->error . "<br>";
            echo $instruccion;

        }

        $data = $consulta->fetch_all(MYSQLI_ASSOC);
        $this->db->close();
        return $data;
    }

    public function cargar_preguntas($id){
        $instruccion = "CALL cargar_preguntas(".$id.")";
        
        $consulta = $this->db->query($instruccion);

        if (!$consulta) {
            echo "Error al realizar consulta <br>" . $this->db->error . "<br>";
            echo $instruccion;

        }

        $data = $consulta->fetch_all(MYSQLI_ASSOC);
        $this->db->close();
        return $data;
    }

    public function cargar_respuestas($id){
        $instruccion = "CALL cargar_respuestas(".$id.")";
        
        $consulta = $this->db->query($instruccion);

        if (!$consulta) {
            echo "Error al realizar consulta <br>" . $this->db->error . "<br>";
            echo $instruccion;

        }

        $data = $consulta->fetch_all(MYSQLI_ASSOC);
        $this->db->close();
        return $data;
    }

    public function respuestas(){
        $instruccion = "CALL respuestas()";
        
        $consulta = $this->db->query($instruccion);

        if (!$consulta) {
            echo "Error al realizar consulta <br>" . $this->db->error . "<br>";
            echo $instruccion;

        }

        $data = $consulta->fetch_all(MYSQLI_ASSOC);
        $this->db->close();
        return $data;
    }

    

}


?>