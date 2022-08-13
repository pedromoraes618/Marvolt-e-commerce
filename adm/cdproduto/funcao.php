<?php

include("../conexao/conexao.php");
function anexarArquivoImg($novoNome,$pasta,$codProduto){
    include("../conexao/conexao.php");
    $update = "UPDATE tb_produto set cl_imagem = '$pasta$novoNome'  where cl_id = {$codProduto} ";
    $operacao_update = mysqli_query($conecta, $update);
    if(!$operacao_update){
        die("Erro no banco de dados || Inserir o diretorio no banco de dados");
    }

}

//funcão para excluir a imagem
function excluirImg($codProduto){
    include("../conexao/conexao.php");
    $remover = "UPDATE tb_produto set cl_imagem = ''  where cl_id = {$codProduto} ";
    $operacao_remover = mysqli_query($conecta, $remover);
    if(!$operacao_remover){
        die("Erro no banco de dados || excluir imagem || tb_produto || cl_imagem");
    }else{
        ?>
<script>
alertify.error("Imagem removida com sucesso");
</script>
<?php 
    }

}



if(isset($_POST['enviar_formulario'])){
    $codProduto = $_GET["codigo"];
    $formatosPermitidos = array("png","PNG","jpeg","jpg","gif","webp");
    $extensao = pathinfo($_FILES['arquivo']['name'],PATHINFO_EXTENSION);

    if(in_array($extensao,$formatosPermitidos)){
        $pasta = "img_produto/";
        $temporario = $_FILES['arquivo']['tmp_name'];
        $novoNome = uniqid().".".$extensao;
        $nome = ($_FILES['arquivo']['name']);

        if(move_uploaded_file($temporario,$pasta.$novoNome)){
            //incliur no banco de dados
            anexarArquivoImg($novoNome,$pasta,$codProduto);
            ?>
<script>
alertify.success("Uplop efetuado com sucesso");
</script>
<?php

        }else{
            ?>
<script>
alertify.error("Não foi possivel fazer o Upload");
</script>
<?php
        }
        
    }else{
        ?>
<script>
alertify.error("Arquivo com formato invalido");
</script>
<?php
    }
}

if(isset($_POST['excluirImg'])){
    excluirImg($codProduto);
}

//consultando o diretorio da imagem
$select = "SELECT * from tb_produto where cl_id = $codProduto ";
$operacao_select = mysqli_query($conecta, $select);
if(!$operacao_select){
    die("Erro no banco de dados || select no diretorio do anexo no banco de dados");
}else{
    $linha = mysqli_fetch_assoc($operacao_select);
    $img = $linha['cl_imagem'];
    $b_titulo = $linha['cl_titulo'];

}
