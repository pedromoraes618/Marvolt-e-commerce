<?php require_once("../../conexao/conexao.php"); ?>
<?php

include("../../conexao/sessao.php");


//consultar clientes
$clientes = "SELECT * FROM comprador";
if(isset($_GET["cliente"])){
    $nome_cliente = $_GET["cliente"];
    $clientes .= " WHERE  id_cliente = $nome_cliente  ";
}

$resultado = mysqli_query($conecta, $clientes);
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

    <?php include_once("../../_incluir/funcoes.php"); ?>


    <main>

        <div style="margin-top:0px" id="janela_pesquisa">


            <div id="BotaoLancar">
                <input type="submit" class="btnvoltar" id="btnvoltar" onclick="fechar();" name="voltar"
                    value="Voltar"></input>

                <a href="cadastro_comprador.php?cliente=<?php echo $_GET['cliente'];?>">
                    <input id="lancar" type="submit" name="cadastar_cliente" value="Adicionar Comprador">
                </a>

            </div>








        </div>

        <form action="consulta_pdcompra.php" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            Código
                        </td>
                        <td>
                            <p>Comprador</p>
                        </td>
                        <td>
                            <p>Contato</p>
                        </td>
                        <td>
                            <p>E-mail</p>
                        </td>

                        <td>
                            <p>Observação</p>
                        </td>
                        <td>
                            <p></p>
                        </td>

                    </tr>

                    <?php
           if(isset($_GET["cliente"])){
           while($linha = mysqli_fetch_assoc($resultado)){
           ?>


                    <tr id="linha_pesquisa">

                        <td style="width:100px;">
                            <p>
                                <font size="3"><?php echo utf8_encode($linha["id_comprador"])?>
                                </font>
                            </p>
                        </td>

                        <td style="width:400px;">
                            <font size="3"><?php echo utf8_encode($linha["comprador"])?></font>
                        </td>
                        <td style="width:160px;">
                            <font size="3"> <?php echo utf8_encode($linha["contato"])?>
                            </font>
                        </td>

                        <td style="width:180px;">
                            <font size="3"> <?php echo utf8_encode($linha["email"])?></font>
                        </td>

                        <td>
                            <font size="3"> <?php echo utf8_encode($linha["observacao"])?></font>
                        </td>


                        <td id="botaoEditar">

                            <a
                                href="editar_comprador.php?comprador=<?php echo $linha["id_comprador"]?>&cliente=<?php echo $nome_cliente;?>">
                                <button type="button" name="Editar">Editar</button>
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
function abrepopupCadastroComprador() {

    var janelaCadastro = "cadastro_comprador.php?cliente=<?php echo $_GET['cliente'];?>"
    window.open(janelaCadastro, 'popuppageCadastro',
        'width=1000,toolbar=0,resizable=1,scrollbars=yes,height=300,top=100,left=200');
}

function fechar() {
    window.close();
}
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>