<?php 
include "conexao/conexao.php";
include "lib/alertify/alert.php";
include "funcao/script.php";
//adicionar a variavel de sessão
session_start();


//consulta categoria query para estados
$select = "SELECT * from tb_estados";
$resultado_estados = mysqli_query($conecta, $select);


?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="_css/login.css" rel="stylesheet">
    <meta name="author" content="Desenvolvedor Pedro moraes -+5598988814696">
    <meta property="og:title" content="Marvolt localizada em são do maranhão" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <title>Marvolt</title>
    <link rel="shortcut icon" type="imagex/png" href="img/marvolt.ico">
</head>

<body>

    <div class="main-cadastro">
        <div class="bloco-1">
            <div class="tab">
                <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'juridica')"><i
                        class="fa-solid fa-building"></i> Pessoa juridica</button>
                <button class="tablinks" onclick="openCity(event, 'fisica')"><i class="fa-solid fa-user"></i> Pessoa
                    fisica</button>


            </div>

            <!-- Tab content -->
            <div id="juridica" class="tabcontent">
                <p>Campos obrigatorios *</p>
                <div id="form-cadastro">
                    <form id="formulario_cadastro_cliente">
                        <div class="group-left" id="grupo-opcao">
                            <div class="group-input">
                                <div class="input">
                                    <input type="text" id="razao_social" name="razao_social"
                                        placeholder="* Razão social">
                                    <input type="text" id="nome_fantasia" name="nome_fantasia"
                                        placeholder="* Nome fantasia">
                                    <input type="text" id="cnpj" name="cnpj" placeholder="* Cnpj"
                                        data-mask="00.000.000/0000-00">
                                    <input type="hidden" id="verifica_cnpj" name="verifica_cnpj">
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <input type="text" id="inscricao_municipal" name="inscricao_municipal"
                                        onkeypress="return onlynumber();" placeholder="Inscrição Municiapl">
                                    <input type="text" id="inscricao_estadual" name="inscricao_estadual"
                                        onkeypress="return onlynumber();" id="insc_estadual"
                                        placeholder="* Inscrição estadual">

                                    <label><input type="checkbox" name="isento" id="isento" value="isneto"
                                            onclick="Isento()">Isento</label>
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <input type="text" id="telefone" name="telefone" data-mask="(00) 00000-0000"
                                        placeholder="* Seu telefone">
                                    <input type="text" id="outro_telefone" name="outro_telefone"
                                        data-mask="(00) 00000-0000" placeholder=" Outro telefone">
                                    <input type="text" id="telefone_fixo" name="telefone_fixo"
                                        data-mask="(00) 00000-0000" placeholder=" Telefone fixo">
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <input type="text" id="cep" name="cep" data-mask="00000-000" placeholder="Cep">
                                    <input type="text" id="bairro" name="bairro" placeholder="* Bairro">
                                    <input type="text" id="endereco" name="endereco" placeholder="* Endereço">
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <input type="text" id="numero" name="numero" onkeypress="return onlynumber();"
                                        placeholder="* Número">
                                    <select style="width:195px" name="estado" id="estado">
                                        <option value="0">Estados</option>
                                        <?php while($linha = mysqli_fetch_assoc($resultado_estados)){?>
                                        <option value="<?php echo ($linha["cl_id"]);?>">
                                            <?php echo utf8_encode($linha["cl_nome"]);?>
                                        </option>
                                        <?php }?>
                                    </select>

                                    <input type="text" id="cidade" name="cidade" placeholder="* Cidade">

                                    <input type="hidden" id="verifica_cep" placeholder="Cep">
                                </div>
                            </div>




                        </div>
                        <div class="group-right" id="grupo-opcao">
                            <div class="group-input">
                                Sobre a sua conta
                            </div>
                            <hr>
                            <div class="group-input">
                                <div class="input">
                                    <input type="text" id="email" name="email" placeholder="* Email">
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <input type="password" id="senha" name="senha" placeholder="* Senha">
                                    <i id="mostrar_senha" class="fa-solid fa-eye"></i>
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <label class="obg"><input type="checkbox" id="receber_email" name="receber_email"
                                            value="1">Quero
                                        receber por
                                        email ofertas
                                        e novidades</label>
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <label class="obg"><input type="checkbox" id="privacidade" name="privacidade"
                                            value="1">* Concordo
                                        com
                                        o uso
                                        dos meus dados para
                                        compra e experiência no site
                                        conforme a Poítica de Privacidade</label>
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <button type="submit" disabled id="btn_cadastrar"
                                        class="btn btn-primary">Cadastrar</button>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>


                <div class="login_ir">
                    <p class="ir_login">Ir para a tela de <a href="login.php">login</a></p>
                </div>
            </div>


            <div id="fisica" class="tabcontent">
                <p>Campos obrigatorios *</p>
                <div id="form-cadastro">
                    <form id="formulario_cadastro_cliente">
                        <div class="group-left" id="grupo-opcao">
                            <div class="group-input">
                                <div class="input">
                                    <input type="text" placeholder="* Razão social">
                                    <input type="text" placeholder="* Nome fantasia">
                                    <input type="text" id="" name="" data-mask="00.000.000/0000-00"
                                        placeholder="* Cnpj">
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <input type="text" onkeypress="return onlynumber();"
                                        placeholder="Inscrição Municiapl">
                                    <input type="text" placeholder="* Inscrição estadual">
                                    <label><input type="checkbox">Isento</label>
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <input type="text" data-mask="(00) 00000-0000" placeholder="* Seu telefone">
                                    <input type="text" data-mask="(00) 00000-0000" placeholder=" Outro telefone">
                                    <input type="text" id="" name="" data-mask="(00) 00000-0000"
                                        placeholder=" Telefone fixo">
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <input type="text" placeholder="* Bairro">
                                    <input type="text" id="" name="" placeholder="* Endereço">
                                    <input type="text" id="" name="" onkeypress="return onlynumber();"
                                        placeholder="* Número">
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <select style="width:195px" name="" id="">
                                        <option value="0">Estados</option>
                                        <?php while($linha = mysqli_fetch_assoc($resultado_estados)){?>
                                        <option value="<?php echo ($linha["cl_id"]);?>">
                                            <?php echo utf8_encode($linha["cl_nome"]);?>
                                        </option>
                                        <?php }?>
                                    </select>

                                    <input type="text" id="" name="" placeholder="* Cidade">
                                </div>
                            </div>




                        </div>
                        <div class="group-right" id="grupo-opcao">
                            <div class="group-input">
                                Sobre a sua conta
                            </div>
                            <hr>
                            <div class="group-input">
                                <div class="input">
                                    <input type="text" placeholder="* Email">
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <input type="password" placeholder="* Senha">
                                    <i id="mostrar_senha" class="fa-solid fa-eye"></i>
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <label class="obg"><input type="checkbox" value="1">Quero
                                        receber por
                                        email ofertas
                                        e novidades</label>
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <label class="obg"><input type="checkbox" value="1">* Concordo
                                        com
                                        o uso
                                        dos meus dados para
                                        compra e experiência no site
                                        conforme a Poítica de Privacidade</label>
                                </div>
                            </div>
                            <div class="group-input">
                                <div class="input">
                                    <!-- <button type="submit" disabled id="btn_cadastrar"
                                        class="btn btn-primary">Cadastrar</button> -->
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
                <div class="login_ir">
                    <p class="ir_login">Ir para a tela de <a href="login.php">login</a></p>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>




    <script src="_js/jquery.js"></script>
    <script src="_js/jquery.mask.js"></script>
    <script src="_js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="_js/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>


    <?php include 'funcao/funcaojavascript.jar'; ?>
