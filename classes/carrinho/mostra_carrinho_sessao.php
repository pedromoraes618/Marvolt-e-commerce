

<?php 

if($_GET['acao'] == 'del'){
    $id = intval($_GET['id']);
    if(isset($_SESSION['carrinho'][$id])){
        unset($_SESSION['carrinho'][$id]);
    }
}

foreach($_SESSION['carrinho'] as $cd_prod => $qtn){
    $select = "SELECT * FROM tb_produto where cl_id = $cd_prod ";
    $operacao_select = mysqli_query($conecta,$select);
    if(!$operacao_select){
        die("Falha na consulta ao banco de dados || tb_produto");
    }else{
        $linha = mysqli_fetch_assoc($operacao_select);
        $cd_prod = ($linha['cl_id']);
        $titulo_prod = ($linha['cl_titulo']);
    }
?>
<div class="produto">
    <p>ID <?PHP echo $cd_prod; ?></p>
    <p>Titulo <?PHP echo $titulo_prod; ?></p>
    <a href="?acao=del&id=<?php echo $cd_prod; ?>">Remover</a>
</div>
<?php 
}
?>