<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />

<?php
require_once("../../conexao/conexao.php");

include("../../conexao/sessao.php");

$hoje = date('Y-d-m');
echo ".";

//select
$select = " SELECT * from categoria_produto ";
if(isset($_GET['codigo'])){
    $categoriaCodigo = $_GET['codigo'];
    $select .= " WHERE categoriaID = '{$categoriaCodigo}' ";
}

$detalhe = mysqli_query($conecta, $select);
    if(!$detalhe){
        die("Erro no banco de dados ");
        }else{
            $dados_detalhe = mysqli_fetch_assoc($detalhe);
            $categoriaID=  utf8_encode($dados_detalhe['categoriaID']);
            $categoria =  utf8_encode($dados_detalhe['nome_categoria']);
        }
        

//salvar no banco de dados
if(isset($_POST['salvar'])){
    $categoria = $_POST['txtCategoria'];

    if($categoria == "" ){
        ?>
<script>
alertify.alert("Categoria não informada");
</script>
<?php
    }else{
    //inserindo as informações no banco de dados
    $update = "UPDATE categoria_produto SET nome_categoria = '{$categoria}' where categoriaID = '{$categoriaCodigo}'  ";
    $operacao_alterar = mysqli_query($conecta, $update);
    if(!$operacao_alterar) {
        die("Erro na alteracao - banco de dados");   
    } else {  
       
       ?>
<script>
alertify.success("Dados alterados");
</script>
<?php
            
                
        }
    }
        
}

if(isset($_POST['btnremover'])){
   //query para remover o cliente no banco de dados
   $remover = "DELETE FROM categoria_produto WHERE categoriaID = '{$categoriaCodigo}' ";
     $operacao_remover = mysqli_query($conecta, $remover);
     if(!$operacao_remover) {
         die("Erro banco de dados Revover categoria");   
     } else {
        ?>
<script>
alertify.error("Categoria removida com sucesso");
</script>
<?php
         //header("location:listagem.php"); 
          
     }
    }

?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>

<body>
    <div id="titulo">
        </p>Dados Categoria produtos</p>
    </div>
    <main>
        <div style="margin:0 auto; width:700px; float:left ">
            <form action="" method="post">

                <table style="float:left; width:700px;">
                    <div style="width: 700px; ">

                        <tr>
                            <td>
                                <label for="txtcodigo" style="width:115px;"> <b>Código:</b></label>
                                <input readonly type="text" size=10 id="txtcodigo" name="txtcodcliente"
                                    value="<?php echo $categoriaCodigo;?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="txtrazaosocial" style="width:115px;"> <b>Categoria:</b></label>
                                <input type="text" size=55 name="txtCategoria" id="txtCategoria"
                                    value="<?php echo $categoria; ?>">
                            </td>
                        </tr>
                    </div>
                    <tr>

                        <td>
                            <div style="margin-left: 120px;margin-top:10px">
                                <input type="submit" name=salvar value="Alterar" class="btn btn-info btn-sm"></input>

                                <button type="button" onclick="fechar();" class="btn btn-secondary">Voltar</button>

                                <input id="remover" type="submit" name="btnremover" value="Remover"
                                    class="btn btn-danger"
                                    ></input>
                            </div>

                        </td>

                </table>
    </main>
    <script>
    function fechar() {
        window.close();
    }
    </script>
</body>

</html>