<?php 

include("../conexao/sessao.php");
require_once("../conexao/conexao.php"); 
//inportar o alertar js
include('../alert/alert.php');
echo ",";
//deckara as varuaveus


if($_POST){
    $formulario = 0;
    $hoje = date('Y-m-d'); 
    $codCotacao = utf8_decode($_POST["codigoCotacao"]);
    $salvar = utf8_decode($_POST["tueSalvar"]);
    $cotacaofinalizada = utf8_decode($_POST["cotacaofinalizada"]);
    $compradorID = utf8_decode($_POST["campoComprador"]);   
    $freteID = utf8_decode($_POST["campoFrete"]);   
    $numeroSolicitacao = utf8_decode($_POST["campoNsolitacao"]);
    $numeroOrcamento = utf8_decode($_POST["campoNorcamento"]);
    $formaPagamento = utf8_decode($_POST["campoFormaPagamento"]); 
    $dataRecebida = utf8_decode($_POST["campoDataRecebida"]);
    $validade = utf8_decode($_POST["campoValidade"]);
    $dataEnvio = utf8_decode($_POST["campoDataEnvio"]);
    $dataResponder = utf8_decode($_POST["campoDataResponder"]);
    $dataFechamento= utf8_decode($_POST["campoDaFechamento"]);
    $diasNegociacao = utf8_decode($_POST["campoDiasNegociacao"]);
    $statusProposta = utf8_decode($_POST["campoStatusProposta"]);
    $prazoEntrega = utf8_decode($_POST["campoPrazoEntrega"]);
    $clienteID = utf8_decode($_POST["campoCliente"]);
    $statusProduto = utf8_decode($_POST['campoStatusProduto']);
    $comprador = utf8_decode($_POST["campoComprador"]);
    $nomeProduto= utf8_decode($_POST["campoNomeProduto"]);
    $qtdProduto = utf8_decode($_POST["campoQtdProduto"]);
    $precoCompra = utf8_decode($_POST["campoPrecoCotado"]);
    $precoVenda= utf8_decode($_POST["campoPrecoVenda"]);
    $margem = utf8_decode($_POST["campoMargem"]);
    $unidade = utf8_decode($_POST["campoUnidade"]);
    $desconto = utf8_decode($_POST["campoDesconto"]);
    $valorTotal = utf8_decode($_POST["campoValorTotal"]);
    $valorTotalComDesconto = utf8_decode($_POST["campoValorTotalHidden"]);
    $margemGeral = utf8_decode($_POST["txtValorMargem"]);
    
}

//limpar imput apos ser inciado uma cotação
if(isset($_POST['iniciar'])){
    $dataRecebida = "";
    $validade = "";
    $dataEnvio = "";
    $dataFechamento= "";
    $diasNegociacao = "";
    $statusProposta = "2";
    $prazoEntrega ="";
    $dataResponder = "";
    $numeroSolicitacao = "";
    $formaPagamento = "0";
    $freteID = "0";
    $compradorID = "0";
    $clienteID = "0";
    $numeroOrcamento = "";
    $desconto = 0;
    $valorTotal = 0;
}

//consultar ultimo id da cotacao
$selectCotacao = "SELECT MAX(CotacaoID) as maximo FROM cotacao";
$lista_cotacao= mysqli_query($conecta, $selectCotacao);
if(!$lista_cotacao){
die("Falaha no banco de dados");
}else{
    $linha = mysqli_fetch_assoc($lista_cotacao);
    $id_cotacao = $linha['maximo'];}


//auto incremento do numero do orçamento
if($_POST){
$selectCotacaoMax = "SELECT MAX(valor) as maximo FROM tb_parametros where descricao = 'Numero Atual Orcamento' ";
$lista_cotacao_max= mysqli_query($conecta, $selectCotacaoMax);
if(!$lista_cotacao_max){
die("Falaha no banco de dados");
}else{
$linha = mysqli_fetch_assoc($lista_cotacao_max);
$numeroOrcamentoMax = $linha['maximo'];
$result = substr($numeroOrcamentoMax,0,3);
$soma = $result + 1;
$data = date('Y');
$paramentroNumeroOrcamento = $soma.$data;
}
}


//inicar a cotacao novamente    
if(isset($_POST['iniciar'])){
$selectCotacao = "SELECT MAX(CotacaoID) as maximo FROM cotacao";
$lista_cotacao= mysqli_query($conecta, $selectCotacao);
if(!$lista_cotacao){
die("Falaha no banco de dados");
}else{
    $linha = mysqli_fetch_assoc($lista_cotacao);
    $id_cotacao = $linha['maximo'];
}
}


