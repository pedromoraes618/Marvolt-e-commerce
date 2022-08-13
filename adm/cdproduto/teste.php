<?php
require_once("../conexao/conexao.php");

$buscar = $_GET['codigo'];

$select = "SELECT * from produtos where produtoID = '$buscar'";
$lista_produtos = mysqli_query($conecta, $select);
if(!$lista_produtos){
die("Falaha no banco de dados  Linha 31 inserir_transportadora");
}

?>

<body>
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
                    <p>Preço venda</p>
                </td>
                <td>
                    <p>Preço compra</p>
                </td>
                <td>
                    <p>Estoque</p>
                </td>


                <td>
                    <p>Categoria</p>
                </td>
                <td>
                    <p>Fabricante</p>
                </td>
                <td>
                    <p>UND</p>
                </td>

                <td>
                    <p></p>
                </td>

            </tr>

            <?php



      while($linha = mysqli_fetch_assoc($lista_produtos)){
        $idProduto = $linha["produtoID"]?>


            <tr id="linha_pesquisa">



                <td style="width: 70px;">
                    <font size="3"><?php echo utf8_encode($linha["produtoID"])?> </font>
                </td>

                <td style="width: 500px;">
                    <p>
                        <font size="2"><?php echo utf8_encode($linha["nomeproduto"])?> </font>
                    </p>
                </td>
                <td style="width: 150px;">
                    <font size="2"><?php echo ($linha["precovenda"])?></font>
                </td>
                <td style="width: 150px;">
                    <font size="2"><?php echo ($linha["precocompra"])?> </font>
                </td>

                <td style="width: 100px;">
                    <font size="2"><?php echo utf8_encode($linha["estoque"])?> </font>
                </td>



                <td style="width: 100px;">
                    <font size="2"><?php echo utf8_encode($linha["fabricante"])?> </font>
                </td>
                <td>
                    <font size="2"><?php echo utf8_encode($linha["unidade_medida"])?> </font>
                </td>

                <td id="botaoEditar">

                    <a
                        onclick="window.open('editar_produto.php?codigo=<?php echo $linha['produtoID']?>', 
'editar_produto', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">

                        <button type="button" name="editar">Editar</button>
                    </a>

                </td>


            </tr>



            <?php
             }
            
            ?>
        </tbody>
    </table>

</body>