<?php

require_once 'includes/config.php';

echo '<a href="sesiones.php"> ⇐Atras </a>';

if (isset($_POST['procesar'])) {
    $arr = $ctrl->selectSesion();
    $str = "";
    $keys = array();
    foreach($arr as $pair) {
        $keys[] = date("Y-m-d H:i",strtotime($pair['fecha'])).$pair['id_sala'];
    }

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
                $arr_asientos = $ctrl->selectAsiento('', "fecha_sesion='".$_POST['fecha']."' AND id_sala=".$_POST['sala']);
                foreach ($arr_asientos as $valor) {
                    $ctrl->deleteAsiento($valor['fecha_sesion'], $valor['id']);
                }
                $ctrl->deleteSesion($_POST['fecha'], $_POST['sala']);
            }
            else {
                $errores[] = "La sesion no existe";
            }
        }
    }
    if (!isset($errores)) {
        header("Location:sesiones.php".$str);
    }
    else {
        echo '<h2>Problemas en el formulario</h2>';
        if (isset($errores) && count($errores) > 0) {
            echo '<ul>';
            foreach($errores as $error) {
                echo '<li>'.$error.'</li>';
            }
            echo '</ul>';
        }
    }
}
?>