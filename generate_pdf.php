<?php
//include connection file
include("databaze.php");
include('fpdf/fpdf.php');
 
ini_set('display_errors',1); 
error_reporting(E_ALL);

class PDF extends FPDF
{
// Page header
function Header()
{
    $this->SetFont('Times','B',13);
    // Title
    $this->Cell(180,10,'ID ------------------ Jmeno ----------- Druh ------------- Vek ------------------ e-mail',0,0,'L');
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
 
$sql = 'SELECT * FROM patient_log';
$result = $dbconn->query($sql);
if(!$result) {
    die('CHYBA DATABAZE: '.$dbconn->error);
  }
  $patient = $result->fetch_all(MYSQLI_ASSOC);

$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Times','',10);


foreach($patient as $row) {
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(35,12,$column,0);
}

$pdf->Output();

?>