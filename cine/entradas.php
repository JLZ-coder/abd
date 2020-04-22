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
	        min-width: 600px; }
    td { border: 1px solid black; }
    strong {
        color: red;
    }
    
	</style>
	<title>Cines Coronado</title>
</head>

<body>

	<h1 align="center">Cines Coronado</h1>
	
	<a href="index.php"> ⇐Atras </a>
	
	<h2>Entradas</h2>
	
	<ul> 
		<li>Solo aparecen las sesiones que estan programadas para el futuro.</li>
		<li>Pulse en una de las opciones de vender o cancelar, segun la que eliga podra seleccionar asientos disponibles u ocupados.</li>
		<li>Cada fila de asientos es de 20 columnas</li>
		<li>Los asientos ocupados aparecen en rojo.</li>
	</ul> 

	<?php 
	$arr = $ctrl->selectSesion('',"fecha > '".date("Y-m-d H:i:s", time())."' ORDER BY id_peli");
	
	if (count($arr) > 0) {
	    $pelis_sesion= $ctrl->selectSesion('id_peli',"fecha > '".date("Y-m-d H:i:s", time())."' GROUP BY id_peli");
	    
	    $pelis_nombres = array();
	    foreach ($pelis_sesion as $valor) {
	        $aux = $ctrl->selectPeliculas('nombre', "id=".$valor['id_peli']);
	        $pelis_nombres[$valor['id_peli']] = $aux[0]['nombre'];
	    }
	    
	    echo
	    '<table>
        <tr> <th>Sesiones</th> <th>Pelicula</th> <th>Sala</th> <th>Vender Entrada(s)</th> <th>Cancelar Entrada(s)</th> </tr>';
	    foreach ($arr as $valor)
	    {
	        echo
	        '<tr>
	    <td>'.$valor['fecha'].'</td>
        <td>'.$pelis_nombres[$valor['id_peli']].'</td>
        <td>'.$valor['id_sala'].'</td>
	    <td>'.'<a href="entradas.php
        ?vender=1&fecha='.$valor['fecha'].'&sala='.$valor['id_sala'].'&peli='.$pelis_nombres[$valor['id_peli']].'">
            Mostrar Asientos
        </a>'.'</td>
        <td>'.'<a href="entradas.php
        ?vender=0&fecha='.$valor['fecha'].'&sala='.$valor['id_sala'].'&peli='.$pelis_nombres[$valor['id_peli']].'">
            Mostrar Asientos
        </a>'.'</td>
	    </tr>';
	    }
	    echo '</table>';
	    
	    if (isset($_GET['vender']) && isset($_GET['fecha']) && isset($_GET['peli']) && isset($_GET['sala'])) {
	        echo '<h2>Sesion: '.$_GET['fecha'].' para la Pelicula: '.$_GET['peli'].' en Sala: '.$_GET['sala'].'</h2>';
	        
	        $aforo_sala = $ctrl->selectSala('aforo', "id=".$_GET['sala']);
	        $no_disponibles = $ctrl->selectAsiento('', "fecha_sesion='".$_GET['fecha']."' AND id_sala=".$_GET['sala']);
	        $no_disp = array();
	        foreach ($no_disponibles as $valor) {
	            $no_disp[] = $valor['id'];
	        }
	        
	        if ($_GET['vender'] == 1) {
	            
	            echo '<h4>VENDIENDO</h4>';
	            
	            echo '<form action="procesarEntradas.php?fecha='.$_GET['fecha'].'&sala='.$_GET['sala'].'&peli='.$_GET['peli'].'"'.'method="post">';
	            
	            for ($i = 0; $i < $aforo_sala[0]['aforo']; $i++) {
	                if ($i % 20 == 0) {
	                    echo '<br>';
	                }
	                if (!in_array($i, $no_disp)) {
	                    echo '<input type="checkbox" name="asientos[]" value="'.$i.'">'.$i." | ";
	                }
	                else {
	                    echo '<strong>'.$i.' </strong>'."| ";
	                }
	                
	            }
	            echo '<br>';
	            
	            echo '<input type="submit" name="vender" value="Confirmar">';
	            echo '</form>';
	        }
	        else {
	            echo '<h4>CANCELANDO</h4>';
	            
	            echo '<form action="procesarEntradas.php?fecha='.$_GET['fecha'].'&sala='.$_GET['sala'].'&peli='.$_GET['peli'].'"'.'method="post">';
	            
	            for ($i = 0; $i < $aforo_sala[0]['aforo']; $i++) {
	                if ($i % 20 == 0) {
	                    echo '<br>';
	                }
	                if (in_array($i, $no_disp)) {
	                    echo '<input type="checkbox" name="asientos[]" value="'.$i.'">'.'<strong>'.$i.' </strong>'." | ";
	                }
	                else {
	                    echo " ".$i." | ";
	                }
	                
	            }
	            echo '<br>';
	            
	            echo '<input type="submit" name="cancelar" value="Confirmar">';
	            echo '</form>';
	        }
	    }
	}
	else {
	    echo '<h3>No hay Sesiones Disponibles por ahora</h3>';
	}
	

    ?>

</body>
</html>