<?php
require_once(__DIR__.'/DAO.php');

class peliculaDAo extends DAO
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
            $query = "SELECT ".$col." FROM pelicula";
        }
        else {
            $query = "SELECT ".$col." FROM pelicula WHERE ".$cond;
        }
        
        return $this->consultar($query);
    }
    
    public function insert($nombre, $descripcion)
    {
        $query = "INSERT into pelicula(nombre, descripcion) values('".$nombre."','".$descripcion."')";
        
        return $this->consultar($query);
    }
    
    public function update($id, $nombre, $descripcion)
    {
        $query = "UPDATE pelicula set nombre ='".$nombre."', descripcion ='".$descripcion."' where id ='".$id."'";
        
        return $this->consultar($query);
    }
    
    public function delete($id)
    {
        $query = "DELETE from pelicula where id ='".$id."'";
        
        return $this->consultar($query);
    }

}
?>