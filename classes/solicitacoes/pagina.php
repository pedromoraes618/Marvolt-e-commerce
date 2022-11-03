<?php 
if(isset($_GET['cds'])){
    $codigo = $_GET['cds'];
    echo "<input type='hidden' id='codigo' value='$codigo'>";
}elseif(isset($_GET['slc'])){

}
?>
<div class="row" id="bloco">
    <div class="container">
        <div class="bloco-principal">
            <div class="titulo">
                <h3>Solicitação</h3>
            </div>
            <div class="bloco-1-1">
                <div class="sub-titulo">
                    <p>Minhas solicitações</p>
                </div>
                <div class="form-solicitacao">
                    <div class="cx-pesquisa-solicitacao">
                        <input type="text" name="buscar" id="buscar_slc"
                            placeholder="Tente pesquisar por Nº Solicitação / Data de envio">
                        <button class="img-pesquisar glyphicon glyphicon-search">
                    </div>
                </div>
            </div>


            <div id="bloco-sub-principal">
                <div class="bloco-info">
                    <div class="result_consultar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="_js/jquery.js"></script>
<script src="_js/script.js"></script>


<script>
var codigo = document.getElementById("codigo").value
var pesquisa = document.getElementById("buscar_slc")

//funcao para pesquisar as solicitacoes
function pesquisar(cliente) {
    $.ajax({
        type: 'GET',
        url: "classes/solicitacoes/consulta.php?slc&cliente=" + cliente,
        success: function(result) {
            return $(".result_consultar").html(result);
        },
    });
}

//pesquisar as solicitacoes ao fazer a buscar pelo campo buscar
$('.cx-pesquisa-solicitacao button').click(function(e) {
    e.preventDefault();
    $.ajax({
        type: 'GET',
        url: "classes/solicitacoes/consulta.php?slc&cliente=" + cliente + "&buscar=" + pesquisa.value,
        success: function(result) {
            $(".result_consultar").html(result);
        },
    });
})

//pesquisar as solicitacoes ao carregar a pagina
$(document).ready(function(e) {
    pesquisar(cliente);
});

$(document).ready(function(e) {
    //verificar se a solicitação foi finalizar
    $.ajax({
        type: "POST",
        data: "cds=" + codigo,
        url: "crud.php",
        async: false
    }).then(sucesso, falha);
    function sucesso(data) {
        $sucesso = $.parseJSON(data)["sucesso"];
        $verifcar = $.parseJSON(data)["verificar"];
        if ($sucesso) {

            if ($verifcar) {
                Swal.fire(
                    'Pedido finalizado! Codigo da sua solicitação ' + codigo,
                    'A equipe da marvolt entrara em contato com voçê via email para a confirmação da situação dos produtos',
                    'success'
                )
                $.ajax({
                    type: "POST",
                    data: "verifica=" + codigo,
                    url: "crud.php",
                    async: false
                }).then(sucesso, falha);

                function sucesso(data) {
                    console.log("ok")
                }

                function falha(data) {
                    console.log("falha")
                }

            }


        }

    }

    function falha(data) {
        console.log("erro")
    }

})
</script>