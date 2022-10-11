<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />

<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");

echo ",";
//coletar os codigos do produto que foram enviados via get
if (isset($_GET["codigo"])){
    $codProduto=$_GET["codigo"];
    $codPedido=$_GET["codigoPedido"];
    $cod_produto=$_GET["cod_produto"];
}

//deckara as varuaveus
if((isset($_POST['adicionar']))){
    $hoje = date('Y-m-d'); 
   //inlcuir as varias do input
   $codPedido = utf8_decode($_POST["codigoPedido"]);
   $codProduto = utf8_decode($_POST["codigoProduto"]);
   $nomeProduto= utf8_decode($_POST["campoNomeProduto"]);
   $qtdProduto = utf8_decode($_POST["campoQtdProduto"]);
   $precoCompra = utf8_decode($_POST["campoPrecoCompra"]);
   $precoVenda = $_POST["campoVenda"];
   $margem = utf8_decode($_POST["campoMargem"]);
   $unidade = utf8_decode($_POST["campoUnidade"]);
   $statusCompra = utf8_decode($_POST['txtStatusCompra']);
  
  if($statusCompra == "1"){
    ?>
<script>
alertify.alert("Favor Selecione o status da compra");
</script>
<?php
  }else{


  
  //query para alterar o produto da cotacao no banco de dados
  $inserir = "INSERT INTO tb_pedido_item ";
  $inserir .= "( data_lancamento,pedidoID,cod_produto,produto,unidade,quantidade,preco_compra_unitario,preco_venda_unitario,margem,status_compra )";
  $inserir .= " VALUES ";
  $inserir .= "( '$hoje','$codPedido','$cod_produto','$nomeProduto','$unidade','$qtdProduto','$precoCompra','$precoVenda','$margem','$statusCompra' )";
  $operacao_inserir = mysqli_query($conecta, $inserir);
  if(!$operacao_inserir){
   print_r($_POST);
     die("Erro no banco de dados || adicionar o produto no banco de dados");
      
 }
    ?>
<script>
alertify.success("Produto incluido com sucesso!");
</script>
<?php
    }
}


//consultar o produto 
$consulta = "SELECT * FROM produto_cotacao ";
$consulta .= " WHERE produto_cotacao = {$codProduto} ";

//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
   die("Falha na consulta ao banco de dados");
}else{
   $linha = mysqli_fetch_assoc($detalhe);
   $produtoID = $linha['produto_cotacao'];
   $descricaoB = utf8_encode($linha['descricao']);
   $precoCompraB = $linha['preco_compra'];
   $precoVendaB = $linha['preco_venda'];
   $unidadeB = $linha['unidade'];
   $quantidadeB = $linha['quantidade'];
   $margemB = $linha['margem'];
}


//consultar o status do produto
$select = "SELECT * FROM status_produto_cotacao ";
$lista_status_produto_cotacao = mysqli_query($conecta,$select);
if(!$lista_status_produto_cotacao){
    die("Falaha no banco de dados");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilo -->
    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
</head>

<body>


    <?php include_once("../_incluir/funcoes.php"); ?>


    <main>




        <div style="margin:0 auto; width:1400px; ">

            <table style="float: right;">
                <div id="titulo">
                    </p>Adicionar Produto</p>
                </div>


                <tr>

                    <form action="" method="post">
                        <td align=left> <input type="submit" id="adicionar" name="adicionar" class="btn btn-success"
                                value="salvar">
                        </td>

                        <td align=left> <button type="button" name="btnfechar" class="btn btn-secondary"
                                onclick="fechar();">Voltar</button>





                </tr>

            </table>

            </td>

            </tr>

            </table>


            <table style="float:left;  margin-top:5px;">

                <tr>
                    <td style="width:70px;"><b>Código:</b></td>
                    <input style="margin-left:0px;" readonly type="text" size="10" name="codigoProduto"
                        value="<?php echo $codProduto; ?>">
                    </td>

                    <input style="margin-left:0px;" readonly type="hidden" size="10" name="codigoPedido"
                        value="<?php echo $codPedido; ?>">
                    </td>


                </tr>

                </tr>
            </table>

            <table style="float:left; ">
                <tr>
                    <td style="width:70px;"><b>Produto:</b></td>
                    <td align=left><input style="margin-left:0px;" type="text" size=62 name="campoNomeProduto" value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($nomeProduto);} elseif(!isset($_POST['adicionar'])){
                                    echo ($descricaoB);
                                }?>">
                    </td>
                    <td align=left> <label for="txtStatusCompra" style="width:150px;"> <b>Status da
                                compra:</b></label>
                        <select style="margin-right: 40px;" id="txtStatusCompra" name="txtStatusCompra">
                            <?php 
                                while($linha_statusCompra  = mysqli_fetch_assoc($lista_statuscompra)){
                                    $statusCompraPrincipal = utf8_encode($linha_statusCompra["statuscompraID"]);
                                   if(!isset($statusCompra)){
                                   
                                   ?>
                            <option value="<?php echo utf8_encode($linha_statusCompra["statuscompraID"]);?>">
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
                            <option value="<?php echo utf8_encode($linha_statusCompra["statuscompraID"]);?>">
                                <?php echo utf8_encode($linha_statusCompra["nome"]);?>
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

            <table style="float:left;">
                <tr>
                    <div>
                        <td align=left style="width:70px;"><b>Und:</b></td>
                        <td align=left><input type="text" size=10 name="campoUnidade" id="campoUnidade"
                                autocomplete="off" value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($unidade);}
                                elseif(!isset($_POST['adicionar'])){
                                    echo utf8_encode($unidadeB);
                                }?>">
                        </td>
                        <td align=left><b>Qtd:</b></td>
                        <td align=left><input type="text" size=10 name="campoQtdProduto" id="campoQtdProduto"
                                onblur="calculavalormargem()" autocomplete="off" value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($qtdProduto);} elseif(!isset($_POST['adicionar'])){
                                    echo $quantidadeB;}?>">
                        </td>
                        <td align=left><b>P. Compra:</b></td>
                        <td align=left><input type="text" size=10 name="campoPrecoCompra" id="campoPrecoCompra"
                                onblur="calculavalormargem()" autocomplete="off" value="<?php
                                if(isset($_POST['adicionar'])){ echo utf8_encode($precoCompra);}
                                elseif(!isset($_POST['adicionar'])){
                                    echo $precoCompraB;
                                }?>" </td>
                        <td align=left><b>P. venda:</b></td>
                        <td align=left><input type="text" size=10 name="campoVenda" id="campoPrecoVenda"
                                onblur="calculavalormargem()" autocomplete="off" value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($precoVenda);}
                                elseif(!isset($_POST['adicionar'])){
                                    echo $precoVendaB;
                                }?>">
                        </td>
                        <td align=left><b>Margem:</b></td>
                        <td align=left><input type="text" size=10 name="campoMargem" id="campoMargem" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($margem);} elseif(!isset($_POST['adicionar'])){
                                    echo $margemB*100;
                                }?>">
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
    var campoPrecoCompra = document.getElementById("campoPrecoCompra").value;
    var campoPrecoVenda = document.getElementById("campoPrecoVenda").value;
    var campoMargem = document.getElementById("campoMargem");
    var calculo;

    campoPrecoVenda = parseFloat(campoPrecoVenda);
    campoPrecoCompra = parseFloat(campoPrecoCompra);

    calculo = (((campoPrecoVenda - campoPrecoCompra) / campoPrecoVenda) * 100).toFixed(2);

    campoMargem.value = calculo;


}
</script>



</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>