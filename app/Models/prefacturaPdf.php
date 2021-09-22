<?php

namespace App\Models;

use App\Models\factura;
use Illuminate\Database\Eloquent\Model;
use PDF;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class prefacturaPdf extends Model
{
    use HasFactory;
    public static function create($id)
    {
        $factura=factura::find($id);
        PDF::setHeaderCallback(function($pdf){
            // Set font
            $pdf->SetFont('helvetica', 'B', 20);
            // Title
            $pdf->Image(\URL::asset("images/constructura2.jpg"),5, 10, 60, 30, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            $pdf->Image(\URL::asset("images/conbe_header.jpg"),100, 0, 110, 50, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            
        });

        PDF::setFooterCallback(function($pdf){
            $html = <<<EOD
                <table >
                    <tr style = "text-align: center;">
                        <td width="20%"></td> 
                        <td style="font-weight: bold;border-top: 4 px solid #000;" width="60%">ING.OSCAR E. CONTRERAS CAZARES</td>
                        <td width="20%"></td>
                    </tr>
                    <tr style = "text-align: center;">
                        <td></td>
                        <td style="height:25px;">REPRESENTANTE LEGAL</td>
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
            $pdf->Image(\URL::asset("images/conbe_fotter.jpg"),5, 230, 180, 60, 'JPG', '', 'B', false, 300, '', false, false, 0, false, false, false);
            $pdf->writeHTMLCell('0','0','10','230',$html);
        });
        PDF::AddPage('P', 'Letter');
        $view = \View::make("facturas.prefactura_pdf",compact("factura"));
        $html = $view->render();
        PDF::SetFont('helvetica', '',12);
        //OBTIENE INSERTA EL HTML EN EL PDF
        PDF::writeHTMLCell('0','0','10','50',$html);
        PDF::Output();

    }
}
