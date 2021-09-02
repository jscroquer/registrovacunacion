<?php
require 'database.php';

$message = '';

if(!empty($_POST['cui']) && !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['fecha_na']) && !empty($_POST['password']))
{
    $sql = "INSERT INTO registro (cui,nombre,apellido,fecha_na,password) VALUES (:cui, :nombre, :apellido, :fecha_na, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cui', $_POST['cui']);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':apellido', $_POST['apellido']);
    $stmt->bindParam(':fecha_na', $_POST['fecha_na']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if($stmt->execute())
    {
        $message = 'Se a creado un nuevo usuario';
    }
    else
    {
        $message = 'Lo lamento, ha acurrido un error de registro';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="complemento/styles.css">
</head>
<body>

<?php require 'partes/cabecera.php' ?>

<?php if(!empty($message)): ?>
    <p><?= $message?></p>
<?php endif; ?>

<h1>Registro</h1>
<span>or <a href="login.php">Iniciar Sesion</a></span>

<form action="registro.php" method="POST">
    <input type="text" name="cui" placeholder="Ingrese su CUI">
    <input type="text" name="nombre" placeholder="Ingrese su nombre">
    <input type="text" name="apellido" placeholder="Ingrese su apellido">
    <input type="text" name="fecha_na" placeholder="Fecha de Nacimiento anio/mes/dia">
    <input type="password" name="password" placeholder="Ingrese un password">
    <input type="submit" value="Registrar">
    </form>


    
</body>
</html>