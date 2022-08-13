<?php

include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include_once("../_incluir/funcoes.php"); 
//inportar o alertar js
include('../alert/alert.php');

echo",";

if(isset($_GET["codigo"])){
    $pedidoID =  $_GET["codigo"];
    $codigo_pedido =  $_GET["codigoPedido"];
}


//vericar o total de produtos que estão incluso no pedido de compra
    $select = "SELECT count(data_chegada_prevista) as produto_chegada from tb_pedido_item  where pedidoID = '$codigo_pedido'  ";
    $lista_produto_pedido = mysqli_query($conecta,$select);
    if(!$lista_produto_pedido){
        die("Falha no banco de dados || select produto_pedido");
    }else{
        $linha = mysqli_fetch_assoc($lista_produto_pedido);
        $totalDeProdutos = $linha['produto_chegada'];
       
    }
//vericar o total de produtos que estão com a data de chegada preenchidas
    $select = "SELECT count(data_chegada) as produto_chegada from tb_pedido_item  where pedidoID = '$codigo_pedido' and data_chegada <> '0000.00.00'  ";
    $lista_produto_pedido = mysqli_query($conecta,$select);
    if(!$lista_produto_pedido){
        die("Falha no banco de dados || select produto_pedido");
    }else{
        $linha = mysqli_fetch_assoc($lista_produto_pedido);
        $produtoChegou = $linha['produto_chegada'];
       
    }
    
   //update na tabela pedido de compra na coluna entrega_realizada
   if(isset($_POST['salvar'])){
    $entregaRealizada = utf8_decode($_POST["txtEntregaRealizada"]);
    $observacao = utf8_decode($_POST["observacao"]);
    
    if($totalDeProdutos!=$produtoChegou){
        ?>
<script>
alertify.error("Operação cancelada");
</script>
<?php
        if($entregaRealizada !=""){
            ?>
<script>
alertify.alert("Não é possivel incluir a data de entrega, alguns produtos estão com o status a chegar");
</script>
<?php
        }
     
}else{
        if($entregaRealizada !=""){
        $div1 = explode("/",$_POST['txtEntregaRealizada']);
        $entregaRealizada = $div1[2]."-".$div1[1]."-".$div1[0];  
        }
        $alterar = "UPDATE pedido_compra set entrega_realizada = '{$entregaRealizada}', observacao = '{$observacao}' where codigo_pedido = '$codigo_pedido' ";
        $lista_pedido_de_compra = mysqli_query($conecta,$alterar);
        if(!$lista_pedido_de_compra){
        die("Falha no banco de dados || select pedido_compra");
        }else{
            ?>
<script>
alertify.success("Dados alterados");
</script>
<?php
            
            }

        
    }

    $alterar = "UPDATE pedido_compra set  observacao = '{$observacao}' where codigo_pedido = '$codigo_pedido' ";
    $lista_pedido_de_compra = mysqli_query($conecta,$alterar);
    
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




//Consultar os dados do pedido banco de dados
$consulta = "SELECT * FROM pedido_compra ";

$consulta .= " WHERE codigo_pedido = {$codigo_pedido} and pedidoID = {$pedidoID}";  
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
    $dataFechamentoB  = utf8_encode($linha['data_fechamento']);
    $observacaoB  = utf8_encode($linha['observacao']);

}




//consultar os produtos do pedido de compra!
if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa']))  or (isset($_POST['salvar'])) or (!isset($_GET['pesquisar']))) {
    $selectProduto =  " SELECT  produto , pedidoID ,pedido_itemID, unidade,data_chegada_prevista,data_chegada, quantidade,preco_compra_unitario,preco_venda_unitario,margem,desconto,status_compra from tb_pedido_item where pedidoID = '$codigo_pedido'";
    $lista_Produto= mysqli_query($conecta, $selectProduto);
    if(!$lista_Produto){
    die("Falha no banco de dados || pesquisar produto ");
    }
    
        }

        if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or  (isset($_POST['salvar'])) or (!isset($_POST['pesquisar'])))  {
  
            $selectProdutoSoma =  " SELECT  sum(preco_venda_unitario*quantidade) as somaVenda, sum(preco_compra_unitario*quantidade) as somaCompra from tb_pedido_item where pedidoID = '$codigo_pedido'";
            $lista_Produto_Soma= mysqli_query($conecta, $selectProdutoSoma);
            if(!$lista_Produto_Soma){
            die("Falha no banco de dados || pesquisar produto ");
            }else{$linha_soma = mysqli_fetch_assoc($lista_Produto_Soma);
                $somaVenda = $linha_soma['somaVenda'];
                $somaCompra = $linha_soma['somaCompra'];
                
              
            
            }
            
                }

                

