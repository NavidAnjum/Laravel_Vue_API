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

    public function index($pr_number,$po_number)
    {
        $po=POCreation::find($po_number);
        return $po;

        $this->fpdf->SetFont('Arial', 'B', 15);
        $this->fpdf->AddPage("L", ['100', '100']);
        $this->fpdf->Text(10, 10, "Hello World!");

        $this->fpdf->Output();

        exit;
    }
}
