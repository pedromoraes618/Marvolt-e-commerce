<?php
//referenciar o dompdf com namespace
include("../conexao/sessao.php");
require_once("../conexao/conexao.php"); 
include("../_incluir/funcoes.php");
include('../tcpdf/tcpdf.php');



$codCotacaoB =  $_GET["codigo"];
//consultar os dados da empresa pelo id 
$consulta = "SELECT * from empresa where empresaID = '1' ";
$dados_empresa= mysqli_query($conecta, $consulta);
while($row_empresa = mysqli_fetch_assoc($dados_empresa)){
    $razaoSocial = utf8_encode($row_empresa['razao_social']);
    $endereco = utf8_encode($row_empresa['endereco']);
    $cnpj = utf8_encode($row_empresa['cnpj']);
    $inscricaoEstadual = utf8_encode($row_empresa['inscricao_estadual']);
    $email = utf8_encode($row_empresa['email']);
    $telefone = utf8_encode($row_empresa['telefone']);
    $site = utf8_encode($row_empresa['site']);
}

//consultar Comprador
if(isset($_GET['compradorID'])){
    $compradorID =$_GET['compradorID'];
    $consulta = "SELECT * from comprador where id_comprador = {$compradorID} ";
$dados_comprador= mysqli_query($conecta, $consulta);
while($row_comprador = mysqli_fetch_assoc($dados_comprador)){
    $comprador = utf8_encode($row_comprador['comprador']);
    $emailComprador = utf8_encode($row_comprador['email']);
    }
}

$consultaProdutoComImg = "SELECT count(img) as produtosComImg from produto_cotacao  where cotacaoID = $codCotacaoB and img <>'' ";
$dados_produto_img = mysqli_query($conecta, $consultaProdutoComImg);
if(!$dados_produto_img){
    die("Falha no banco de dados || select produto_cotacao");
}else{
    $linha = mysqli_fetch_assoc($dados_produto_img);
    $totalDeProdutosComImg = $linha['produtosComImg'];
   
}

$consultaTodosOsProdutos = "SELECT count(cotacaoID) as todosOsProdutos from produto_cotacao  where cotacaoID = $codCotacaoB";
$dados_todos_produtos = mysqli_query($conecta, $consultaTodosOsProdutos);
if(!$dados_todos_produtos){
    die("Falha no banco de dados || select produto_cotacao");
}else{
    $linhaTotal = mysqli_fetch_assoc($dados_todos_produtos);
    $totalDeProdutos= $linhaTotal['todosOsProdutos'];
   
}


//consultar cliente pelo id
$consultaCliente = " SELECT clientes.razaosocial,clientes.endereco,clientes.telefone,clientes.cpfcnpj,clientes.cidade,clientes.nome_fantasia, clientes.email,estados.sigla AS uf from estados inner join clientes on clientes.estadoID = estados.estadoID ";
$clienteID =  $_GET["cliente"];
$consultaCliente .= " WHERE clienteID = {$clienteID}";  

$dados_cliente = mysqli_query($conecta, $consultaCliente);
while($row_cliente = mysqli_fetch_assoc($dados_cliente)){
    $razaoSocialCliente = utf8_encode($row_cliente['razaosocial']);
     $nomeFantasiaCliente = utf8_encode($row_cliente['nome_fantasia']);
    $enderecoCliente = utf8_encode($row_cliente['endereco']);
    $telefoneCliente = $row_cliente['telefone'];
    $cnpjCliente = $row_cliente['cpfcnpj'];
    $ufCliente = utf8_encode($row_cliente['uf']);
    $cidadeCliente = utf8_encode($row_cliente['cidade']);
    $emailCliente = utf8_encode($row_cliente['email']);
}


//consultar cotacao pelo codigo cotação
$consulta = "SELECT cotacao.data_lancamento,cotacao.data_envio,cotacao.numero_orcamento, cotacao.cod_cotacao, cotacao.numero_solicitacao, cotacao.validade, cotacao.prazo_entrega,cotacao.valorTotal,cotacao.desconto, cotacao.valorTotalComDesconto, forma_pagamento.nome as formapagamento,forma_pagamento.nome,frete.descricao as frete from forma_pagamento inner join cotacao on cotacao.forma_pagamentoID = forma_pagamento.formapagamentoID inner join  frete on cotacao.freteID = frete.freteID ";
$codCotacaoB =  $_GET["codigo"];
$consulta .= " WHERE cod_cotacao = {$codCotacaoB}";  
$dados_cotacao= mysqli_query($conecta, $consulta);
while($row_cotacao = mysqli_fetch_assoc($dados_cotacao)){
    $dataLancamentoB = $row_cotacao['data_lancamento'];
    $dataEnvio = $row_cotacao['data_envio'];
    $numeroOrcamentoB = $row_cotacao['numero_orcamento'];
    $codCotacaoB = $row_cotacao['cod_cotacao'];
    $numeroSolicitacaoB = $row_cotacao['numero_solicitacao'];
    $validadeB = $row_cotacao['validade'];
    $freteB = $row_cotacao['frete'];
    $formaPagamentoIDB = $row_cotacao['formapagamento'];
    $prazoEntregaB = $row_cotacao['prazo_entrega'];
    $cliente = $row_cotacao['clienteID'];
    $valor = $row_cotacao['valorTotal'];
    
    $desconto = $row_cotacao['desconto'];
    $totalComDesconto = $row_cotacao['valorTotalComDesconto'];
    
}



