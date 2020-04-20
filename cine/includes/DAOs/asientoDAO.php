<?php 
require_once(__DIR__.'/DAO.php');

class asientoDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function select($col, $cond){
        $query = "";
        if ($col == "") {
            $col = "*";
        }
        if ($cond == "") {
            $query = "SELECT ".$col." FROM asientos";
        }
        else {
            $query = "SELECT ".$col." FROM asientos WHERE ".$cond;
        }
        
        return $this->consultar($query);
    }
    
    public function insert($col, $values){
        $query = "";
        $query = "INSERT INTO asientos(".$col.") VALUES (".$values.")";
        
        return $this->consultar($query);
    }
    
    public function update($set, $cond){
        $query = "";
        if ($cond != "") {
            $query = "UPDATE asientos SET ".$set." WHERE ".$cond;
        }
        
        return $this->consultar($query);
    }
    
    public function delete($cond){
        $query = "";
        if ($cond != "") {
            $query = "DELETE FROM asientos WHERE ".$cond;
        }
        
        return $this->consultar($query);
    }
}
?>