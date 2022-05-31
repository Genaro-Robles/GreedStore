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
        } else if ($categoria != "") {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM categorias where nombre_categoria=:nombre_categoria");
            $stmt->bindParam(":nombre_categoria", $categoria, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM categorias WHERE estado = 1 ORDER BY idcategoria ASC");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        $stmt = null;
    }
    public static function mdlListarCategorias()
    {
        require_once "conexion.php";

        $stmt = Conexion::conectar()->prepare("SELECT idcategoria,nombre_categoria, foto_categoria, descripcion_categoria FROM categorias WHERE estado = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }
    public static function mdlListarCategoriasTabla()
    {
        require_once "conexion.php";
        $consulta = "SELECT idcategoria,nombre_categoria, foto_categoria, descripcion_categoria, estado FROM categorias";
        $stmt = Conexion::conectar()->prepare($consulta);
        $stmt->execute();
        $salida = "";
        if ($stmt->rowCount() > 0) {
            $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $salida .= "<table class='table table-responsive table-bordered border-dark'>
            <thead class='thead-colored thead-dark'>
              <th>ID</th>
              <th>NOMBRE</th>
              <th>IMAGEN</th>
              <th>DESCRIPCION</th>
              <th>ESTADO</th>
              <th>ACCIONES</th>
            </thead>
            <tbody>";
            foreach ($categorias as $key => $value) {
                $salida .= "<tr>
                <td>" . $value['idcategoria'] . "</td>
                <td>" . $value['nombre_categoria'] . "</td>
                <td><a href='" . URL_MAIN . UPLOADS . $value['foto_categoria'] . "' data-fancybox='gallery'><img class='' width='190px' id='FotoP' height='116px' src='" . URL_MAIN . UPLOADS . $value['foto_categoria'] . "' /></a></td>
                <td>" . $value['descripcion_categoria'] . "</td>
                <td>
                    <div class='badge text-wrap " . ($value['estado'] == 1 ? "bg-success" : "bg-danger") . "' style='width: 6rem;' id='estado'>
                        " . ($value['estado'] == 1 ? "Activo" : "Inactivo") . "
                    </div>
                </td>
                <td>
                    <div class='d-flex flex-column gap-2'>
                        <button class='btn btn-teal btn-view-categoria mg-b-10' data-idcate='" . $value['idcategoria'] . "'><i class='fa fa-refresh'></i> Actualizar</button>
                        <button class='btn  btn-danger btn-action-categoria' data-action='" . ($value['estado'] == 1 ? "eliminar" : "restaurar") . "' data-idcate='" . $value['idcategoria'] . "'><i class='icon ion-trash-a'></i> " . ($value['estado'] == 1 ? "Eliminar" : "Restaurar") . "</button>
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
    public static function mdlAgregarCategoria($array = [])
    {
        return insert_new('categorias', $array);
    }
    public static function mdlActualizarCategoria($key = [], $array = [])
    {
        return update_record('categorias', $key, $array);
    }
    public static function mdlEliminarCategoria($key = [], $array = [])
    {
        return update_record('categorias', $key, $array);
    }
    public static function mdlListarCategoriaTabla($key = [])
    {

        // ! buscamos la categoria
        $respuesta = get_by_id('categorias', $key);
        // ! validamos si existe
        if (empty($respuesta[0])) json_output(400, 'No hay datos');
        // ! para insertar en el atributo class comvertimos el 
        // !string a minus y reemplazamos los espacios en blanco
        $clase = strtolower($respuesta[0]["nombre_categoria"]);
        $clase = str_replace(' ', '-', $clase);

        // ! generamos los array para los detalles
        $detalle = rtrim($respuesta[0]['descripcion_categoria'], '/');
        $detalle = filter_var($detalle, FILTER_SANITIZE_STRING);
        $detalle = explode('/', $detalle);

        $salida = "";

        // ! generamos el html
        $salida .= "
            <h4 class='card-title text-primary' id='titulodetalles'>Detalles " . $respuesta[0]["nombre_categoria"] . "</h4>
            <div class='row " . $clase . "'>";
        for ($i = 0; $i < sizeof($detalle); $i++) :
            $salida .= "
                    <div class='col-md-3'>
                        <label>" . $detalle[$i] . "</label>
                        <input type='text' name='" . strtolower($detalle[$i]) . "' class='form-control detalle-producto' placeholder='Ingresar " . $detalle[$i] . "'>
                    </div>";
        endfor;
        $salida .= "</div>";
        // ! retornamos el html
        return $salida;
    }
}
