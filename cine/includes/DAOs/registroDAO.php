<?php 
require_once(__DIR__.'/DAO.php');

class registroDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function select()
    {
        $query = 
        "SELECT r.id as id_registro, r.sesion, r.id_sala, r.asiento, r.fecha as fecha_registro, s.id_peli, s.precio
         FROM registro r 
         JOIN sesion s ON r.sesion = s.fecha";
        
        return $this->consultar($query);
    }
    
    //public function insert(...)
    
    
}
?>