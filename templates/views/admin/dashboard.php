<?php

require_once 'app/models/mdlUsuarios.php';
$user = new mdlUsuarios();
if (!$user::auth() || !$user::isAdmin()) {
    header('Location: ../');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    hola
</body>
</html>