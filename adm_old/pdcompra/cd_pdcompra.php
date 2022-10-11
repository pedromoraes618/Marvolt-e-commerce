<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include_once("../_incluir/funcoes.php"); 


//consultar cliente
$select = "SELECT clienteID, razaosocial,nome_fantasia from clientes where clienteFtID = 1 order by nome_fantasia ";
$lista_clientes = mysqli_query($conecta,$select);
if(!$lista_clientes){
    die("Falaha no banco de dados || select clientes");
}

//consultar status do pedido
$select = "SELECT statuspedidoID, nome from status_pedido";
$lista_statuspedido = mysqli_query($conecta,$select);
if(!$lista_statuspedido){
    die("Falaha no banco de dados || select statuspedido");
}

//consultar status da compra
$select = "SELECT statuscompraID, nome from status_compra";
$lista_statuscompra = mysqli_query($conecta,$select);
if(!$lista_statuscompra){
    die("Falaha no banco de dados || select statuscompra");
}

//consultar forma de pagamento
$select = "SELECT formapagamentoID, nome, statuspagamento from forma_pagamento";
$lista_formapagamemto = mysqli_query($conecta,$select);
if(!$lista_formapagamemto){
    die("Falaha no banco de dados || select formapagma");
}
        



?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="../alert/css/alertify.css" rel="stylesheet">
    <link href="../alert/css/alertify.min.css" rel="stylesheet">
    <link href="../alert/css/themes/default.min.css" rel="stylesheet">

    <?php 
    include("../classes/select2/select2_link.php")
    ?>

    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>

</head>

