<?php

class MdlCategorias
{
    /*  ************************
                LISTAR
        ************************ */

    public static function mdlListar($categoria)
    {
        require_once "conexion.php";
        if (is_numeric($categoria)) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM categorias where idcategoria=:idcategoria");
            $stmt->bindParam(":idcategoria", $categoria, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else if($categoria != "") {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM categorias where nombre_categoria=:nombre_categoria");
            $stmt->bindParam(":nombre_categoria", $categoria, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM categorias");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        $stmt = null;
    }
}
