<?php 
if(isset($_GET['incfor'])){
    if(!empty($_GET['id'])){
        $id_prod = $_GET['id'];

     
    }else{
        include "classes/erro/404.php";
    }
}


if(isset($_POST['cor_prod'])){
    $cor_prod = $_POST['cor_prod'];
    $tamanho_prod = $_POST['tamanho_prod'];
    $obs_prod = $_POST['observacao_prod'];
    $quantidade = $_POST['quantidade_prod'];
    $alterar = "UPDATE tb_carrinho set cl_produto_cor = '{$cor_prod}', cl_produto_tamanho = '{$tamanho_prod}',cl_produto_obs = '{$obs_prod}',cl_quantidade='{$quantidade}' where cl_id = $id_prod";
    $operacao_inserir = mysqli_query($conecta, $alterar);
        if(!$operacao_inserir){
            include "classes/erro/504.php";
        }
    }

//consultar tabela produto 
$select = "SELECT f.cl_descricao as fabricante, c.cl_quantidade as quantidade, c.cl_produto_cor as cor,c.cl_produto_tamanho as tamanho, c.cl_produto_obs as obs, c.cl_sessao, c.cl_id, p.cl_titulo as titulo, p.cl_imagem as imagem from tb_carrinho as c
inner join tb_produto as p on p.cl_id = c.cl_produtoID inner join tb_fabricante as f on f.cl_id = p.cl_fabricante  where c.cl_id = $id_prod ";
$resultado_prod_infor = mysqli_query($conecta, $select);
if(!$resultado_prod_infor){
   include "classes/erro/504.php";
}else{
    $linha = mysqli_fetch_assoc($resultado_prod_infor);
    $img = $linha['imagem'];
    $titulo = $linha['titulo'];
    $cor = $linha['cor'];
    $tamanho = $linha['tamanho'];
    $obs = $linha['obs'];
    $quantidade = $linha['quantidade'];
}



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
                <img src="<?php echo "adm/cdproduto/".$img;?>">
                <p class="titulo"><?php echo $titulo; ?></p>
            </div>
            <hr>
            <div class="form">
                <form id="form_add_info_prod">
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

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="_js/jquery.js"></script>
<script src="_js/bootstrap.min.js"></script>
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
        if (qtd.value == "") {
            alertify.alert("Quantidade não foi informada");
        } else {
            var retorno = cadastar(formulario)
        }

    })

})

function cadastar(dados) {
    $.ajax({
        type: "POST",
        data: dados.serialize(),
        async: false,
    }).then(sucesso, falha)

    function sucesso(data) {
        alertify.success("Informações salvas com sucesso!")
    }

    function falha(data) {
        console.log("erro")
    }
}
</script>