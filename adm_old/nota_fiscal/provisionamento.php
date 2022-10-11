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
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include_once("../_incluir/funcoes.php"); 
echo",";



//consultar forma de pagamento
$select = "SELECT formapagamentoID, nome, statuspagamento from forma_pagamento";
$lista_formapagamemto = mysqli_query($conecta,$select);
if(!$lista_formapagamemto){
    die("Falaha no banco de dados || select formapagma");
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


if(isset($_GET["codigo"])){
$nNfe =  $_GET["codigo"];
}

$consulta = "SELECT * FROM tb_nfe_entrada ";
$consulta .= " WHERE numero_nf = {$nNfe}";  

$dados_pedido= mysqli_query($conecta, $consulta);
if(!$dados_pedido){
die("Falaha no banco de dados");
}else{
    $linha = mysqli_fetch_assoc($dados_pedido);
    $cnpj = $linha['cnpj_cpf'];
    $valorContabilNf = $linha['valor_total_nota'];
}

//consultar cliente
$select = "SELECT clienteID, razaosocial,nome_fantasia,cpfcnpj from clientes ";
$lista_clientes = mysqli_query($conecta,$select);
if(!$lista_clientes){
    die("Falaha no banco de dados || select clientes");
}


if(isset($_POST['salvar'])){
    $hoje = date('Y-m-d'); 
    $numeroNf = $_POST['txtNumeroNf'];
    $valorPedido = utf8_decode($_POST["valorPedido"]);
    $formaPagamento = utf8_decode($_POST["txtFormaPagamento"]);
    $cliente = utf8_decode($_POST["txtCliente"]);
    $dataApagar = utf8_decode($_POST["txtaPagar"]);
    $documento = utf8_decode($_POST["txtNumeroDocumento"]);
    $valor = utf8_decode($_POST["valorDocumento"]);
    $mensagem = utf8_decode("Duplicata $documento referente a nota fiscal de entrada $nNfe");
    $salvar = $_POST['salvar'];
    

    $select = "SELECT sum(valor) as total from lancamento_financeiro WHERE numeroNotaFiscal = '$nNfe'";
    $lista_total_financeiro = mysqli_query($conecta,$select);
    if(!$lista_total_financeiro){
        die("Falha no banco de dados || select somatorio financeiro");
    }else{
        $row = mysqli_fetch_assoc($lista_total_financeiro);
        $total = $row['total'];
    }

    if($dataApagar == ""){
        ?>
<script>
alertify.alert("Favor preencher o campo valor parcela");
</script>
<?php
                }elseif(($total + $valor)>$valorPedido){
                    ?>
<script>
alertify.alert("Valor total das parcelas difere do valor total do pedido de compra");
</script>
<?php
                }elseif($formaPagamento == "0"){
                    ?>
<script>
alertify.alert("Favor informar a forma de pagamento da duplicata");
</script>
<?php

                }else{
                    	
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

  
                        $div1 = explode("/",$_POST['txtaPagar']);
                        $dataApagar = $div1[2]."-".$div1[1]."-".$div1[0]; 
                    $inserir = "INSERT INTO lancamento_financeiro ";
                    $inserir .= "( data_movimento,data_a_pagar,receita_despesa,status,forma_pagamentoID,clienteID,descricao,documento,grupoID,valor,numeroNotaFiscal)";
                    $inserir .= " VALUES ";
                    $inserir .= "( '$hoje','$dataApagar','Despesa','A Pagar','$formaPagamento','$cliente','$mensagem','$documento','17','$valor','$nNfe' )";

                    //verificando se está havendo conexão com o banco de dados
                    $operacao_inserir = mysqli_query($conecta, $inserir);
                    if(!$operacao_inserir){
                        die("Erro no banco de dados inserir_no_banco_de_dados");
                    }else{
                        $documento ="";
                        $dataApagar = "";
                        $valor = "";
                    }

                
                    $select = "SELECT sum(valor) as total from lancamento_financeiro WHERE numeroNotaFiscal = '$nNfe'";
                    $lista_total_financeiro = mysqli_query($conecta,$select);
                    if(!$lista_total_financeiro){
                        die("Falha no banco de dados || select somatorio financeiro");
                    }else{
                        $row = mysqli_fetch_assoc($lista_total_financeiro);
                        $total = $row['total'];
                    }
                   
                }
            }
    }
   
}


