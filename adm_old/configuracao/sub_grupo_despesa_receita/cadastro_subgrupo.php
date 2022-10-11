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


if(isset($_POST['enviar'])){
    $grupoLancamento = utf8_decode($_POST['txtGrupoLancamento']);
    $subGrupo = utf8_decode($_POST['txtsubGrupo']);
    $tipoLancamento =utf8_decode($_POST['txtTipoLancamento']);
    $hoje = date('Y-m-d');

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
    $inserir = "INSERT INTO tb_subgrupo_receita_despesa ";
    $inserir .= "(data_cadastro, subgrupo,grupo,lancamento)";
    $inserir .= " VALUES ";
    $inserir .= "('$hoje', '$subGrupo','$grupoLancamento','$tipoLancamento' )";
$grupoLancamento = "1";
$subGrupo = "";
$tipoLancamento="Selecione";

    $operacao_inserir = mysqli_query($conecta, $inserir);
    if(!$operacao_inserir){
        die("Erro no banco de dados || inserir na tabela tb_subgrupo_receita_despesa ");
        }else{
            ?>
<script>
alertify.success("Subgrupo lançado com sucesso");
</script>
<?php
        }

    }
        
}

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
        </p>Cadastro SubGrupo</p>
    </div>
    <main>
        <div style="margin:0 auto; width:700px; float:left ">
            <form action="" method="post">

                <table style="float:left; width:700px;">
                    <div style="width: 700px; ">

                        <tr>
                            <td>
                                <label for="txtcodigo" style="width:115px;"> <b>Código:</b></label>
                                <input readonly type="text" size=10 id="txtcodigo" name="txtcodcliente" value="">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="txtsubGrupo" style="width:115px;"> <b>Subgrupo:</b></label>
                                <input type="text" size=55 name="txtsubGrupo" id="txtsubGrupo"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($subGrupo);}?>">




                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="txtGrupoLancamento" style="width:115px;"> <b>Grupo:</b></label>
                                <select style="width: 170px; margin-bottom:10px;" id="txtGrupoLancamento"
                                    name="txtGrupoLancamento">
                                    <option value="0">Selecione</option>
                                    <?php 
                            
                             while($linha_grupo_receita_despesa  = mysqli_fetch_assoc($lista_grupo)){
                                $grupo_receita_despesa_principal = utf8_encode($linha_grupo_receita_despesa["grupo_lancamentoID"]);
                               if(!isset($grupoLancamento)){
                               
                               ?>
                                    <option
                                        value="<?php echo utf8_encode($linha_grupo_receita_despesa["grupo_lancamentoID"]);?>">
                                        <?php echo utf8_encode($linha_grupo_receita_despesa["nome"]);?>
                                    </option>
                                    <?php
                               
                               }else{
   
                                if($grupoLancamento==$grupo_receita_despesa_principal){
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
                            
                                                        
                            }
                            
                                                    ?>


                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="txtTipoLancamento" style="width:115px;"> <b>Lançamento:</b></label>
                                <select style="width: 170px;" id="txtTipoLancamento" name="txtTipoLancamento">
                                    <option value="0">Selecione</option>
                                    <?php 
                            
                               
                             while($linha_receita_despesa  = mysqli_fetch_assoc($lista_receita_despesa)){
                                $receita_despesa_principal = utf8_encode($linha_receita_despesa["nome"]);
                               if(!isset($lancamento)){
                               
                               ?>
                                    <option value="<?php echo utf8_encode($linha_receita_despesa["nome"]);?>">
                                        <?php echo utf8_encode($linha_receita_despesa["nome"]);?>
                                    </option>
                                    <?php
                               
                               }else{
   
                                if($lancamento==$receita_despesa_principal){
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
                            
                                                        
                            }
                            
                                                    ?>


                                </select>


                            </td>
                        </tr>
                    </div>
                    <tr>

                        <td>
                            <div style="margin-left: 120px;margin-top:10px">
                                <input type="submit" name=enviar value="Incluir" class="btn btn-info btn-sm"
                                    onClick="return confirm('Confirmar o cadastro do subgrupo?');"></input>

                                <button type="button" onclick="window.opener.location.reload();fechar();"
                                    class="btn btn-secondary">Voltar</button>
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