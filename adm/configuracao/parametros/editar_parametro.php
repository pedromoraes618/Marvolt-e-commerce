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

if(isset($_GET['codigo'])){
$parametroID = $_GET['codigo'];
}
//salvar no banco de dados
if(isset($_POST['salvar'])){
    $valor = $_POST['txtValor'];

    if($valor == "" ){
        ?>
<script>
alertify.alert("O valor não foi informado");
</script>
<?php
    }else{
    //inserindo as informações no banco de dados
    $update = "UPDATE tb_parametros SET valor = '{$valor}' where parametroID = '{$parametroID}'  ";
    $operacao_alterar = mysqli_query($conecta, $update);
    if(!$operacao_alterar) {
        die("Erro na alteracao - banco de dados");   
    } else {  
       
       ?>
<script>
alertify.success("Parametro alterado");
</script>
<?php
            
                
        }
    }
        
}

//select
$select = " SELECT * from tb_parametros ";
$select .= " WHERE parametroID = '{$parametroID}' ";
$detalhe = mysqli_query($conecta, $select);
    if(!$detalhe){
        die("Erro no banco de dados ");
        }else{
            $dados_detalhe = mysqli_fetch_assoc($detalhe);
            $parametroIDB=  utf8_encode($dados_detalhe['parametroID']);
            $descricaoB =  utf8_encode($dados_detalhe['descricao']);
            $valorB =  utf8_encode($dados_detalhe['valor']);

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
        </p>Dados Parâmetro</p>
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
                                    value="<?php echo $parametroIDB;?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="txtDescricao" style="width:115px;"> <b>Descricao:</b></label>
                                <input type="text" size=55 name="txtDescricao" id="txtDescricao" readonly
                                    value="<?php echo $descricaoB; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="txtValor" style="width:115px;"> <b>Valor:</b></label>
                                <input type="text" size=20 name="txtValor" id="txtValor" value="<?php echo $valorB; ?>">
                            </td>
                        </tr>
                    </div>
                    <tr>

                        <td>
                            <div style="margin-left: 120px;margin-top:10px">
                                <input type="submit" name=salvar value="Salvar" class="btn btn-info btn-sm"></input>

                                <button type="button" onclick="window.opener.location.reload();fechar();"
                                    onClick="return confirm('Deseja alterar esse parâmetro?');"
                                    class="btn btn-secondary">Voltar</button>


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