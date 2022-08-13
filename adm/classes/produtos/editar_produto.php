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
 echo "."; 
if(isset($_POST['btnsalvar'])){

//inlcuir as varias do input

$produtoID = utf8_decode($_POST["cammpoProdutoID"]);
$nome_produdo = utf8_decode($_POST["campoNomeProduto"]);
$preco_venda = utf8_decode($_POST["campoPrecoVenda"]);
$preco_compra = utf8_decode($_POST["campoPrecoCompra"]);
$estoque = utf8_decode($_POST["campoEstoque"]);
$unidade_medida = utf8_decode($_POST["campoUnidadedeMedida"]);
$categoria = utf8_decode($_POST["campoCategoria"]);
$ativo = utf8_decode($_POST["campoAtivo"]);
$observacao = utf8_decode($_POST["campoObservacao"]);
$fabricante =  utf8_decode($_POST["campoFabricante"]);
$ncm =  utf8_decode($_POST["campoNcm"]);


if($categoria=="0"){
     
    ?>
<script>
alertify.alert("Favor informar a categoria do produto");
</script>

<?php 
  }elseif($nome_produdo==""){
    ?>
<script>
alertify.alert("Favor informe a descrição do produto");
</script>

<?php 
  }else{
     
//query para alterar o cliente no banco de dados
$alterar = "UPDATE produtos set nomeproduto = '{$nome_produdo}', precovenda = '{$preco_venda}', precocompra = '{$preco_compra}',  estoque = '{$estoque}', ncm = '{$ncm}', ";
$alterar .= " unidade_medida = '{$unidade_medida}', categoriaID = '{$categoria}', ativoID = '{$ativo}', observacao = '{$observacao}', nome_categoria = '{$categoria}', nome_ativo = '{$ativo}',fabricante = '{$fabricante}' WHERE produtoID = {$produtoID} ";

 $operacao_alterar = mysqli_query($conecta, $alterar);
 if(!$operacao_alterar) {
     die("Erro banco de dados || upate no banco de dados || tabela produtos");   
 } else { ?>
<script>
alertify.success("Dados alterados");
</script>

<?php
     //header("location:listagem.php"); 
    }
      
 }

}

?>

<?php
if(isset($_POST['btnremover'])){

//inlcuir as varias do input
include("../_incluir/variaveis_input_produto.php");

//query para remover o produto no banco de dados
$remover = "DELETE FROM produtos WHERE produtoID = {$produtoID}";

 $operacao_remover = mysqli_query($conecta, $remover);

 if(!$operacao_remover) {
     die("Erro linha 44");   
 } else {    ?>
<script>
alertify.error("Produto removido com sucesso");
</script>

<?php
     //header("location:listagem.php"); 
      
 }

}

?>

<?php


//variaveis
$campo_obrigatorio_RazacaoS ="Razao Social deve ser informada";
$msgcadastrado = "Cliente cadastrado com sucesso";


$select = "SELECT estadoID, nome from estados";
$lista_estados = mysqli_query($conecta,$select);
if(!$lista_estados){
die("Falaha no banco de dados  Linha 49 cadastro_cliente");
}


$consulta = "SELECT * FROM produtos ";
if (isset($_GET["codigo"])){
$produtoID=$_GET["codigo"];
$consulta .= " WHERE produtoID = {$produtoID} ";
}else{
$consulta .= " WHERE produtoID = 1 ";

}
//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
die("Falha na consulta ao banco de dados");
}else{

$dados_detalhe = mysqli_fetch_assoc($detalhe);
$BprodutoID=  utf8_encode($dados_detalhe['produtoID']);
$Bnome_produdo =  utf8_encode($dados_detalhe["nomeproduto"]);
$Bpreco_venda = utf8_encode($dados_detalhe["precovenda"]);
$Bpreco_compra = utf8_encode($dados_detalhe["precocompra"]);
$Bestoque = utf8_encode($dados_detalhe["estoque"]);
$Bunidade_medida = $dados_detalhe["unidade_medida"];
$Bcategoria = utf8_encode($dados_detalhe["nome_categoria"]);
$Bativo = utf8_encode($dados_detalhe["nome_ativo"]);
$Bobservacao = utf8_encode($dados_detalhe["observacao"]);
$Bfabricante = utf8_encode($dados_detalhe["fabricante"]);
$Bncm = utf8_encode($dados_detalhe["ncm"]);

}

//consulta categoria

$select = "SELECT categoriaID, nome_categoria from categoria_produto";
$lista_categoria = mysqli_query($conecta,$select);
if(!$lista_categoria){
die("Falaha no banco de dados  Linha 89");
}

//consultar Situação ativo
$selectativo = "SELECT ativoID, nome_ativo from ativo";
$lista_ativo = mysqli_query($conecta, $selectativo);
if(!$lista_ativo){
die("Falaha no banco de dados  Linha 96 ");
}
?>