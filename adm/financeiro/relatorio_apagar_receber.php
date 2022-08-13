<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");


include ("../_incluir/funcoes.php");

//consultar lancamento
$select = "SELECT receita_despesaID, nome from receita_despesa";
$lista_receita_despesa = mysqli_query($conecta,$select);
if(!$lista_receita_despesa){
    die("Falaha no banco de dados || falha de conexão");
}

$hoje = date('Y--m-d');

//consultar pedido de compra

if(isset($_GET["apagar"]) or (isset($_GET["areceber"]))){

    $pesquisaData = $_GET["CampoPesquisaData"];
    $pesquisaDataf = $_GET["CampoPesquisaDataf"];
   
    if($pesquisaData==""){
          
    }else{
        $div1 = explode("/",$_GET['CampoPesquisaData']);
        $pesquisaData = $div1[2]."-".$div1[1]."-".$div1[0];  
       
    }
    if($pesquisaDataf==""){
       
    }else{
    $div2 = explode("/",$_GET['CampoPesquisaDataf']);
    $pesquisaDataf = $div2[2]."-".$div2[1]."-".$div2[0];
    }

        $select = "SELECT  clientes.nome_fantasia,DATEDIFF(CURRENT_DATE(),lancamento_financeiro.data_a_pagar) as atraso,lancamento_financeiro.data_do_pagamento, forma_pagamento.nome,lancamento_financeiro.descricao,grupo_lancamento.nome  as grupo, lancamento_financeiro.lancamentoFinanceiroID, tb_subgrupo_receita_despesa.subgrupo, tb_subgrupo_receita_despesa.subgrupo, lancamento_financeiro.data_movimento,  lancamento_financeiro.documento,lancamento_financeiro.lancamentoFinanceiroID,  lancamento_financeiro.data_a_pagar, lancamento_financeiro.status,lancamento_financeiro.valor,lancamento_financeiro.documento,  lancamento_financeiro.receita_despesa from  clientes  inner join lancamento_financeiro on lancamento_financeiro.clienteID = clientes.clienteID inner join tb_subgrupo_receita_despesa on lancamento_financeiro.grupoID = tb_subgrupo_receita_despesa.subGrupoID inner join forma_pagamento on lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID inner join grupo_lancamento on  tb_subgrupo_receita_despesa.grupo = grupo_lancamento.grupo_lancamentoID " ;
        $pesquisa = $_GET["CampoPesquisa"];
        if(isset($_GET["apagar"])){
        $select  .= " WHERE data_a_pagar BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%' and lancamento_financeiro.status = 'A Pagar' ";

        }elseif(isset($_GET["areceber"])){
        $select  .= " WHERE data_a_pagar BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%' and  lancamento_financeiro.status = 'A Receber' ";
    
    }elseif(isset($_GET["pagas"])){
        $select  .= " WHERE data_a_pagar BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%' and  lancamento_financeiro.status = 'Pago' ";

    }elseif(isset($_GET["recebidas"])){
        $select  .= " WHERE data_a_pagar BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%' and  lancamento_financeiro.status = 'Recebido' ";

    }
//consultar cliente
    $lista_pesquisa = mysqli_query($conecta,$select);


}



