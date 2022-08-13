<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include("../alert/alert.php");

echo "."; 

$select = "SELECT * from tb_categoria";
$lista_categoria = mysqli_query($conecta,$select);
if(!$lista_categoria){
    die("Falaha no banco de dados");
 }

 $select = "SELECT * from tb_fabricante";
$lista_fabricante = mysqli_query($conecta,$select);
if(!$lista_fabricante){
    die("Falaha no banco de dados");
 }

if(isset($_GET['codigo'])){
    $codProduto = $_GET["codigo"];

};




//variaveis 
if(isset($_POST["enviar"])){
    $hoje = date('Y-m-d'); 
    $produtoID = utf8_decode($_POST["cammpoProdutoID"]);
    $nome_produto = utf8_decode($_POST["campoNomeProduto"]);
    $preco_venda = utf8_decode($_POST["campoPrecoVenda"]);
    $preco_compra = utf8_decode($_POST["campoPrecoCompra"]);
    $estoque = utf8_decode($_POST["campoEstoque"]);
    $unidade_medida = utf8_decode($_POST["campoUnidadedeMedida"]);
    $categoria = utf8_decode($_POST["campoCategoria"]);
    $ativo = utf8_decode($_POST["campoAtivo"]);
  if(isset($_POST['enviar']))
  {
    if($categoria=="0"){

      ?>
<script>
alertify.alert("Favor informar a categoria do produto");
</script>

<?php 
    }elseif($nome_produto==""){
      ?>
<script>
alertify.alert("Favor informe a descrição do produto");
</script>

<?php 
    }else{
       

//inserindo as informações no banco de dados
  $inserir = "INSERT INTO produtos ";
  $inserir .= "( data_cadastro,nomeproduto,precovenda,precocompra,estoque,unidade_medida,observacao,nome_categoria,nome_ativo,fabricante,ncm )";
  $inserir .= " VALUES ";
  $inserir .= "( '$hoje','$nome_produto','$preco_venda',' $preco_compra',' $estoque','$unidade_medida','$observacao','$categoria','$ativo','$fabricante','$ncm')";

   
  $operacao_inserir = mysqli_query($conecta, $inserir);
  if(!$operacao_inserir){
      die("Erro no banco de dados inserir_no_banco_de_dados");
      
  }else{
    $nome_produto = "";
    $preco_venda = "";
    $preco_compra = "";
    $estoque = "";
    $unidade_medida = "";
    $categoria = "1";
    $ativo = "";
    $observacao = "";
    $fabricante = "";
    $ncm = "";
    ?>
<script>
alertify.success("Produto cadastrado com sucesso");
</script>

<?php
  }

}

}

}

//incluir funcão anexar
include "funcao.php";


?>

<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <main>
        <form action="" name="enviar_formulario" method="POST" enctype="multipart/form-data">

            <table style="margin-right:100px;">
                <div id="titulo">
                    </p>Imagem do produto</p>
                </div>

            </table>
        
                    <table style="width:900px; height:300px; border:1px;"  id="divisaoTabela">
                        <td>
                            <div id="imgProdutos"  style="width:380px;border:1px solid;padding:20px; margin:0 auto;">
                                <img src=<?php echo $img;?> style="text-align:center;" width="100%">
                                <p style="color:black;text-align:center;margin-top:20px; margin-bottom:0px; font-weight:500px"><?php echo strtoupper($b_titulo);?></p>
                                <input type="file" style="margin-top:50px" name="arquivo" id="file">
                                <ul>
                                    <li><input type="submit" value="Upload" id="upload" class="btn-btn-info"
                                            name="enviar_formulario"></li>
                                    <li> <input type="submit" value="Excluir" id="excluirImg" class="btn btn-danger"
                                            name="excluirImg"></li>
                                    <li>   <button type="button" name="btnfechar"
                                    onclick="window.opener.location.reload();fechar(); "
                                    class="btn btn-secondary">Voltar</button></li>
                                </ul>
                                
                            </div>
                        </td>

                    </table>


        


        </form>


    </main>


</body>


<script>
function fechar() {
    window.close();
}
</script>

</html>

<?php 
mysqli_close($conecta);
?>