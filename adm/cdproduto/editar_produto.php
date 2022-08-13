<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include("../alert/alert.php");
include("crud.php");


echo "."; 


//consulta produto
if(isset($_GET["codigo"])){
    $codProduto = $_GET["codigo"];
}
//variaveis 
if(isset($_POST['enviar'])){
    $hoje = date('Y-m-d'); 
    $titulo = ($_POST["campoTitulo"]);
    $descricao = ($_POST["campoDescricao"]);
    $fabricante = ($_POST["campoFabricante"]);
    $categoria = ($_POST["campoCategoria"]);
    $ativo = ($_POST["ativo"]);
    $destaque = ($_POST["destaque"]);
    $subcategoria = ($_POST["campoSubcategoria"]);

    if($titulo==""){
        ?>
<script>
alertify.alert("Favor informar a categoria do produto");
</script>

<?php 
      }elseif($fabricante=="0"){
        ?>
<script>
alertify.alert("Favor informar o fabricante");
</script>

<?php 
      }elseif($categoria=="0"){
          ?>
<script>
alertify.alert("Favor informar a categoria");
</script>

<?php 
        }else{

//update as informações no banco de dados
$update = "UPDATE tb_produto set cl_titulo = '{$titulo}',cl_descricao = '{$descricao}',cl_fabricante = '{$fabricante}',cl_categoria = '{$categoria}'
,cl_ativo = '{$ativo}', cl_destaque = '{$destaque}',cl_subcategoria = '{$subcategoria}' where cl_id = {$codProduto} ";
$operacao_update_produto = mysqli_query($conecta, $update);
if(!$operacao_update_produto){
    die("Erro no banco de dados || tb_produto || update");
    }else{
        ?>
<script>
alertify.success("Dados alterado com sucesso");
</script>

<?php 
    }

}
}

//funcao para anexar img produto
include "funcao.php";


    $produtos = "SELECT * from tb_produto where cl_id = $codProduto ";
    $resultado = mysqli_query($conecta, $produtos);
        if(!$resultado){
            die("Falha na consulta ao banco de dados || tb_produto ");
        }else{
        $linha = mysqli_fetch_assoc($resultado);
        $b_id = $linha["cl_id"];
        $b_imagem = ($linha["cl_imagem"]);
        $b_titulo = ($linha["cl_titulo"]);
        $b_descricao = ($linha["cl_descricao"]);
        $b_fabricante = ($linha["cl_fabricante"]);
        $b_categoria = ($linha["cl_categoria"]);
        $b_ativo = ($linha["cl_ativo"]);
        $b_destaque = ($linha["cl_destaque"]);
        $b_subcategoria = ($linha["cl_subcategoria"]);
        
}
    
    
?>