if(isset($_POST['pesquisar'])){
        $select = "SELECT * from produto_cotacao  where numero_orcamento = '$numeroOrcamento'";
        $lista_produto_cotacao = mysqli_query($conecta,$select);
        if(!$lista_produto_cotacao){
            die("Falha no banco de dados || select produto_cotacao");
        }
    }


    $select = "SELECT * from pedido_compra  where codigo_pedido = '$codigo_pedido' ";
    $lista_produto_pedido = mysqli_query($conecta,$select);
    if(!$lista_produto_pedido){
        die("Falha no banco de dados || select produto_pedido");
    }else{
        $linha = mysqli_fetch_assoc($lista_produto_pedido);
        $entrega_realizada = $linha['entrega_realizada'];
    
        
    }


    $select = "SELECT * from tb_pedido_item  where pedidoID = '$codigo_pedido' ";
    $lista_produto_pedido = mysqli_query($conecta,$select);
    if(!$lista_produto_pedido){
        die("Falha no banco de dados || select produto_pedido");
    }else{
        $linha = mysqli_fetch_assoc($lista_produto_pedido);
        $dataChegadaPrevista = $linha['data_chegada_prevista'];
        $dataChegada= $linha['data_chegada'];
    }

 

 
?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>

</head>

<body>
    <div id="titulo">
        </p>Produtos do pedido de compra Nº <?php echo $numeroPedidoCompraB;?> </p>
    </div>
    <form method="post">
        <table>
            <tr>
                <td>
                    <div style="text-align:center;">
                        Status:
                        <?php if ($entrega_realizada == "0000-00-00" or $entrega_realizada == "" ){
            
            if($totalDeProdutos==$produtoChegou){
                ?><font size="4">
                            <p style="color:green;">

                                <?php  echo "Pronto para a entrega "?><i class="fa-solid fa-people-carry-box"></i>

                            </p>

                            <?php
            }else{
            ?>
                            <font size="4">
                                <p style="color:gold;">

                                    <?php  echo "Aguardando chegada de produtos  ". $produtoChegou . "/".$totalDeProdutos;?>

                                </p>
                            </font>
                            <?php
        
             }     
              
        }else{
                            ?>
                            <font size="4">
                                <p style="color:green;">
                                    <?php echo" Entrega Realizada";
                        } ; ?>

                                </p>
                            </font>


                    </div>
                </td>
            </tr>
        </table>
        <table border="0" cellspacing="0" id="tabela_pesquisa" width="100%" style="margin-top:10px;">
            <?php if((isset($_POST['adicionar']))  or (isset($_POST['fecharPesquisa']))  or (isset($_POST['salvar'])) or (!isset($_POST['pesquisar']))) {?>
            <tbody>
                <tr id="cabecalho_pesquisa_consulta">
                    <td>
                        <p style="margin-left:10px;">Item</p>
                    </td>

                    <td>
                        <p>Descrição</p>
                    </td>
                    <td>
                        <p>Und</p>
                    </td>
                    <td>
                        <p>Qtd</p>
                    </td>
                    <td>
                        <p>Total CP</p>
                    </td>
                    <td>
                        <p>Total Vnd</p>
                    </td>

                    <td>
                        <p>Chegada Prevista</p>
                    </td>

                    <td>
                        <p>Data Chegada</p>
                    </td>
                    <td>
                        <p></p>
                    </td>


                    <td>

                    </td>





                </tr>
                <?php

    $linhas = 0;
while($linha = mysqli_fetch_assoc($lista_Produto)){
  
    $produtoB = utf8_encode($linha['produto']);
    $unidadeB = utf8_encode($linha['unidade']);
    $quantidadeB = $linha['quantidade'];
    $precoCompraB = $linha['preco_compra_unitario'];
    $precoVendaB = $linha['preco_venda_unitario'];
    $margemB = $linha['margem'];
    $chegadaPrevistaB = $linha['data_chegada_prevista'];
    $chegadaB = $linha['data_chegada'];
    $descontoB = $linha['desconto'];
    $statusCompraB = $linha['status_compra'];
    $pedidoID = $linha['pedidoID'];
    $pedido_item_id = $linha['pedido_itemID'];

   
   
?>

                <tr id="linha_pesquisa">

                    <td style="width: 70px; ">
                        <p style="margin-left: 15px; margin-top:10px;">
                            <font size="3"><?php echo $linhas = $linhas +1;?></font>
                        </p>
                    </td>

                    <td style="width: 550px;">

                        <font size="2"><?php echo $produtoB;?> </font>

                    </td>

                    <td style="width: 80px;">

                        <font size="2"><?php echo $unidadeB;?> </font>

                    </td>

                    <td style="width: 60px;">
                        <font size="2"><?php echo $quantidadeB;?> </font>
                    </td>

                    <td style="width: 100px;">
                        <font size="2"><?php echo real_format($quantidadeB*$precoCompraB)?> </font>
                    </td>

                    <td style="width: 100px;">
                        <font size="2"><?php echo real_format($quantidadeB*$precoVendaB)?> </font>
                    </td>


                    <td style="width: 150px;">
                        <font size="2"> <?php if($chegadaPrevistaB=="0000-00-00") {
                               echo ("");

                                  }elseif($chegadaPrevistaB=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($chegadaPrevistaB); } ?></font>

                    </td>



                    <td style="width: 150px;">
                        <font size="2"> <?php if($chegadaB=="0000-00-00") {
                               echo ("");

                                  }elseif($chegadaB=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($chegadaB); } ?></font>
                    </td>



                    <td style="width:120px;">
                        <font size="2">
                            <?php if($chegadaB!=0000-00-00 ){
                                ?> <i style="font-size: 20px; margin-left:10px" title="Produto Chegou"
                                class="fa-solid fa-check-double"></i>
                            <?php }?>
                        </font>
                    </td>


                    <td id="botaoEditar">

                        <a
                            onclick="window.open('editar_produto_check_pedido.php?codigo=<?php echo $pedidoID; ?>&produtoCodigo=<?php echo $pedido_item_id;?>',
                            'editar_produto_cotacao', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=500');">

                            <button type="button" class="btn btn-warning" name="editar">Editar</button>
                        </a>

                    </td>


                </tr>

                <?php
}
?>
                <tr id="cabecalho_pesquisa_consulta">
                    <td>
                        <font size=2>
                            <p style="margin-left:10px;">Total</p>
                        </font>
                    </td>

                    <td>

                    </td>
                    <td>

                    </td>

                    <td>

                    </td>
                    <td>
                        <font size=2><?php echo  real_format($somaCompra);?></font>
                    </td>
                    <td>
                        <font size=2><?php echo  real_format($somaVenda);?></font>
                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>
                    </td>



                    <td>
                        <p></p>
                    </td>


                </tr>



            </tbody>

            </tr>

            <?php
if($descontoGeralB > 0 ){

?>
            <tr id="cabecalho_pesquisa_consulta" style="background-color:white">
                <td>
                    <font size=2>
                        <p style=" margin-left:10px;">Com desconto</p>
                    </font>
                </td>

                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>
                    <font size=2><?php echo  real_format($somaCompra);?></font>
                </td>


                <td>
                    <font size=2><?php echo  real_format($valorComDescontoB);?></font>
                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>


                <td>
                    <p></p>
                </td>

            </tr>



            </tbody>
            <?php 
    }
}
                            ?>
        </table>

        <div style="text-align:center; margin-top:30px;">
            <p>
                Data prevista para a entrega: <?php 
                if($entregaPrevistaB=="1970-01-01"){
                    echo("Sem data");
                }elseif($entregaPrevistaB=="0000-00-00"){
                    echo ("Sem data");
                }else{
                    echo formatardataB($entregaPrevistaB);}?>
            </p>
            <td>
                <label for="txtEntregaRealizada"><b>Entrega Realizada:</b></label>

                <input type="text" size=12 id="txtEntregaRealizada" name="txtEntregaRealizada"
                    OnKeyUp="mascaraData(this);" onkeypress="return onlynumber();" maxlength="10" autocomplete="off"
                    value="<?php 

