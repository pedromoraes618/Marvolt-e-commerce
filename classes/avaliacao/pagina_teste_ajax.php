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
             <p id="mensagem"></p>
         </form>
     </div>
 </div>

 <script src="_js/jquery.js"></script>
 <script src="_js/script.js"></script>


 <script>
$('#avaliacao').submit(function(e) {
    e.preventDefault();
    var formulario = $(this);
    var retorno = inserirFormulario(formulario)
});

function inserirFormulario(dados) {
    $.ajax({
        type: "POST",
        data: dados.serialize(),
        url: "crud.php",
        async: false
    }).then(sucesso, falha);

    function sucesso(data) {

        $mensagem = $.parseJSON(data)["mensagem"];
        alertify.alert($mensagem)
        $('#mensagem').show();

        $('#mensagem').html($mensagem);

    }

    function falha() {
        console.log("erro");
    }

}
 </script>