//inserir o produto 
if(isset($_POST['adicionar']))
{
    if($codCotacao==""){
        ?>
<script>
alertify.alert("É necessario inciar a cotação !! Favor clique em iniciar cotação");
</script>
<?php
    }elseif($nomeProduto==""){
       
            ?>
<script>
alertify.alert("É necessario informar a descrição do produto");
</script>
<?php 
      
    }elseif($qtdProduto==""){
        ?>
<script>
alertify.alert("Favor informar a quantidade do produto");
</script>
<?php 
              
    }else{
        if( $_SERVER['REQUEST_METHOD']=='POST' )
        {
            $request = md5( implode( $_POST ) );
            
            if( isset( $_SESSION['last_request'] ) && $_SESSION['last_request']== $request )
            {
                $nomeProduto = "";
                $qtdProduto = "";
                $precoCompra = "";
                $precoVenda = "";
                $margem = "";
                $unidade = "";
            }
            else
            {
                $_SESSION['last_request']  = $request;
//inserir o produto
  $inserir = "INSERT INTO produto_cotacao ";
  $inserir .= "(cotacaoID,numero_orcamento, descricao,quantidade,preco_compra,preco_venda,margem,unidade,status )";
  $inserir .= " VALUES ";
  $inserir .= "('$codCotacao','$paramentroNumeroOrcamento','$nomeProduto','$qtdProduto','$precoCompra', '$precoVenda', '$margem','$unidade','$statusProduto' )";
  $operacao_inserir = mysqli_query($conecta, $inserir);

            if(!$operacao_inserir){
                die("Falaha no banco de dados || pesquisar produto cotacao");
                }else{
                    $nomeProduto = "";
                    $qtdProduto = "";
                    $precoCompra = "";
                    $precoVenda = "";
                    $margem = "";
                    $unidade = "";
                }
            }
        }
    }

}

//consultar os produto da cotação, codição de clicar no botao adicionar
if($_POST) {
$selectProdutoCotacao =  " SELECT * from produto_cotacao where cotacaoID = '$codCotacao'";
$lista_Produto_cotacao= mysqli_query($conecta, $selectProdutoCotacao);
if(!$lista_Produto_cotacao){
die("Falaha no banco de dados || pesquisar produto cotacao");

}

$selectProdutoCotacaoTotal =  " SELECT sum(preco_venda*quantidade) as soma, sum(preco_compra*quantidade) as somaCompra from produto_cotacao where cotacaoID = '$codCotacao'";
$lista_Produto_cotacao_total= mysqli_query($conecta, $selectProdutoCotacaoTotal);
if(!$lista_Produto_cotacao_total){
die("Falaha no banco de dados || pesquisar produto cotacao");
}else{$linha_soma = mysqli_fetch_assoc($lista_Produto_cotacao_total);
    $somaTotal = $linha_soma['soma'];
    $somaTotalCompra = $linha_soma['somaCompra'];

}

    
}


   

//calculo



//condicao podera salvar a cotação com a condição variavel salvar está com o valor 1

if(isset($_POST['salvar'])){
if($codCotacao == ""){
    ?>

<script>
alertify.alert("É necessario inciar a cotação !! Favor clique em iniciar cotação");
</script>

<?php
}elseif($clienteID == "0"){

    ?>

<script>
alertify.alert("É necessario informar o cliente");
</script>

<?php 
}elseif($freteID == "0"){
    ?>

<script>
alertify.alert("Favor informar o frete");
</script>

<?php
} elseif($compradorID == "0"){
    ?>

<script>
alertify.alert("Favor informar o comprador");
</script>

<?php
} elseif($formaPagamento == "0"){
    ?>

<script>
alertify.alert("Favor informar a forma de pagamento");
</script>

<?php
}elseif($dataEnvio == ""){
    ?>

<script>
alertify.alert("É necessario informar a data de envio");
</script>

<?php
}else{    

if($dataRecebida==""){

}else{
$div1 = explode("/",$_POST['campoDataRecebida']);
$dataRecebida = $div1[2]."-".$div1[1]."-".$div1[0];

}
if($dataEnvio ==""){

}else{
$div2 = explode("/",$_POST['campoDataEnvio']);
$dataEnvio = $div2[2]."-".$div2[1]."-".$div2[0];
}


if($dataResponder ==""){

}else{
$div3 = explode("/",$_POST['campoDataResponder']);
$dataResponder = $div3[2]."-".$div3[1]."-".$div3[0];
}

if($dataFechamento==""){
}else{

$div4 = explode("/",$_POST['campoDaFechamento']);
$dataFechamento = $div4[2]."-".$div4[1]."-".$div4[0];

}

$inserir = "INSERT INTO cotacao ";
$inserir .= "( clienteID,data_lancamento,compradorID,freteID,status_proposta,forma_pagamentoID,data_recebida,data_envio,data_responder,data_fechamento,dias_negociacao,prazo_entrega,numero_solicitacao,numero_orcamento,cod_cotacao,validade,valorTotal,desconto,valorTotalComDesconto,margem )";
$inserir .= " VALUES ";
$inserir .= "('$clienteID','$dataEnvio','$compradorID','$freteID','$statusProposta','$formaPagamento','$dataRecebida','$dataEnvio','$dataResponder','$dataFechamento','$diasNegociacao','$prazoEntrega','$numeroSolicitacao','$numeroOrcamento','$codCotacao','$validade','$valorTotal','$desconto','$valorTotalComDesconto','$margemGeral' )";
$operacao_inserir = mysqli_query($conecta, $inserir);
$formaPagamento = "1";
$freteID = "1";
$compradorID = "1";
$clienteID = "1";
$codCotacao = "";
$numeroOrcamento = "";
$desconto = 0;
$valorTotal = 0;

        if(!$operacao_inserir){
        die("Erro no banco de dados inserir cotacao");
        }else{
            
                    ?>

<script>
alertify.success("Cotação <?php echo $codCotacao; ?> finalizada com sucesso");
</script>
<?php
 $dataRecebida = "";
 $validade = "";
 $dataEnvio = "";
 $dataFechamento= "";
 $diasNegociacao = "";
 $statusProposta = "2";
 $prazoEntrega ="";
 $dataResponder = "";
 $dataFechamento = "";
 $numeroSolicitacao = "";
 $formaPagamento = "0";
 $freteID = "0";
 $compradorID = "0";
 $clienteID = "0";
 $numeroOrcamento = "";
 $desconto = 0;
 $valorTotal = 0;

        }

    }


}
//consultar cliente
$select = "SELECT clienteID, razaosocial,nome_fantasia from clientes where clienteFtID = 1 order by nome_fantasia asc  ";
$lista_clientes = mysqli_query($conecta,$select);
if(!$lista_clientes){
    die("Falaha no banco de dados || select clientes");
}

