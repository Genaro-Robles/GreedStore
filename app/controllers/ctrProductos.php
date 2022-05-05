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
        if(isset($_POST['nombre']) && isset($_POST['orden'])){
        $nombre=$_POST['nombre'];
        $orden=$_POST['orden'];
        }else{
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
}
