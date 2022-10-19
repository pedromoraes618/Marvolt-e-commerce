<?php
//referenciar o dompdf com namespace
include("../../conexao/sessao.php");
require_once("../../conexao/conexao.php"); 
include("../../funcao/script.php");
include('../../tcpdf/tcpdf.php');


//consultar os dados da empresa pelo id 
$consulta = "SELECT * from tb_empresa ";
$dados_empresa= mysqli_query($conecta, $consulta);
while($row_empresa = mysqli_fetch_assoc($dados_empresa)){
    $razaoSocialEmpresa = utf8_encode($row_empresa['cl_razao_social']);
    $enderecoEmpresa = utf8_encode($row_empresa['cl_endereco']);
    $cnpjEmpresa = utf8_encode($row_empresa['cl_cnpj']);
    $inscricaoEstadualEmpresa = utf8_encode($row_empresa['cl_inscricao_estadual']);
    $emailEmpresa = utf8_encode($row_empresa['cl_email']);
    $contatoEmpresa = utf8_encode($row_empresa['cl_telefone']);
}

if(isset($_GET['gerarSolicitacao']));
    if($_GET['gerarSolicitacao']=="true"){    
    $idPedido = $_GET['idPedido'];
    $sessao = $_GET['sessao'];
    $select = "SELECT p.cl_cliente as id_cliente,c.cl_email,c.cl_telefone,c.cl_cidade,c.cl_cnpj,c.cl_cpf,c.cl_logadouro,c.cl_numero, c.cl_razao_social,c.cl_nome_fantasia,p.cl_data,c.cl_nome_fantasia,c.cl_cnpj,c.cl_cpf,c.cl_bairro,c.cl_cep,c.cl_logadouro,
   p.cl_codigo as codigo from tb_pedido as p inner join tb_cliente as c on c.cl_id = p.cl_cliente where p.cl_id = {$idPedido}";
    $dados_solicitacao= mysqli_query($conecta, $select);
    while($linha = mysqli_fetch_assoc($dados_solicitacao)){
    $razaoSocialCliente = $linha['cl_razao_social'];
    $nomeFantasiaCliente = $linha['cl_nome_fantasia'];
    $enderecoCliente = $linha['cl_logadouro'];
    $numeroEnderecoCliente = $linha['cl_numero'];
    $numeroSolicitacao = $linha['codigo'];
    $dataEnvio =  formatDateB($linha['cl_data']);
    $clienteID = $linha['id_cliente'];
    $cnpjCliente = $linha['cl_cnpj'];
    $cpfCliente = $linha['cl_cpf'];
    $cidadeCliente = $linha['cl_cidade'];
    $contatoCliente = $linha['cl_telefone'];
    $emailCliente = $linha['cl_email'];

    //condicao para verificar se o cliente é fisico ou juridico
    if(($cnpjCliente=="") and ($cpfCliente!="")){
        $dadosCpfCnpj = $cpfCliente; //dados cpfcnj vai receber o cpf do cliente - cliente fisico
    }elseif(($cnpjCliente!="") and ($cpfCliente=="")){
        $dadosCpfCnpj = $cnpjCliente; //dados cpfcnj vai receber o cnpj do cliente - cliente juridico
    }
    }

}

$date = date('d/m/Y');
$seq = 0;

$html= "<table width=100% id='tempresa'>";
$html .= "<tr><td > <img width=150px height=90px src='../../img/logopdf.jpg' ></td></tr>"; 
$html .="<tr><td align=left><font size=3><b>" . $razaoSocialEmpresa . "</b></font></td></tr>";

$html .="<tr><td align=left><font size=3>" . $enderecoEmpresa . "</font></td></tr>";
$html .="<tr><td align=left><font size=3>CNPJ:" . $cnpjEmpresa . " INSCRIÇÃO ESTADUAL:". $inscricaoEstadualEmpresa."</font></td></tr>";
$html .="<tr><td align=left><font size=3>E-MAIL:" . $emailEmpresa . " CONTATO:".$contatoEmpresa."</font></td></tr>";

$html .= "</table>";
$html .= "<p>";
$html .= "<p align=center><b>Solicitação Nª ".$numeroSolicitacao ."</b><p>";
$html .= "<p>";

//dados cotacao
$html .= "<table id='tcotacao' >";
$html .="<tr><td align=left><font size=3><b>Solicitação de cotação Nº: </b>" . $numeroSolicitacao . "</font></td><td align=left><font size=3><b>Data: </b>" . ($numeroSolicitacao) . "</font></td></tr>";

