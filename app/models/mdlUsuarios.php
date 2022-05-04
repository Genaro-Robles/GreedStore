<?php

// model users autentify

class mdlUsuarios{

    public function __construct(){
        if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    }

    public static function setSessionUser($correo, $nombre, $rol, $login = false){
        $_SESSION['correo'] = $correo;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['rol'] = $rol;
        $_SESSION['login'] = $login;
    }
    public static function getSessionUser(){
        return $_SESSION;
    }
    public static function getSessionUserName(){
        return $_SESSION['nombre'];
    }

    public static function auth(){
        return isset($_SESSION['login']) && $_SESSION['login'] == true;
    }
    public static function isAdmin(){
        return isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['rol'] == 2;
    }

    public static function destroy(){
        session_unset();
        session_destroy();
    }

}