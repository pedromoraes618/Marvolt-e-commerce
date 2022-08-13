<?php 
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include ("../_incluir/funcoes.php");


$hoje = date('Y--m-d');

if($_GET){

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
    
    //receita
    $select = "SELECT  clientes.nome_fantasia, 
    lancamento_financeiro.data_do_pagamento, forma_pagamento.nome,lancamento_financeiro.grupoID,lancamento_financeiro.descricao,grupo_lancamento.nome  as grupo, 
    lancamento_financeiro.lancamentoFinanceiroID, tb_subgrupo_receita_despesa.subgrupo, tb_subgrupo_receita_despesa.subgrupo, lancamento_financeiro.data_movimento,  
    lancamento_financeiro.documento,lancamento_financeiro.lancamentoFinanceiroID,  lancamento_financeiro.data_a_pagar, 
    lancamento_financeiro.documento, lancamento_financeiro.valor,forma_pagamento.nome,
    lancamento_financeiro.receita_despesa from  clientes  inner join 
    lancamento_financeiro on lancamento_financeiro.clienteID = clientes.clienteID 
    inner join tb_subgrupo_receita_despesa on lancamento_financeiro.grupoID = 
    tb_subgrupo_receita_despesa.subGrupoID inner join forma_pagamento on 
    lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID inner join 
    grupo_lancamento on  tb_subgrupo_receita_despesa.grupo = grupo_lancamento.grupo_lancamentoID 
    WHERE data_do_pagamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and lancamento_financeiro.status = 'Recebido' ";
    $lista_pesquisa_receita = mysqli_query($conecta,$select);
    if(!$lista_pesquisa_receita){
        die("Falha no banco de dados || lancamento_financeiro");
    }

    $selectValorSoma  = "SELECT  clientes.nome_fantasia, forma_pagamento.nome,lancamento_financeiro.descricao, 
    grupo_lancamento.nome as grupo, lancamento_financeiro.lancamentoFinanceiroID, tb_subgrupo_receita_despesa.subgrupo, 
    lancamento_financeiro.data_movimento,  sum(valor) as soma, lancamento_financeiro.documento,lancamento_financeiro.lancamentoFinanceiroID, 
     lancamento_financeiro.data_a_pagar, lancamento_financeiro.status,lancamento_financeiro.valor,lancamento_financeiro.documento,  
     lancamento_financeiro.receita_despesa from  clientes  inner join lancamento_financeiro on lancamento_financeiro.clienteID = 
     clientes.clienteID inner join tb_subgrupo_receita_despesa on lancamento_financeiro.grupoID = tb_subgrupo_receita_despesa.subGrupoID 
     inner join forma_pagamento on lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID inner join grupo_lancamento 
     on  tb_subgrupo_receita_despesa.grupo = grupo_lancamento.grupo_lancamentoID " ;
    $selectValorSoma  .= " WHERE data_do_pagamento BETWEEN '$pesquisaData' and '$pesquisaDataf'  and lancamento_financeiro.status = 'Recebido'   " ;
    $lista_Soma_Valor = mysqli_query($conecta,$selectValorSoma);
    if(!$lista_Soma_Valor){
        die("Falha no banco de dados || lancamento_financeiro (soma total)");
    }else{
        $linha = mysqli_fetch_assoc($lista_Soma_Valor);
        $somaReceita = $linha['soma'];

    }

    //despesa
    $select = "SELECT  clientes.nome_fantasia, 
    lancamento_financeiro.data_do_pagamento, forma_pagamento.nome,lancamento_financeiro.grupoID,lancamento_financeiro.descricao,grupo_lancamento.nome  as grupo, 
    lancamento_financeiro.lancamentoFinanceiroID, tb_subgrupo_receita_despesa.subgrupo, tb_subgrupo_receita_despesa.subgrupo, lancamento_financeiro.data_movimento,  
    lancamento_financeiro.documento,lancamento_financeiro.lancamentoFinanceiroID,  lancamento_financeiro.data_a_pagar, 
    lancamento_financeiro.documento, lancamento_financeiro.valor,forma_pagamento.nome,
    lancamento_financeiro.receita_despesa from  clientes  inner join 
    lancamento_financeiro on lancamento_financeiro.clienteID = clientes.clienteID 
    inner join tb_subgrupo_receita_despesa on lancamento_financeiro.grupoID = 
    tb_subgrupo_receita_despesa.subGrupoID inner join forma_pagamento on 
    lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID inner join 
    grupo_lancamento on  tb_subgrupo_receita_despesa.grupo = grupo_lancamento.grupo_lancamentoID 
    WHERE data_do_pagamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and lancamento_financeiro.status = 'Pago' ";
    $lista_pesquisa_despsa = mysqli_query($conecta,$select);
    if(!$lista_pesquisa_despsa){
        die("Falha no banco de dados || lancamento_financeiro");
    }

    $selectValorSoma  = "SELECT  clientes.nome_fantasia, forma_pagamento.nome,lancamento_financeiro.descricao, 
    grupo_lancamento.nome as grupo, lancamento_financeiro.lancamentoFinanceiroID, tb_subgrupo_receita_despesa.subgrupo, 
    lancamento_financeiro.data_movimento,  sum(valor) as soma, lancamento_financeiro.documento,lancamento_financeiro.lancamentoFinanceiroID, 
     lancamento_financeiro.data_a_pagar, lancamento_financeiro.status,lancamento_financeiro.valor,lancamento_financeiro.documento,  
     lancamento_financeiro.receita_despesa from  clientes  inner join lancamento_financeiro on lancamento_financeiro.clienteID = 
     clientes.clienteID inner join tb_subgrupo_receita_despesa on lancamento_financeiro.grupoID = tb_subgrupo_receita_despesa.subGrupoID 
     inner join forma_pagamento on lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID inner join grupo_lancamento 
     on  tb_subgrupo_receita_despesa.grupo = grupo_lancamento.grupo_lancamentoID " ;
    $selectValorSoma  .= " WHERE data_do_pagamento BETWEEN '$pesquisaData' and '$pesquisaDataf'  and lancamento_financeiro.status = 'Pago'  " ;
    $lista_Soma_Valor_despesa = mysqli_query($conecta,$selectValorSoma);
    if(!$lista_Soma_Valor_despesa){
        die("Falha no banco de dados || lancamento_financeiro (soma total)");
    }else{
        $linha = mysqli_fetch_assoc($lista_Soma_Valor_despesa);
        $somaDespesa = $linha['soma'];

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
            <ul>
                <li>
                    <b style="margin-left:35px ;"> Data</b>
                </li>
            </ul>

            <form style="width:100%; " action="" method="get">
                <div id="BotaoLancar">
                    <form action="consulta_produto.php" method="get">

                        <input type="submit" style="width: 130px;" name="pesquisar" id="pesquisar" value="Pesquisar">



                </div>


                <input style="width: 100px; " type="text" id="CampoPesquisaData" name="CampoPesquisaData"
                    placeholder="Data incial" onkeyup="mascaraData(this);" value="<?php if(!$_GET){ echo formatardataB(date('Y-m-01')); 
                        }elseif(isset($_GET["CampoPesquisaData"])){
                                 echo $pesquisaData;
                     }?>">

                <input style=" width: 100px;" type="text" name="CampoPesquisaDataf" placeholder="Data final"
                    onkeyup="mascaraData(this);" value="<?php if(!$_GET){ echo date('d/m/Y');
                    }elseif(isset($_GET["CampoPesquisaDataf"])){ echo $pesquisaDataf;} ?>">




            </form>
         

        </div>

        <?php 
        //receita
        if($_GET){
        include ("include_tabela/receita.php");
        include ("include_tabela/despesa.php");
        include ("include_tabela/resumo.php");
        }
         ?>
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