$html .="<tr><td align=left><font size=3><b>Validade do orçamento: </b>" . $numeroSolicitacao . " dias </font></td><td align=left><font size=3><b>Plano de pagamento: </b>" . $numeroSolicitacao . " dias </font></td></tr>";
$html .="<tr><td align=left><font size=3><b>Modalidade do Frete: </b>" . $numeroSolicitacao . "</font></td>";
$html .= "</table>";
$html .= "<div id='linha'></div>";
$html .= "<p>";

//dados cliente

$html .= "<div id='dadosCliente'>";
$html .= "<table id='tcliente'>";
$html .="<tr><td align=lefts><font size=3><b>Cliente: </b>" . $nomeFantasiaCliente . "</font></td><td align=left><font size=3><b>CPF/CNPJ: </b>" . $dadosCpfCnpj . "</font></td></tr>";
$html .="<tr><td align=left><font size=3><b>Endereço: </b>" . $enderecoCliente . " </font></td><td align=left><font size=3><b>Cidade: </b>" . $cidadeCliente ."</font></td></tr>";
$html .="<tr><td align=left><font size=3><b>Contato: </b>" . $contatoCliente . "</font></td><td align=left><font size=3><b>E-Mail: </b>" . $emailCliente . "</font></td></tr>";
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



$select = "SELECT p.cl_modelo,p.cl_modelo, p.cl_titulo,e.cl_descricao from tb_carrinho as cr 
INNER JOIN tb_produto as p on cr.cl_produtoID = p.cl_id
INNER JOIN tb_embalagem as e on p.cl_embalagem = e.cl_id where cr.cl_sessao = '$sessao' and cr.cl_cliente = '$clienteID'   ";
 $dados_produto = mysqli_query($conecta, $select);
 while($linha = mysqli_fetch_assoc($dados_produto)){
     $produto = $linha['cl_titulo'];
     $embalagem = $linha['cl_descricao'];
     $modelo = $linha['cl_modelo'];
     $seq = $seq +1;
     
$html .="<tr>";
$html .="<td align=center style=width:50px;><font size=2>".$seq."</font></td>";
$html .="<td align=left style=width:500px;><font size=2> ".($produto)." </font></td>";
$html .="<td align=left ><font size=2>".$embalagem." </font></td>";
$html .="<td align=left><font size=2>".($modelo)." </font></td>";
$html .="<td align=left><font size=2>".($modelo)." </font></td>";
$html .="<td align=left><font size=2>".($modelo)." </font></td>";
$html .="<td align=left><font size=2>".($modelo)."</font></td>";
$html .="</tr>";
}



$html .= "</table>";
$html .= "<div id='linhaTotal'></div>";
$html .= "<table width=100%>";
$html .="<tr>";
$html .="<td align=left style=width:200px;><font size=2><b>TOTAL DE ITENS ".$numeroSolicitacao."</b></font></td>";
$html .="<td align=right style=width:200px;><font size=2><b>VALOR TOTAL DO PEDIDO: ".($numeroSolicitacao)."</b></font></td>";
$html .="</tr>";

$html .= "<table>";
$html .="<tr>";
$html .="<td></td>";
$html .="</tr>";
$html .= "</table>";

$html .= "</table>";
$html .= "<table>";
$html .="<tr>";
$html .="<td align=left><font size=2>".$numeroSolicitacao."</font></td>";
$html .="</tr>";
$html .= "</table>";

$html .= "<table>";
$html .="<tr>";
$html .="<td></td>";
$html .="</tr>";
$html .= "</table>";





use Dompdf\Dompdf;

require_once("../../pdf/dompdf/autoload.inc.php");

$dompdf = new DOMPDF();
$dompdf->setPaper('a4', 'landscape');
$codigo_html = $html;
$dompdf -> loadHtml('<link href="../../_css/solicitacaoPdf.css" rel="stylesheet">'. $codigo_html );

ob_clean(); 
$dompdf->render();
//renderizar com o html


//exibibir a página
$dompdf ->stream("Solicitação Nº:".$numeroSolicitacao."",array("Attachment"=>false));//para realizar o download somente alterar para true

file_put_contents("cotacao.pdf", $output);
// redirecionamos o usuário para o download do arquivo
die("<script>location.href='minuta.pdf';</script>");
?>

?>