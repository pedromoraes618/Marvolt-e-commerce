<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include("../alert/alert.php");
include("crud.php");
include ("../_incluir/funcoes.php");
echo "."; 

$select = "SELECT MAX(cl_id) as max_id_produto from tb_produto";
$query_id = mysqli_query($conecta,$select);
if(!$query_id){
    die("Erro tb_produtp query id");
}else{
    $linha = mysqli_fetch_assoc($query_id);
    $id_produto =  1 + $linha['max_id_produto'];
}

//variaveis 
if($_POST){
    $hoje = date('Y-m-d'); 
    $titulo = ($_POST["campoTitulo"]);
    $descricao = ($_POST["campoDescricao"]);
    $fabricante = ($_POST["campoFabricante"]);
    $subcategoria = ($_POST["campoSubCategoria"]);
    $ativo = ($_POST["ativo"]);
    $destaque = ($_POST["destaque"]);
    $embalagem = $_POST['campoEmbalagem'];
    $cdg_produto = $_POST['campoCodigoProduto'];
    $modelo = $_POST['campoModelo'];
    $valor = $_POST['campoValor'];
    $disponivel = $_POST['campoDisponivel'];
   
    if(isset($_POST['enviar']))
    {
      if($titulo==""){
        ?>
<script>
alertify.alert("Favor informar o Titulo do produto");
</script>

<?php 
      }elseif($fabricante=="0"){
        ?>
<script>
alertify.alert("Favor informar o fabricante");
</script>

<?php 
      }elseif($subcategoria=="0"){
            ?>
<script>
alertify.alert("Favor informar a Subcategoria do produto");
</script>

<?php 
          }
          elseif($embalagem=="0"){
            ?>
<script>
alertify.alert("Favor informar a Embalagem do produto");
</script>

<?php 
          }elseif($disponivel=="s"){
            ?>
<script>
alertify.alert("Favor informar se o produto está disponivel");
</script>

<?php 
          }else{

            //pegar o id da categoria
 $select = "SELECT s.cl_id, s.cl_descricao as subcategoria,s.cl_categoria as id_categoria, c.cl_descricao as categoria_descricao from tb_subcategoria as s inner join 
 tb_categoria as c on c.cl_id = s.cl_categoria where s.cl_id = $subcategoria";
 $lista_id_categoria = mysqli_query($conecta,$select);
 if(!$lista_id_categoria){
 die("Falaha no banco de dados");
 }else{
     $linha = mysqli_fetch_assoc($lista_id_categoria);
     $id_categoria =$linha['id_categoria'];
 }

         
  //inserindo as informações no banco de dados
    $inserir = "INSERT INTO tb_produto ";
    $inserir .= "(cl_data_cadastro,cl_descricao,cl_fabricante,cl_categoria,cl_subcategoria,cl_titulo,cl_imagem,cl_destaque,cl_ativo,cl_embalagem,cl_modelo,cl_codigo,cl_disponivel,cl_valor)";
    $inserir .= " VALUES ";
    $inserir .= "( '$hoje','$descricao','$fabricante',' $id_categoria','$subcategoria','$titulo','img_produto/img-padrao.PNG','$destaque','$ativo','$embalagem','$modelo','$cdg_produto','$disponivel','$valor')";


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
    $embalagem = 0;
    $cdg_produto = "";
    $modelo = "";
    $subcategoria = 0;

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
    <?php 
    include("../classes/select2/select2_link.php")
    ?>
</head>

<body>
    <main>
        <form action="" method="post">

            <table style="margin-right:100px;">
                <div id="titulo">
                    </p>Dados do Produto</p>
                </div>

            </table>

            <div class="bloco-dados">
                <div class="form-group ">
                    <label for="campoCodigo">Código</label>
                    <input type="text" size="10" style="width:20%;" readonly class="form-control" id="campoCodigo"
                        placeholder="" value="<?php echo $id_produto; ?>">
                </div>
                <div class="form-group">
                    <label for="campoTitulo">Titulo *</label>
                    <input type="text" class="form-control" name="campoTitulo" id="campoTitulo"
                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($titulo);}?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="campoFabricante">Fabricante*</label>
                        <select id="campoFabricante" class="form-control" name="campoFabricante">
                            <option value="0">Selecione</option>
                            <?php 
                                    
                                    while($linha_fabricante  = mysqli_fetch_assoc($lista_fabricante)){
                                        $fabricantePrincipal = ($linha_fabricante["cl_id"]);
                                    if(!isset($fabricante)){
                                    
                                    ?>
                            <option value="<?php echo ($linha_fabricante["cl_id"]);?>">
                                <?php echo ($linha_fabricante["cl_descricao"]);?>
                            </option>
                            <?php
   
                                    }else{
                                        if($fabricante==$fabricantePrincipal){
                                        ?> <option value="<?php echo ($linha_fabricante["cl_id"]);?>" selected>
                                <?php echo ($linha_fabricante["cl_descricao"]);?>
                            </option>
                            <?php
                                    }else{
    
                                ?>
                            <option value="<?php echo utf8_encode($linha_fabricante["cl_id"]);?>">
                                <?php echo ($linha_fabricante["cl_descricao"]);?>
                            </option>
                            <?php

                                    }

                                    }

                                    }
                   
     ?>

                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="campoSubCategoria">Sub/Categoria *</label>
                        <select class="form-control" id="campoSubCategoria" name="campoSubCategoria">
                            <option value="0">Selecione</option>
                            <?php 
                                    while($linha_subcategoria = mysqli_fetch_assoc($lista_subcategoria)){
                                        $subcategoriaPrincipal = ($linha_subcategoria["cl_id"]);
                                    if(!isset($subcategoria)){
                                    
                                    ?>
                            <option value="<?php echo ($linha_subcategoria["cl_id"]);?>">
                                <?php echo ($linha_subcategoria["cl_descricao"]." - ".$linha_subcategoria["categoria_descricao"]);?>
                            </option>
                            <?php
   
                                    }else{
                                        if($subcategoria==$subcategoriaPrincipal){
                                        ?> <option value="<?php echo ($linha_subcategoria["cl_id"]);?>" selected>
                                <?php echo  ($linha_subcategoria["cl_descricao"]." - ".$linha_subcategoria["categoria_descricao"]);?>
                            </option>
                            <?php
                                    }else{
    
                                ?>
                            <option value="<?php echo ($linha_subcategoria["cl_id"]);?>">
                                <?php echo ($linha_subcategoria["cl_descricao"]." - ".$linha_subcategoria["categoria_descricao"]);?>
                            </option>
                            <?php

                                    }

                                    }

                                    }
                   
     ?>

                        </select>

                    </div>
                    <div class="form-group col-md-4">
                        <label for="campoEmbalagem">Embalagem *</label>
                        <select class="form-control" id="campoEmbalagem" name="campoEmbalagem">
                            <option value="0">Selecione</option>
                            <?php 
                                    
                                    while($linha = mysqli_fetch_assoc($lista_embalagem)){
                                        $subcategoriaPrincipal = ($linha["cl_id"]);
                                    if(!isset($subcategoria)){
                                    
                                    ?>
                            <option value="<?php echo ($linha["cl_id"]);?>">
                                <?php echo ($linha["cl_descricao"]);?>
                            </option>
                            <?php
   
                                    }else{
                                        if($subcategoria==$subcategoriaPrincipal){
                                        ?> <option value="<?php echo ($linha["cl_id"]);?>" selected>
                                <?php echo  ($linha["cl_descricao"]);?>
                            </option>
                            <?php
                                    }else{
    
                                ?>
                            <option value="<?php echo ($linha["cl_id"]);?>">
                                <?php echo ($linha["cl_descricao"]);?>
                            </option>
                            <?php

                                    }

                                    }

                                    }
                   
     ?>

                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="campoCodigoProduto">Código Produto:</label>
                        <input type="text" class="form-control col" size=40 name="campoCodigoProduto"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($cdg_produto);}?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="campoCodigoProduto">Modelo</label>
                        <input type="text" name="campoModelo" class="form-control col"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($modelo);}?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="campoDisponivel">Disponivel *</label>
                        <select class="form-control" id="campoDisponivel" name="campoDisponivel">
                            <option value="s" <?php if(isset($_POST['enviar'])){
                                if($disponivel == 's'){
                                    echo 'selected';
                                }
                            }?>>Selecione</option>
                            <option value="1" <?php if(isset($_POST['enviar'])){
                                if($disponivel == '1'){
                                    echo 'selected';
                                }
                            }?>>
                                Sim
                            </option>
                            <option value="0" <?php if(isset($_POST['enviar'])){
                                if($disponivel == '0'){
                                    echo 'selected';
                                }
                            }?>>
                                Não
                            </option>


                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="campoValor">Valor</label>
                    <input type="text"  onkeypress="return onlynumber();" name="campoValor" class="form-control col" 
                        value="<?php if(isset($_POST['enviar'])){ echo ($valor);}?>">
                </div>

            </div>

            <div class="form-group">
                <label for="validationTextarea">Descrição</label>
                <textarea class="form-control" id="campoDescricao" name="campoDescricao"
                    placeholder="Informe a descrição do produto"></textarea>

            </div>



            <div class="form-group">
                <label style="margin-right:10px ;">Ativo</label>

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="ativo" checked value="1"
                        class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Sim</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="ativo" value="0" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Não</label>
                </div>
            </div>

            <div class="form-group">
                <label style="margin-right:10px ;">Destaque</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline3" name="destaque" value="1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline3">Sim</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline4" checked name="destaque" value="0"
                        class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline4">Não</label>
                </div>
            </div>

            <div class="form-group row" id="btn-row">
                <input type="submit" name=enviar value="Incluir" class="btn btn-info btn-sm"
                    onClick="return confirm('Confirma o cadastro do Produto?');"></input>

                <button type="button" name="btnfechar" onclick="window.opener.location.reload();fechar(); "
                    class="btn btn-secondary">Voltar</button>

            </div>




            </div>


        </form>



    </main>




</body>
<?php include '../classes/select2/select2_java.php'; ?>
<?php include '../_incluir/funcaojavascript.jar'; ?>
<script>
function fechar() {
    window.close();
}
</script>

</html>

<?php 
mysqli_close($conecta);
?>