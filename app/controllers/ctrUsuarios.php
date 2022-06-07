<?php

class CtrUsuarios
{
    public static function VerificarSession()
    {
        $user = new mdlUsuarios();
        return $user::auth();
    }

    public static function ObtenerSession()
    {
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
            if (!isset($_POST['name'], $_POST['email'], $_POST['metodo'])) {
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

            $user::setSessionUser($respuesta['id'], $respuesta['correo'], $respuesta['nombre_apellido'], $respuesta["perfil"], $respuesta['id_rol']);

            json_output(200, 'Bienvenido ' . $respuesta['nombre_apellido']);
        } else {

            if (!isset($_POST['email'], $_POST['metodo'], $_POST['name'])) {
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

            $user::setSessionUser($respuesta['id'], $respuesta['correo'], $respuesta['nombre_apellido'], $respuesta["perfil"], $respuesta['id_rol']);

            json_output(200, 'Bienvenido ' . $respuesta['nombre_apellido']);
        }
    }
    public static function ctrListarUsuarios()
    {
        $respuesta = mdlUsuarios::mdlListarPor();

        echo $respuesta;
    }

    public static function ctrListarUsuario()
    {
        if (isset($_POST['usuario'])) {
            $id = $_POST['usuario'];
        } else {
            $id = '';
        }
        $respuesta = mdlUsuarios::mdlListarUsuario($id);

        echo json_encode($respuesta);
    }
    public static function ctrActualizarUsuarioFotoPerfil()
    {
        if (!isset($_POST['perfil_anterior'], $_POST['id'])) {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }

        $id = (int) $_POST['id'];

        $usuario = array();

        if (isset($_FILES['perfil']) && $_FILES['perfil']['error'] !== 4) {
            // Obtener la imagen anterior si existe
            $perfil_anterior = $_POST['perfil_anterior'];

            // Primero vamos almacenarla en una variable
            $img = $_FILES['perfil'];
            $ext = pathinfo($img['name'], PATHINFO_EXTENSION);

            // Después vamos a renombrarla
            $new_name = generate_filename() . '.' . $ext;

            // Después vamos a guardarla en nuestro SERVIDOR dentro de UPLOADS
            if (!move_uploaded_file($img['tmp_name'], UPLOADS . $new_name)) {
                json_output(400, 'Hubo un error al guardar la imagen, intenta de nuevo');
            }
            $usuario['perfil'] = $new_name;
        }
        if (!MdlUsuarios::mdlActualizarUsuario(['id' => $id], $usuario)) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }

        if (isset($new_name) && is_file(UPLOADS . $new_name)) {
            if (is_file(UPLOADS . $perfil_anterior) && $perfil_anterior != 'default-profile.jpg') unlink(UPLOADS . $perfil_anterior);
        }

        $data = get_by_id('usuarios', ['id' => $id])[0];
        $user = new mdlUsuarios();
        $user::setSessionUser($data['id'], $data['correo'], $data['nombre_apellido'], $data["perfil"], $data['id_rol']);
        json_output(200, 'Cambios guardados con éxito', $data);
    }
    public static function ctrActualizarUsuarioPerfil()
    {
        unset($_POST['correo']);

        if (!isset($_POST['nombre_apellido'], $_POST['id'])) {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }
        $id = (int) $_POST['id'];

        if (!MdlUsuarios::mdlActualizarUsuario(['id' => $id], $_POST)) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }
        $data = get_by_id('usuarios', ['id' => $id])[0];
        $user = new mdlUsuarios();
        $user::setSessionUser($data['id'], $data['correo'], $data['nombre_apellido'], $data["perfil"], $data['id_rol']);
        json_output(200, 'Cambios guardados con éxito', $data);
    }
}