//consultar o comprador
$select = "SELECT * from comprador order by comprador asc ";
$lista_comprador = mysqli_query($conecta,$select);
if(!$lista_comprador){
    die("Falaha no banco de dados || select comprador");
}

//consultar o frete
$select = "SELECT * from frete";
$lista_frete= mysqli_query($conecta,$select);
if(!$lista_frete){
    die("Falaha no banco de dados || select frete");
}

//consultar forma de pagamento
$select = "SELECT formapagamentoID, nome, statuspagamento from forma_pagamento";
$lista_formapagamemto = mysqli_query($conecta,$select);
if(!$lista_formapagamemto){
    die("Falaha no banco de dados || select formapagma");
}

$select = "SELECT * FROM situacao_proposta ";
$lista_situacao_proposta = mysqli_query($conecta,$select);
if(!$lista_situacao_proposta){
    die("Falaha no banco de dados");
}

//consultar o status do produto
$select = "SELECT * FROM status_produto_cotacao ";
$lista_status_produto_cotacao = mysqli_query($conecta,$select);
if(!$lista_status_produto_cotacao){
    die("Falaha no banco de dados");
}


    if(isset($_POST['pesquisar'])){
        $selectProdutos = "SELECT * from produtos WHERE nomeproduto LIKE '%{$nomeProduto}%' order by nomeproduto asc ";
        $lista_Produtos= mysqli_query($conecta, $selectProdutos);
        if(!$lista_Produtos){
        die("Falaha no banco de dados || pesquisar produto cotacao".$selectProdutos);
    }
}




?>
<!doctype html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilo -->
    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">
    <?php 
    include("../classes/select2/select2_link.php")
    ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
</head>

