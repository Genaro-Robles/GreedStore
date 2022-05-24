<?php
class Conexion
{
    private $host = "localhost";
    private $DB = "greedstore_db";
    private $user = "root";
    private $pass = "";
    protected $conect;
    public static function conectar()
    {

        $self = new Conexion();

        $connectionString = "mysql:host=" . $self->host . ";dbname=" . $self->DB . ";charset=utf8";
        try {
            $self->conect = new PDO($connectionString, $self->user, $self->pass);
            $self->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $self->conect;
        } catch (Exception $e) {
            $self->conect = "Error en la conexion";
            echo "ERROR: " . $e->getMessage();
        }
    }

    public static function query_db($stmt, $params = [], $debug = false)
    {
        $con = self::conectar();

        // Necesitamos preparar nuestro enunciado o consulta
        $query = $con->prepare($stmt);

        // Vamos a ejecutar la información dentro de query ($stmt)
        // INSERT INTO usuarios (nombre , email) VALUES (:nombre , :email)
        if (!$query->execute($params)) {
            // TODO SI SALE MAL
            // NO PUDO INSERTARSE
            // NO PUDO BORRARSE
            // NO PUDO ACTUALIZARSE
            // NO PUDO EJECUTARSE LA SELECCIÓN
            if ($debug) {
                $error = $query->errorInfo();
                echo $error[0] . '<br>';
                echo $error[1] . '<br>';
                echo $error[2];
            }

            return false;
        }

        // TODO SI SALE BIEN
        // HAY O NO HAY RESULTADOS
        // SE INSERTO EL REGISTRO
        // SE ACTUALIZO 0 O MÁS COLUMNAS
        // SE BORRO ÉXITO 0 MÁS COLUMNAS
        // CRUD
        $count = 0;
        $count = $query->rowCount();

        if (strpos($stmt, 'SELECT') !== false) {
            // Selección o busqueda de información
            // Necesitamos contar los resultados encontrados y regresarlos
            if ($count > 0) {
                return $query->fetchAll();
            }
            return false;
        } elseif (strpos($stmt, 'INSERT INTO') !== false) {
            // Necesitamos regresar el id de la fila insertada
            if ($count > 0) {
                return $con->lastInsertId();
            }
            return false;
        } elseif (strpos($stmt, 'UPDATE') !== false) {
            // Necesitamos contar cuantos registros se actualizaron y si son 0 o más
            // regresamos true
            if ($count >= 0) {
                return true;
            }
        } elseif (strpos($stmt, 'DELETE') !== false) {
            // Regresar true si son 0 o más filas afectadas
            if ($count > 0) {
                return true;
            }
            return false;
        }
        return true;
    }
}
