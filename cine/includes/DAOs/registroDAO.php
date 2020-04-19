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
        $query = "SELECT * from registro";
        
        return $this->consultar($query);
    }
    
    //public function insert(...)
    
    
}
?>