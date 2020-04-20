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
	$datos = $ctrl->selectRegistros();
	
	echo
	'<table>
     <tr> <td>id_registro</td> <td>id_sala</td> <td>asiento</td> <td>fecha_registro</td> <td>sesion</td> 
          <td>id_peli</td> <td>precio</td> </tr>';
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
	
</body>
</html>