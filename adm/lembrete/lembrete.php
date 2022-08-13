<?php 

include("../conexao/sessao.php");
require_once("../conexao/conexao.php"); 
include ("../_incluir/funcoes.php");

//consultar lancamento
$select = "SELECT receita_despesaID, nome from receita_despesa";
$lista_receita_despesa = mysqli_query($conecta,$select);
if(!$lista_receita_despesa){
    die("Falaha no banco de dados || falha de conexão");
}

//pegar o nivel do usuario
if($_SESSION["user_portal"]){
    $user= $_SESSION["user_portal"];
    $saudacao = "SELECT usuarios.usuario,usuarios.nivel,usuarios.nome, tb_nivel_usuario.descricao FROM usuarios inner join tb_nivel_usuario on usuarios.nivel = tb_nivel_usuario.nivel_usuarioID where usuarioID = {$user}";
    $saudacao_login = mysqli_query($conecta,$saudacao);
    if (!$saudacao_login){
        die ("Falha no banco de dados");
    }
    $saudacao_login = mysqli_fetch_assoc($saudacao_login);
    $nome = $saudacao_login['usuario'];
    $nivel = $saudacao_login['nivel'];
    $descricaoNivel = $saudacao_login['descricao'];
}



$pesquisaDataf = date('Y--m-31');
$pesquisaData = date('Y-01-01');

//select contas a receber
$select = "SELECT  clientes.nome_fantasia,DATEDIFF(CURRENT_DATE(),lancamento_financeiro.data_a_pagar) as atraso,lancamento_financeiro.data_do_pagamento, forma_pagamento.nome,lancamento_financeiro.descricao,grupo_lancamento.nome  as grupo, lancamento_financeiro.lancamentoFinanceiroID, tb_subgrupo_receita_despesa.subgrupo, tb_subgrupo_receita_despesa.subgrupo, lancamento_financeiro.data_movimento,  lancamento_financeiro.documento,lancamento_financeiro.lancamentoFinanceiroID,  lancamento_financeiro.data_a_pagar, lancamento_financeiro.status,lancamento_financeiro.valor,lancamento_financeiro.documento,  lancamento_financeiro.receita_despesa from  clientes  inner join lancamento_financeiro on lancamento_financeiro.clienteID = clientes.clienteID inner join tb_subgrupo_receita_despesa on lancamento_financeiro.grupoID = tb_subgrupo_receita_despesa.subGrupoID inner join forma_pagamento on lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID inner join grupo_lancamento on  tb_subgrupo_receita_despesa.grupo = grupo_lancamento.grupo_lancamentoID " ;
$select  .= " WHERE data_a_pagar BETWEEN '$pesquisaData' and '$pesquisaDataf' and  lancamento_financeiro.status = 'A Receber' ";
$lista_pesquisa = mysqli_query($conecta,$select);

//select contas a pagar
$select = "SELECT  clientes.nome_fantasia,DATEDIFF(CURRENT_DATE(),lancamento_financeiro.data_a_pagar) as atraso,lancamento_financeiro.data_do_pagamento, 
forma_pagamento.nome,lancamento_financeiro.descricao,grupo_lancamento.nome  as grupo, lancamento_financeiro.lancamentoFinanceiroID, tb_subgrupo_receita_despesa.subgrupo, 
tb_subgrupo_receita_despesa.subgrupo, lancamento_financeiro.data_movimento,  lancamento_financeiro.documento,lancamento_financeiro.lancamentoFinanceiroID,  
lancamento_financeiro.data_a_pagar, lancamento_financeiro.status,lancamento_financeiro.valor,lancamento_financeiro.documento,  lancamento_financeiro.receita_despesa from  
clientes  inner join lancamento_financeiro on lancamento_financeiro.clienteID = clientes.clienteID inner join tb_subgrupo_receita_despesa on 
lancamento_financeiro.grupoID = tb_subgrupo_receita_despesa.subGrupoID inner join forma_pagamento on lancamento_financeiro.forma_pagamentoID = 
forma_pagamento.formapagamentoID inner join grupo_lancamento on  
tb_subgrupo_receita_despesa.grupo = grupo_lancamento.grupo_lancamentoID  WHERE 
data_a_pagar BETWEEN '$pesquisaData' and '$pesquisaDataf' and  lancamento_financeiro.status = 'A Pagar' " ;
$lista_pesquisa_pagar = mysqli_query($conecta,$select);


//select tabela pedido de compra
$select = "SELECT clientes.nome_fantasia,data_fechamento,pedido_compra.data_movimento, pedido_compra.data_movimento,pedido_compra.valor_total_compra,
pedido_compra.status_recebimento,  pedido_compra.codigo_pedido, pedido_compra.numero_pedido_compra, pedido_compra.pedidoID, 
pedido_compra.data_chegada, pedido_compra.entrega_realizada, pedido_compra.entrega_prevista, pedido_compra.valor_total, 
 pedido_compra.desconto_geral, pedido_compra.valor_total_margem from  clientes inner join pedido_compra on pedido_compra.clienteID = clientes.clienteID " ;
$select  .= " WHERE data_fechamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and  entrega_realizada <> '0000-00-00' and status_recebimento = 0 ORDER BY  pedido_compra.data_fechamento asc ";
$lista_pesquisa_recebemento = mysqli_query($conecta,$select);
if(!$lista_pesquisa_recebemento){
    die("Falaha no banco de dados || pedido_compra");
}


//select tabela pedido de compra entrega de produto
$select = "SELECT clientes.nome_fantasia,data_fechamento,pedido_compra.data_movimento, pedido_compra.data_movimento,pedido_compra.valor_total_compra,
pedido_compra.status_recebimento,  pedido_compra.codigo_pedido, pedido_compra.numero_pedido_compra, pedido_compra.pedidoID, 
pedido_compra.data_chegada, pedido_compra.entrega_realizada, pedido_compra.entrega_prevista, pedido_compra.valor_total, 
 pedido_compra.desconto_geral, pedido_compra.valor_total_margem from  clientes inner join pedido_compra on pedido_compra.clienteID = clientes.clienteID " ;
$select  .= " WHERE data_fechamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and  entrega_realizada = '0000-00-00' and entrega_prevista <> '0000-00-00' ORDER BY  pedido_compra.data_fechamento asc ";
$lista_pesquisa_entrega = mysqli_query($conecta,$select);
if(!$lista_pesquisa_entrega){
    die("Falaha no banco de dados || pedido_compra");
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
    <?php include_once("../_incluir/funcoes.php"); ?>
    <div id="titulo">
        </p>Lembrete <?php echo utf8_encode($descricaoNivel); ?> </p>
    </div>

    <main>

        <?php 
         //administracao
    if($nivel == 2){
    include("nivel/adminstracao.php");
    }
    
    //administrador
    if($nivel == 5){
    include("nivel/administrador.php");
    }
    //logistica
    if($nivel == 3){
        include("nivel/logistica.php");
    }
    //financeiro
    if($nivel == 4){
        include("nivel/financeiro.php");
    }
    ?>

    </main>


</body>


<?php include '../_incluir/funcaojavascript.jar'; ?>


</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>