if((isset($_GET["recebidas"])) or (isset($_GET["pagas"]))){

    $pesquisaData = $_GET["CampoPesquisaData"];
    $pesquisaDataf = $_GET["CampoPesquisaDataf"];
   
    if($pesquisaData==""){
          
    }else{
        $div1 = explode("/",$_GET['CampoPesquisaData']);
        $pesquisaData = $div1[2]."-".$div1[1]."-".$div1[0];  
       
    }
    if($pesquisaDataf==""){
       
    }else{
    $div2 = explode("/",$_GET['CampoPesquisaDataf']);
    $pesquisaDataf = $div2[2]."-".$div2[1]."-".$div2[0];
    }

        $select = "SELECT  clientes.nome_fantasia,DATEDIFF(lancamento_financeiro.data_a_pagar,lancamento_financeiro.data_do_pagamento) as atraso, lancamento_financeiro.data_do_pagamento, forma_pagamento.nome,lancamento_financeiro.descricao,grupo_lancamento.nome  as grupo, lancamento_financeiro.lancamentoFinanceiroID, tb_subgrupo_receita_despesa.subgrupo, tb_subgrupo_receita_despesa.subgrupo, lancamento_financeiro.data_movimento,  lancamento_financeiro.documento,lancamento_financeiro.lancamentoFinanceiroID,  lancamento_financeiro.data_a_pagar, lancamento_financeiro.status,lancamento_financeiro.valor,lancamento_financeiro.documento,  lancamento_financeiro.receita_despesa from  clientes  inner join lancamento_financeiro on lancamento_financeiro.clienteID = clientes.clienteID inner join tb_subgrupo_receita_despesa on lancamento_financeiro.grupoID = tb_subgrupo_receita_despesa.subGrupoID inner join forma_pagamento on lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID inner join grupo_lancamento on  tb_subgrupo_receita_despesa.grupo = grupo_lancamento.grupo_lancamentoID " ;
        $pesquisa = $_GET["CampoPesquisa"];
        
    if(isset($_GET["pagas"])){
        $select  .= " WHERE data_do_pagamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%' and  lancamento_financeiro.status = 'Pago' ";
    }elseif(isset($_GET["recebidas"])){
        $select  .= " WHERE data_do_pagamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%' and  lancamento_financeiro.status = 'Recebido' ";

    }
//consultar cliente
    $lista_pesquisa = mysqli_query($conecta,$select);


}



if(isset($_GET["apagar"]) or (isset($_GET["areceber"]))  or (isset($_GET["recebidas"])) or (isset($_GET["pagas"])) ){
    $pesquisaData = $_GET["CampoPesquisaData"];
    $pesquisaDataf = $_GET["CampoPesquisaDataf"];
    
 
    if($pesquisaData==""){
          
    }else{
        $div1 = explode("/",$_GET['CampoPesquisaData']);
        $pesquisaData = $div1[2]."-".$div1[1]."-".$div1[0];  
       
    }
    if($pesquisaDataf==""){
       
    }else{
    $div2 = explode("/",$_GET['CampoPesquisaDataf']);
    $pesquisaDataf = $div2[2]."-".$div2[1]."-".$div2[0];
    }
    
   
$selectValorSoma  = "SELECT  clientes.nome_fantasia, forma_pagamento.nome,lancamento_financeiro.descricao, grupo_lancamento.nome as grupo, lancamento_financeiro.lancamentoFinanceiroID, tb_subgrupo_receita_despesa.subgrupo, lancamento_financeiro.data_movimento,  sum(valor) as soma, lancamento_financeiro.documento,lancamento_financeiro.lancamentoFinanceiroID,  lancamento_financeiro.data_a_pagar, lancamento_financeiro.status,lancamento_financeiro.valor,lancamento_financeiro.documento,  lancamento_financeiro.receita_despesa from  clientes  inner join lancamento_financeiro on lancamento_financeiro.clienteID = clientes.clienteID inner join tb_subgrupo_receita_despesa on lancamento_financeiro.grupoID = tb_subgrupo_receita_despesa.subGrupoID inner join forma_pagamento on lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID inner join grupo_lancamento on  tb_subgrupo_receita_despesa.grupo = grupo_lancamento.grupo_lancamentoID " ;
$pesquisa = $_GET["CampoPesquisa"];
if(isset($_GET["apagar"])){
$selectValorSoma  .= " WHERE data_a_pagar BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%'  and lancamento_financeiro.status = 'A Pagar' " ;
}elseif(isset($_GET["areceber"])){
$selectValorSoma  .= " WHERE data_a_pagar BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%'  and  lancamento_financeiro.status = 'A Receber'   "   ;
}elseif(isset($_GET["pagas"])){
    $selectValorSoma  .= " WHERE data_do_pagamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%'  and  lancamento_financeiro.status = 'Pago'   "   ;
}elseif(isset($_GET["recebidas"])){
    $selectValorSoma  .= " WHERE data_do_pagamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%'  and  lancamento_financeiro.status = 'Recebido'   "   ;
}
$lista_Soma_Valor= mysqli_query($conecta,$selectValorSoma);
if(!$lista_Soma_Valor){
    die("Falaha no banco de dados || select valor");
}

}
//recuperar valores via get
if (isset($_GET["CampoPesquisaData"])){
    $pesquisaData=$_GET["CampoPesquisaData"];
  }
  if (isset($_GET["CampoPesquisaDataf"])){
    $pesquisaDataf=$_GET["CampoPesquisaDataf"];
  }
  

