<?php 
include("../conexao/sessao.php");
require_once("../conexao/conexao.php"); 

//consulta produto
if(isset($_GET["pesquisa"])){
$descricao = $_GET["pesquisa"];
$select = "SELECT * from tb_categoria WHERE cl_descricao LIKE '%{$descricao}%' ";
$resultado_select = mysqli_query($conecta, $select);
    if(!$resultado_select){
        die("Falha na consulta ao banco de dados || tb_categoria");
    }
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

    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>

    <?php include_once("../_incluir/topo.php"); ?>
    <?php include("../_incluir/body.php"); ?>
    <?php include_once("../_incluir/funcoes.php"); ?>

    <main>
        <div id="janela_pesquisa">
            <a
                onclick="window.open('cadastro_categoria.php', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">
                <input type="submit" style="width:140px" name="cadastrar_produto" value="Adicionar">
            </a>
            <form action="" method="get">
                <input type="text" name="pesquisa" placeholder="Pesquisa / Categoria / Código " value="<?php if(isset($_GET['pesquisa'])){
                    echo $descricao;
                }?>">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />
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
                            <p>Categoria</p>
                        </td>

                        <td>
                        </td>
                    </tr>

                    <?php


if(isset($_GET["pesquisa"])){
      while($linha = mysqli_fetch_assoc($resultado_select)){
        $b_id = $linha["cl_id"];
        $b_categoria = ($linha["cl_descricao"]);
   
        ?>


                    <tr id="linha_pesquisa">

                        <td style="width: 70px;padding-left:15px">
                            <font size="3"><?php echo $b_id;?> </font>
                        </td>

                        <td style="width: 500px;">
                            <p>
                                <font size="2"><?php echo $b_categoria; ?> </font>
                            </p>
                        </td>

                        <td>
                            <a
                                onclick="window.open('editar_categoria.php?codigo=<?php echo $b_id;?>', 
'editar_categoria', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">

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


</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>