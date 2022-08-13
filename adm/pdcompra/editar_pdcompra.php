<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
//inportar o alertar js
include('../alert/alert.php');
include_once("../_incluir/funcoes.php"); 
echo",";

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
    $entregaPrevistaPost = utf8_decode($_POST["txtEntregaPrevista"]);
    $dataCompraPost = utf8_decode($_POST["txtDataDaCompra"]);
    $entregaRealizadaPost = utf8_decode($_POST["txtEntregaRealizada"]);
    $dataChegadaPost = utf8_decode($_POST["txtDataChegada"]);
    $dataChegadaPrevistaPost = utf8_decode($_POST["txtDataChegadaPrevista"]);
    $dataFechamentoPost= utf8_decode($_POST["txtDataFechamento"]);
    $valorTototalVenda= utf8_decode($_POST["txtValorTotal"]);
    $descontoGeral= utf8_decode($_POST["txtDescontoGeral"]);
    $valorComDesconto= utf8_decode($_POST["txtValorTotalComDesconto"]);
    $valorTotalMargem= utf8_decode($_POST["txtValorMargem"]);
    $valorTotalCompra= utf8_decode($_POST["txtValorTotalCompra"]);
    $dataFechamento= utf8_decode($_POST["txtDataFechamento"]);
    $descontoGeralReais= utf8_decode($_POST["txtDescontoGeralReais"]);
    

    
    
}

if(isset($_GET["codigo"])){
    $pedidoID =  $_GET["codigo"];
    $codigo_pedido =  $_GET["codigoPedido"];}

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
    
    


       //query para alterar o cliente no banco de dados
   $alterar = "UPDATE pedido_compra set data_fechamento = '{$dataFechamento}', numero_pedido_compra = '{$numeroPedidoCompra}',
   desconto_geral_reais = '{$descontoGeralReais}', numero_orcamento  = '{$numeroOrcamento}', 
   numero_nf = '{$numeroNfe}',  forma_pagamento = '{$formaPagamento}', 
   valor_total_compra = '{$valorTotalCompra}', 
   clienteID = '{$cliente}', status_da_compra = '{$statusCompra}',  
   entrega_prevista = '{$entregaPrevista}', data_compra = '{$dataCompra}', 
   entrega_realizada = '{$entregaRealizada}', data_chegada= '{$dataChegada}', 
   data_chegada_prevista = '{$dataChegadaPrevista}',desconto_geral = '{$descontoGeral}',
   valor_total = '{$valorComDesconto}',valor_total_margem = '{$valorTotalMargem}' WHERE pedidoID = {$pedidoID} and codigo_pedido = {$codigo_pedido} ";
  
     $operacao_alterar = mysqli_query($conecta, $alterar);
     if(!$operacao_alterar) {
         die("Erro o no update banco de dados");   
     } else {
        ?>

<script>
alertify.success('Dados alterados');
</script>
<?php
         //header("location:listagem.php"); 
          
     }
   
   }

   if($descontoGeral!=""){
       $update = "UPDATE tb_pedido_item set desconto = '{$descontoGeral}' where pedidoID = '{$codigo_pedido}'";
 
      $operacao_update = mysqli_query($conecta, $update);
     if(!$operacao_update) {
         die("Erro no update banco de dados || Desconto no item");   
     }      }
   
    }


