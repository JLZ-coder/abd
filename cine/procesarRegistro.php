<?php

require_once 'includes/config.php';

echo '<a href="registros.php"> ⇐Atras </a>';

if (isset($_POST['procesar'])) {
    if (
        (!isset($_POST['fecha']) || trim($_POST['fecha']) == '')
        
        ) {
            
            $errores[] = "Campo fecha incorrecto";
        }
          
    if (!isset($errores)) {
        
        $ctrl->deleteAsientoBefore($_POST['fecha']);
        $ctrl->deleteSesionBefore($_POST['fecha']);
        $ctrl->deleteRegistroBefore($_POST['fecha']);
        header("Location:registros.php");
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