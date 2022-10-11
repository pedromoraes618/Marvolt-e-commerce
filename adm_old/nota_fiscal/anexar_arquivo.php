<?php

include("../conexao/sessao.php");
include("../conexao/conexao.php");
//inportar o alertar js
include('../alert/alert.php');

if(isset($_GET['codigo'])){
    $codigo = $_GET['codigo'];
}


//funcao para anexar o inserir as informacoes no banco de dados
function anexarArquivoNfe($nome,$codigo,$pasta){
    include("../conexao/conexao.php");
    $insert = "INSERT INTO tb_anexo_nfe_saida ";
    $insert .= "( descricao,numero_nf,diretorio )";
    $insert .= " VALUES ";
    $insert .= "( '$nome','$codigo','$pasta$nome' )";
    $operacao_insert = mysqli_query($conecta, $insert);
    if(!$operacao_insert){
        die("Erro no banco de dados || Inserir o diretorio no banco de dados");
    }

}


if(isset($_GET['deletar'])){
    $codigo = $_GET['deletar'];
    $remover = "DELETE FROM tb_anexo_nfe_saida WHERE anexoID = '$codigo' ";
    $operacao_remover = mysqli_query($conecta, $remover);
    if(!$operacao_remover) {
         die("Erro na tabela || tb_anexo_nfe_saida");   
    }      
    
}


if(isset($_POST['enviar_formulario'])){
    $formatosPermitidos = array("png","jpeg","jpg","pdf","gif","xml");
    $extensao = pathinfo($_FILES['arquivo']['name'],PATHINFO_EXTENSION);

    if(in_array($extensao,$formatosPermitidos)){
        $pasta = "anexos/";
        $temporario = $_FILES['arquivo']['tmp_name'];
        $nome = ($_FILES['arquivo']['name']);

        if(move_uploaded_file($temporario,$pasta.$nome)){
            //incliur no banco de dados
            anexarArquivoNfe($nome,$codigo,$pasta);
            ?>
<script>
alertify.sucess("Uplop efetuado com sucesso");
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

//select no banco de dados
if(isset($_GET['codigo']) or isset($_POST['enviar_formulario'])){
    $select = "SELECT * from tb_anexo_nfe_saida where numero_nf = '$codigo'";
    $operacao_select = mysqli_query($conecta, $select);
    if(!$operacao_select){
        die("Erro no banco de dados || select no diretorio do anexo no banco de dados");
    }
}


    

?>



<!doctype html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilo -->
    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include_once("../_incluir/funcoes.php"); ?>
    <main>
        <div style="margin:0 auto; width:1400px; ">


            <table>
                <div id="titulo">
                    </p>Anexar arquivos</p>

                    <form method="POST" enctype="multipart/form-data">
                        <tr>
                            <td>
                                <input type="file" name="arquivo" id="file">
                                <input type="submit" value="Upload" id="upload" class="btn-btn-info"
                                    name="enviar_formulario">


                            </td>


                            <td align=left> <button type="button" name="btnfechar" onclick="window.close()"
                                    class="btn btn-secondary">Voltar</button>
                            </td>
                        </tr>

                        <form action="" method="get">
                            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa"
                                style="margin-top:50px ;">
                                <tbody>
                                    <tr id="cabecalho_pesquisa_consulta">
                                        <td>
                                            <font size="3" style="margin-left:20px">
                                                Descrição
                                            </font>
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <?php   
                                
                                if(isset($_GET['codigo']) or isset($_POST['enviar_formulario'])){
                                    
                                while($linha = mysqli_fetch_assoc($operacao_select)){
                                    $anexoID = $linha['anexoID'];
                                    $descricao = $linha['descricao'];
                                    $diretorio = $linha['diretorio'];

                                ?>

                                    <tr id="linha_pesquisa">

                                        <td>
                                            <p style="margin-top:10px; width:800px;">
                                                <font size="3" style="margin-left:20px;"><?php echo $descricao;?>
                                                </font>
                                            </p>
                                        </td>
                                        <td>
                                            <a target="blank" href="<?php echo $diretorio;?>">
                                                <img src="../images/imagem.png" width="40px"></a>
                                        </td>

                                        <form>
                                            <td>
                                                <a href="" class="excluir" title="<?php echo $anexoID ?>"><button
                                                        type="button" class="btn btn-danger">Remover</button></a>



                                            </td>

                                    </tr>



                                    <?php

 }}?>
                </div>
            </table>
        </div>
    </main>
    <script src="../jquery.js"></script>
    <script>
    $('td a.excluir').click(function(e) {
        e.preventDefault();
        var id = $(this).attr("title");
        var elemento = $(this).parent().parent();
        $(elemento).fadeOut();
        alertify.success("Anexo removido com sucesso!")
        $.ajax({
            type: "GET",
            data: "deletar=" + id,
            url: "anexar_arquivo.php",
            async: false
        }).done(function(data) {

        })
       
    });
    </script>

</body>



</html>