<body>
    <div id="titulo">
        </p>Lançamento de pedido de compra </p>
    </div>

    <main>
        <form id="inserir_pedido">
            <div id="status"></div>
            <main>
                <div style="margin:0 auto; width:1400px; ">
                    <table style="float:left; width:1400px; margin-bottom: 10px; border:1px solid;">
                        <table style="float:right;">
                            <td align=left> <button type="button" style="width:120px" name="iniciar" id="iniciar"
                                    class="btn btn-info btn-sm">Iniciar pedido</button>

                                <button type="submit" id="salvar" name="salvar"
                                    onclick="calculavalordescontoReais();calculavalormargemGeral();"
                                    class="btn btn-success">Finalizar</button>

                                <button type="button" name="btnfechar"
                                    onclick="window.opener.location.reload();fechar();"
                                    class="btn btn-secondary">Voltar</button>
                            </td>
                        </table>
                        <tr>
                            <td>
                                <label for="txtcodigo" style="width:100px;"> <b>Código:</b></label>
                                <input readonly type="text" size=10 id="txtcodigo" name="txtcodigo" value="<?php ?>">
                            </td>
                        </tr>
                    </table>

                    <table style="float:left; width:1400px; margin-bottom: 10px;border-bottom:1px solid #ddd;  ">
                        <tr>
                            <td>
                                <label for="txtNumeroPedido" style="width:100px;"> <b>Nº Pedido:</b></label>
                                <input type="text" size=10 id="txtNumeroPedido" name="txtNumeroPedido" value="">

                                <label for="txtNumeroOrcamento"> <b>Nº Orçamento:</b></label>
                                <input type="text" size=10 id="txtNumeroOrcamento" name="txtNumeroOrcamento" value="">

                                <label for="txtNumeroNfe"> <b>Nº Nfe:</b></label>
                                <input type="text" size=10 id="txtNumeroNfe" name="txtNumeroNfe" value="<?php ?>">


                                <label for="txtFormaPagamento"><b>Forma do pagamento:</b></label>
                                <select style="width: 205px; margin-right:24px;" id="campoFormaPagamento"
                                    name="campoFormaPagamento">
                                    <option value="0">Selecione</option>

                                    <?php 
                                while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                                    $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);
                
                                ?>
                                    <option
                                        value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                        <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                    </option>
                                    <?php

                                    }       

         ?>

                                </select>
                                <label for="txtDataFechamento"> <b>D.Fch:</b></label>
                                <input type="text" size=12 id="txtDataFechamento" name="txtDataFechamento" value=""
                                    OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                            </td>
                        </tr>



                    </table>
                    <table style="float:left; width:650px; margin-bottom:10px">

                        <tr>
                            <td>
                                <label for="txtCliente" style="width:100px;"> <b>Empresa:</b></label>
                                <select style="margin-right: 60px; margin-bottom:10px; width:480px;" id="campoCliente"
                                    name="txtCliente">
                                    <option value="0">Selecione</option>


                                    <?php 
                                while($linha_clientes  = mysqli_fetch_assoc($lista_clientes)){
                                    $clientePrincipal = utf8_encode($linha_clientes["clienteID"]);
                                 
                                   ?>
                                    <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>">
                                        <?php echo utf8_encode($linha_clientes["nome_fantasia"]);?>
                                    </option>
                                    <?php
       
               }
               
           
                         ?>

                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="txtNumeroOrcamento" style="width:100px;"> <b>Produto</b></label>
                                <input type="text" size=35 id="txtProduto" name="txtProduto" value="<?php ?>">




                                <button type="submit" style="width:80px" name="adicionar" id="adicionar"
                                    class="btn btn-success" value="Add">Add</button>


                            </td>

                        </tr>
                        <tr>
                            <td>
                                <label for="txtUnidade" style="width:100px;"> <b>Und</b></label>
                                <input type="text" size=10 id="txtUnidade" name="txtUnidade" value="<?php ?>">
                                <label for="txtQuantidade" style="width: 100px;"><b>Quantidade</b></label>
                                <input type="text" size=10 id="txtQuantidade" name="txtQuantidade" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="txtprecoUnitarioCompra" style="width:100px;"><b>Preco CP</b></label>
                                <input type="text" size=10 id="txtprecoUnitarioCompra" name="txtprecoUnitarioCompra"
                                    onblur="calculavalormargem()" value="<?php ?>">
                                <label for="txtprecoUnitarioVenda" style="width:100px;"><b>Preco VND</b></label>
                                <input type="text" size=10 id="txtprecoUnitarioVenda" name="txtprecoUnitarioVenda"
                                    onblur="calculavalormargem()" value="<?php ?>">

                        </tr>
                        <tr>
                            <td>
                                <label for="txtMargem" style="width:100px;"><b>Margem</b></label>
                                <input type="text" size=10 id="txtMargem" name="txtMargem" value="<?php ?>">


                                <input type="hidden" size=10 id="txtDesconto" name="txtDesconto" value="<?php ?>">

                        </tr>


                    </table>

                    <table style="float:left; width:750px;">

                        <tr>
                            <td>
                                <label for="txtStatusCompra" style="width:150px;"> <b>Status da
                                        compra:</b></label>
                                <select style="margin-right: 40px;" id="txtStatusCompra" name="txtStatusCompra">
                                    <option value="0">Selecione</option>
                                    <?php 
                                while($linha_statusCompra  = mysqli_fetch_assoc($lista_statuscompra)){
                                    $statusCompraPrincipal = utf8_encode($linha_statusCompra["statuscompraID"]);
                                 
                                   ?>
                                    <option value="<?php echo utf8_encode($linha_statusCompra["statuscompraID"]);?>">
                                        <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                                    </option>
                                    <?php
            
                }
                
                         ?>

                                </select>

                                <label for="txtDataDaCompra" style="width: 150px;"> <b>Data da
                                        compra:</b></label>
                                <input type="text" size=12 id="txtDataDaCompra" name="txtDataDaCompra" value="<?php ?>"
                                    OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">


                            </td>

                        </tr>

                    </table>
                    <table style="float:right; width:750px;">

                        <tr>
                            <td>

                                <label for="txtDataChegadaPrevista" style="width:150px;"> <b>Chegada
                                        prevista:</b></label>
                                <input type="text" style="margin-right:100px;" size=12 id="txtDataChegadaPrevista"
                                    name="txtDataChegadaPrevista" value="<?php ?>" OnKeyUp="mascaraData(this);"
                                    maxlength="10" autocomplete="off">

                                <label for="txtDataChegada" style="width:150px;"> <b>Data
                                        Chegada:</b></label>
                                <input type="text" size=12 id="txtDataChegada" name="txtDataChegada" value=""
                                    OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                            </td>
                        </tr>

                    </table>
                    <table style="float:right; width:750px; margin-bottom: 40px;">

                        <tr>
                            <td>
                                <label for="txtEntregaPrevista" style="width:150px; "> <b>Entrega
                                        Prevista:</b></label>
                                <input type="text" style="margin-right:100px;" size=12 id="txtEntregaPrevista"
                                    name="txtEntregaPrevista" value="" OnKeyUp="mascaraData(this);" maxlength="10"
                                    autocomplete="off">

                                <label for="txtEntregaRealizada" style="width:150px;"> <b>Entrega
                                        Realizada:</b></label>
                                <input type="text" size=12 id="txtEntregaRealizada" name="txtEntregaRealizada" value=""
                                    OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                            </td>
                        </tr>

                    </table>

                    <table style=" width:800px; margin-left:400 ">
                        <tr>
                            <td>
                                <div style="width:600px">
                                    <div>

                                        <input type="hidden" size=10 id="txtDescontoGeral" name="txtDescontoGeral"
                                            value="<?php ?>">

                                        <label for="txtDescontoGeralReais" style="width:85px;"> <b>Desc
                                                R$:</b></label>
                                        <input type="text" size=10 id="txtDescontoGeralReais"
                                            onblur="calculavalordescontoReais();calculavalormargemGeral();"
                                            name="txtDescontoGeralReais" value="">


                                        <label for="txtValorTotalComDesconto" style="width:85px; "> <b>Vlr
                                                total:</b></label>
                                        <input type="text" size=10 id="txtValorTotalComDesconto"
                                            name="txtValorTotalComDesconto" value="">

                                        <input type="hidden" size=5 id="txtValorTotal" name="txtValorTotal" value="">

                                        <input type="hidden" size=5 id="txtValorTotalCompra" name="txtValorTotalCompra"
                                            value="">

                                        <input type="hidden" size=5 id="txtValorMargem" name="txtValorMargem" value="<?php
                                            
                                    ?>">


                                        <button type="button" style="float: right; margin-top:10px"
                                            onclick="calculavalordescontoReais();calculavalormargemGeral();"
                                            name="fecharPesquisa" class="btn btn-danger">Atualizar</button>


                                    </div>
                                </div>
                        </tr>
                        </td>

                    </table>
                </div>
            </main>
        </form>
