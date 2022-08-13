<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
//inportar o alertar js
include('../alert/alert.php');

if(isset($_GET['codigo'])){
    $patrimonioID = $_GET['codigo'];
 }

//update
if(isset($_POST['campoDescricao'])){
    $hoje = date('y-m-d');
    $descricao = utf8_decode($_POST['campoDescricao']);
    $qtd = $_POST['campoQtd'];
    $valor =$_POST['campoValor'];
    $total = $valor * $qtd;
            $update = "UPDATE tb_patrimonio set descricao = '{$descricao}', quantidade = '{$qtd}', valor = '{$valor}', total = '{$total}' where patrimonioID = '{$patrimonioID}'  ";
            $operacao_inserir = mysqli_query($conecta, $update);
            if(!$operacao_inserir){
                die("Erro no banco de dados Linha 63 inserir_no_banco_de_dados");
            }
    

}

//delete
if(isset($_GET['deletar'])){
    $id = $_GET['deletar'];
   //query para remover o cliente no banco de dados
   $remover = "DELETE FROM tb_patrimonio WHERE patrimonioID = {$id}";
     $operacao_remover = mysqli_query($conecta, $remover);
     if(!$operacao_remover) {
         die("Erro consulta ao banco de dados ");   
     } 
   
   }

//consultar dados do usuaio no banco de dados 
$select = " SELECT * from tb_patrimonio ";
$select .= " WHERE patrimonioID = '$patrimonioID' ";
$dados_detalhe = mysqli_query($conecta,$select);
if(!$dados_detalhe){
die("Falha na consulta ao banco de dados");
}else{
$linha = mysqli_fetch_assoc($dados_detalhe);
$descricaoB = utf8_encode($linha['descricao']);
$valorB = $linha['valor'];
$qtdB = $linha['quantidade'];
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


            <form id="alterar_patrimonio">
                <table style="float: right; margin-right:100px;">

                    <div id="titulo">
                        </p>Dados do Patrimônio</p>
                    </div>


                </table>

                <div style="width: 600px;">

                    <!--finalizar hidden -->
                    <table style="float:left;">
                        <tr>
                            <td align=left><input type="hidden" size=50 name="campoCodigo" id="campoCodigo"
                                    value="<?php echo $patrimonioID; ?>">
                        </tr>

                        <tr>
                            <td style="width: 90px;" align=left><b>Descrição:</b></td>
                            <td align=left><input type="text" size=50 name="campoDescricao" id="campoDescricao"
                                    value="<?php echo $descricaoB; ?>">
                            </td>
                        </tr>
                    </table>
                    <table style="float:left;">

                        <tr>
                            <td style="width: 90px;" align=left><b>Qtd:</b></td>
                            <td align=left><input type="text" size=10 name="campoQtd" id="campoQtd"
                                    value="<?php echo $qtdB; ?>">
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 90px;" align=left><b>Valor:</b></td>
                            <td align=left><input type="text" size=10 name="campoValor" id="campoValor"
                                    value="<?php echo $valorB; ?>">
                            </td>
                        </tr>
                    </table>

                    <table style="float: left;">
                        <tr>
                            <div style="margin-left:90px;" id="botoes">
                                <input type="submit" name=alterar value="Alterar" class="btn btn-info btn-sm"></input>


                                <button type="button" name="btnfechar"
                                    onclick="window.opener.location.reload();fechar();"
                                    class="btn btn-secondary">Voltar</button>

                                <button id="remover" type="button" name="btnremover" value="Remover"
                                    class="btn btn-danger">Remover</button>

                            </div>
                    </table>
                </div>
            </form>
        </div>


    </main>
</body>
<script src="../jquery/jquery.js"></script>


<script>
//alterar
$('#alterar_patrimonio').submit(function(e) {
    e.preventDefault();
    var descricao = document.getElementById('campoDescricao');
    var qtd = document.getElementById('campoQtd')
    var valor = document.getElementById('campoValor');
    var formulario = $(this);

    if (descricao.value == "") {
        alertify.alert("Favor preencher o campo Descrição");

    } else if (qtd.value == "") {
        alertify.alert("Favor preencher o campo Qtd");
    } else if (valor.valor == "") {
        alertify.alert("Favor preencher o campo Valor");
    } else {
        var retorno = editarPatrimonio(formulario);
        alertify.success("Dados alterados");
    }


});

function editarPatrimonio(dados) {
    $.ajax({
        type: 'POST',
        data: dados.serialize(),
        async: false
    }).then(sucesso, falha)

    function sucesso(data) {
        console.log("ok")
    }

    function falha(data) {
        console.log("erro")
    }

}

//remover
$('#remover').click(function(e) {
    e.preventDefault();
    //var id = $(this).attr("title");
    var id = document.getElementById('campoCodigo').value;
    alertify.confirm("Deseja remover essa patrimônio?.",
        function() {
            alertify.error('Patrimonio Removido');
            $.ajax({
                type: "GET",
                data: "deletar=" + id,
                url: "editar_patrimonio.php",
                async: false
            }).done(function(data) {

            })
        },
        function() {});

});



function fechar() {
    window.close();
}
</script>

</html>

<?php 
mysqli_close($conecta);
?>