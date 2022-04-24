<?php

//configuracion::configuracion_inicial();

const URL_MAIN = "http://localhost/GreedStore/";
require_once "app/models/mdlProductos.php";
require_once "app/controllers/ctrProductos.php";
require_once "app/models/mdlCategorias.php";
require_once "app/controllers/ctrCategorias.php";
$ListCat = CtrCategorias::ctrListar('');

if (isset($_GET['view'])) {

    $get = $_GET["view"];
    $url = rtrim($get, '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url2 = explode('/', $url);
    
    include 'templates/includes/header.php';

    if (sizeof($url2) == 1) {
        $url2[0]=str_replace('-',' ',$url2[0]);
        if(CtrCategorias::ctrListar($url2[0])){
            $file = "templates/views/main.php";
            $cat = $url2[0];
        }else{
            $file = "templates/views/" . $url2[0] . ".php";
        }
        if (file_exists($file)) {
            
            include $file;
        } else {
            echo 'error no existe 1';
        }
    } else if (sizeof($url2) == 2) {
        if(is_numeric($url2[1])){
            $file = "templates/views/" . $url2[0] . ".php";
            $idp = $url2[1];
        }else{
            $file = "templates/views/" . $url2[0] . "/" . $url2[1] . ".php";
        }
        if (file_exists($file)) {
            include $file;
        } else {
            echo 'no existe 2';
        }
    } else if (sizeof($url2) == 3) {
        $file = "templates/views/" . $url2[0] . "/" . $url2[1] . "/" . $url2[2] . ".php";
        if (file_exists($file)) {
            include $file;
        } else {
            echo 'error';
        }
    } else if (sizeof($url2) == 4) {
        $file = "templates/views/" . $url2[0] . "/" . $url2[1] . "/" . $url2[2] . "/" . $url2[3] . ".php";
        if (file_exists($file)) {
            include $file;
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
    include 'templates/includes/footer.php';
} else if (isset($_GET['ruta'])) {
} else {
    include 'templates/includes/header.php';
    include 'templates/views/main.php';
    include 'templates/includes/footer.php';
}
