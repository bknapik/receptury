<?php

/**
 * Class PDF
 */
class PDF extends tFPDF
{

    /**
     *
     */
    function Header()
    {
//        require('makefont/makefont.php');
//        MakeFont('C:\xampp\htdocs\recepik\vendor\fpdf\arial.ttf','cp1250');
        // Logo
        $this->Image($this->logo, 170, 6, 30);
        // Arial bold 15
        $this->SetFont('DejaVu', 'B', 15);
        // Title
        $this->Cell(20, 10, $this->name, 0, 0, 'L');
        $this->Ln(8);
        // adres
        $this->Cell(30, 10, $this->adres, 0, 0, 'L');
        // Line break
        $this->Ln(20);
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('DejaVu', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Strona ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    /**
     * @param $header
     * @param $data
     */
    function Table($header, $data)
    {
        // Column widths
        $w = array(110, 35, 40);
        // Header
        $this->SetFont('','B');
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],0,0,'C');
        $this->Ln();
        // Data
        $this->SetFont('');
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],1);
            $this->Cell($w[1],6,$row[1],1,0,'R');
            $this->Cell($w[2],6,$row[2],1);
            $this->Ln();
        }
    }

    /**
     * @param $h
     */
    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }
}