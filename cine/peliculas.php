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
	        width: 700px; }
    td { border: 1px solid black; }
	</style>
</head>

<body>
	<h1 align="center">Cines Coronado</h1>
	<a href="index.php"> ⇐Atras </a>
	<h2>Películas</h2>
	
	<ul>
		<li>id: deben introducirse valores enteros positivos</li>
		<li>Añadir película: no debe añadirse un nuevo id, simplemente proporcionar los datos nombre y descripción</li>
		<li>Actualizar película: deben rellenarse los 3 campos</li>
		<li>Borrar película: solamente se debe indicar el id de la película que se desea borrar</li>
	</ul>
	
	<?php
	
    $datosIni = $ctrl->selectPeliculas();
    
    echo '<p><table>
      <tr> <th>id</th> <th>nombre</th> <th>descripcion</th> </tr>';
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
		<p>descripción:</p>
		<p><textarea name='descripcion' cols='40' rows='5'></textarea></p>
		
		<p>Opciones:
		<p><input type='radio' name='op' value='insert' checked='checked'>Añadir película</p>
		<p><input type='radio' name='op' value='update'>Actualizar película</p>
		<p><input type='radio' name='op' value='delete'>Borrar película</p>
		</fieldset>
		
		<input type='submit' name='enviar' value='Enviar'>
	</form>
	
</body>
</html>