<body>


    <?php include_once("../_incluir/funcoes.php"); ?>


    <main>




        <div style="margin:0 auto; width:1400px ">


            <table style="float: right;">
                <div id="titulo">
                    </p>Cotação</p>
                </div>

                <tr>

                    <form action="" autocomplete="off" method="post">

                        <td align=left> <input style="width:120px" type="submit" name="iniciar"
                                class="btn btn-info btn-sm" value="Iniciar Cotacão">
                        </td>
                        <td align=left> <input type="submit" id="" name="salvar" class="btn btn-success"
                                onclick="calculavalordesconto();calculavalormargemGeral();" value="Finalizar">
                        </td>
                        <td align=left> <button type="button" name="btnfechar"
                                onclick="window.opener.location.reload();fechar();"
                                class="btn btn-secondary">Voltar</button>
                        </td>



                </tr>

            </table>


            <table style="float:left; ">



                <tr>
                    <td>Código:</td>
                    <td align=left><input readonly type="text" size="10" name="codigoCotacao" value="<?php 
         if(isset($_POST['iniciar'])){
              echo rand(1,1000000000);
         }elseif((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa']))  or (isset($_POST['editar'])) or (isset($_POST['pesquisar'])) or (isset($_POST['salvar']))){
             echo $codCotacao;
         }
         ?>"> </td>


                    <td align=left><input readonly type="hidden" size="10" name="cotacaofinalizada"
                            placeholder="finalizado" value="<?php 
            //1 Para não poder incluir item e 0 para incluir iten
         
            if(isset($_POST['salvar'])){
                echo 1;
            }elseif(isset($_POST['iniciar'])or isset($_POST['pesquisar'])or isset($_POST['fecharPesquisa'])){
                echo 0;
            }
            if(isset($_POST['adicionar'])){
                echo $_POST['cotacaofinalizada'];
            }

         
         ?>"> </td>

                    <td align=left><input readonly type="hidden" size="10" name="tueSalvar" value="<?php
           if($_POST){
                if($salvar == ""){
                    echo 1;
                }else{
                    echo 1;
                }
            }
            
            ?>"> </td>



                </tr>
                <!--finalizar hidden -->
                <tr>

                    <td align=left> <b>Nº solicitação:</b></td>
                    <td align=left> <input type="text" name="campoNsolitacao" size="10" value="<?php  if($_POST){
     echo $numeroSolicitacao;
    }?>"> </td>

                    <td align=left> <b>Nº orçamento:</b></td>
                    <td align=left> <input type="text" name="campoNorcamento" size="10" value="<?php 
                    if($_POST){
                        echo $numeroOrcamento;
                         }
                   
   
    ?>"> </td>

                    <td align=left> <b>Forma do pagamento:</b></td>
                    <td align=left><select style="width: 170px; margin-right:10px;" id="campoFormaPagamento"
                            name="campoFormaPagamento">
                            <option value="0">Selecione</option>

                            <?php 
            while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);
               if(!isset($formaPagamento)){
               
               ?>
                            <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                            </option>
                            <?php
               
               }else{

                if($formaPagamento==$formaPagamentoPrincipal){
                ?> <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>" selected>
                                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                            </option>

                            <?php
                         }else{
                
               ?>
                            <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                            </option>
                            <?php

               }

        }

             
}

         ?>

                        </select>
                    </td>

                    <td><b>Data recebida:</b></td>
                    <td align="left"> <input type="text" name="campoDataRecebida" OnKeyUp="mascaraData(this);" size="10"
                            autocomplete="off" maxlength="10" onkeypress="return onlynumber();" value="<?php  if($_POST){
                                echo $dataRecebida; 
                                
                        }?>"></td>




                    <td> <b>Validade:<b>
                    <td><input type="text" autocomplete="off" onkeypress="return onlynumber();" name="campoValidade"
                            size="10" value="<?php if($_POST){
                        echo $validade;
   
    }?>"> </td>
                </tr>

            </table>


            <table style="float:left; margin-top:5px; ">
                <tr>

                    <td> <b>Data a responder:<b>
                    <td> <input type="text" name="campoDataResponder" OnKeyUp="mascaraData(this);" size="10"
                            autocomplete="off" maxlength="10" onkeypress="return onlynumber();" value="<?php if($_POST){
                                echo $dataResponder;
            
    }?>"></td>
                    <td align=left><b>Data envio:</b></td>
                    <td align=left><input type="text" name="campoDataEnvio" OnKeyUp="mascaraData(this);" size="10"
                            autocomplete="off" maxlength="10" onkeypress="return onlynumber();" value="<?php  if($_POST){
                                echo $dataEnvio;
    }?>"></td>


                    <td align=left><b>Data fechamento:</b></td>
                    <td align=left><input type="text" name="campoDaFechamento" OnKeyUp="mascaraData(this);" size="10"
                            autocomplete="off" maxlength="10" onkeypress="return onlynumber();" value="<?php if($_POST){
      echo $dataFechamento;
                     }?>"></td>


                    <td align=left><input type="hidden" name="campoDiasNegociacao" autocomplete="off" size="10" value="<?php  if($_POST){
      echo  $diasNegociacao;
    }?>"></td>

                </tr>





            </table>
            <table style="float:left; width:1400px;" id="divisaoTabela">
                <td>
                    <div id="divDivisao">
                    </div>
                </td>

            </table>
            <table style="float:left;  ">

                <tr>


                    <td><b>Proposta:</b></td>
                    <td><select style="width:170px; margin-right:20px; " name="campoStatusProposta"
                            id="campoStatusProposta">

                            <?php  
                            while($linha_status_proposta= mysqli_fetch_assoc($lista_situacao_proposta)){
$statusProposta_principal= utf8_encode($linha_status_proposta["statusID"]);
if(!isset($statusProposta)){

?>
                            <option value="<?php echo utf8_encode($linha_status_proposta["statusID"]);?>">
                                <?php echo utf8_encode($linha_status_proposta["descricao"]);?>
                            </option>
                            <?php

}else{

if($statusProposta==$statusProposta_principal){
?> <option value="<?php echo utf8_encode($linha_status_proposta["statusID"]);?>" selected>
                                <?php echo utf8_encode($linha_status_proposta["descricao"]);?>
                            </option>

                            <?php
}else{

?>
                            <option value="<?php echo utf8_encode($linha_status_proposta["statusID"]);?>">
                                <?php echo utf8_encode($linha_status_proposta["descricao"]);?>
                            </option>
                            <?php

}

}


}

