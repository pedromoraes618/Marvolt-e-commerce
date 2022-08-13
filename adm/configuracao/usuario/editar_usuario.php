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
echo ".";
$hoje = date('y-m-d');






        
    //inserir o usuario no banco de dados
    if(isset($_POST['enviar'])){
    $usuarioID = utf8_decode($_POST['campoUsuarioID']);
    $nome = utf8_decode($_POST['campoNome']);
    $email = utf8_decode($_POST['campoEmail']);
    $usuario = utf8_decode($_POST['campoUsuario']);
    $nivel = utf8_decode($_POST['campoNivel']);
    $senha = utf8_decode($_POST['campoSenha']);


      if($nivel=="0"){
          
              ?>
<script>
alertify.alert("Favor defina um nível para o usuário");
</script>
<?php 
            }elseif($nome ==""){
                
                ?>
<script>
alertify.alert("Favor informe o campo nome");
</script>

<?php 
    
        }elseif($usuario ==""){
                
            ?>
<script>
alertify.alert("Favor informe o campo usuário");
</script>

<?php 

    }elseif($senha ==""){
                
        ?>
<script>
alertify.alert("Favor informe o campo senha");
</script>

<?php 

    }else{ 
        
                        ?>
<script>
alertify.success("Dados alterados!");
</script>
<?php
                
        //inserindo as informações no banco de dados
            $inserir = "UPDATE usuarios set email = '{$email}', usuario = '{$usuario}', nivel = '{$nivel}',nome = '{$nome}',senha = '{$senha}' where usuarioID = {$usuarioID}  ";
  
            $operacao_inserir = mysqli_query($conecta, $inserir);
            if(!$operacao_inserir){
                die("Erro no banco de dados Linha 63 inserir_no_banco_de_dados");
            }
    
        }

}

//conultar o nivel 
$select = " SELECT * from tb_nivel_usuario ";
$consulta = mysqli_query($conecta,$select);
if(!$consulta){
    die("Falha na consulta ao banco de dados");
}

//consultar dados do usuaio no banco de dados 
$select = " SELECT * from usuarios ";
if(isset($_GET['codigo'])){
$usuarioID = $_GET['codigo'];
}
$select .= " WHERE usuarioID = '$usuarioID' ";
$dados_detalhe = mysqli_query($conecta,$select);
if(!$dados_detalhe){
die("Falha na consulta ao banco de dados");
}else{
$linha = mysqli_fetch_assoc($dados_detalhe);
$usuarioB = $linha['usuario'];
$nomeB =  utf8_encode($linha['nome']);
$emailB = utf8_encode($linha['email']);
$nivelB = utf8_encode( $linha['nivel']);
$senhaB = utf8_encode($linha['senha']);
}


if(isset($_POST['btnremover'])){
 
    //inlcuir as varias do input
    $usuarioID = utf8_decode($_POST['campoUsuarioID']);
    $nome = utf8_decode($_POST['campoNome']);
    $email = utf8_decode($_POST['campoEmail']);
    $usuario = utf8_decode($_POST['campoUsuario']);
    $nivel = utf8_decode($_POST['campoNivel']);
    $senha = utf8_decode($_POST['campoSenha']);


   //query para remover o cliente no banco de dados
   $remover = "DELETE FROM usuarios WHERE usuarioID = {$usuarioID}";

     $operacao_remover = mysqli_query($conecta, $remover);
     if(!$operacao_remover) {
         die("Erro consulta ao banco de dados ");   
     } else {
        ?>
<script>
alertify.error("Usuário removido com sucesso");
</script>
<?php
         //header("location:listagem.php"); 
          
     }
   
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
    <main>

        <div style="margin:0 auto; width:1100px; ">


            <form action="" method="post">
                <table style="float: right; margin-right:100px;">
                    <form action="" method="post">
                        <div id="titulo">
                            </p>Dados do usuário</p>
                        </div>


                </table>


                <div style="width: 600px;">

                    <table style="float:left; ">

                        <tr>
                            <td style="width: 90px;" align="left">Código:</td>
                            <td align=left><input readonly type="text" size="10" id="campoUsuarioID"
                                    name="campoUsuarioID" value="<?php echo $usuarioID;?>"> </td>

                        </tr>
                    </table>
                    <!--finalizar hidden -->
                    <table style="float:left;">

                        <tr>
                            <td style="width: 90px;" align=left><b>Nome:</b></td>
                            <td align=left><input type="text" size=50 name="campoNome" id="campoNome"
                                    value="<?php echo $nomeB;?>">
                            </td>

                        </tr>
                    </table>
                    <table style="float:left;">

                        <tr>
                            <td style="width: 90px;" align=left><b>E-mail:</b></td>
                            <td align=left><input type="email" size=50 name="campoEmail" value="<?php echo $emailB;?>">
                            </td>

                        </tr>
                    </table>
                    <table style="float: left;">

                        <tr>
                            <td style="width: 90px;"> <b>Usuário</b></td>
                            <td style="width:100px;"><input type="text" size=20 id="campoUsuario" name="campoUsuario"
                                    autocomplete="of" value="<?php echo $usuarioB?>"></td>



                            <td> <b>Nível:</b></td>
                            <td> <select id="campoNivel" style="width: 150px;" name="campoNivel">
                                    <option value="0">Selecione</option>
                                    <?php 
                                    $meu_nivel = $nivelB;
                                    while($linha_usuario = mysqli_fetch_assoc($consulta)){
                                        $usuario_princiapl = utf8_encode($linha_usuario["nivel_usuarioID"]);
                                        if($meu_nivel==$usuario_princiapl){
                                        ?> <option value="<?php echo utf8_encode($linha_usuario["nivel_usuarioID"]);?>"
                                        selected>
                                        <?php echo utf8_encode($linha_usuario["descricao"]);?>
                                    </option>

                                    <?php
                                                }else{
                                        
                                    ?>
                                    <option value="<?php echo utf8_encode($linha_usuario["nivel_usuarioID"]);?>">
                                        <?php echo utf8_encode($linha_usuario["descricao"]);?>
                                    </option>
                                    <?php

                                    }

                                    }

                                    


                                    ?>



                                </select>
                            </td>
                        </tr>




                    </table>


                    <table style="float: left;">
                        <tr>
                            <td style="width: 90px;" align=left><b>Senha:</b></td>
                            <td align=left><input type="text" size=20 name="campoSenha" id="campoSenha"
                                    value="<?php echo $senhaB;?>"></td>
                        </tr>
                    </table>


                    <table style="float: left;">
                        <tr>
                            <div style="margin-left:90px;" id="botoes">
                                <input type="submit" name=enviar value="Alterar" class="btn btn-info btn-sm"></input>


                                <button type="button" name="btnfechar"
                                    onclick="window.opener.location.reload();fechar();"
                                    class="btn btn-secondary">Voltar</button>


                                <input id="remover" type="submit" name="btnremover" value="Remover"
                                    class="btn btn-danger"
                                    onClick="return confirm('Deseja remover esse usuário?');"></input>
                            </div>
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