</body>

</html>

<script>
function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>

<script>
var razao_social = document.getElementById("razao_social")
var nome_fantasia = document.getElementById("nome_fantasia")
var cnpj = document.getElementById("cnpj")
var inscricao_municipal = document.getElementById("inscricao_municipal")
var inscricao_estadual = document.getElementById("inscricao_estadual")
var telefone = document.getElementById("telefone")
var outro_telefone = document.getElementById("outro_telefone")
var telefone_fixo = document.getElementById("telefone_fixo")
var bairro = document.getElementById("bairro")
var endereco = document.getElementById("endereco")
var numero = document.getElementById("numero")
var estado = document.getElementById("estado")
var cidade = document.getElementById("cidade")
var email = document.getElementById("email")
var senha = document.getElementById("senha")
var isento = document.getElementById("isento")
var receber_email = document.getElementById("receber_email")
var privacidade = document.getElementById("privacidade")
var cep = document.getElementById("cep")
var verificaCep = document.getElementById("verifica_cep")
var verificaCnpj = document.getElementById("verifica_cnpj")


//verificar se o campo email e senha se foram preenchidos, se sim o botão será liberado para ser clicado
$(document).keydown(function(event) {
    if (email.value != "" & senha.value != "") {
        btn_cadastrar.removeAttribute("disabled", "disabled");
    } else {
        btn_cadastrar.setAttribute("disabled", "disabled");
    }
})

