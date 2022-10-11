<?php require_once("../../conexao/conexao.php"); ?>
<?php

include("../../conexao/sessao.php");

//consultar situacao ativo
$selectativo = "SELECT ativoID, nome_ativo from ativo";
$lista_ativo = mysqli_query($conecta, $selectativo);
if(!$lista_ativo){
die("Falaha no banco de dados  Linha 31 inserir_transportadora");
}

//consultar categoria
$selectcategoria = "SELECT categoriaID, nome_categoria from categoria_produto";
$lista_categoria = mysqli_query($conecta, $selectcategoria);
if(!$lista_categoria){
die("Falha no banco de dados");
}

//consultar clientes

$select = " SELECT usuarios.usuarioID, usuarios.email, usuarios.nome, tb_nivel_usuario.descricao AS nivelUsuario, usuarios.usuario, usuarios.nivel  from usuarios inner join tb_nivel_usuario on usuarios.nivel = tb_nivel_usuario.nivel_usuarioID";

if(isset($_GET["pesquisa"])){
    $pesquisa_usuario = $_GET["pesquisa"];
    $select .= " WHERE usuarios.usuario LIKE '%{$pesquisa_usuario}%' ";
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
                onclick="window.open('cadastro_usuario.php', 
'cadastro_usuario', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1200, HEIGHT=650');">
                <input type="submit" id="lancar" style="width: 150px;" name="cadastrar_usuario"
                    value="Adicionar Usuário">
            </a>


            <form action="" method="get">

                <input type="text" name="pesquisa" placeholder="Pesquisa / usuário" value="<?php if(isset($_GET['pesquisa'])){
                    echo $pesquisa_usuario;
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
                            <p>Nome</p>
                        </td>

                        <td>
                            <p>Usuário</p>
                        </td>

                        <td>
                            <p>E-mail</p>
                        </td>
                        <td>
                            <p>Nível</p>
                        </td>

                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>




                    </tr>

                    <?php


                if(isset($_GET["pesquisa"])){
                    while($linha = mysqli_fetch_assoc($resultado)){
                        $idUsuario = $linha["usuarioID"];
                        $usuario = utf8_encode($linha["usuario"]);
                        $nome = utf8_encode($linha["nome"]);
                        $email = utf8_encode( $linha["email"]);
                        $nivel = utf8_encode($linha["nivelUsuario"]);

                        
                    ?>

                    <tr id="linha_pesquisa">



                        <td style="width: 70px;">
                            <font size="3">
                                <p style="margin-left: 20px;"><?php echo $idUsuario?></p>
                            </font>
                        </td>

                        <td style="width: 350px;">
                            <p>
                                <font size="3"><?php echo $nome?> </font>
                            </p>
                        </td>
                        <td style="width: 300px;">
                            <p>
                                <font size="3"><?php echo $usuario?> </font>
                            </p>
                        </td>
                        <td style="width: 300px;">
                            <font size="3"><?php echo $email?></font>
                        </td>
                        <td style="width: 150px;">
                            <font size="3"><?php echo  $nivel?> </font>
                        </td>

                        <td>

                        </td>

                        <td id="botaoEditar">


                            <a
                                onclick="window.open('editar_usuario.php?codigo=<?php echo $idUsuario?>', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1200, HEIGHT=650');">

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