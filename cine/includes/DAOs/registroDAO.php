<?php 
require_once(__DIR__.'/DAO.php');

class registroDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function selectAll()
    {
        $query = 
        "SELECT r.id as id_registro, r.sesion, r.id_sala, r.asiento, r.fecha as fecha_registro, s.id_peli, s.precio
         FROM registro r 
         JOIN sesion s ON r.sesion = s.fecha";
        
        return $this->consultar($query);
    }
    
    public function select($col, $cond){
        $query = "";
        if ($col == "") {
            $col = "*";
        }
        if ($cond == "") {
            $query = "SELECT ".$col." FROM sesion";
        }
        else {
            $query = "SELECT ".$col." FROM sesion WHERE ".$cond;
        }
        
        return $this->consultar($query);
    }
    
    public function insert($col, $values){
        $query = "";
        $query = "INSERT INTO registro(".$col.") VALUES (".$values.")";
        
        return $this->consultar($query);
    }
    
    public function delete($cond){
        $query = "";
        if ($cond != "") {
            $query = "DELETE FROM registro WHERE ".$cond;
        }
        
        return $this->consultar($query);
    }
    
    //public function insert(...)
    
    
}
?>