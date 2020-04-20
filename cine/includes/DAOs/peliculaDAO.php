<?php
require_once(__DIR__.'/DAO.php');

class peliculaDAo extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function select()
    {
        $query = "SELECT * from pelicula";
        
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