<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <main>
        <form action="" method="post">

            <table style="margin-right:100px;">
                <div id="titulo">
                    </p>Dadodos do produto</p>
                </div>

            </table>
            <div style="margin:0 auto; width:1400px;display:flex;  ">
                <div style="width: 700px;  ">
                    <table style="float:left; width:300px; ">
                        <tr>
                            <td style="width: 120px;" align="left">Código:</td>
                            <td align=left><input readonly type="text" size="10" id="cammpoProdutoID"
                                    name="cammpoProdutoID" value="<?php echo $b_id; ?>"> </td>
                        </tr>
                    </table>

                    <table style="float:left;">

                        <tr>
                            <td style="width: 120px;" align=left><b>Titulo:</b></td>
                            <td align=left><input type="text" size=30 name="campoTitulo" value="<?php if(isset($_POST['enviar'])){echo $titulo;
                                    }else{
                                        echo $b_titulo;
                                    }?>">
                            </td>
                        </tr>

                        <tr>
                            <td align=left><b>Fabricante:</b></td>
                            <td>
                                <select style="width: 390px; margin-bottom: 5px;" id="campoFabricante"
                                    name="campoFabricante">
                                    <option value="0">Selecione</option>
                                    <?php 
                                    
                                    while($linha_fabricante  = mysqli_fetch_assoc($lista_fabricante)){
                                        $fabricantePrincipal = utf8_encode($linha_fabricante["cl_id"]);
        
                                        if($b_fabricante==$fabricantePrincipal){
                                        ?> <option value="<?php echo utf8_encode($linha_fabricante["cl_id"]);?>"
                                        selected>
                                        <?php echo utf8_encode($linha_fabricante["cl_descricao"]);?>
                                    </option>
                                    <?php
                                    }else{
    
                                ?>
                                    <option value="<?php echo utf8_encode($linha_fabricante["cl_id"]);?>">
                                        <?php echo utf8_encode($linha_fabricante["cl_descricao"]);?>
                                    </option>
                                    <?php

                                    }

                                    }

                                
                   
     ?>

                                </select>

                            </td>

                        </tr>
                        <tr>
                            <td align=left><b>Categoria:</b></td>
                            <td>
                                <select style="width: 390px; margin-bottom: 5px;" id="campoCategoria"
                                    name="campoCategoria">
                                    <option value="0">Selecione</option>
                                    <?php 
                                    while($linha_categoria  = mysqli_fetch_assoc($lista_categoria)){
                                        $categoriaPrincipal = utf8_encode($linha_categoria["cl_id"]);
                                        if($categoriaPrincipal==$b_categoria){
                                        ?> <option value="<?php echo utf8_encode($linha_categoria["cl_id"]);?>"
                                        selected>
                                        <?php echo utf8_encode($linha_categoria["cl_descricao"]);?>
                                    </option>
                                    <?php
                                    }else{
    
                                ?>
                                    <option value="<?php echo utf8_encode($linha_categoria["cl_id"]);?>">
                                        <?php echo utf8_encode($linha_categoria["cl_descricao"]);?>
                                    </option>
                                    <?php

                                    }

                                    }

                                    
                   
     ?>

                                </select>

                            </td>

                        </tr>
                        <tr>
                            <td align=left><b>Sub categoria:</b></td>
                            <td>
                                <select style="width: 390px; margin-bottom: 5px;" id="campoSubcategoria"
                                    name="campoSubcategoria">
                                    <option value="0">Selecione</option>
                                    <?php 
                                    while($linha_subcategoria  = mysqli_fetch_assoc($lista_subcategoria)){
                                        $subcategoriaPrincipal = utf8_encode($linha_subcategoria["cl_id"]);
                                        if($subcategoriaPrincipal==$b_subcategoria){
                                        ?> <option value="<?php echo utf8_encode($linha_subcategoria["cl_id"]);?>"
                                        selected>
                                        <?php echo utf8_encode($linha_subcategoria["cl_descricao"]);?>
                                    </option>
                                    <?php
                                    }else{
    
                                ?>
                                    <option value="<?php echo utf8_encode($linha_subcategoria["cl_id"]);?>">
                                        <?php echo utf8_encode($linha_subcategoria["cl_descricao"]);?>
                                    </option>
                                    <?php
                                    }
                                    }
                                            ?>
                                </select>

                            </td>

                        </tr>


                        <tr>
                            <td style="width: 120px;"><b>Descricao:<b></td>
                            <td><textarea rows=4 cols=60 name="campoDescricao" id="observacao"><?php if(isset($_POST['enviar'])){echo $descricao;
                                    }else{
                                        echo $b_descricao;
                                    }?></textarea>
                            </td>
                        </tr>
                    </table>
                    <table style="float: left; width:100%; margin-right:50px; margin-top:15px;">
                        <tr>
                            <td style="width: 120px;"> <b>Ativo:</b></td>
                            <td> <input type="radio" id="ativo" name="ativo" <?php if($b_ativo == 1){
                            ?> checked <?php
                            };
                            ?> value="1"> Sim
                                <input type="radio" id="ativo" name="ativo" <?php if($b_ativo == 0){
                            ?> checked <?php
                            };
                            ?> value="0"> Não
                            </td>
                        </tr>
                    </table>
                    <table style="float: left; margin-top:15px;">
                        <tr>
                            <td style="width: 120px;"> <b>Destaque:</b></td>
                            <td> <input type="radio" id="destaque" name="destaque" <?php if($b_destaque == 1){
                            ?> checked <?php
                            };
                            ?> value="1"> Sim
                                <input type="radio" id="destaque" name="destaque" <?php if($b_destaque == 0){
                            ?> checked <?php
                            };
                            ?> value="0"> Não
                            </td>
                        </tr>

                    </table>





                    <table style="float: left;">
                        <tr>
                            <div id="botoes">
                                <input type="submit" name=enviar value="Alterar" class="btn btn-info btn-sm"
                                    onClick="return confirm('Confirmar alteração do produto?');"></input></td>


                                <button type="button" name="btnfechar"
                                    onclick="window.opener.location.reload();fechar(); "
                                    class="btn btn-secondary">Voltar</button>

                            </div>
                        </tr>
                    </table>
                </div>

        </form>

        <div style="width: 700px; ">
            <form action="" name="enviar_formulario" method="POST" enctype="multipart/form-data">
                <table id="divisaoTabela">
                    <td>
                        <div id="imgProdutos" style="width:380px;border:1px solid;padding:20px;">
                            <img src=<?php echo $img;?> style="text-align:center;" width="100%">
                            <p
                                style="color:black;text-align:center;margin-top:20px; margin-bottom:0px; font-weight:500px">
                                <?php echo strtoupper($b_titulo);?></p>
                            <input type="file" style="margin-top:50px" name="arquivo" id="file">
                            <ul>
                                <li><input type="submit" value="Upload" id="upload" class="btn-btn-info"
                                        name="enviar_formulario"></li>
                                <li> <input type="submit" value="Excluir" id="excluirImg" class="btn btn-danger"
                                        name="excluirImg"></li>

                            </ul>

                        </div>
                    </td>

                </table>

            </form>


        </div>

        </div>



    </main>


</body>


<script>
function fechar() {
    window.close();
}
</script>

</html>

<?php 
mysqli_close($conecta);
?>