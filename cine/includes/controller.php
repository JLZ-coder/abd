<?php

require_once(__DIR__ . '/DAOs/salaDAO.php');
//require_once(__DIR__ . '/DAOs/asientoDAO.php');
require_once(__DIR__ . '/DAOs/peliculaDAO.php');
require_once(__DIR__ . '/DAOs/registroDAO.php');
require_once(__DIR__ . '/DAOs/sesionesDAO.php');

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
        $this->peliculaDAO = new peliculaDAO();
        $this->registroDAO = new registroDAO();
        $this->sesionDAO = new sesionesDAO();
    }
    
    /* 
     * sala         asientos     pelicula        sesion      registro
     *  id           id_sala      id(auto)        fecha       id
     *  aforo        id           nombre          id_sala     sesion
     *               fecha_sesion descripcion     id_peli     id_sala
     *                                            id_precio   asiento
     *                                                        fecha
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

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    // FUNCIONES SESION
    
    public function selectSesion($col = "", $cond = ""){
        return $this->sesionDAO->select($col, $cond);
    }
    
    public function insertSesion($fecha, $sala, $peli, $precio){
        $col = "fecha,id_sala,id_peli,precio";
        $values = "'".$fecha."'" . "," . $sala . "," . $peli . "," . $precio;
        return $this->sesionDAO->insert($col, $values);
    }
    
    public function updateSesion($fecha, $sala, $peli, $precio){
        $set = "id_peli =".$peli . "," . "precio=" . $precio;
        $cond = "fecha="."'".$fecha."'" . " AND " . "id_sala=" . $sala;
        return $this->sesionDAO->update($set, $cond);
    }
    
    public function deleteSesion($fecha, $sala){
        $cond = "fecha="."'".$fecha."'" . " AND " . "id_sala=" . $sala;
        return $this->sesionDAO->delete($cond);
    }


    // - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    // FUNCIONES REGISTRO
    
    public function selectRegistros()
    {
        return $this->registroDAO->select();
    }


    // - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    // FUNCIONES PELICULA

    public function selectPeliculas()
    {
        return $this->peliculaDAO->select();
    }
    
    public function insertPelicula($nombre, $descripcion)
    {
        return $this->peliculaDAO->insert($nombre, $descripcion);
    }
    
    public function updatePelicula($id, $nombre, $descripcion)
    {
        return $this->peliculaDAO->update($id, $nombre, $descripcion);
    }
    
    public function deletePelicula($id)
    {
        return $this->peliculaDAO->delete($id);
    }
}

