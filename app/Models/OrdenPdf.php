<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDF;

class OrdenPdf extends Model
{
    use HasFactory;

    public static function create()
    {
        // $requisicion = "HOLA";
        PDF::setHeaderCallback(function($pdf){
            $pdf->Rect(0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), 'F', array(), array( 247, 247, 247));
            // Set font
            $pdf->SetFont('helvetica', 'B', 20);
            // Title
            $pdf->Image(\URL::asset("images/constructura2.jpg"),0, 0, 120, 40, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            $pdf->SetXY(90, 30);
            $pdf->Cell(0, 0, 'REQUISICIÓN DE COMPRA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        });

        //CONFIGURACION 
        PDF::SetAuthor('Evotek');
        PDF::SetTitle('Nueva Requisición');
        PDF::SetSubject('Nueva Requisición');
        PDF::AddPage('L', 'Letter');
        PDF::SetFont('helvetica', 'B',12);

        //OBTIENE LA VISTA DE REQUISICIONES PDF
        $view = \View::make("ordenes_compras.orden_pdf");
        $html = $view->render();
        PDF::SetFont('helvetica', '',9);
        //OBTIENE INSERTA EL HTML EN EL PDF
        PDF::writeHTMLCell(210, 0, 0, 55, $html, 0, 0,  0, true, '', true);
        PDF::Output();
    }
}