?>
<!doctype html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilo -->
    <link href="../_css/estilo.css" rel="stylesheet">
    <link href="../_css/pesquisa_tela.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>
    <?php include_once("../_incluir/topo.php"); ?>
    <?php include("../_incluir/body.php"); ?>
    <?php include_once("../_incluir/funcoes.php"); ?>



    <main>



        <div id="janela_pesquisa">


            <form style="width:100%; " action="" method="get">
                <div id="BotaoLancar" >
                    <input id="lancar" type="submit" style="width: 130px;" name="apagar" value="Contas A pagar">
                    <input id="lancar" style="width: 130px;" type="submit" name="areceber" value="Contas A Receber">
                    <input id="lancar" style="width: 130px;" type="submit" name="pagas" value="Contas Pagas">
                    <input id="lancar" style="width: 130px;" type="submit" name="recebidas" value="Contas Recebidas">

                </div>

                <tr>

                    <input style="width: 100px; " type="text" id="CampoPesquisaData" name="CampoPesquisaData"
                        placeholder="Data incial" onkeyup="mascaraData(this);" value="<?php if( !isset($_GET["CampoPesquisa"])){ echo formatardataB(date('Y-m-01')); }
                              if (isset($_GET["CampoPesquisaData"])){
                                 echo $pesquisaData;
                     }?>">

                    <input style=" width: 100px;" type="text" name="CampoPesquisaDataf" placeholder="Data final"
                        onkeyup="mascaraData(this);" value="<?php if(!isset($_GET["CampoPesquisa"])){ echo date('d/m/Y');
                    } if (isset($_GET["CampoPesquisaDataf"])){ echo $pesquisaDataf;} ?>">



                    <td>
                        <input style="margin-left:50px; width:300px;" type="text" name="CampoPesquisa"
                            placeholder="Pesquisa / Empresa" value="<?php if(isset($_GET['CampoPesquisa'])){
                                echo $pesquisa;
                        }?>">

                    </td>



                </tr>


            </form>

        </div>

        <form action="consulta_financeiro.php" method="get">

            <nav id="cabecalho">
                <ul>
                    <?php if(isset($_GET['areceber'])){?>
                    <li>
                        Contas A Receber
                    </li>
                    <?php  }elseif(isset($_GET['apagar'])){?>
                    <li>
                        Contas A Pagar
                    </li>
                    <?php
                     }elseif(isset($_GET['pagas'])){?>
                    <li>
                        Contas Pagas
                    </li>
                    <?php
                        }elseif(isset($_GET['recebidas'])){?>
                    <li>
                        Contas Recebidas
                    </li>
                    <?php
                }?>
                </ul>
            </nav>
            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>

                    <tr id="cabecalho_pesquisa_consulta">
                        <?php
                        if((isset($_GET["recebidas"])) or (isset($_GET["pagas"]))){

                            ?>
                        <td>
                            <p>Data Pagamento</p>
                        </td>
                        <?php   }elseif((isset($_GET["areceber"])) or (isset($_GET["apagar"]))){?>
                        <td>
                            <p>Data Vencimento</p>
                        </td>
                        <?php
                        }?>
                        <td>
                            <p>Empresa</p>
                        </td>
                        <td>
                            <p>Descrição</p>
                        </td>
                        <td>
                            <p>Valor</p>
                        </td>

                        <td>
                            <p>SubGrupo</p>
                        </td>

                        <td>
                            <p>Nº doc</p>
                        </td>
                        <td>
                            <p>Atraso</p>
                        </td>


                    </tr>

                    <?php

