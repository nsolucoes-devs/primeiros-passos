<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function pdf_create($html, $filename, $stream = TRUE, $format)
{

    require_once(APPPATH . '../vendor/autoload.php');

    if($format == 1){
        $format = "A4";
        $mgl=15;
        $mgr=15;
        $mgt=35;
        $mgb=15;
        $local = "Relatório de Vendas";
        
    }elseif($format == 2){
        $format = "A4";
        $mgl=15;
        $mgr=15;
        $mgt=35;
        $mgb=15;
        $local = "Relatório de Participantes";
    }elseif($format == 3){
        $format = "A4";
        $mgl=15;
        $mgr=15;
        $mgt=35;
        $mgb=15;
        $local = "Relatório de Vendas Resumido";
    }   

    $mpdf = new \Mpdf\Mpdf([
        'mode' => '',
        'format' => $format,
        'default_font_size' => 0,
        'default_font' => '',
        'margin_left' => $mgl,
        'margin_right' => $mgr,
        'margin_top' => $mgt,
        'margin_bottom' => $mgb,
        'margin_header' => 9,
        'margin_footer' => 9,
        'orientation' => 'P',
    ]);
    /*$mpdf = new \Mpdf\Mpdf($mode='',$format,$default_font_size=0,$default_font='',$mgl,$mgr,$mgt,$mgb,$mgh=9,$mgf=9, $orientation='P');*/
    
    //$mpdf->SetAutoFont();
    
    $mpdf->use_kwt = true;
    
    $headE = "
        <div style='text-align: right; font-weight: bold;'>
            <div class='row'>
                <div style='width: 25%;'>
                    <img src='".base_url('resources/reidospremioscores.jpeg')."'>
                </div>
                <div style='width: 100%; text-align: center'>
                    <h3 style='font-weight: bold'>".mb_strtoupper($local)."</h3>
                </div>
            </div>
        </div>
        <br><br>
        ";
    
    $headO = "
        <div style='text-align: right; font-weight: bold;'>
            <div class='row'>
                <div style='width: 25%;'>
                    <img src='".base_url('resources/reidospremioscores.jpeg')."'>
                </div>
                <div style='width: 100%; text-align: center'>
                    <h3 style='font-weight: bold'>".mb_strtoupper($local)."</h3>
                </div>
            </div><br>
        <br><br>
        ";

    $footerE = "
        <table width='100%' style='vertical-align: bottom; 
            font-size: 5pt; color: #000000;'>
            <tr>
                <td width='33%'>{DATE d-m-Y}</td>
                <td width='33%' align='center'>{PAGENO}/{nbpg}</td>
                <td width='33%' style='text-align: right;'>".$local." | Desenvolvido por N Soluções</td>
            </tr>
        </table>";

    $footerO = "
        <table width='100%' style='vertical-align: bottom; 
            font-size: 5pt; color: #000000;'>
            <tr>
                <td width='33%'><span>".$local." | Desenvolvido por N Soluções</span></td>
                <td width='33%' align='center'>{PAGENO}/{nbpg}</td>
                <td width='33%' style='text-align: right; '>{DATE d-m-Y}</td>
            </tr>
        </table>";
    
    
    
    $mpdf->SetHTMLHeader($headO, 'O');
    $mpdf->SetHTMLHeader($headE, 'E');
    $mpdf->SetHTMLFooter($footerO, 'O');
    $mpdf->SetHTMLFooter($footerE, 'E');

    $mpdf->WriteHTML($html);
    if ($stream)
    {
        $mpdf->Output($filename . '.pdf', 'I');
    }
    else
    {
        $mpdf->Output('./uploads/temp/' . $filename . '.pdf', 'F');
        
        return './uploads/temp/' . $filename . '.pdf';
    }
}

?>