<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php"); 
//inportar o alertar js
include('../alert/alert.php');

echo ",";
$hoje = date('Y-d-m');
if (isset($_GET["codigo"])){
    $codProduto=$_GET["codigo"];
}
//deckara as varuaveus
if(isset($_POST['btnremover'])){
 
    //inlcuir as varias do input
    $codProduto = utf8_decode($_POST["codigoProduto"]);
    $nomeProduto= utf8_decode($_POST["campoNomeProduto"]);
    $qtdProduto = utf8_decode($_POST["campoQtdProduto"]);
    $precoCompra = utf8_decode($_POST["campoPrecoCotado"]);
    $precoVenda = $_POST["campoVenda"];
    $margem = utf8_decode($_POST["campoMargem"]);
    $unidade = utf8_decode($_POST["campoUnidade"]);
    $prazo_entrega = utf8_decode($_POST['campoPrazo']);


   //query para remover o cliente no banco de dados
   $remover = "DELETE FROM produto_cotacao WHERE produto_cotacao = {$codProduto} ";

     $operacao_remover = mysqli_query($conecta, $remover);
     if(!$operacao_remover) {
         die("Erro remover produto cotacao");   
     } else {
        ?>
<script>
alertify.error("Produto removido com sucesso!");
</script>
<?php
         //header("location:listagem.php"); 
          
     }
   
   }

   
   if(isset($_POST['btnCadastrar'])){
    //cadastrar o produto no sistema 
    $codProduto = utf8_decode($_POST["codigoProduto"]);
    $nomeProduto= utf8_decode($_POST["campoNomeProduto"]);
    $qtdProduto = utf8_decode($_POST["campoQtdProduto"]);
    $precoCompra = utf8_decode($_POST["campoPrecoCotado"]);
    $precoVenda = $_POST["campoVenda"];
    $margem = utf8_decode($_POST["campoMargem"]);
    $unidade = utf8_decode($_POST["campoUnidade"]);
    $statusProduto = utf8_decode($_POST['campoStatusProduto']);
    $prazo_entrega = utf8_decode($_POST['campoPrazo']);

    $selectProdutos = "SELECT * from produtos WHERE nomeproduto = '{$nomeProduto}' ";
    $lista_Produtos= mysqli_query($conecta, $selectProdutos);
    if(!$lista_Produtos){
    die("Falaha no banco de dados");
}else{
     $row_banco = mysqli_fetch_assoc($lista_Produtos);
     $produtoBanco = $row_banco['nomeproduto'];}

     if($nomeProduto == $produtoBanco){
         ?>

<script>
alertify.alert("Não foi possivel cadastrar o Produto pois ele já possui cadastro no sistema");
</script>
<?php 

}else{
    $inserirProduto = "INSERT INTO produtos ";
    $inserirProduto .= "(data_cadastro,nomeProduto,precovenda,precocompra,unidade_medida, nome_categoria,nome_ativo)";
    $inserirProduto .= " VALUES ";
    $inserirProduto .= "( '$hoje','$nomeProduto','$precoVenda','$precoCompra','$unidade','3','1' )";
    $operacao_inserir_produto = mysqli_query($conecta, $inserirProduto);
    if(!$operacao_inserir_produto) {
        die("Erro de inclusão - banco de dados"); }
        else{
                ?>
<script>
alertify.success("Produto cadastrado com sucesso!");
</script>
<?php
                    
            
        }

                

    }
 
   }
  
   
