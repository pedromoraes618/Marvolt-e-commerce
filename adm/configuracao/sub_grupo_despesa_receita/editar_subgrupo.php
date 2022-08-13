<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />

<?php
require_once("../../conexao/conexao.php");

include("../../conexao/sessao.php");

$hoje = date('Y-d-m');
echo ".";


//consultar lancamento
$select = "SELECT receita_despesaID, nome from receita_despesa";
$lista_receita_despesa = mysqli_query($conecta,$select);
if(!$lista_receita_despesa){
    die("Falaha no banco de dados ||   falha de conexão de red || select clientes");
}


//consultar grupo receita despesa
$select = "SELECT * from grupo_lancamento";
$lista_grupo = mysqli_query($conecta,$select);
if(!$lista_grupo){
    die("Falaha no banco de dados ||   falha de conexão de red || select clientes");
}


if(isset($_GET['codigo'])){
    $codigo = $_GET['codigo'];
}

//salvar no banco de dados
if($_POST){
    $codigo = $_POST['txtCodigo'];
    $grupoLancamento = utf8_decode($_POST['txtGrupoLancamento']);
    $grupoLancamento = $_POST['txtGrupoLancamento'];
    $subGrupo = utf8_decode($_POST['txtsubGrupo']);
    $tipoLancamento = $_POST['txtTipoLancamento'];
if(isset($_POST['salvar'])){
    if($subGrupo == "" ){
        ?>
<script>
alertify.alert("Campo SubGrupo não informado");
</script>
<?php
    }elseif($tipoLancamento=="0"){
        ?>
<script>
alertify.alert("Favor informar o Tipo do lancamento");
</script>
<?php
    }elseif($grupoLancamento == "0"){
        ?>
<script>
alertify.alert("Favor informar o grupo");
</script>
<?php
}else{
    //inserindo as informações no banco de dados
    $update = "UPDATE tb_subgrupo_receita_despesa SET subgrupo = '{$subGrupo}', grupo = '{$grupoLancamento}', lancamento = '{$tipoLancamento}'  where subGrupoID = '{$codigo}'  ";
    $operacao_alterar = mysqli_query($conecta, $update);
    if(!$operacao_alterar) {
        die("Erro na alteracao - banco de dados");   
    } else {  
       
       ?>
<script>
alertify.success("Dados alterados");
</script>
<?php
            
                
    }
        }
    }
        
}

if(isset($_POST['btnremover'])){
   //query para remover 
   $remover = "DELETE FROM tb_subgrupo_receita_despesa WHERE subGrupoID = '{$codigo}' ";
     $operacao_remover = mysqli_query($conecta, $remover);
     if(!$operacao_remover) {
         die("Erro banco de dados Revover categoria");   
     } else {
        ?>
<script>
alertify.error("SubGrupo removido com sucesso");
</script>
<?php
      $subGrupo ="";  
     }
    }

//select NA TABELA SUNBGUPO
$select = " SELECT * from tb_subgrupo_receita_despesa ";
$select .= " WHERE subGrupoID = '{$codigo}' ";

$detalhe = mysqli_query($conecta, $select);
    if(!$detalhe){
        die("Erro no banco de dados || consulta no banco de dados tb_subgrupo_receita_despesa ");
     }else{
        $dados_detalhe = mysqli_fetch_assoc($detalhe);
            $subGrupoID = utf8_encode($dados_detalhe["subGrupoID"]);
            $subGrupoB = utf8_encode($dados_detalhe["subgrupo"]);
            $grupoB = utf8_encode($dados_detalhe["grupo"]);
            $tipoLancamentoB = utf8_encode($dados_detalhe["lancamento"]);
          
 }
        




?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>


