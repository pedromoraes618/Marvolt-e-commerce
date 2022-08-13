<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />

<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");
include_once("../_incluir/funcoes.php"); 
echo",";

//consultar forma de pagamento
$select = "SELECT formapagamentoID, nome, statuspagamento from forma_pagamento";
$lista_formapagamemto = mysqli_query($conecta,$select);
if(!$lista_formapagamemto){
    die("Falaha no banco de dados || select formapagma");
}


//consultar cliente
$select = "SELECT clienteID, razaosocial,nome_fantasia from clientes";
$lista_clientes = mysqli_query($conecta,$select);
if(!$lista_clientes){
    die("Falaha no banco de dados || select clientes");
}

//consultar status do pedido
$select = "SELECT statuspedidoID, nome from status_pedido";
$lista_statuspedido = mysqli_query($conecta,$select);
if(!$lista_statuspedido){
    die("Falaha no banco de dados || select statuspedido");
}

//consultar status da compra
$select = "SELECT statuscompraID, nome from status_compra";
$lista_statuscompra = mysqli_query($conecta,$select);
if(!$lista_statuscompra){
    die("Falaha no banco de dados || select statuscompra");
}

$select = "SELECT statuscompraID, nome from status_compra";
$lista_statuscompra = mysqli_query($conecta,$select);
if(!$lista_statuscompra){
    die("Falaha no banco de dados || select statuscompra");
}






$consulta = "SELECT * FROM pedido_compra ";
if(isset($_GET["codigo"])){
    $pedidoID =  $_GET["codigo"];
    $codigo_pedido =  $_GET["codigoPedido"];
    $nPedido =  $_GET["nPedido"];
$consulta .= " WHERE codigo_pedido = {$codigo_pedido} and pedidoID = {$pedidoID}";  
}
$dados_pedido= mysqli_query($conecta, $consulta);
if(!$dados_pedido){
die("Falaha no banco de dados");
}else{
    $linha = mysqli_fetch_assoc($dados_pedido);
    $numeroPedidoCompraB =  utf8_encode($linha['numero_pedido_compra']);
    $numeroOrcamentoB = utf8_encode($linha['numero_orcamento']);
    $numeroNfeB = utf8_encode($linha['numero_nf']);
    $formaPagamentoB = utf8_encode($linha['forma_pagamento']);
    $clienteB = utf8_encode($linha['clienteID']);
    $statusCompraB = utf8_encode($linha['status_da_compra']);
    $statusPedidoB = utf8_encode($linha['status_do_pedido']);
    $dataCompraB = utf8_encode($linha['data_compra']);
    $dataChegadaPrevistaB = utf8_encode($linha['data_chegada_prevista']);
    $dataChegadaB = utf8_encode($linha['data_chegada']);
    $entregaPrevistaB = utf8_encode($linha['entrega_prevista']);
    $entregaRealizadaB = utf8_encode($linha['entrega_realizada']);
    $valorComDescontoB  = utf8_encode($linha['valor_total']);
    $descontoGeralB  = utf8_encode($linha['desconto_geral']);
    $valorTotalMargemB  = utf8_encode($linha['valor_total_margem']);
    $valorTotalCompraB  = utf8_encode($linha['valor_total_compra']);

    
}




