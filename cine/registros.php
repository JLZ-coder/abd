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
	<a href="index.php"> ⇐Atras </a>
	<h2>Registros</h2>
	
	<?php
	$datos = $ctrl->selectRegistros();
	
	echo
	'<table>
     <tr> <td>id</td> <td>sesion</td> <td>id_sala</td> <td>asiento</td> <td>fecha</td> </tr>';
	foreach ($datos as $valor)
	{
	    echo
	    '<tr>
	    <td>'.$valor['id'].'</td>
	    <td>'.$valor['sesion'].'</td>
        <td>'.$valor['id_sala'].'</td>
        <td>'.$valor['asiento'].'</td>
        <td>'.$valor['fecha'].'</td>
	    </tr>';
	}
	echo '</table>';
	
	?>
	
</body>
</html>