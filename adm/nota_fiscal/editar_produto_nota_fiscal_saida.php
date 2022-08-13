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
$hoje = date('Y-d-m');
//cadastrar o produto em cadastro de produtos
   if(isset($_POST['btnCadastrar'])){
    //cadastrar o produto no sistema 
    $codigo = utf8_decode($_POST["codigoProduto"]);
    $descricao= utf8_decode($_POST["campoDescricao"]);
    $ncm = utf8_decode($_POST["campoNcm"]);
    $cfop = utf8_decode($_POST["campoCfop"]);
    $und = utf8_decode($_POST["campoUnd"]);
    $quantidade = utf8_decode($_POST["campoQuantidade"]);
    $valor_unitario = utf8_decode($_POST["campoValorUnitario"]);
    $valor_produto = utf8_decode($_POST['campoValorProduto']);
    $bc_icms = utf8_decode($_POST['campoBcIcms']);
    $valor_icms = utf8_decode($_POST['campoValorIcms']);
    $valor_ipi = utf8_decode($_POST['campoValorIpi']);
    $icms = utf8_decode($_POST['campoIcms']);
    $ipi = utf8_decode($_POST['campoIpi']);

    $selectProdutos = "SELECT * from produtos WHERE nomeproduto = '{$descricao}' ";
    $lista_Produtos= mysqli_query($conecta, $selectProdutos);
    if(!$lista_Produtos){
    die("Falaha no banco de dados");
}else{
     $row_banco = mysqli_fetch_assoc($lista_Produtos);
     $produtoBanco = $row_banco['nomeproduto'];}

     if($descricao == $produtoBanco){
         ?>

<script>
alertify.alert("Não foi possivel cadastrar o Produto pois ele já possui cadastro no sistema");
</script>
<?php 

}else{
    $inserirProduto = "INSERT INTO produtos ";
    $inserirProduto .= "(data_cadastro,nomeProduto,precovenda,unidade_medida, nome_categoria,nome_ativo,ncm)";
    $inserirProduto .= " VALUES ";
    $inserirProduto .= "( '$hoje','$descricao','$valor_unitario','$und','3','1','$ncm' )";
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
 

//consultar o produto da cotacao
$consulta = "SELECT * FROM tb_nfe_saida_item  ";
if (isset($_GET["codigo"])){
   $codProduto=$_GET["codigo"];
$consulta .= " WHERE nfe_iten_saidaID = {$codProduto} ";
}else{
   $consulta .= " WHERE nfe_iten_saidaID = 1 ";
}

//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
   die("Falha na consulta ao banco de dados");
}else{
   $dados_detalhe = mysqli_fetch_assoc($detalhe);
   $Bcodigo =  utf8_encode($dados_detalhe['codigo']);
   $Bdescicao = utf8_encode($dados_detalhe['descricao']);
   $Bncm =  utf8_encode($dados_detalhe['ncm']);
   $Bcfop =  utf8_encode($dados_detalhe['cfop']);
   $Bund =  utf8_encode($dados_detalhe['und']);
   $Bquantidade =  utf8_encode($dados_detalhe['quantidade']);
   $Bvalor_unitario =  utf8_encode($dados_detalhe['valor_unitario']);
   $Bvalor_produto =  utf8_encode($dados_detalhe['valor_produto']);
   $Bbc_icms =  utf8_encode($dados_detalhe['bc_icms']);
   $Bvalor_icms =  utf8_encode($dados_detalhe['valor_icms']);
   $Bvalor_ipi =  utf8_encode($dados_detalhe['valor_ipi']);
   $Bicms =  utf8_encode($dados_detalhe['icms']);
   $Bipi =  utf8_encode($dados_detalhe['ipi']);
   
  
}

 //remover produto nota saida
 if(isset($_POST['btnremover'])){
    //query para remover o cliente no banco de dados
    $remover = "DELETE FROM tb_nfe_saida_item WHERE nfe_iten_saidaID = {$codProduto} ";
 
      $operacao_remover = mysqli_query($conecta, $remover);
      if(!$operacao_remover) {
          die("Erro remover produto || tabela tb_nfe_saida_item");   
      } else {
         ?>
<script>
alertify.success("Produto removido com sucesso!");
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

//consultar o status do produto
$select = "SELECT * FROM tb_cfop ";
$lista_cfop= mysqli_query($conecta,$select);
if(!$lista_cfop){
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




        <div style="margin:0 auto; width:1400px; ">

            <table style="float: right; ">
                <div id="titulo">
                    </p>Editar Produto</p>
                </div>

            </table>
            <table style="float:right ;">
                <tr>


                    <form action="" method="post">
                        <td align=left> <input type="submit" id="cadastrar" name="btnCadastrar" class="btn btn-primary"
                                value="Cadastar"
                                onClick="return confirm('Confirmar o cadastro do produto no sistema?');">
                        </td>


                        <td> <input id="remover" type="submit" name="btnremover" value="Remover" class="btn btn-danger"
                                onClick="return confirm('Confirmar Remoção do produto da cotação <?php ?>');"></input>
                        </td>

                        <td align=left> <button type="button" name="btnfechar" class="btn btn-secondary"
                                onclick="fechar();">Voltar</button>
                        </td>

                </tr>
            </table>

            </table>


            <table style="float:left; width:1400px; margin-top:5px;">

                <tr>
                    <td>Código:
                        <input readonly type="text" size="5" name="codigoProduto" value="<?php echo $Bcodigo; ?>">
                    </td>

                    <td align=left><input readonly type="hidden" size="10" name="codigoCotacao" value="<?php  ?>"> </td>
                </tr>
            </table>

            <table style="float:left; ">
                <tr>
                    <td><b>Produto:</b></td>
                    <td align=left><input style="margin-left:0px;" type="text" size=62 name="campoDescricao" value="<?php 
                              echo $Bdescicao;     ?>">
                    </td>

                    <td align=left> <b>CFOP:</b></td>
                    <td align=left><select style="width: 450px; margin-right:10px;" id="campoCfop" name="campoCfop">

                            <?php  
                        $meu_cfop = $Bcfop;
                        while($linha_cfop  = mysqli_fetch_assoc($lista_cfop)){
                            $cfop_principal = utf8_encode($linha_cfop["cfop"]);
                            if($meu_cfop==$cfop_principal){
                            ?> <option value="<?php echo utf8_encode($linha_cfop["cfop"]);?>" selected>
                                <?php echo ($linha_cfop["cfop"]), " ",  utf8_encode($linha_cfop["descricao"]);?>
                            </option>

                            <?php
             }else{
    
   ?>
                            <option value="<?php echo utf8_encode($linha_cfop["cfop"]);?>">
                                <?php echo  ($linha_cfop["cfop"]), " ", utf8_encode($linha_cfop["descricao"]);?>
                            </option>
                            <?php

}

}


?>

                        </select>

                    </td>

                </tr>
            </table>

            <table style="float:left; ">
                <tr>
                    <div>
                        <td align=left style="width:70px;"><b>Und:</b></td>
                        <td align=left><input type="text" size=10 name="campoUnd" id="campoUnd" autocomplete="off"
                                value="<?php echo $Bund; ?>">
                        </td>
                        <td align=left><b>NCM:</b></td>
                        <td align=left><input type="text" size=10 name="campoNcm" id="campoNcm" autocomplete="off"
                                value="<?php echo $Bncm; ?>">
                        </td>

                        <td align=left><b>Qtd:</b></td>
                        <td align=left><input type="text" size=10 name="campoQuantidade" id="campoQuantidade"
                                autocomplete="off" value="<?php echo $Bquantidade;?>">
                        </td>

                        <td align=left><b>Vlr Unitario</b></td>
                        <td align=left><input type="text" size=10 name="campoValorUnitario" id="campoValorUnitario"
                                autocomplete="off" value="<?php echo $Bvalor_unitario;
                                ?>">
                        </td>
                        <td align=left><b>Vlr Unitario</b></td>
                        <td align=left><input type="text" size=10 name="campoValorProduto" id="campoValorProduto"
                                autocomplete="off" value="<?php echo $Bvalor_produto;
                                ?>">
                        </td>

                    </div>
                </tr>

            </table>
            <table style="float:left; width:1400px; " id="divisaoTabela">
                <td>
                    <div id="DivisaoNota">
                        <p>Imposto</p>
                    </div>
                </td>
            </table>


            <table style="float:left; ">
                <tr>
                    <div>
                        <td align=left style="width:70px;"><b>Bc icms:</b></td>
                        <td align=left><input type="text" size=10 name="campoBcIcms" id="campoBcIcms" autocomplete="off"
                                value="<?php echo $Bbc_icms; ?>">
                        </td>
                        <td align=left><b>Vlr Icms:</b></td>
                        <td align=left><input type="text" size=10 name="campoValorIcms" id="campoVlrIcms"
                                autocomplete="off" value="<?php echo $Bvalor_icms;?>">
                        </td>

                        <td align=left><b>Vlr Ipi</b></td>
                        <td align=left><input type="text" size=10 name="campoValorIpi" id="campoValorIpi"
                                autocomplete="off" value="<?php echo $Bvalor_ipi;
                                ?>">
                        </td>
                        <td align=left><b>Icms %</b></td>
                        <td align=left><input type="text" size=10 name="campoIcms" id="campoIcms" autocomplete="off"
                                value="<?php echo $Bicms;
                                ?>">
                        </td>
                        <td align=left><b>Ipi %</b></td>
                        <td align=left><input type="text" size=10 name="campoIpi" id="campoIpi" autocomplete="off"
                                value="<?php echo $Bipi;
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