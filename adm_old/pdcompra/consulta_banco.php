<?php 
require_once("../conexao/conexao.php");

if($_POST){

    $hoje = date('Y-m-d'); 
    $codPedido = utf8_decode($_POST["txtcodigo"]);

    $numeroPedidoCompra = utf8_decode($_POST["txtNumeroPedido"]);
    $numeroOrcamento = utf8_decode($_POST["txtNumeroOrcamento"]);
    $numeroNfe = utf8_decode($_POST["txtNumeroNfe"]);
    $formaPagamento = utf8_decode($_POST["campoFormaPagamento"]);
    $cliente = utf8_decode($_POST["txtCliente"]);
    $produto = utf8_decode($_POST["txtProduto"]);
    $statusCompra = utf8_decode($_POST["txtStatusCompra"]);
    $precoVenda = utf8_decode($_POST["txtprecoUnitarioVenda"]);
    $precoCompra = utf8_decode($_POST["txtprecoUnitarioCompra"]);
    $unidade = utf8_decode($_POST["txtUnidade"]);
    $quantidade = utf8_decode($_POST["txtQuantidade"]);
    $margem = utf8_decode($_POST["txtMargem"]);
    $desconto = utf8_decode($_POST["txtDesconto"]);
    $entregaPrevista = utf8_decode($_POST["txtEntregaPrevista"]);
    $dataCompra = utf8_decode($_POST["txtDataDaCompra"]);
    $entregaRealizada = utf8_decode($_POST["txtEntregaRealizada"]);
    $dataChegada = utf8_decode($_POST["txtDataChegada"]);
    $dataChegadaPrevista = utf8_decode($_POST["txtDataChegadaPrevista"]);
    $valorTototalVenda= utf8_decode($_POST["txtValorTotal"]);
    $descontoGeral= utf8_decode($_POST["txtDescontoGeral"]);
    $valorComDesconto= utf8_decode($_POST["txtValorTotalComDesconto"]);
    $valorTotalMargem= utf8_decode($_POST["txtValorMargem"]);
    $valorTotalCompra= utf8_decode($_POST["txtValorTotalCompra"]);
    $dataFechamento = utf8_decode($_POST["txtDataFechamento"]);
    $descontoGeralReais= utf8_decode($_POST["txtDescontoGeralReais"]);
    if($valorComDesconto =="NaN" ){
        $valorComDesconto = $valorTototalVenda;
    }

        
}
//salvando o produto no banco de dados
if(isset($_POST['adicionar'])){
    $inserir = "INSERT INTO tb_pedido_item ";
    $inserir .= "(status_compra )";
    $inserir .= " VALUES ";
    $inserir .= "( '2' )";
    $operacao_inserir = mysqli_query($conecta, $inserir);
    if(!$operacao_inserir){
    die("Erro no banco de dados || adicionar o produto no banco de dados");    
    }
}

