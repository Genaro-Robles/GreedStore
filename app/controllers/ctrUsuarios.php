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

}

?>