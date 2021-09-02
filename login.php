<?php
session_start();

require 'database.php';

if (!empty($_POST['cui']) && !empty($_POST['password']))
{
    $records = $conn->prepare('SELECT cui, password FROM registro WHERE cui = :cui');
    $records->bindParam(':cui', $_POST['cui']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password']))
    {
        $_SESSION['cui_usuario'] = $results['cui'];
       header("Location: /php-login") ;
    }
    else
    {
        $message = 'Lo siento, credenciales no encontradas';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="complemento/styles.css">
</head>
<body>
    <?php require 'partes/cabecera.php' ?>

    <?php if(!empty($message)): ?>
        <p><?= $message?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="registro.php">Registrate</a></span>
    <form action="login.php" method="POST">
    <input type="text" name="cui" placeholder="Ingrese su CUI">
    <input type="password" name="password" placeholder="Ingrese su password">
    <input type="submit" value="Entrar">
    </form>

</body>
</html>