<?php

require('../pdf/fpdf.php');
require_once('../Datos/Connection.php');
require_once('../Modelo/Busqueda.php');
require_once('../Modelo/descripcion.php');

$busqueda  = new Busqueda();
$des  = new descripcion_model();

class PDF extends FPDF
{
  // Cabecera de página
  function Header()
  {
      // Logo
      //  $this->Image('logo.png',10,8,33);
      // Arial bold 15
      $this->SetFont('Arial','B',15);
      // Movernos a la derecha
      $this->Cell(80);
      // Título
      $this->Cell(30,10,'Detalle',0,0,'C');
      // Salto de línea
      $this->Ln(20);
    }
    // Tabla simple
    function BasicTable($header, $data)
    {
        // Cabecera
        foreach($header as $col)
            $this->Cell(40,7,$col,1);
        $this->Ln();
        // Datos
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(40,6,$col,1);
            $this->Ln();
        }
    }
    // Pie de página
    function Footer()
    {
      // Posición: a 1,5 cm del final
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial','I',8);
      // Número de página
      $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$x = $_GET['codigo'];

if($des->Existe($x)){
  $buscar = $busqueda->BuscarDetalle($x);
  foreach ($buscar as $fol) {
    $folio     = $fol ['codFolio'];    $numero    = $fol ['codnumero'];    $codigo    = $fol ['codS'];
    $detalle   = $fol ['descripcion']; $fecha     = $fol ['fecha'];        $cliente   = $fol ['nomcliente'];
    $solicitud = $fol ['nombre'];      $nombreen  = $fol ['nomencargado']; $apellido  = $fol ['apellido'];
    $numS      = $fol ['numsal'];      $nfecha    = $fol ['fesal'];        $estado    = $fol ['estado'];
  }
}
else{
  $BuscarFol = $busqueda->get_BusquedaFolio($x);
  foreach ($BuscarFol as $fol){
    $folio     = $fol ['codFolio'];    $numero    = $fol ['codnumero'];    $codigo    = $fol ['codS'];
    $detalle   = $fol ['descripcion']; $fecha     = $fol ['fecha'];        $cliente   = $fol ['nomcliente'];
    $solicitud = $fol ['nombre'];      $nombreen  = $fol ['nomencargado']; $apellido  = $fol ['apellido'];
    $estado = $fol ['estado'];         $numS      = ''; $nfecha = "";
  }
}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
//$pdf->Cell(70,10, $x, 0,1,'L',0);
$pdf->Cell(20);
$pdf->Cell(70,10, 'SC', 0,0,'L',0);
$pdf->Cell(70,10, $folio, 0,1,'L',0);
$pdf->Cell(20);
$pdf->Cell(70,10, utf8_decode('N° Guia Entrada'), 0,0,'L',0);
$pdf->Cell(70,10, $numero, 0,1,'L',0);
$pdf->Cell(20);
$pdf->Cell(70,10, 'Codigo Solped', 0,0,'L',0);
$pdf->Cell(70,10, $codigo, 0,1,'L',0);
$pdf->Cell(20);
$pdf->Cell(70,10, 'Detalle', 0,0,'L',0);
$pdf->Cell(70,10, $detalle, 0,1,'L',0);
$pdf->Cell(20);
$pdf->Cell(70,10, 'Fecha Ingreso', 0,0,'L',0);
$pdf->Cell(70,10, $fecha, 0,1,'L',0);
$pdf->Cell(20);
$pdf->Cell(70,10, 'Tipo Solicitud', 0,0,'L',0);
$pdf->Cell(70,10, $solicitud, 0,1,'L',0);
$pdf->Cell(20);
$pdf->Cell(70,10, 'Cliente', 0,0,'L',0);
$pdf->Cell(70,10, $cliente, 0,1,'L',0);
$pdf->Cell(20);
$pdf->Cell(70,10, 'Estado', 0,0,'L',0);
$pdf->Cell(70,10, $estado, 0,1,'L',0);
$pdf->Cell(20);
$pdf->Cell(70,10, 'Encargado Ingreso', 0,0,'L',0);
$pdf->Cell(70,10, $nombreen.' '.$apellido, 0,1,'L',0);
$pdf->Cell(20);
$pdf->Cell(70,10, utf8_decode('N° Guia Salida'), 0,0,'L',0);
$pdf->Cell(70,10, $numS, 0,1,'L',0);
$pdf->Cell(20);
$pdf->Cell(70,10, 'Fecha de Egreso', 0,0,'L',0);
$pdf->Cell(70,10, $nfecha, 0,1,'L',0);

$imagenes= $des->MostrarImagen($folio);
$header = array('País', 'Capital', 'Superficie (km2)', 'Pobl. (en miles)');
foreach ($imagenes as  $i){
  $direccion =  $i['imagen']; $id = $i['codimg']; $descipcion = $i['descripcion'];
  $pdf->Image('../imagenes/1img2.jpg',30,150,50);
  $pdf->Cell(70,10,$descipcion, 0,1,'L',0);
}

$pdf->Output();

 ?>