if(isset($_GET["CampoPesquisaData"])){

                    while($linha_pesquisa = mysqli_fetch_assoc($lista_pesquisa)){
                    $dataPagamento = $linha_pesquisa["data_do_pagamento"];
                    $dataVencimentoL = $linha_pesquisa["data_a_pagar"];
                    $clienteL = $linha_pesquisa['nome_fantasia'];
                    $descricao = $linha_pesquisa['descricao'];
                    $statusL = $linha_pesquisa["status"];
                    $subGrupo = ($linha_pesquisa["subgrupo"]);
                    $grupo = utf8_encode($linha_pesquisa["grupo"]);
                    $valorL = $linha_pesquisa["valor"];
                    $documentoL = $linha_pesquisa["documento"];
                    $receite_despesa = $linha_pesquisa["receita_despesa"];
                    $lancamentoID = $linha_pesquisa["lancamentoFinanceiroID"];
                    $atraso = $linha_pesquisa["atraso"];
                    
                   
                    ?>

                    <tr id="linha_pesquisa">
                        <?php
                    if((isset($_GET["recebidas"])) or (isset($_GET["pagas"]))){
                        ?>
                        <td style="width: 100px;">
                            <p>
                                <font size="2"> <?php if($dataPagamento=="0000-00-00") {
                               echo ("");

                                  }elseif($dataPagamento=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($dataPagamento); } ?></font>
                            </p>
                        </td>
                        <?php 
                        
                    }elseif((isset($_GET["areceber"])) or (isset($_GET["apagar"]))){
                        ?>
                        <td style="width: 100px;">
                            <p>
                                <font size="2"> <?php if($dataVencimentoL=="0000-00-00") {
                               echo ("");

                                  }elseif($dataVencimentoL=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($dataVencimentoL); } ?></font>
                            </p>
                        </td>
                        <?php 
                        
                    }
                        
                        ?>

                        <td style="width:200px;">
                            <p>
                                <font size="2"><?php echo utf8_encode($clienteL)?></font>
                            </p>
                        </td>
                        <td style="width:250px;">
                            <font size="2"><?php echo utf8_encode($descricao)?></font>
                        </td>


                        <td>
                            <font size="2"> <?php echo real_format($valorL)?></font>
                        </td>


                        <td style="width:170px;">
                            <font size="2"> <?php echo utf8_encode($subGrupo) ." - ". $grupo?></font>
                        </td>


                        <td style="width:90px;">
                            <font size="2"> <?php echo utf8_encode($documentoL)?> </font>
                        </td>


                        <td style="width:90px;">
                            <font size="2"><?php 
                            if($atraso <= 0 ){

                            }else{
                                ?>
                                <p style="color:red ;"><?php 
                                echo $atraso;
                                 ?>
                                </p>
                                <?php
                                }
                                
                                ?>
                            </font>
                        </td>



                    </tr>




                    <?php
                    }

                    while($linha_Soma_Valor = mysqli_fetch_assoc($lista_Soma_Valor)){
                
                        ?>

                    <tr id="cabecalho_pesquisa_consulta">

                        <td>
                            <p>Valor</p>
                        </td>

                        <td>
                            <p></p>
                        </td>

                        <td>

                        </td>
                        <td style="width: 80px;">
                            <p><?php echo real_format($linha_Soma_Valor['soma']) ?></p>
                        </td>
                        <td>
                            <p></p>
                        </td>

                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>


                    </tr>

                    <?php

                    }
             }
            
            ?>
                </tbody>
            </table>

        </form>

    </main>


</body>


<?php include '../_incluir/funcaojavascript.jar'; ?>

<script>
//abrir uma nova tela de cadastro

function abrepopupEditarEditarFinanceiro() {

    var janela = "editar_receita_despesa.php?codigo=<?php echo  $lancamentoID?>";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>