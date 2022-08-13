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


echo ",";
$hoje = date('Y-d-m');

if(isset($_POST['btnsalvar'])){

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
   
   
   //query para alterar o produto da cotacao no banco de dados
   $alterar = "UPDATE tb_pedido_item set produto = '{$nomeProduto}', quantidade = '{$qtdProduto}', preco_compra_unitario = '{$precoCompra}',  preco_venda_unitario = '{$precoVenda}' ,  margem = '{$margem}' ,  unidade = '{$unidade}', status_compra = '{$statusCompra}' WHERE pedido_itemID = {$codProduto} and pedidoID = {$codPedido} ";

     $operacao_alterar = mysqli_query($conecta, $alterar);
     if(!$operacao_alterar) {
         die("Erro na alteracao - banco de dados");   
     } else {  
        ?>
<script>
alertify.success("Dados alterados");
</script>
<?php
         //header("location:listagem.php"); 
          
     }
   
   }



//consultar o produto 
$consulta = "SELECT * FROM tb_pedido_item ";
if (isset($_GET["codigo"])){
   $codPedido=$_GET["codigo"];
   $codProduto=$_GET["produtoCodigo"];
$consulta .= " WHERE pedido_itemID = {$codProduto} and pedidoID = {$codPedido}  ";
}

//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
   die("Falha na consulta ao banco de dados");
}else{
   $dados_detalhe = mysqli_fetch_assoc($detalhe);
   $produto =  utf8_encode($dados_detalhe['produto']);
   $quantidade =  utf8_encode($dados_detalhe['quantidade']);
   $precoCompra =  utf8_encode($dados_detalhe['preco_compra_unitario']);
   $precoVenda =  utf8_encode($dados_detalhe['preco_venda_unitario']);
   $margem =  utf8_encode($dados_detalhe['margem']);
   $unidade =  utf8_encode($dados_detalhe['unidade']);
   $statusCompra =  utf8_encode($dados_detalhe['status_compra']);
  
   
  
}

if(isset($_POST['btnremover'])){
    //query para remover o cliente no banco de dados
    $remover = "DELETE FROM tb_pedido_item WHERE pedido_itemID = {$codProduto} and pedidoID = {$codPedido} ";
    $codPedido = "";
    $codProduto = "";
   $produto =  "";
   $produto =  "";
   $quantidade =  "";
   $precoCompra = "";;
   $precoVenda = "";
   $margem =  "";
   $unidade =  "";
   $statusCompra = "1";

      $operacao_remover = mysqli_query($conecta, $remover);
      if(!$operacao_remover) {
          die("Erro remover produto");   
      } else {
         ?>
<script>
alertify.error("Produto removido com sucesso!");
</script>
<?php
          //header("location:listagem.php"); 
           
      }
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
                    </p>Editar Produto</p>
                </div>


                <tr>

                    <form action="" method="post">

                        <td align=left> <input type="submit" id="salvar" name="btnsalvar" class="btn btn-success"
                                value="salvar">
                        </td>
                        <td> <input id="remover" type="submit" name="btnremover" value="Remover" class="btn btn-danger"
                                onClick="return confirm('Confirmar Remoção do produto da cotação <?php echo $codProduto;?>');"></input>
                        </td>


                        <td align=left> <button type="button" name="btnfechar" class="btn btn-secondary"
                                onclick="window.opener.location.reload();fechar();">Voltar</button>
                        </td>





                </tr>

            </table>

            </td>

            </tr>

            </table>


            <table style="float:left; width:900px; margin-top:5px;">

                <tr>
                    <td>Código:
                        <input style="margin-left:0px;" readonly type="text" size="10" name="codigoProduto"
                            value="<?php echo $codProduto; ?>">
                    </td>

                    <td align=left><input readonly type="hidden" size="10" name="codigoPedido"
                            value="<?php echo $codPedido; ?>"> </td>
                </tr>
            </table>

            <table style="float:left; ">
                <tr>
                    <td><b>Produto:</b></td>
                    <td align=left><input style="margin-left:0px;" type="text" size=62 name="campoNomeProduto" value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($nomeProduto);} elseif(!isset($_POST['adicionar'])){
                                    echo $produto;
                                }?>">
                    </td>


                    <td align=left> <label for="txtStatusCompra" style="width:150px;"> <b>Status da
                                compra:</b></label>
                        <select style="margin-right: 40px;" id="txtStatusCompra" name="txtStatusCompra">
                            <?php 
                            $meuStatusCompra = $statusCompra;
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

                    </td>

                </tr>
            </table>

            <table style="float:left;">
                <tr>
                    <div>
                        <td align=left style="width:70px;"><b>Und:</b></td>
                        <td align=left><input type="text" size=10 name="campoUnidade" id="campoUnidade"
                                autocomplete="off" value="<?php echo $unidade; ?>">
                        </td>
                        <td align=left><b>Qtd:</b></td>
                        <td align=left><input type="text" size=10 name="campoQtdProduto" id="campoQtdProduto"
                                onblur="calculavalormargem()" autocomplete="off" value="<?php echo $quantidade?>">
                        </td>
                        <td align=left><b>P. Compra:</b></td>
                        <td align=left><input type="text" size=10 name="campoPrecoCompra" id="campoPrecoCompra"
                                onblur="calculavalormargem()" autocomplete="off" value="<?php echo $precoCompra; ?>">
                        </td>
                        <td align=left><b>P. venda:</b></td>
                        <td align=left><input type="text" size=10 name="campoVenda" id="campoPrecoVenda"
                                onblur="calculavalormargem()" autocomplete="off" value="<?php echo $precoVenda;
                                ?>">
                        </td>
                        <td align=left><b>Margem:</b></td>
                        <td align=left><input type="text" size=10 name="campoMargem" id="campoMargem" autocomplete="off"
                                value="<?php echo $margem?>">
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