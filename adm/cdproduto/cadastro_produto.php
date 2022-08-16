<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include("../alert/alert.php");
include("crud.php");

echo "."; 

//variaveis 
if($_POST){
    $hoje = date('Y-m-d'); 
    $titulo = ($_POST["campoTitulo"]);
    $descricao = ($_POST["campoDescricao"]);
    $fabricante = ($_POST["campoFabricante"]);
    $categoria = ($_POST["campoCategoria"]);
    $subcategoria = ($_POST["campoSubCategoria"]);
    $ativo = ($_POST["ativo"]);
    $destaque = ($_POST["destaque"]);
    if(isset($_POST['enviar']))
    {
      if($titulo==""){
        ?>
<script>
alertify.alert("Favor informar a categoria do produto");
</script>

<?php 
      }elseif($fabricante=="0"){
        ?>
<script>
alertify.alert("Favor informar o fabricante");
</script>

<?php 
      }elseif($categoria=="0"){
          ?>
<script>
alertify.alert("Favor informar a categoria");
</script>

<?php 
        }elseif($subcategoria=="0"){
            ?>
<script>
alertify.alert("Favor informar a Subcategoria do produto");
</script>

<?php 
          }else{
         
  //inserindo as informações no banco de dados
    $inserir = "INSERT INTO tb_produto ";
    $inserir .= "(cl_data_cadastro,cl_descricao,cl_fabricante,cl_categoria,cl_subcategoria,cl_titulo,cl_imagem,cl_destaque,cl_ativo)";
    $inserir .= " VALUES ";
    $inserir .= "( '$hoje','$descricao','$fabricante',' $categoria','$subcategoria','$titulo','img_produto/img-padrao.PNG','$destaque','$ativo')";


    $operacao_inserir = mysqli_query($conecta, $inserir);
    if(!$operacao_inserir){
        die("Erro no banco de dados || operação: insert || table: tb_produto");
        
    }else{
      ?>
<script>
alertify.success("Produto cadastrado com sucesso");
</script>
<?php
    }
    $titulo = "";
    $descricao = "";
    $fabricante = "0";
    $categoria = "0";
    $ativo = "1";
    $destaque ="0";
  }
  
  }
  
}



?>

