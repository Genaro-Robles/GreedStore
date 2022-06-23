<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if($_POST['pedido']){
	if($_POST['pedido'] == "nuevo"){
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

class PDF extends FPDF
{
	// Cabecera de p�gina
	function Header()
	{
		// Logo
		$this->Image(URL_MAIN . 'assets/img/logo-bg-max.png', 10, 8, 33);
		// Arial bold 15
		$this->SetFont('Arial', 'B', 15);
		// Movernos a la derecha
		$this->Cell(70);
		// T�tulo
		$this->Cell(50, 10, 'Boleta de venta', 1, 0, 'C');
		// Salto de l�nea
		$this->Ln(20);
	}

	// Pie de p�gina
	function Footer()
	{
		// Posici�n: a 1,5 cm del final
		$this->SetY(-25);
		$this->Cell(0, 5, 'MUCHAS GRACIAS POR SU COMPRA', 0, 1, 'C');
		$this->Cell(0, 5, utf8_decode('GREEDSTORE tu tienda online experta en tecnología con un servicio 5 estrellas'), 0, 1, 'C');
		// Arial italic 8
		$this->SetFont('Arial', 'I', 8);
		// N�mero de p�gina
		$this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}
}

// Creaci�n del objeto de la clase heredada

$boleta = CtrPedidos::ctrGetBoleta();
$detalle = CtrPedidos::ctrGetDetallesBoleta();
$cliente = MdlUsuarios::mdlListarUsuario($boleta['idusuario']);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 10, utf8_decode('C. Barbara D\'Achile 230, Surquillo 15038'), 0, 1, "C");
$pdf->Cell(0, 10, utf8_decode('LIMA-LIMA-SURQUILLO'), 0, 1, "C");
$pdf->Cell(0, 10, utf8_decode('RUC: 23063285199'), 0, 1, "C");
$pdf->Cell(0, 10, utf8_decode('TELÉFONO: +51994870247'), 0, 1, "C");
$pdf->Cell(0, 5, utf8_decode('==================================='), 0, 1, "C");
$pdf->Cell(0, 5, utf8_decode('FECHA DE EMISION: ') . $boleta['fechaPedido'], 0, 1, "C");
$pdf->Cell(0, 5, utf8_decode('CLIENTE: ') . $cliente['nombre_apellido'], 0, 1, "C");
$pdf->Cell(0, 5, utf8_decode('TIPO DE ENTREGA: ') . $boleta['tipoEntrega'], 0, 1, "C");
$pdf->Cell(0, 5, utf8_decode('FECHA DE LLEGADA: ') . $boleta['fechaEntrega'], 0, 1, "C");
$pdf->Cell(0, 5, utf8_decode('==================================='), 0, 1, "C");
$pdf->SetLeftMargin(20);
$pdf->Cell(80, 5, utf8_decode('PRODUCTO: '), 0, 0, "");
$pdf->Cell(30, 5, utf8_decode('PRECIO: '), 0, 0, "C");
$pdf->Cell(30, 5, utf8_decode('CANTIDAD: '), 0, 0, "C");
$pdf->Cell(30, 5, utf8_decode('IMPORTE: '), 0, 0, "C");
$pdf->Ln();

foreach ($detalle as $detalleB) {
	$nombrep = CtrProductos::ctrNombreItem($detalleB['idproducto']);
	$pdf->Cell(80, 5, $nombrep, 0, 0,"");
	$pdf->Cell(30, 5, "S/. ".$detalleB['precioU'], 0, 0, "C");
	$pdf->Cell(30, 5, $detalleB['cantidad'], 0, 0, "C");
	$pdf->Cell(30, 5, $detalleB['importe'], 0, 0, "C");
	$pdf->Ln();
}
$pdf->Ln(10);
$pdf->Cell(80, 5, '', 0, 0, "C");
$pdf->Cell(30, 5, '', 0, 0, "C");
$pdf->Cell(30, 5, 'Subtotal: ', 0, 0, "C");
$pdf->Cell(30, 5, 'S/. '.$boleta['subtotal'], 0, 0, "C");
$pdf->Ln();
$pdf->Cell(80, 5, '', 0, 0, "C");
$pdf->Cell(30, 5, '', 0, 0, "C");
$pdf->Cell(30, 5, 'IGV(18%): ', 0, 0, "C");
$pdf->Cell(30, 5, 'S/. '.$boleta['igv'], 0, 0, "C");
$pdf->Ln();
$pdf->Cell(80, 5, '', 0, 0, "C");
$pdf->Cell(30, 5, '', 0, 0, "C");
$pdf->Cell(30, 5, 'Total: ', 0, 0, "C");
$pdf->Cell(30, 5, 'S/. '.$boleta['total'], 0, 0, "C");
$pdf->Ln();
$doc = $pdf->Output("S");
//$pdf->Output("I");

try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'tucorreo@gmail.com';                     //SMTP username
    $mail->Password   = 'tucontraseña';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('tucorreo@gmail.com', 'GreedStore');
    $mail->addAddress($cliente['correo']);     //Add a recipient

    //Attachments
    $mail->AddStringAttachment($doc, 'boleta.pdf'); //Add attachments/Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Boleta de Pedido #'.$boleta['idpedido'];
    $mail->Body    = 'Se adjunta la boleta por su pedido';

    if($mail->send()){
		header("Location: ".URL_MAIN);
	}
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}else{
	echo "Error no existe";
}
}else{
	echo "error no es nuevo";
}
