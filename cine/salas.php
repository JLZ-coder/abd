<?php 
	require_once 'includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style>
	table { border: 1px solid black;
	        border-collapse: collapse;
	        min-width: 250px; }
    td { border: 1px solid black; }
	</style>
	<title>Cines Coronado</title>
</head>

<body>

	<h1 align="center">Cines Coronado</h1>
	
	<a href="index.php"> ⇐Atras </a>
	
	<h2>Salas</h2>
	
	<ul> 
		<li>ID: Solo acepta valores enteros.</li>
		<li>Aforo: Solo acepta valores enteros.</li>
		<li>La opcion crear necesita los dos campos.</li>
		<li>La opcion editar necesita los dos campos, se cambiara el Aforo de la sala ID.</li>
		<li>La opcion borrar solo necesita el ID.</li>
		<li>NO SE PUEDE MODIFICAR UNA SALA ASOCIADA A UNA SESION ACTIVA.</li>
	</ul> 
	
	<?php 
    $arr = $ctrl->selectSala();
    
    if (count($arr) > 0) {
        echo
        '<table>
        <tr> <th>ID</th> <th>Aforo</th> </tr>';
        foreach ($arr as $valor)
        {
            echo
            '<tr>
	    <td>'.$valor['id'].'</td>
	    <td>'.$valor['aforo'].'</td>
	    </tr>';
        }
        echo '</table>';
    }
    else {
        echo '<h3>No hay ninguna sala</h3>';
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