<?php
include("../conexao/conexao.php");
if(isset($_GET['codigo'])){
    $codigo = $_GET['codigo'];
    $remover = "DELETE FROM lancamento_financeiro WHERE lancamentoFinanceiroID = '$codigo' ";
    $operacao_remover = mysqli_query($conecta, $remover);
    if(!$operacao_remover) {
         die("Erro na tabela || tb_anexo_nfe_saida");   
    } else {
        ?>
<script>
alertify.error("Anexo Removida com sucesso");
</script>
<?php
    }        
    
}
    