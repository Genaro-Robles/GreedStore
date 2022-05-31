<?php

class CtrUsuarios
{
    public static function VerificarSession(){
        $user = new mdlUsuarios();
        return $user::auth();
    }

    public static function ObtenerSession(){
        $user = new mdlUsuarios();
        return $user::getSessionUser();
    }
    /*  ************************
            LISTAR CATEGORIAS
        ************************ */

    public static function ctrRegistrarUsuario()
    {
        $new_usuario = [];

        if (!isset($_POST["metodo"])) {
            if (!isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['phone'])) {
                json_output(400, 'Completa el formulario por favor e intenta de nuevo');
            }
            // Crear nuestro array de información del nuevo usuario
            $new_usuario = [
                'nombre_apellido'    => clean_string($_POST['name']),
                'correo'        => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
                'pass'        => password_hash($_POST["password"], true),
                'celular'        => clean_string($_POST['phone'])
            ];
        } else {
            if (!isset($_POST['name'], $_POST['email'], $_POST['perfil'], $_POST['metodo'])) {
                json_output(400, 'Completa el formulario por favor e intenta de nuevo');
            }
            // Crear nuestro array de información del nuevo usuario
            $new_usuario = [
                'nombre_apellido'    => clean_string($_POST['name']),
                'correo'        => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
                'perfil'        => filter_var($_POST['perfil'], FILTER_SANITIZE_URL),
                'metodo'        => clean_string($_POST['metodo'])
            ];
        }

        if (!MdlUsuarios::mdlRegistrarUsuario($new_usuario)) {
            json_output(400, 'El correo ya se encuentra en uso, intenta con otro');
        }
        json_output(201, 'Se ha registrado correctamente');
    }
    public static function ctrActualizarUsuario()
    {
        if (!isset($_POST['idusuario'], $_POST['cborol'])) {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }

        $id = (int) $_POST['idusuario'];
        // Crear nuestro array de información del nuevo usuario
        $usuario = [
            'id_rol'    => $_POST['cborol'],
        ];

        // Guardar en la base de datos
        if (!MdlUsuarios::mdlActualizarUsuario(['id' => $id], $usuario)) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }
        json_output(201, 'Se ha Actualizado correctamente');
    }
    public static function ctrEstadoUsuario()
    {
        if (!isset($_POST['usuario'], $_POST['action'])) {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }
        $usuario = [];

        $action_msg = $_POST['action'] == 'banear' ? 'Baneado' : 'Desbaneado';

        $id = (int) $_POST['usuario'];
        if ($_POST['action'] == 'banear') {
            $usuario = [
                'estado'    => '0',
            ];
        } else {
            $usuario = [
                'estado'    => '1',
            ];
        }

        if (!MdlUsuarios::mdlActualizarUsuario(['id' => $id], $usuario)) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }
        json_output(201, 'Se ha ' . $action_msg . ' correctamente', ['action' => $action_msg . '!']);
    }
    public static function ctrLoginUsuario()
    {
        if (!isset($_POST["metodo"])) {
            if (!isset($_POST['email'], $_POST['password'])) {
                json_output(400, 'Completa el formulario por favor e intenta de nuevo');
            }
            // Validar que el correo exista
            $respuesta = MdlUsuarios::mdlLoginUsuario(["correo" => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)])[0];
            // Si no existe el correo
            if (!$respuesta) {
                json_output(400, 'El correo no existe');
            }
            // Si el usuario está baneado
            if ($respuesta["estado"] == 0) {
                json_output(400, 'El usuario está baneado');
            }
            // Si el la contraseña es incorrecta
            if (!password_verify($_POST['password'], $respuesta["pass"])) {
                json_output(400, 'La contraseña es incorrecta');
            }

            $user = new mdlUsuarios();

            $user::setSessionUser($respuesta['correo'], $respuesta['nombre_apellido'], $respuesta["perfil"], $respuesta['id_rol']);

            json_output(200, 'Bienvenido ' . $respuesta['nombre_apellido']);

        } else {

            if (!isset($_POST['email'], $_POST['perfil'], $_POST['metodo'], $_POST['name'])) {
                json_output(400, 'Hubo un problema con las credenciales');
            }
            // Validar que el correo exista
            $respuesta = MdlUsuarios::mdlLoginUsuario(["correo" => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)])[0];
            // Si no existe el correo
            if (!$respuesta) {
                json_output(400, 'El correo no existe');
            }
            // Si el usuario está baneado
            if ($respuesta["estado"] == 0) {
                json_output(400, 'El usuario está baneado');
            }

            $user = new mdlUsuarios();

            $user::setSessionUser($respuesta['correo'], $respuesta['nombre_apellido'], $respuesta["perfil"],$respuesta['id_rol']);

            json_output(200, 'Bienvenido ' . $respuesta['nombre_apellido']);
        }
    }
}

?>