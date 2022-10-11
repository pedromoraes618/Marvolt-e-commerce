<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
//inportar o alertar js
include('../alert/alert.php');

include_once("../_incluir/funcoes.php"); 
echo",";

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
$inserir .= "( data_movimento,codigo_pedido,data_fechamento,desconto_geral_reais,numero_pedido_compra,numero_orcamento,numero_nf,forma_pagamento,clienteID,status_da_compra,data_compra,data_chegada,data_chegada_prevista,entrega_prevista,entrega_realizada,desconto_geral,valor_total,valor_total_margem,valor_total_compra )";
$inserir .= " VALUES ";
$inserir .= "( '$hoje','$codPedido','$dataFechamento','$descontoGeralReais','$numeroPedidoCompra','$numeroOrcamento','$numeroNfe','$formaPagamento','$cliente','$statusCompra','$dataCompra','$dataChegada','$dataChegadaPrevista','$entregaPrevista','$entregaRealizada','$descontoGeral','$valorComDesconto','$valorTotalMargem','$valorTotalCompra' )";
$operacao_inserir = mysqli_query($conecta, $inserir);
if(!$operacao_inserir){
die("Erro no banco de dados salvar o pedido no banco de dados");
 }else{
        ?>
<script>
alertify.success("Pedido de compra lançado com sucesso");
</script>
<?php

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
    $descontoGeral = "";
    $txtValorTotalComDesconto = "";
    $dataFechamento = "";
    $descontoGeralReais ="";
  
         }
    }
}



        
//salvando o produto no banco de dados
if(isset($_POST['adicionar'])){
    if($codPedido==""){
        ?>
<script>
alertify.alert("Pedido de compra não iniciado");
</script>
<?php
    }else{
        if($produto==""){
            ?>
<script>
alertify.alert("Favor preencher o campo Produto");
</script>
<?php
        }elseif($unidade==""){
            ?>
<script>
alertify.alert("Favor preencher o campo unidade");
</script>
<?php
        }elseif($precoCompra==""){
            ?>
<script>
alertify.alert("Favor preencher o campo preço compra");
</script>
<?php
        }elseif($precoVenda==""){
            ?>
<script>
alertify.alert("Favor preencher o campo preço venda");
</script>
<?php
        }elseif($quantidade==""){
            ?>
<script>
alertify.alert("Favor preencher o campo quantidade");
</script>
<?php
        }else{
            if( $_SERVER['REQUEST_METHOD']=='POST' )
            {
                $request = md5( implode( $_POST ) );
                
                if( isset( $_SESSION['last_request'] ) && $_SESSION['last_request']== $request )
                {
                  
            $produto = "";
            $unidade = "";
            $quantidade = "";
            $precoCompra = "";
            $precoVenda = "";
            $margem = "";
            $desconto = "";
                }
                else
                {
                    $_SESSION['last_request']  = $request;
            
            $inserir = "INSERT INTO tb_pedido_item ";
            $inserir .= "( data_lancamento,pedidoID,produto,unidade,quantidade,preco_compra_unitario,preco_venda_unitario,margem,desconto,status_compra )";
            $inserir .= " VALUES ";
            $inserir .= "( '$hoje','$codPedido','$produto','$unidade','$quantidade','$precoCompra','$precoVenda','$margem','$desconto','2' )";
            $operacao_inserir = mysqli_query($conecta, $inserir);
            if(!$operacao_inserir){
             print_r($_POST);
               die("Erro no banco de dados || adicionar o produto no banco de dados");
                
           }

           $produto = "";
           $unidade = "";
           $quantidade = "";
           $precoCompra = "";
           $precoVenda = "";
           $margem = "";
           $desconto = "";
        }
    }
        }
    }


}

//consultar os produtos do pedido de compra
if($_POST) {
    $selectProduto =  " SELECT  produto ,cod_produto, pedidoID ,pedido_itemID, unidade, 
    quantidade,preco_compra_unitario,preco_venda_unitario,margem,desconto,status_compra 
    from tb_pedido_item where pedidoID = '$codPedido'";
    $lista_Produto= mysqli_query($conecta, $selectProduto);
    if(!$lista_Produto){
    die("Falaha no banco de dados || pesquisar produto ");
    }
}