</body>
<?php include '../_incluir/funcaojavascript.jar'; ?>
<?php include '../classes/select2/select2_java.php'; ?>
<script src="../jquery/jquery.js"></script>
<script src="../alert/alertify.min.js"></script>

<script>
var codigo = document.getElementById('txtcodigo');

$('button#iniciar').click(function() {
    var gerarN = Math.floor(Math.random() * 80005536);
    codigo.value = gerarN;
});



$('#inserir_pedido').submit(function(e) {
    e.preventDefault();

});


//remover
$('#adicionar').click(function(e) {
    var txt
    console.log("clicado")
    e.preventDefault();
    var formulario = $(this);
    alert(formulario.serialize());
    var retorno = adicionarProduto(formulario);

});

function adicionarProduto(dados) {
    $.ajax({
        type: "POST",
        data: dados.serialize(),
        url: "adicionar_produto.php",
        async: false
    }).then(sucesso, falha)

    function sucesso(data) {
        console.log(data)
    }

    function falha(data) {
        console.log("erro")
    }

}

















function fechar() {
    window.close();
}

function calculavalormargem() {
    var campoPrecoVenda = document.getElementById("txtprecoUnitarioVenda").value;
    var campoPrecoCompra = document.getElementById("txtprecoUnitarioCompra").value;
    var campoMargem = document.getElementById("txtMargem");
    var calculo;

    campoPrecoVenda = parseFloat(campoPrecoVenda);
    campoPrecoCompra = parseFloat(campoPrecoCompra);

    calculo = (((campoPrecoVenda - campoPrecoCompra) / campoPrecoVenda) * 100).toFixed(2);
    campoMargem.value = calculo;
}

function calculavalormargemGeral() {
    var campoPrecoVenda = document.getElementById("txtValorTotalComDesconto").value;
    var campoPrecoCompra = document.getElementById("txtValorTotalCompra").value;
    var campoMargem = document.getElementById("txtValorMargem");
    var calculo;

    campoPrecoVenda = parseFloat(campoPrecoVenda);
    campoPrecoCompra = parseFloat(campoPrecoCompra);

    calculo = (((campoPrecoVenda - campoPrecoCompra) / campoPrecoVenda) * 100).toFixed(2);
    campoMargem.value = calculo;
}

function calculavalordesconto() {
    var campoDesconto = document.getElementById("txtDescontoGeral").value;
    var campoValorTotalH = document.getElementById("txtValorTotal").value;
    var campoDescontoReais = document.getElementById("txtDescontoGeralReais");
    var campoValorTotal = document.getElementById("txtValorTotalComDesconto");

    var calculoDesconto;
    var calculoTotalCDesconto;
    var calculoTotalCDescontoReais;

    campoValorTotalH = parseFloat(campoValorTotalH);
    campoDesconto = parseFloat(campoDesconto);

    calculoDesconto = ((campoValorTotalH * campoDesconto) / 100);
    calculoTotalCDesconto = (campoValorTotalH - calculoDesconto).toFixed(2);
    calculoTotalCDescontoReais = (campoValorTotalH - calculoTotalCDesconto).toFixed(2);
    campoValorTotal.value = calculoTotalCDesconto;
    campoDescontoReais.value = calculoTotalCDescontoReais;

}

function calculavalordescontoReais() {
    var campoDesconto = document.getElementById("txtDescontoGeral");
    var campoValorTotalH = document.getElementById("txtValorTotal").value;
    var campoDescontoReais = document.getElementById("txtDescontoGeralReais").value;
    var campoValorTotal = document.getElementById("txtValorTotalComDesconto");

    var calculoValorTotal;
    var calculoTotalCDescontoReais;

    campoValorTotalH = parseFloat(campoValorTotalH);
    campoDescontoReais = parseFloat(campoDescontoReais);

    calculoValorTotal = (campoValorTotalH - campoDescontoReais);
    calculoTotalCDescontoReais = ((campoDescontoReais / campoValorTotalH) * 100).toFixed(2);
    campoValorTotal.value = calculoValorTotal;
    campoDesconto.value = calculoTotalCDescontoReais;

}
</script>


</body>

</html>

<?php
mysqli_close($conecta);
?>