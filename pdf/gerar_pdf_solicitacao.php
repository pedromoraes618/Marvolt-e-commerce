<?php
//referenciar o dompdf com namespace
include("../conexao/sessao.php");
require_once("../conexao/conexao.php"); 
require_once("../funcao/script.php"); 


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


	
	$pagina = 
		"<html>
        <header>
        <link href='css.css' rel='stylesheet'>s
        </header>
			<body>
				<table  id='dadosEmpresa'>
                    <tr>
                        <td><b>$razaoSocialEmpresa</b></td>
                    </tr>
                    <tr>
                         <td> $enderecoEmpresa </td>
                    </tr>
                    <tr>
                         <td>Cnpj:$cnpjEmpresa Inscrição EstadualL:$inscricaoEstadualEmpresa </td>
                       
                    </tr>
                    <tr>
                         <td>E-mail:$emailEmpresa   CONTATO:$contatoEmpresa </td>
                    </tr>

                </table>

                <div id='cabecalho'><p><b>Solicitação Nº $numeroSolicitacao </b></p></div>

                <table id='dadosCotacao'>
                <tr>
                    <td><b>Solicitação Nº:</b> </td>
                    <td><b>Data Envio:</b> $dataEnvio </td>
                </tr>
              
                   
           
                <tr>
                     <td><b>Validade do orçamento:</b>  dias úteis</td>
                     <td><b>Plano de pagamento:</b> </td>
                </tr>
                <tr>
                     <td><b>Modalidade do frete:</b>   </td>
                     <td><b>Prazo entrega:</b>   </td>
                </tr>
                
            </table>

            <div id='lista'></div>
		


            <div id='dadosCliente'>
            <table>

                <tr>
                    <td><b>Cliente:</b> $nomeFantasiaCliente </td>
                    <td><b>CPF/CNPJ:</b> $dadosCpfCnpj</td>
                </tr>
       
                <tr>
                    <td><b>Endereço:</b> $enderecoCliente - $numeroEnderecoCliente  </td>
                    <td><b>Cidade:</b> $cidadeCliente </td>
                </tr>

                <tr>
                    <td><b>Contato:</b> $contatoCliente  </td>
                    <td><b>Email:</b> $emailCliente </td>
                </tr>
            
        </table>";
        
        $pagina .= "<div id='dadosProduto'>
        <table width=100%  id='produto'>
        <tr id='cabecalhoTabela'>
            <td style='width:50px;'>Item</td>
            <td style='width:420px;'>Descrição</td>
            <td style='width:100px;'>Und</td>
            <td style='width:100px;'>Modelo</td>
            <td style='width:100px;'>Cor</td>
        </tr>
        </table>
        </div>";

      $pagina .= "<table width=100%> ";
       $linha = 0;
       $select = "SELECT p.cl_modelo,p.cl_modelo, p.cl_titulo,e.cl_descricao from tb_carrinho as cr 
       INNER JOIN tb_produto as p on cr.cl_produtoID = p.cl_id
       INNER JOIN tb_embalagem as e on p.cl_embalagem = e.cl_id where cr.cl_sessao = '$sessao' and cr.cl_cliente = '$clienteID'   ";
        $dados_produto = mysqli_query($conecta, $select);
        while($linha = mysqli_fetch_assoc($dados_produto)){
            $produto = $linha['cl_titulo'];
            $embalagem = $linha['cl_descricao'];
            $modelo = $linha['cl_modelo'];
            $seq = $seq +1;
            
        
        $pagina .= "
        <tr>
        <td style='width:50px;'>$seq</td>
        <td style='width:420px;'>$produto</td>
        <td style='width:100px;'>$embalagem</td>
        <td style='width:100px;'>$modelo</td>
        <td style='width:100px;'>P.Unitario</td>
        </tr>"; 
        };

        $pagina .= "</table>
        </html>";


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

