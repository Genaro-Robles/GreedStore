<?php
class Conexion{ 
    private $host="localhost";
    private $DB="greedstore_db";
    private $user="root";
    private $pass="";
    protected $conect;
    public static function conectar()
    {
        
        $self = new Conexion();

        $connectionString = "mysql:host=".$self->host.";dbname=".$self->DB.";charset=utf8";
        try {
            $self->conect = new PDO($connectionString,$self->user,$self->pass);
            $self->conect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $self->conect;
        } catch (Exception $e) {
            $self->conect = "Error en la conexion";
            echo "ERROR: ".$e->getMessage();
        }
        
    }
    
}
?>