?>
                        </select>
                    </td>
                    <td align=left><b>Frete:</b></td>
                    <td><select style="width: 260px; margin-right:30px; " name="campoFrete" id="campoFrete">
                            <option value="0">Selecione</option>

                            <?php 
                             while($linha_frete = mysqli_fetch_assoc($lista_frete)){
$frete_principal= utf8_encode($linha_frete["freteID"]);
if(!isset($freteID)){

?>
                            <option value="<?php echo utf8_encode($linha_frete["freteID"]);?>">
                                <?php echo utf8_encode($linha_frete["descricao"]);?>
                            </option>
                            <?php

}else{

if($freteID==$frete_principal){
?> <option value="<?php echo utf8_encode($linha_frete["freteID"]);?>" selected>
                                <?php echo utf8_encode($linha_frete["descricao"]);?>
                            </option>

                            <?php
}else{

?>
                            <option value="<?php echo utf8_encode($linha_frete["freteID"]);?>">
                                <?php echo utf8_encode($linha_frete["descricao"]);?>
                            </option>
                            <?php

}

}


}

?>
                        </select>
                    </td>


                    <td align=left> <input type="hidden" name="campoPrazoEntrega" autocomplete="of" size="10" value="<?php if($_POST){
                                   echo $prazoEntrega;}?>">


                    </td>
                    <td>

                    </td>




                </tr>


            </table>
            <table style="float:left;  margin-top:10px; width:1000px; ">
                <tr>
                    <td align=left style="border:1px soldi; width:75"><b>Cliente:</b></td>
                    <td align=left> <select style="margin-right:50px;width:600px;" name="campoCliente"
                            id="campoCliente">
                            <option value="0">Selecione</option>

                            <?php  while($linha_cliente = mysqli_fetch_assoc($lista_clientes)){
        $cliente_Principal = utf8_encode($linha_cliente["clienteID"]);
       if(!isset($clienteID)){
       
       ?>
                            <option value="<?php echo utf8_encode($linha_cliente["clienteID"]);?>">
                                <?php echo utf8_encode($linha_cliente["nome_fantasia"]);?>
                            </option>
                            <?php
       
       }else{

        if($clienteID==$cliente_Principal){
        ?> <option value="<?php echo utf8_encode($linha_cliente["clienteID"]);?>" selected>
                                <?php echo utf8_encode($linha_cliente["nome_fantasia"]);?>
                            </option>

                            <?php
                 }else{
        
       ?>
                            <option value="<?php echo utf8_encode($linha_cliente["clienteID"]);?>">
                                <?php echo utf8_encode($linha_cliente["nome_fantasia"]);?>
                            </option>
                            <?php

}

}

     
}

?>

                    </td>


                    <td align=left><b>Comprador:</b></td>
                    <td align=left><select style="width: 200px;" name="campoComprador" id="campoComprador">
                            <option value="0">Selecione</option>

                            <?php  while($linha_comprador = mysqli_fetch_assoc($lista_comprador)){
            $comprador_Principal = utf8_encode($linha_comprador["id_comprador"]);
            if(!isset($compradorID)){
            
            ?>
                            <option value="<?php echo utf8_encode($linha_comprador["id_comprador"]);?>">
                                <?php echo utf8_encode($linha_comprador["comprador"]);?>
                            </option>
                            <?php

            }else{

            if($compradorID==$comprador_Principal){
            ?> <option value="<?php echo utf8_encode($linha_comprador["id_comprador"]);?>" selected>
                                <?php echo utf8_encode($linha_comprador["comprador"]);?>
                            </option>

                            <?php
               }else{

?>
                            <option value="<?php echo utf8_encode($linha_comprador["id_comprador"]);?>">
                                <?php echo utf8_encode($linha_comprador["comprador"]);?>
                            </option>
                            <?php

}

}

}

