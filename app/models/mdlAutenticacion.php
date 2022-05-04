<?php

class MdlAutenticacion
{
    /*  ************************
                LISTAR
        ************************ */

    public static function mdlUsuarioExiste($correo)
    {
        require_once "conexion.php";
        $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios where correo = :correo");
        $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    public static function mdlRegistrarUsuario($datos)
    {
        require_once "conexion.php";
        $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios(nombre_apellido, correo, celular, edad, pass) VALUES 
        (:nombre, :correo, :celular, :edad, :pass)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
        $stmt->bindParam(":edad", $datos["edad"], PDO::PARAM_STR);
        $stmt->bindParam(":pass", password_hash($datos["pass"], true), PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }
}
