<?php 
include("../conexao/sessao.php");
require_once("../conexao/conexao.php"); 
//inportar o alertar js
include('../alert/alert.php');


echo ",";
//deckara as varuaveus
if((isset($_POST['adicionar']))){
    $hoje = date('Y-m-d'); 
    $codProduto = utf8_decode($_POST["codigoProduto"]);
    $codCotacao = utf8_decode($_POST["codigoCotacao"]);
    $nomeProduto= utf8_decode($_POST["campoNomeProduto"]);
    $qtdProduto = utf8_decode($_POST["campoQtdProduto"]);
    $precoCompra = utf8_decode($_POST["campoPrecoCotado"]);
    $precoVenda = $_POST["campoVenda"];
    $margem = utf8_decode($_POST["campoMargem"]);
    $unidade = utf8_decode($_POST["campoUnidade"]);
    $statusProduto = utf8_decode($_POST['campoStatusProduto']);
    $prazo = utf8_decode($_POST['campoPrazo']);
    $numero_orcamento = utf8_decode($_POST['campoNumeroOrcamento']);

}
//variaveis 
if(isset($_POST['adicionar'])){
    if($precoVenda==""){
        ?>
<script>
alertify.alert("Valor de venda do produto não foi preenchido");
</script>
<?php
    }else{

   
    $inserir = "INSERT INTO produto_cotacao ";
    $inserir .= "(cotacaoID, cod_produto, numero_orcamento, descricao , quantidade, preco_compra, margem , preco_venda,unidade,status, prazo )";
    $inserir .= " VALUES ";
    $inserir .= "('$codCotacao','$codProduto','$numero_orcamento','$nomeProduto','$qtdProduto','$precoCompra', '$margem' ,'$precoVenda','$unidade','$statusProduto','$prazo') ";
    $operacao_inserir = mysqli_query($conecta, $inserir);
  
    if(!$operacao_inserir){
        die("Falaha no banco de dados || pesquisar produto cotacao");
          }else{
            ?>
<script>
alertify.success("Produto incluido com sucesso!");
</script>
<?php
          }
        }

  }
  


$consulta = "SELECT * FROM produtos ";
if (isset($_GET["codigo"])){
   $codProduto=$_GET["codigo"];
$consulta .= " WHERE produtoID= {$codProduto} ";
}else{
   $consulta .= " WHERE produtoID = 1 ";
}

//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
   die("Falha na consulta ao banco de dados");
}else{
   $dados_detalhe = mysqli_fetch_assoc($detalhe);
  
}

if(isset($_GET)){
$cotacaoID = $_GET['cotacaoCod'];
$descrisaoGet = utf8_encode($_GET['nomProduto']);
$precoCompraGet = $_GET['precoCompra'];
$precoVendaGet = $_GET['precoVenda'];
$unidadeGet = $_GET['unidade'];
$numero_orcamentoGet = $_GET['numeroOrcamento'];


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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilo -->
    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
</head>

<body>


    <?php include_once("../_incluir/funcoes.php"); ?>


    <main>



        <form action="" method="post" style="width:100%;">
            <div style="margin:0 auto;">

                <table style="float: right; ">
                    <div id="titulo">
                        </p>Adicionar Produto na Cotação</p>
                    </div>


                    <tr>
                        <td align=left> <input type="submit" id="adicionar" name="adicionar" class="btn btn-success"
                                value="Incluir">
                        </td>

                        <td align=left> <button type="button" name="btnfechar" class="btn btn-secondary"
                                onclick="fechar();">Voltar</button>


                    </tr>

                </table>


                <table style="float:left;  margin-top:5px;">

                    <tr>
                        <td style="width:70px;">Código:</td>
                        <input style="margin-left:0px;" readonly type="text" size="10" name="codigoProduto"
                            value="<?php echo $codProduto; ?>">
                        </td>

                        <td align=left><input readonly type="hidden" size="10" name="codigoCotacao"
                                value="<?php echo $cotacaoID; ?>"> </td>
                    </tr>
                </table>

                <table style="float:left; ">
                    <tr>
                        <td style="width:70px;"><b>Produto:</b></td>
                        <td align=left><input style="margin-left:0px;" type="text" size=64 name="campoNomeProduto"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($nomeProduto);} elseif(!isset($_POST['adicionar'])){
                                    echo ($descrisaoGet);
                                }?>">
                        </td>
                        <td align=left> <b>Status:</b></td>
                        <td align=left><select style="width: 170px; margin-right:10px;" id="campoStatusProduto"
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
                        <td align=left><b>Prazo:</b></td>
                        <td align=left><input type="text" size=10 name="campoPrazo" id="campoPrazo"
                                onblur="calculavalormargem()" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($prazo);}?>">
                        </td>
                    </tr>
                </table>

                <table style="float:left;">
                    <tr>
                        <div>
                            <td align=left style="width:70px;"><b>Und:</b></td>
                            <td align=left><input type="text" size=10 name="campoUnidade" id="campoUnidade"
                                    autocomplete="off" value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($unidade);}
                                elseif(!isset($_POST['adicionar'])){
                                    echo utf8_encode($unidadeGet);
                                }?>">
                            </td>
                            <td align=left><b>Qtd:</b></td>
                            <td align=left><input type="text" size=10 name="campoQtdProduto" id="campoQtdProduto"
                                    onblur="calculavalormargem()" autocomplete="off"
                                    value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($qtdProduto);}?>">
                            </td>
                            <td align=left><b>P. cotado:</b></td>
                            <td align=left><input type="text" size=10 name="campoPrecoCotado" id="campoPrecoCotado"
                                    onblur="calculavalormargem()" autocomplete="off" value="<?php
                                if(isset($_POST['adicionar'])){ echo utf8_encode($precoCompra);}
                                elseif(!isset($_POST['adicionar'])){
                                    echo $precoCompraGet;
                                }?>" </td>
                            <td align=left><b>Margem:</b></td>
                            <td align=left><input type="text" size=10 name="campoMargem" id="campoMargem"
                                    onblur="calculavalorPrecoVenda()" autocomplete="off"
                                    value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($margem);}?>">
                            </td>
                            <td align=left><b>P. venda:</b></td>
                            <td align=left><input type="text" size=10 name="campoVenda" id="campoPrecoVenda"
                                    onblur="calculavalormargem()" autocomplete="off" value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($precoVenda);}
                                elseif(!isset($_POST['adicionar'])){
                                    echo $precoVendaGet;
                                }?>">
                            </td>


                            <td align=left><input type="hidden" size=10 name="campoNumeroOrcamento"
                                    id="campoNumeroOrcamento" onblur="calculavalormargem()" autocomplete="off" value="<?php 
                                    echo $numero_orcamentoGet;
                                ?>">
                            </td>


                        </div>
                    </tr>


                </table>
            </div>



    </main>
</body>

<?php include '../_incluir/funcaojavascript.jar'; ?>

<script>
function fechar() {
    window.close();
}
</script>
<script>
//abrir uma nova tela de cadastro
function abrepopupCadastroProduto() {

    var janela = "cadastro_produto.php";
    window.open(janela, 'popuppage',
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


</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>