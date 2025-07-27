<?php
require('fpdf.php');

// Collect booking details
$name       = $_POST["name"] ?? 'Devotee';
$temple     = $_POST["temple"] ?? 'N/A';
$type       = $_POST["darshan_type"] ?? 'General';
$time       = $_POST["time"] ?? 'N/A';
$date       = $_POST["date"] ?? 'N/A';
$persons    = $_POST["persons"] ?? '1';
$total      = $_POST["total"] ?? '200';
$payment_id = uniqid("TXN");

// Create the PDF
$pdf = new FPDF();
$pdf->AddPage();

// Title
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'🛕 Temple Darshan Booking Receipt',0,1,'C');
$pdf->Ln(8);

// Booking Details
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,10,'Name:',0,0);       $pdf->Cell(100,10,$name,0,1);
$pdf->Cell(50,10,'Temple:',0,0);     $pdf->Cell(100,10,$temple,0,1);
$pdf->Cell(50,10,'Darshan Type:',0,0); $pdf->Cell(100,10,$type,0,1);
$pdf->Cell(50,10,'Time:',0,0);       $pdf->Cell(100,10,$time,0,1);
$pdf->Cell(50,10,'Date:',0,0);       $pdf->Cell(100,10,$date,0,1);
$pdf->Cell(50,10,'No. of Persons:',0,0); $pdf->Cell(100,10,$persons,0,1);
$pdf->Cell(50,10,'Total Amount:',0,0); $pdf->Cell(100,10,'₹'.$total,0,1);
$pdf->Cell(50,10,'Payment ID:',0,0); $pdf->Cell(100,10,$payment_id,0,1);

$pdf->Ln(10);
$pdf->SetFont('Arial','I',11);
$pdf->Cell(0,10,'Please show this receipt during temple entry. Thank you!',0,1,'C');

// Output the file
$pdf->Output('D', 'Darshan_Receipt.pdf');
?>
