<?php
include("../../conexao/sessao.php");
include("../../conexao/conexao.php");
include("../../_incluir/funcoes.php");
include("../../alert/alert.php");


echo '.';


if($_POST){
    $empresaID = utf8_decode($_POST['empresaID']);
    $campoRazaoSocial =  utf8_decode($_POST['txtrazaosocial']);
    $campoNome_fantasia =  utf8_decode($_POST['txtnomefantasia']);
    $campoCodigoMunicipio =  utf8_decode($_POST['codigo_municipio']);
    $campoEndereco =  utf8_decode($_POST['endereco']);
    $campoCidade =  utf8_decode($_POST['cidade']);
    $campoCnpj =  utf8_decode($_POST['cpfcnpj']);
    $campoInscricaoEstadual =  utf8_decode($_POST['inscricao_estadual']);
    $campoEmail = utf8_decode($_POST['email']);
    $campoTelefone =  utf8_decode($_POST['telefone']);
    $campoSite =  utf8_decode($_POST['site']);
    $campoNumero =  utf8_decode($_POST['numero']);
    $campoEstado =  utf8_decode($_POST['estados']);
    $campoResponsavel =  utf8_decode($_POST['responsavel']);
    $campoBairro =  utf8_decode($_POST['bairro']);
    $campoCep =  utf8_decode($_POST['cep']);
    $campoSenhaCtf =  utf8_decode($_POST['senha']);
if(isset($_POST['btnsalvar'])){
/*
    if($campoCnpj!=""){
    $div1 = explode(".",$campoCnpj);
    $campoCnpj = $div1[0]."".$div1[1]."".$div1[2];
    $div2 = explode("/",$campoCnpj);
    $cpfcnpj2 = $div2[0]."".$div2[1];
    $div3 = explode("-",$cpfcnpj2);
    $cpfcnpj3 = $div3[0]."".$div3[1];
    }

    if($campoCep!=""){
    $div4 = explode(".",$campoCep);
    $campoCep = $div4[0]."".$div4[1]."";
    $div5 = explode("-",$campoCep);
    $cep2 = $div5[0]."".$div5[1];
    }
    */

    $alterar = "UPDATE empresa set razao_social = '{$campoRazaoSocial}', nome_fantasia = '{$campoNome_fantasia}', codigo_municipio = '{$campoCodigoMunicipio}',  endereco = '{$campoEndereco}', ";
    $alterar .= " cidade = '{$campoCidade}', cnpj = '{$campoCnpj}' ,inscricao_estadual = '{$campoInscricaoEstadual}', email = '{$campoEmail}', telefone = '{$campoTelefone}', ";
    $alterar .= " site = '{$campoSite}', numero = '{$campoNumero}', estado = '{$campoEstado}' ,responsavel = '{$campoResponsavel}', bairro = '{$campoBairro}', cep = '{$campoCep}'  WHERE empresaID = '1' ";

          
    $operacao_alterar = mysqli_query($conecta, $alterar);
    if(!$operacao_alterar) {
        die("Erro na alteracao lina 20");   
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
    


    
//funcao para anexar o inserir as informacoes no banco de dados
function anexarArquivoImg($novoNome,$pasta,$senhaCertificado){
    include("../../conexao/conexao.php");
    $update = "UPDATE empresa set certificado = '$pasta$novoNome',senha_certificado = '$senhaCertificado' where empresaID = 1 ";
    $operacao_update = mysqli_query($conecta, $update);
    if(!$operacao_update){
        die("Erro no banco de dados || Inserir o diretorio no banco de dados");
    }
}

function excluirImg(){
    include("../../conexao/conexao.php");
    $remover = "UPDATE empresa set certificado = ''  where empresaID = 1 ";
    $operacao_remover = mysqli_query($conecta, $remover);
    if(!$operacao_remover){
        die("Erro no banco de dados || Inserir o diretorio no banco de dados");
    }else{
        //deletar o arquivo
        unlink("certificado/certificado.pfx");
        ?>
<script>
alertify.success("Certificado Removido com sucesso");
</script>
<?php
    }

}


if(isset($_POST['upload_certificado'])){
    $formatosPermitidos = array("pfx");
    $extensao = pathinfo($_FILES['arquivo']['name'],PATHINFO_EXTENSION);
    if(in_array($extensao,$formatosPermitidos)){
        $pasta = "certificado/";
        $temporario = $_FILES['arquivo']['tmp_name'];
        $novoNome = "certificado".".".$extensao;
        $nome = ($_FILES['arquivo']['name']);

        if(move_uploaded_file($temporario,$pasta.$novoNome)){
            //incliur no banco de dados
           anexarArquivoImg($novoNome,$pasta,$campoSenhaCtf);
            ?>
<script>
alertify.success("Uplop efetuado com sucesso");
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

if(isset($_POST['excluirAnexo'])){
   excluirImg();
}


$select = "SELECT * from empresa where empresaID = '1' ";
$operacao_select = mysqli_query($conecta, $select);
if(!$operacao_select){
    die("Erro no banco de dados || select no diretorio do anexo no banco de dados");
}else{
    $linha = mysqli_fetch_assoc($operacao_select);
    $cert = $linha['certificado'];
   
}


$consulta = "SELECT * from empresa where empresaID = '1' ";
$dados_empresa= mysqli_query($conecta, $consulta);
while($row_empresa = mysqli_fetch_assoc($dados_empresa)){
    $empresaID = utf8_encode($row_empresa['empresaID']);
    $razaoSocial = utf8_encode($row_empresa['razao_social']);
    $nome_fantasia = utf8_encode($row_empresa['nome_fantasia']);
    $codigoMunicipio = utf8_encode($row_empresa['codigo_municipio']);
    $endereco = utf8_encode($row_empresa['endereco']);
    $cidade = utf8_encode($row_empresa['cidade']);
    $cnpj = utf8_encode($row_empresa['cnpj']);
    $inscricaoEstadual = utf8_encode($row_empresa['inscricao_estadual']);
    $email = utf8_encode($row_empresa['email']);
    $telefone = utf8_encode($row_empresa['telefone']);
    $site = utf8_encode($row_empresa['site']);
    $numero = utf8_encode($row_empresa['numero']);
    $estado = utf8_encode($row_empresa['estado']);
    $responsavel = utf8_encode($row_empresa['responsavel']);
    $bairro = utf8_encode($row_empresa['bairro']);
    $cep = utf8_encode($row_empresa['cep']);
    $senhaCtf = utf8_encode($row_empresa['senha_certificado']);
    
}


?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="../../_css/tela_cadastro_editar.css" rel="stylesheet">

</head>

<body>
    <div id="titulo">
        </p>Dados da Empresa</p>
    </div>
    <div class="tab" style="width: 1500px;">
        <button class="tablinks" onclick="openCity(event, 'p1')" id="defaultOpen">Dados básicos</button>
        <button class="tablinks" onclick="openCity(event, 'p2')" id="defaultOpen">Ceticado Digital</button>
    </div>

    <main>
        <div style="margin:0 auto; width:1500px; ">
            <form action="" method="POST" enctype="multipart/form-data">



                <div id="p1" class="tabcontent">
                    <table style="float:left; width:700px;">
                        <div style="width: 700px; ">
                            <tr>
                                <td>
                                    <label for="txtcodcliente" style="width:120px;"> <b>Código:</b></label>
                                    <input readonly type="text" size="10" id="empresaID" name="empresaID"
                                        value="<?php echo 1; ?>">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="txtrazaosocial" style="width:120px;"> <b>Razão Social:</b></label>
                                    <input type="text" size=55 name="txtrazaosocial" id="txtrazaosocial"
                                        value="<?php echo $razaoSocial;?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="cpfcnpj" style="width:120px;"> <b>Cnpj:</b></label>
                                    <input type="text" size=30 name="cpfcnpj" id="cpfcnpj"
                                        data-mask="00.000.000/0000-00" value="<?php echo $cnpj; ?>">
                                    <submit type="submit" onclick="checkCnpj(cpfcnpj.value)" class="btn btn-secondary">
                                        Buscar cnpj</submit>
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <label for="cidade" style="width:120px;"> <b>Cidade:</b></label>
                                    <input required type="text" size=30 name="cidade" id="cidade"
                                        value="<?php echo $cidade?>">

                                    <label for="estados"><b>UF:</b></label>
                                    <input required type="text" size=5 name="estados" id="estados"
                                        value="<?php echo $estado; ?>">

                                </td>


                            </tr>

                            <tr>
                                <td>
                                    <label for="email" style="width:120px;"> <b>Email:</b></label>
                                    <input type="email" size=30 id="email" name="email" value="<?php echo $email?>">
                                </td>


                            </tr>

                            <tr>
                                <td>
                                    <label for="telefone" style="width:120px;"> <b>Telefone:</b></label>
                                    <input type="text" size=30 id="telefone" name="telefone" data-mask="(00)000000000"
                                        value="<?php echo $telefone ?>">
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <label for="telefone" style="width:120px;"> <b>Responsável:</b></label>
                                    <input type="text" size=30 id="responsavel" name="responsavel"
                                        value="<?php echo $responsavel?>">
                                </td>

                            </tr>


                        </div>

                        <tr>

                            <td>
                                <div style="margin-left: 120px;margin-top:10px">
                                    <input type="submit" name="btnsalvar" value="Alterar"
                                        class="btn btn-info btn-sm"></input>
                                    <a href="../../index.php">
                                        <button type="button" class="btn btn-secondary">Voltar</button></a>

                                </div>
                            </td>
                        </tr>

                    </table>



                    <table style="float:right; width:700px; margin-top:50px;">
                        <tr>
                            <td>
                                <label for="txtnomefantasia " style="width:120px;"><b>Nome Fantasia:</b></label>
                                <input type="text" size=50 id="txtnomefantasia" name="txtnomefantasia"
                                    value="<?php echo $nome_fantasia ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="inscricao_estadual" style="width:120px;"><b>Insc Estadual:</b></label>
                                <input type="text" size=30 id="inscricao_estadual" name="inscricao_estadual"
                                    value="<?php echo $inscricaoEstadual ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="bairro" style="width: 120px;"><b>Bairro:</b></label>
                                <input type="text" size=20 id="bairro" name="bairro" value="<?php echo $bairro;?>">

                                <label for="fornecedor_cliente"><b>Número</b></label>
                                <input type="text" size=12 id="numero" name="numero" value="<?php echo $numero;?>">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="endereco" style="width:120px;"><b>Endereço:</b></label>
                                <input type="text" size=50 id="endereco" name="endereco"
                                    value="<?php echo $endereco ?>">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="cep" style="width:120px;"><b>Cep:</b></label>
                                <input type="text" size=20 id="cep" data-mask="00.0000-00" name="cep"
                                    value="<?php echo $cep ?>">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="cep" style="width:120px;"><b>Site:</b></label>
                                <input type="text" size=20 id="site" name="site" value="<?php echo $site;?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="cep" style="width:120px;"><b>Código Município:</b></label>
                                <input type="text" size=20 id="codigo_municipio" name="codigo_municipio"
                                    value="<?php echo $codigoMunicipio;?>">
                            </td>
                        </tr>

                    </table>
                </div>
                <div id="p2" class="tabcontent">

                    <div style="width:300px; float:left; height:400px;">
                        <table style="float:left; width:1400px; " id="divisaoTabela">
                            <td>
                                <div id="imgProdutos" style="width:340px; height:200px;padding:20px">
                                    <img src=<?php if($cert!=""){ echo "../../images/certificado.png";
                                    };?> style="text-align:center;" height="150" width="200">

                                    <input type="file" style="margin-top:50px" name="arquivo" id="file">

                                    <input type="text" style="margin-top:50px" placeholder="Senha" name="senha"
                                        id="senha" value="<?php echo $senhaCtf; ?>">
                                    <ul>

                                        <li><input type="submit" value="Upload" id="upload" class="btn-btn-info"
                                                name="upload_certificado"></li>
                                        <li> <input type="submit" value="Excluir" id="excluirAnexo"
                                                class="btn btn-danger" name="excluirAnexo"></li>
                                    </ul>
                                </div>
                            </td>

                        </table>
                    </div>

                </div>


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
                    alert(data.status + ' ' + data.message)
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