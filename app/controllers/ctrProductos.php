<?php

class CtrProductos
{

    /*  ************************
            LISTAR CAT o TODOS
        ************************ */

    public static function ctrListar($categoria)
    {

        $respuesta = MdlProductos::mdlListar($categoria);

        return $respuesta;
    }

    /*  ************************
            LISTAR POR ID
        ************************ */
    public static function ctrListarItem($id)
    {

        $respuesta = MdlProductos::mdlListarItem($id);

        return $respuesta;
    }
    public static function ctrListarItemAJAX()
    {
        if (isset($_POST['producto'])) {
            $id = $_POST['producto'];
        } else {
            $id = '';
        }
        $respuesta = MdlProductos::mdlListarItem($id);

        echo json_encode($respuesta);
    }

    /*  ************************
            LISTAR RELACIONADOS
        ************************ */

    public static function ctrListarRelacionados($id, $categoria)
    {

        $respuesta = MdlProductos::mdlListarRelacionados($id, $categoria);

        return $respuesta;
    }

    /*  ************************
            LISTAR POR
        ************************ */

    public static function ctrListarPor()
    {
        if (isset($_POST['nombre']) && isset($_POST['orden'])) {
            $nombre = $_POST['nombre'];
            $orden = $_POST['orden'];
        } else {
            $nombre = '';
            $orden = '';
        }
        $respuesta = MdlProductos::mdlListarPor($nombre, $orden);

        echo $respuesta;
    }


    /*  ************************
            REGISTRAR
        ************************ */

