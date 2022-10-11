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




$consulta = "SELECT * from tb_nfe_entrada ";
if(isset($_GET["codigo"])){
    $nFE =  $_GET["codigo"];
$consulta .= " WHERE numero_nf = {$nFE}";  
}
$dados_nfeE= mysqli_query($conecta, $consulta);
if(!$dados_nfeE){
die("Falaha no banco de dados");
}else{
    $linha = mysqli_fetch_assoc($dados_nfeE);
    $dataEntrada = $linha['data_entrada'];
    $chaveAcesso = $linha['chave_acesso'];
    $numero_nf = $linha['numero_nf'];
    $protAutorizacao = $linha['prot_autorizacao'];
    $serie = $linha['serie'];
    $dataEmisao= $linha['data_emissao'];
    $dataSaida = $linha['data_saida'];
    $razaoSocial = $linha['razao_social'];
    $cnpj = $linha['cnpj_cpf'];
    $inscricao_estadual = $linha['inscricao_estadual'];
    $bcIcms = $linha['bc_icms'];
    $bcIcmsSt = $linha['bc_icms_st'];
    $valorFrete = $linha['valor_frete'];
    $valorIcmsSt = $linha['valor_icms_st'];
    $valorIcms = $linha['valor_icms'];
    $valorSeguro = $linha['valor_seguro'];
    $desconto = $linha['valor_desconto'];
    $valorTotalIpi = $linha['valor_total_ipi'];
    $valorTotalProdutos = $linha['valor_total_produtos'];
    $valorTotalNota = $linha['valor_total_nota'];
    

}

if(isset($_GET['codigo'])){

$consulta = "SELECT * from tb_nfe_entrada_item where numero_nf = '$numero_nf' ";
$dados_prod_nfe= mysqli_query($conecta, $consulta);
if(!$dados_prod_nfe){
die("Falha no banco de dados");
}
}