if(isset($_POST['btnsalvar'])){

    //inlcuir as varias do input
    $codProduto = utf8_decode($_POST["codigoProduto"]);
    $nomeProduto= utf8_decode($_POST["campoNomeProduto"]);
    $qtdProduto = utf8_decode($_POST["campoQtdProduto"]);
    $precoCompra = utf8_decode($_POST["campoPrecoCotado"]);
    $precoVenda = $_POST["campoVenda"];
    $margem = utf8_decode($_POST["campoMargem"]);
    $unidade = utf8_decode($_POST["campoUnidade"]);
    $statusProduto = utf8_decode($_POST['campoStatusProduto']);
    $prazo_entrega = utf8_decode($_POST['campoPrazo']);
   
   //query para alterar o produto da cotacao no banco de dados
   $alterar_produto = "UPDATE produto_cotacao set descricao = '{$nomeProduto}', quantidade = '{$qtdProduto}', preco_compra = '{$precoCompra}',  preco_venda = '{$precoVenda}' ,  margem = '{$margem}' ,  unidade = '{$unidade}', status = '{$statusProduto}', prazo = '{$prazo_entrega}' WHERE produto_cotacao = {$codProduto}  ";

     $operacao_alterar_produto = mysqli_query($conecta, $alterar_produto);
     if(!$operacao_alterar_produto) {
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



//consultar o produto da cotacao
$consulta = "SELECT * FROM produto_cotacao ";
$consulta .= " WHERE produto_cotacao= {$codProduto} ";


//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
   die("Falha na consulta ao banco de dados");
}else{
   $dados_detalhe = mysqli_fetch_assoc($detalhe);
   $produto =  utf8_encode($dados_detalhe['descricao']);
   $cotacaoID = utf8_encode($dados_detalhe['cotacaoID']);
   $quantidade =  utf8_encode($dados_detalhe['quantidade']);
   $precoCompra =  utf8_encode($dados_detalhe['preco_compra']);
   $precoVenda =  utf8_encode($dados_detalhe['preco_venda']);
   $margem =  utf8_encode($dados_detalhe['margem']);
   $unidade =  utf8_encode($dados_detalhe['unidade']);
   $status =  utf8_encode($dados_detalhe['status']);
   $prazo =  utf8_encode($dados_detalhe['prazo']);
   
  
}

//consultar o status do produto
$select = "SELECT * FROM status_produto_cotacao ";
$lista_status_produto_cotacao = mysqli_query($conecta,$select);
if(!$lista_status_produto_cotacao){
    die("Falaha no banco de dados");
}




//funcao para anexar o inserir as informacoes no banco de dados
function anexarArquivoImg($novoNome,$pasta,$codProduto){
    include("../conexao/conexao.php");
    $update = "UPDATE produto_cotacao set img = '$pasta$novoNome'  where produto_cotacao = {$codProduto} ";
    $operacao_update = mysqli_query($conecta, $update);
    if(!$operacao_update){
        die("Erro no banco de dados || Inserir o diretorio no banco de dados");
    }

}

function excluirImg($codProduto){
    include("../conexao/conexao.php");
    $remover = "UPDATE produto_cotacao set img = ''  where produto_cotacao = {$codProduto} ";
    $operacao_remover = mysqli_query($conecta, $remover);
    if(!$operacao_remover){
        die("Erro no banco de dados || Inserir o diretorio no banco de dados");
    }

}



if(isset($_POST['enviar_formulario'])){
    $codProduto = $_GET["codigo"];
    $formatosPermitidos = array("png","PNG","jpeg","jpg","gif");
    $extensao = pathinfo($_FILES['arquivo']['name'],PATHINFO_EXTENSION);

    if(in_array($extensao,$formatosPermitidos)){
        $pasta = "imgProdutos/";
        $temporario = $_FILES['arquivo']['tmp_name'];
        $novoNome = uniqid().".".$extensao;
        $nome = ($_FILES['arquivo']['name']);

        if(move_uploaded_file($temporario,$pasta.$novoNome)){
            //incliur no banco de dados
            anexarArquivoImg($novoNome,$pasta,$codProduto);
            ?>
<script>
alertify.success("Uplop efetuado com sucesso");
</script>
<?php

        }else{
            ?>
<script>
alertify.error("Não foi possivel fazer o Upload");
</script>
<?php
        }
        
    }else{
        ?>
<script>
alertify.error("Arquivo com formato invalido");
</script>
<?php
    }
}

if(isset($_POST['excluirImg'])){
    excluirImg($codProduto);
}

$select = "SELECT * from produto_cotacao where produto_cotacao = '$codProduto' ";
$operacao_select = mysqli_query($conecta, $select);
if(!$operacao_select){
    die("Erro no banco de dados || select no diretorio do anexo no banco de dados");
}else{
    $linha = mysqli_fetch_assoc($operacao_select);
    $img = $linha['img'];
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

            <table style="float: right;margin-bottom:20px">
                <div id="titulo">
                    </p>Editar Produto</p>
                </div>


                <tr>


                    <form action="" method="post">

                        <td align=left> <input type="submit" id="salvar" name="btnsalvar" class="btn btn-success"
                                value="salvar">
                        </td>
                        <td align=left> <input type="submit" id="cadastrar" name="btnCadastrar" class="btn btn-primary"
                                value="Cadastar"
                                onClick="return confirm('Confirmar o cadastro do produto no sistema?');">
                        </td>
                        <td> <input id="remover" type="submit" name="btnremover" value="Remover" class="btn btn-danger"
                                onClick="return confirm('Confirmar Remoção do produto da cotação <?php echo $cotacaoID;?>');"></input>
                        </td>
                        <td align=left> <button type="button" name="btnfechar" class="btn btn-secondary"
                                onclick="window.opener.location.reload();fechar()">Voltar</button>
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

                    <td align=left><input readonly type="hidden" size="10" name="codigoCotacao"
                            value="<?php echo $cotacaoID; ?>"> </td>
                </tr>
            </table>

            <table style="float:left; ">
                <tr>
                    <td><b>Produto:</b></td>
                    <td align=left><input style="margin-left:0px;" type="text" size=64 name="campoNomeProduto" value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($nomeProduto);} elseif(!isset($_POST['adicionar'])){
                                    echo $produto;
                                }?>">
                    </td>

                    <td align=left> <b>Status:</b></td>
                    <td align=left><select style="width: 170px; margin-right:10px;" id="campoStatusProduto"
                            name="campoStatusProduto">

                            <?php  
                        $meu_status = $status;
                        while($linha_status_produto  = mysqli_fetch_assoc($lista_status_produto_cotacao)){
                            $status_principal = utf8_encode($linha_status_produto["status_produtoID"]);
                            if($meu_status==$status_principal){
                            ?> <option value="<?php echo utf8_encode($linha_status_produto["status_produtoID"]);?>"
                                selected>
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

 


?>

                        </select>

                    </td>
                    <td align=left><b>Prazo:</b></td>
                    <td align=left><input type="text" size=10 name="campoPrazo" id="campoPrazo"
                            value="<?php echo utf8_encode($prazo);?>">
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
                        <td align=left><b>P. cotado:</b></td>
                        <td align=left><input type="text" size=10 name="campoPrecoCotado" id="campoPrecoCotado"
                                onblur="calculavalormargem()" autocomplete="off" value="<?php echo $precoCompra; ?>">
                        </td>
                        <td align=left><b>Margem:</b></td>
                        <td align=left><input type="text" size=10 name="campoMargem" id="campoMargem"
                                onblur="calculavalorPrecoVenda()" autocomplete="off" value="<?php echo $margem?>">
                        </td>
                        <td align=left><b>P. venda:</b></td>
                        <td align=left><input type="text" size=10 name="campoVenda" id="campoPrecoVenda"
                                onblur="calculavalormargem()" autocomplete="off" value="<?php echo $precoVenda;
                                ?>">
                        </td>


                    </div>
                </tr>


            </table>


            <table style="float:left; width:1400px; " id="divisaoTabela">
                <td>
                    <div id="DivisaoNota">
                        <p>Imagem do produto</p>
                    </div>
                </td>

            </table>
            </form>

            <form action="" method="POST" enctype="multipart/form-data">
                <div style="width:300px; float:left; height:400px;">
                    <table style="float:left; width:1400px; " id="divisaoTabela">
                        <td>
                            <div id="imgProdutos" style="width:340px; height:200px;padding:20px">
                                <img src=<?php echo $img;?> style="text-align:center;" height="150" width="200">

                                <input type="file" style="margin-top:50px" name="arquivo" id="file">
                                <ul>

                                    <li><input type="submit" value="Upload" id="upload" class="btn-btn-info"
                                            name="enviar_formulario"></li>
                                    <li> <input type="submit" value="Excluir" id="excluirImg" class="btn btn-danger"
                                            name="excluirImg"></li>
                                </ul>
                            </div>
                        </td>

                    </table>
                </div>
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