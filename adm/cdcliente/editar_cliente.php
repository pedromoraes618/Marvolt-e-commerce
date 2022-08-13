<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include_once("../_incluir/funcoes.php");
include("../alert/alert.php");

echo ".";

if($_POST){

    //inlcuir as varias do input
    $clienteID = utf8_decode($_POST["txtcodcliente"]);
    $razao_social = utf8_decode($_POST["txtrazaosocial"]);
    $nome_fantasia = utf8_decode($_POST["txtnomefantasia"]);
    $cpfcnpj = utf8_decode($_POST["cpfcnpj"]);
    $inscricao_estadual = utf8_decode($_POST["inscricao_estadual"]);
    $cidade = utf8_decode($_POST["cidade"]);
    $estados = utf8_decode($_POST["estados"]);
    $bairro = utf8_decode($_POST["bairro"]);
    $clientefortrans = utf8_decode($_POST["fornecedor_cliente"]);
    $email = utf8_decode($_POST["email"]);
    $endereco = utf8_decode($_POST["endereco"]);
    $telefone = $_POST["telefone"];
    $informacao_bancaria = utf8_decode($_POST["informacao_bancaria"]);
    $pix = $_POST["pix"];
    $observacao = utf8_decode($_POST["observacao"]);
    $conta_agencia = utf8_decode($_POST["conta_agencia"]);
    $cep = $_POST["cep"];
    $codigo_cidade = $_POST["ibge"];
   
    if(isset($_POST['btnsalvar'])){

      

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
        

   //query para alterar o cliente no banco de dados
   $alterar = "UPDATE clientes set razaosocial = '{$razao_social}', endereco = '{$endereco}', cidade = '{$cidade}',  estadoID = '{$estados}', ";
   $alterar .= " telefone = '{$telefone}', email = '{$email}' ,informacao_bancaria = '{$informacao_bancaria}', conta_agencia = '{$conta_agencia}', pix = '{$pix}', ";
   $alterar .= " clienteftID = '{$clientefortrans}', observacao = '{$observacao}', cpfcnpj = '{$cpfcfnp3}' ,inscricao_estadual = '{$inscricao_estadual}', nome_fantasia = '{$nome_fantasia}', bairro = '{$bairro}',
   codigo_cidade ='{$codigo_cidade}', cep='{$cep2}'  WHERE clienteID = {$clienteID} ";

     $operacao_alterar = mysqli_query($conecta, $alterar);
     if(!$operacao_alterar) {
         die("Erro no update tb_cliente");   
     } else {  
        ?>
<script>
alertify.success("Dados alterados");
</script>
<?php
         //header("location:listagem.php"); 
        }
          
     }
   
   }
}






 if(isset($_POST['btnremover'])){
 
   //query para remover o cliente no banco de dados
   $remover = "DELETE FROM clientes WHERE clienteID = {$clienteID}";

     $operacao_remover = mysqli_query($conecta, $remover);
     if(!$operacao_remover) {
         die("Erro linha 44");   
     } else {   
        ?>
<script>
alertify.error("Cliente removido com sucesso");
</script>
<?php
         //header("location:listagem.php"); 
          
     }
   
   }

 ?>

<?php



$select = "SELECT estadoID, nome from estados";
$lista_estados = mysqli_query($conecta,$select);
if(!$lista_estados){
   die("Falaha no banco de dados  Linha 49 cadastro_cliente");
}


$consulta = "SELECT * FROM clientes ";
if (isset($_GET["codigo"])){
   $clienteID=$_GET["codigo"];
$consulta .= " WHERE clienteID = {$clienteID} ";
}else{
   $consulta .= " WHERE clienteID = 1 ";
}

