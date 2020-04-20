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
	
	<h2>Sesiones</h2>

	<?php 
    
    echo '<ul>';
    $arr = $ctrl->selectSesion('',"1 ORDER BY id_sala");
    
    if (count($arr) > 0) {
        $last_sala = $arr[0]['id_sala'];
    }
    $i = 0;
    $j = 0;
    while ($i < count($arr)) {
        echo '<h3>'."Sala ".$arr[$i]['id_sala'] . '</h3>';
        echo '<ul>';
        while ($j < count($arr) && $last_sala == $arr[$j]['id_sala']) {
            $str = "Sesion: ".$arr[$j]['fecha']."-->Sala: ".$arr[$j]['id_sala']." -->Peli: ".$arr[$j]['id_peli']." -->Precio: ".$arr[$j]['precio'];
            echo '<li>'.$str.'</li>';
            $last_sala = $arr[$j]['id_sala'];
            $j++;
        }
        if ($j < count($arr)) $last_sala = $arr[$j]['id_sala'];
        echo '</ul>';
        
        $i=$j;
    }
    
	
    if (isset($_GET['errores']) && count($_GET['errores']) > 0) {
        echo '<ul>';
        foreach($_GET['errores'] as $error) {
            echo '<li>'.$error.'</li>';
        }
        echo '</ul>';
    }

    ?>
	
	<form action="procesarSesion.php" method="post">
		<fieldset>
		<legend>Modificación de sesiones</legend>
            Fecha:<br> 
            <input type="datetime-local" name="fecha"> <!--  value=<?php echo substr(date("c", time()), 0, 16);?>
            min=<?php echo substr(date("c", time()), 0, 16);?>> --> <br>
            Sala:<br> 
            <select name="sala">
            	<?php 
            	    $arr_sala = $ctrl->selectSala();
                	foreach($arr_sala as $pair) {
                	    $str = "value=".$pair['id'].">".$pair['id'];
                	    echo '<option '.$str.'</option>';
                	}
            	?>
            </select> <br>
            Pelicula:<br> 
            <select name="peli">
            	<?php 
            	    $arr_peli = $ctrl->selectSala();
                	foreach($arr_peli as $pair) {
                	    $str = "value=".$pair['id'].">".$pair['id']."-".$pair['nombre'];
                	    echo '<option '.$str.'</option>';
                	}
            	?>
            </select> <br>
            Precio:<br> 
            <input type="text" name="precio"><br>
            Opciones: <br>
            <input type="radio" name="op" value="insert" checked="checked">Crear sesion<br>
      		<input type="radio" name="op" value="update">Editar sesion<br>
      		<input type="radio" name="op" value="delete">Borrar sesion<br>
  		</fieldset>
  		
        <input type="submit" name="procesar" value="Procesar">
    </form>

</body>
</html>