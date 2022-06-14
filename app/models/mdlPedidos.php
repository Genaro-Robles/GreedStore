<?php

class MdlPedidos
{
    public static function mdlIngresarPedido($array = [])
    {
        return insert_new('pedidos', $array);
    }

    public static function mdlIngresarDetallePedido($array = [])
    {
        return insert_new('detallep', $array);
    }

    public static function mdlUltimoPedido()
    {
        $stmt = Conexion::conectar()->prepare("SELECT idpedido FROM pedidos order by idpedido desc LIMIT 1");
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    public static function mdlGetDetallesBoleta($idp)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM detallep where idpedido = :idpedido");
        $stmt->bindParam(":idpedido", $idp, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlGetPedidoBoleta($idp)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM pedidos where idpedido = :idpedido");
        $stmt->bindParam(":idpedido", $idp, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    public static function mdlListarPedidosTabla()
    {
        require_once "conexion.php";
        $consulta = "SELECT * FROM pedidos";
        $stmt = Conexion::conectar()->prepare($consulta);
        $stmt->execute();
        $salida = "";
        if ($stmt->rowCount() > 0) {
            $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $salida .= "<table class='table table-responsive table-bordered border-dark'>
            <thead class='thead-colored thead-dark'>
                <th>ID PEDIDO</th>
                <th>ID USUARIO</th>
                <th>FECHA PEDIDO</th>
                <th>FECHA ENTREGA</th>
                <th>SUBTOTAL</th>
                <th>IGV</th>
                <th>TOTAL</th>
                <th>ENTREGA</th>
                <th>ESTADO</th>
                <th>ACCIONES</th>
            </thead>
            <tbody>";
            foreach ($categorias as $key => $value) {
                $salida .= "<tr>
                <td>" . $value['idpedido'] . "</td>
                <td>" . $value['idusuario'] . "</td>
                <td>" . $value['fechaPedido'] . "</td>
                <td>" . $value['fechaEntrega'] . "</td>
                <td>s/." . $value['subtotal'] . "</td>
                <td>s/." . $value['igv'] . "</td>
                <td>s/." . $value['total'] . "</td>
                <td>" . $value['tipoEntrega'] . "</td>
                <td>
                    <div class='badge text-wrap " . ($value['estado'] == 1 ? "bg-success" : "bg-danger") . "' style='width: 6rem;' id='estado'>
                        " . ($value['estado'] == 1 ? "En proceso" : "Concluido") . "
                    </div>
                </td>
                <td>
                    <div class='d-flex flex-column gap-2'>
                        <button class='btn btn-teal btn-view-pedido mg-b-10' data-idped='" . $value['idpedido'] . "'><i class='icon ion-eye'></i> Ver Detalles</button>
                        <button class='btn  btn-danger btn-action-pedido' data-action='" . ($value['estado'] == 1 ? "concluir" : "proceso") . "' data-idped='" . $value['idpedido'] . "'><i class='icon ion-trash-a'></i> " . ($value['estado'] == 1 ? "Concluir" : "Reabrir") . "</button>
                    </div>
                </td>
                </tr>";
            }
            $salida .= "</tbody>
            </table>";
        } else {
            $salida .= "No hay datos";
        }

        return $salida;

        $stmt = null;
    }

    public static function mdlListarPedidoDetallesTabla($id)
    {
        $stmt = Conexion::conectar()->prepare("SELECT d.*, pro.nombre, c.nombre_categoria, p.estado FROM detallep d inner join pedidos p on d.idpedido=p.idpedido INNER JOIN productos pro ON pro.idproducto= d.idproducto INNER JOIN categorias c ON c.idcategoria= pro.categoria where p.idpedido=:idpedido");
        $stmt->bindParam(":idpedido", $id, PDO::PARAM_STR);
        $stmt->execute();
        $salida = "";
        if ($stmt->rowCount() > 0) {
            $detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $salida .= "<table class='table table-responsive table-bordered border-dark'>
            <thead class='thead-colored thead-dark'>
                <th>ID DETALLE</th>
                <th>ID PRODUCTO</th>
                <th>PRODUCTO</th>
                <th>CATEGORIA</th>
                <th>PRECIO UNI</th>
                <th>CANTIDAD</th>
                <th>IMPORTE</th>
                <th>ESTADO</th>
            </thead>
            <tbody>";
            foreach ($detalles as $key => $value) {
                $salida .= "<tr>
                <td>" . $value['iddetalle'] . "</td>
                <td>" . $value['idproducto'] . "</td>
                <td>" . $value['nombre'] . "</td>
                <td>" . $value['nombre_categoria'] . "</td>
                <td>s/." . $value['precioU'] . "</td>
                <td>" . $value['cantidad'] . "</td>
                <td>s/." . $value['importe'] . "</td>
                <td>
                    <div class='badge text-wrap " . ($value['estado'] == 1 ? "bg-success" : "bg-danger") . "' style='width: 6rem;' id='estado'>
                        " . ($value['estado'] == 1 ? "En proceso" : "Concluido") . "
                    </div>
                </td>
                </tr>";
            }
            $salida .= "</tbody>
            </table>";
        } else {
            $salida .= "No hay datos";
        }
        return $salida;
        $stmt = null;
    }
    public static function mdlActualizarPedido($key = [], $array = [])
    {
        return update_record('pedidos', $key, $array);
    }

    public static function mdlContadorPedidos($condicion)
    {
        if ($condicion == "anual") {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM pedidos where YEAR(fechaPedido)=YEAR(NOW())");
        } else if ($condicion == "mensual") {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM pedidos where MONTH(fechaPedido)=MONTH(NOW()) AND YEAR(fechaPedido)=YEAR(NOW())");
        } else if ($condicion == "totales") {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM pedidos");
        }
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    public static function mdlIngresosPedidos($condicion)
    {
        if ($condicion == "anual") {
            $stmt = Conexion::conectar()->prepare("SELECT SUM(total) FROM pedidos where YEAR(fechaPedido)=YEAR(NOW())");
        } else if ($condicion == "mensual") {
            $stmt = Conexion::conectar()->prepare("SELECT SUM(total)  FROM pedidos where MONTH(fechaPedido)=MONTH(NOW()) AND YEAR(fechaPedido)=YEAR(NOW())");
        } else if ($condicion == "totales") {
            $stmt = Conexion::conectar()->prepare("SELECT SUM(total) FROM pedidos");
        }
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    public static function mdlPedidosDashboard($limit)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM pedidos order by idpedido desc LIMIT :limite");
        $stmt->bindParam(":limite", $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    public static function mdlUltimoProdCat($tabla)
    {
        if ($tabla == "productos") {
        $stmt = Conexion::conectar()->prepare("SELECT *  FROM productos order by idproducto desc LIMIT 1");
        } else if ($tabla == "categorias") {
            $stmt = Conexion::conectar()->prepare("SELECT *  FROM categorias order by idcategoria desc LIMIT 1");
        }
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }
}
