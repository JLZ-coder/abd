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

	<?php 
    $arr = $ctrl->selectSala();
    
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