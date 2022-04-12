<?php

namespace App\Models;

use PDF;
use App\Models\proveedor;
use App\Models\orden_compra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class REPORTEPDF extends Model
{
    use HasFactory;

    public static function create($id_contrato,$id_status, $views,$totales,$fecha1,$fecha2){
  
        $ordenes = $views;
        $total = $totales;
        PDF::setHeaderCallback(function($pdf){
            $pdf->Rect(0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), 'F', array(), array( 247, 247, 247));
            // Set font
            $pdf->SetFont('helvetica', 'B', 15);
            // Title
            $pdf->Image(\URL::asset("images/constructura2.jpg"),0, 0, 60, 30, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            $pdf->SetY(15);
            $pdf->Cell(0,0, 'REPORTE DE ORDEN DE COMPRA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT); 
        });

        PDF::AddPage('P', 'Letter');
        $view = \View::make("ordenes_compras.reportePDF",compact("ordenes","total"));
        $html = $view->render();
        PDF::SetFont('helvetica', '',10);
        //OBTIENE INSERTA EL HTML EN EL PDF
        PDF::writeHTMLCell('0','0','8','25',$html);
        PDF::setFooterCallback(function($pdf){
            $pdf->SetFont('helvetica', 'B', 8);
            $html = <<<EOD
                <table >
                <tr style = "text-align: center;">
                        <td width="20%"></td> 
                        <td style="border-bottom: 1 px solid #000;" width="50%"></td>
                        <td width="20%"></td>
                    </tr>
                    <tr style = "text-align: center;">
                        <td width="20%"></td> 
                        <td style="font-weight: bold;" width="50%">ING.OSCAR E. CONTRERAS CAZARES</td>
                        <td width="20%"></td>
                    </tr>
                    <tr style = "text-align: center;">
                        <td></td>
                        <td style="height:14px;">REPRESENTANTE LEGAL</td>
                        <td></td>
                    </tr>
                    <tr style = "text-align: end;">
                        <td width="15%"></td>
                        <td width="35%"></td>
                        <td width="50%" style="color:#ff9c00">(+52)844 432 52 14    (+52)4 32 06 63</td>
                        <td></td>
                    </tr>
                    <tr style = "text-align: end;">
                        <td></td>
                        <td></td>
                        <td style="color:#f16532">info@conbeconstrucciones.com</td>
                        <td></td>
                    </tr>
                    <tr style = "text-align: end;">
                        <td></td>
                        <td></td>
                        <td style="color:black">Av.Revolución 500,Ejido Piedras Negras,26015</td>
                        <td></td>
                    </tr>
                    <tr style = "text-align: end;">
                        <td></td>
                        <td></td>
                        <td style="color:black">Piedras,Coahuila</td>
                        <td></td>
                    </tr>
                </table>
                
EOD;
            $pdf->Image(\URL::asset("images/conbe_fotter.jpg"),5, 265, 180, 30, 'JPG', '', 'B', false, 300, '', false, false, 0, false, false, false);
            $pdf->writeHTMLCell('0','0','50','262',$html);
        });
        PDF::Output();

    }
}

