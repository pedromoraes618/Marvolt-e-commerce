<?php require_once("../../conexao/conexao.php"); ?>
<?php

include("../../conexao/sessao.php");


//consultar clientes

$select = " SELECT * from tb_parametros ";
if(isset($_GET["pesquisa"])){
    $pesquisa = $_GET["pesquisa"];
    $select .= " WHERE descricao LIKE '%{$pesquisa}%' ";
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


    
            <form action="" method="get">

                <input type="text" name="pesquisa" placeholder="Pesquisa / Descricao" value="<?php if(isset($_GET['pesquisa'])){
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
                            <p>Código</p>
                        </td>
                        <td>
                            <p>Descrição</p>
                        </td>
                        <td>
                        <p>Valor</p>
                        </td>
                        <td>
                       
                        </td>



                    </tr>

                    <?php


                if(isset($_GET["pesquisa"])){
                    while($linha = mysqli_fetch_assoc($resultado)){
                        $parametroID = $linha["parametroID"];
                        $descricao = utf8_encode($linha["descricao"]);
                        $valor = utf8_encode($linha["valor"]);
                      

                        
                    ?>

                    <tr id="linha_pesquisa">



                        <td style="width: 70px;">
                            <font size="3">
                                <p style="margin-left: 20px;"><?php echo $parametroID?></p>
                            </font>
                        </td>

                        <td style="width: 500px;">
                            <p>
                                <font size="3"><?php echo $descricao?> </font>
                            </p>
                        </td>
                        <td style="width: 500px;">
                            <p>
                                <font size="3"><?php echo $valor?> </font>
                            </p>
                        </td>

                        <td id="botaoEditar">


                            <a
                                onclick="window.open('editar_parametro.php?codigo=<?php echo $parametroID?>', 
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