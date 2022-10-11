<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include("../alert/alert.php");
include("crud.php");

echo "."; 

//pegar o ultimo a id e soma mais um

$select = "SELECT * FROM tb_embalagem ORDER BY cl_id DESC LIMIT 1 ";
$query_id = mysqli_query($conecta,$select);
if(!$query_id){
    die("Erro tb_produtp query id");
}else{
    $linha = mysqli_fetch_assoc($query_id);
    $id =  1 + $linha['cl_id'];
}

//variaveis 
if($_POST){
    $hoje = date('Y-m-d'); 
    $embalagem = ($_POST['campoEmbalagem']);
 
    if(isset($_POST['enviar']))
    {
 if($embalagem=="" ){ ?>
<script>
alertify.alert("Favor informar a Embalagem");
</script>
<?php 
      }else{

  //inserindo as informações no banco de dados
    $inserir = "INSERT INTO tb_embalagem ";
    $inserir .= "(cl_descricao)";
    $inserir .= " VALUES ";
    $inserir .= "( '$embalagem')";


    $operacao_inserir = mysqli_query($conecta, $inserir);
    if(!$operacao_inserir){
        die("Erro no banco de dados || operação: insert || table: tb_embalagem");
        
    }else{
      ?>
<script>
alertify.success("Embalagem cadastrada com sucesso");
</script>
<?php
    }
    $embalagem = "";

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
                    </p>Dados da Subcategorria</p>
                </div>

            </table>
            <div class="bloco-dados">
                <div class="form-group ">
                    <label for="exampleInputEmail1">Código</label>

                    <input type="text" size="10" style="width:20%;" readonly class="form-control" id="campoCodigo"
                        placeholder="" value="<?php echo $id; ?>" >
                </div>
                <div class="form-group">
                    <label for="campoCategoria">Embalagem *</label>
                    <input type="text" class="form-control" name="campoEmbalagem"
                        placeholder="Informe o nome da subcategoria" value="<?php if(isset($_POST['enviar'])){echo $embalagem;
                        }?>">
                </div>


                <div class="form-group row" id="btn-row">
                    <input type="submit" name=enviar value="Incluir" class="btn btn-info btn-sm"
                        onClick="return confirm('Confirma o cadastro da Embalagem?');"></input>

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