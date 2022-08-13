<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");


//inportar a classe com as variaveis do banco de dados
include("../classes/cliente/cadastro_cliente.php");


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
        <form action="cadastro_cliente.php" method="post">
            <div id="titulo">
                </p>Ficha Cadastral do Ciente</p>
            </div>


            <table width=100%>

                <tr>
                    <td>Codigo:</td>
                    <td align=left><input readonly type="text" id="txtcodigo" name="txtcodcliente" value=""> </td>
                </tr>

                <tr>
                    <td align=left><b>Razão Social: *</b></td>
                    <td align=left><input type="text" required size=60 name="txtrazaosocial"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($razao_social);}?>">
                    </td>
                    <td><b>Nome Fantasia:</b></td>
                    <td><input type="text" size=60 id="txtnomefantasia" name="txtnomefantasia"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($nome_fantasia);}?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>CPF/CNPJ:</b></td>
                    <td align=left><input type="text" size=60 name="cpfcnpj"
                            value="<?php if(isset($_POST['enviar'])){ echo $cpfcnpj ;}?>"> </td>
                    <td><b>Inscrisão estadual:</b></td>
                    <td><input type="text" size=60 id="inscricao_estadual" name="inscricao_estadual"
                            value="<?php if(isset($_POST['enviar'])){ echo $inscricao_estadual;}?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Cidade:*</b></td>
                    <td align=left><input  required type="text" size=30 name="cidade"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($cidade);}?>"><b>UF:</b>
                        <?php include_once("../_incluir/uf_estados.php"); ?>
                    </td>

                    <td align=left><b>Bairro:</b></td>
                    <td align=left><input type="text" size=30 name="bairro" id="bairro"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($bairro);}?>">
                        <b>C/F/T:</b>
                        <select style="width: 168px;" name="cft" id="cft">
                        
                      <?php  while($linha_cft  = mysqli_fetch_assoc($lista_cft)){
                                $clienteftPrincipal = utf8_encode($linha_cft["nome"]);
                               if(!isset($clienteft)){
                               
                               ?>
                               <option value="<?php echo utf8_encode($linha_cft["nome"]);?>">
                                   <?php echo utf8_encode($linha_cft["nome"]);?>
                               </option>
                               <?php
                               
                               }else{
   
                                if($clienteft==$clienteftPrincipal){
                                ?> <option value="<?php echo utf8_encode($linha_cft["nome"]);?>" selected>
                                   <?php echo utf8_encode($linha_cft["nome"]);?>
                               </option>
   
                               <?php
                                         }else{
                                
                               ?>
                               <option value="<?php echo utf8_encode($linha_cft["nome"]);?>">
                                   <?php echo utf8_encode($linha_cft["nome"]);?>
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
                    <td align=left><b>Email:</b></td>
                    <td align=left><input type="email" size=60 id="email" name="email"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($email);}?>"> </td>
                    <td><b>Enderço:</b></td>
                    <td><input type="text" size=60 id="endereco" name="endereco"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($endereco);}?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Telefone:</b></td>
                    <td align=left><input type="text" size=60 id="telefone" name="telefone"
                            value="<?php if(isset($_POST['enviar'])){ echo $telefone;}?>"> </td>
                    <td align=left><b>Informação bancaria:</b></td>
                    <td align=left><input type="text" size=60 id="informacao_bancaria" name="informacao_bancaria"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($informacao_bancaria);}?>">
                    </td>
                </tr>

                <tr>
                    <td><b>Conta agência:</b></td>
                    <td><input type="text" size=20 id="conta_agencia" name="conta_agencia"
                            value="<?php if(isset($_POST['enviar'])){ echo $conta_agencia;}?>"> </td>
                    <td><b>Pix:</b></td>
                    <td><input type="text" size=60 id="pix" name="pix"
                            value="<?php if(isset($_POST['enviar'])){ echo $pix;}?>"> </td>

                </tr>

                <tr>
                    <td><b>Observação:</b></td>
                    <td><textarea rows=4 cols=60 name="observacao" id="observacao"><?php if(isset($_POST['enviar'])){ echo utf8_encode($observacao);}?></textarea> </td>
                </tr>



                </talbe>
                <table width=100%>
                    <tr>
                        <div id="botoes">
                            <input type="submit" name=enviar value="Cadastrar" class="btn btn-info btn-sm"  onClick="return confirm('Confirma o cadastro desse cliente?');"></input>
                           
                                <button type="button" onclick="fechar();" class="btn btn-secondary">Voltar</button>
                      
                     
                        </div>
                    </tr>

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