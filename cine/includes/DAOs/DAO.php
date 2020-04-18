<?php

class DAO {
    
    private $mysqli = null;
    
    public function __construct(){
        if(!$this->mysqli){
            //Crear conexion base de datos
            $this->mysqli = new mysqli("localhost", "root", "", "cine_php");
            if ( $this->mysqli->connect_errno) {
                echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error ;
            }
            if(!$this->mysqli->set_charset("utf8")) {
                printf("<hr>Error loading character set utf8 (Err. nº %d): %s\n<hr/>",  $this->mysqli->errno, $this->mysqli->error);
                exit();
            }
        }
    }
    
    protected function consultar($sql){
        if ($sql != "") {
            $consulta = $this->mysqli->query($sql) or die ($this->mysqli->error. " en la línea ".(__LINE__-1));
            $tablaDatos = array();
            if (substr($sql, 0, 6) == "SELECT") {
                if ($consulta) {
                    while ($fila = mysqli_fetch_assoc($consulta)){
                        array_push($tablaDatos, $fila);
                    }
                }
            }
            return $tablaDatos; 
        }
        else {
            return 0;
        }
    }
}

?>