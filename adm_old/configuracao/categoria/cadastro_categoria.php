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

$hoje = date('Y-m-d');
echo ".";


if(isset($_POST['enviar'])){
    $categoria = $_POST['txtCategoria'];

    if($categoria == "" ){
        ?>
<script>
alertify.alert("Categoria não informada");
</script>
<?php
    }else{
    //inserindo as informações no banco de dados
    $inserir = "INSERT INTO categoria_produto ";
    $inserir .= "(data_cadastro, nome_categoria)";
    $inserir .= " VALUES ";
    $inserir .= "('$hoje', '$categoria' )";

    $categoria = "";
    $operacao_inserir = mysqli_query($conecta, $inserir);
    if(!$operacao_inserir){
        die("Erro no banco de dados ");
        }

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
        </p>Cadastro Categoria produtos</p>
    </div>
    <main>
        <div style="margin:0 auto; width:700px; float:left ">
            <form action="" method="post">

                <table style="float:left; width:700px;">
                    <div style="width: 700px; ">

                        <tr>
                            <td>
                                <label for="txtcodigo" style="width:115px;"> <b>Código:</b></label>
                                <input readonly type="text" size=10 id="txtcodigo" name="txtcodcliente" value="">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="txtrazaosocial" style="width:115px;"> <b>Categoria:</b></label>
                                <input type="text" size=55 name="txtCategoria" id="txtCategoria"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($categoria);}?>">
                            </td>
                        </tr>
                    </div>
                    <tr>

                        <td>
                            <div style="margin-left: 120px;margin-top:10px">
                                <input type="submit" name=enviar value="Incluir" class="btn btn-info btn-sm"
                                    onClick="return confirm('Confirmar o cadastro da categoria?');"></input>

                                <button type="button" onclick="fechar();" class="btn btn-secondary">Voltar</button>
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