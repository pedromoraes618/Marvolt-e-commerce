<?php

include("../../conexao/sessao.php");
require_once("../../conexao/conexao.php");
//inportar o alertar js
include('../../alert/alert.php');
echo ".";
$hoje = date('y-m-d');

        
//inserir o usuario no banco de dados
if(isset($_POST['enviar'])){
    $usuarioID = utf8_decode($_POST['campoUsuarioID']);
    $nome = utf8_decode($_POST['campoNome']);
    $email = utf8_decode($_POST['campoEmail']);
    $usuario =utf8_decode( $_POST['campoUsuario']);
    $nivel = $_POST['campoNivel'];
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
    if($usuario!=""){
        //verificar se o usuario já está cadastrado
        $select = " SELECT * from usuarios where usuario = '$usuario' ";
        $consulta = mysqli_query($conecta,$select);
        if(!$consulta){
        die("Falha na consulta ao banco de dados Usuraio");
        }else{
        $row_banco = mysqli_fetch_assoc($consulta);
        $usuarioBanco = $row_banco['usuario'];}

        
       if($usuario == $usuarioBanco){
                ?>

<script>
alertify.alert("Usuario Já cadastrado");
</script>
<?php 
}else{

       
                
        //inserindo as informações no banco de dados
            $inserir = "INSERT INTO usuarios ";
            $inserir .= "(data_cadastro, email,usuario,nivel,nome,senha)";
            $inserir .= " VALUES ";
            $inserir .= "('$hoje','$email','$usuario','$nivel','$nome','$senha' )";

            $email = "";
            $usuario = "";
            $nivel = "";
            $nome = "";
            $senha= "";
            $nivel = 1;
        
  
            $operacao_inserir = mysqli_query($conecta, $inserir);
            if(!$operacao_inserir){
                die("Erro no banco de dados inserir usuario");
            }else{
                ?>
<script>
alertify.success("Usuário cadastrado com sucesso!");
</script>
<?php
            }
    
        }

  
     }
  
    }   
}



$select = " SELECT * from tb_nivel_usuario ";
$consulta = mysqli_query($conecta,$select);
if(!$consulta){
    die("Falha na consulta ao banco de dados");
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


            <form action="cadastro_usuario.php" autocomplete="off" method="post">
                <table style="float: right; margin-right:100px;">
                    <form action="" method="post">
                        <div id="titulo">
                            </p>Cadastro de usuário</p>
                        </div>


                </table>


                <div style="width: 600px;">

                    <table style="float:left; ">

                        <tr>
                            <td style="width: 90px;" align="left">Código:</td>
                            <td align=left><input readonly type="text" size="10" id="campoUsuarioID"
                                    name="campoUsuarioID" value=""> </td>
                        </tr>
                    </table>
                    <!--finalizar hidden -->
                    <table style="float:left;">

                        <tr>
                            <td style="width: 90px;" align=left><b>Nome:</b></td>
                            <td align=left><input type="text" size=50 name="campoNome" id="campoNome"
                                    value="<?php if(isset($_POST['enviar'])){ echo $nome;}?>">
                            </td>
                        </tr>
                    </table>
                    <table style="float:left;">

                        <tr>
                            <td style="width: 90px;" align=left><b>E-mail:</b></td>
                            <td align=left><input type="email" size=50 name="campoEmail"
                                    value="<?php if(isset($_POST['enviar'])){ echo $email;}?>">
                            </td>

                        </tr>
                    </table>
                    <table style="float: left;">

                        <tr>
                            <td style="width: 90px;"> <b>Usuário</b></td>
                            <td style="width:100px;"><input type="text" size=20 id="campoUsuario" name="campoUsuario"
                                    value="<?php if(isset($_POST['enviar'])){ echo $usuario;}?>"></td>

                            <td> <b>Nível:</b></td>
                            <td> <select id="campoNivel" style="width: 150px;" name="campoNivel">
                                    <option value="0">Selecione</option>
                                    <?php 

                                while($row_banco  = mysqli_fetch_assoc($consulta)){
                                    $nivelID = $row_banco['nivel_usuarioID'];
                                    $descricao = utf8_encode($row_banco['descricao']);
                                    
                                    $nivelPrincipal = $nivelID;
                                if(!isset($nivel)){
                                ?>
                                    <option value="<?php echo $nivelID;?>">
                                        <?php echo $descricao;?>
                                    </option>
                                    <?php
                                        }else{
                                            if($nivel==$nivelPrincipal){
                                            ?> <option value="<?php echo $nivelID;?>" selected>
                                        <?php echo $descricao;?>
                                    </option>

                                    <?php
                                            }else{?>
                                    <option value="<?php echo $nivelID;?>">
                                        <?php echo $descricao;?>
                                    </option>
                                    <?php

                                        }

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
                                    value="<?php if(isset($_POST['enviar'])){ echo $senha;}?>"></td>
                        </tr>
                    </table>


                    <table style="float: left;">
                        <tr>
                            <div style="margin-left:90px;" id="botoes">
                                <input type="submit" name=enviar value="Incluir" class="btn btn-info btn-sm"
                                    onClick="return confirm('Confirmar o cadastro do usuario?');"></input>


                                <button type="button" name="btnfechar"
                                    onclick="window.opener.location.reload();fechar();"
                                    class="btn btn-secondary">Voltar</button>



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