?>
                        </select>
                    </td>


                </tr>

            </table>







            <table style="float:left; width:1400px; margin-top:5px;" id="divisaoTabela">
                <td>
                    <div id="divDivisao">
                    </div>
                </td>

            </table>

            <table style="float:left; ">
                <tr>
                    <td align=left><b>Produto:</b></td>
                    <td align=left><input style="margin-right:5px;" type="text" size=60 name="campoNomeProduto"
                            value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($nomeProduto);}?>">
                    </td>

                    <td><button style="border:0px;  background-color:white;" id="buttonPesquisa" name="pesquisar"><i
                                class="fa-solid fa-magnifying-glass"></i></button></td>

                    <td>



                        <input type="submit" onclick="calculavalordesconto()" name="adicionar" class="btn btn-success"
                            value="Adicionar">

                    </td>



                </tr>
            </table>
            <table style="float:left;   margin-bottom:5px;">

                <tr>
                    <div>
                        <td align=left style="width:70px;"><b>Und:</b></td>
                        <td align=left><input type="text" size=10 name="campoUnidade" id="campoUnidade"
                                autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($unidade);}?>">
                        </td>
                        <td align=left><b>Quantidade:</b></td>
                        <td align=left><input type="text" size=10 name="campoQtdProduto" id="campoQtdProduto"
                                onblur="calculavalormargem()" autocomplete="off" onkeypress="return onlynumber();"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($qtdProduto);}?>">
                        </td>
                        <td align=left><b>Preço cotado:</b></td>
                        <td align=left><input type="text" size=10 name="campoPrecoCotado" id="campoPrecoCotado"
                                onkeypress="return onlynumber();" onblur="calculavalormargem()" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($precoCompra);}?>">
                        </td>
                        <td align=left><b>Margem:</b></td>
                        <td align=left><input type="text" size=10 name="campoMargem" id="campoMargem"
                                onkeypress="return onlynumber();" onblur="calculavalorPrecoVenda()" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($margem);}?>">
                        </td>
                        <td align=left><b>Preço venda:</b></td>
                        <td align=left><input type="text" size=10 name="campoPrecoVenda" id="campoPrecoVenda"
                                onkeypress="return onlynumber();" onblur="calculavalormargem()" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($precoVenda);}?>">
                        </td>

                        <td align=left> <b>Status:</b></td>
                        <td align=left><select style="width: 130px; margin-right:10px;" id="campoStatusProduto"
                                name="campoStatusProduto">
                                <?php 
            while($linha_status_produto  = mysqli_fetch_assoc($lista_status_produto_cotacao)){
                $statusProdutoPrincipal= utf8_encode($linha_status_produto["status_produtoID"]);
               if(!isset($statusProduto)){
               
               ?>
                                <option value="<?php echo utf8_encode($linha_status_produto["status_produtoID"]);?>">
                                    <?php echo utf8_encode($linha_status_produto["descricao"]);?>
                                </option>
                                <?php
               
               }else{

                if($statusProduto==$statusProdutoPrincipal){
                ?> <option value="<?php echo utf8_encode($linha_status_produto["status_produtoID"]);?>" selected>
                                    <?php echo utf8_encode($linha_status_produto["descricao"]);?>
                                </option>

                                <?php
                         }else{
                
               ?>
                                <option value="<?php echo utf8_encode($linha_status_produto["status_produtoID"]);?>">
                                    <?php echo utf8_encode($linha_status_produto["descricao"]);?>
                                </option>
                                <?php

}

}

             
}

         ?>

                            </select>
                        </td>



                    </div>
                </tr>




            </table>

            <table style="float:left; width:1400px; margin-top:5px;" id="divisaoTabela">
                <td>
                    <div id="divDivisao">
                    </div>
                </td>

            </table>

            <table style="float:left;  margin-bottom: 20px;">
                <tr>

                    <td align=left><input type="submit" style="margin-right:120px ;" onclick="calculavalordesconto()"
                            name="fecharPesquisa" class="btn btn-danger" value="Atualizar">
                    </td>

                    <td align=left style="width:100px; "><b>Desconto:</b></td>
                    <td align=left><input type="text" size=10 name="campoDesconto" id="campoDesconto"
                            onblur="calculavalordesconto();calculavalormargemGeral();" autocomplete="off" value="<?php 
                            if($_POST){
                            echo $desconto;}

                            if((isset($_POST['adicionar'])) && $desconto==""){
                                echo 0;
                            }

                            ?>"></td>
                    <td align=left style="width:100px;"><b>Valor Total:</b></td>
                    <td align=left><input type="text" size=10 name="campoValorTotal" id="campoValorTotal"
                            onblur="calculavalordesconto()" autocomplete="off" value="<?php 
                            if($_POST){
                            echo $valorTotal;
                            }

                          
                       ?>"></td>

                    </td>

                    <td align=right><input type="hidden" size=10 name="campoValorTotalHidden" id="campoValorTotalHidden"
                            autocomplete="off" value="<?php 
                           if($_POST){
                                echo ($somaTotal);}
                       ?>"></td>

                    <td><input type="hidden" size=5 id="txtValorMargem" name="txtValorMargem" value="<?php
                if($_POST){
                 echo $margemGeral;
                                    }?>"></td>
                    <td><input type="hidden" size=5 id="txtValorCompra" name="txtValorCompra" value="<?php
                     if($_POST){
             echo $somaTotalCompra; }?>"></td>


                </tr>
            </table>

        </div>


        <table border="0" cellspacing="0" width="1400px" class="tabela_pesquisa">
            <?php if((isset($_POST['iniciar']))or (isset($_POST['adicionar'])) or (isset($_POST['editar'])) or (isset($_POST['fecharPesquisa']))   or (isset($_POST['salvar'])) && ($codCotacao !="")) {?>
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
                        <p>Vlr Cotado</p>
                    </td>
                    <td>
                        <p>Vlr Venda</p>
                    </td>
                    <td>
                        <p>Vlr.Ct total</p>
                    </td>
                    <td>
                        <p>Vlr Vnd Total</p>
                    </td>
                    <td>
                        <p>Margem</p>
                    </td>
                    <td>
                        <p>Situação</p>
                    </td>


                    <td>
                        <p></p>
                    </td>

                </tr>


                <?php
if($_POST){

    $linhas = 0;
while($linha = mysqli_fetch_assoc($lista_Produto_cotacao)){
    $cotacaoID = $linha['cotacaoID'];
    $descricao = $linha['descricao'];
    $quantidade = $linha['quantidade'];
    $precoCompra = $linha['preco_compra'];
    $precoVenda = $linha['preco_venda'];
    $margem = $linha['margem'];
    $unidade = $linha['unidade'];
    $status = $linha['status'];
   
   
?>
                <tr id="linha_pesquisa">

                    <td style="width: 70px; ">
                        <p style="margin-left: 15px; margin-top:10px;">
                            <font size="3"><?php echo $linhas = $linhas +1;?></font>
                        </p>
                    </td>

                    <td style="width: 550px;">

                        <font size="2"><?php echo utf8_encode($descricao);?> </font>

                    </td>

                    <td style="width: 60px;">

                        <font size="2"><?php echo utf8_encode($unidade);?> </font>

                    </td>

                    <td style="width: 70px;">
                        <font size="2"><?php echo $quantidade;?> </font>
                    </td>

                    <td style="width: 100px;">
                        <font size="2"><?php echo real_format($precoCompra);?> </font>
                    </td>

                    <td style="width: 100px;">
                        <font size="2"><?php echo real_format($precoVenda);?> </font>
                    </td>


                    <td style="width: 120px;">
                        <font size="2"><?php echo real_format($quantidade*$precoCompra)?> </font>
                    </td>

                    <td style="width: 120px;">
                        <font size="2"><?php echo real_format($quantidade*$precoVenda)?> </font>
                    </td>

                    <td style="width: 80px;">
                        <font size="2"><?php echo  real_percent($margem*100);?> </font>
                    </td>


                    <td style="width: 80px; text-align:center">
                        <font size="2"><?php if($status==1){
                                ?><i title="Aberto" class="fa-solid fa-face-meh"></i><?php
                            }elseif($status==2){
                                ?><i title="Fechado" class="fa-solid fa-handshake"></i><?php
                            }elseif($status==3){
                                ?> <i title="Perdido" class="fa-solid fa-calendar-xmark"></i> <?php
                            }
                            
                            ?> </font>

                    </td>


                    <td id="botaoEditar">


                        <a
                            onclick="window.open('editar_produto_cotacao.php?codigo=<?php echo $linha['produto_cotacao'];?>&cod_produto=<?php echo $linha['cod_produto'];?>', 
'editar_produto_cotacao', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">

                            <input type="submit" class="btn btn-warning" name="editar" value="Editar">

                        </a>

                    </td>


                </tr>



                <?php
}
?>
                <tr id="cabecalho_pesquisa_consulta">
                    <td>
                        <font size=2>
                            <p style="margin-left:10px;">total</p>
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
                        <font size=2><?php echo  real_format($somaTotalCompra);?></font>
                    </td>
                    <td>
                        <font size=2><?php echo  real_format($somaTotal);?></font>
                    </td>
                    <td>

                        <font size=2><?php 
                            
                            if($somaTotalCompra == 0){
                            }else{
                                echo  real_percent((1-($somaTotalCompra/$somaTotal))*100);}?></font>
                    </td>
                    <td>

                    </td>


                    <td>
                        <p></p>
                    </td>

                </tr>

                <?php
}


}elseif(isset($_POST['pesquisar']) && ($codCotacao!="")){
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
                        <p>Estoque</p>
                    </td>
                    <td>
                        <p>P. compra</p>
                    </td>
                    <td>
                        <p>P. Venda</p>
                    </td>
                    <td>

                    </td>




                    <td>
                        <p></p>
                    </td>

                </tr>
                <?php

    while($linha = mysqli_fetch_assoc($lista_Produtos)){
        $produtoID = $linha['produtoID'];
        $descricao = $linha['nomeproduto'];
        $estoque = $linha['estoque'];
        $precoCompra = $linha['precocompra'];
        $precoVenda = $linha['precovenda'];
        $unidade = $linha['unidade_medida'];
    
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
                        <font size="2"><?php echo $estoque;?> </font>
                    </td>

                    <td style="width: 130px;">
                        <font size="2"><?php echo real_format($precoCompra);?> </font>
                    </td>

                    <td style="width: 130px;">
                        <font size="2"><?php echo real_format($precoVenda);?> </font>
                    </td>


                    <td id="botaoEditar">

                        <a
                            onclick="window.open('selecionar_produto_cotacao.php?codigo=<?php echo $linha['produtoID'];?>&cotacaoCod=<?php echo $_POST['codigoCotacao'];?>&unidade=<?php echo $linha['unidade_medida'];?>&nomProduto=<?php echo $linha['nomeproduto'];?>&precoCompra=<?php echo $linha['precocompra'];?>&precoVenda=<?php echo $linha['precovenda'];?>&numeroOrcamento=<?php echo $numeroOrcamento;?>', 'popuppageSelecionarProduto',
                                                    'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=500');">

                            <button type="button" class="btn btn-warning" name="editar">Selecione</button>

                        </a>


                    </td>


                </tr>



                <?php
    }
}