if(isset($_POST['salvar'])){
    $hoje = date('Y-m-d'); 
    $numeroPedidoCompra = utf8_decode($_POST["txtNumeroPedido"]);
    $valorPedido = utf8_decode($_POST["valorPedido"]);
    $formaPagamento = utf8_decode($_POST["txtFormaPagamento"]);
    $cliente = utf8_decode($_POST["txtCliente"]);
    $dataApagar = utf8_decode($_POST["txtaPagar"]);
    $documento = utf8_decode($_POST["txtNumeroDocumento"]);
    $valor = utf8_decode($_POST["valorDocumento"]);
    $menagem = utf8_decode("Lançamento referente ao pedido de compra Nº $numeroPedidoCompra");

    //não deixa duplicar o post
if( $_SERVER['REQUEST_METHOD']=='POST' )
{
    $request = md5( implode( $_POST ) );
    
    if( isset( $_SESSION['last_request'] ) && $_SESSION['last_request']== $request )
    {
        $documento ="";
        $dataApagar = "";
        $valor = "";
    }
    else
    {
        
    $_SESSION['last_request']  = $request;
    $select = "SELECT sum(valor) as totalPedido from lancamento_financeiro WHERE numeroPedido = '$nPedido'";
    $lista_total_financeiro = mysqli_query($conecta,$select);
    if(!$lista_total_financeiro){
        die("Falha no banco de dados || select somatorio financeiro");
    }else{
        $row = mysqli_fetch_assoc($lista_total_financeiro);
        $totalPedido = $row['totalPedido'];
    }

                if($valor == ""){
                    ?>
<script>
alertify.alert("Favor preencher o campo valor");
</script>
<?php
                }elseif(($totalPedido + $valor)>$valorPedido){
                    ?>
<script>
alertify.alert("Valor total das parcelas difere do valor total do pedido de compra");
</script>
<?php
                }elseif($documento==""){
                    ?>
<script>
alertify.alert("Favor preencher o campo Documento");
</script>
<?php   
                }elseif($dataApagar==""){
                    ?>
<script>
alertify.alert("Favor preencher o campo data a pagar");
</script>
<?php   
                }else{
                  
                    $div1 = explode("/",$_POST['txtaPagar']);
                    $dataApagar = $div1[2]."-".$div1[1]."-".$div1[0]; 
                    $inserir = "INSERT INTO lancamento_financeiro ";
                    $inserir .= "( data_movimento,data_a_pagar,receita_despesa,status,forma_pagamentoID,clienteID,descricao,documento,grupoID,valor,numeroPedido)";
                    $inserir .= " VALUES ";
                    $inserir .= "( '$hoje','$dataApagar','Receita','A Receber','$formaPagamento','$cliente','$menagem','$documento','15','$valor','$numeroPedidoCompra' )";
    
                    //verificando se está havendo conexão com o banco de dados
                    $operacao_inserir = mysqli_query($conecta, $inserir);
                    if(!$operacao_inserir){
                  
                        die("Erro no banco de dados inserir_no_banco_de_dados");
                     
                    }else{
                        $documento ="";
                        $dataApagar = "";
                        $valor = "";
                    }

                    

                    $select = "SELECT sum(valor) as totalPedido from lancamento_financeiro WHERE numeroPedido = '$nPedido'";
                    $lista_total_financeiro = mysqli_query($conecta,$select);
                    if(!$lista_total_financeiro){
                        die("Falha no banco de dados || select somatorio financeiro");
                    }else{
                        $row = mysqli_fetch_assoc($lista_total_financeiro);
                        $totalPedido = $row['totalPedido'];
                    }

                    if($totalPedido == $valorPedido ){
                        $update = "UPDATE pedido_compra set status_recebimento = '1' where numero_pedido_compra = '{$numeroPedidoCompra}'";
                        $operacao_update = mysqli_query($conecta, $update);
                        if(!$operacao_update){
                            die("Erro no banco de dados update no status recebimento tabela pedido de compra");
                        }
                        
                    }
                  

                
    }
    }
}
    
}

if(isset($_POST['salvar'])or (isset($_GET['nPedido']))){
    $select = "SELECT * from lancamento_financeiro WHERE numeroPedido = '$nPedido'";
        $lista_financeiro = mysqli_query($conecta,$select);
        if(!$lista_financeiro){
            die("Falha no banco de dados || select financeiro");
        }
    
    $select = "SELECT sum(valor) as total from lancamento_financeiro WHERE numeroPedido = '$nPedido'";
        $lista_total_financeiro = mysqli_query($conecta,$select);
        if(!$lista_total_financeiro){
            die("Falha no banco de dados || select somatorio financeiro");
        }
    }




?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <?php 
    include("../classes/select2/select2_link.php")
    ?>
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>

</head>

