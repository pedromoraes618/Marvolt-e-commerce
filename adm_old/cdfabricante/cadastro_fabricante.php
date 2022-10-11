<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include("../alert/alert.php");
include("crud.php");

echo "."; 

//variaveis 
if($_POST){
    $fabricante = ($_POST["campoFabricante"]);
 
    if(isset($_POST['enviar']))
    {
      if($fabricante==""){
        ?>
<script>
alertify.alert("Favor informar o Fabricante");
</script>

<?php 
      }else{

  //inserindo as informações no banco de dados
    $inserir = "INSERT INTO tb_fabricante ";
    $inserir .= "( cl_descricao )";
    $inserir .= " VALUES ";
    $inserir .= "( '$fabricante')";


    $operacao_inserir = mysqli_query($conecta, $inserir);
    if(!$operacao_inserir){
        die("Erro no banco de dados || operação: insert || table: tb_fabricante");
        
    }else{
      ?>
<script>
alertify.success("Fabricante cadastrado com sucesso");
</script>
<?php
    }

    $fabricante = "";


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
                    </p>Dados do Fabricante</p>
                </div>

            </table>
            <div class="bloco-dados">
                <div class="form-group ">
                    <label for="exampleInputEmail1">Código</label>

                    <input type="text" size="10" style="width:20%;" readonly class="form-control" id="campoCodigo"
                        placeholder="">
                </div>
                <div class="form-group">
                    <label for="campoFabricante">Fabricante *</label>
                    <input type="text" class="form-control" name="campoFabricante"
                        placeholder="Informe o nome do Fabricante" value="<?php if(isset($_POST['enviar'])){echo $fabricante;
                        }?>">
                </div>

           
                <div class="form-group row" id="btn-row">
                    <input type="submit" name=enviar value="Incluir" class="btn btn-info btn-sm"
                        onClick="return confirm('Confirma o cadastro do Fabricante?');"></input>

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