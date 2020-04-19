<?php 
	require_once 'includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Cines "nombre original"</title>
</head>

<body>

	<h1 align="center">Cines "Nombre original"</h1>
	
	<a href="index.php"> â‡�Atras </a>
	
	<h2>Salas</h2>

	<?php 
	$arr = $ctrl->selectSala();
	$str = "";
	$keys = array();
	foreach($arr as $pair) {
	    $keys[] = $pair['id'];
	}
	
    if (isset($_POST['procesar'])) {
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
    }
    
    echo '<ul>';
    $arr = $ctrl->selectSala();
    foreach($arr as $pair) {
        $str = "Sala: ".$pair['id']."-->Aforo: ".$pair['aforo'];
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
	
	<form action="salas.php" method="post">
		<fieldset>
		<legend>ModificaciÃ³n de salas</legend>
            ID:<br> 
            <input type="text" name="id"><br>
            Aforo:<br> 
            <input type="text" name="aforo"><br>
            Opciones: <br>
            <input type="radio" name="op" value="insert" checked="checked">Crear sala<br>
      		<input type="radio" name="op" value="update">Editar sala<br>
      		<input type="radio" name="op" value="delete">Borrar sala<br>
  		</fieldset>
  		
        <input type="submit" name="procesar" value="Procesar">
    </form>

</body>
</html>