//Consultar os dados do pedido banco de dados
$consulta = "SELECT * FROM pedido_compra ";
if(isset($_GET["codigo"])){
    $pedidoID =  $_GET["codigo"];
    $codigo_pedido =  $_GET["codigoPedido"];
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
    $dataFechamentoB  = utf8_encode($linha['data_fechamento']);
    $descontoGeralReaisB  = utf8_encode($linha['desconto_geral_reais']);

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
                    $quantidade="";
                    $precoCompra="";
                    $precoVenda="";
                    $margem="";
                }
                else
                {
        $_SESSION['last_request']  = $request;
        $_POST;
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
//consultar os produtos do pedido de compra!
if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa']))  or (isset($_POST['salvar'])) or (!isset($_GET['pesquisar']))) {
  
    $selectProduto =  " SELECT produto ,cod_produto, pedidoID ,pedido_itemID, unidade, quantidade,preco_compra_unitario,preco_venda_unitario,margem,desconto,status_compra from tb_pedido_item where pedidoID = '$codigo_pedido'";
    $lista_Produto= mysqli_query($conecta, $selectProduto);
    if(!$lista_Produto){
    die("Falaha no banco de dados || pesquisar produto ");
    }
    
        }

        if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or  (isset($_POST['salvar'])) or (!isset($_POST['pesquisar'])))  {
  
            $selectProdutoSoma =  " SELECT  sum(preco_venda_unitario*quantidade) as somaVenda, sum(preco_compra_unitario*quantidade) as somaCompra from tb_pedido_item where pedidoID = '$codigo_pedido'";
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
        </p>Dados do pedido de compra </p>
    </div>
    <tr>
        <form action="" autocomplete="off" method="post">

            <main>
                <div style="margin:0 auto; width:1400px; ">
                    <table style="float:left; width:1400px; margin-bottom: 10px; border:1px solid;">
                        <table style="float:right;">
                            <td align=left>

                                <input type="submit" id="" name="salvar" class="btn btn-success"
                                    onclick="calculavalordescontoReais();calculavalormargemGeral();" value="Salvar">

                                <button type="button" name="btnfechar"
                                    onclick="window.opener.location.reload();fechar();"
                                    class="btn btn-secondary">Voltar</button>


                        </table>
                        <tr>
                            <td>
                                <label for="txtcodigo" style="width:100px;"> <b>Código:</b></label>
                                <input readonly type="text" size=10 id="txtcodigo" name="txtcodigo" value="<?php 
                                     echo  $codigo_pedido;
                                    ?>">
                            </td>
                        </tr>
                    </table>

                    <table style="float:left; width:1400px; margin-bottom: 10px;border-bottom:1px solid #ddd; ; ">
                        <tr>
                            <td>
                                <label for="txtNumeroPedido" style="width:100px;"> <b>Nº Pedido:</b></label>
                                <input type="text" size=10 id="txtNumeroPedido" name="txtNumeroPedido" value="<?php  if($_POST){
                                       echo $numeroPedidoCompra;
                                        }else{
                                            echo $numeroPedidoCompraB;
                                        }?>">

                                <label for="txtNumeroOrcamento"> <b>Nº Orçamento:</b></label>
                                <input type="text" size=10 id="txtNumeroOrcamento" name="txtNumeroOrcamento" value="<?php  if($_POST){
                                       echo $numeroOrcamento;
                                        }else{
                                            echo $numeroOrcamentoB;
                                        }?>">

                                <label for="txtNumeroNfe"> <b>Nº Nfe:</b></label>
                                <input type="text" size=10 id="txtNumeroNfe" name="txtNumeroNfe" value="<?php if($_POST){
                                       echo $numeroNfe;
                                        }else{
                                            echo $numeroNfeB;
                                        }?>">


                                <label for="txtFormaPagamento"><b>Forma do pagamento:</b></label>
                                <select style="width: 205px; margin-right:24px;" id="campoFormaPagamento"
                                    name="campoFormaPagamento">

                                    <option value="0">Selecione</option>
                                    <?php 
                                         if($_POST){
    
                                            while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                                             $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);
    
                                             if($formaPagamentoPrincipal == $formaPagamento){
                                             ?> <option value="<?php echo $formaPagamento?>" selected>
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
                                         }else{
                                        $meuFormaPagamento = $formaPagamentoB;
                                        while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                                         $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);

                                         if($meuFormaPagamento==$formaPagamentoPrincipal){
                                         ?> <option
                                        value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>"
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
                                        
                                    }}
                                
                                                           
                                
                                
                                                        ?>

                                </select>
                                <label for="txtDataFechamento"> <b>D.fch:</b></label>
                                <input type="text" size=12 id="txtDataFechamento" name="txtDataFechamento" value="<?php if($_POST){
                                        echo ($dataFechamentoPost);
                                        }else{
                                            if($dataFechamentoB=="1970-01-01"){
                                                print_r("");
                                            }elseif($dataFechamentoB=="0000-00-00"){
                                                print_r ("");
                                            }elseif($dataFechamentoB==""){
                                                print_r ("");
                                            }else{
                                                echo formatardataB($dataFechamentoB);}

                                                
                                                }?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">
                            </td>
                        </tr>



                    </table>
                    <table style="float:left; width:650px; margin-bottom:10px">

                        <tr>
                            <td>
                                <label for="txtCliente" style="width:100px;"> <b>Empresa:</b></label>
                                <select style="margin-right: 60px; margin-bottom:10px; width:480px;" id="campoCliente"
                                    name="txtCliente">
                                    <option value="0">Selecione</option><?php 
                                        if($_POST){
        
                                            while($linha_clientes  = mysqli_fetch_assoc($lista_clientes)){
                                                $clientePrincipal = utf8_encode($linha_clientes["clienteID"]);
                   
                                                if($cliente==$clientePrincipal){
                                                ?> <option
                                        value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>" selected>
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
                                        }else{
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


                                <input type="submit" style="width:80px" onclick="calculavalordescontoReais();"
                                    name="adicionar" class="btn btn-success" value="Add">

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
                                        if($_POST){
                                         
                                            while($linha_statusCompra  = mysqli_fetch_assoc($lista_statuscompra)){
                                                $statusCompraPrincipal = utf8_encode($linha_statusCompra["statuscompraID"]);
                                               
                                                if($statusCompra==$statusCompraPrincipal){
                                                ?> <option
                                        value="<?php echo utf8_encode($linha_statusCompra["statuscompraID"]);?>"
                                        selected>
                                        <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                                    </option>

                                    <?php
                                                   
                                                         }else{
                                                
                                               ?>
                                    <option value="<?php echo utf8_encode($linha_statusCompra["statuscompraID"]);?>">
                                        <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                                    </option>
                                    <?php
                            
                                    }
                                    
                                }
                                        }else{

                                        }
                                        $meuStatusCompra = $statusCompraB;
                                while($linha_statusCompra  = mysqli_fetch_assoc($lista_statuscompra)){
                                    $statusCompraPrincipal = utf8_encode($linha_statusCompra["statuscompraID"]);
                                   
                                    if($meuStatusCompra==$statusCompraPrincipal){
                                    ?> <option value="<?php echo utf8_encode($linha_statusCompra["statuscompraID"]);?>"
                                        selected>
                                        <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                                    </option>

                                    <?php
                                       
                                             }else{
                                    
                                   ?>
                                    <option value="<?php echo utf8_encode($linha_statusCompra["statuscompraID"]);?>">
                                        <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                                    </option>
                                    <?php
                
                        }
                        
                    }
                
                                            
                


                         ?>

                                </select>

                                <label for="txtDataDaCompra" style="width: 150px;"> <b>Data da
                                        compra:</b></label>
                                <input type="text" size=12 id="txtDataDaCompra" name="txtDataDaCompra" value="<?php  if($_POST){
                                       
                                        echo ($dataCompraPost);
                                        }else{
                                            if($dataCompraB=="1970-01-01"){
                                                print_r("");
                                            }elseif($dataCompraB=="0000-00-00"){
                                                print_r ("");
                                            }elseif($dataCompraB==""){
                                                print_r ("");
                                            }else{
                                                echo formatardataB($dataCompraB);
                                            }
  
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
                                    name="txtDataChegadaPrevista" value="<?php if($_POST){
                                    
                                        echo ($dataChegadaPrevistaPost);
                                      
                                      
                                    }else{
                                            if($dataChegadaPrevistaB=="1970-01-01"){
                                                print_r("");
                                            }elseif($dataChegadaPrevistaB=="0000-00-00"){
                                                print_r ("");
                                            }elseif($dataChegadaPrevistaB==""){
                                                print_r ("");
                                            }else{
                                                echo formatardataB($dataChegadaPrevistaB);}

                                                }?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                                <label for="txtDataChegada" style="width:150px;"> <b>Data
                                        Chegada:</b></label>
                                <input type="text" size=12 id="txtDataChegada" name="txtDataChegada" value="<?php  if($_POST){
                                    
                                            echo ($dataChegadaPost);
                                      
                                        }else{
                                            if($dataChegadaB=="1970-01-01"){
                                            print_r("");
                                        }elseif($dataChegadaB=="0000-00-00"){
                                            print_r ("");
                                        }elseif($dataChegadaB==""){
                                            print_r ("");
                                        }else{
                                            echo formatardataB($dataChegadaB);

                                            }}?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                            </td>
                        </tr>

                    </table>
                    <table style="float:right; width:750px; margin-bottom: 00px;">

                        <tr>
                            <td>
                                <label for="txtEntregaPrevista" style="width:150px; "> <b>Entrega
                                        Prevista:</b></label>
                                <input type="text" style="margin-right:100px;" size=12 id="txtEntregaPrevista"
                                    name="txtEntregaPrevista" value="<?php  if($_POST){
                                    //se entrega prevista vindo do banco estiver zerado ou com a data 1970-01-01 o campo vai ser vazio quando o usuario clicar em um botão
                                        echo ($entregaPrevistaPost) ;
                                       //se o valor de entrega prevista estiver zerado ou com a data 1970 -01-01 o campo vai ser vazio quando a tela for ativado
                                        }else{
                                            if($entregaPrevistaB=="1970-01-01"){
                                            print_r("");
                                        }elseif($entregaPrevistaB=="0000-00-00"){
                                            print_r ("");
                                        }elseif($entregaPrevistaB==""){
                                            print_r ("");
                                        }else{
                                            echo formatardataB($entregaPrevistaB);

                                            }}?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                                <label for="txtEntregaRealizada" style="width:150px;"> <b>Entrega
                                        Realizada:</b></label>
                                <input type="text" size=12 id="txtEntregaRealizada" data-mask=00/00/0000
                                    name="txtEntregaRealizada" value="<?php  if($_POST){
                                           
                                                echo ($entregaRealizadaPost);
                                        }else{
                                            if($entregaRealizadaB=="1970-01-01"){
                                            print_r("");
                                        }elseif($entregaRealizadaB=="0000-00-00"){
                                            print_r ("");
                                        }elseif($entregaRealizadaB==""){
                                            print_r ("");
                                        }else{
                                            echo formatardataB($entregaRealizadaB);

                                            }}?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                            </td>
                        </tr>

                    </table>

                    <table style="  width:800px; margin-left:400 ">
                        <tr>
                            <td>
                                <div style="width:700px">
                                    <div>

                                        <input type="hidden" size=10 id="txtDescontoGeral" name="txtDescontoGeral"
                                            value="<?php if($_POST){
                                                echo $descontoGeral;
                                        }else{
                                                echo $descontoGeralB;
                                        }?>">
                                        <label for="txtDescontoGeralReais" style="width:85px;"> <b>Desc
                                                R$:</b></label>
                                        <input type="text" size=10 id="txtDescontoGeralReais"
                                            onblur="calculavalordescontoReais(); calculavalormargemGeral();"
                                            name="txtDescontoGeralReais" value="<?php if($_POST){
                                                echo $descontoGeralReais;
                                        }else{
                                                echo $descontoGeralReaisB;
                                        }?>">

                                        <label for="txtValorTotalComDesconto" style="width:85px; "> <b>Vlr
                                                total:</b></label>
                                        <input type="text" size=10 id="txtValorTotalComDesconto"
                                            name="txtValorTotalComDesconto" value="<?php if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa']))  or (isset($_POST['salvar'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
                                       
                                       if($descontoGeral == "" or $descontoGeral==""){
                                           echo valor_total($somaVenda);
                                       }else{
                                        echo $valorComDesconto;
                                       }
                                      
                                        }else{
                                            echo $valorComDescontoB;
                                        }?>">

                                        <input type="hidden" size=5 id="txtValorTotal" name="txtValorTotal" value="<?php
                if((isset($_POST['adicionar'])) or (isset($_POST['salvar'])) or (isset($_POST['fecharPesquisa'])) or (!isset($_POST['pesquisar']))){ 
                    echo $somaVenda;
                                    
                                    }?>">

                                        <input type="hidden" size=5 id="txtValorTotalCompra" name="txtValorTotalCompra"
                                            value="<?php
                if((isset($_POST['adicionar'])) or (isset($_POST['salvar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar']))){ 
                    echo $somaCompra;
                                    }else{
                                        echo $valorTotalCompraB;}?>">

                                        <input type="hidden" size=5 id="txtValorMargem" name="txtValorMargem" value="<?php
                if((isset($_POST['adicionar'])) or (isset($_POST['salvar'])) or (isset($_POST['fecharPesquisa'])) or (!isset($_POST['pesquisar']))){ 
                    if($somaVenda==0){
                                                    
                    }else{
                        echo $valorTotalMargemB;
                    }
                                    }?>">




                                        <input type="submit" style="float: right; margin-top:10px"
                                            onclick="calculavalordescontoReais();calculavalormargemGeral();"
                                            name="fecharPesquisa" class="btn btn-danger" value="Atualizar">

                                        <a
                                            onclick="window.open('valor_de_compra.php?codigo=<?php echo $codigo_pedido; ?>','popuppageValorCompra','STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=12000, HEIGHT=500');">
                                            <button type="button"  class="btn btn-warning" >V.Compra</button>

                                        </a>

                                       

                                    </div>
                                </div>
                        </tr>
                        </td>

                    </table>


                    <table border="0" cellspacing="0" width="1400px;" class="tabela_pesquisa" style="margin-top:10px;">
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
                                        onclick="window.open('editar_produto_pedido.php?codigo=<?php echo $pedidoID; ?>&produtoCodigo=<?php echo $pedido_item_id;?>&cod_produto=<?php echo $cod_produto;?>', 
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

    </tr>

    <?php
if($descontoGeralB > 0 ){

?>
    <tr id="cabecalho_pesquisa_consulta" style="background-color:white">
        <td>
            <font size=2>
                <p style="width: 100px; margin-left:10px;">Desconto de <?php echo $descontoGeralB; ?> %</p>
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
            <font size=2><?php echo  real_format($valorComDescontoB);?></font>
        </td>
        <td>
            <font size=2>
                <?php 
            if($valorComDescontoB==0){
                
            }else{
                echo  real_percent((($valorComDescontoB-$somaCompra)/$valorComDescontoB)*100);
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
    }
}
elseif(isset($_POST['pesquisar'])){
                                ?>
    <tr id="cabecalho_pesquisa_consulta">
        <td>
            <p style="margin-left: 10px;">Cód</p>
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

                <button type="button" class="btn btn-warning" name="editar">Selecione</button>

            </a>


        </td>


    </tr>

    <?php }
        }?>
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
    //calcar o desconto em porcentagem
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
    //calcar o desconto em reais
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>

</body>

</html>

<?php
mysqli_close($conecta);
?>