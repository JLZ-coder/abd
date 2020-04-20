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
	
	<h2>Salas</h2>

	<?php 
    echo '<ul>';
    $arr = $ctrl->selectSala();
    foreach($arr as $pair) {
        $str = "Sala: ".$pair['id']."-->Aforo: ".$pair['aforo'];
        echo '<li>'.$str.'</li>';
    }
    echo '</ul>'; 
	
    if (isset($_GET['errores']) && count($_GET['errores']) > 0) {
        echo '<ul>';
        foreach($_GET['errores'] as $error) {
            echo '<li>'.$error.'</li>';
        }
        echo '</ul>';
    }

    ?>
	
	<form action="procesarSala.php" method="post">
		<fieldset>
		<legend>Modificación de salas</legend>
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