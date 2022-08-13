<?php 
include("../conexao/sessao.php");
require_once("../conexao/conexao.php"); 

//consulta produto
if(isset($_GET["produto"])){
$nome_produto = $_GET["produto"];
$produtos = "SELECT p.cl_data_cadastro,p.cl_destaque,p.cl_ativo,p.cl_id,p.cl_categoria, p.cl_descricao, c.cl_descricao as as_descricao_categoria, f.cl_descricao as as_descricao_fabricante, p.cl_fabricante, 
p.cl_titulo, p.cl_imagem, p.cl_destaque from tb_produto as 
p inner join tb_fabricante as f on f.cl_id = p.cl_fabricante inner join tb_categoria as c on c.cl_id = p.cl_categoria
WHERE p.cl_titulo LIKE '%{$nome_produto}%' ";

$resultado = mysqli_query($conecta, $produtos);
    if(!$resultado){
        die("Falha na consulta ao banco de dados || tb_produto com inner join tb_fabricante");
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
                onclick="window.open('cadastro_produto.php', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">
                <input type="submit" style="width:140px" name="cadastrar_produto" value="Adicionar Produto">
            </a>
            <form action="consulta_produto.php" method="get">
                <input type="text" name="produto" placeholder="Pesquisa / Titulo / Código " value="<?php if(isset($_GET['produto'])){
                    echo $nome_produto;
                }?>">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />
            </form>

        </div>

        <form action="consulta_produto.php" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>Código</p>
                        </td>

                        <td>
                            <p>Imagem</p>
                        </td>
                        <td>
                            <p>Titulo</p>
                        </td>
                        <td>
                            <p>Descrição</p>
                        </td>
                        <td>
                            <p>Categoria</p>
                        </td>
                        <td>
                            <p>Fabricante</p>
                        </td>
                        <td>
                            <p>Ativo</p>
                        </td>
                        <td>
                        <p>Destaque</p>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>

                    <?php


if(isset($_GET["produto"])){
      while($linha = mysqli_fetch_assoc($resultado)){
        $b_id = $linha["cl_id"];
        $b_imagem = ($linha["cl_imagem"]);
        $b_titulo = ($linha["cl_titulo"]);
        $b_descricao = ($linha["cl_descricao"]);
        $b_fabricante = ($linha["as_descricao_fabricante"]);
        $b_categoria = ($linha["as_descricao_categoria"]);
        $b_ativo = ($linha["cl_ativo"]);
        $destaque = ($linha["cl_destaque"]);
        ?>


                    <tr id="linha_pesquisa">

                        <td style="width: 70px;padding-left:15px">
                            <font size="3"><?php echo $b_id;?> </font>
                        </td>

                        <td style="width: 200px;">
                            <p>
                                <font size="2"><img src="<?php echo $b_imagem; ?>"> </font>
                            </p>
                        </td>
                        <td style="width: 200px;">
                            <font size="2"><?php echo $b_titulo;?></font>
                        </td>

                        <td style="width: 500px;">
                            <font size="2"><?php echo $b_descricao;?> </font>
                        </td>
                        <td style="width: 200px;">
                            <font size="2"><?php echo $b_categoria;?> </font>
                        </td>
                        <td style="width: 100px;">
                            <font size="2"><?php echo $b_fabricante;?> </font>
                        </td>
                        <td style="width: 100px;padding-left:20px;">
                            <font size="2"><?php if($b_ativo==1){
                                ?><i style="color:green; cursor:pointer" title="ativo"
                                    class="fa-solid fa-circle-check"></i><?php
                            }else{
                                ?>
                                <i style="color:red;cursor:pointer" title="Inativo"
                                    class="fa-solid fa-circle-xmark"></i>
                                <?php
                            }?>
                            </font>
                        </td>
                        <td style="width:100px;padding-left:20px;">
                            <font size="2"><?php if($destaque==1){
                                ?><i style="color:yellow; cursor:pointer" title="Destaque"
                                    class="fa-solid fa-star"></i><?php
                            }?>
                            </font>
                        </td>
                     
                        <td>
                            <a
                                onclick="window.open('add_img.php?codigo=<?php echo $b_id;?>', 
'editar_produto', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">
                                <button type="button" name="img">Img</button>
                            </a>
                        </td>   
                        <td>
                            <a
                                onclick="window.open('editar_produto.php?codigo=<?php echo $b_id;?>', 
'editar_produto', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">

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