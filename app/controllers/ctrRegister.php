<?php
require_once '../models/mdlAutenticacion.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    switch($_GET['action']){
        case 'register':
            $respuesta = MdlAutenticacion::mdlUsuarioExiste($_POST['correo']);
            if(is_array($respuesta) == true && count($respuesta) > 0){
                echo '0';
            }else{
                if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['celular']) && isset($_POST['edad']) && isset($_POST['pass'])) {
                    if ($_POST['nombre'] != "" && $_POST['correo'] != "" && $_POST['celular'] != "" && $_POST['edad'] != "" && $_POST['pass'] != "") {
                        $datos = array(
                            "nombre" => $_POST['nombre'],
                            "correo" => $_POST['correo'],
                            "celular" => $_POST['celular'],
                            "edad" => $_POST['edad'],
                            "pass" => $_POST['pass']
                        );
                        $respuesta = MdlAutenticacion::mdlRegistrarUsuario($datos);
                        if ($respuesta == true) {
                            echo '1';
                            // ENVIAR CORREO
                        } else {
                            echo '0';
                        }
                    } else {
                        $respuesta = "error vacio";
                        echo $respuesta;
                    }
                } else {
                    $respuesta = "error no existe";
                    echo $respuesta;
                }
            }
            break;
    }
}