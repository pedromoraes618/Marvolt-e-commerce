<?php 
include("../../conexao/conexao.php");
include("../../funcao/script.php");
?>

<div class="tab">
    <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'solicitacao')">Solicitações</button>
    <button class="tablinks" onclick="openCity(event, 'cancelado')">Solicitações canceladas</button>
</div>

<div id="solicitacao" class="tabcontent">
    <?php
if(isset($_GET['slc'])){
    $cliente = $_GET['cliente'];
    $select = "SELECT * FROM tb_pedido ";
    if(isset($_GET['buscar'])){
        $pesquisa = $_GET['buscar'];
        $select .= " where cl_cliente = $cliente and cl_codigo like '%{$pesquisa}%' and cl_status = 1 or  cl_status = 2 or cl_status = 3 order by cl_data desc" ;
    }else{
        $select .= " WHERE cl_cliente = $cliente AND cl_status = 1 or  cl_status = 2 or cl_status = 3 order by cl_data desc ";
    }
    $operacao_consulta_pedido = mysqli_query($conecta, $select);

while($linha = mysqli_fetch_assoc($operacao_consulta_pedido)){
    $codigo_solicitacao = $linha['cl_codigo'];
    $data_envio = formatDateB($linha['cl_data']);
    $id = $linha['cl_id'];
    $sessao = $linha['cl_sessao'];
?>
    <div class="bloco-cnj-solicitacao">
        <nav>
            <ul>
                <li>
                    Solicitação Nº: <b><?php echo $codigo_solicitacao; ?></b>

                </li>

                <li>Data de envio: <?php echo $data_envio ?></li>

                <li>Status: <?php echo "Em analise"; ?></li>
                <li><a href="" numero_soli="<?php echo $codigo_solicitacao;?>" id="solicitacao_id"
                        id_solicitacao="<?php echo $id;?>">Cancelar Solcitação</a></li>
            </ul>
        </nav>
        <div class="btn-gerar-doc">
            <div class="btn-1">
                <a  target="blanck" href="classes/solicitacoes/gerar_pdf.php?gerarSolicitacao=true&sessao=<?php echo $sessao; ?>&idPedido=<?php echo $id;?>">
                    Gerar pdf <i class="fa-solid fa-file-pdf"></i>
                </a>

            </div>
            <div class="btn-1">
                <a>
                    Gerar Csv <i class="fa-solid fa-file-csv"></i>
                </a>
            </div>
        </div>

    </div>


    <?php
};
}
?>

</div>
<div id="cancelado" class="tabcontent">
    <?php
if(isset($_GET['slc'])){
    $cliente = $_GET['cliente'];
    $select = "SELECT * FROM tb_pedido ";
    if(isset($_GET['buscar'])){
        $pesquisa = $_GET['buscar'];
        $select .= " where cl_cliente = $cliente and cl_codigo like '%{$pesquisa}%' and cl_status = 4 order by cl_data desc ";
    }else{
        $select .= " WHERE cl_cliente = $cliente AND  cl_status = 4 order by cl_data desc";
    }
    $operacao_consulta_pedido_cancelado = mysqli_query($conecta, $select);

while($linha = mysqli_fetch_assoc($operacao_consulta_pedido_cancelado)){
    $codigo_solicitacao_c = $linha['cl_codigo'];
    $id = $linha['cl_id'];
    $data_envio_c = formatDateB($linha['cl_data']);
?>
    <div class="bloco-cnj-solicitacao">
        <div class="cancelado_text">
            Cancelado
        </div>
        <nav>
            <ul>
                <li>
                    Solicitação Nº: <b><?php echo $codigo_solicitacao_c; ?></b>
                </li>

                <li>Data de envio: <?php echo $data_envio_c ?></li>
                <li>Status: <?php echo "Em analise"; ?></li>
                <li><a href="" id="reativarSoliticao" numero_soli="<?php echo $codigo_solicitacao_c;?>" id_solicitacao="<?php echo $id; ?> ">Reativar Solicitação</a></li>
            </ul>
        </nav>
        <div class="btn-gerar-doc">
            <div class="btn-1">
                <a href="">
                    Gerar pdf <i class="fa-solid fa-file-pdf"></i>
                </a>

            </div>
            <div class="btn-1">
                <a>
                    Gerar Csv <i class="fa-solid fa-file-csv"></i>
                </a>
            </div>
        </div>

    </div>


    <?php
};
}
?>

</div>

<script>
//cancelar o pedido
$(".bloco-cnj-solicitacao #solicitacao_id").click(function(e) {
    e.preventDefault()
    var idSolicitacao = $(this).attr("id_solicitacao");
    var numeroSolicitacao = $(this).attr("numero_soli");


    Swal.fire({
        title: 'Tem certeza?',
        text: "Deseja Cancelar a Solicitação nº " + numeroSolicitacao,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Não',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                data: "acaoSl=cancelar&idSolicitacao=" + idSolicitacao,
                url: "crud.php",
                async: false
            }).then(sucesso, falha);

            function sucesso(data) {
                $sucesso = $.parseJSON(data)["sucesso"];
                if ($sucesso) {
                    Swal.fire(
                        'Cancelado!',
                        'Solicitação Cancelada com suscesso.',
                        'success'
                    )
                    pesquisar(cliente);
                    // $(".qtd-carrinho").html($qtdcar);
                    // $(".qtd_itens").html("Quantidades de itens: " + $qtdcar);
                }
            }

            function falha() {
                $.ajax({
                    type: "POST",
                    data: "erroLog=erro_cancelar_solicitacao",
                    url: "crud.php",
                    async: false
                }).then(sucesso, falha);
            }
        }
    })
})

//Reativar
$(".bloco-cnj-solicitacao #reativarSoliticao").click(function(e) {
    e.preventDefault()
    var idSolicitacao = $(this).attr("id_solicitacao");
    var numeroSolicitacao = $(this).attr("numero_soli");
    Swal.fire({
        title: 'Tem certeza?',
        text: "Deseja Reativar a Solicitação nº " + numeroSolicitacao,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Não',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                data: "acaoSl=reativar&idSolicitacao=" + idSolicitacao,
                url: "crud.php",
                async: false
            }).then(sucesso, falha);

            function sucesso(data) {
                $sucesso = $.parseJSON(data)["sucesso"];
                if ($sucesso) {
                    Swal.fire(
                        'Reativado!',
                        'Solicitação Reativada com suscesso. Entre em contato com a equipe da marvolt ',
                        'success'
                    )
                    pesquisar(cliente);
                    // $(".qtd-carrinho").html($qtdcar);
                    // $(".qtd_itens").html("Quantidades de itens: " + $qtdcar);
                }
            }

            function falha() {
                $.ajax({
                    type: "POST",
                    data: "erroLog=erro_reativar_solicitacao",
                    url: "crud.php",
                    async: false
                }).then(sucesso, falha);
            }
        }
    })



})


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