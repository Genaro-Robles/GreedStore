<?php

class MdlProductos
{
    /*  ************************
                LISTAR
        ************************ */

    public static function mdlListar($categoria)
    {
        require_once "conexion.php";
        if ($categoria != "") {
            $stmt = Conexion::conectar()->prepare("SELECT p.* FROM productos p inner join categorias c on p.categoria=c.idcategoria where c.nombre_categoria=:categoria and estado = 1  order by idproducto desc LIMIT 8");
            $stmt->bindParam(":categoria", $categoria, PDO::PARAM_STR);
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM productos where estado = 1 order by idproducto desc LIMIT 8");
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    /*  ************************
                LISTAR ITEM
        ************************ */

    public static function mdlListarItem($id)
    {
        require_once "conexion.php";
        $stmt = Conexion::conectar()->prepare("SELECT * FROM productos where idproducto = :producto");
        $stmt->bindParam(":producto", $id, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    /*  *******************************
                LISTAR RELACIONADOS
        ******************************* */

        public static function mdlListarRelacionados($id,$categoria)
        {
            require_once "conexion.php";
            $stmt = Conexion::conectar()->prepare("SELECT * FROM productos where categoria = :categoria AND idproducto != :producto");
            $stmt->bindParam(":producto", $id, PDO::PARAM_STR);
            $stmt->bindParam(":categoria", $categoria, PDO::PARAM_STR);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $stmt = null;
        }


    public static function mdlCrearUsuario($datos)
    {
        require_once "conexion.php";
        $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios(nombre,apellidos, dni, correo, pass) VALUES 
			(:nombre, :apellidos, :dni, :correo, :pass)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":dni", $datos["dni"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":pass", password_hash($datos['pass'], true), PDO::PARAM_STR);
        if ($stmt->execute()) {

            return "ok";
        } else {

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    /*  ************************
            MODIFICAR USUARIO
        ************************ */

    public static function mdlModificarUsuario($datos)
    {
        require_once "conexion.php";

        $stmt = Conexion::conectar()->prepare("UPDATE usuarios set nombre  = :nombre, apellidos = :apellidos, dni = :dni, correo = :correo where idusuario = :id");
        if ($datos['pass'] != "") {
            $stmt = Conexion::conectar()->prepare("UPDATE usuarios set nombre  = :nombre, apellidos = :apellidos, dni = :dni, correo = :correo, pass = :pass where idusuario = :id");
            $stmt->bindParam(":pass", password_hash($datos['pass'], true), PDO::PARAM_STR);
        }

        $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos['apellidos'], PDO::PARAM_STR);
        $stmt->bindParam(":dni", $datos['dni'], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos['correo'], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos['idU'], PDO::PARAM_INT);
        $stmt->execute();


        if ($stmt->execute()) {

            return "ok";
        } else {

            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    public static function mdlListarUsuario($id)
    {
        require_once "conexion.php";
        if ($id == 0) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios where idusuario  = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $stmt = null;
    }
}
