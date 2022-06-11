<?php

class MdlPedidos
{
    public static function mdlIngresarPedido($array = []){
        return insert_new('pedidos', $array);
    }

    public static function mdlIngresarDetallePedido($array = []){
        return insert_new('detallep', $array);
    }

    public static function mdlUltimoPedido(){
        $stmt = Conexion::conectar()->prepare("SELECT idpedido FROM pedidos order by idpedido desc LIMIT 1");
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    public static function mdlGetDetallesBoleta($idp){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM detallep where idpedido = :idpedido");
        $stmt->bindParam(":idpedido", $idp, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    public static function mdlGetPedidoBoleta($idp){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM pedidos where idpedido = :idpedido");
        $stmt->bindParam(":idpedido", $idp, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }
    
}
?>