<?php

require_once "./app/functions/functions.php";

class CtrCategorias
{

    /*  ************************
            LISTAR CATEGORIAS
        ************************ */

    public static function ctrListar($categoria)
    {
        $respuesta = MdlCategorias::mdlListar($categoria);
        return $respuesta;
    }
    public static function ctrListarAJAX()
    {
        $categoria = $_POST['categoria'];
        $respuesta = MdlCategorias::mdlListar($categoria);
        echo json_encode($respuesta);
    }
    public static function ctrListarCategorias()
    {

        $respuesta = MdlCategorias::mdlListarCategorias();

        return $respuesta;
    }
    public static function ctrListarCategoriasTabla()
    {
        $respuesta = MdlCategorias::mdlListarCategoriasTabla();
        echo $respuesta;
    }
    public static function ctrAgregarCategoria()
    {
        if (!isset($_POST['nombre'], $_POST['detalles'])) {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }

        // Crear nuestro array de información del nuevo juego
        $new_categoria =
            [
                'nombre_categoria'    => clean_string($_POST['nombre']),
                'descripcion_categoria'        => clean_string($_POST['detalles']),
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

            $new_categoria['foto_categoria'] = $new_name;
        } else {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }
        // Guardar en la base de datos
        if (!MdlCategorias::mdlAgregarCategoria($new_categoria)) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }
        json_output(201, 'Nuevo categoria agregada con éxito');
    }
    public static function ctrActualizarCategoria()
    {
        if (!isset($_POST['nombre'], $_POST['detalles'], $_POST['idcategoria'])) {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }
        $id = (int) $_POST['idcategoria'];
        // Crear nuestro array de información del nuevo juego
        $categoria =
            [
                'nombre_categoria'    => clean_string($_POST['nombre']),
                'descripcion_categoria'        => clean_string($_POST['detalles']),
            ];

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

            $categoria['foto_categoria'] = $new_name;
        }

        // Guardar en la base de datos
        if (!MdlCategorias::mdlActualizarCategoria(['idcategoria' => $id], $categoria)) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }

        // Antes de regresar la respuesta
        // Debemos borrar del servidor la imagen anterior
        if (isset($new_name) && is_file(UPLOADS . $new_name)) {
            if (is_file(UPLOADS . $foto_anterior)) unlink(UPLOADS . $foto_anterior);
        }

        json_output(200, 'Cambios guardados con éxito');
    }
    public static function ctrEliminarCategoria()
    {
        if (!isset($_POST['idcategoria'])) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }
        $id = (int) $_POST['idcategoria'];
        // Obtener la imagen anterior si existe
        /*         $respuesta = get_by_id('categorias',['idcategoria' => $id, 'estado' => 1]); */

        // Borrar de la base de datos
        if (!MdlCategorias::mdlEliminarCategoria(['idcategoria' => $id], ['estado' => 0])) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }
        // Antes de regresar la respuesta
        // Debemos borrar del servidor la imagen anterior
        json_output(200, 'Categoria eliminada con éxito');
    }
    public static function ctrListarCategoriaTabla()
    {

        if (!isset($_POST['idcategoria'])) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }

        $id = (int) $_POST['idcategoria'];

        $respuesta = MdlCategorias::mdlListarCategoriaTabla(['idcategoria' => $id]);

        echo $respuesta;
    }
    public static function ctrEstadoCategoria()
    {
        if (!isset($_POST['idcategoria'], $_POST['action'])) {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }
        $categoria = [];

        $action_msg = $_POST['action'] == 'eliminar' ? 'Eliminado' : 'Restaurado';

        $id = (int) $_POST['idcategoria'];

        if ($_POST['action'] == 'eliminar') {
            $categoria = [
                'estado'    => '0',
            ];
        } else {
            $categoria = [
                'estado'    => '1',
            ];
        }

        if (!MdlCategorias::mdlActualizarCategoria(['idcategoria' => $id], $categoria)) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }
        json_output(201, 'Se ha ' . $action_msg . ' correctamente', ['action' => $action_msg . '!']);
    }
}
