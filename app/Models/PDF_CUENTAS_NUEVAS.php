<?php

namespace App\Models;

use PDF;
use App\Models\relacion_cuentas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PDF_CUENTAS_NUEVAS extends Model
{
    use HasFactory;
    public static function create($id){
        $cuentas = relacion_cuentas::where("cuenta_id",$id)->get();
        $suma_monto = relacion_cuentas::setSumaMonto($id);
        $suma_programado = relacion_cuentas::setSumaProgramado($id);
        $suma_total = relacion_cuentas::setSumaTotal($id);

        PDF::setHeaderCallback(function($pdf){
            $pdf->Rect(0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), 'F', array(), array( 247, 247, 247));
            // Set font
            $pdf->SetFont('helvetica', 'B', 15);
            $pdf->SetMargins(0,15, 0); 
            // Title
            $pdf->Image(\URL::asset("images/constructura2.jpg"),0, 0, 60, 30, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            $pdf->SetY(15);
            $pdf->Cell(0,0, 'CUENTAS POR PAGAR', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
                $view = \View::make("cuentas_pagar.PDF_CUENTAS_NUEVAS",compact("cuentas",'suma_monto','suma_total','suma_programado'));
                $html = $view->render();
                PDF::SetFont('helvetica', '',10);
                //OBTIENE INSERTA EL HTML EN EL PDF
                PDF::writeHTMLCell('0','0','2','40',$html);
                PDF::Output();
    }
}
