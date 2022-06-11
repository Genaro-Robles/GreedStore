<?php

class CtrPedidos
{

    public static function ctrAgregarPedido()
    {
        if (!isset($_POST['subtotal'], $_POST['igv'], $_POST['total'], $_POST['FechaE'], $_POST['correo'], $_POST['TipoEntrega'])) {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }
        // Crear nuestro array de información del nuevo juego
        $id = MdlUsuarios::mdlIdUsuario($_POST['correo']);
        
        $new_pedido =
            [
                'idusuario'    => intval($id['id']),
                'subtotal'    => floatval($_POST['subtotal']),
                'igv'        => floatval($_POST['igv']),
                'total'        => intval($_POST['total']),
                'tipoEntrega'        => clean_string($_POST['TipoEntrega']),
                'fechaEntrega'        => $_POST['FechaE']
            ];

        // Guardar en la base de datos
        if (!MdlPedidos::mdlIngresarPedido($new_pedido)) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }
        json_output(201, 'Nuevo pedido agregado con éxito');
    }

    public static function ctrAgregarDetallePedido()
    {
        if (!isset($_POST['idproducto'], $_POST['precio'], $_POST['cantidad'], $_POST['importe'])) {
            json_output(400, 'Completa el formulario por favor e intenta de nuevo');
        }
        // Crear nuestro array de información del nuevo juego
        $pedido = MdlPedidos::mdlUltimoPedido();
        
        $new_detalle =
            [
                'idpedido'    => intval($pedido['idpedido']),
                'idproducto'    => intval($_POST['idproducto']),
                'precioU'    => floatval($_POST['precio']),
                'cantidad'        => intval($_POST['cantidad']),
                'importe'        => floatval($_POST['importe'])
            ];

        // Guardar en la base de datos
        if (!MdlPedidos::mdlIngresarDetallePedido($new_detalle)) {
            json_output(400, 'Hubo un problema, intenta de nuevo');
        }
        json_output(201, 'Nuevo detalle agregado con éxito');
    }

    public static function ctrGetBoleta()
    {
        $idp = mdlPedidos::mdlUltimoPedido();
        return MdlPedidos::mdlGetPedidoBoleta($idp['idpedido']);
    }

    public static function ctrGetDetallesBoleta()
    {
        $idp = mdlPedidos::mdlUltimoPedido();
        return MdlPedidos::mdlGetDetallesBoleta($idp['idpedido']);
    }
}
?>