//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
   die("Falha na consulta ao banco de dados");
}else{
   
   $dados_detalhe = mysqli_fetch_assoc($detalhe);
   $clienteID=  utf8_encode($dados_detalhe['clienteID']);
   $razao_social =  utf8_encode($dados_detalhe["razaosocial"]);
   $nome_fantasia = utf8_encode($dados_detalhe["nome_fantasia"]);
   $cpfcnpj = utf8_encode($dados_detalhe["cpfcnpj"]);
   $inscricao_estadual = $dados_detalhe["inscricao_estadual"];
   $cidade = utf8_encode($dados_detalhe["cidade"]);
   $estados = utf8_encode($dados_detalhe["estadoID"]);
   $bairro = utf8_encode($dados_detalhe["bairro"]);
   $clienteftID = $dados_detalhe["clienteftID"];
   $email = utf8_encode($dados_detalhe["email"]);
   $endereco = utf8_encode($dados_detalhe["endereco"]);
   $telefone = utf8_encode($dados_detalhe["telefone"]);
   $informacao_bancaria = utf8_encode($dados_detalhe["informacao_bancaria"]);
   $pix = $dados_detalhe["pix"];
   $observacao = utf8_encode($dados_detalhe["observacao"]);
   $conta_agencia = utf8_encode($dados_detalhe["conta_agencia"]);
   $cep = $dados_detalhe["cep"];
   $codigo_cidadeB = $dados_detalhe["codigo_cidade"];


}

//consulta estados

$select = "SELECT estadoID, nome from estados";
$lista_estados = mysqli_query($conecta,$select);
if(!$lista_estados){
   die("Falaha no banco de dados");
}

//consultar cliente/forncedor/transportador
$selectcft = "SELECT clienteftID, nome from forclietrans";
$lista_cft = mysqli_query($conecta, $selectcft);
if(!$lista_cft){
   die("Falaha no banco de dados ");
}


?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">

</head>