if(isset($_POST['btnremover'])){
   //query para remover o cliente no banco de dados
   $remover = "DELETE FROM tb_nfe_entrada WHERE numero_nf = '$numero_nf' ";

     $operacao_remover = mysqli_query($conecta, $remover);
     if(!$operacao_remover) {
         die("Erro na tabela || tb_nfe_entrada");   
     } else {
        ?>
<script>
alertify.error("Nota fiscal Removida com sucesso");
</script>
<?php
         //header("location:listagem.php"); 
          
     }
     $remover = "DELETE FROM tb_nfe_entrada_item WHERE numero_nf = '$numero_nf' ";

     $operacao_remover = mysqli_query($conecta, $remover);
     if(!$operacao_remover) {
         die("Erro na tabela || tb_nfe_entrada_item");   
     }
   
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




        <div style="margin:0 auto; width:1500px; ">


            <table style="float: right; ">
                <div id="titulo">
                    </p>Dados NFE entrada</p>
                </div>

                <tr>

                    <form action="" method="post">
                        <td><input id="remover" type="submit" name="btnremover" value="Remover" class="btn btn-danger"
                                onClick="return confirm('Deseja remover esse lembrete?');"></input></td>
                        <td align=left> <button type="button" name="btnfechar" onclick="fechar();"
                                class="btn btn-secondary">Voltar</button>
                        </td>



                </tr>

            </table>


            <table style="float:left;">



                <tr>
                    <td style="width: 140px;"><b>Chave acesso:</b></td>
                    <td align=left><input readonly type="text" size="50" name="campoChaveAcesso" value="<?php echo $chaveAcesso;
        
         ?>"> </td>
                    <td align=left><b>Data Entrada:</b></td>
                    <td align=left><input type="text" name="campoDataEntrada" size="10" value="<?php   if($dataEntrada=="1970-01-01"){
                                print_r("");
                            }elseif($dataEntrada=="0000-00-00"){
                                print_r ("");
                            }
                            elseif($dataEntrada==""){
                                print_r ("");
                            }else{
                                echo formatardataB($dataEntrada);}?>" autocomplete="off"></td>



                </tr>
                <!--finalizar hidden -->
            </table>
            <table style="float:left;">
                <tr>

                    <td align=left style="width: 140px;"> <b>Prot.Autorização:</b></td>
                    <td align=left> <input type="text" name="campoProtAutorizacao" size="10" value="<?php  echo $protAutorizacao;
    ?>"> </td>

                    <td align=left> <b>Nº nota:</b></td>
                    <td align=left> <input type="text" name="campoNnota" size="10" autocomplete="of"
                            value="<?php echo $nFE?>"> </td>

                    <td align=left> <b>Serie:</b></td>
                    <td align=left> <input type="text" name="campoSerie" size="10" autocomplete="of"
                            value="<?php echo $serie?>"> </td>

                    <td align=left><b>Data Emissao:</b></td>
                    <td align=left><input type="text" name="campoDataEmissao" size="10" value="<?php   if($dataEmisao=="1970-01-01"){
                                print_r("");
                            }elseif($dataEmisao=="0000-00-00"){
                                print_r ("");
                            }
                            elseif($dataEmisao==""){
                                print_r ("");
                            }else{
                                echo formatardataB($dataEmisao);}?>" autocomplete="off"></td>

                    <td align=left><b>Data Saida:</b></td>
                    <td align=left><input type="text" name="campoDataSaida" size="10" value="<?php   if($dataSaida=="1970-01-01"){
                                print_r("");
                            }elseif($dataSaida=="0000-00-00"){
                                print_r ("");
                            }
                            elseif($dataSaida==""){
                                print_r ("");
                            }else{
                                echo formatardataB($dataSaida);}?>" autocomplete="off"></td>



                </tr>

            </table>


            <table style="float:left; width:1500px; " id="divisaoTabela">
                <td>
                    <div id="DivisaoNota">
                        <p>Fornecedor</p>
                    </div>
                </td>

            </table>
            <table style="float:left;  ">
                <tr>

                    <td align=left style="width: 140px;"> <b>Razão Social: </b></td>
                    <td align=left> <input type="text" name="campoEmpresa" size="50" value="<?php  echo $razaoSocial;
    ?>"> </td>
                    <td align=left> <b>CNPJ:</b></td>
                    <td align=left> <input type="text" name="campoCnpj" size="30" value="<?php  echo formatCnpjCpf($cnpj);
    ?>"> </td>
                    <td align=left> <b>Inscrição Estadual:</b></td>
                    <td align=left> <input type="text" name="campoCnpj" size="30" value="<?php  echo formatInscricaoEstadual($inscricao_estadual);
    ?>"> </td>
                </tr>
            </table>
            <table style="float:left; width:1500px; " id="divisaoTabela">
                <td>
                    <div id="DivisaoNota">
                        <p>Totais</p>
                    </div>
                </td>
            </table>
            <table style="float:left;  ">
                <tr>

                    <td align=left style="width: 140px;"> <b>Bc do icms: </b></td>
                    <td align=left> <input type="text" name="campoBcIcms" size="10" value="<?php  echo total_format($bcIcms);
    ?>"> </td>
                    <td align=left> <b>Valor do Icms:</b></td>
                    <td align=left> <input type="text" name="campoValorIcms" size="10" value="<?php  echo total_format($valorIcms);
    ?>"> </td>
                    <td align=left> <b>Bc icms st:</b></td>
                    <td align=left> <input type="text" name="campoBcIcmsSt" size="10" value="<?php  echo total_format($bcIcmsSt);
    ?>"> </td>
                    <td align=left> <b>Valor icms st:</b></td>
                    <td align=left> <input type="text" name="campoValorIcmsSt" size="10" value="<?php  echo total_format($valorIcmsSt);
    ?>"> </td>

                    <td align=left> <b>Valor Total Produto:</b></td>
                    <td align=left> <input type="text" name="campoValorTotalProduto" size="20" value="<?php  echo real_format($valorTotalProdutos);
    ?>"> </td>

                </tr>
            </table>
            <table style="float:left;  ">
                <tr>

                    <td align=left style="width: 140px;"> <b>Valor Frete: </b></td>
                    <td align=left> <input type="text" name="campoValorFrete" size="10" value="<?php  echo total_format($valorFrete);
    ?>"> </td>
                    <td align=left> <b>Valor Seguro:</b></td>
                    <td align=left> <input type="text" name="campoValorSeguro" size="10" value="<?php  echo total_format($valorSeguro);
    ?>"> </td>
                    <td align=left> <b>Desconto:</b></td>
                    <td align=left> <input type="text" name="campoDesconto" size="10" value="<?php  echo total_format($desconto);
    ?>"> </td>
                    <td align=left> <b>Valor Total Ipi:</b></td>
                    <td align=left> <input type="text" name="campoValorTotalIpi" size="10" value="<?php  echo total_format($valorTotalIpi);
    ?>"> </td>

                    <td align=left> <b>Valor Total Nota:</b></td>
                    <td align=left> <input type="text" name="campoValorTotalNota" size="20" value="<?php  echo real_format($valorTotalNota);
    ?>"> </td>

                </tr>
            </table>
            </form>

            <table style="float:left; width:1500px; " id="divisaoTabela">
                <td>
                    <div id="DivisaoNota">
                        <p>Itens</p>
                    </div>
                </td>
            </table>

            <form action="consulta_produto.php" method="post">

                <table border="0" cellspacing="0" width="1500px;" style="margin-top: 100px;" class="tabela_pesquisa">
                    <tbody>
                        <tr id="cabecalho_pesquisa_consulta">
                            <td>
                                <p style="margin-left:10px;">Item</p>
                            </td>

                            <td>
                                <p>Código</p>
                            </td>
                            <td>
                                <p>Descrição</p>
                            </td>
                            <td>
                                <p>Ncm</p>
                            </td>
                            <td>
                                <p>CFOP</p>
                            </td>
                            <td>
                                <p>Qtd</p>
                            </td>
                            <td>
                                <p>Vl unitário</p>
                            </td>
                            <td>
                                <p>Vl total</p>
                            </td>
                            <td>
                                <p>Bc Icms</p>
                            </td>
                            <td>
                                <p>Vl icms</p>
                            </td>

                            <td>
                                <p>Vl Ipi</p>
                            </td>
                            <td>
                                <p>%ICMS</p>
                            </td>
                            <td>
                                <p>%IPI</p>
                            </td>

                            <td>
                                <p></p>
                            </td>

                        </tr>

                        <?php




