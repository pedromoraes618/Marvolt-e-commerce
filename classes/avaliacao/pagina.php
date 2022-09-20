 <div class="back">
        <a href="JavaScript: window.history.back();">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Voltar</a>
    </div>
<div id="bloco-avaliacao">
   
    <div class="formulario">

        <div class="titulo">
            <p>O que achou do produto: <?php echo $_GET['desc'];   ?></p>
        </div>
        <form id="avaliacao">
            <input type="hidden" name="id_produto_avaliacao" id="id_produto_avaliacao"
                value="<?php echo $_GET['addavalicao'];?>">
            <input type="hidden" name="id_cliente_avaliacao" id="id_cliente_avaliacao"
                value="<?php echo $b_id_cliente?>">
            <input type="text" name="titulo_avaliacao" id="titulo_avaliacao" placeholder="Titulo *">
            <textarea type="text" name="descricao_avaliacao" id="descricao_avaliacao"
                placeholder="Seu comentario *"></textarea>
            <button class="button_enivar" type="submit">Enviar</button>

        </form>
    </div>
</div>

<script src="_js/jquery.js"></script>
<script src="_js/script.js"></script>
<script>
//receber
$(document).ready(function() {
    $("#avaliacao").submit(function(e) {
        e.preventDefault(); //evito o submit do form ao apetar o enter..
        titulo = document.getElementById("titulo_avaliacao");
        descricao = document.getElementById("descricao_avaliacao");
        id_cliente = document.getElementById("id_cliente_avaliacao");
        id_produto = document.getElementById("id_produto_avaliacao");
        var formulario = $(this);

        if (titulo.value == "") {
            alertify.alert("Campo Titulo não foi preechindo");

        } else if (descricao.value == "") {
            alertify.alert("Campo Descrição não foi preechindo");
        } else {
            var retorno = enviarAvaliacao(formulario);
            descricao.value = "";
            titulo.value = "";
            alertify.success("Muito obrigado por avaliar o produto!");

        }
    })
});

function enviarAvaliacao(dados) {
    $.ajax({
        type: "POST",
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
</script>