//select preco de compra e preco de venda do pedido de compra
if($_POST) {
$selectProdutoSoma =  " SELECT  sum(preco_venda_unitario*quantidade) as somaVenda, sum(preco_compra_unitario*quantidade) as somaCompra from tb_pedido_item where pedidoID = '$codPedido'";
$lista_Produto_Soma= mysqli_query($conecta, $selectProdutoSoma);
if(!$lista_Produto_Soma){
die("Falaha no banco de dados || pesquisar produto ");
}else{$linha_soma = mysqli_fetch_assoc($lista_Produto_Soma);
$somaVenda = $linha_soma['somaVenda'];
$somaCompra = $linha_soma['somaCompra'];
                
}
    }

if(isset($_POST['pesquisar'])){
    $select = "SELECT * from produto_cotacao  where numero_orcamento = '$numeroOrcamento'";
    $lista_produto_cotacao = mysqli_query($conecta,$select);
    if(!$lista_produto_cotacao){
    die("Falaha no banco de dados || select produto_cotacao");
    }
}

        //consultar forma de pagamento
$select = "SELECT formapagamentoID, nome, statuspagamento from forma_pagamento";
$lista_formapagamemto = mysqli_query($conecta,$select);
if(!$lista_formapagamemto){
    die("Falaha no banco de dados || select formapagma");
}