$linhas = 0;
while($linha = mysqli_fetch_assoc($dados_prod_nfe)){
    $codigo = $linha['codigo'];
    $descricao = $linha['descricao'];
    $ncm = $linha['ncm'];
    $cfop = $linha['cfop'];
    $undidade = $linha['und'];
    $quantidade = $linha['quantidade'];
    $valorUnitario = $linha['valor_unitario'];
    $valorProduto = $linha['valor_produto'];
    $baseCalculo = $linha['bc_icms'];
    $valorIcms = $linha['valor_icms'];
    $valorIpi = $linha['valor_ipi'];
    $icms = $linha['icms'];
    $ipi = $linha['ipi'];

   
?>
                        <tr id="linha_pesquisa">

                            <td style="width: 70px; ">
                                <p style="margin-left: 15px; margin-top:10px;">
                                    <font size="3"><?php echo $linhas = $linhas +1;?></font>
                                </p>
                            </td>

                            <td style="width: 80px;">

                                <font size="2"><?php echo utf8_encode($codigo);?> </font>

                            </td>

                            <td style="width: 450px;">

                                <font size="2"><?php echo utf8_encode($descricao);?> </font>

                            </td>

                            <td style="width: 80px;">
                                <font size="2"><?php echo ($ncm);?> </font>
                            </td>

                            <td style="width: 80px;">
                                <font size="2"><?php echo ($cfop);?> </font>
                            </td>

                            <td style="width: 80px;">
                                <font size="2"><?php echo total_format($quantidade)?> </font>
                            </td>

                            <td style="width: 110px;">
                                <font size="2"><?php echo real_format($valorUnitario);?> </font>
                            </td>


                            <td style="width: 110px;">
                                <font size="2"><?php echo real_format($valorProduto)?> </font>
                            </td>
                            <td style="width: 80px;">
                                <font size="2"><?php echo  total_format($baseCalculo);?> </font>
                            </td>
                            <td style="width: 80px;">
                                <font size="2"><?php echo  total_format($valorIcms);?> </font>
                            </td>
                            <td style="width: 80px;">
                                <font size="2"><?php echo  total_format($valorIpi);?> </font>
                            </td>
                            <td style="width: 80px;">
                                <font size="2"><?php echo  total_format($icms);?> </font>
                            </td>
                            <td style="width: 80px;">
                                <font size="2"><?php echo  total_format($ipi);?> </font>
                            </td>



                        </tr>



                        <?php
            
    }

?>

                    </tbody>
                </table>
            </form>
        </div>

    </main>
</body>

<?php include '../_incluir/funcaojavascript.jar'; ?>

<script>
function fechar() {
    window.close();
}
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>