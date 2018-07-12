<?php
/** algo que hacer */
require_once 'connection.php';

class Game extends Connection
{
    // A $db bariable que contiene la conexion a la base de datos
    public function __construct()
    {
        parent::__construct();
    }


    public function actualizar_puntaje($id, $puntaje){
        $instruccion = "CALL actualizar_puntaje('".$id."', '". $puntaje ."')";
        
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

    public function actualizar_progreso($user, $idPregunta){
        $instruccion = "CALL actualizar_progreso('".$user."', '". $idPregunta ."')";
        
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


    

}


?>