<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
//inportar o alertar js
include('../alert/alert.php');
include_once("../_incluir/funcoes.php"); 

echo ".";
if(isset($_GET['codigo'])){
$codigo_pedido = $_GET['codigo'];
}

$select = "SELECT * FROM pedido_compra where codigo_pedido = '$codigo_pedido' ";
$operacao_select = mysqli_query($conecta,$select);
if(!$operacao_select){
die("Erro no banco de dados || pedido_compra");
 }else{
    $linha = mysqli_fetch_assoc($operacao_select);
    $valor_compraB = $linha['valor_total_compra'];
    $valor_vendaB = $linha['valor_total'];
    $valor_margemB= $linha['valor_total_margem'];
 }

if(isset($_POST['salvar'])){ 
    $valor_compra = $_POST['valorCompra'];
    $valor_margem = $_POST['margem'];

    $update = "UPDATE pedido_compra set valor_total_compra = '$valor_compra' , valor_total_margem = '$valor_margem' where codigo_pedido = '$codigo_pedido' ";
    $operacao_update = mysqli_query($conecta,$update);
        if(!$operacao_select){
        die("Erro no banco de dados || pedido_compra");
        }else{
            ?>
<script>
alertify.success("Valor salvo");
</script>
<?php
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
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>

</head>

<body>
    <div id="titulo">
        </p>Adicionar Valor de compra </p>
    </div>

    <form action="" autocomplete="off" method="post">
        <main>
            <div style="margin:0 auto; width:1200px; ">
                <table style="float:left;  margin-bottom: 10px;">
                    <tr>
                        <td>
                            <label for="valorCompra" style="width:80px;"> <b>V.compra:</b></label>
                            <input type="text" onblur="calculavalormargemGeral();" size="15" name="valorCompra"
                                id="valorCompra" value="<?php 
                                if($_POST){
                                echo $valor_compra;
                                }else{
                                echo $valor_compraB; 
                                }?>">
                        </td>
                        <td>
                            <label for="valorCompra" style="width:80px;"> <b>V. Venda:</b></label>
                            <input type="text" onblur="calculavalormargemGeral();" size="15" name="valorVenda"
                                id="valorVenda" value="<?php   echo $valor_vendaB; ?>">
                            <label for="valorCompra" style="width:90px;"> <b>Margem %:</b></label>
                            <input type="text" readonly size="10" name="margem" id="margem" value="<?php if($_POST){
                                echo $valor_margem;
                            }else{
                                echo $valor_margemB;
                            } ?>">


                            <input type="submit" onblur="calculavalormargemGeral();" class="btn btn-success"
                                name="salvar" value="Salvar">

                            <button type="button" name="btnfechar" onclick="fechar();"
                                class="btn btn-secondary">Voltar</button>
                        </td>

                    </tr>
                </table>



            </div>
        </main>
    </form>
</body>
<script>
function calculavalormargemGeral() {
    var campoPrecoVenda = document.getElementById("valorVenda").value;
    var campoPrecoCompra = document.getElementById("valorCompra").value;
    var campoMargem = document.getElementById("margem");
    var calculo;

    campoPrecoVenda = parseFloat(campoPrecoVenda);
    campoPrecoCompra = parseFloat(campoPrecoCompra);

    calculo = (((campoPrecoVenda - campoPrecoCompra) / campoPrecoVenda) * 100).toFixed(2);
    campoMargem.value = calculo;
}

function fechar() {
    window.close();
}
</script>

</html>
<?php
mysqli_close($conecta);
?>