if($numeroSolicitacaoB=="0"){$numeroSolicitacaoB="";}
$textoCotacao = "No valor estão inclusas todas as despesas que resultem no custo das aquisições, tais como impostos, taxas, transportes, materiais utilizados, seguros, encargos fiscais e todos os ônus diretos e qualquer outra despesa que incidir na execução do produto.Empresa optante pelo Simples Nacional. Todos os produtos são de origem Nacional.";

$linha = 0;
$consultaCotacao = "SELECT * from produto_cotacao  ";
$prodCotacao =  $_GET["codigo"];
$consultaCotacao .= " WHERE cotacaoID = {$prodCotacao} ";  
$dados_produto = mysqli_query($conecta, $consultaCotacao);

$consultaProdutoCotacao = "SELECT * from produto_cotacao ";
$consultaProdutoCotacao .= " WHERE cotacaoID = {$prodCotacao}";  
$dados_produto_img = mysqli_query($conecta, $consultaProdutoCotacao);

$date = date('d/m/Y');

$html= "<table width=100% id='tempresa'>";

$html .= "<tr><td > <img width=150px height=90px src='../images/logopdf.jpg' ></td></tr>"; 
$html .="<tr><td align=left><font size=3><b>" . $razaoSocial . "</b></font></td></tr>";

$html .="<tr><td align=left><font size=3>" . $endereco . "</font></td></tr>";
$html .="<tr><td align=left><font size=3>CNPJ:" . formatCnpjCpf($cnpj) . " INSCRIÇÃO ESTADUAL:".formatInscricaoEstadual($inscricaoEstadual)."</font></td></tr>";
$html .="<tr><td align=left><font size=3>E-MAIL:" . $email . " CONTATO:".$telefone."</font></td></tr>";
$html .="<tr><td align=left><font size=3>SITE: " . $site ."</font></td></tr>";
$html .= "</table>";
$html .= "<p>";
$html .= "<p align=center><b>ORÇAMENTO DE MATERIAIS Nº ".$numeroOrcamentoB ."</b><p>";
$html .= "<p>";

//dados cotacao
$html .= "<table id='tcotacao' >";
if($dataEnvio == "0000-00-00"){
$html .="<tr><td align=left><font size=3><b>Solicitação de cotação Nº: </b>" . $numeroSolicitacaoB . "</font></td><td align=left><font size=3><b>Data: </b>" . $date . "</font></td></tr>";
}else{
$html .="<tr><td align=left><font size=3><b>Solicitação de cotação Nº: </b>" . $numeroSolicitacaoB . "</font></td><td align=left><font size=3><b>Data: </b>" . formatardataB($dataEnvio) . "</font></td></tr>";
}
$html .="<tr><td align=left><font size=3><b>Validade do orçamento: </b>" . $validadeB . " dias </font></td><td align=left><font size=3><b>Plano de pagamento: </b>" . $formaPagamentoIDB . " dias </font></td></tr>";
$html .="<tr><td align=left><font size=3><b>Modalidade do Frete: </b>" . $freteB . "</font></td>";
$html .= "</table>";
$html .= "<div id='linha'></div>";
$html .= "<p>";

//dados cliente

$html .= "<div id='dadosCliente'>";
$html .= "<table id='tcliente'>";
$html .="<tr><td align=lefts><font size=3><b>Cliente: </b>" . $nomeFantasiaCliente . "</font></td><td align=left><font size=3><b>CPF/CNPJ: </b>" . formatCnpjCpf($cnpjCliente) . "</font></td></tr>";
$html .="<tr><td align=left><font size=3><b>Endereço: </b>" . $enderecoCliente . " </font></td><td align=left><font size=3><b>Cidade: </b>" . $cidadeCliente . " - " .$ufCliente."</font></td></tr>";
$html .="<tr><td align=left><font size=3><b>Contato: </b>" . $telefoneCliente . "</font></td><td align=left><font size=3><b>E-Mail: </b>" . $emailComprador . "</font></td></tr>";
$html .= "</table>";
$html .= "</div>";

$html .= "<table id='cabecalhoTabela' width=100%>";
$html .="<tr id='linhaCabecalho'><td align=center style=width:50px;><font size=2><b>Item</b></font></td>";
$html .="<td align=left style=width:550px;><font size=2><b>Descrição</b> </font></td>";
$html .="<td align=left ><font size=2 style=r><b> Und. </b></font></td>";
$html .="<td align=left><font size=2><b> Quant.</b> </font></td>";
$html .="<td align=left><font size=2><b> P.unitario</b> </font></td>";
$html .="<td align=left><font size=2><b> V.total </b></font></td>";
$html .="<td align=left><font size=2><b> Prazo </b></font></td>";
$html .="</tr>";



