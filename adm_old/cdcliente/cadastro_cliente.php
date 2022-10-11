<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include("../alert/alert.php");
include("../_incluir/funcoes.php");
echo ".";
//data lançamento
$hoje = date('Y-m-d'); 

//consultar estados 
$select = "SELECT estadoID, nome from estados";
$lista_estados = mysqli_query($conecta,$select);
if(!$lista_estados){
    die("Falaha no banco de dados  Linha 19 cadastro_cliente");
}

//consultar cliente/forncedor/transportador
$selectcft = "SELECT clienteftID, nome from forclietrans";
$lista_cft = mysqli_query($conecta, $selectcft);
if(!$lista_cft){
die("Falaha no banco de dados  Linha 26clienteftid");
}

//variaveis 
if(isset($_POST["enviar"])){
  $razao_social = utf8_decode($_POST["txtrazaosocial"]);
  $nome_fantasia = utf8_decode($_POST["txtnomefantasia"]);
  $cpfcnpj = $_POST["cpfcnpj"];
  $inscricao_estadual = utf8_decode($_POST["inscricao_estadual"]);
  $cidade = utf8_decode($_POST["cidade"]);
  $estados = utf8_decode($_POST["estados"]);
  $bairro = utf8_decode($_POST["bairro"]);
  $clienteft = utf8_decode($_POST["cft"]);
  $email = utf8_decode($_POST["email"]);
  $endereco = utf8_decode($_POST["endereco"]);
  $telefone = $_POST["telefone"];
  $informacao_bancaria = utf8_decode($_POST["informacao_bancaria"]);
  $pix = $_POST["pix"];
  $observacao = utf8_decode($_POST["observacao"]);
  $conta_agencia = utf8_decode($_POST["conta_agencia"]);
  $cep = $_POST["cep"];
  $codigo_cidade = $_POST["ibge"];
  


  if(isset($_POST['enviar']))
  {

    if($cpfcnpj==""){
      ?>
<script>
alertify.alert("Favor preencher o campo cnpj");
</script>
<?php
    }elseif($cep==""){
      ?>
<script>
alertify.alert("Favor preencher o campo cep");
</script>
<?php
    }elseif($razao_social==""){
      ?>
<script>
alertify.alert("Favor preencher o campo Razão social");
</script>
<?php

    }
    elseif($estados=="0"){
        ?>
<script>
alertify.alert("Favor informar a UF");
</script>
<?php
  
      }elseif($nome_fantasia==""){
      ?>
<script>
alertify.alert("Favor preencher o campo Nome fantasia");
</script>
<?php

    }
    elseif($codigo_cidade==""){
        ?>
<script>
alertify.alert("Cidade não encontrada, Favor clique no botão consultar Cep");
</script>
<?php
  
      }else{

      
        $div1 = explode(".",$cpfcnpj);
        $cpfcnpj = $div1[0]."".$div1[1]."".$div1[2];
        $div2 = explode("/",$cpfcnpj);
        $cpfcnpj2 = $div2[0]."".$div2[1];
        $div3 = explode("-",$cpfcnpj2);
        $cpfcfnp3 = $div3[0]."".$div3[1];


        $div4 = explode(".",$cep);
        $cep = $div4[0]."".$div4[1]."";
        $div5 = explode("-",$cep);
        $cep2 = $div5[0]."".$div5[1];



      if($cpfcfnp3!=""){
        //verificar se o usuario já está cadastrado
        $select = " SELECT * from clientes where cpfcnpj = '$cpfcfnp3' ";
        $consulta = mysqli_query($conecta,$select);
        if(!$consulta){
        die("Falha na consulta ao banco de dados clientes");
        }else{
        $row_banco = mysqli_fetch_assoc($consulta);
        $cpfcnpjBanco = $row_banco['cpfcnpj'];
    }
       if($cpfcfnp3 == $cpfcnpjBanco){

                ?>

<script>
alertify.alert("Cnpj do cliente já cadastrado no sistema");
</script>
<?php 
}else{

//inserindo as informações no banco de dados
  $inserir = "INSERT INTO clientes ";
  $inserir .= "(razaosocial,endereco,cidade,estadoID,telefone,email,informacao_bancaria,conta_agencia,pix,observacao,cpfcnpj,inscricao_estadual,clienteftID,nome_fantasia,bairro,cep,data_cadastro,codigo_cidade)";
  $inserir .= " VALUES ";
  $inserir .= "('$razao_social','$endereco','$cidade',' $estados',' $telefone','$email','$informacao_bancaria','$conta_agencia','$pix','$observacao','$cpfcfnp3','$inscricao_estadual','$clienteft','$nome_fantasia','$bairro','$cep2','$hoje','$codigo_cidade')";


  $razao_social = "";
  $nome_fantasia = "";
  $cpfcnpj = "";
  $inscricao_estadual = "";
  $cidade = "";
  $bairro = "";
  $email = "";
  $endereco = "";
  $telefone = "";
  $informacao_bancaria = "";
  $pix ="";
  $cep ="";
  $observacao = "";
  $conta_agencia ="";
  $codigo_cidade ="";

  $operacao_inserir = mysqli_query($conecta, $inserir);
  if(!$operacao_inserir){
      die("Erro no banco de dados Linha 63 inserir_no_banco_de_dados");
          }else{
            ?>
<script>
alertify.success("Cliente cadastrado com sucesso");
</script>
<?php
          }
 
      }
     }
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
    <div id="titulo">
        </p>Ficha Cadastral do Ciente</p>
    </div>

    <div class="tab" style="width: 1500px;">
        <button class="tablinks" onclick="openCity(event, 'p1')" id="defaultOpen">Dados básicos</button>
        <button class="tablinks" onclick="openCity(event, 'p2')">Dados bancário</button>

    </div>

    <main>
        <div style="margin:0 auto; width:1450px; ">
            <form action="cadastro_cliente.php" method="post">

                <div id="p1" class="tabcontent">
                    <table style="float:left; width:700px;">
                        <div style="width: 700px; ">

                            <tr>
                                <td>
                                    <label for="txtcodigo" style="width:120px;"> <b>Código:</b></label>
                                    <input readonly type="text" size=10 id="txtcodigo" name="txtcodcliente" value="">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="txtrazaosocial" style="width:120px;"> <b>Razão Social:</b></label>
                                    <input type="text" size=60 name="txtrazaosocial" id="txtrazaosocial"
                                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($razao_social);}?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="cpfcnpj" style="width:120px;"> <b>Cnpj</b></label>
                                    <input type="text" size=30 name="cpfcnpj" id="cpfcnpj"
                                        data-mask="00.000.000/0000-00"
                                        value="<?php if(isset($_POST['enviar'])){ echo $cpfcnpj ;}?>">
                                    <button type="button" style="width:120px ;" onclick="checkCnpj(cpfcnpj.value)"
                                        class="btn btn-secondary">
                                        Buscar cnpj</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="cidade" style="width:120px;"> <b>Cidade:*</b></label>
                                    <input type="text" size=30 name="cidade" id="localidade"
                                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($cidade);}?>">


                                    <label for="estados"><b>UF:</b></label>
                                    <select name="estados" id="estados">
                                        <option value="0">Selecione</option>

                                        <?php while($linha = mysqli_fetch_assoc($lista_estados)){
                                 $estadosPrincipal = utf8_encode($linha["estadoID"]);
                                   if(!isset($estados)){
                               
                               ?>
                                        <option value="<?php echo utf8_encode($linha["estadoID"]);?>">
                                            <?php echo utf8_encode($linha["nome"]);?>
                                        </option>
                                        <?php
                               
                               }else{
   
                                if($estados==$estadosPrincipal){
                                ?> <option value="<?php echo utf8_encode($linha["estadoID"]);?>" selected>
                                            <?php echo utf8_encode($linha["nome"]);?>
                                        </option>

                                        <?php
                                         }else{
                                
                               ?>
                                        <option value="<?php echo utf8_encode($linha["estadoID"]);?>">
                                            <?php echo utf8_encode($linha["nome"]);?>
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
                                    <label for="email" style="width:120px;"> <b>Email:</b></label>
                                    <input type="email" size=30 id="email" name="email"
                                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($email);}?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="telefone" style="width:120px;"> <b>Telefone:</b></label>
                                    <input type="text" size=30 id="telefone" name="telefone"
                                        value="<?php if(isset($_POST['enviar'])){ echo $telefone;}?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="observacao" style="width:120px;"> <b>Observação:</b></label>
                                    <textarea rows=4 cols=60 name="observacao"
                                        id="observacao"><?php if(isset($_POST['enviar'])){ echo utf8_encode($observacao);}?></textarea>
                                </td>
                            </tr>

                        </div>

                        <tr>

                            <td>
                                <div style="margin-left: 120px;margin-top:10px">
                                    <input type="submit" name=enviar value="Incluir" class="btn btn-info btn-sm"
                                        onClick="return confirm('Confirmar o cadastro desse cliente?');"></input>

                                    <button type="button" onclick="window.opener.location.reload();fechar();"
                                        class="btn btn-secondary">Voltar</button>
                                </div>

                            </td>


                        </tr>



                    </table>


                    <table style="float:right; width:700px; margin-top:50px;">

                        <tr>
                            <td>
                                <label for="txtnomefantasia " style="width:120px;"><b>Nome Fantasia:</b></label>
                                <input type="text" size=55 id="txtnomefantasia" name="txtnomefantasia"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($nome_fantasia);}?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="inscricao_estadual" style="width:120px;"><b>Insc Estadual:</b></label>
                                <input type="text" size=20 id="inscricao_estadual" name="inscricao_estadual"
                                    value="<?php if(isset($_POST['enviar'])){ echo $inscricao_estadual;}?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="bairro" style="width: 120px;"><b>Bairro:</b></label>
                                <input type="text" size=20 name="bairro" id="bairro"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($bairro);}?>">
                                <label for="cft"><b>Cli/For:</b></label>
                                <select style="width: 168px;" name="cft" id="cft">

                                    <?php  while($linha_cft  = mysqli_fetch_assoc($lista_cft)){
                                    $clienteftPrincipal = utf8_encode($linha_cft["clienteftID"]);
                                    if(!isset($clienteft)){

                                    ?>
                                    <option value="<?php echo utf8_encode($linha_cft["clienteftID"]);?>">
                                        <?php echo utf8_encode($linha_cft["nome"]);?>
                                    </option>
                                    <?php

                                    }else{

                                    if($clienteft==$clienteftPrincipal){
                                    ?> <option value="<?php echo utf8_encode($linha_cft["clienteftID"]);?>" selected>
                                        <?php echo utf8_encode($linha_cft["nome"]);?>
                                    </option>

                                    <?php
                                    }else{

                                    ?>
                                    <option value="<?php echo utf8_encode($linha_cft["clienteftID"]);?>">
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
                            <td>
                                <label for="endereco" style="width:120px;"><b>Endereço:</b></label>
                                <input type="text" size=55 id="logradouro" name="endereco"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($endereco);}?>">

                                <input type="hidden" size=55 id="ibge" name="ibge"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($codigo_cidade);}?>">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="cep" style="width:120px;"><b>Cep:</b></label>
                                <input type="text" size=20 id="cep" name="cep" data-mask="00.0000-00"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($cep);}?>">
                                <button type="button" id="consultarCep" style="width:130px;" class="btn btn-secondary">
                                    Consultar Cep</button>
                            </td>

                        </tr>

                    </table>




                </div>
                <div id="p2" class="tabcontent">
                    <table style="float:left; width:100% ">
                        <tr>
                            <td align=left style="width: 120px;"><b>Informação bancaria:</b></td>
                            <td align=left><input type="text" size=30 id="informacao_bancaria"
                                    name="informacao_bancaria"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($informacao_bancaria);}?>">
                            </td>
                        </tr>
                        <tr>
                            <td><b>Conta agência:</b></td>
                            <td><input type="text" size=30 id="conta_agencia" name="conta_agencia"
                                    value="<?php if(isset($_POST['enviar'])){ echo $conta_agencia;}?>"> </td>
                        </tr>
                        <tr>
                            <td><b>Pix:</b></td>
                            <td><input type="text" size=30 id="pix" name="pix"
                                    value="<?php if(isset($_POST['enviar'])){ echo $pix;}?>"> </td>




                        </tr>
                    </table>
                </div>



            </form>
        </div>
    </main>
    <script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    document.getElementById("defaultOpen").click();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
    function checkCnpj(cnpj) {
        $.ajax({
            'url': 'https://www.receitaws.com.br/v1/cnpj/' + cnpj.replace(/[^0-9]/g, ''),
            'type': "GET",
            'dataType': 'jsonp',
            'success': function(data) {
                if (data.nome == undefined) {
                    alertify.alert("Cnpj incorreto")
                } else {
                    document.getElementById('txtrazaosocial').value = data.nome;
                    document.getElementById('txtnomefantasia').value = data.fantasia;
                    document.getElementById('cep').value = data.cep;
                    document.getElementById('cidade').value = data.municipio;
                    document.getElementById('endereco').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('telefone').value = data.telefone;
                    document.getElementById('email').value = data.email;


                }
            }
        })
    }
    </script>

    <script>
    //api consultar cep
    const cep = document.querySelector("#cep")
    const butaoCep = document.querySelector("#consultarCep")

    const showData = (result) => {
        for (const campo in result) {
            if (document.querySelector("#" + campo)) {
                document.querySelector("#" + campo).value = result[campo];
            }

        }
    }



    $('#consultarCep').click(function(e) {
        let search = cep.value.replace(/[^0-9]/g, '')
        const options = {
            method: 'GET',
            mode: 'cors',
            cache: 'default'

        }

        fetch('https://viacep.com.br/ws/' + search + '/json/', options)
            .then(response => {
                response.json()
                    .then(data => showData(data))

            })
            .catch(e => console.log('deu erro' + e, message))


    })
    </script>
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