<?php 

include("database.php");

if (isset($_POST['register'])) {
    if (strlen($_POST['cui']) >= 1 &&strlen($_POST['name']) >= 1 && strlen($_POST['apellido']) >= 1 && strlen($_POST['fecha']) >= 1 && strlen($_POST['categoria']) >= 1) {
		$cui = trim($_POST['cui']);
		$name = trim($_POST['name']);
	    $apellido = trim($_POST['apellido']);
		$fecha = date("d/m/y");
		$categoria = trim($_POST['categoria']);
	    $fechareg = date("d/m/y");
		$consulta = "INSERT INTO preregistro(cui, nombre, apellido, fecha, categoria, fecha_reg) VALUES ('$cui','$name','$apellido','$fecha','$categoria','$fechareg')";
	
	    $resultado = mysqli_query($conex,$consulta);
		if ($resultado) {
	    	?> 
	    	<h3 class="ok">¡Te has inscripto correctamente!</h3>
           <?php
	    } else {
	    	?> 
	    	<h3 class="bad">¡Ha ocurrdio un error!</h3>
           <?php
	    }
    }   else {
	    	?> 
	    	<h3 class="bad">¡Por favor complete los campos!</h3>
           <?php
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Pre Registro</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="complemento/estilo.css">
	
</head>
<body>
    <form method="post">
    	<h1>Pre-registro de Vacunación</h1>
		<input type="text" name="cui" placeholder="Ingrese su DPI" pattern="[0-9]{13}"  title="Coloque su DPI">
    	<input type="text" name="name" placeholder="Nombre" pattern="[A-Z a-z]{5,50}"  title="Coloque su nombre">
    	<input type="text" name="apellido" placeholder="Apellido" pattern="[A-Z a-z]{5,50}"  title="Coloque su apellido">
		<input type="date" name="fecha" placeholder="Fecha">
    	<select name="categoria">
			<option value="1">60 años en adelante</option>
			<option value="2">De 50 a 59 años</option>
			<option value="3">De 40 a 49 años</option>
			<option value="3">De 418 a 39 años</option>
</select>
		<input type="submit" name="register">
    </form>
        <?php 
      include("registrar.php");
        ?>
</body>
</html>
