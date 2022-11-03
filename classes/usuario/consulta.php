<?php 
include("../../conexao/conexao.php");
include("../../conexao/sessao.php");
include("../../funcao/script.php");
include("../../crud.php");
//inclundo novamente as pastas de crud e ssão

?>

<div class="tab">
    <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'perfil')">Perfil</button>
    <button class="tablinks" onclick="openCity(event, 'endereco')">Endereço</button>
    <button class="tablinks" onclick="openCity(event, 'senha')">Trocar senha</button>
</div>

<div id="perfil" class="tabcontent">
    <div class="form">
        <div class="form-column">
            <div class="bloco-left">
                <div class="input">
                    <label for="data_entrega_finalizar_pedido">Expectativa de entrega</label>
                    <input type="text" autocomplete="off">
                </div>
                <div class="input">
                    <label for="data_entrega_finalizar_pedido">Expectativa de entrega</label>
                    <input type="text" autocomplete="off">
                </div>
                <div class="input">
                    <label for="data_entrega_finalizar_pedido">Expectativa de entrega</label>
                    <input type="text" autocomplete="off">
                </div>
                <div class="input">
                    <label for="data_entrega_finalizar_pedido">Expectativa de entrega</label>
                    <input type="text" autocomplete="off">
                </div>
                <div class="input">
                    <label for="data_entrega_finalizar_pedido">Expectativa de entrega</label>
                    <input type="text" autocomplete="off">
                </div>
                <div class="input">
                    <label for="data_entrega_finalizar_pedido">Expectativa de entrega</label>
                    <input type="text" autocomplete="off">
                </div>
                <div class="input">
                    <label for="data_entrega_finalizar_pedido">Expectativa de entrega</label>
                    <input type="text" autocomplete="off">
                </div>
                <div class="input">
                    <label for="data_entrega_finalizar_pedido">Expectativa de entrega</label>
                    <input type="text" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="form-column">
            <div class="bloco-right">
                <div class="logo">
                    <img id="img_user" src="img/clientes/<?php echo $b_cliente_logo; ?>">
                </div>
                <div class="upload">
                    <form id="form">
                        <input type="file" id="file-input" name="file-input" />
                        <p>Tamanho do arquivo: no máximo 1 MB<br>Extensão de arquivo: .JPEG, .PNG</p>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>


<div id="endereco" class="tabcontent">teste</div>
<div id="senha" class="tabcontent"></div>

<script>
function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>
<script>
$('#file-input').change(function() {
    $('#form').ajaxForm({
        url: 'classes/usuario/upload.php',
        type: 'post',
        success: function(data) {

            $mensagem = $.parseJSON(data)["alert"];
            $sucesso = $.parseJSON(data)["sucesso"];
            $nome_arquivo = $.parseJSON(data)["name_arquivo"];
            if ($sucesso) {
                $('#img_user').attr('src', "img/clientes/" + $nome_arquivo);
                $.ajax({
                    type: "POST",
                    data: "dirimguser=" + $nome_arquivo + '&clienteid=' + cliente,
                    url: "crud.php",
                    async: false
                });

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: $mensagem,
                    footer: ''
                })
            }


        }
    }).submit();

});
</script>