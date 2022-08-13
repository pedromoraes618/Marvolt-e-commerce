<?php
$html = "";
$consulta = "SELECT * from cotacao ";
if(isset($_GET["codigo"])){
    $cotacaoID =  $_GET["codigo"];
    $codCotacao =  $_GET["cotacaoCod"];
$consulta .= " WHERE cotacaoID = {$cotacaoID}";  
}
$dados_cotacao= mysqli_query($conecta, $consulta);

while($row_cotacao = mysqli_fetch_assoc($dados_cotacao)){
    $html .= $row_cotacao['clienteID'] . "<br>";
}
    
    /*
    $dataLancamentoB = $linha['data_lancamento'];
    $statusPropostaB = $linha['status_proposta'];
    $formaPagamentoIDB = $linha['forma_pagamentoID'];
    $dataRecebidaB = $linha['data_recebida'];
    $dataEnvioB = $linha['data_envio'];
    $dataResponderB = $linha['data_responder'];
    $dataFechamentoB= $linha['data_fechamento'];
    $diasNegociacaoB = $linha['dias_negociacao'];
    $prazoEntregaB = $linha['prazo_entrega'];
    $numeroSolicitacaoB = $linha['numero_solicitacao'];
    $numeroOrcamentoB = $linha['numero_orcamento'];
    $codCotacaoB = $linha['cod_cotacao'];
    $validadeB = $linha['validade'];
    $freteB = $linha['freteID'];
    $compradorB = $linha['compradorID'];*/
    

?>