//consultar cliente
$select = "SELECT clienteID, razaosocial,nome_fantasia from clientes where clienteFtID = 1 order by nome_fantasia ";
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
        </p>Lançamento de pedido de compra </p>
    </div>
    <tr>
        <form action="" autocomplete="off" method="post">


            <main>
                <div style="margin:0 auto; width:1400px; ">
                    <form action="" method="post">
                        <table style="float:left; width:1400px; margin-bottom: 10px; border:1px solid;">
                            <table style="float:right;">
                                <td align=left> <input style="width:120px" type="submit" name="iniciar" id="iniciar"
                                        class="btn btn-info btn-sm" value="Iniciar Pedido">

                                    <input type="submit" id="" name="salvar"
                                        onclick="calculavalordescontoReais();calculavalormargemGeral();"
                                        class="btn btn-success" value="Finalizar">

                                    <button type="button" name="btnfechar"
                                        onclick="window.opener.location.reload();fechar();"
                                        class="btn btn-secondary">Voltar</button>
                                </td>
                            </table>
                            <tr>
                                <td>
                                    <label for="txtcodigo" style="width:100px;"> <b>Código:</b></label>
                                    <input readonly type="text" size=10 id="txtcodigo" name="txtcodigo" value="<?php 
                                     if(isset($_POST['iniciar'])){
                                        echo rand(200,10000000);
                                   }elseif((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $codPedido;
                                   }
                                    ?>">
                                </td>
                            </tr>
                        </table>

                        <table style="float:left; width:1400px; margin-bottom: 10px;border-bottom:1px solid #ddd;  ">
                            <tr>
                                <td>
                                    <label for="txtNumeroPedido" style="width:100px;"> <b>Nº Pedido:</b></label>
                                    <input type="text" size=10 id="txtNumeroPedido" name="txtNumeroPedido" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $numeroPedidoCompra;
                                        }?>">

                                    <label for="txtNumeroOrcamento"> <b>Nº Orçamento:</b></label>
                                    <input type="text" size=10 id="txtNumeroOrcamento" name="txtNumeroOrcamento" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $numeroOrcamento;
                                        }?>">

                                    <label for="txtNumeroNfe"> <b>Nº Nfe:</b></label>
                                    <input type="text" size=10 id="txtNumeroNfe" name="txtNumeroNfe" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $numeroNfe;
                                        }?>">


                                    <label for="txtFormaPagamento"><b>Forma do pagamento:</b></label>
                                    <select style="width: 205px; margin-right:24px;" id="campoFormaPagamento"
                                        name="campoFormaPagamento">
                                        <option value="0">Selecione</option>

                                        <?php 
                                while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                                    $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);
                                if(!isset($formaPagamento)){
                                ?>
                                        <option
                                            value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                            <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                        </option>
                                        <?php
                                
                                }else{

                                if($formaPagamento==$formaPagamentoPrincipal){
                                    ?> <option
                                            value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>"
                                            selected>
                                            <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                        </option>

                                        <?php
                                            }else{
                                    
                                ?>
                                        <option
                                            value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                            <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                        </option>
                                        <?php

}

}

             
}

         ?>

                                    </select>
                                    <label for="txtDataFechamento"> <b>D.Fch:</b></label>
                                    <input type="text" size=12 id="txtDataFechamento" name="txtDataFechamento" value="<?php if($_POST){
                                       echo $dataFechamento;
                                        }?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                                </td>
                            </tr>



                        </table>
                        <table style="float:left; width:650px; margin-bottom:10px">

                            <tr>
                                <td>
                                    <label for="txtCliente" style="width:100px;"> <b>Empresa:</b></label>
                                    <select style="margin-right: 60px; margin-bottom:10px; width:480px;"
                                        id="campoCliente" name="txtCliente">
                                        <option value="0">Selecione</option>


                                        <?php 
                                while($linha_clientes  = mysqli_fetch_assoc($lista_clientes)){
                                    $clientePrincipal = utf8_encode($linha_clientes["clienteID"]);
                                   if(!isset($cliente)){
                                   
                                   ?>
                                        <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>">
                                            <?php echo utf8_encode($linha_clientes["nome_fantasia"]);?>
                                        </option>
                                        <?php
                                   
                                   }else{
       
                                    if($cliente==$clientePrincipal){
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
       
                                 
       }
       
                         ?>

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="txtNumeroOrcamento" style="width:100px;"> <b>Produto</b></label>
                                    <input type="text" size=35 id="txtProduto" name="txtProduto" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $produto;
                                        }?>">

                                    <button style="border:0px;  background-color:white;" id="buttonPesquisa"
                                        name="pesquisar"><i class="fa-solid fa-magnifying-glass"></i></button>

                                    <form action="" method="post">
                                        <input type="submit" style="width:80px" name="adicionar" class="btn btn-success"
                                            value="Add"
                                            onclick="calculavalordesconto();calculavalordescontoReais();calculavalormargemGeral();">

                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <label for="txtUnidade" style="width:100px;"> <b>Und</b></label>
                                    <input type="text" size=10 id="txtUnidade" name="txtUnidade" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $unidade;
                                        }?>">
                                    <label for="txtQuantidade" style="width: 100px;"><b>Quantidade</b></label>
                                    <input type="text" size=10 id="txtQuantidade" name="txtQuantidade" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $quantidade;
                                        }?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="txtprecoUnitarioCompra" style="width:100px;"><b>Preco CP</b></label>
                                    <input type="text" size=10 id="txtprecoUnitarioCompra" name="txtprecoUnitarioCompra"
                                        onblur="calculavalormargem()" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $precoCompra;
                                        }?>">
                                    <label for="txtprecoUnitarioVenda" style="width:100px;"><b>Preco VND</b></label>
                                    <input type="text" size=10 id="txtprecoUnitarioVenda" name="txtprecoUnitarioVenda"
                                        onblur="calculavalormargem()" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $precoVenda;
                                        }?>">

                            </tr>
                            <tr>
                                <td>
                                    <label for="txtMargem" style="width:100px;"><b>Margem</b></label>
                                    <input type="text" size=10 id="txtMargem" name="txtMargem" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $margem;
                                        }?>">


                                    <input type="hidden" size=10 id="txtDesconto" name="txtDesconto" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $desconto;
                                        }?>">

                            </tr>



                        </table>

                        <table style="float:left; width:750px;">

                            <tr>
                                <td>
                                    <label for="txtStatusCompra" style="width:150px;"> <b>Status da
                                            compra:</b></label>
                                    <select style="margin-right: 40px;" id="txtStatusCompra" name="txtStatusCompra">
                                        <option value="0">Selecione</option>
                                        <?php 
                                while($linha_statusCompra  = mysqli_fetch_assoc($lista_statuscompra)){
                                    $statusCompraPrincipal = utf8_encode($linha_statusCompra["statuscompraID"]);
                                   if(!isset($statusCompra)){
                                   
                                   ?>
                                        <option
                                            value="<?php echo utf8_encode($linha_statusCompra["statuscompraID"]);?>">
                                            <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                                        </option>
                                        <?php
                                   
                                   }else{
       
                                    if($statusCompra==$statusCompraPrincipal){
                                    ?> <option value="<?php echo utf8_encode($linha_statusCompra["statuscompraID"]);?>"
                                            selected>
                                            <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                                        </option>

                                        <?php
                                             }else{
                                    
                                   ?>
                                        <option
                                            value="<?php echo utf8_encode($linha_statusCompra["statuscompraID"]);?>">
                                            <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                                        </option>
                                        <?php
                
                        }
                        
                    }
     
                }
                
                         ?>

                                    </select>

                                    <label for="txtDataDaCompra" style="width: 150px;"> <b>Data da
                                            compra:</b></label>
                                    <input type="text" size=12 id="txtDataDaCompra" name="txtDataDaCompra" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $dataCompra ;
                                        }?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">


                                </td>

                            </tr>

                        </table>
                        <table style="float:right; width:750px;">

                            <tr>
                                <td>

                                    <label for="txtDataChegadaPrevista" style="width:150px;"> <b>Chegada
                                            prevista:</b></label>
                                    <input type="text" style="margin-right:100px;" size=12 id="txtDataChegadaPrevista"
                                        name="txtDataChegadaPrevista" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $dataChegadaPrevista ;
                                        }?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                                    <label for="txtDataChegada" style="width:150px;"> <b>Data
                                            Chegada:</b></label>
                                    <input type="text" size=12 id="txtDataChegada" name="txtDataChegada" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $dataChegada ;
                                        }?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                                </td>
                            </tr>

                        </table>
                        <table style="float:right; width:750px; margin-bottom: 40px;">

                            <tr>
                                <td>
                                    <label for="txtEntregaPrevista" style="width:150px; "> <b>Entrega
                                            Prevista:</b></label>
                                    <input type="text" style="margin-right:100px;" size=12 id="txtEntregaPrevista"
                                        name="txtEntregaPrevista" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $entregaPrevista ;
                                        }?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                                    <label for="txtEntregaRealizada" style="width:150px;"> <b>Entrega
                                            Realizada:</b></label>
                                    <input type="text" size=12 id="txtEntregaRealizada" name="txtEntregaRealizada"
                                        value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       echo $entregaRealizada ;
                                        }?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                                </td>
                            </tr>

                        </table>

                        <table style=" width:800px; margin-left:400 ">
                            <tr>
                                <td>
                                    <div style="width:600px">
                                        <div>

                                            <input type="hidden" size=10 id="txtDescontoGeral" name="txtDescontoGeral"
                                                value="<?php
                                                if($_POST){
                                                echo $descontoGeral;
                                                }
                                                ?>">

                                            <label for="txtDescontoGeralReais" style="width:85px;"> <b>Desc
                                                    R$:</b></label>
                                            <input type="text" size=10 id="txtDescontoGeralReais"
                                                onblur="calculavalordescontoReais();calculavalormargemGeral();"
                                                name="txtDescontoGeralReais" value="<?php if($_POST){
                                                    echo $descontoGeralReais;
                                        }?>">


                                            <label for="txtValorTotalComDesconto" style="width:85px; "> <b>Vlr
                                                    total:</b></label>
                                            <input type="text" size=10 id="txtValorTotalComDesconto"
                                                name="txtValorTotalComDesconto" value="<?php   
                                                if($_POST){
                                                if($descontoGeralReais == "" or $descontoGeralReais=="0"){
                                           echo valor_total($somaVenda);
                                       }else{
                                        echo $valorComDesconto;
                                       }}?>">

                                            <input type="hidden" size=5 id="txtValorTotal" name="txtValorTotal" value="<?php
                                    if($_POST){
                                        echo $somaVenda;
                                    }?>">

                                            <input type="hidden" size=5 id="txtValorTotalCompra"
                                                name="txtValorTotalCompra" value="<?php
                                            if($_POST){ 
                                                    echo $somaCompra;
                                            }?>">



                                            <input type="hidden" size=5 id="txtValorMargem" name="txtValorMargem" value="<?php
                                             if($_POST){ 
                                            echo $valorTotalMargem;
                                            }
                                    ?>">


                                            <input type="submit" style="float: right; margin-top:10px"
                                                onclick="calculavalordescontoReais();calculavalormargemGeral();"
                                                name="fecharPesquisa" class="btn btn-danger" value="Atualizar">


                                        </div>
                                    </div>
                            </tr>
                            </td>

                        </table>

                        <form action="consulta_produto.php" method="post">

                            <table border="0" cellspacing="0" width="1400px;" class="tabela_pesquisa"
                                style="margin-top:10px;">
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

                                                <button type="button" class="btn btn-warning"
                                                    name="editar">Editar</button>
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
                                    
                             
                            }elseif(isset($_POST['pesquisar'])){
                                ?>
                                <tr id="cabecalho_pesquisa_consulta">
                                    <td>
                                        <p style="margin-left: 10px;;">Cód</p>
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
                                        <p>P. compra</p>
                                    </td>
                                    <td>
                                        <p>P. Venda</p>
                                    </td>
                                    <td>
                                        <p>Margem</p>
                                    </td>
                                    <td>

                                    </td>




                                    <td>
                                        <p></p>
                                    </td>

                                </tr>
                                <?php
                            
                                while($linha = mysqli_fetch_assoc($lista_produto_cotacao)){
                                    $produtoID = $linha['produto_cotacao'];
                                    $descricao = $linha['descricao'];
                                    $precoCompra = $linha['preco_compra'];
                                    $precoVenda = $linha['preco_venda'];
                                    $unidade = $linha['unidade'];
                                    $quantidade = $linha['quantidade'];
                                    $margem = $linha['margem'];
                                    $cod_produto = $linha['cod_produto'];
                   
                                    
                                ?>
                                <tr id="linha_pesquisa">

                                    <td style="width: 70px;">
                                        <p style="margin-left: 15px; margin-top:10px;">
                                            <font size="3"><?php echo $produtoID;?></font>
                                        </p>
                                    </td>

                                    <td style="width: 650px;">

                                        <font size="2"><?php echo utf8_decode($descricao);?> </font>

                                    </td>

                                    <td style="width: 100px;">
                                        <font size="2"><?php echo utf8_decode($unidade);?> </font>
                                    </td>

                                    <td style="width: 100px; ">
                                        <font size="2"><?php echo utf8_decode($quantidade);?> </font>
                                    </td>

                                    <td style="width: 130px;">
                                        <font size="2"><?php echo real_format($precoCompra);?> </font>
                                    </td>

                                    <td style="width: 130px;">
                                        <font size="2"><?php echo real_format($precoVenda);?> </font>
                                    </td>
                                    <td style="width: 130px;">
                                        <font size="2"><?php echo real_percent($margem*100);?> </font>
                                    </td>


                                    <td id="botaoEditar">
                                        <a
                                            onclick="window.open('selecionar_produto_pedido.php?codigo=<?php echo $produtoID;?>&codigoPedido=<?php echo $codPedido;?>&cod_produto=<?php echo $cod_produto;?>', 'popuppageSelecionarProduto',
                                                                                'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=500');">

                                            <button type="button" class="btn btn-warning"
                                                name="editar">Selecione</button>

                                        </a>


                                    </td>


                                </tr>

                                <?php }}?>
                            </table>
                        </form>



                    </form>
                </div>
            </main>


            <?php 
            include '../_incluir/funcaojavascript.jar'; 
            include '../classes/select2/select2_java.php'; 
            ?>
            <script src="../jquery/jquery.js"></script>

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
            /*
            function calculavalordesconto() {
                var campoDesconto = document.getElementById("txtDescontoGeral").value;
                var campoValorTotalH = document.getElementById("txtValorTotal").value;
                var campoDescontoReais = document.getElementById("txtDescontoGeralReais");
                var campoValorTotal = document.getElementById("txtValorTotalComDesconto");

                var calculoDesconto;
                var calculoTotalCDesconto;
                var calculoTotalCDescontoReais;

                campoValorTotalH = parseFloat(campoValorTotalH);
                campoDesconto = parseFloat(campoDesconto);

                calculoDesconto = ((campoValorTotalH * campoDesconto) / 100);
                calculoTotalCDesconto = (campoValorTotalH - calculoDesconto).toFixed(2);
                calculoTotalCDescontoReais = (campoValorTotalH - calculoTotalCDesconto).toFixed(2);
                campoValorTotal.value = calculoTotalCDesconto;
                campoDescontoReais.value = calculoTotalCDescontoReais;

            }
*/
            function calculavalordescontoReais() {
                var campoDesconto = document.getElementById("txtDescontoGeral");
                var campoValorTotalH = document.getElementById("txtValorTotal").value;
                var campoDescontoReais = document.getElementById("txtDescontoGeralReais").value;
                var campoValorTotal = document.getElementById("txtValorTotalComDesconto");

                var calculoValorTotal;
                var calculoTotalCDescontoReais;

                campoValorTotalH = parseFloat(campoValorTotalH);
                campoDescontoReais = parseFloat(campoDescontoReais);

                calculoValorTotal = (campoValorTotalH - campoDescontoReais);
                calculoTotalCDescontoReais = ((campoDescontoReais / campoValorTotalH) * 100).toFixed(2);
                campoValorTotal.value = calculoValorTotal.toFixed(2);
                campoDesconto.value = calculoTotalCDescontoReais;

            }
            </script>


</body>

</html>

<?php
mysqli_close($conecta);
?>