<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <main>
        <form action="" method="post">

            <table style="margin-right:100px;">
                <div id="titulo">
                    </p>Dadodos do produto</p>
                </div>

            </table>
            <div style="margin:0 auto; width:1400px;display:flex;  ">
                <div style="width: 700px; ">
                    <table style="float:left;  width:300px; ">
                        <tr>
                            <td style="width: 120px;" align="left">Código:</td>
                            <td align=left><input readonly type="text" size="10" id="cammpoProdutoID"
                                    name="cammpoProdutoID" value=""> </td>
                        </tr>
                    </table>

                    <table style="float:left;">

                        <tr>
                            <td style="width: 120px;" align=left><b>Titulo:</b></td>
                            <td align=left><input type="text" size=30 name="campoTitulo"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($titulo);}?>">
                            </td>
                        </tr>


                        <tr>
                            <td align=left><b>Fabricante:</b></td>
                            <td>
                                <select style="width: 350px; margin-bottom: 5px;" id="campoFabricante"
                                    name="campoFabricante">
                                    <option value="0">Selecione</option>
                                    <?php 
                                    
                                    while($linha_fabricante  = mysqli_fetch_assoc($lista_fabricante)){
                                        $fabricantePrincipal = utf8_encode($linha_fabricante["cl_id"]);
                                    if(!isset($fabricante)){
                                    
                                    ?>
                                    <option value="<?php echo utf8_encode($linha_fabricante["cl_id"]);?>">
                                        <?php echo utf8_encode($linha_fabricante["cl_descricao"]);?>
                                    </option>
                                    <?php
   
                                    }else{
                                        if($fabricante==$fabricantePrincipal){
                                        ?> <option value="<?php echo utf8_encode($linha_fabricante["cl_id"]);?>"
                                        selected>
                                        <?php echo utf8_encode($linha_fabricante["cl_descricao"]);?>
                                    </option>
                                    <?php
                                    }else{
    
                                ?>
                                    <option value="<?php echo utf8_encode($linha_fabricante["cl_id"]);?>">
                                        <?php echo utf8_encode($linha_fabricante["cl_descricao"]);?>
                                    </option>
                                    <?php

                                    }

                                    }

                                    }
                   
     ?>

                                </select>

                            </td>

                        </tr>
                        <tr>
                            <td align=left><b>Categoria:</b></td>
                            <td>
                                <select style="width: 350px; margin-bottom: 5px;" id="campoCategoria"
                                    name="campoCategoria">
                                    <option value="0">Selecione</option>
                                    <?php 
                                    
                                    while($linha_categoria  = mysqli_fetch_assoc($lista_categoria)){
                                        $categoriaPrincipal = utf8_encode($linha_categoria["cl_id"]);
                                    if(!isset($categoria)){
                                    
                                    ?>
                                    <option value="<?php echo utf8_encode($linha_categoria["cl_id"]);?>">
                                        <?php echo utf8_encode($linha_categoria["cl_descricao"]);?>
                                    </option>
                                    <?php
   
                                    }else{
                                        if($categoria==$categoriaPrincipal){
                                        ?> <option value="<?php echo utf8_encode($linha_categoria["cl_id"]);?>"
                                        selected>
                                        <?php echo utf8_encode($linha_categoria["cl_descricao"]);?>
                                    </option>
                                    <?php
                                    }else{
    
                                ?>
                                    <option value="<?php echo utf8_encode($linha_categoria["cl_id"]);?>">
                                        <?php echo utf8_encode($linha_categoria["cl_descricao"]);?>
                                    </option>
                                    <?php

                                    }

                                    }

                                    }
                   
     ?>

                                </select>

                            </td>

                        </tr>

                        <tr>
                            <td align=left><b>Sub Categoria:</b></td>
                            <td>
                                <select style="width: 350px; margin-bottom: 5px;" id="campoSubCategoria"
                                    name="campoSubCategoria">
                                    <option value="0">Selecione</option>
                                    <?php 
                                    
                                    while($linha_subcategoria = mysqli_fetch_assoc($lista_subcategoria)){
                                        $subcategoriaPrincipal = utf8_encode($linha_categoria["cl_id"]);
                                    if(!isset($subcategoria)){
                                    
                                    ?>
                                    <option value="<?php echo utf8_encode($linha_subcategoria["cl_id"]);?>">
                                        <?php echo utf8_encode($linha_subcategoria["cl_descricao"]." - ".$linha_subcategoria["categoria_descricao"]);?>
                                    </option>
                                    <?php
   
                                    }else{
                                        if($subcategoria==$subcategoriaPrincipal){
                                        ?> <option value="<?php echo utf8_encode($linha_subcategoria["cl_id"]);?>"
                                        selected>
                                        <?php echo  utf8_encode($linha_subcategoria["cl_descricao"]." - ".$linha_subcategoria["categoria_descricao"]);?>
                                    </option>
                                    <?php
                                    }else{
    
                                ?>
                                    <option value="<?php echo utf8_encode($linha_subcategoria["cl_id"]);?>">
                                        <?php echo utf8_encode($linha_subcategoria["cl_descricao"]." - ".$linha_subcategoria["categoria_descricao"]);?>
                                    </option>
                                    <?php

                                    }

                                    }

                                    }
                   
     ?>

                                </select>

                            </td>

                        </tr>

                        <tr>
                            <td style="width: 120px;"><b>Descricao:<b></td>
                            <td><textarea rows=4 cols=60 name="campoDescricao" id="observacao"><?php if(isset($_POST['enviar'])){echo $descricao;
                                    }?></textarea>
                            </td>
                        </tr>
                    </table>
                    <table style="float: left; width:100%;  margin-right:50px; margin-top:15px;">
                        <tr>
                            <td style="width: 120px;"> <b>Ativo:</b></td>
                            <td> <input type="radio" id="ativo" name="ativo" checked value="1"> Sim
                                <input type="radio" id="ativo" name="ativo" value="0"> Não
                            </td>
                        </tr>
                    </table>
                    <table style="float: left;  margin-top:15px;">
                        <tr>
                            <td style="width: 120px;"> <b>Destaque:</b></td>
                            <td> <input type="radio" id="destaque" name="destaque" value="1"> Sim
                                <input type="radio" id="destaque" name="destaque" value="0" checked> Não
                            </td>
                        </tr>

                    </table>





                    <table style="float: left;">
                        <tr>
                            <div id="botoes">
                                <input type="submit" name=enviar value="Incluir" class="btn btn-info btn-sm"
                                    onClick="return confirm('Confirma o cadastro do produto?');"></input></td>


                                <button type="button" name="btnfechar"
                                    onclick="window.opener.location.reload();fechar(); "
                                    class="btn btn-secondary">Voltar</button>
                            </div>
                        </tr>
                    </table>
                </div>


            </div>


        </form>



    </main>


</body>


<script>
function fechar() {
    window.close();
}
</script>

</html>

<?php 
mysqli_close($conecta);
?>