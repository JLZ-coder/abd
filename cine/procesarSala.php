<?php

require_once 'includes/config.php';

echo '<a href="index.php"> ⇐Atras </a>';

if (isset($_POST['procesar'])) {
    $arr = $ctrl->selectSala();
    $str = "";
    $keys = array();
    foreach($arr as $pair) {
        $keys[] = $pair['id'];
    }
    if (
        (!isset($_POST['id']) || trim($_POST['id']) == '')
        ||
        !ctype_digit($_POST['id'])
        ) {
            
            $errores[] = "Campo id incorrecto";
        }
    if (
        ($_POST['op'] == "insert" || $_POST['op'] == "update") && (!isset($_POST['aforo']) || trim($_POST['aforo']) == '')
        ||
        !ctype_digit($_POST['id'])
        ) {
            
            $errores[] = "Campo aforo incorrecto";
        }
            
    if (!isset($errores)) {
        if ($_POST['op'] == "insert") {
            if (!in_array ( $_POST['id'], $keys )) {
                $ctrl->insertSala($_POST['id'], $_POST['aforo']);
            }
            else {
                $errores[] = "Ya existe una sala con ese nombre";
            }
        }
        else if ($_POST['op'] == "update"){
            if (in_array ( $_POST['id'], $keys )) {
                $ctrl->updateSala($_POST['id'], $_POST['aforo']);
            }
            else {
                $errores[] = "El nombre de sala no existe";
            }
        }
        else {
            if (in_array ( $_POST['id'], $keys )) {
                $ctrl->deleteSala($_POST['id']);
            }
            else {
                $errores[] = "El nombre de sala no existe";
            }
        }
    }
    
    if (!isset($errores)) {
        header("Location:salas.php".$str);
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