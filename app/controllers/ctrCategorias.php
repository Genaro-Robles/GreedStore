<?php

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
}