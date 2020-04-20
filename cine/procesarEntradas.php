<?php

require_once 'includes/config.php';

echo '<a href="entradas.php"> ⇐Atras </a>';

if (isset($_POST['vender']) || isset($_POST['cancelar'])) {
    $aux = $ctrl->selectSesion('', "fecha='".$_GET['fecha']."' AND id_sala=".$_GET['sala']." AND fecha > '".date("Y-m-d H:i:s", time())."'");
    if (count($aux) > 0) {
        foreach($_POST['asientos'] as $valor) {
            if (isset($_POST['vender'])) {
                $ctrl->insertAsiento($_GET['fecha'], $_GET['sala'], $valor);
            }
            else {
                $ctrl->deleteAsiento($_GET['fecha'], $_GET['sala'], $valor);
            }
        }
    }
    else {
        $errores[] = "La sesión no esta disponible";
    }
    
    if (!isset($errores)) {
        $vender = 0;
        if (isset($_POST['vender'])) {
            $vender = 1;
        }
        header("Location:entradas.php?vender=".$vender.'&fecha='.$_GET['fecha'].'&sala='.$_GET['sala'].'&peli='.$_GET['peli']);
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