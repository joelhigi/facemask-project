<?php
// require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        //$this->Image('logo.jpeg',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,7,'UMUJYI WA KIGALI',0,2,'C');
        // Title
        $this->Cell(30,7,'AKARERE KA NYARUGENGE',0,2,'C');
        // Title
        $this->Cell(30,7,'UMURENGE WA NYARUGENGE',0,2,'C');
        // Title
        $this->Cell(30,7,'AKAGARI KA RWAMPARA',0,2,'C');
        // Title
        $this->Cell(30,7,'UMUDUGUDU WA XXXXXXX',0,1,'C');
         // Logo
         //$this->Image('logo.jpg',170,6,30);
        // // Line break
        // $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// // Instanciation of inherited class
// $pdf = new PDF();
// $pdf->AliasNbPages();
// $pdf->AddPage();
// $pdf->SetFont('Times','',12);
// for($i=1;$i<=40;$i++)
// 	$pdf->Cell(0,10,'Printing line number '.$i,0,1);

// $pdf->Output();
?>