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
$campo_obrigatorio_RazacaoS ="Descrição deve ser informado";
$msgcadastrado = "Produto cadastrado com sucesso!";


echo "."; 
//consultar categoria do produto
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
    $observacao = utf8_decode($_POST["campoObservacao"]);
    $fabricante =  utf8_decode($_POST["campoFabricante"]);
    $ncm =  utf8_decode($_POST["campoNcm"]);
   

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
      die("Erro no banco de dados Linha 63 inserir_no_banco_de_dados");
      
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

}?>