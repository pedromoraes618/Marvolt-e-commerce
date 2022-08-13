<?php require_once("../../conexao/conexao.php"); ?>
<?php

include("../../conexao/sessao.php");


//consultar subgrupos
$select = " SELECT subgrupo,nome,subGrupoID,lancamento from tb_subgrupo_receita_despesa inner join grupo_lancamento on grupo_lancamento.grupo_lancamentoID = tb_subgrupo_receita_despesa.grupo ";
if(isset($_GET["pesquisa"])){
    $pesquisa = $_GET["pesquisa"];
    $select .= " WHERE subgrupo LIKE '%{$pesquisa}%' ";
}

$resultado = mysqli_query($conecta, $select);
if(!$resultado){
    die("Falha na consulta ao banco de dados");
    
}

?>
<!doctype html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilo -->
    <link href="../../_css/estilo.css" rel="stylesheet">
    <link href="../../_css/pesquisa_tela.css" rel="stylesheet">

    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>

    <?php include_once("../../_incluir/topo.php"); ?>
    <?php include("../../_incluir/body.php"); ?>
    <?php include_once("../../_incluir/funcoes.php"); ?>


    <main>
        <div id="janela_pesquisa">


            <a
                onclick="window.open('cadastro_subgrupo.php', 
'cadastro_usuario', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1200, HEIGHT=650');">
                <input type="submit" id="cadastrar_sbuGrupo" style="width: 150px;" name="cadastrar_sbuGrupo"
                    value="Adicionar SubGrupo"> </a>


            <form action="" method="get">

                <input type="text" name="pesquisa" placeholder="Pesquisa / SubGrupo" value="<?php if(isset($_GET['pesquisa'])){
                    echo $pesquisa;
                }?>">
                <input type="image" name="btnPesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />


            </form>


        </div>

        <form action="" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p style="margin-left: 20px;">SubGrupo</p>
                        </td>
                        <td>
                            <p>Grupo</p>
                        </td>
                        <td>
                            <p>Tipo</p>
                        </td>
                        <td>

                        </td>



                    </tr>

                    <?php


                if(isset($_GET["pesquisa"])){
                    while($linha = mysqli_fetch_assoc($resultado)){
                        $subGrupoID = utf8_encode($linha["subGrupoID"]);
                        $subGrupo = utf8_encode($linha["subgrupo"]);
                        $grupo = utf8_encode($linha["nome"]);
                        $tipoLancamento = utf8_encode($linha["lancamento"]);
                      

                        
                    ?>

                    <tr id="linha_pesquisa">

                        <td style="width: 300px;">
                            <font size="3">
                                <p style="margin-left: 20px;"><?php echo $subGrupo?></p>
                            </font>
                        </td>

                        <td style="width: 200px;">
                            <p>
                                <font size="3"><?php echo $grupo?> </font>
                            </p>
                        </td>

                        <td style="width: 500px;">
                            <p>
                                <font size="3"><?php echo $tipoLancamento?> </font>
                            </p>
                        </td>
                        
                        <td id="botaoEditar">


                            <a
                                onclick="window.open('editar_subgrupo.php?codigo=<?php echo $subGrupoID?>', 
'editar_categoria', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1200, HEIGHT=650');">

                                <button type="button" name="editar">Editar</button>
                            </a>

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

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>