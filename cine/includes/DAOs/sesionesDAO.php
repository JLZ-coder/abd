<?php

require_once(__DIR__.'/DAO.php');

class sesionesDAO extends DAO
{   
	public function __construct(){
        parent::__construct();
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
        $query = "INSERT INTO sesion(".$col.") VALUES (".$values.")";
        
        return $this->consultar($query);
    }
    
    public function update($set, $cond){
        $query = "";
        if ($cond != "") {
            $query = "UPDATE sesion SET ".$set." WHERE ".$cond;
        }
        
        return $this->consultar($query);
    }
    
    public function delete($cond){
        $query = "";
        if ($cond != "") {
            $query = "DELETE FROM sesion WHERE ".$cond;
        }
        
        return $this->consultar($query);
    }
}
?>
