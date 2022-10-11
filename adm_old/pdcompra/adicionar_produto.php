<?php 
require_once("../conexao/conexao.php");


if(isset($_POST["txtProduto"])) {
       
    $hoje = date('Y-m-d'); 
    $codPedido = utf8_decode($_POST["txtcodigo"]);
    $produto = utf8_decode($_POST["txtProduto"]);
    $precoVenda = utf8_decode($_POST["txtprecoUnitarioVenda"]);
    $precoCompra = utf8_decode($_POST["txtprecoUnitarioCompra"]);
    $unidade = utf8_decode($_POST["txtUnidade"]);
    $quantidade = utf8_decode($_POST["txtQuantidade"]);
    $margem = utf8_decode($_POST["txtMargem"]);
    $desconto = utf8_decode($_POST["txtDesconto"]);


    $inserir = "INSERT INTO tb_pedido_item ";
    $inserir .= "( data_lancamento,)";
    $inserir .= " VALUES ";
    $inserir .= "( '$hoje' )";

    $operacao_insercao = mysqli_query($conecta,$inserir);
    if($operacao_insercao){
      echo "ok";
    }else{
        echo "erro";
     }
    
 
}