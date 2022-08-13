<?php

include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
//inportar o alertar js
include('../alert/alert.php');

        
//update
if(isset($_POST['campoDescricao'])){
    $hoje = date('y-m-d');
    $descricao = utf8_decode($_POST['campoDescricao']);
    $qtd = $_POST['campoQtd'];
    $valor =$_POST['campoValor'];
    $total = $valor * $qtd;
        //inserindo as informações no banco de dados
            $inserir = "INSERT INTO tb_patrimonio ";
            $inserir .= "(data_cadastro,descricao,quanstidade,valor,total)";
            $inserir .= " VALUES ";
            $inserir .= "('$hoje','$descricao','$qtd','$valor','$total' )";
            $operacao_inserir = mysqli_query($conecta, $inserir);
            if(!$operacao_inserir){
               echo "erro";
            
            }else{
                echo "ok";
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
</head>

<body>
    <main>

        <div style="margin:0 auto; width:1100px; ">
            <form id="adicionar_patrimonio" autocomplete="off">
                <table style="float: right; margin-right:100px;">
                    <div id="titulo">
                        </p>Cadastro de Patrimônio</p>
                    </div>


                </table>


                <div style="width: 600px;">

                    <!--finalizar hidden -->
                    <table style="float:left;">

                        <tr>
                            <td style="width: 90px;" align=left><b>Descrição:</b></td>
                            <td align=left><input type="text" size=50 name="campoDescricao" id="campoDescricao"
                                    value="">
                            </td>
                        </tr>
                    </table>
                    <table style="float:left;">

                        <tr>
                            <td style="width: 90px;" align=left><b>Qtd:</b></td>
                            <td align=left><input type="text" size=10 name="campoQtd" id="campoQtd" value="">
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 90px;" align=left><b>Valor:</b></td>
                            <td align=left><input type="text" size=10 name="campoValor" id="campoValor" value="">
                            </td>

                        </tr>
                    </table>



                    <table style="float: left;">
                        <tr>
                            <div style="margin-left:90px;" id="botoes">
                                <input type="submit" name=enviar value="Incluir" class="btn btn-info btn-sm"></input>


                                <button type="button" name="btnfechar"
                                    onclick="window.opener.location.reload();fechar();"
                                    class="btn btn-secondary">Voltar</button>



                            </div>
                    </table>



                </div>
            </form>
        </div>




    </main>
</body>
<script src="../jquery/jquery.js"></script>


<script>
$('#adicionar_patrimonio').submit(function(e) {
    var descricao = document.getElementById('campoDescricao');
    var qtd = document.getElementById('campoQtd')
    var valor = document.getElementById('campoValor');
    e.preventDefault();
    var formulario = $(this);

    if (descricao.value == "") {
        alertify.alert("Favor preencher o campo Descrição");

    } else if (qtd.value == "") {
        alertify.alert("Favor preencher o campo Qtd");
    } else if (valor.valor == "") {
        alertify.alert("Favor preencher o campo Valor");
    } else {
        var retorno = adicionarPatrimonio(formulario);
        alertify.success("Patrimômio cadastrado com sucesso");
        descricao.value = "";
        qtd.value = "";
        valor.value = "";
    }


});

function adicionarPatrimonio(dados) {
    $.ajax({
        type: 'POST',
        data: dados.serialize(),
        async: false
    }).then(sucesso, falha)
    function sucesso(data) {
        
    }

    function falha(data) {
        console.log("erro")
    }


}



function fechar() {
    window.close();
}
</script>

</html>

<?php 
mysqli_close($conecta);
?>