<?php 
if(isset($_GET['cds'])){
    $codigo = $_GET['cds'];
    echo "<input type='hidden' id='codigo' value='$codigo'>";
}
?>
<div class="row" id="bloco">
    <div class="container">
        <div class="bloco-solicitacao">
            <div class="bloco-solicitacao">
                <h3>Solicitação</h3>
            </div>

            <div id="pedidos-solicitacao">
                wdsd
            </div>
        </div>
    </div>
</div>



<script>
let codigo = document.getElementById("codigo").value
Swal.fire(
    'Pedido finalizado! Codigo da sua solicitacao ' + codigo,
    'A equipe da marvolt entrara em contato com voçê via email para a confirmação da situação dos produtos',
    'success'
)
</script>