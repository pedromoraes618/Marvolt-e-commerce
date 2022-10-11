<?php
//referenciar o dompdf com namespace

$date = date('d/m/Y');
$linhas = 0;

$html = '<table>"teste"';
$html .= '</table>';




use Dompdf\Dompdf;
require_once("dompdf/autoload.inc.php");
    

$dompdf = new DOMPDF();
$dompdf->setPaper('letter', 'landscape');

$dompdf -> loadHtml($html);

//renderizar com o html
ob_clean(); 
$dompdf->render();

//exibibir a página
$dompdf ->stream("relatorio_teste.php",array("Attachment"=>false));//para realizar o download somente alterar para true
?>