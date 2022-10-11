 <div id="bloco-avaliacao">
     <div class="back">
         <a href="JavaScript: window.history.back();">
             <i class="fa-solid fa-circle-arrow-left"></i>
             Voltar</a>
     </div>
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

$("#avaliacao").submit(function(e) {
    e.preventDefault(); //evito o submit do form ao apetar o enter..
    titulo = document.getElementById("titulo_avaliacao");
    descricao = document.getElementById("descricao_avaliacao");
    id_cliente = document.getElementById("id_cliente_avaliacao");
    id_produto = document.getElementById("id_produto_avaliacao");
    var formulario = $(this);
    var retorno = enviarAvaliacao(formulario);



    //alertify.success("Muito obrigado por avaliar o produto!");

})

function enviarAvaliacao(dados) {
    $.ajax({
        type: "POST",
        data: dados.serialize(),
        url: "crud.php",
        async: false
    }).then(sucesso, falha);

    function sucesso(data) {

        $mensagem = $.parseJSON(data)["mensagem"];
        $sucesso = $.parseJSON(data)["sucesso"];

  
        if ($sucesso) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Obrigado por avaliar o produto',
                showConfirmButton: false,
                timer: 1500
            })

            descricao.value = "";
            titulo.value = "";
        }else{
            alertify.alert($mensagem)
        }
    }

    function falha() {
        console.log("erro");
    }

}
 </script>