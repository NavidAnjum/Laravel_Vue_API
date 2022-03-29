<?php

namespace App\Http\Controllers;
use App\Models\POCreation;
use App\Models\PRCreation;
use Codedge\Fpdf\Fpdf\Fpdf;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function index($po_number)
    {
        $po=POCreation::find($po_number);

        $pr_number=$po->pr_number;
      //  ->where('pr_number',$pr_number)
      //  return $pr->pr_creaton;

        $this->fpdf->AddPage("L", ['100', '100']);


        $this->fpdf->Image('img/spining_pdf.png',24,3,50,6);
        $this->fpdf->Ln(0);
        $this->fpdf->SetFont('Arial','B',10);
        $this->fpdf->Cell(85,5,'SPINNING MILLS',0,0,'C');
        $this->fpdf->SetFont('Arial','B',6);
        $this->fpdf->Ln();
        $this->fpdf->SetFont('Arial','B',9);
        $this->fpdf->Cell(85,4,"Pagar, Tongi, Gazipur","0","1","C");
        $this->fpdf->Ln(0);
//  ..................... for barcode ..........................
        $this->fpdf->setLeftMargin(15);
        $this->fpdf->Cell(50,16,$pr_number,"0","0","R");
//  .....................end for barcode ..........................

        $this->fpdf->Output();

        exit;
    }
}
