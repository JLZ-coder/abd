<?php 
	require_once 'includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Cines Coronado</title>
</head>

<body>

	<h1 align="center">Cines Coronado</h1>
	
	<a href="index.php"> ⇐Atras </a>
	
	<h2>Sesiones</h2>

	<?php 
	$arr = $ctrl->selectSesion();
	$str = "";
	$keys = array();
	foreach($arr as $pair) {
	    $keys[] = date("Y-m-d H:i",strtotime($pair['fecha'])).$pair['id_sala'];
	}
	
	$_POST['peli'] = 1;
	
    if (isset($_POST['procesar'])) {
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
    }
    
    echo '<ul>';
    $arr = $ctrl->selectSesion();
    foreach($arr as $pair) {
        $str = "Sesion: ".$pair['fecha']."-->Sala: ".$pair['id_sala']." -->Peli: ".$pair['id_peli']." -->Precio: ".$pair['precio'];
        echo '<li>'.$str.'</li>';
    }
    echo '</ul>'; 
    
    unset($_POST['submit']);
	
    if (isset($errores) && count($errores) > 0) {
        echo '<ul>';
        foreach($errores as $error) {
            echo '<li>'.$error.'</li>';
        }
        echo '</ul>';
    }
    
    unset($errores);

    ?>
	
	<form action="sesiones.php" method="post">
		<fieldset>
		<legend>Modificación de sesiones</legend>
            Fecha:<br> 
            <input type="datetime-local" name="fecha" value=<?php echo substr(date("c", time()), 0, 16);?>
            min=<?php echo substr(date("c", time()), 0, 16);?>><br>
            Sala:<br> 
            <select name="sala">
            	<?php 
            	    $arr_sala = $ctrl->selectSala();
                	foreach($arr_sala as $pair) {
                	    $str = "value=".$pair['id'].">".$pair['id'];
                	    echo '<option '.$str.'</option>';
                	}
            	?>
            </select> <br>
            Pelicula:<br> 
            <select name="peli">
            	<?php 
            	    $arr_peli = $ctrl->selectSala();
                	foreach($arr_peli as $pair) {
                	    $str = "value=".$pair['id'].">".$pair['id']."-".$pair['nombre'];
                	    echo '<option '.$str.'</option>';
                	}
            	?>
            </select> <br>
            Precio:<br> 
            <input type="text" name="precio"><br>
            Opciones: <br>
            <input type="radio" name="op" value="insert" checked="checked">Crear sesion<br>
      		<input type="radio" name="op" value="update">Editar sesion<br>
      		<input type="radio" name="op" value="delete">Borrar sesion<br>
  		</fieldset>
  		
        <input type="submit" name="procesar" value="Procesar">
    </form>

</body>
</html>