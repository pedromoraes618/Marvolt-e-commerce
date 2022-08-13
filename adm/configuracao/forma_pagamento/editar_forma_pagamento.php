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
    $codigoID = ($_GET['codigo']);
}



if(isset($_POST['enviar'])){
    $descricao = utf8_decode($_POST['txtFormaPagamento']);
    $banco = utf8_decode($_POST['txtBanco']);


    if($descricao == "" ){
        ?>
<script>
alertify.alert("Forma de pagamento não informada");
</script>
<?php
    }elseif(!isset($_POST['status'])){
        ?>
<script>
alertify.alert("Favor informar o status");
</script>
<?php
    }else{
    $status =utf8_decode($_POST['status']);
    //inserindo as informações no banco de dados
    $update = "UPDATE forma_pagamento set nome = '{$descricao}', banco = '{$banco}', statuspagamento = '{$status}'  where formapagamentoID = '{$codigoID}'  ";
    $operacao_update = mysqli_query($conecta,$update);
    if(!$operacao_update){
        die("Erro no banco de dados || update na tabela forma_pagamento ");
        }else{
            ?>
<script>
alertify.success("Dados alterado com sucesso");
</script>
<?php
        }

    }
        
}


$select = "SELECT * FROM forma_pagamento where formapagamentoID = '$codigoID'";
$operacao_select = mysqli_query($conecta, $select);
if($operacao_select){
    $linha = mysqli_fetch_assoc($operacao_select);
    $fomaPagamentoID = $linha['formapagamentoID'];
    $formaPagamentoB = utf8_encode($linha['nome']);
    $bancoB = utf8_encode($linha['banco']);
    $statusB = $linha['statuspagamento'];
}else{
    die("Erro no banco de dados");
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
        </p>Dados Forma de Pagamento</p>
    </div>
    <main>
        <div style="margin:0 auto; width:700px; float:left ">
            <form action="" method="post">

                <table style="float:left; width:700px;">
                    <div style="width: 700px; ">

                        <tr>
                            <td>
                                <label for="txtCodigo" style="width:115px;"> <b>Código:</b></label>
                                <input readonly type="text" size=10 id="txtCodigo" name="txtCodigo"
                                    value="<?php echo $codigoID;?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="txtFormaPagamento" style="width:115px;"> <b>Forma de Pagamento:</b></label>
                                <input type="text" size=50 name="txtFormaPagamento" id="txtFormaPagamento"
                                    value="<?php echo $formaPagamentoB;?>">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="txtBanco" style="width:115px; "> <b>Banco:</b></label>
                                <input type="text" style="margin-bottom:20px" size=20 name="txtBanco" id="txtBanco"
                                    value="<?php echo $bancoB;?>">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="txtStatus" style="width:115px;"> <b>Status:</b></label>
                                <input type="radio" name="status" value="A RECEBER" <?php if($statusB == "A RECEBER"){
                                ?> checked <?php
                                } ?>> A Receber
                                <input type="radio" name="status" value="RECEBIDO" <?php if($statusB == "RECEBIDO"){
                                ?> checked <?php
                                } ?>> Recebido


                            </td>
                        </tr>
                    </div>
                    <tr>

                        <td>
                            <div style="margin-left: 120px;margin-top:10px">
                                <input type="submit" name=enviar value="Alterar" class="btn btn-info btn-sm"></input>

                                <button type="button" onclick="window.opener.location.reload();fechar();"
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