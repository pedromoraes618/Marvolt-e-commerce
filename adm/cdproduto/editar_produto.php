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


//remover
if(isset($_POST['btnRemoverProd'])){
    $select = "DELETE from tb_produto  where cl_id = $codProduto ";
    $delete = mysqli_query($conecta, $select);
    if(!$delete){
        die("Falha na consulta ao banco de dados || tb_produto delete ");
    }else{
        ?>
<script>
alertify.error("Produto removido com sucesso");
</script>

<?php 
    }
}




//variaveis 
if(isset($_POST['enviar'])){
    $hoje = date('Y-m-d'); 
    $titulo = ($_POST["campoTitulo"]);
    $descricao = ($_POST["campoDescricao"]);
    $fabricante = ($_POST["campoFabricante"]);
    $ativo = ($_POST["ativo"]);
    $destaque = ($_POST["destaque"]);
    $subcategoria = ($_POST["campoSubCategoria"]);
    $cdg_produto = $_POST['campoCodigoProduto'];
    $modelo = $_POST['campoModelo'];
    $embalagem = $_POST['campoEmbalagem'];
    $valor = $_POST['campoValor'];
    $disponivel = $_POST['campoDisponivel'];
    if($titulo==""){
        ?>
<script>
alertify.alert("Favor informar O Titulo do produto");
</script>

<?php 
      }elseif($fabricante=="0"){
        ?>
<script>
alertify.alert("Favor informar o fabricante");
</script>

<?php 
      }elseif($embalagem=="0"){
        ?>
<script>
alertify.alert("Favor informar a embalagem do produto");
</script>

<?php 
      }elseif($subcategoria=="0"){
        ?>
<script>
alertify.alert("Favor informar a Subcategoria do produto");
</script>

<?php 
      }elseif($disponivel=="s"){
        ?>
<script>
alertify.alert("Favor informar se o produto está disponivel");
</script>

<?php 
      }else{
//pegar o id da categoria
 $select = "SELECT s.cl_id, s.cl_descricao as subcategoria,s.cl_categoria as id_categoria, c.cl_descricao as categoria_descricao from tb_subcategoria as s inner join 
 tb_categoria as c on c.cl_id = s.cl_categoria where s.cl_id = $subcategoria";
 $lista_id_categoria = mysqli_query($conecta,$select);
 if(!$lista_id_categoria){
 die("Falaha no banco de dados");
 }else{
     $linha = mysqli_fetch_assoc($lista_id_categoria);
     $id_categoria =$linha['id_categoria'];
 }


//update as informações no banco de dados
$update = "UPDATE tb_produto set cl_titulo = '{$titulo}',cl_descricao = '{$descricao}',cl_fabricante = '{$fabricante}',cl_categoria = '{$id_categoria}'
,cl_ativo = '{$ativo}', cl_destaque = '{$destaque}',cl_subcategoria = '{$subcategoria}',cl_modelo = '{$modelo}',cl_codigo = '{$cdg_produto}',cl_embalagem = '{$embalagem}',
cl_disponivel = '{$disponivel}',cl_valor = '{$valor}'
where cl_id = {$codProduto} ";
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
        $b_cdg_produto = $linha['cl_codigo'];
        $b_modelo = $linha['cl_modelo'];
        $b_embalagem = $linha['cl_embalagem'];
        $b_valor = $linha['cl_valor'];
        $b_disponivel = $linha['cl_disponivel'];
        
}
    
    

?>

<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <?php 
    include("../classes/select2/select2_link.php")
    ?>
</head>

<body>
    <main>


        <table style="margin-right:100px;">
            <div id="titulo">
                </p>Dados do produto</p>
            </div>

        </table>

        <div class="dados-container">
            <form action="" method="post" style="margin:0 auto;">
                <div class="bloco-dados" style="width: 80%;">
                    <div class="form-group ">
                        <label for="campoCodigo">Código</label>
                        <input type="text" size="10" style="width:20%;" readonly class="form-control" id="campoCodigo"
                            placeholder="" value="<?php echo $b_id; ?>">
                    </div>
                    <div class="form-group">
                        <label for="campoTitulo">Titulo *</label>
                        <input type="text" class="form-control" name="campoTitulo" id="campoTitulo" value="<?php if(isset($_POST['enviar'])){echo $titulo;
                                    }else{
                                        echo $b_titulo;
                                    }?>">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="campoFabricante">Fabricante*</label>
                            <select class="form-control" id="campoFabricante" name="campoFabricante">
                                <option value="0">Selecione</option>
                                <?php 
                                    
                                    while($linha_fabricante  = mysqli_fetch_assoc($lista_fabricante)){
                                        $fabricantePrincipal = ($linha_fabricante["cl_id"]);
        
                                        if($b_fabricante==$fabricantePrincipal){
                                        ?> <option value="<?php echo ($linha_fabricante["cl_id"]);?>" selected>
                                    <?php echo ($linha_fabricante["cl_descricao"]);?>
                                </option>
                                <?php
                                    }else{
    
                                ?>
                                <option value="<?php echo ($linha_fabricante["cl_id"]);?>">
                                    <?php echo ($linha_fabricante["cl_descricao"]);?>
                                </option>
                                <?php

                                    }

                                    }

                                
                   
     ?>

                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="campoSubCategoria">Sub/Categoria *</label>
                            <select class="form-control" id="campoSubCategoria" name="campoSubCategoria">
                                <option value="0">Selecione</option>
                                <?php 
                                    while($linha_subcategoria  = mysqli_fetch_assoc($lista_subcategoria)){
                                        $subcategoriaPrincipal = ($linha_subcategoria["cl_id"]);
                                        if($subcategoriaPrincipal==$b_subcategoria){
                                        ?> <option value="<?php echo ($linha_subcategoria["cl_id"]);?>" selected>
                                    <?php echo ($linha_subcategoria["cl_descricao"]." - ".$linha_subcategoria["categoria_descricao"]);?>
                                </option>
                                <?php
                                    }else{
    
                                ?>
                                <option value="<?php echo ($linha_subcategoria["cl_id"]);?>">
                                    <?php echo ($linha_subcategoria["cl_descricao"]." - ".$linha_subcategoria["categoria_descricao"]);?>
                                </option>
                                <?php
                                    }
                                    }
                                            ?>
                            </select>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="campoEmbalagem">Embalagem *</label>
                            <select class="form-control" id="campoEmbalagem" name="campoEmbalagem">
                                <option value="0">Selecione</option>
                                <?php 
                                    while($linha  = mysqli_fetch_assoc($lista_embalagem)){
                                        $embalagePrincipal = ($linha["cl_id"]);
                                        if($embalagePrincipal==$b_embalagem){
                                        ?> <option value="<?php echo ($linha["cl_id"]);?>" selected>
                                    <?php echo ($linha["cl_descricao"]);?>
                                </option>
                                <?php
                                    }else{
    
                                ?>
                                <option value="<?php echo ($linha["cl_id"]);?>">
                                    <?php echo ($linha["cl_descricao"]);?>
                                </option>
                                <?php
                                    }
                                    }
                                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="campoCodigoProduto">Código Produto:</label>
                            <input type="text" class="form-control col" size=40 name="campoCodigoProduto" value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($cdg_produto);
                            }
                                    else{
                                        echo $b_cdg_produto;
                                    }?>">
                        </div>

                        <div class="form-group">
                            <label for="campoCodigoProduto">Modelo</label>
                            <input type="text" name="campoModelo" class="form-control col" value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($modelo);}else{
                                        echo $b_modelo;
                                    }?>">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="campoDisponivel">Disponivel *</label>
                            <select class="form-control" id="campoDisponivel" name="campoDisponivel">
                                <option value="s">Selecione</option>
                                <option value="1" <?php if($b_disponivel == 1){
                                    echo 'selected';
                                } ?>>
                                    Sim
                                </option>
                                <option value="0" <?php if($b_disponivel == 0){
                                    echo 'selected';
                                } ?>>
                                    Não
                                </option>


                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="campoValor">Valor</label>
                            <input type="text" onkeypress="return onlynumber();" name="campoValor"
                                class="form-control col" value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($valor);}else{
                                        echo $b_valor;
                                    }?>"">
                    </div>

                </div>
                <div class=" form-group">
                            <label for="validationTextarea">Descrição</label>
                            <textarea class="form-control" id="campoDescricao" name="campoDescricao"
                                placeholder="Informe a descrição do produto"><?php if(isset($_POST['enviar'])){echo $descricao;
                                    }else{
                                        echo $b_descricao;
                                    }?></textarea>

                        </div>



                        <div class="form-group">
                            <label style="margin-right:10px ;">Ativo</label>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="ativo" <?php if($b_ativo == 1){
                            ?> checked <?php
                            };
                            ?> value="1" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">Sim</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" <?php if($b_ativo == 0){
                            ?> checked <?php
                            };
                            ?> name="ativo" value="0" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">Não</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="margin-right:10px ;">Destaque</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline3" name="destaque" <?php if($b_destaque == 1){
                            ?> checked <?php
                            };
                            ?> value="1" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline3">Sim</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline4" name="destaque" <?php if($b_destaque == 0){
                            ?> checked <?php
                            };
                            ?> value="0" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline4">Não</label>
                            </div>
                        </div>

                        <div class="form-group row" id="btn-row">
                            <input type="submit" name=enviar value="Alterar" class="btn btn-info btn-sm"
                                onClick="return confirm('Confirmar a alteração do produto?');"></input>

                            <button type="button" name="btnfechar" onclick="window.opener.location.reload();fechar(); "
                                class="btn btn-secondary">Voltar</button>

                            <input type="submit" onClick="return confirm('Deseja Remover essa Produto??');"
                                name="btnRemoverProd" value="Remover" class="btn btn-danger btn-sm"></input>

                        </div>
                    </div>
            </form>
            <div style=" margin:0 auto;">
                <form action="" name="enviar_formulario" class="enviar_formulario" method="POST"
                    enctype="multipart/form-data">
                    <table id="divisaoTabela">
                        <td>
                            <div id="imgProdutos" style="width:380px;border:1px solid;padding:20px;">
                                <div style="padding:10px; height:350px ;border:1px solid;">
                                    <img src=<?php echo $img;?> width="300px" style="padding:60px; text-align:center; ">
                                </div>
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
<?php include '../classes/select2/select2_java.php'; ?>


<script>
function fechar() {
    window.close();
}
</script>

</html>

<?php 
mysqli_close($conecta);
?>