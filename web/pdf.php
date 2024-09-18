<?php

$pdf = new FPDF('P', 'mm', array(250, 250)); 
$pdf->AddPage();

$pdf->SetLineWidth(0,1);
$pdf->SetDrawColor(200,200,200);
$pdf->SetFillColor(235,235,235);

$pdf->SetFont('Arial', '',8);
$pdf->Cell(77, 10, $pdf->Image("assets/img/logo.png", 15, 10, 25), 0, 0, 'C');

// $textoEmpresa = "Marroquineria SAS \n NIT 586033406-5 \n Calle 11 # 12-10";
$pdf->Cell(77, 5, "Marroquineria SAS", 0, 0, 'C');
$pdf->Cell(77, 5, "", 0, 1, 'C');
$pdf->Cell(77, 5, "", 0, 0, 'C');

$pdf->Cell(77, 5, "NIT 586033406-5", 0, 0, 'C');
$pdf->SetFont('Arial', '',12);
$pdf->Cell(77, 5, "Factura de venta", 0, 1, 'C');
$pdf->Cell(77, 5, "", 0, 0, 'C');

$pdf->SetFont('Arial', '',8);
$pdf->Cell(77, 5, "TEL: 5130612", 0, 0, 'C');
$pdf->SetFont('Arial', '',10);
$pdf->Cell(77, 5, "No. FEID"." ".$result[0]->getId(), 0, 1, 'C');

$pdf->Cell(77, 5, "", 0, 0, 'C');
$pdf->Cell(77, 5, "Calle 11 # 12-10", 0, 0, 'C');
$pdf->Cell(77, 5, "", 0, 1, 'C');

$pdf->SetFont('Arial', '',8);
$pdf->Cell(77, 5, "", 0, 0, 'C');
$pdf->Cell(77, 5, "Cali, Valle del Cauca", 0, 0, 'C');
$pdf->Cell(77, 5, "", 0, 0, 'C');

$pdf->Cell(194, 15, '',0, 1, 'L');
if($result[0]->getIdCliente()[0]->getTipoPersona() == 1){
    $tipoPersona = "Natural";
    $documento = "Documento: ";
    $widthDoc = "21";
}else{
    $tipoPersona = "Juridica";
    $documento = "NIT: ";
    $widthDoc = "8";
}

$pdf->SetFont('Arial', 'B', 8); 
$pdf->Cell(30,6, 'Nombre del cliente:',"T", 0, 'L',true);
$pdf->SetFont('Arial', '', 8); 
$pdf->Cell(201,6, "".$result[0]->getIdCliente()[0]->getnombreCliente(). " ". $result[0]->getIdCliente()[0]->getapellidoCliente()."" ,1, 1, 'L');

$pdf->SetFont('Arial', 'B', 8); // Fuente en negrita
$pdf->Cell(30,5, "NIT: ", "L", 0, 'L',true); // "NIT:" en negrita
$pdf->SetFont('Arial', '', 8); // Fuente normal
$pdf->Cell(80,5, $result[0]->getIdCliente()[0]->getDocumentoCliente(), 1, 0, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(40,5, "Telefono: ", "T", 0, 'L',true);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(81,5, "3135585553", 1, 1, 'L');

$pdf->SetFont('Arial', 'B', 8); 
$pdf->Cell(30,6, utf8_decode('Razón social:'),"L", 0, 'L', true);
$pdf->SetFont('Arial', '', 8); 
$pdf->Cell(80,6, $result[0]->getIdCliente()[0]->getRazonCliente() ,1, 0, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(40,6, "Direccion:", "L", 0, 'L', true);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(81,6, "CALLE 1A #42-112", 1, 1, 'L');

$pdf->SetFont('Arial', 'B', 8); 
$pdf->Cell(30,6, 'Tipo persona:',"LB", 0, 'L',true);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(80,6, $tipoPersona,1,0, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(40,6, "Correo: ", "LB", 0, 'L',true);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(81,6, "jaiberortiz2000@gmail.com", 1, 1, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(194,10, '  ',0, 1, 'C');
$pdf->Cell(46.2,8, utf8_decode('Descripción'),1, 0, 'C',true);
$pdf->Cell(46.2,8, utf8_decode('Código'),1, 0, 'C',true);
$pdf->Cell(46.2,8, 'Cantidad',1, 0, 'C',true);
$pdf->Cell(46.2,8, 'Precio Unitario',1, 0, 'C',true);
$pdf->Cell(46.2,8, 'Precio total producto',1, 1, 'C',true);

$pdf->SetFont('Arial', '', 8);
$subTotal = 0;
foreach ($ventas_detalle as $producto) {
    $pdf->Cell(46.2, 6, $producto->getIdProducto()[0]->getDescripcion(), 1, 0, 'C');
    $pdf->Cell(46.2, 6, $producto->getIdProducto()[0]->getCodigo(), 1, 0, 'C');
    $pdf->Cell(46.2, 6, $producto->getCantidadProducto(), 1, 0, 'C');
    $pdf->Cell(46.2, 6, "$ ".number_format($producto->getTotalProducto(),0,",","."), 1, 0, 'C');
    $pdf->Cell(46.2, 6, "$ ".number_format($producto->getTotalProducto() * $producto->getCantidadProducto(),0,",","."), 1, 1, 'C');

    $subTotal += $producto->getTotalProducto()* $producto->getCantidadProducto();
}

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(184.8,8, 'Subtotal ',0, 0, 'R');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(46.2,8, "$ ".number_format($subTotal,0,",",".") ,"LR", 1, 'C');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(184.8,8, 'Iva (19%) ',0, 0, 'R');
$totalIva = calcularIVA($subTotal,19);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(46.2,8, "$ ".number_format(round($totalIva['montoIVA']),0,",","."),"LR", 1, 'C');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(184.8,8, 'Total ',0, 0, 'R');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(46.2,8, "$ ".number_format($result[0]->getTotal(),0,",","."),1, 1, 'C',true);

$pdf->Cell(231,20,"",0,1);
$terminosCondiciones = utf8_decode("Términos y Condiciones: No se aceptan devoluciones después de 15 días de la entrega. Los precios incluyen/n o " .
            "excluyen/n los impuestos aplicables. La garantía cubre defectos de fábrica por un período de 12 meses.");
$pdf->MultiCell(231,5,$terminosCondiciones,0,"C",TRUE);

$pdf->Output();