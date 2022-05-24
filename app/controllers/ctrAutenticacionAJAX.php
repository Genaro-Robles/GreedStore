<?php
require_once '../models/mdlAutenticacion.php';
require_once '../models/mdlUsuarios.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($_GET['action']) {
        case 'register':
            $respuesta = MdlAutenticacion::mdlCorreoExiste($_POST['correo']);
            if (is_array($respuesta) == true && count($respuesta) > 0) {
                echo '0';
            } else {
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
        case 'login':
            $respuesta = MdlAutenticacion::mdlCorreoExiste($_POST['correo']);
            if (is_array($respuesta) == true && count($respuesta) > 0) {
                if (password_verify($_POST['pass'], $respuesta['pass'])) {
                    $user = new mdlUsuarios();
                    $user::setSessionUser($respuesta['correo'], $respuesta['nombre_apellido'], $respuesta['id_rol'], $respuesta["perfil"], true);
                    echo "1";
                } else {
                    echo "0";
                }
            } else {
                echo "0";
            }
            break;
        case 'loginSocialMedia':

            $respuesta = MdlAutenticacion::mdlCorreoExiste($_POST['correo']);
            $respuestaSocialMedia = MdlAutenticacion::mdlCorreoExisteSocialMedia($_POST['correo'], $_POST['metodo']);

            $data = array();
            if (is_array($respuesta) == true && count($respuesta) > 0) {
                $data = array(
                    "respuesta" => "error",
                    "msg" => "El usuario ya existe"
                );
                echo json_encode($data, JSON_FORCE_OBJECT);
            } else {
                if (is_array($respuestaSocialMedia) == true && count($respuestaSocialMedia) > 0) {
                    $user = new mdlUsuarios();
                    $user::setSessionUser($respuestaSocialMedia['correo'], $respuestaSocialMedia['nombre_apellido'], $respuestaSocialMedia['id_rol'], $respuestaSocialMedia["perfil"], true);
                    $data = array(
                        "respuesta" => "login",
                        "msg" => "El usuario ya existe"
                    );
                    echo json_encode($data, JSON_FORCE_OBJECT);
                } else {
                    if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['perfil']) && isset($_POST['metodo'])) {
                        if ($_POST['nombre'] != "" && $_POST['correo'] != "" && $_POST['perfil'] != "" && $_POST['metodo'] != "") {
                            $datos = array(
                                "nombre" => $_POST['nombre'],
                                "correo" => $_POST['correo'],
                                "perfil" => $_POST['perfil'],
                                "metodo" => $_POST['metodo']
                            );

                            $respuesta = MdlAutenticacion::mdlRegistrarUsuarioSocialMedia($datos);
                            if ($respuesta == true) {
                                $user = new mdlUsuarios();
                                $user::setSessionUser($datos['correo'], $datos['nombre'], 1, $datos["perfil"], true);
                                $data = array(
                                    "respuesta" => "login",
                                    "msg" => "El usuario se registro con exito"
                                );
                                echo json_encode($data, JSON_FORCE_OBJECT);
                            } else {
                                $data = array(
                                    "respuesta" => "error",
                                    "msg" => "El usuario no se pudo registrar"
                                );
                                echo json_encode($data, JSON_FORCE_OBJECT);
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
            }
            break;
    }
}
