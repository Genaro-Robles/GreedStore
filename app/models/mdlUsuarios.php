<?php

// model users autentify

class MdlUsuarios
{

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    }

    public static function setSessionUser($correo, $nombre, $rol, $perfil, $login = false)
    {
        $_SESSION['correo'] = $correo;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['rol'] = $rol ?? 1;
        $_SESSION['login'] = $login;
        $_SESSION['perfil'] = $perfil ?? "";
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
            $salida .= "<table class='table table-hover'>
            <thead>
              <th>ID</th>
              <th>NOMBRE</th>
              <th>IMAGEN</th>
              <th>CORREO</th>
              <th>ROL</th>
              <th>METODO</th>
              <th></th>
            </thead>
            <tbody>";
            foreach ($usuarios as $key => $value) {
                $salida .= "<tr>
                <td>" . $value['id'] . "</td>
                <td>" . $value['nombre_apellido'] . "</td>
                <td><img class='' width='203px' id='FotoP' height='136px' src='data:image/png;base64," . base64_encode($value['perfil']) . "' /></td>
                <td>" . $value['correo'] . "</td>
                <td>" . $value['rol'] . "</td>
                <td>" . $value['metodo'] . "</td>
                <td>
                  <button class='btn btn-success btn-view' data-iduser=" . $value['id'] . ">Visualizar</button>
                  <a href='#' class='btn btn-danger'>Banear</a>
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
        $stmt = Conexion::conectar()->prepare("SELECT id, nombre_apellido, correo , id_rol , metodo, estado FROM usuarios where id = :usuario");
        $stmt->bindParam(":usuario", $id, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }
}
