<?php

require_once 'includes/config.php';

if (isset($_POST['procesar'])) {
    $arr = $ctrl->selectSesion();
    $str = "";
    $keys = array();
    foreach($arr as $pair) {
        $keys[] = date("Y-m-d H:i",strtotime($pair['fecha'])).$pair['id_sala'];
    }
    
    $_POST['peli'] = 1;
    if (
        (!isset($_POST['fecha']) || trim($_POST['fecha']) == '')
        
        ) {
            
            $errores[] = "Campo fecha incorrecto";
        }
    if (
        ($_POST['op'] == "insert" || $_POST['op'] == "update") && (!isset($_POST['precio']) || trim($_POST['precio']) == '')
        ||
        preg_match("/[^0-9.]/", $_POST['precio'])
        ) {
            
            $errores[] = "Campo precio incorrecto";
        }
    
    if (!isset($errores)) {
        $_POST['fecha'] = date("Y-m-d H:i",strtotime($_POST['fecha']));
        if ($_POST['op'] == "insert") {
            if (!in_array ( $_POST['fecha'].$_POST['sala'], $keys )) {
                $_POST['fecha'] = date("Y-m-d H:i",strtotime($_POST['fecha']));
                $ctrl->insertSesion($_POST['fecha'], $_POST['sala'], $_POST['peli'], $_POST['precio']);
            }
            else {
                $errores[] = "Ya existe una sesion con esos parametros";
            }
        }
        else if ($_POST['op'] == "update"){
            
            if (in_array ( $_POST['fecha'].$_POST['sala'], $keys )) {
                $_POST['fecha'] = date("Y-m-d H:i",strtotime($_POST['fecha']));
                $ctrl->updateSesion($_POST['fecha'], $_POST['sala'], $_POST['peli'], $_POST['precio']);
            }
            else {
                $errores[] = "La sesion no existe";
            }
        }
        else {
            if (in_array ( $_POST['fecha'].$_POST['sala'], $keys  )) {
                $ctrl->deleteSesion($_POST['fecha'], $_POST['sala']);
            }
            else {
                $errores[] = "La sesion no existe";
            }
        }
    }
    $str='';
    if (isset($errores)) {
        $str = "?".http_build_query(
            array('errores' => $errores)
            );
    }
    
    header("Location:sesiones.php".$str);
}
?>