<body>
    <div id="titulo">
        </p>Dados do Cliente</p>
    </div>
    <div class="tab" style="width: 1500px;">
        <button class="tablinks" onclick="openCity(event, 'p1')" id="defaultOpen">Dados básicos</button>
        <button class="tablinks" onclick="openCity(event, 'p2')">Dados bancário</button>

    </div>

    <main>
        <div style="margin:0 auto; width:1450px; ">
            <form action="" method="post">



                <div id="p1" class="tabcontent">
                    <table style="float:left; width:700px;">
                        <div style="width: 700px; ">
                            <tr>
                                <td>
                                    <label for="txtcodcliente" style="width:120px;"> <b>Código:</b></label>
                                    <input readonly type="text" size="10" id="txtcodcliente" name="txtcodcliente"
                                        value="<?php echo $clienteID;?>">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="txtrazaosocial" style="width:120px;"> <b>Razão Social:</b></label>
                                    <input type="text" size=60 name="txtrazaosocial" id="txtrazaosocial"
                                        value="<?php echo $razao_social ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="cpfcnpj" style="width:120px;"> <b>Cnpj/Cpf:</b></label>
                                    <input type="text" size=30 name="cpfcnpj" id="cpfcnpj"
                                        data-mask="00.000.000/0000-00" value="<?php echo formatCnpjCpf($cpfcnpj)?>">
                                    <submit type="submit" onclick="checkCnpj(cpfcnpj.value)" class="btn btn-secondary">
                                        Buscar cnpj</submit>
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <label for="cidade" style="width:120px;"> <b>Cidade:</b></label>
                                    <input required type="text" size=30 name="cidade" id="cidade"
                                        value="<?php echo $cidade ?>">

                                    <label for="estados"><b>UF:</b></label>
                                    <select id="estados" name="estados">
                                        <option value="0">Seleione</option>
                                        <?php 
                           $meuestado =  $estados;
                           while($linha=mysqli_fetch_assoc($lista_estados)){
                           $estado_principal  = $linha["estadoID"];
                           if($meuestado==$estado_principal){

                         
                        ?>
                                        <option value="<?php echo $linha["estadoID"];?>" selected>
                                            <?php echo utf8_encode($linha["nome"]);?>
                                        </option>

                                        <?php
                         }else{
                         ?>
                                        <option value="<?php echo $linha["estadoID"];?>">
                                            <?php echo utf8_encode($linha["nome"]);?>
                                        </option>
                                        <?php

                         }}
                         
                         ?>

                                    </select>

                                </td>


                            </tr>

                            <tr>
                                <td>
                                    <label for="email" style="width:120px;"> <b>Email:</b></label>
                                    <input type="email" size=30 id="email" name="email" value="<?php echo $email;?>">
                                </td>


                            </tr>

                            <tr>
                                <td>
                                    <label for="telefone" style="width:120px;"> <b>Telefone:</b></label>
                                    <input type="text" size=30 id="telefone" name="telefone"
                                        value="<?php echo $telefone?>">
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <label for="observacao " style="width:120px;"><b>Observação</b></label>
                                    <textarea rows=4 cols=60 name="observacao"
                                        id="observacao"><?php echo $observacao ?></textarea>
                                </td>

                            </tr>
                        </div>

                        <tr>

                            <td>
                                <div style="margin-left: 120px;margin-top:10px">
                                    <input type="submit" name="btnsalvar" value="Alterar"
                                        class="btn btn-info btn-sm"></input>
                                    <button type="button" onclick="window.opener.location.reload();fechar();"
                                        class="btn btn-secondary">Voltar</button>
                                    <input id="remover" type="submit" name="btnremover" value="Remover"
                                        class="btn btn-danger"
                                        onClick="return confirm('Confirma Remoção do CLienter? Verifique se o cliente tem movimentação');"></input>
                                    <button type="button" name="brncomprador" value="Comprador" class="btn btn-dark"
                                        onClick="abrepopupConsultaComprador();">Comprador</button>
                                </div>
                            </td>
                        </tr>

                    </table>



                    <table style="float:right; width:700px; margin-top:50px;">
                        <tr>
                            <td>
                                <label for="txtnomefantasia " style="width:120px;"><b>Nome Fantasia:</b></label>
                                <input type="text" size=55 id="txtnomefantasia" name="txtnomefantasia"
                                    value="<?php echo $nome_fantasia ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="inscricao_estadual" style="width:120px;"><b>Insc Estadual:</b></label>
                                <input type="text" size=30 id="inscricao_estadual" name="inscricao_estadual"
                                    value="<?php echo $inscricao_estadual ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="bairro" style="width: 120px;"><b>Bairro:</b></label>
                                <input type="text" size=20 id="bairro" name="bairro" value="<?php echo $bairro;?>">

                                <label for="fornecedor_cliente"><b>Clt/For:</b></label>
                                <select style="width: 175px;" id="fornecedor_cliente" name="fornecedor_cliente">

                                    <?php 
                           $cft_selecionado =  $clienteftID;
                           while($linha_cft = mysqli_fetch_assoc($lista_cft)){
                           $ctf_principal  = $linha_cft["clienteftID"];
                           if($cft_selecionado==$ctf_principal){
                               
                        ?>
                                    <option value="<?php echo $linha_cft["clienteftID"];?>" selected>
                                        <?php echo utf8_encode($linha_cft["nome"]);?>
                                    </option>

                                    <?php
                         }else{
                         ?>
                                    <option value="<?php echo $linha_cft["clienteftID"];?>">
                                        <?php echo utf8_encode($linha_cft["nome"]);?>
                                    </option>
                                    <?php
                         }}
                         ?>

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="endereco" style="width:120px;"><b>Endereço:</b></label>
                                <input type="text" size=55 id="endereco" name="endereco"
                                    value="<?php echo $endereco;?>">
                                <input type="hidden" size=10 id="ibge" name="ibge"
                                    value="<?php echo $codigo_cidadeB;?>">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="cep" style="width:120px;"><b>Cep:</b></label>
                                <input type="text" size=20 id="cep" data-mask="00.0000-00" name="cep"
                                    value="<?php echo $cep;?>">
                                <button type="button" id="consultarCep" style="width:130px;" class="btn btn-secondary">
                                    Consultar Cep</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="p2" class="tabcontent">
                    <table style="float:left; width:100% ">
                        <tr>
                            <td>
                                <label for="informacao_bancaria" style="width:120px;"><b>Informação
                                        bancaria:</b></label>
                                <input type="text" size=60 id="informacao_bancaria" name="informacao_bancaria"
                                    value="<?php echo $informacao_bancaria?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="conta_agencia" style="width:120px;"><b>Conta Agência:</b></label>
                                <input type="text" size=30 id="conta_agencia" name="conta_agencia"
                                    value="<?php echo $conta_agencia?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="conta_agencia" style="width:120px;"><b>Pix:</b></label>
                                <input type="text" size=60 id="pix" name="pix" value="<?php echo $pix?>">
                            </td>
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


</html>

<script>
function abrepopupConsultaComprador() {
    var janela = "comprador_cl/consulta_comprador.php?cliente=<?php echo $clienteID;?>";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=700,top=100,left=100');
}

function fechar() {
    window.close();
}
</script>

<?php 
mysqli_close($conecta);
?>