//salvando o pedido de compra no banco de dados
if(isset($_POST['salvar'])){
  
    if($codPedido==""){
        ?>
<script>
alertify.alert("Pedido de compra não iniciado");
</script>
<?php
    }elseif($numeroPedidoCompra==""){
        ?>
<script>
alertify.alert("Numero do pedido não informado");
</script>
<?php
    }elseif($cliente=="0"){
        ?>
<script>
alertify.alert("Favor selecione o cliente");
</script>
<?php
    }elseif($statusCompra=="0"){
        ?>
<script>
alertify.alert("Não foi definido o status da compra");
</script>
<?php

}elseif($formaPagamento=="0"){
    ?>
<script>
alertify.alert("Não foi definido a forma de pagamento");
</script>
<?php

}elseif($dataFechamento==""){
    ?>
<script>
alertify.alert("Data do fechamento não informada || Campo D.Fch");
</script>
<?php

}else{
   
    
    if($entregaPrevista==""){
          
    }else{
        $div1 = explode("/",$_POST['txtEntregaPrevista']);
        $entregaPrevista = $div1[2]."-".$div1[1]."-".$div1[0];  
       
    }
    if($dataChegadaPrevista==""){
       
    }else{
        $div2 = explode("/",$_POST['txtDataChegadaPrevista']);
    $dataChegadaPrevista = $div2[2]."-".$div2[1]."-".$div2[0];
    }


    if($dataCompra==""){
    
    }else{
        
    $div3 = explode("/",$_POST['txtDataDaCompra']);
    $dataCompra = $div3[2]."-".$div3[1]."-".$div3[0];
    }

    
    if($entregaRealizada==""){
       
    }else{
        
        $div4 = explode("/",$_POST['txtEntregaRealizada']);
        $entregaRealizada = $div4[2]."-".$div4[1]."-".$div4[0];
    }

    if($dataChegada==""){
       
    }else{
        
        $div5 = explode("/",$_POST['txtDataChegada']);
        $dataChegada = $div5[2]."-".$div5[1]."-".$div5[0];
    }

    if($dataFechamento==""){
       
    }else{
        
        $div7 = explode("/",$_POST['txtDataFechamento']);
        $dataFechamento = $div7[2]."-".$div7[1]."-".$div7[0];
    }
    
   
   // inserindo as informações no banco de dados
    $inserir = "INSERT INTO pedido_compra ";
    $inserir .= "( data_movimento,codigo_pedido,data_fechamento,desconto_geral_reais,numero_pedido_compra,numero_orcamento,numero_nf,forma_pagamento,clienteID,status_da_compra,status_do_pedido,data_compra,data_chegada,data_chegada_prevista,entrega_prevista,entrega_realizada,desconto_geral,valor_total,valor_total_margem,valor_total_compra )";
    $inserir .= " VALUES ";
    if($entregaPrevista == "" or $entregaRealizada==""){
      $inserir .= "( '$hoje','$codPedido','$dataFechamento','$descontoGeralReais','$numeroPedidoCompra','$numeroOrcamento','$numeroNfe','$formaPagamento','$cliente','$statusCompra','1','$dataCompra','$dataChegada','$dataChegadaPrevista','$entregaPrevista','$entregaRealizada','$descontoGeral','$valorComDesconto','$valorTotalMargem','$valorTotalCompra' )";
    }elseif($entregaPrevista < $entregaRealizada){
    $inserir .= "( '$hoje','$codPedido','$dataFechamento','$descontoGeralReais','$numeroPedidoCompra','$numeroOrcamento','$numeroNfe','$formaPagamento','$cliente','$statusCompra','4','$dataCompra','$dataChegada','$dataChegadaPrevista','$entregaPrevista','$entregaRealizada','$descontoGeral','$valorComDesconto','$valorTotalMargem','$valorTotalCompra' )";
    }elseif($entregaPrevista > $entregaRealizada){
      $inserir .= "( '$hoje','$codPedido','$dataFechamento','$descontoGeralReais','$numeroPedidoCompra','$numeroOrcamento','$numeroNfe','$formaPagamento','$cliente','$statusCompra','2','$dataCompra','$dataChegada','$dataChegadaPrevista','$entregaPrevista','$entregaRealizada','$descontoGeral','$valorComDesconto','$valorTotalMargem','$valorTotalCompra' )";
    }elseif($entregaPrevista == $entregaRealizada){
      $inserir .= "( '$hoje','$codPedido','$dataFechamento','$descontoGeralReais','$numeroPedidoCompra','$numeroOrcamento','$numeroNfe','$formaPagamento','$cliente','$statusCompra','3','$dataCompra','$dataChegada','$dataChegadaPrevista','$entregaPrevista','$entregaRealizada','$descontoGeral','$valorComDesconto','$valorTotalMargem' ,'$valorTotalCompra' )";
  }

    //limpando os campos apos ser feito o insert no banco de dados
    $codPedido = "";
    $numeroPedidoCompra = "";
    $numeroOrcamento = "";
    $numeroNfe = "";
    $produto = "";
    $precoVenda = "";
    $precoCompra = "";
    $unidade = "";
    $quantidade = "";
    $margem = "";
    $desconto = "";
    $observacao = "";
    $entregaPrevista = "";
    $dataPagamento = "";
    $dataChegadaPrevista = "";
    $dataCompra = "";
    $entregaRealizada = "";
    $dataChegada = "";
    $cliente = "0";
    $statusCompra="0";
    $formaPagamento ="0";
    $txtDescontoGeral = "";
    $txtValorTotalComDesconto = "";
    $dataFechamento = "";
    $descontoGeralReais ="";
  
    
    //verificando se está havendo conexão com o banco de dados
    $operacao_inserir = mysqli_query($conecta, $inserir);
    if(!$operacao_inserir){

        }
    }
}




?>

<table border="0" cellspacing="0" width="1400px;" class="tabela_pesquisa" style="margin-top:10px;">
    <?php if((isset($_POST['adicionar']))  or (isset($_POST['fecharPesquisa'])) or (isset($_POST['iniciar'])) or (isset($_POST['salvar'])) and ($codPedido != "")) {?>
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
                <p>QTD</p>
            </td>
            <td>
                <p>CP unitaria</p>
            </td>
            <td>
                <p>Vnd unitaria</p>
            </td>

            <td>
                <p>Total CP</p>
            </td>


            <td>
                <p>Total Vnd</p>
            </td>


            <td>
                <p>Margem</p>
            </td>

            <td>
                <p></p>
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
    $descontoB = $linha['desconto'];
    $statusCompraB = $linha['status_compra'];
    $pedidoID = $linha['pedidoID'];
    $pedido_item_id = $linha['pedido_itemID'];
    $cod_produto = $linha['cod_produto'];
   
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

            <td style="width: 80px;">
                <font size="2"><?php echo $quantidadeB;?> </font>
            </td>

            <td style="width: 120px;">
                <font size="2"><?php echo real_format($precoCompraB)?> </font>
            </td>

            <td style="width: 120px;">
                <font size="2"><?php echo real_format($precoVendaB)?> </font>
            </td>


            <td style="width: 100px;">
                <font size="2"><?php echo real_format($quantidadeB*$precoCompraB)?> </font>
            </td>


            <td style="width: 100px;">
                <font size="2"><?php echo real_format($quantidadeB*$precoVendaB)?> </font>
            </td>

            <td style="width: 100px;">
                <font size="2"><?php echo  real_percent($margemB);?> </font>
            </td>

            <td id="botaoEditar">
                <a
                    onclick="window.open('editar_produto_pedido.php?codigo=<?php echo $pedidoID; ?>&produtoCodigo=<?php echo $pedido_item_id;?>&cod_produto=<?php echo $pedido_item_id;?> ', 
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
                <font size=2>
                    <?php 
                                                if($somaVenda==0){
                                                    
                                                }else{
                                                    echo  real_percent((($somaVenda-$somaCompra)/$somaVenda)*100);
                                                }
                                                ?>
                </font>
            </td>


            <td>
                <p></p>
            </td>

        </tr>

    </tbody>
    <?php
                               }?>
</table>