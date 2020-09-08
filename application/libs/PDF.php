<?php

class PDF extends FPDF
{
// Cabecera de página
    function addImage($directory_diploma = "")
    {        // Logo
        $this->Image($directory_diploma, 10, 8, 275, 200);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
//        $this->Cell(80);
        // Título

        // Salto de línea
        $this->Ln(20);
    }

    function addText($name = "", $x = 0, $y = 0)
    {
        $this->AddFont("verdana", "B", "verdanab.php");
        $this->SetFont('verdana', 'B', 38);
        $this->SetTextColor(127,128,130);

        $this->Ln(45);
        $this->Cell($x, $y, $name, 0, 0, 'C');
        $this->Ln(20);
    }

    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}


?>