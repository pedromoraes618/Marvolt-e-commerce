<?php
include("../conexao/sessao.php");
include("../conexao/conexao.php"); 


if(isset($_GET["pesquisa"])){
    $pesquisa = $_GET["pesquisa"];
    $select = " SELECT * from tb_patrimonio where descricao LIKE '%{$pesquisa}%' ";
    $resultado = mysqli_query($conecta, $select);
    if(!$resultado){
    die("Falha na consulta ao banco de dados || tb_patrimonio");
                
    }
}

$select = "SELECT sum(total) as vTotal from tb_patrimonio ";
$resultadoSomatorio = mysqli_query($conecta, $select);
if(!$resultadoSomatorio){
die("Falha na consulta ao banco de dados || tb_patrimonio");        
}else{
    $linha = mysqli_fetch_assoc($resultadoSomatorio);
    $total = $linha['vTotal'];
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
                onclick="window.open('cadastro_patrimonio.php', 
'cadastro_usuario', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1200, HEIGHT=650');">
                <input type="submit" id="lancar" style="width: 150px;" name="cadatrar_patrimonio"
                    value="Adicionar Patrimônio">
            </a>

            <form method="get">
                <input type="text" name="pesquisa" placeholder="Pesquisa / Descrição" value="<?php if($_GET){
                    echo $pesquisa;
                }?>">
                <input type="image" name="btnPesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />

            </form>

        </div>


        <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
            <tbody>
                <tr id="cabecalho_pesquisa_consulta">
                    <td>
                        <p>Descrição</p>
                    </td>
                    <td>
                        <p>Qtd</p>
                    </td>
                    <td>
                        <p>Valor</p>
                    </td>
                    <td>
                        <p>Total</p>
                    </td>
                    <td>

                    </td>

                </tr>

                <?php
                if(isset($_GET["pesquisa"])){
                    while($linha = mysqli_fetch_assoc($resultado)){
                        $patrimonioID = $linha["patrimonioID"];
                        $descricao = utf8_encode($linha["descricao"]);
                        $qtd = utf8_encode($linha["quantidade"]);
                        $valor = utf8_encode($linha["valor"]);
                
                        
                    ?>

                <tr id="linha_pesquisa">

                    <td style="width: 350px;">
                        <p>
                            <font size="2"><?php echo $descricao?> </font>
                        </p>
                    </td>
                    <td style="width: 350px;">
                        <p>
                            <font size="2"><?php echo $qtd?> </font>
                        </p>
                    </td>
                    <td style="width: 300px;">
                        <p>
                            <font size="2"><?php echo real_format($valor)?> </font>
                        </p>
                    </td>

                    <td style="width: 300px;">
                        <p>
                            <font size="2"><?php echo real_format($valor * $qtd)?> </font>
                        </p>
                    </td>
                    <td id="botaoEditar">
                        <a
                            onclick="window.open('editar_patrimonio.php?codigo=<?php echo $patrimonioID; ?>', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1200, HEIGHT=650');">

                            <button type="button" name="editar">Editar</button>
                        </a>

                    </td>


                </tr>



                <?php
             }
            }
            ?>
                <tr id="cabecalho_pesquisa_consulta">
                    <td>
                        <p>Total</p>
                    </td>
                    <td>
                        <p></p>
                    </td>
                    <td>
                        <p></p>
                    </td>
                    <td>
                        <p>
                            <?PHP   if(isset($_GET["pesquisa"])){
                             ECHO real_format($total);
                             
                            }?>
                        </p>
                    </td>
                    <td>

                    </td>

                </tr>
            </tbody>
        </table>


    </main>
</body>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>