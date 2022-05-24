<?php

class CtrRoles{
     /*  ************************
            LISTAR CATEGORIAS
        ************************ */
        public static function ctrListarRoles()
        {
            require_once "./app/models/mdlRoles.php";
            $respuesta = MdlRoles::mdlListarRoles();
    
            return $respuesta;
        }
}