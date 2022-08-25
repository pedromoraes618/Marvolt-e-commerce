<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include("../alert/alert.php");
include("crud.php");

echo "."; 

//variaveis 
if($_POST){
    $hoje = date('Y-m-d'); 
    $categoria = ($_POST["campoCategoria"]);
 
    if(isset($_POST['enviar']))
    {
      if($categoria==""){
        ?>
<script>
alertify.alert("Favor informar a Categoria");
</script>

<?php 
      }else{

  //inserindo as informações no banco de dados
    $inserir = "INSERT INTO tb_categoria ";
    $inserir .= "(cl_descricao)";
    $inserir .= " VALUES ";
    $inserir .= "( '$categoria')";


    $operacao_inserir = mysqli_query($conecta, $inserir);
    if(!$operacao_inserir){
        die("Erro no banco de dados || operação: insert || table: tb_categoria");
        
    }else{
      ?>
<script>
alertify.success("Categoria cadastrada com sucesso");
</script>
<?php
    }

    $descricao = "";

  }
  
  }
  
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
                    </p>Dadodos da Categoria</p>
                </div>

            </table>
            <div class="bloco-dados">
                <div class="form-group ">
                    <label for="exampleInputEmail1">Código</label>

                    <input type="text" size="10" style="width:20%;" readonly class="form-control" id="campoCodigo"
                        placeholder="">
                </div>
                <div class="form-group">
                    <label for="campoCategoria">Categoria *</label>
                    <input type="text" class="form-control" name="campoCategoria" id="campoCategoria"
                        placeholder="Informe o nome da categoria"
                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($categoria);}?>">
                </div>

                <div class="form-group row" id="btn-row">
                    <input type="submit" name=enviar value="Incluir" class="btn btn-info btn-sm"
                        onClick="return confirm('Confirma o cadastro da Categoria?');"></input>

                    <button type="button" name="btnfechar" onclick="window.opener.location.reload();fechar(); "
                        class="btn btn-secondary">Voltar</button>

                </div>
            </div>
        </form>



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