<?php 
	require_once 'includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="includes/estilo.css" />
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
	<h2>Películas</h2>
	
	<?php
	
    $datosIni = $ctrl->selectPeliculas();
    
    echo '<p><table>
      <tr> <td>id</td> <td>nombre</td> <td>descripcion</td> </tr>';
    foreach ($datosIni as $valor)
    {
        echo
        "<tr>
    <td>".$valor['id']."</td>
    <td>".$valor['nombre']."</td>
    <td>".$valor['descripcion']."</td>
    </tr>";
    }
    echo '</table></p>';
	
	?>
	
	<form action='procesarPeliculas.php' method ='post'>
		<fieldset>
		<legend>Modificación de películas</legend>
		<p>id:
		<input type='text' name='id'></p>
		<p>nombre:
		<input type='text' name='nombre'></p>
		<p>descripción:
		<input type='text' name='descripcion'></p>
		
		<p>Opciones:
		<p><input type='radio' name='op' value='insert' checked='checked'>Añadir pelicula</p>
		<p><input type='radio' name='op' value='update'>Actualizar pelicula</p>
		<p><input type='radio' name='op' value='delete'>Borrar pelicula</p>
		</fieldset>
		
		<input type='submit' name='enviar' value='Enviar'>
	</form>
	
</body>
</html>
