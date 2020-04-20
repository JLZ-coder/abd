<?php
    require_once 'includes/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv=Content-Type content=text/html charset=UTF-8 />
	<title>Cines Coronado</title>
	<style>
	table { border: 1px solid black;
	        border-collapse: collapse;
	        width: 500px; }
    td { border: 1px solid black; }
	</style>
</head>

<body>
	<h1 align="center">Cines Coronado</h1>
	<a href="peliculas.php"> ⇐Atras </a>
	<h2>Películas</h2>

<?php    
    $datos = $ctrl->selectPeliculas();
    foreach ($datos as $value)
    {
        $id[] = $value['id'];
        $nombre[] = $value['nombre'];
    }
    
    $errores = array();
    
    if (isset($_POST['enviar']))
    {
        if ($_POST['op'] == 'insert')
        {
            if(trim($_POST['id']) != '')
            {
                $errores[] = "No introduzca un nuevo id";
            }
            
            if (trim($_POST['nombre']) == '' || trim($_POST['descripcion']) == '')
            {
                $errores[] = "Rellene los campos nombre y descripcion";
            }
            
            if (in_array($_POST['nombre'], $nombre))
            {
                
            }
            
            if(count($errores) === 0)
            {
                $ctrl->insertPelicula($_POST['nombre'], $_POST['descripcion']);
            }
        }
        
        elseif($_POST['op'] == 'update')
        {
            if(trim($_POST['id']) == '' || trim($_POST['nombre']) == '' || trim($_POST['descripcion']) == '')
            {
                $errores[] = "Rellene todos los campos";
            }
            
            elseif(!in_array($_POST['id'], $id))
            {
                $errores[] = "Escoge un id existente";
            }
            
            if(count($errores) === 0)
            {
                $ctrl->updatePelicula($_POST['id'] ,$_POST['nombre'], $_POST['descripcion']);
            }
        }
        
        elseif($_POST['op'] == 'delete')
        {
            if (trim($_POST['id']) == '' || trim($_POST['nombre']) != '' || trim($_POST['descripcion']) != '')
            {
                $errores[] = "Rellene solo el campo id";
            }
            
            elseif(!in_array($_POST['id'], $id))
            {
                $errores[] = "Escoge un id existente";
            }
            
            if(count($errores) === 0)
            {
                $ctrl->deletePelicula($_POST['id']);
            }
        }
        
        if (isset($errores) && count($errores) > 0)
        {
            echo '<ul>';
            foreach($errores as $error)
            {
                echo '<li>'.$error.'</li>';
            }
            echo '</ul>';
        }
        else
        {
            header('Location: peliculas.php');
        }
        
        unset($_POST['enviar']);
        unset($errores);
    }
    
?>

</body>
</html>