?>

            </tbody>
        </table>
        </form>


    </main>
</body>

<?php include '../_incluir/funcaojavascript.jar'; ?>
<?php include '../classes/select2/select2_java.php'; ?>

<script>
function fechar() {
    window.close();
}
</script>

<script>
//abrir uma nova tela de cadastro
function abrepopupProdutoAvulso() {

    var janela = "produto_avulso_cotacao.phpcodigo=<?php echo $codCotacao; ?>";
    window.open(janela, 'popuppageProdutoAvulso',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}

function abrepopupEditarProduto() {

    var janela = "editar_produto.php?codigo=<?php echo $idProduto ?>";
    window.open(janela, 'popuppageEditarProduto',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

<script>
function calculavalormargem() {
    var campoQuantidade = document.getElementById("campoQtdProduto").value;
    var campoPrecoCotado = document.getElementById("campoPrecoCotado").value;
    var campoPrecoVenda = document.getElementById("campoPrecoVenda").value;
    var campoMargem = document.getElementById("campoMargem");
    var calculoMargem;
    var calculoFinal;

    campoPrecoVenda = parseFloat(campoPrecoVenda);
    campoPrecoCotado = parseFloat(campoPrecoCotado);

    calculoMargem = (campoPrecoCotado / campoPrecoVenda).toFixed(2);
    calculoFinal = (1 - calculoMargem).toFixed(2);
    campoMargem.value = calculoFinal;


}
</script>

<script>
function calculavalormargemGeral() {
    var campoPrecoVenda = document.getElementById("campoValorTotal").value;
    var campoPrecoCompra = document.getElementById("txtValorCompra").value;
    var campoMargem = document.getElementById("txtValorMargem");
    var calculo;

    campoPrecoVenda = parseFloat(campoPrecoVenda);
    campoPrecoCompra = parseFloat(campoPrecoCompra);

    calculo = (((campoPrecoVenda - campoPrecoCompra) / campoPrecoVenda) * 100).toFixed(2);
    campoMargem.value = calculo;
}
</script>


<script>
function calculavalorPrecoVenda() {
    var campoPrecoCotado = document.getElementById("campoPrecoCotado").value;
    var campoMargem = document.getElementById("campoMargem").value;
    var campoPrecoVenda = document.getElementById("campoPrecoVenda");
    var calculoPrecoVenda;

    campoMargem = parseFloat(campoMargem);
    campoPrecoCotado = parseFloat(campoPrecoCotado);
    calculoPrecoVenda = (campoPrecoCotado / (1 - (campoMargem))).toFixed(2);
    campoPrecoVenda.value = calculoPrecoVenda;

}
</script>

<script>
function calculavalordesconto() {
    var campoDesconto = document.getElementById("campoDesconto").value;
    var campoValorTotalH = document.getElementById("campoValorTotalHidden").value;
    var campoValorTotal = document.getElementById("campoValorTotal");
    var calculoDesconto;
    var calculoTotalCDesconto;


    campoValorTotalH = parseFloat(campoValorTotalH);
    campoDesconto = parseFloat(campoDesconto);

    calculoDesconto = ((campoValorTotalH * campoDesconto) / 100);
    calculoTotalCDesconto = (campoValorTotalH - calculoDesconto).toFixed(2);
    campoValorTotal.value = calculoTotalCDesconto;


}
</script>


</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>