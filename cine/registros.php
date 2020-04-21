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
	        width: 600px; }
    td { border: 1px solid black; }
	</style>
</head>

<body>
	<h1 align="center">Cines Coronado</h1>
	<a href="index.php"> ⇐Atras </a>
	<h2>Registros</h2>
	
	<?php
	$datos = $ctrl->selectAllRegistros();
	
	echo
	'<table>
     <tr> <th>ID</th> <th>Sala</th> <th>Asiento</th> <th>Fecha de Registro</th> <th>Fecha de Sesion</th> 
          <th>ID Peli</th> <th>precio</th> </tr>';
	foreach ($datos as $valor)
	{
	    echo
	    '<tr>
	    <td>'.$valor['id_registro'].'</td>
        <td>'.$valor['id_sala'].'</td>
        <td>'.$valor['asiento'].'</td>
        <td>'.$valor['fecha_registro'].'</td>
        <td>'.$valor['sesion'].'</td>
        <td>'.$valor['id_peli'].'</td>
        <td>'.$valor['precio'].'</td>
	    </tr>';
	}
	echo '</table>';
	
	?>
	
	<form action="procesarRegistro.php" method="post">
		<fieldset>
		<legend>Borrado de registros</legend>
			Borrar registros anteriores a:<br> 
            <input type="datetime-local" name="fecha" value=<?php echo substr(date("c", time()), 0, 14)."00";?>
            max=<?php echo substr(date("c", time()), 0, 16);?>><br>
  		</fieldset>
  		
        <input type="submit" name="procesar" value="Procesar">
    </form>
	
</body>
</html>