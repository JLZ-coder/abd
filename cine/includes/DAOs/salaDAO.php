<?php

require_once(__DIR__.'/DAO.php');

class salaDAO extends DAO
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
            $query = "SELECT ".$col." FROM sala";
        }
        else {
            $query = "SELECT ".$col." FROM sala WHERE ".$cond;
        }
        
        return $this->consultar($query);
    }
    
    public function insert($col, $values){
        $query = "";
        $query = "INSERT INTO sala(".$col.") VALUES (".$values.")";
        
        return $this->consultar($query);
    }
    
    public function update($set, $cond){
        $query = "";
        if ($cond != "") {
            $query = "UPDATE sala SET ".$set." WHERE ".$cond;
        }
        
        return $this->consultar($query);
    }
    
    public function delete($cond){
        $query = "";
        if ($cond != "") {
            $query = "DELETE FROM sala WHERE ".$cond;
        }
        
        return $this->consultar($query);
    }
}
?>
