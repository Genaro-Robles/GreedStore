<?php

class MdlRoles
{
    /*  ************************
                LISTAR
        ************************ */

    public static function mdlListarRoles()
    {
        require_once "conexion.php";

        $stmt = Conexion::conectar()->prepare("SELECT id,rol FROM roles");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }
}