//buscar cep
$("#cep").change(function(event) {
    let search = cep.value.replace(/[^0-9]/g, '')
    var url = 'https://viacep.com.br/ws/' + search + '/json';
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.onerror = function(e) {

    }
    request.onload = () => {
        var response = JSON.parse(request.responseText);
        if (response.erro === true) {
            verificaCep.value = "0";
        } else {
            verificaCep.value = "1";
            bairro.value = response.bairro
            endereco.value = response.logradouro
            cidade.value = response.localidade
        }
    }
    request.send();

})

//buscar cep
$("#cnpj").change(function(event) {
    $.ajax({
        'url': 'https://www.receitaws.com.br/v1/cnpj/' + cnpj.value.replace(/[^0-9]/g, ''),
        'type': "GET",
        'dataType': 'jsonp',
        'success': function(data) {
            if (data.nome == undefined) {
                verificaCnpj.value = "";
                verificaCnpj.value = "0" // cnpj incorreto
            } else {
                // document.getElementById('txtrazaosocial').value = data.nome;
                // document.getElementById('txtnomefantasia').value = data.fantasia;
                // document.getElementById('cep').value = data.cep;
                // document.getElementById('cidade').value = data.municipio;
                // document.getElementById('endereco').value = data.logradouro;
                // document.getElementById('bairro').value = data.bairro;
                // document.getElementById('telefone').value = data.telefone;
                // document.getElementById('email').value = data.email;
                verificaCnpj.value = "";
                verificaCnpj.value = "1"

            }
        }
    })
})




function Isento() {

    if (inscricao_estadual.hasAttribute("readonly")) {
        inscricao_estadual.removeAttribute("readonly", "readonly");

    } else {
        inscricao_estadual.setAttribute("readonly", "readonly");
        inscricao_estadual.value = "";
    }
}
</script>



<script>
$("#mostrar_senha").click(function() {

    if (senha.type == "password") {
        senha.type = "text";

    } else {
        senha.type = "password";
    }
})
</script>

<script>
$(document).ready(function() {
    $("#formulario_cadastro_cliente").submit(function(e) {
        e.preventDefault();
        var formulario = $(this);
        var retorno = cadastro_cliente(formulario)

    })

})

function cadastro_cliente(dados) {
    $.ajax({
        type: "POST",
        data: dados.serialize(),
        url: "crud.php",
        async: false
    }).then(sucesso, falha);

    function sucesso(data) {
        $mensagem = $.parseJSON(data)["mensagem"];
        $sucesso = $.parseJSON(data)["sucesso"];

        if ($sucesso) {
            Swal.fire(
                'Cadastro realizado com sucesso!',
                'Entre com o seu login',
                'success'
            )

            razao_social.value = "";
            nome_fantasia.value = "";
            cnpj.value = "";
            inscricao_municipal.value = "";
            inscricao_estadual.value = "";
            telefone.value = "";
            outro_telefone.value = "";
            telefone_fixo.value = "";
            bairro.value = "";
            endereco.value = "";
            numero.value = "";
            estado.value = 0;
            cidade.value = "";
            email.value = "";
            senha.value = "";
            cep.value = "";
            isento.checked = false
            receber_email.checked = false
            privacidade.checked = false
            verificaCnpj = "";
            verificaCep = "";

        } else {

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: $mensagem,
                footer: ''
            })
        }
    }

    function falha() {
        console.log("erro");
    }

}
</script>


<?php
    mysqli_close($conecta);
?>