<?php

require_once(__DIR__ . '/DAOs/salaDAO.php');
require_once(__DIR__ . '/DAOs/asientoDAO.php');
require_once(__DIR__ . '/DAOs/peliculaDAO.php');
require_once(__DIR__ . '/DAOs/sesionesDAO.php');

class controller{

    private $salaDAO;
    private $asientoDAO;
    private $peliculaDAO;
    private $sesionDAO;
   
    private static $instance = null;

    public function __construct(){
        $this->salaDAO = new salaDAO();
        $this->asientoDAO = new asientoDAO();
        $this->peliculaDAO = new peliculaDAO();
        $this->sesionDAO = new sesionesDAO();
    }

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
    
    public function ventaSesion($fecha, $sala){
        $set = "total_venta=total_venta + 1";
        $cond = "fecha="."'".$fecha."'" . " AND " . "id_sala=" . $sala;
        return $this->sesionDAO->update($set, $cond);
    }
    
    public function cancelaSesion($fecha, $sala){
        $set = "cancelado=cancelado + 1";
        $cond = "fecha="."'".$fecha."'" . " AND " . "id_sala=" . $sala;
        return $this->sesionDAO->update($set, $cond);
    }
    
    public function deleteSesion($fecha, $sala){
        $cond = "fecha="."'".$fecha."'" . " AND " . "id_sala=" . $sala;
        return $this->sesionDAO->delete($cond);
    }
    
    public function deleteSesionBefore($fecha){
        $cond = "fecha<"."'". $fecha . "'";
        return $this->sesionDAO->delete($cond);
    }
    
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    // FUNCIONES ASIENTO
    
    public function selectAsiento($col = "", $cond = ""){
        return $this->asientoDAO->select($col, $cond);
    }
    
    public function insertAsiento($fecha, $asiento){
        $col = "id, fecha_sesion";
        $values = $asiento . "," . "'". $fecha . "'";
        return $this->asientoDAO->insert($col, $values);
    }
    
    public function updateAsiento($fecha, $asiento_ant, $asiento_post){
        $set = "id =".$asiento_post . ", fecha_sesion=" . "'". $fecha . "'";
        $cond = "id="."'".$asiento_ant."'" . " AND " . "fecha=" . "'". $fecha . "'";
        return $this->asientoDAO->update($set, $cond);
    }
    
    public function deleteAsiento($fecha, $asiento){
        $cond = "id=".$asiento. " AND " . "fecha_sesion=" . "'". $fecha . "'";
        return $this->asientoDAO->delete($cond);
    }
    
    public function deleteAsientos($fecha, $sala){
        $cond = "id_sala=" . $sala . " AND " . "fecha_sesion=" . "'". $fecha . "'";
        return $this->asientoDAO->delete($cond);
    }
    
    public function deleteAsientoBefore($fecha){
        $cond = "fecha_sesion<"."'". $fecha . "'";
        return $this->asientoDAO->delete($cond);
    }


    // - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    // FUNCIONES PELICULA

    public function selectPeliculas($col = "", $cond = ""){
        return $this->peliculaDAO->select($col, $cond);
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

