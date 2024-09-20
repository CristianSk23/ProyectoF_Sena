<?php
require_once '../lib/fpdf186/fpdf.php';

$pdf = new FPDF('P', 'mm', array(300, 300)); 
$pdf->AddPage();

$pdf->SetLineWidth(0,1);
$pdf->SetDrawColor(173, 216, 230); // Color de líneas (azul claro)
$pdf->SetFillColor(173, 216, 230); // Color de relleno (azul claro)

$pdf->SetFont('Arial', '', 8);
$pdf->Ln(10);
$pdf->Ln(10);
$pdf->Cell(77, 10, $pdf->Image("images/icons/ntrSport Logo1.png", 15, 10, 45), 0, 0, 'C');

// Información del vendedor
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(80, 10, 'No.Factura ' . utf8_decode($respuesta['factura']['idVenta']), 1, 0, 'C', 'true');

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, utf8_decode('Natural Sport'), 0, 2, 'R'); // Primera línea
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, utf8_decode('Carrera 32A No. 34B 04'), 0, 2, 'R'); // Segunda línea
$pdf->Cell(0, 10, utf8_decode('Tel: +57 800 1236879'), 0, 2, 'R'); // Tercera línea
$pdf->Cell(0, 10, utf8_decode('naturalsportwear@gmail.com'), 0, 1, 'R'); // Cuarta línea
$pdf->Ln(10); // Espacio adicional si es necesario

// Información del cliente
$pdf->Cell(0, 10, utf8_decode('Cliente: ') . "\n" . utf8_decode($respuesta['usuario']['usu_nombre']) . "\n" . utf8_decode($respuesta['usuario']['usu_apellido']), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Direccion de envio: ') . "\n" . utf8_decode($respuesta['factura']['direccion_Envio']), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Metodo de pago: ') . "\n" . utf8_decode($respuesta['factura']['descripcionMetodo_pago']), 0, 1);
$pdf->Ln(10);

// Tabla de productos
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 10, utf8_decode('Producto'), 1, 0, 'C', 'true');
$pdf->Cell(30, 10, utf8_decode('Talla'), 1, 0, 'C', 'true');
$pdf->Cell(30, 10, utf8_decode('Color'), 1, 0, 'C', 'true');
$pdf->Cell(30, 10, utf8_decode('Cantidad'), 1, 0, 'C', 'true');
$pdf->Cell(30, 10, utf8_decode('Precio'), 1, 0, 'C', 'true');
$pdf->Cell(30, 10, utf8_decode('Total'), 1, 0, 'C', 'true');
$pdf->Ln();

foreach ($respuesta['productos'] as $producto) {
    $pdf->Cell(90, 10, utf8_decode($producto['product_nombre']), 1);
    $pdf->Cell(30, 10, utf8_decode($producto['stock_talla']), 1);
    $pdf->Cell(30, 10, utf8_decode($producto['stock_color']), 1);
    $pdf->Cell(30, 10, utf8_decode($producto['cantidad_Producto']), 1);
    $pdf->Cell(30, 10, '$' . number_format($producto['stock_precio'], 2), 1);
    $pdf->Cell(30, 10, '$' . number_format($producto['stock_precio'] * $producto['cantidad_Producto'], 2), 1);
    $pdf->Ln();
}

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 10, '', 0);
$pdf->Cell(30, 10, '', 0);
$pdf->Cell(30, 10, '', 0);
$pdf->Cell(30, 10, '', 0);
$pdf->Cell(30, 10, utf8_decode('Envio'), 1, 0, 'C', 'true'); 
$pdf->Cell(30, 10, '$' . number_format($respuesta['factura']['ciu_precioenvio'], 2), 1);
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 10, '', 0);
$pdf->Cell(30, 10, '', 0);
$pdf->Cell(30, 10, '', 0);
$pdf->Cell(30, 10, '', 0);
$pdf->Cell(30, 10, utf8_decode('SubTotal'), 1, 0, 'C', 'true'); 
$pdf->Cell(30, 10, '$' . number_format($respuesta['factura']['totalVenta'], 2), 1);
$pdf->Ln();

// Salida del PDF
$pdf->Output('I', 'factura.pdf');