while($row_produto = mysqli_fetch_assoc($dados_produto)){
$cotacaoID = $row_produto['cotacaoID'];
$descricao = $row_produto['descricao'];
$quantidade = $row_produto['quantidade'];
$precoCompra = $row_produto['preco_compra'];
$precoVenda = $row_produto['preco_venda'];
$margem = $row_produto['margem'];
$unidade = $row_produto['unidade'];
$status = $row_produto['status'];
$prazo = $row_produto['prazo'];
$img = $row_produto['img'];
  
if($prazo < 5){
    $prazo = "Imediato";
}else{
    $prazo = $prazo." dias úteis";
}
$precoTotal = $precoVenda * $quantidade;
$linha = $linha +1;

$html .="<tr>";
$html .="<td align=center style=width:50px;><font size=2>".$linha."</font></td>";
$html .="<td align=left style=width:500px;><font size=2> ".utf8_encode($descricao)." </font></td>";
$html .="<td align=left ><font size=2>".$unidade." </font></td>";
$html .="<td align=left><font size=2>".valor_qtd($quantidade)." </font></td>";
$html .="<td align=left><font size=2>".real_format($precoVenda)." </font></td>";
$html .="<td align=left><font size=2>".real_format($precoTotal)." </font></td>";
$html .="<td align=left><font size=2>".($prazo)."</font></td>";
$html .="</tr>";
}



$html .= "</table>";
$html .= "<div id='linhaTotal'></div>";
$html .= "<table width=100%>";
$html .="<tr>";
$html .="<td align=left style=width:200px;><font size=2><b>TOTAL DE ITENS ".$linha."</b></font></td>";
$html .="<td align=right style=width:200px;><font size=2><b>VALOR TOTAL DO PEDIDO: ".real_format($valor)."</b></font></td>";
$html .="</tr>";

$html .= "<table>";
$html .="<tr>";
$html .="<td></td>";
$html .="</tr>";
$html .= "</table>";

$html .= "</table>";
$html .= "<table>";
$html .="<tr>";
$html .="<td align=left><font size=2>".$textoCotacao."</font></td>";
$html .="</tr>";
$html .= "</table>";

$html .= "<table>";
$html .="<tr>";
$html .="<td></td>";
$html .="</tr>";
$html .= "</table>";

if($desconto!=0){
$html .= "<table width=100%  ";
$html .="<tr>";
$html .="<td align=left style=width:200px;><font size=2><b> </b></font></td>";
$html .="<td align=right style=width:500px; font-size:115px;><b>VALOR TOTAL DO PEDIDO COM DESCONTO DE: ".real_percent($desconto)  .   "     " .  real_format($totalComDesconto). "</b></td>";
$html .="</tr>";
$html .= "</table>";
}


if($totalDeProdutosComImg != 0){
$html .="<div class='page-break'></div>";
$html .= "<table width=100% id='tempresa' >";
$html .="<tr><td align=left><font size=3><b>" . $razaoSocial . "</b></font></td></tr>";

$html .= "</table>";

while($linha = mysqli_fetch_assoc($dados_produto_img)){
    $cotacaoID = $linha['cotacaoID'];
    $descricao = $linha['descricao'];
    $quantidade = $linha['quantidade'];
    $precoCompra = $linha['preco_compra'];
    $precoVenda = $linha['preco_venda'];
    $margem = $linha['margem'];
    $unidade = $linha['unidade'];
    $status = $linha['status'];
    $prazo = $linha['prazo'];
    $img = $linha['img'];

if($img !=""){

$html .="<div id='agrupamento'>";
$html .="<div id='elemento'>";
$html .="<div id='img'><font size=2><img width=150px height=130px src=".($img)." ></font></div>";
$html .="<div id='texto' style=width:500px;><font size=2><p style='margin-top:20px; margin-left:20px;'> ".utf8_encode($descricao)."</p> </font></div>";
$html .="</div>";
$html .="</div>";

}
}
}
$date = date('d/m/Y');


use Dompdf\Dompdf;

require_once("../pdf/dompdf/autoload.inc.php");

$dompdf = new DOMPDF();
$dompdf->setPaper('a4', 'landscape');
$codigo_html = $html;
$dompdf -> loadHtml('<link href="../_css/cotacaoPdf.css" rel="stylesheet">'. $codigo_html );

ob_clean(); 
$dompdf->render();
//renderizar com o html


//exibibir a página
$dompdf ->stream("Orçamento Nº:".$numeroOrcamentoB."",array("Attachment"=>false));//para realizar o download somente alterar para true

file_put_contents("cotacao.pdf", $output);
// redirecionamos o usuário para o download do arquivo
die("<script>location.href='minuta.pdf';</script>");
?>

?>