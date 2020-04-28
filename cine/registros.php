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
	        min-width: 600px; }
    td { border: 1px solid black; }
	</style>
</head>

<body>
	<h1 align="center">Cines Coronado</h1>
	<a href="index.php"> ⇐Atras </a>
	<h2>Registros</h2>
	
	<ul>
		<li>Borrado de registros: debe escogerse una fecha del pasado, no se pueden borrar registros para sesiones del futuro</li>
		<li>Un registro es un resumen de las entradas vendidas y canceladas de las sesiones</li>
		<li>Se puede buscar sesiones para un dia especifico</li>
		<li>En proximas sesiones apareceran las que estan dentro de los tres proximos dias contando con hoy</li>
	</ul>
	
	<?php
	$max = Date('Y-m-d', strtotime('+3 days'));
	$arr = $ctrl->selectSesion('', "fecha > '".date("Y-m-d", time())."' AND fecha < '".$max."' ORDER BY fecha");

	echo '<h3>Proximas sesiones</h3>';
	
	if (count($arr) > 0) {
	    $last = $arr[0]['fecha'];
	    $i = 0;
	    $j = 0;
	    echo '<table>';
	    
	    while ($i < count($arr)) {
	        echo '<tr>';
	        
	        echo '<th>';
	        echo '<h3>'.substr($arr[$i]['fecha'], 0, 11) . '</h3>';
	        echo '</th>';
	        
	        echo '<td>';
	        echo
	        '<table>
                <tr> <th>Fecha</th> <th>Id_pelicula</th> <th>Precio</th> <th>Total Ventas</th> <th>Cancelaciones</th> <th>Ganacias(bruto)</th> </tr>';
	        while ($j < count($arr) && $last == $arr[$j]['fecha']) {
	            
	            $gan=($arr[$j]['total_venta'] - $arr[$j]['cancelado']) * $arr[$j]['precio'];
	            
	            echo
	            '<tr>
            	    <td>'.$arr[$j]['fecha'].'</td>
            	    <td>'.$arr[$j]['id_peli'].'</td>
                    <td>'.$arr[$j]['precio'].'</td>
                    <td>'.$arr[$j]['total_venta'].'</td>
                    <td>'.$arr[$j]['cancelado'].'</td>
                    <td>'.$gan.'</td>
            	    </tr>';
	            
	            $last = $arr[$j]['fecha'];
	            $j++;
	        }
	        if ($j < count($arr)) $last = $arr[$j]['fecha'];
	        echo '</table>';
	        
	        echo '</td>';
	        
	        echo '</tr>';
	        
	        $i=$j;
	    }
	}
	else {
	    echo '<h4>No hay proximas sesiones</h4>';
	}
	echo '</table>';
	
	
	
	echo '<h3>Buscar sesion</h3>';
	
	echo '<form action="procesarRegistro.php" method="post">';
	
	$def = isset($_GET['fecha']) ? $_GET['fecha'] : date("Y-m-d", time());
	
	    echo 'Fecha de la sesion: <input type="date" name="fecha" 
                value='. $def .'>';
  		
        echo '<input type="submit" name="buscar" value="Buscar">';
    echo '</form>';
    
    if (isset($_GET['fecha'])) {
        
        $arr = $ctrl->selectSesion('', "fecha > '".$_GET['fecha']." 00:00:00' AND fecha < '".$_GET['fecha']." 23:59:59' ORDER BY fecha");
        
        if (count($arr) > 0) {
            echo
            '<table>
                <tr> <th>Fecha</th> <th>Id_pelicula</th> <th>Precio</th> <th>Total Ventas</th> <th>Cancelaciones</th> <th>Ganacias(bruto)</th> </tr>';
            
            foreach($arr as $value) {
                
                $gan=($value['total_venta'] - $value['cancelado']) * $value['precio'];
                
                echo
                '<tr>
            	    <td>'.$value['fecha'].'</td>
            	    <td>'.$value['id_peli'].'</td>
                    <td>'.$value['precio'].'</td>
                    <td>'.$value['total_venta'].'</td>
                    <td>'.$value['cancelado'].'</td>
                    <td>'.$gan.'</td>
            	    </tr>';
            }
            
            echo '</table>';
        }
        else {
            echo '<h4>No hay sesiones para esta fecha</h4>';
        }
    }
    
	?>
	
	<h3>Borrado de Registros</h3>
	
	<form action="procesarRegistro.php" method="post">
		<fieldset>
			Borrar registros anteriores a:<br> 
            <input type="date" name="fecha" value=<?php echo date("Y-m-d", time());?>
            max=<?php echo date("Y-m-d", time());?>>
  		</fieldset>
  		
        <input type="submit" name="procesar" value="Borrar">
    </form>
	
</body>
</html>