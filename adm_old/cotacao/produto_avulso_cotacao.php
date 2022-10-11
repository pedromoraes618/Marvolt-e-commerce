<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include("../conexao/sessao.php");
include ("../_incluir/funcoes.php");


echo ',';
   

if(isset($_GET["codigo"])){
    $codCotacao =  $_GET["codigo"];
    $Norcamento =  $_GET["numeroOrcamento"];
}

if(isset($_POST['adicionar'])){
    $hoje = date('Y-m-d'); 
    $statusProduto = utf8_decode($_POST['campoStatusProduto']);
    $nomeProduto= utf8_decode($_POST["campoNomeProduto"]);
    $qtdProduto = utf8_decode($_POST["campoQtdProduto"]);
    $precoCompra = utf8_decode($_POST["campoPrecoCotado"]);
    $precoVenda= utf8_decode($_POST["campoPrecoVenda"]);
    $margem = utf8_decode($_POST["campoMargem"]);
    $unidade = utf8_decode($_POST["campoUnidade"]);
    
    //inserir o produto com a condição

    if($nomeProduto==""){
        ?>
<script>
alertify.alert("É necessario informar a descrição do produto");
</script>
<?php

    }elseif($qtdProduto==""){
        ?>
<script>
alertify.alert("É necessario preencher o campo quantidade");
</script>
<?php
    }else{
     
//inserir o produto
  $inserir = "INSERT INTO produto_cotacao ";
  $inserir .= "(cotacaoID,numero_orcamento, descricao,quantidade,preco_compra,preco_venda,margem,unidade,status )";
  $inserir .= " VALUES ";
  $inserir .= "('$codCotacao','$Norcamento','$nomeProduto','$qtdProduto','$precoCompra', '$precoVenda', '$margem','$unidade','$statusProduto' )";
  $operacao_inserir = mysqli_query($conecta, $inserir);
  ?>
<script>
alertify.success("Produto incluido com sucesso!");
</script>
<?php
    $nomeProduto = "";
    $qtdProduto = "";
    $precoCompra = "";
    $precoVenda = "";
    $margem = "";
    $unidade = "";
    $statusProduto ="1";
    }

}



//consultar o status do produto
$select = "SELECT * FROM status_produto_cotacao ";
$lista_status_produto_cotacao = mysqli_query($conecta,$select);
if(!$lista_status_produto_cotacao){
    die("Falaha no banco de dados");
}

?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">

    <link rel="shortcut icon" type="imagex/png" href="img/marvolt.ico">
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>

    <div id="titulo">
        </p>Lançamento de Receita / Despesa</p>
    </div>

    <main>

        <form action="" style="margin:0 auto; width:100%;" method="post">
            <table style="float:left; margin-bottom: 10px; border:1px solid;">

                <table style="float:right;">
                    <button type="button" style="float:right ;" name="btnfechar"
                        onclick="window.opener.location.reload(false);fechar();"
                        class="btn btn-secondary">Voltar</button>

                    <input type="submit" style="float:right;" name=adicionar id="adicionar" value="Incluir"
                        class="btn btn-info btn-sm"></input>
                    </td>

                </table>
                <table>

                    <tr>
                        <td>
                            <input type="hidden" size=60 name="campoNomeCodigo" id="campoNomeCodigo"
                                value="<?php echo $codCotacao; ?>">
                            <label for="campoNomeProduto"> <b>Produto:</b></label>
                            <input type="text" size=60 name="campoNomeProduto" id="campoNomeProduto"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($nomeProduto);}?>">
                            <label for="campoStatusProduto"> <b>Status:</b></label>
                            <select style="width: 130px; margin-right:10px;" id="campoStatusProduto"
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
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><label for="campoUnidade" style="width: 65px;"> <b>Und:</b></label>
                            <input type="text" size=10 id="campoUnidade" name="campoUnidade"
                                OnKeyUp="mascaraData(this);" maxlength="10"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($unidade);}?>">

                            <label for="campoQtdProduto"> <b>Quantidade:</b></label>
                            <input type="text" size=10 id="campoQtdProduto" name="campoQtdProduto"
                                onblur="calculavalormargem()" autocomplete="off" onkeypress="return onlynumber();"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($qtdProduto);}?>">


                            <label for="campoPrecoCotado"> <b>Preço cotado:</b></label>
                            <input type="text" size=10 id="campoPrecoCotado" name="campoPrecoCotado"
                                onkeypress="return onlynumber();" onblur="calculavalormargem()" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($precoCompra);}?>">

                            <label for="campoMargem"> <b>Margem:</b></label>
                            <input type="text" size=10 id="campoMargem" name="campoMargem"
                                onkeypress="return onlynumber();" onblur="calculavalorPrecoVenda()" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($margem);}?>">

                            <label for="campoPrecoVenda"> <b>Preço venda:</b></label>
                            <input type="text" size=10 id="campoPrecoVenda" name="campoPrecoVenda"
                                onkeypress="return onlynumber();" onblur="calculavalormargem()" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($precoVenda);}?>">



                        </td>

                    </tr>
                </table>
            </table>
        </form>
    </main>

</body>

<script>
function fechar() {
    window.close();
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