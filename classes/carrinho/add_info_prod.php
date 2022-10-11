<?php 


?>

<div class="row" id="bloco">
    <div class="container">
        <div class="add-infor-prod">
            <div class="back">
                <a href="JavaScript: window.history.back();">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    Voltar</a>
            </div>
            <div class="prod">
                <div class="img">
                    <img src="<?php echo "adm/classes/produto/".$img;?>">
                </div>
                <p class="titulo"><?php echo $titulo; ?></p>
            </div>
            <hr>
            <div class="form">
                <form id="form_add_info_prod">
                    <input type="hidden" class="form-control" name="id_produto" id="id_produto"
                        value="<?php echo $id_prod; ?>">

                    <div class="form-group">
                        <label for="formGroupExampleInput">Cor</label>
                        <input type="text" class="form-control" name="cor_prod" id="cor_prod"
                            value="<?php echo $cor; ?>" placeholder="Input exemplo">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Tamanho</label>
                        <input type="text" class="form-control" name="tamanho_prod" id="tamanho_prod"
                            value="<?php echo $tamanho; ?>" placeholder="Input exemplo">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Quantidade</label>
                        <input type="number" class="form-control" name="quantidade_prod" id="quantidade_prod"
                            value="<?php echo $quantidade; ?>" placeholder="Input exemplo">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Observação</label>
                        <textarea class="form-control" name="observacao_prod" id="observacao_prod"
                            rows="3"><?php echo $obs; ?></textarea>
                        <div>Essas informações serão registradas no pedido</div>
                    </div>

                    <button type="submit" class="button_enivar">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="_js/jquery.js"></script>
<script src="_js/script.js"></script>

<script>
$(document).ready(function() {
    $("#form_add_info_prod").submit(function(e) {
        e.preventDefault();
        var cor_prod = document.getElementById("cor_prod");
        var tamanho_prod = document.getElementById("tamanho_prod")
        var observacao_prod = document.getElementById("observacao_prod")
        var qtd = document.getElementById("quantidade_prod")
        var formulario = $(this);
        var retorno = cadastar(formulario)

    })
})

function cadastar(dados) {
    $.ajax({
        type: "POST",
        data: dados.serialize(),
        url: "crud.php",
        async: false
    }).then(sucesso, falha);

    function sucesso(data) {
        $mensagem = $.parseJSON(data)["mensagem_1"];
        $sucesso = $.parseJSON(data)["sucesso"];
        if ($sucesso) {
                 Swal.fire(
                'Informações salvas com sucesso!',
                '',
                'success'
            )
        }else{
            alertify.alert($mensagem)
        }

    }

    function falha() {
        console.log("erro");
    }

}
</script>