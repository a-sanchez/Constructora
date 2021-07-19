<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\orden_compra;
use App\Models\OrdenProducto;
use PDF;

class OrdenPdf extends Model
{
    use HasFactory;

    public static function create($id)
    {
        $orden = orden_compra::find($id);
        $productos = OrdenProducto::where("orden_id","=",$id)->get();
        $subTotal = 
        // HEADER TCPDF
        PDF::setHeaderCallback(function($pdf){
            $pdf->Rect(0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), 'F', array(), array( 247, 247, 247));
            // Set font
            $pdf->SetFont('helvetica', 'B', 20);
            // Title
            $pdf->Image(\URL::asset("images/constructura2.jpg"),0, 0, 60, 30, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            $pdf->SetY(10);
            $pdf->Cell(0, 0, 'REQUISICIÓN DE COMPRA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        });
        // Footer TCPDF
        PDF::setFooterCallback(function($pdf) use ($orden){
            $pdf->SetY(-55);
            $pdf->Multicell(0, 0, $orden->observaciones, 0, "C", 0, 1, '','',true, 0, false,true,0);
            $html = <<<EOD
                <table border=".5" cellpadding="3">
                    <tr >
                        <td height = "50px"></td>
                        <td height = "50px"></td> 
                        <td height = "50px"></td>
                    </tr>
                    <tr style = "text-align: center;">
                        <td>$orden->solicitado</td>
                        <td>Vo.Bo.<br>$orden->vobo</td> 
                        <td>AUTORIZA <br>$orden->autorizacion</td>
                    </tr>
                </table>
            EOD;
            $pdf->SetY(-40);
            PDF::writeHTML($html,true,0,false,false,"");

            
        });

        //CONFIGURACION 
        PDF::SetAuthor('Evotek');
        PDF::SetTitle('Nueva Requisición');
        PDF::SetSubject('Nueva Requisición');
        PDF::AddPage('L', 'Letter');

        //OBTIENE LA VISTA DE REQUISICIONES PDF
        $ctx = [
            "orden"=>$orden,
            "productos"=>$productos
        ];
        $view = \View::make("ordenes_compras.orden_pdf",$ctx);
        $html = $view->render();
        PDF::SetFont('helvetica', 'B',9);
        //OBTIENE INSERTA EL HTML EN EL PDF
        PDF::setY(20);
        PDF::writeHTML($html,true,0,false,false,"");
        PDF::Output();
    }
}
