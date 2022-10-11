<?php

include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include ("../_incluir/funcoes.php");
//inportar o alertar js
include('../alert/alert.php');


echo ",";


$hoje = date('d/m/Y');
//consultar forma de pagamento
$select = "SELECT formapagamentoID, nome, statuspagamento from forma_pagamento";
$lista_formapagamemto = mysqli_query($conecta,$select);
if(!$lista_formapagamemto){
    die("Falaha no banco de dados || select formapagma");
}


//consultar cliente
$select = "SELECT clienteID, razaosocial,nome_fantasia from clientes order by nome_fantasia ";
$lista_clientes = mysqli_query($conecta,$select);
if(!$lista_clientes){
    die("Falaha no banco de dados || select clientes");
}

//consultar lancamento
$select = "SELECT receita_despesaID, nome from receita_despesa";
$lista_receita_despesa = mysqli_query($conecta,$select);
if(!$lista_receita_despesa){
    die("Falaha no banco de dados ||   falha de conexão de red || select clientes");
}


//consultar status do lancamento
//consultar status do lancamento
$select = "SELECT status_lancamentoID, nome, lancamento from status_lancamento where lancamento = 'Receita' or lancamento = 'Cancelado' or lancamento = 'Selecione' ";
$lista_statusLancamento = mysqli_query($conecta,$select);
if(!$lista_statusLancamento){
    die("Falaha no banco de dados
    || falha de conexão de red
    select status Lancamento");
}

//consultar grupo Lançamento
$select = "SELECT subGrupoID, subgrupo,nome as grupo,lancamento from tb_subgrupo_receita_despesa inner join grupo_lancamento on grupo_lancamento.grupo_lancamentoID = tb_subgrupo_receita_despesa.grupo where lancamento = 'Receita' or grupo = 1";
$lista_grupoLancamento = mysqli_query($conecta,$select);
if(!$lista_grupoLancamento){
    die("Falaha no banco de dados
    || falha de conexão de red
    select tb_subgrupo_receita_despesa");
}

//consultar status da compra
$select = "SELECT statuscompraID, nome from status_compra";
$lista_statuscompra = mysqli_query($conecta,$select);
if(!$lista_statuscompra){
    die("Falaha no banco de dados || select statuscompra");
}

//iniciar a tela com o campo preenchido

    
if($_POST){


    $lancamentoID = utf8_decode($_POST["cammpoLancamentoID"]);
    $dataLancamento = utf8_decode($_POST["campoDataLancamento"]);
    $dataapagar = utf8_decode($_POST["campoDataPagar"]);
    $dataPagamento = utf8_decode($_POST["campoDataPagamento"]);
    $dataLancamentoPost = utf8_decode($_POST["campoDataLancamento"]);
    $dataapagarPost = utf8_decode($_POST["campoDataPagar"]);
    $dataPagamentoPost = utf8_decode($_POST["campoDataPagamento"]);
    $cliente = utf8_decode($_POST["campoCliente"]);
    $formaPagamento = utf8_decode($_POST["campoFormaPagamento"]);
    $statusLancamento = utf8_decode($_POST["campoStatusLancamento"]);
    $descricao = utf8_decode($_POST["campoDescricao"]);
    $documento = utf8_decode($_POST["campoDocumento"]);
    $grupoLancamento = utf8_decode($_POST["CampoGrupoLancamento"]);
    $valor = utf8_decode($_POST["campoValor"]); 
    $observacao = utf8_decode($_POST["observacao"]);
    $nPedido = utf8_decode($_POST["numeroPedido"]);
    $nNotaFiscal = utf8_decode($_POST["numeroNotaFiscal"]);

    if(isset($_POST["btnsalvar"])){
//condição obrigatorio 

if($dataLancamento==""){
    
    ?>
<script>
alertify.alert("Favor informe a data de lançamento");
</script>

<?php
}elseif($cliente=="0"){
    ?>

<script>
alertify.alert("Favor informe o cliente");
</script>

<?php

}elseif($formaPagamento=="0"){
    ?>

<script>
alertify.alert("Favor informe a forma de pagamento");
</script>

<?php

}elseif($statusLancamento=="0"){
    
    ?>

<script>
alertify.alert("Favor informe o status do lançamento");
</script>
<?php

}elseif($grupoLancamento=="0"){
    
  ?>

<script>
alertify.alert("Favor informe o subGrupo");
</script>
<?php

}elseif(($statusLancamento == "Recebido") && ($dataPagamento == "")){
    ?>

<script>
alertify.alert("Favor informe a data do pagamento");
</script>
<?php
}else{

    
    if(!$dataLancamento == ""){

        if($dataLancamento==""){
          
        }else{
            $div1 = explode("/",$_POST['campoDataLancamento']);
            $dataLancamento = $div1[2]."-".$div1[1]."-".$div1[0];  
           
        }
        if($dataapagar==""){
           
        }else{
            $div2 = explode("/",$_POST['campoDataPagar']);
        $dataapagar = $div2[2]."-".$div2[1]."-".$div2[0];
        }


        if($dataPagamento==""){
        
        }else{
            
        $div3 = explode("/",$_POST['campoDataPagamento']);
        $dataPagamento = $div3[2]."-".$div3[1]."-".$div3[0];
        }
        
        
       
       

    //alterando as informações no banco de dados
  
    //query para alterar o pedido de compra no banco de dados
    $alterar = "UPDATE lancamento_financeiro set data_movimento = '{$dataLancamento}', data_a_pagar = '{$dataapagar}', data_do_pagamento = '{$dataPagamento}',  status = '{$statusLancamento}', ";
    $alterar .= " forma_pagamentoID = '{$formaPagamento}', clienteID = '{$cliente}', descricao = '{$descricao}', documento = '{$documento}', grupoID = '{$grupoLancamento}', valor = '{$valor}',  observacao  = '{$observacao}', numeroPedido = '{$nPedido}',numeroNotaFiscal = '{$nNotaFiscal}' WHERE lancamentoFinanceiroID = {$lancamentoID} ";

      $operacao_alterar = mysqli_query($conecta, $alterar);
      if(!$operacao_alterar) {
          die("Erro na alteracao linha29");   
      } else {  
  
    ?>
<script>
alertify.success("Dados alterados");
</script>
<?php
          //header("location:listagem.php"); 
           
      }
    }

}
}

}



//variaveis texto obrigatorio e sucesso!



$consulta = "SELECT * FROM lancamento_financeiro ";
if (isset($_GET["codigo"])){
$lancamentoID=$_GET["codigo"];
$consulta .= " WHERE lancamentoFinanceiroID = {$lancamentoID} ";
}else{
$consulta .= " WHERE lancamentoFinanceiroID = 1 ";

}
//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
die("Falha na consulta ao banco de dados");
}else{

$dados_detalhe = mysqli_fetch_assoc($detalhe);
$BpedidoID = utf8_encode($dados_detalhe['lancamentoFinanceiroID']);
$BdataMovimento = utf8_encode($dados_detalhe["data_movimento"]);
$BdataaPagar = utf8_encode($dados_detalhe["data_a_pagar"]);
$BdataPagamento = utf8_encode($dados_detalhe["data_do_pagamento"]);
$BreceitaDespesa = utf8_encode($dados_detalhe["receita_despesa"]);
$Bstatus = utf8_encode($dados_detalhe["status"]);
$BformaPagamentoID = utf8_encode($dados_detalhe["forma_pagamentoID"]);
$BclienteID = utf8_encode($dados_detalhe["clienteID"]);
$Bdescrisao = utf8_encode($dados_detalhe["descricao"]);
$Bdocumento = utf8_encode($dados_detalhe["documento"]);
$BgrupoID = $dados_detalhe["grupoID"];
$Bvalor = utf8_encode($dados_detalhe["valor"]);
$Bobservacao = utf8_encode($dados_detalhe["observacao"]);
$BnPedido = utf8_encode($dados_detalhe["numeroPedido"]);
$BnNotaFiscal = utf8_encode($dados_detalhe["numeroNotaFiscal"]);


}


if(isset($_POST['btnremover'])){
  

    //query para remover o produto no banco de dados
    $remover = "DELETE FROM lancamento_financeiro WHERE lancamentoFinanceiroID = {$lancamentoID}";

      $operacao_remover = mysqli_query($conecta, $remover);
    
      if(!$operacao_remover) {
          die("Erro linha 44");   
      } else {
      echo ',';
?>

<script>
alertify.error('Lancamento removido com sucesso');
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

    <link rel="shortcut icon" type="imagex/png" href="img/marvolt.ico">
    <?php 
    include("../classes/select2/select2_link.php")
    ?>
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <form action="" autocomplete="off" method="post">
        <div id="titulo">
            </p>Dados da Receita</p>
        </div>

        <main>
            <div style="margin:0 auto; width:1400px; ">
                <form action="" method="post">
                    <table style="float:left; width:1400px; margin-bottom: 10px; border:1px solid;">



                        <table style="float:left; width:1400px; margin-bottom: 10px;border-bottom:1px solid #ddd; ; ">


                            <tr>
                                <td>
                                    <label for="cammpoLancamentoID" style="width: 100px;"> <b>Código:</b></label>
                                    <input readonly type="text" size="10" id="cammpoLancamentoID"
                                        name="cammpoLancamentoID" value="<?php echo $BpedidoID?>">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="txtNumeroOrcamento" style="width: 100px;"> <b>Data Lnct</b></label>
                                    <input type="text" size=10 name="campoDataLancamento" id="campoDataLancamento"
                                        OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off" value="<?php
                    
                            if($_POST){
                            echo $dataLancamentoPost;
                            }else{
                       
                    if($BdataMovimento=="1970-01-01"){
                        print_r("");
                    }elseif($BdataMovimento=="0000-00-00"){
                        print_r ("");
                    }else{
                        echo formatardataB($BdataMovimento);
                    }}?>">
                                    <label for="txtUnidade" style="width:140px;"> <b>Data
                                            Vencimento:</b></label>
                                    <input type="text" size=10 id="campoDataPagar" name="campoDataPagar"
                                        OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off" value="<?php 
                                    if($_POST){
                                        echo $dataapagarPost;
                                    }else{
                                    if($BdataaPagar=="1970-01-01"){
                                        print_r("");
                                    }elseif($BdataaPagar=="0000-00-00"){
                                        print_r ("");
                                    }else{
                                        echo formatardataB($BdataaPagar);}}
                            ?>">

                                    <label for="campoDataPagamento" style="width: 140px;"> <b>Data
                                            Pagamento:</b></label>
                                    <input type="text" size=10 id="campoDataPagamento" name="campoDataPagamento"
                                        OnKeyUp="mascaraData(this);" maxlength="10" value="<?php
                                    if($_POST){
                                        echo $dataPagamentoPost;
                                    }else{
                                 if($BdataPagamento=="1970-01-01"){
                                    print_r("");
                                }elseif($BdataPagamento=="0000-00-00"){
                                    print_r ("");
                                }else{
                                    echo formatardataB($BdataPagamento);}}
                                ?>">

                                </td>

                            </tr>
                        </table>
                        <table style="float:left; width:650px; margin-bottom:30px; ">
                            <tr>
                                <td>
                                    <label for="campoCliente" style="width: 100px;"> <b>Empresa:</b></label>
                                    <select id="campoCliente" name="campoCliente">
                                        <option value="0">Selecione</option>

                                        <?php

                                        $meuCliente =  $BclienteID;
                                        while($linha_clientes = mysqli_fetch_assoc($lista_clientes)){
                                        $formaClientePrincipal = utf8_encode($linha_clientes["clienteID"]);

                                        if($meuCliente==$formaClientePrincipal){
                                        ?> <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>"
                                            selected>
                                            <?php echo utf8_encode($linha_clientes["nome_fantasia"]);?>
                                        </option>

                                        <?php
                                        }else{
                                        ?>
                                        <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>">
                                            <?php echo utf8_encode($linha_clientes["nome_fantasia"]);?>
                                        </option>
                                        <?php

                                        }


                                        }

                                        ?>

                                    </select>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="campoDescricao" style="width:100px;"> <b>Descrição:</b></label>
                                    <input type="text" size=56 name="campoDescricao" id="campoDescricao" value="<?php 
                                        if($_POST){
                                            echo utf8_encode($descricao);
                                        }else{
                                        echo $Bdescrisao;}?>">
                            </tr>
                            <tr>
                                <td>
                                    <label for="CampoGrupoLancamento" style="width:100px;"> <b>subGrupo:</b></label>
                                    <select style="margin-left:0px; width:300px" id="CampoGrupoLancamento"
                                        name="CampoGrupoLancamento">
                                        <option value="0">Selecione</option>

                                        <?php
                                $meuGrupo =  $BgrupoID;
                                while($linha_grupoLancamento = mysqli_fetch_assoc($lista_grupoLancamento)){
                                    $meuGrupoPrincipal = utf8_encode($linha_grupoLancamento["subGrupoID"]);

                                    if($meuGrupo==$meuGrupoPrincipal){
                                        ?> <option
                                            value="<?php echo utf8_encode($linha_grupoLancamento["subGrupoID"]);?>"
                                            selected>
                                            <?php echo utf8_encode($linha_grupoLancamento["subgrupo"]." - ". $linha_grupoLancamento['grupo']);?>
                                        </option>

                                        <?php
                                        }else{
                                            ?>
                                        <option value="<?php echo utf8_encode($linha_grupoLancamento["subGrupoID"]);?>">
                                            <?php echo utf8_encode($linha_grupoLancamento["subgrupo"]." - ". $linha_grupoLancamento['grupo']);?>
                                        </option>
                                        <?php

                                        }
                                }
                                ?>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="campoValor" style="width:100px;"> <b>Valor:</b></label>
                                    <input type="text" size=15 name="campoValor" id="campoValor"
                                        onkeypress="return onlynumber();" value="<?php 
                                        if($_POST){
                                                echo  $valor;
                                        }else{
                                        echo $Bvalor;
                                        }?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="observacao" style="width: 100px;"> <b>Observação:</b></label>
                                    <textarea rows=4 cols=60 name="observacao" id="observacao"><?php
                                        if($_POST){
                                            echo $observacao;
                                        }else{  
                                        echo $Bobservacao;
                                        }?></textarea>
                                </td>
                            </tr>


                        </table>


                        <table style="float:right; width:730px; margin-bottom:30px;">
                            <tr>
                                <td>
                                    <label for="campoFormaPagamento" style="width:180px;"> <b>Forma do
                                            pagamento:</b></label>
                                    <select style="width: 210px; margin-right:27px" id="campoFormaPagamento"
                                        name="campoFormaPagamento">
                                        <option value="0">Selecione</option>
                                        <?php 
                            $meuFormaPagamento = $BformaPagamentoID;
                           while($linha_formapagamento = mysqli_fetch_assoc($lista_formapagamemto)){
                               $formaPagamentoPrincipal = utf8_encode($linha_formapagamento['formapagamentoID']);
                               if($meuFormaPagamento==$formaPagamentoPrincipal){
                        ?>
                                        <option value="<?php 
                            echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>" selected>
                                            <?php echo utf8_encode($linha_formapagamento["nome"]); ?>
                                        </option>

                                        <?php 
                               }else{
                               ?>
                                        <option value="<?php 
                            echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                            <?php echo utf8_encode($linha_formapagamento["nome"]);
                                
                                ?>
                                        </option>

                                        <?php   
                            }
                         }
                         
                         ?>
                                    </select>
                                    <label for="campoStatusLancamento" style="width:80px;"> <b>Status:</b></label>
                                    <select style="width:170px" id="campoStatusLancamento" name="campoStatusLancamento">
                                        <option value="0">Selecione</option>
                                        <?php 
                            $meuStatus = $Bstatus;
                           while($linha_statusLamento = mysqli_fetch_assoc($lista_statusLancamento )){
                            $meuStatusPrincipal = utf8_encode($linha_statusLamento["nome"]);
                            if($meuStatus==$meuStatusPrincipal){
                        ?>

                                        <option value="<?php echo utf8_encode($linha_statusLamento["nome"]);?>"
                                            selected>
                                            <?php echo utf8_encode($linha_statusLamento["nome"]);?>
                                        </option>

                                        <?php
                            }else{
                                ?>
                                        <option value="<?php echo utf8_encode($linha_statusLamento["nome"]);?>">
                                            <?php echo utf8_encode($linha_statusLamento["nome"]);?>
                                        </option>

                                        <?php
                            }
                         }
                         
                         ?>

                                    </select>

                                </td>
                            </tr>

                            <tr>
                                <td><label for="campoDocumento" style="width:180px;"> <b>N°
                                            Documento:</b></label>
                                    <input type="text" style="margin-right:40px" size=20 name="campoDocumento"
                                        id="campoDocumento" value="<?php 
                                        if($_POST){
                                            echo $documento;
                                        }else{
                                        echo $Bdocumento;
                                        }?>">
                                    <label for="numeroNotaFiscal" style="width:80px;"> <b>N°
                                            NFE:</b></label>
                                    <input type="text" size=12 name="numeroNotaFiscal" id="numeroNotaFiscal" value="<?php 
                                            if($_POST){
                                                echo $nNotaFiscal;
                                            }else{
                                                echo $BnNotaFiscal;
                                            }
                                      ?>">


                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <label for="numeroPedido" style="width:180px;"> <b>N°
                                            Pedido:</b></label>
                                    <input type="text" size=20 name="numeroPedido" id="numeroPedido" value="<?php 
                                        if($_POST){
                                            echo $nPedido;
                                        }else{
                                            echo $BnPedido;
                                        }
                                       ?>">
                                </td>

                                </td>

                            </tr>
                        </table>
                        <table style="float:left; width:800px;">
                            <tr>

                                <td>
                                    <div style="margin-left:100px;">

                                        <input type="submit" name=btnsalvar value="Alterar"
                                            class="btn btn-info btn-sm"></input>
                                        <button type="button" class="btn btn-secondary"
                                            onclick="window.opener.location.reload();fechar()">Voltar</button>
                                        <input id="remover" type="submit" name="btnremover" value="Remover"
                                            class="btn btn-danger"
                                            onClick="return confirm('Deseja remover esse lançamento?');"></input>

                                    </div>
                                </td>

                            </tr>

                        </table>

                    </table>

                </form>
            </div>
        </main>


</body>

<?php include '../_incluir/funcaojavascript.jar'; ?>

<?php include '../classes/select2/select2_java.php'; ?>
<script>

</script>


<script>
function abrepopupcliente() {

    var janela = "../buscar_cliente/consulta_cliente.php";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}

function fechar() {
    window.close();
}
</script>


</html>

<?php 
mysqli_close($conecta);
?>