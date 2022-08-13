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
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");

include ("../_incluir/funcoes.php");


//variaveis texto obrigatorio e sucesso!

$msgcadastrado = "Lançamento realizado com sucesso";

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


//consultar status do pedido
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

$select = "SELECT MAX(lancamentoFinanceiroID) as ultimoID FROM lancamento_financeiro;";
$lista_Max_ID = mysqli_query($conecta,$select);
if(!$lista_Max_ID){
    die("Falaha no banco de dados || select statuscompra");
}else{
    $idMax = mysqli_fetch_assoc($lista_Max_ID);
    $ultimoID = $idMax['ultimoID'];

}



echo ",";
//iniciar a tela com o campo preenchido

//variaveis 
if(isset($_POST["enviar"])){
    $hoje = date('Y-m-d'); 
   $lancamentoID = utf8_decode($_POST["cammpoLancamentoID"]);
   $dataLancamento = utf8_decode($_POST["campoDataLancamento"]);
   $dataapagar = utf8_decode($_POST["campoDataPagar"]);
   $dataPagamento = utf8_decode($_POST["campoDataPagamento"]);
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
  

//formatar a data para o banco de dados(Y-m-d)
  if(isset($_POST['enviar']))
{

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
  
  }elseif($formaPagamento=="0"){
        
      ?>

<script>
alertify.alert("Favor informe a forma de pagamento");
</script>
<?php
  
  }else{


      

//condição obrigatorio 
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



        if($dataapagar==""){
          $dataapagar=$dataLancamento;
      }
//inserindo as informações no banco de dados

  $inserir = "INSERT INTO lancamento_financeiro ";
  $inserir .= "( data_movimento,data_a_pagar,data_do_pagamento,receita_despesa,status,forma_pagamentoID,clienteID,descricao,documento,grupoID,valor,observacao,numeroPedido,numeroNotaFiscal )";
  $inserir .= " VALUES ";
  $inserir .= "( '$dataLancamento','$dataapagar','$dataPagamento','Receita','$statusLancamento','$formaPagamento','$cliente','$descricao','$documento','$grupoLancamento','$valor','$observacao','$nPedido','$nNotaFiscal' )";

  //limpando os campos apos inserir no banco de dados
  


  //verificando se está havendo conexão com o banco de dados
  $operacao_inserir = mysqli_query($conecta, $inserir);
  if(!$operacao_inserir){
    print_r($_POST);
      die("Erro no banco de dados inserir_no_banco_de_dados");
   
  }else{
     

  $dataLancamento = "";
  $dataapagar ="";
  $dataPagamento = "";
  $formaPagamento = "";
  $cliente = 1;
  $formaPagamento = 1;
  $statusLancamento=1;
  $grupoLancamento=1;
  $descricao = "";
  $documento ="";
  $valor = "";
  $observacao = "";
  $nPedido = "";
  $nNotaFiscal = "";
         //vai retornar o ultimo id
     
  ?>
<script>
alertify.success("Lançamento <?php echo ($ultimoID + 1)?> Realizado com sucesso");
</script>
<?php
    
  }


}
}
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
            </p>Lançamento de Receita</p>
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
                                        name="cammpoLancamentoID" value="">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="txtNumeroOrcamento" style="width: 100px;"> <b>Data Lnct</b></label>
                                    <input type="text" size=10 name="campoDataLancamento" id="campoDataLancamento"
                                        OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off" value="<?php
                    
                            
                            if(isset($_POST['enviar'])){ 
                             
                                if($dataLancamento){
                              
                                    echo  $dataLancamento;
                                }else{
                                        echo "";
                                    
                                }}
                                  
                           ?>">
                                    <label for="txtUnidade" style="width:140px;"> <b>Data Vencimento:</b></label>
                                    <input type="text" size=10 id="campoDataPagar" name="campoDataPagar"
                                        OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off" value="<?php if(isset($_POST['enviar'])){ 
                                
                                if($dataapagar){
                              
                                    echo ($dataapagar);
                                }else{
                                        echo "";
                                    
                                }}
                            ?>">

                                    <label for="txtNumeroOrcamento" style="width: 140px;"> <b>Data
                                            Pagamento:</b></label>
                                    <input type="text" size=10 id="campoDataPagamento" name="campoDataPagamento"
                                        OnKeyUp="mascaraData(this);" maxlength="10" value="<?php if(isset($_POST['enviar'])){ 
                                
                                if($dataPagamento){
                              
                                    echo ($dataPagamento);
                                }else{
                                        echo "";
                                    
                                }}

                               ?>">


                                </td>

                            </tr>
                        </table>
                        <table style="float:left; width:650px; margin-bottom:30px; ">
                            <tr>
                                <td>
                                    <label for="campoCliente" style="width: 100px;"> <b>Empresa:</b></label>
                                    <select id="campoCliente" name="campoCliente">
                                        <option value="0">Selecione</option><?php 

                            while($linha_clientes = mysqli_fetch_assoc($lista_clientes)){
                            $formaClientePrincipal = utf8_encode($linha_clientes["clienteID"]);
                            if(!isset($cliente)){
                            
                            ?>
                                        <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>">
                                            <?php echo utf8_encode($linha_clientes["nome_fantasia"]);?>
                                        </option>
                                        <?php
                            

                            }else{
                            if($cliente ==$formaClientePrincipal){
                             ?> <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>" selected>
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

                                                        
                                }


                                ?>


                                    </select>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="campoDescricao" style="width:100px;"> <b>Descrição:</b></label>
                                    <input type="text" size=56 name="campoDescricao" id="campoDescricao"
                                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($descricao );}?>">
                            </tr>
                            <tr>
                                <td>
                                    <label for="CampoGrupoLancamento" style="width:100px;"> <b>SubGrupo:</b></label>
                                    <select style="margin-left:0px; width:300px" id="CampoGrupoLancamento"
                                        name="CampoGrupoLancamento">
                                        <option value="0">Selecione</option>
                                        <?php 
                           
                           while($linha_grupoLancamento  = mysqli_fetch_assoc($lista_grupoLancamento)){
                            $GrupoLancamentoPrincipal = utf8_encode($linha_grupoLancamento["subGrupoID"]);
                           if(!isset($grupoLancamento)){
                           
                           ?>
                                        <option value="<?php echo utf8_encode($linha_grupoLancamento["subGrupoID"]);?>">
                                            <?php echo utf8_encode($linha_grupoLancamento["subgrupo"] ." - ". $linha_grupoLancamento['grupo']);?>
                                        </option>
                                        <?php
                           

                           }else{

                            if($grupoLancamento==$GrupoLancamentoPrincipal){
                            ?> <option value="<?php echo utf8_encode($linha_grupoLancamento["subGrupoID"]);?>"
                                            selected>
                                            <?php echo utf8_encode($linha_grupoLancamento["subgrupo"] ." - ".   $linha_grupoLancamento['grupo']);?>
                                        </option>

                                        <?php
                                     }else{
                            
                           ?>
                                        <option value="<?php echo utf8_encode($linha_grupoLancamento["subGrupoID"]);?>">
                                            <?php echo utf8_encode($linha_grupoLancamento["subgrupo"] ." - ". $linha_grupoLancamento['grupo']);?>
                                        </option>
                                        <?php

                                        }
                                        
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
                                        onkeypress="return onlynumber();"
                                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($valor);}?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="observacao" style="width: 100px;"> <b>Observação:</b></label>
                                    <textarea rows=4 cols=60 name="observacao"
                                        id="observacao"><?php if(isset($_POST['enviar'])){ echo utf8_encode($observacao);}?></textarea>
                                </td>
                            </tr>


                        </table>


                        <table style="float:right; width:730px; margin-bottom:30px;">
                            <tr>
                                <td>
                                    <label for="campoFormaPagamento" style="width:180px;"> <b>Forma do
                                            pagamento:</b></label>
                                    <select style="width: 212px; margin-right:27px" id="campoFormaPagamento"
                                        name="campoFormaPagamento">
                                        <option value="0">Selecione</option>
                                        <?php 

                             while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                             $formaPagmaentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);
                            if(!isset($formaPagamento)){
                            
                            ?>
                                        <option
                                            value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                            <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                        </option>
                                        <?php
                            

                            }else{

                             if($formaPagamento==$formaPagmaentoPrincipal){
                             ?> <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>"
                                            selected>
                                            <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                        </option>

                                        <?php
                                      }else{
                             
                            ?>
                                        <option
                                            value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                            <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                        </option>
                                        <?php

                                            }
                                            
                                        }

                                                            
                                    }
                                                            
                                         ?>

                                    </select>
                                    <label for="campoStatusLancamento" style="width:80px;"> <b>Status:</b></label>
                                    <select style="width:170px" id="campoStatusLancamento" name="campoStatusLancamento">
                                        <option value="0">Selecione</option>
                                        <?php 
                            while($linha_statusLacamento  = mysqli_fetch_assoc($lista_statusLancamento)){
                                $statusPrincipal = utf8_encode($linha_statusLacamento["nome"]);
                               if(!isset($statusLancamento)){
                               
                               ?>
                                        <option value="<?php echo utf8_encode($linha_statusLacamento["nome"]);?>">
                                            <?php echo utf8_encode($linha_statusLacamento["nome"]);?>
                                        </option>
                                        <?php
                               
   
                               }else{
   
                                if($statusLancamento==$statusPrincipal){
                                ?> <option value="<?php echo utf8_encode($linha_statusLacamento["nome"]);?>" selected>
                                            <?php echo utf8_encode($linha_statusLacamento["nome"]);?>
                                        </option>

                                        <?php
                                         }else{
                                
                               ?>
                                        <option value="<?php echo utf8_encode($linha_statusLacamento["nome"]);?>">
                                            <?php echo utf8_encode($linha_statusLacamento["nome"]);?>
                                        </option>
                                        <?php
   
                                        }
                                        
                                    }
                                
                                                            
                                }
                                                        
                                                        ?>

                                </td>
                            </tr>

                            <tr>
                                <td><label for="campoDocumento" style="width:180px;"> <b>N°
                                            Documento:</b></label>
                                    <input type="text" style="margin-right:40px" size=20 name="campoDocumento"
                                        id="campoDocumento"
                                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($documento);}?>">
                                    <label for="numeroNotaFiscal" style="width:80px;"> <b>N°
                                            NFE:</b></label>
                                    <input type="text" size=12 name="numeroNotaFiscal" id="numeroNotaFiscal"
                                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($nNotaFiscal);}?>">


                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <label for="numeroPedido" style="width:180px;"> <b>N°
                                            Pedido:</b></label>
                                    <input type="text" size=20 name="numeroPedido" id="numeroPedido"
                                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($nPedido);}?>">
                                </td>

                                </td>

                            </tr>
                        </table>
                        <table style="float:left; width:800px;">
                            <tr>

                                <td>
                                    <div style="margin-left:100px;">

                                        <input type="submit" style="height:37px" name=enviar value="Incluir"
                                            class="btn btn-info btn-sm"></input>
                                        <button type="button" name="btnfechar"
                                            onclick="window.opener.location.reload();fechar();"
                                            class="btn btn-secondary">Voltar</button>
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
/*
function fechar() {
    window.close();
}
*/
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