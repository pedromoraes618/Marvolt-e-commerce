<div class="row" id="bloco">
    <div class="container">
        <div class="bloco-principal">
            <div class="titulo">
                <h3>Minha conta</h3>
            </div>
            <div class="bloco-1-1">
                <div class="sub-titulo">
                    <p>Gerenciar e proteger sua conta</p>
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
<script>
//funcao para pesquisar as solicitacoes
var id_cliente_logo = document.getElementById("id_cliente_logo");

function pesquisar(cliente) {
    $.ajax({
        type: 'GET',
        url: "classes/usuario/consulta.php?cliente=" + cliente,
        success: function(result) {
            return $(".result_consultar").html(result);
            
        },
    });
}

//pesquisar as solicitacoes ao carregar a pagina
$(document).ready(function(e) {
    pesquisar(cliente);
});
</script>