<body>
    <div id="titulo">
        </p>Dados SubGrupo</p>
    </div>
    <main>
        <div style="margin:0 auto; width:700px; float:left ">
            <form action="" method="post">

                <table style="float:left; width:700px;">
                    <div style="width: 700px; ">

                        <tr>
                            <td>
                                <label for="txtcodigo" style="width:115px;"> <b>Código:</b></label>
                                <input readonly type="text" size=10 id="txtCodigo" name="txtCodigo"
                                    value="<?php echo $subGrupoID;?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="txtsubGrupo" style="width:115px;"> <b>Subgrupo:</b></label>
                                <input type="text" size=55 name="txtsubGrupo" id="txtsubGrupo" value="<?php 
                                    if($_POST){
                                        echo utf8_encode($subGrupo);
                                    }else{
                                    echo $subGrupoB;}?>">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="txtGrupoLancamento" style="width:115px;"> <b>Grupo:</b></label>
                                <select style="width: 170px; margin-bottom:10px;" id="txtGrupoLancamento"
                                    name="txtGrupoLancamento">
                                    <option value="0">Selecione</option>
                                    <?php 
                             $meuGrupo = $grupoB;
                             while($linha_grupo_receita_despesa  = mysqli_fetch_assoc($lista_grupo)){
                                $grupo_receita_despesa_principal = utf8_encode($linha_grupo_receita_despesa["grupo_lancamentoID"]);
                        
                                if($meuGrupo==$grupo_receita_despesa_principal){
                                ?> <option
                                        value="<?php echo utf8_encode($linha_grupo_receita_despesa["grupo_lancamentoID"]);?>"
                                        selected>
                                        <?php echo utf8_encode($linha_grupo_receita_despesa["nome"]);?>
                                    </option>

                                    <?php
                                         }else{
                                
                               ?>
                                    <option
                                        value="<?php echo utf8_encode($linha_grupo_receita_despesa["grupo_lancamentoID"]);?>">
                                        <?php echo utf8_encode($linha_grupo_receita_despesa["nome"]);?>
                                    </option>
                                    <?php
   
                                    }
                                    
                                }
                            
                                                        
                            
                            
                                                    ?>


                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="txtTipoLancamento" style="width:115px; margin-bottom:20px;">
                                    <b>Lançamento:</b></label>
                                <select style="width: 170px;" id="txtTipoLancamento" name="txtTipoLancamento">
                                    <option value="0">Selecione</option>
                                    <?php 
                            
                            $meuTipoLancamento= $tipoLancamentoB;
                             while($linha_receita_despesa  = mysqli_fetch_assoc($lista_receita_despesa)){
                                $receita_despesa_principal = utf8_encode($linha_receita_despesa["nome"]);
                        
                                if($meuTipoLancamento==$receita_despesa_principal){
                                ?> <option value="<?php echo utf8_encode($linha_receita_despesa["nome"]);?>" selected>
                                        <?php echo utf8_encode($linha_receita_despesa["nome"]);?>
                                    </option>

                                    <?php
                                         }else{
                                
                               ?>
                                    <option value="<?php echo utf8_encode($linha_receita_despesa["nome"]);?>">
                                        <?php echo utf8_encode($linha_receita_despesa["nome"]);?>
                                    </option>
                                    <?php
   
                                    }
                                    
                                }
                            
                                                        
                            
                        
                                                    ?>


                                </select>


                            </td>
                        </tr>
                    </div>
                    <tr>

                        <td>
                            <div style="margin-left: 120px;margin-top:10px">
                                <input type="submit" name=salvar value="Alterar" class="btn btn-info btn-sm"></input>

                                <button type="button" onclick="window.opener.location.reload();fechar();"
                                    class="btn btn-secondary">Voltar</button>
                                <input id="remover" type="submit" name="btnremover" value="Remover"
                                    class="btn btn-danger"
                                    onClick="return confirm('Deseja remover esse SubGrupo?');"></input>
                            </div>

                        </td>

                </table>
    </main>
    <script>
    function fechar() {
        window.close();
    }
    </script>
</body>

</html>