<body>
    <div id="titulo">
        </p>Recebimento Pedido de Compra</p>
    </div>
    <tr>
        <form action="" autocomplete="off" method="post">


            <main>
                <div style="margin:0 auto; width:1400px; ">
                    <form action="" method="post">
                        <table style="float:left; width:1400px; margin-bottom: 10px; border:1px solid;">
                            <table style="float:right; ">
                                <button type="button" style="float:right" name="btnfechar"
                                    onclick="window.opener.location.reload();fechar();"
                                    class="btn btn-secondary">Voltar</button>
                                </td>
                            </table>

                        </table>

                        <table style="float:left; width:1400px; margin-bottom: 10px;border-bottom:1px solid #ddd; ; ">
                            <tr>
                            <tr>
                                <td>
                                    <label for="txtcodigo" style="width:100px;"> <b>Nº pedido:</b></label>
                                    <input readonly type="text" size=10 id="txtNumeroPedido" name="txtNumeroPedido"
                                        value="<?php 
                                        echo $numeroPedidoCompraB;
                                    ?>">



                                    <label for="valorPedido"> <b>Vlr pedido</b></label>
                                    <input type="text" readonly size=10 id="valorPedido" name="valorPedido" value="<?php 
                                    echo $valorComDescontoB;
                                        ?>">


                                    <label for="txtFormaPagamento"><b>Forma do pagamento:</b></label>
                                    <select style="width: 205px;" id="txtFormaPagamento" name="txtFormaPagamento">
                                        <option value="0">Selecione</option>
                                        <?php 
                                        $meuFormaPagamento = $formaPagamentoB;
                            while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                                $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);

                               if($meuFormaPagamento==$formaPagamentoPrincipal){
                                ?> <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>"
                                            selected>
                                            <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                        </option>

                                        <?php }else{ ?>
                                        <option
                                            value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                            <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                        </option>
                                        <?php
   
                                        }
                                        
                                    }
                                
                                                           
                                
                                
                                                        ?>

                                    </select>


                                </td>
                            </tr>



                        </table>


                        <table style="float:left; width:850px; margin-bottom:30px">

                            <tr>
                                <td>
                                    <label for="txtCliente" style="width:100px;"> <b>Empresa:</b></label>
                                    <select style="margin-right: 60px; margin-bottom:10px; width:580px;"
                                        id="campoCliente" name="txtCliente"><?php 
                                        $meuCliente = $clienteB;
                                while($linha_clientes  = mysqli_fetch_assoc($lista_clientes)){
                                    $clientePrincipal = utf8_encode($linha_clientes["clienteID"]);
       
                                    if($meuCliente==$clientePrincipal){
                                    ?> <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>"
                                            selected>
                                            <?php echo utf8_encode($linha_clientes["nome_fantasia"]);?>
                                        </option>

                                        <?php
                                             }else{
                                    
                                   ?>
                                        <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>">
                                            <?php echo utf8_encode($linha_clientes["nome_fantasia"]);?>
                                        </option>
                                        <?php
       
               }
               
           }
       
                                 
       
       
                         ?>

                                    </select>
                                </td>
                            </tr>
                        </table>
                        <table style="float:left; width:1400px; margin-bottom: 10px;border-top:1px solid #ddd; ; ">
                            <tr>
                            <tr>
                                <td>
                                    <label for="txtNumeroDocumento" style="width:100px;"> <b>Documento:</b></label>
                                    <input type="text" size=10 id="txtNumeroDocumento" name="txtNumeroDocumento" value="<?php
                                        if(isset($_POST['salvar'])){
                                            echo $documento;
                                        }
                                    ?>">
                                    <label for="txtaPagar"> <b>Data a pagar:</b></label>
                                    <input type="text" size=12 id="txtaPagar" name="txtaPagar" value="<?php
                                      if(isset($_POST['salvar'])){
                                        echo $dataApagar;
                                    }
                                    ?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                                    <label for="valorDocumento"> <b>Vlr parcela</b></label>
                                    <input type="text" size=10 id="valorDocumento" name="valorDocumento" value="<?php 
                                   if(isset($_POST['salvar'])){
                                    echo $valor;
                                }
                                        ?>"> <input type="submit" id="" name="salvar" class="btn btn-success"
                                        value="Adicionar">
                                </td>
                            </tr>
                        </table>



                        <form action="consulta_produto.php" method="post">

                            <table border="0" cellspacing="0" width="1400px;" class="tabela_pesquisa"
                                style="margin-top:10px;">
                                <?php if(isset($_POST['salvar'])or (isset($_GET['nPedido']))){?>
                                <tbody>
                                    <tr id="cabecalho_pesquisa_consulta">
                                        <td>
                                            <p style="margin-left:10px;">Qtd</p>
                                        </td>
                                        <td>
                                            <p>Lançamento</p>
                                        </td>

                                        <td>
                                            <p>Data a pagar</p>
                                        </td>
                                        <td>
                                            <p>Documento</p>
                                        </td>
                                        <td>
                                            <p>Valor</p>
                                        </td>
                                        <td>
                                            <p></p>
                                        </td>






                                    </tr>
                                    <?php


if($nPedido !=""){
    $linhas = 0;
while($linha = mysqli_fetch_assoc($lista_financeiro)){
    $dataLancamento= utf8_encode($linha['data_movimento']);
    $dataApagarB = utf8_encode($linha['data_a_pagar']);
    $documentoB = utf8_encode($linha['documento']);
    $valorB = $linha['valor'];
    $lancamentoID = $linha['lancamentoFinanceiroID'];


?>

                                    <tr id="linha_pesquisa">

                                        <td style="width: 70px; ">
                                            <p style="margin-left: 15px; margin-top:10px;">
                                                <font size="3"><?php echo $linhas = $linhas +1;?></font>
                                            </p>
                                        </td>
                                        <td style="width: 150px;">

                                            <font size="2"><?php echo formatardataB($dataLancamento);?> </font>

                                        </td>

                                        <td style="width: 150px;">

                                            <font size="2"><?php echo formatardataB($dataApagarB);?> </font>

                                        </td>

                                        <td style="width: 150px;">

                                            <font size="2"><?php echo $documentoB;?> </font>

                                        </td>

                                        <td style="width: 150px;">
                                            <font size="2"><?php echo real_format($valorB);?> </font>
                                        </td>



                                        <td id="botaoEditar">


                                            <a
                                                onclick="window.open('../financeiro/editar_receita.php?codigo=<?php echo $lancamentoID;?>', 
'editar_produto_cotacao', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">

                                                <button type="button" class="btn btn-warning"
                                                    name="editar">Editar</button>
                                            </a>

                                        </td>


                                    </tr>

                                    <?php
}

while($linha = mysqli_fetch_assoc($lista_total_financeiro)){
$total = $linha['total'];

?>


                                    <tr id="cabecalho_pesquisa_consulta">
                                        <td>
                                            <p></p>
                                        </td>


                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <font size="2"><?php echo real_format($total);?> </font>
                                        </td>
                                        <td>

                                        </td>





                                    </tr>
                                </tbody>
                                <?php }}}?>
                            </table>
                        </form>



                    </form>
                </div>
            </main>
            <?php include '../_incluir/funcaojavascript.jar'; ?>
            <?php include '../classes/select2/select2_java.php'; ?>
            <script>
            function fechar() {
                window.close();
            }

            function calculavalormargem() {
                var campoPrecoVenda = document.getElementById("txtprecoUnitarioVenda").value;
                var campoPrecoCompra = document.getElementById("txtprecoUnitarioCompra").value;
                var campoMargem = document.getElementById("txtMargem");
                var calculo;

                campoPrecoVenda = parseFloat(campoPrecoVenda);
                campoPrecoCompra = parseFloat(campoPrecoCompra);

                calculo = (((campoPrecoVenda - campoPrecoCompra) / campoPrecoVenda) * 100).toFixed(2);
                campoMargem.value = calculo;
            }
            </script>
            <script>
            function calculavalordesconto() {
                var campoDesconto = document.getElementById("txtDescontoGeral").value;
                var campoValorTotalH = document.getElementById("txtValorTotal").value;
                var campoValorTotal = document.getElementById("txtValorTotalComDesconto");
                var calculoDesconto;
                var calculoTotalCDesconto;


                campoValorTotalH = parseFloat(campoValorTotalH);
                campoDesconto = parseFloat(campoDesconto);

                calculoDesconto = ((campoValorTotalH * campoDesconto) / 100);
                calculoTotalCDesconto = (campoValorTotalH - calculoDesconto).toFixed(2);
                campoValorTotal.value = calculoTotalCDesconto;


            }
            </script>

</body>

</html>

<?php
mysqli_close($conecta);
?>