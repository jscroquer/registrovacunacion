<?php
session_start();

require 'database.php';

if(isset($_SESSION['cui_usuario']))
{
    $records = $conn->prepare('SELECT cui,password FROM registro WHERE cui = :cui');
    $records->bindParam(':cui', $_SESSION['cui_usuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $usuario = null;

    if(count($result) > 0)
    {
        $usuario = $results;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Vacunacion</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="complemento/styles.css">
</head>
<body>

    <?php require 'partes/cabecera.php' ?>

    <?php if(!empty($usuario)): ?>
        <br>Welcome. <?= $usuario['cui']; ?>
        <br>Tu haz Iniciado Sesion Exitosamente
        <a href="logout.php">
            Logout
        </a>
        <?php else: ?>
            <h1>POR FAVOR INICIA SESION O REGISTRATE</h1>

            <a href="login.php">Iniciar Sesion</a> or
            <a href="registro.php">Registrese</a>
        <?php endif; ?>

</body>
</html>