if(isset($_POST['salvar'])or (isset($_GET['codigo']))){
    $select = "SELECT * from lancamento_financeiro WHERE numeroNotaFiscal = '$nNfe'";
        $lista_financeiro = mysqli_query($conecta,$select);
        if(!$lista_financeiro){
            die("Falha no banco de dados || select financeiro");
        }
    
    $select = "SELECT sum(valor) as total from lancamento_financeiro WHERE numeroNotaFiscal = '$nNfe'";
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
        </p>Provisionamento Nota de Compra</p>
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
                                    <label for="txtcodigo" style="width:100px;"> <b>Nº Nfe:</b></label>
                                    <input readonly type="text" size=10 id="txtNumeroNf" name="txtNumeroNf" value="<?php 
                                        echo $nNfe;
                                    ?>">



                                    <label for="valorPedido"> <b>Vlr Nota</b></label>
                                    <input type="text" readonly size=10 id="valorPedido" name="valorPedido" value="<?php 
                                    echo ($valorContabilNf);
                                        ?>">


                                    <label for="txtFormaPagamento"><b>Forma do pagamento:</b></label>
                                    <select style="width: 205px;" id="txtFormaPagamento" name="txtFormaPagamento">
                                        <option value="0">Selecione</option>
                                        <?php 
                                     if($_POST){
                                        while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                                            $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);

                                        if($formaPagamentoPrincipal == $formaPagamento){
                                            ?> <option value="<?php echo $formaPagamento?>" selected>
                                            <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                        </option>

                                        <?php }else{ 
                                        ?>

                                        <option
                                            value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                            <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                        </option>
                                        <?php
   
                                        }
                                    }
                                        
                                    
                                     }else{
                                        
                                     }
                                        while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                                            $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);

                        ?>
                                        <option
                                            value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                            <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                        </option>
                                        <?php
   
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
                                        id="campoCliente" name="txtCliente">
                                        <option value="0">Selecione</option><?php 
                                        $meuCliente = $cnpj;
                                while($linha_clientes  = mysqli_fetch_assoc($lista_clientes)){
                                    $clientePrincipal = utf8_encode($linha_clientes["clienteID"]);
                                    $clienteCnpj = $linha_clientes['cpfcnpj'];
                                    
                                    if($meuCliente==$clienteCnpj){
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
                                <?php if(isset($_POST['salvar'])or (isset($_GET['codigo']))){?>
                                <tbody>
                                    <tr id="cabecalho_pesquisa_consulta">
                                        <td>
                                            <p style="margin-left:10px;">Nº</p>
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
                                            <p>Status</p>
                                        </td>
                                        <td>
                                            <p></p>
                                        </td>






                                    </tr>
                                    <?php


if(isset($_GET['codigo'])){
    $linhas = 0;
while($linha = mysqli_fetch_assoc($lista_financeiro)){
    $dataLancamento= utf8_encode($linha['data_movimento']);
    $dataApagarB = utf8_encode($linha['data_a_pagar']);
    $documentoB = utf8_encode($linha['documento']);
    $valorB = $linha['valor'];
    $lancamentoID = $linha['lancamentoFinanceiroID'];
    $status = $linha['status'];


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

                                        <td style="width: 150px;">

                                            <font size="2"><?php echo $status;?> </font>

                                        </td>

                                        <td id="botaoEditar">


                                            <a
                                                onclick="window.open('../financeiro/editar_despesa.php?codigo=<?php echo $lancamentoID;?>', 
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