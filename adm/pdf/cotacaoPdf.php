<?php
//referenciar o dompdf com namespace
include("../conexao/sessao.php");
require_once("../conexao/conexao.php"); 

//consultar os dados da empresa pelo id 
$consulta = "SELECT * from empresa ";
$dados_empresa= mysqli_query($conecta, $consulta);
while($row_empresa = mysqli_fetch_assoc($dados_empresa)){
    $razaoSocial = utf8_encode($row_empresa['razao_social']);
    $endereco = utf8_encode($row_empresa['endereco']);
    $cnpj = utf8_encode($row_empresa['cnpj']);
    $inscricaoEstadual = utf8_encode($row_empresa['inscricao_estadual']);
    $email = utf8_encode($row_empresa['email']);
    $telefone = utf8_encode($row_empresa['telefone']);
}


//consultar cliente pelo id
$consultaCliente = "SELECT * from clientes ";
$clienteID =  $_GET["cliente"];
$consultaCliente .= " WHERE clienteID = {$clienteID}";  

$dados_cliente = mysqli_query($conecta, $consultaCliente);
while($row_cliente = mysqli_fetch_assoc($dados_cliente)){
    $razaoSocialCliente = utf8_encode($row_cliente['razaosocial']);
    $enderecoCliente = utf8_encode($row_cliente['endereco']);
    $telefoneCliente = $row_cliente['telefone'];
    $cnpjCliente = $row_cliente['cpfcnpj'];
    $cidadeCliente = utf8_encode($row_cliente['cidade']);
    $emailCliente = utf8_encode($row_cliente['email']);
}


//consultar cotacao pelo codigo cotação
$consulta = "SELECT * from cotacao ";
$codCotacaoB =  $_GET["codigo"];
$consulta .= " WHERE cod_cotacao = {$codCotacaoB}";  

$dados_cotacao= mysqli_query($conecta, $consulta);
while($row_cotacao = mysqli_fetch_assoc($dados_cotacao)){
    $dataLancamentoB = $row_cotacao['data_lancamento'];
    $numeroOrcamentoB = $row_cotacao['numero_orcamento'];
    $codCotacaoB = $row_cotacao['cod_cotacao'];
    $numeroSolicitacaoB = $row_cotacao['numero_solicitacao'];
    $validadeB = $row_cotacao['validade'];
    $freteB = $row_cotacao['freteID'];
    $formaPagamentoIDB = $row_cotacao['forma_pagamentoID'];
    $prazoEntregaB = $row_cotacao['prazo_entrega'];
    $cliente = $row_cotacao['clienteID'];
}

$date = date('d/m/Y');

    
	
	$pagina = 
		"<html>
        <header>
        <link href='css.css' rel='stylesheet'>s
        </header>
			<body>
				<table  id='dadosEmpresa'>
                    <tr>
                        <td><b>$razaoSocial</b></td>
                    </tr>
                    <tr>
                         <td>$endereco </td>
                    </tr>
                    <tr>
                         <td>CNPJ: $cnpj INSCRIÇÃO ESTADUAL: $inscricaoEstadual</td>
                       
                    </tr>
                    <tr>
                         <td>E-MAIL: $email CONTATO: $telefone</td>
                    </tr>

                </table>

                <div id='cabecalho'><p><b>ORÇAMENTO DE MATERIAS Nº $numeroOrcamentoB</b></p></div>

                <table id='dadosCotacao'>
                <tr>
                    <td><b>Solicitação de cotação Nº:</b> $numeroSolicitacaoB</td>
                    <td><b>Data:</b> $date</td>
                </tr>
              
                   
           
                <tr>
                     <td><b>Validade do orçamento:</b> $validadeB dias úteis</td>
                     <td><b>Plano de pagamento:</b> $formaPagamentoIDB</td>
                </tr>
                <tr>
                     <td><b>Modalidade do frete:</b> $freteB  </td>
                     <td><b>Prazo entrega:</b> $prazoEntregaB  </td>
                </tr>
                
            </table>

            <div id='lista'></div>
		


            <div id='dadosCliente'>
            <table>

                <tr>
                    <td><b>Cliente:</b> $razaoSocialCliente</td>
                    <td><b>CPF/CNPJ:</b> $cnpjCliente</td>
                </tr>
       
                <tr>
                    <td><b>Endereço:</b> $enderecoCliente </td>
                    <td><b>Cidade:</b> $cidadeCliente </td>
                </tr>

                <tr>
                    <td><b>Contato:</b> $telefoneCliente  </td>
                    <td><b>Email:</b> $emailCliente </td>
                </tr>
            
        </table>";
        
        $pagina .= "<div id='dadosProduto'>
        <table id='produto'>
        <tr id='cabecalhoTabela'>
            <td style='width:50px;'>Item</td>
            <td style='width:420px;'>Descrição</td>
            <td style='width:70px;'>Und</td>
            <td style='width:70px;'>Qunat</td>
            <td style='width:100px;'>P.Unitario</td>
            <td style='width:100px;'>V.total</td>
            <td style='width:60px;'>ICMS</td>
            <td style='width:60px;'>IPI</td>
        </tr>
        </table>
        </div>";

        $linha = 0;
            
            $consultaCotacao = "SELECT * from produto_cotacao ";
            $prodCotacao =  $_GET["codigo"];
            $consultaCotacao .= " WHERE cotacaoID = {$prodCotacao}";  
            $dados_produto = mysqli_query($conecta, $consultaCotacao);
        while($row_produto = mysqli_fetch_assoc($dados_produto)){
            $cotacaoID = $row_produto['cotacaoID'];
            $descricao = $row_produto['descricao'];
            $quantidade = $row_produto['quantidade'];
            $precoCompra = $row_produto['preco_compra'];
            $precoVenda = $row_produto['preco_venda'];
            $margem = $row_produto['margem'];
            $unidade = $row_produto['unidade'];
            $status = $row_produto['status'];
            $img = $row_produto['img'];

            $precoTotal = $precoVenda * $quantidade;
            $linha = $linha +1;
            
        
        $pagina .= "<table>
        <tr>
        <td style='width:50px;'>$linha</td>
        <td style='width:420px;'>$descricao</td>
        <td style='width:70px;'>$unidade</td>
        <td style='width:70px;'>$quantidade</td>
        <td style='width:100px;'>R$ $precoVenda</td>
        <td style='width:100px;'>R$ $precoTotal</td>
        <td style='width:60px;'>0%</td>
        <td style='width:60px;'>0%</td>
        </tr>
        </table>
        </html>"; 

    };



use Dompdf\Dompdf;

require_once("dompdf/autoload.inc.php");

$dompdf = new DOMPDF();
$dompdf->setPaper('a4', 'landscape');
$codigo_html = $pagina;
$dompdf -> loadHtml($codigo_html);

ob_clean(); 
$dompdf->render();
//renderizar com o html


//exibibir a página
$dompdf ->stream("relatorio_teste.php",array("Attachment"=>false));//para realizar o download somente alterar para true

?>
