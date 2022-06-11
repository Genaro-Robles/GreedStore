<?php

// model users autentify

class MdlUsuarios
{

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    }

    public static function setSessionUser($id, $correo, $nombre, $perfil, $rol = 1)
    {
        $_SESSION['id'] = $id;
        $_SESSION['correo'] = $correo;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['rol'] = $rol;
        $_SESSION['login'] = true;
        $_SESSION['perfil'] = $perfil ?? "default-profile.jpg";
    }
    public static function getSessionUser()
    {
        return $_SESSION;
    }
        public static function getSessionUserName()
        {
            return $_SESSION['nombre'];
        }

    public static function auth()
    {
        return isset($_SESSION['login']) && $_SESSION['login'] == true;
    }
    public static function isAdmin()
    {
        return isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['rol'] == 2;
    }

    public static function destroy()
    {
        session_unset();
        session_destroy();
    }
    public static function mdlListarPor()
    {
        require_once "conexion.php";
        $consulta = "SELECT u.*,r.rol FROM usuarios u inner join roles r on u.id_rol=r.id";
        $stmt = Conexion::conectar()->prepare($consulta);
        $stmt->execute();
        $salida = "";
        if ($stmt->rowCount() > 0) {
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $salida .= "<table class='table table-responsive table-bordered border-dark'>
            <thead class='thead-colored thead-dark'>
              <th>ID</th>
              <th>NOMBRE</th>
              <th>IMAGEN</th>
              <th>CORREO</th>
              <th>ROL</th>
              <th>METODO</th>
              <th>ESTADO</th>
              <th>ACCIONES</th>
            </thead>
            <tbody>";
            foreach ($usuarios as $key => $value) {

                $salida .= "<tr>
                <td>" . $value['id'] . "</td>
                <td>" . $value['nombre_apellido'] . "</td>
                <td>
                    <a href='" . URL_MAIN.UPLOADS.$value["perfil"]. "' data-fancybox='gallery'><img class='' width='190px' id='FotoP' height='116px' src='".URL_MAIN.UPLOADS.$value["perfil"]. "' /></a>
                </td>
                <td>" . $value['correo'] . "</td>
                <td>" . $value['rol'] . "</td>
                <td>" . $value['metodo'] . "</td>
                <td>
                    <div class='badge text-wrap " . ($value['estado'] == 1 ? "bg-success" : "bg-danger") . "' style='width: 6rem;' id='estado'>
                    " . ($value['estado'] == 1 ? "Activo" : "Inactivo") . "
                    </div>
                </td>
                <td>
                  <button class='btn btn-teal btn-view' data-iduser='" . $value['id'] . "'><i class='icon ion-eye'></i> Ver</button>
                  <button class='btn  btn-danger btn-action-user' data-action='" . ($value['estado'] == 1 ? "banear" : "desbanear") . "' data-iduser='" . $value['id'] . "'><i class='fa fa-gavel'></i> " . ($value['estado'] == 1 ? "Banear" : "Desbanear") . "</button>
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

    public static function mdlListarUsuario($id)
    {
        require_once "conexion.php";
        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios where id = :usuario");
        $stmt->bindParam(":usuario", $id, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }
    public static function mdlRegistrarUsuario($array = [])
    {
        $respuesta = get_by_id('usuarios', ['correo' => $array['correo']]);
        if (is_array($respuesta) && count($respuesta) > 0) {
            return false;
        }
        return insert_new('usuarios', $array);
    }
    public static function mdlActualizarUsuario($key = [], $array = [])
    {
        return update_record('usuarios', $key, $array);
    }
    public static function mdlLoginUsuario($array = [])
    {
        $respuesta = get_by_id('usuarios', ['correo' => $array['correo']]);
        return (is_array($respuesta) && count($respuesta) > 0) ? $respuesta : false;
    }

    public static function mdlIdUsuario($correo)
    {
        require_once "conexion.php";
        $stmt = Conexion::conectar()->prepare("SELECT id FROM usuarios where correo = :correo");
        $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }
}
