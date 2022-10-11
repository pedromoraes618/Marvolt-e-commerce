<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include("../alert/alert.php");
include("crud.php");


echo "."; 


//consulta produto
if(isset($_GET["codigo"])){
    $codigo = $_GET["codigo"];
}

//remover
if(isset($_POST['btnRemover'])){

        $produtos = "SELECT * from tb_produto where cl_categoria = $codigo ";
        $resultado_categoria = mysqli_query($conecta, $produtos);
        if(!$resultado_categoria){
        die("Falha na consulta ao banco de dados || tb_produto ");
        }

        if (mysqli_num_rows($resultado_categoria)>0)
        {
        ?>
<script>
alertify.alert("Não é possivel remover essa categoria, existem produtos que estão registrado nessa categoria");
</script>
<?php 

        }else{

        $select = "DELETE from tb_subcategoria  where cl_id = $codigo ";
        $delete = mysqli_query($conecta, $select);
        if(!$delete){
        die("Falha na consulta ao banco de dados || tb_categirua delete ");
        }else{
        ?>
<script>
alertify.error("Categoria removida com sucesso");
</script>

<?php 
        }
        }
}

//variaveis 
if(isset($_POST['enviar'])){
    $hoje = date('Y-m-d'); 
    $subCategoria = ($_POST["campoSubCategoria"]);
    $categoria = ($_POST['campoCategoria']);
    if($subCategoria==""){
        ?>
<script>
alertify.alert("Favor informar a Subcategoria");
</script>

<?php 
      }elseif($categoria == 0){
        ?>
<script>
alertify.alert("Favor informar a Categoria");
</script>
<?php 
        
      }else{


//update as informações no banco de dados
$update = "UPDATE tb_subcategoria set cl_descricao = '{$subCategoria}'  where cl_id = {$codigo} ";
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


    $produtos = "SELECT * from tb_subcategoria where cl_id = $codigo ";
    $resultado = mysqli_query($conecta, $produtos);
        if(!$resultado){
            die("Falha na consulta ao banco de dados || tb_produto ");
        }else{
        $linha = mysqli_fetch_assoc($resultado);
        $b_id = $linha["cl_id"];
        $b_subCategoria = ($linha["cl_descricao"]);
        $b_categoria = ($linha["cl_categoria"]);
      
        
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
        <form action="" method="post">

            <table style="margin-right:100px;">
                <div id="titulo">
                    </p>Dados da Subcategoria</p>
                </div>

            </table>
            <div class="bloco-dados">
                <div class="form-group ">
                    <label for="exampleInputEmail1">Código</label>

                    <input type="text" size="10" style="width:20%;" readonly class="form-control" id="campoCodigo"
                        placeholder="" value="<?php echo $b_id; ?>">
                </div>
                <div class="form-group">
                    <label for="campoCategoria">Subcategoria *</label>
                    <input type="text" class="form-control" name="campoSubCategoria"
                        placeholder="Informe o nome da subCategoria" value="<?php if(isset($_POST['enviar'])){echo $subCategoria;
                        }else{
                        echo $b_subCategoria;
                        }?>">
                </div>

                <div class="form-group">
                    <label for="campoCategoria">Categoria *</label>
                    <select class="form-control" id="campoCategoria" name="campoCategoria">
                        <option value="0">Selecione</option>
                        <?php 
                                    while($linha_categoria  = mysqli_fetch_assoc($lista_categoria)){
                                        $categoriaPrincipal = ($linha_categoria["cl_id"]);
                                        if($categoriaPrincipal==$b_categoria){
                                        ?> <option value="<?php echo ($linha_categoria["cl_id"]);?>"
                            selected>
                            <?php echo ($linha_categoria["cl_descricao"]);?>
                        </option>
                        <?php
                                    }else{
    
                                ?>
                        <option value="<?php echo ($linha_categoria["cl_id"]);?>">
                            <?php echo ($linha_categoria["cl_descricao"]);?>
                        </option>
                        <?php
                                    }
                                    }
                                            ?>
                    </select>

                </div>

                <div class="form-group row" id="btn-row">
                    <input type="submit" name=enviar value="Alterar" class="btn btn-info btn-sm"
                        onClick="return confirm('Confirmar alteração da Subcategoria?');"></input></td>
                    <button type="button" name="btnfechar" onclick="window.opener.location.reload();fechar(); "
                        class="btn btn-secondary">Voltar</button>
                    <input type="submit" onClick="return confirm('Deseja Remover essa Subcategoria?');" name=btnRemover
                        value="Remover" class="btn btn-danger btn-sm"></input>
                </div>

            </div>

        </form>




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