    public static function ctrRIngresar()
    {
        if (isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['dni']) && isset($_POST['telefono']) && isset($_POST['email']) && isset($_POST['asunto']) && isset($_POST['mensaje'])) {
            if ($_POST['nombres'] != "" && $_POST['apellidos'] != "" && $_POST['dni'] != "" && $_POST['telefono'] != "" && $_POST['email'] != "" && $_POST['asunto'] != "" && $_POST['mensaje'] != "") {
                $datos = array(
                    "nombres" => $_POST['nombres'],
                    "apellidos" => $_POST['apellidos'],
                    "dni" => $_POST['dni'],
                    "telefono" => $_POST['telefono'],
                    "email" => $_POST['email'],
                    "asunto" => $_POST['asunto'],
                    "mensaje" => $_POST['mensaje'],
                    "estado" => 0
                );

                //$respuesta = MdlReclamaciones::mdlIngresar($datos);

                return 0;
            } else {
                $respuesta = "error vacio";
                echo $respuesta;
            }
        } else {
            $respuesta = "error no existe";
            echo $respuesta;
        }
    }

    public static function ctrListarUsuarios()
    {
        require_once "./app/models/mdlUsuarios.php";

        $respuesta = mdlUsuarios::mdlListarPor();

        echo $respuesta;
    }

    public static function ctrListarUsuario()
    {
        require_once "./app/models/mdlUsuarios.php";
        if (isset($_POST['usuario'])) {
            $id = $_POST['usuario'];
        } else {
            $id = '';
        }
        $respuesta = mdlUsuarios::mdlListarUsuario($id);

        echo json_encode($respuesta);
    }
    public static function ctrAgregarProducto()
    {
        if (!isset($_POST['nombre'], $_POST['cbocategoria'], $_POST['stock'], $_POST['precio'], $_POST['detalles'], $_FILES["foto"])) {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }
        // Crear nuestro array de información del nuevo juego
        $new_producto =
            [
                'nombre'    => clean_string($_POST['nombre']),
                'descripcion'        => clean_string($_POST['detalles']),
                'stock'        => intval($_POST['stock']),
                'precio'        => floatval($_POST['precio']),
                'categoria'        => intval($_POST['cbocategoria'])
            ];

        // Si el usuario subió una imagen, procesarla
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== 4) {
            // Primero vamos almacenarla en una variable
            $img = $_FILES['foto'];
            $ext = pathinfo($img['name'], PATHINFO_EXTENSION);

            // Después vamos a renombrarla
            $new_name = generate_filename() . '.' . $ext;

            // Después vamos a guardarla en nuestro SERVIDOR dentro de UPLOADS
            if (!move_uploaded_file($img['tmp_name'], UPLOADS . $new_name)) {
                json_output(400, 'Hubo un error al guardar la imagen, intenta de nuevo');
            }

            $new_producto['foto_producto'] = $new_name;
        } else {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }
        // Guardar en la base de datos
        if (!MdlProductos::mdlAgregarProducto($new_producto)) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }
        json_output(201, 'Nuevo producto agregado con éxito');
    }
    public static function ctrEditarProducto()
    {
        if (!isset($_POST['nombre'], $_POST['cbocategoria'], $_POST['stock'], $_POST['precio'], $_POST['idproducto'], $_POST['detalles'])) {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }

        $id = (int) $_POST['idproducto'];

        // Crear nuestro array de información del nuevo juego
        $producto =
            [
                'nombre'    => clean_string($_POST['nombre']),
                'descripcion'        => clean_string($_POST['detalles']),
                'stock'        => intval($_POST['stock']),
                'precio'        => floatval($_POST['precio']),
                'categoria'        => intval($_POST['cbocategoria'])
            ];


        // Si el usuario subió una imagen, procesarla
        // Si el usuario subió una imagen, procesarla
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== 4) {
            // Obtener la imagen anterior si existe
            $foto_anterior = $_POST['foto_anterior'];

            // Primero vamos almacenarla en una variable
            $img = $_FILES['foto'];
            $ext = pathinfo($img['name'], PATHINFO_EXTENSION);

            // Después vamos a renombrarla
            $new_name = generate_filename() . '.' . $ext;

            // Después vamos a guardarla en nuestro SERVIDOR dentro de UPLOADS
            if (!move_uploaded_file($img['tmp_name'], UPLOADS . $new_name)) {
                json_output(400, 'Hubo un error al guardar la imagen, intenta de nuevo');
            }

            $producto['foto_producto'] = $new_name;
        }
        // Guardar en la base de datos
        if (!MdlProductos::mdlActualizarProducto(['idproducto' => $id], $producto)) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }

        // Antes de regresar la respuesta
        // Debemos borrar del servidor la imagen anterior
        if (isset($new_name) && is_file(UPLOADS . $new_name)) {
            if (is_file(UPLOADS . $foto_anterior)) unlink(UPLOADS . $foto_anterior);
        }

        json_output(200, 'Cambios guardados con éxito');
    }
    public static function ctrEliminarProducto()
    {
        if (!isset($_POST['idproducto'])) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }
        $id = (int) $_POST['idproducto'];
        // Obtener la imagen anterior si existe
        /*         $respuesta = get_by_id('categorias',['idcategoria' => $id, 'estado' => 1]); */

        // Borrar de la base de datos
        if (!MdlProductos::mdlEliminarProducto(['idproducto' => $id], ['estado' => 0])) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }
        // Antes de regresar la respuesta
        // Debemos borrar del servidor la imagen anterior
        json_output(200, 'Producto eliminado con éxito');
    }
    public static function ctrEstadoProducto()
    {
        if (!isset($_POST['idproducto'], $_POST['action'])) {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }
        $producto = [];

        $action_msg = $_POST['action'] == 'eliminar' ? 'Eliminado' : 'Restaurado';

        $id = (int) $_POST['idproducto'];

        if ($_POST['action'] == 'eliminar') {
            $producto = [
                'estado'    => '0',
            ];
        } else {
            $producto = [
                'estado'    => '1',
            ];
        }

        if (!MdlProductos::mdlActualizarProducto(['idproducto' => $id], $producto)) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }
        json_output(201, 'Se ha ' . $action_msg . ' correctamente', ['action' => $action_msg . '!']);
    }
}
