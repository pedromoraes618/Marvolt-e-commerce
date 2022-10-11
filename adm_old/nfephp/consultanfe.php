<?php
//session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../nfephp/bootstrap.php';
$id_emitente   = $_SESSION["usuario"]["id"];

use NFePHP\NFe\ToolsNFe;

echo '../nfephp/config/config'.$id_emitente.'.json';
exit;

$nfe = new ToolsNFe('../nfephp/config/config'.$id_emitente.'.json');
$nfe->setModelo('55');



//$chave = '52161016776504000138550010000000141000000142';
include_once("../includes/conexao.php");

$numero = $_POST["numero_nota"];
$pegaChavenoBD2 = mysqli_query($conexao,"select chave_nfe from nota1 where id = '$numero' and id_emitente = '$id_emitente'");
$pegaChavenoBD = mysqli_fetch_array($pegaChavenoBD2);
$chave = $pegaChavenoBD["chave_nfe"];
$tpAmb = $_SESSION["ambiente"];
$aResposta = array();
$xml = $nfe->sefazConsultaChave($chave, $tpAmb, $aResposta);
echo '<br><br><pre>';
echo htmlspecialchars($nfe->soapDebug);
echo '</pre><br><pre>';
print_r($aResposta);
echo "<pre><br>";