if($entregaRealizadaB=="1970-01-01"){
    print_r("");
}elseif($entregaRealizadaB=="0000-00-00"){
    print_r ("");
}else{
    echo formatardataB($entregaRealizadaB);}?>">

            </td>

            <td align=left> <input type="submit" id="salvar" name="salvar" class="btn btn-success" value="salvar">
            </td>
            <td> <button type="button" name="btnfechar" onclick="window.opener.location.reload();fechar();"
                    class="btn btn-secondary">Voltar</button></td>

        </div>

        <div style="text-align:center; margin-top:10px;">
            <textarea rows=6 cols=80 style="width:600px ;" placeholder="Observação na entrega" name="observacao"
                id="observacao" value=""><?php 
        if($_POST){
        echo utf8_encode($observacao); 
        }else{
        echo $observacaoB;
        }
        ?></textarea>
        </div>
    </form>

    </main>
    <?php include '../_incluir/funcaojavascript.jar'; ?>
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
    function calculavalormargemGeral() {
        var campoPrecoVenda = document.getElementById("txtValorTotalComDesconto").value;
        var campoPrecoCompra = document.getElementById("txtValorTotalCompra").value;
        var campoMargem = document.getElementById("txtValorMargem");
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>

</body>

</html>

<?php
mysqli_close($conecta);
?>