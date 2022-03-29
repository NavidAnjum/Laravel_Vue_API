<?php

namespace App\Http\Controllers;
use App\Models\POCreation;
use App\Models\PRCreation;
use Codedge\Fpdf\Fpdf\Fpdf;
use Codedge\Fpdf\Fpdf\PDF_Code128;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new PDF_Code128('P','mm',array(101.6,101.6));
    }

    public function index($po_number)
    {
        $po=POCreation::find($po_number);

        $pr_number=$po->pr_number;
        $barcode_code = "https://www.w3schools.com/";
        $this->fpdf->AddPage("L", ['100', '100']);


        $this->fpdf->Image('img/spining_pdf.png',24,3,50,6);
        $this->fpdf->Ln(0);
        $this->fpdf->SetFont('Arial','B',10);
        $this->fpdf->Cell(85,5,'SPINNING MILLS',0,0,'C');
        $this->fpdf->SetFont('Arial','B',6);
        $this->fpdf->Ln();

//  ..................... for barcode ..........................
        $this->fpdf->Code128(26,17,$barcode_code,50,5);
        $this->fpdf->Ln(0);
        $this->fpdf->setLeftMargin(5);
        $this->fpdf->Cell(50,16,"".$barcode_code,"0","0","R");
//  .....................end for barcode ..........................

        $this->fpdf->Output();

        exit;
    }
}
