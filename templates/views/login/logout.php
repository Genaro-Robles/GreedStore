<?php
require_once 'app/models/mdlUsuarios.php';
$user = new mdlUsuarios();
if ($user::auth()) {
    $user::destroy();
    header('Location: ../');
} else {
    header('Location: ../');
}
