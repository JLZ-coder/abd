<?php

require_once(__DIR__ . '/DAOs/salaDAO.php');
//require_once(__DIR__ . '/DAOs/asientoDAO.php');
//require_once(__DIR__ . '/DAOs/peliculaDAO.php');
require_once(__DIR__ . '/DAOs/registroDAO.php');
//require_once(__DIR__ . '/DAOs/sesionDAO.php');

class controller{

    private $salaDAO;
    private $asientoDAO;
    private $peliculaDAO;
    private $registroDAO;
    private $sesionDAO;
   
    private static $instance = null;

    public function __construct(){
        $this->salaDAO = new salaDAO();
        //$this->asientoDAO = new asientoDAO();
        //$this->peliculaDAO = new peliculaDAO();
        $this->registroDAO = new registroDAO();
        //$this->sesionDAO = new sesionDAO();
    }
    
    /* 
     * sala         asientos    pelicula        sesion      registro
     *  id(auto)     id_sala     id(auto)        fecha       id
     *  aforo        id          nombre          id_sala     sesion
     *  nombre                   descripcion     id_peli     id_sala
     *                                           id_precio   asiento
     *                                                       fecha
     * */

     public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    // FUNCIONES SALA
    
    public function selectSala($col = "", $cond = ""){
        return $this->salaDAO->select($col, $cond);
    }
    
    public function insertSala($nombre, $aforo){
        $col = "aforo,id";
        $values = $aforo . "," . $nombre;
        return $this->salaDAO->insert($col, $values);
    }
    
    public function updateSala($id, $aforo){
        $set = "aforo =".$aforo;
        $cond = "id =".$id;
        return $this->salaDAO->update($set, $cond);
    }
    
    public function deleteSala($id){
        $cond = "id =".$id;
        return $this->salaDAO->delete($cond);
    }
    
    // FIN FUNCIONES SALA
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    // FUNCIONES REGISTRO
    
    public function selectRegistro()
    {
        return $this->registroDAO->select();
    }
    
    
    
    
    // FIN FUNCIONES REGISTRO
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - -
}

