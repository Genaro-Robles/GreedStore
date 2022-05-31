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
            $stmt = Conexion::conectar()->prepare("SELECT p.* FROM productos p inner join categorias c on p.categoria=c.idcategoria where c.nombre_categoria=:categoria and p.estado = 1  order by idproducto desc LIMIT 8");
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
        $stmt = Conexion::conectar()->prepare("SELECT idproducto, nombre, descripcion, categoria, stock, precio, estado, foto_producto FROM productos where idproducto = :producto");
        $stmt->bindParam(":producto", $id, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    /*  *******************************
                LISTAR RELACIONADOS
        ******************************* */

    public static function mdlListarRelacionados($id, $categoria)
    {
        require_once "conexion.php";
        $stmt = Conexion::conectar()->prepare("SELECT * FROM productos where categoria = :categoria AND idproducto != :producto");
        $stmt->bindParam(":producto", $id, PDO::PARAM_STR);
        $stmt->bindParam(":categoria", $categoria, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    /*  ************************
                LISTAR POR
        ************************ */

    public static function mdlListarPor($nombre, $orden)
    {
        require_once "conexion.php";
        $consulta = "SELECT p.*,c.nombre_categoria FROM productos p inner join categorias c on p.categoria=c.idcategoria";
        $stmt = Conexion::conectar()->prepare($consulta);
        if ($nombre != "" && $orden != "Sin filtro") {
            $stmt = Conexion::conectar()->prepare($consulta);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':orden', $orden, PDO::PARAM_STR);
        } else if ($nombre != "") {
            $consulta .= " where p.nombre LIKE :nombre";
            $nombre = "%" . $nombre . "%";
            $stmt = Conexion::conectar()->prepare($consulta);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        } else if ($orden != "Sin filtro") {
            $consulta .= " order by :orden";
            $stmt = Conexion::conectar()->prepare($consulta);
            $stmt->bindParam(':orden', $orden, PDO::PARAM_STR);
        }
        //var_dump($consulta);
        $stmt->execute();

        $salida = "";
        if ($stmt->rowCount() > 0) {
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $salida .= "<table class='table table-responsive table-bordered border-dark'>
            <thead class='thead-colored thead-dark'>
              <th>NOMBRE</th>
              <th>IMAGEN</th>
              <th>CATEGORIA</th>
              <th>STOCK</th>
              <th>PRECIO</th>
              <th>ESTADO</th>
              <th>ACCIONES</th>
            </thead>
            <tbody>";
            foreach ($productos as $key => $value) {
                $salida .= "<tr>
                <td>" . $value['nombre'] . "</td>
                <td><a href='" . URL_MAIN . UPLOADS . $value['foto_producto'] . "' data-fancybox='gallery'><img class='' width='190px' id='FotoP' height='116px' src='" . URL_MAIN . UPLOADS . $value['foto_producto'] . "' /></a></td>
                <td>" . $value['nombre_categoria'] . "</td>
                <td>" . $value['stock'] . "</td>
                <td>" . $value['precio'] . "</td>
                <td>
                    <div class='badge text-wrap " . ($value['estado'] == 1 ? "bg-success" : "bg-danger") . "' style='width: 6rem;' id='estado'>
                        " . ($value['estado'] == 1 ? "Activo" : "Inactivo") . "
                    </div>
                </td>
                <td>
                    <div class='d-flex flex-column gap-2'>
                        <button class='btn  btn-teal btn-view-producto mg-b-10' data-idpro='" . $value['idproducto'] . "'><i class='fa fa-refresh'></i> Actualizar</button>
                        <button class='btn  btn-danger btn-action-producto' data-action='" . ($value['estado'] == 1 ? "eliminar" : "restaurar") . "' data-idpro='" . $value['idproducto'] . "'><i class='icon ion-trash-a'></i> " . ($value['estado'] == 1 ? "Eliminar" : "Restaurar") . "</button>
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
    public static function mdlAgregarProducto($array = [])
    {
        return insert_new('productos', $array);
    }
    public static function mdlActualizarProducto($key = [], $array = [])
    {
        return update_record('productos', $key, $array);
    }
    public static function mdlEliminarProducto($key = [], $array = [])
    {
        return update_record('productos', $key, $array);
    }
}
