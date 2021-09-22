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
            $pdf->Image(\URL::asset("images/constructura2.jpg"),5, 5, 60, 30, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            $pdf->SetY(10);
        });

        PDF::setFooterCallback(function($pdf){
            $pdf->setY(-55);
            $html = <<<EOD
                <table >
                    <tr style = "text-align: center;">
                        <td></td> 
                        <td style="font-weight: bold;border-top-style: solid;">ING.OSCAR E. CONTRERAS CAZARES</td>
                        <td></td>
                    </tr>
                    <tr style = "text-align: center;">
                        <td></td>
                        <td >REPRESENTANTE LEGAL</td>
                        <td></td>
                    </tr>
                </table>
                
            EOD;
            $pdf->SetY(-40);
            PDF::writeHTML($html,true,0,false,false,"");
        });
        PDF::AddPage('L', 'Letter');
        $view = \View::make("facturas.prefactura_pdf",$factura);
        $html = $view->render();
        PDF::SetFont('helvetica', 'B',9);
        //OBTIENE INSERTA EL HTML EN EL PDF
        PDF::setY(20);
        PDF::writeHTML($html,true,0,false,false,"");
        PDF::Output();

    }
}
