<?php

class configuracion{
    public static function configuracion_inicial(){
        if (isset($_GET["ruta"])) {
            $get = $_GET["ruta"];
            $ruta  = rtrim($get, '/'); 
            $ruta = filter_var($ruta, FILTER_SANITIZE_URL);
            $ruta2 = explode('/', $ruta);
            if (class_exists("Ctr".$ruta2[0])) {
                $clase = "Ctr".$ruta2[0];
                $objeto = new $clase;
                if(method_exists( $objeto, "ctr".$ruta2[1])){
                    $objeto -> {"ctr".$ruta2[1]}();
                }else{
                    echo "ERROR DE MÉTODO";
                }
            }
        }
    }
}

?>
