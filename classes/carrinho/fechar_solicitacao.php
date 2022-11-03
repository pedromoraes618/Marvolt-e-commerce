<?php

//funcao para verificar se é o mesmo produto que está sendo adicionado duas vez/ se for não realizar o insert no banco de dados
function verificaProd($b_id_cliente, $sessao, $id_prod)
{
    include "conexao/conexao.php";
    //pegar se o usuario está adicionado o mesmo produto a mesma sessao
    $select = "SELECT * from tb_carrinho where cl_cliente = $b_id_cliente and cl_sessao = '$sessao' and cl_produtoID = '$id_prod'";
    $resultado_produto_sessao = mysqli_query($conecta, $select);
    if (!$resultado_produto_sessao) {
        include "classes/erro/504.php";
    } else {
        $linha = mysqli_fetch_assoc($resultado_produto_sessao);
        $id_produto = $linha['cl_produtoID'];
        return $id_produto;
    }
}

//consultar tabela produto 
$select = "SELECT f.cl_descricao as fabricante,cl_disponivel,cl_valor,cl_recorrente, c.cl_quantidade as quantidade, p.cl_titulo as titulo,p.cl_subcategoria as subcategoria, c.cl_sessao, c.cl_id,c.cl_produtoID as id_produto, p.cl_titulo as titulo, p.cl_imagem as imagem from tb_carrinho as c
inner join tb_produto as p on p.cl_id = c.cl_produtoID inner join tb_fabricante as f on f.cl_id = p.cl_fabricante  where c.cl_cliente = $b_id_cliente and c.cl_sessao = '$sessao'";
$resultado_carrinho = mysqli_query($conecta, $select);
if (!$resultado_carrinho) {
    include "classes/erro/504.php";
}

//pegar q quantidade de produtos que estão no carrinho
$select = "SELECT sum(cl_quantidade) as qtd_prod from tb_carrinho where cl_cliente = $b_id_cliente and cl_sessao = '$sessao' and cl_produtoID > 0 ";
$resultado_qtd_carrinho = mysqli_query($conecta, $select);
if (!$resultado_qtd_carrinho) {
    include "classes/erro/504.php";
} else {
    $linha = mysqli_fetch_assoc($resultado_qtd_carrinho);
    $qtd_carrinho = $linha['qtd_prod'];
}

/* select tb_frete*/
$select = "SELECT * from tb_frete";
$resultado_frete = mysqli_query($conecta, $select);
if (!$resultado_frete) {
    include "classes/erro/504.php";
}

/* select tb_tipo_pagamento*/
$select = "SELECT * from tb_tipo_pagamento";
$resultado_pagamento = mysqli_query($conecta, $select);
if (!$resultado_pagamento) {
    include "classes/erro/504.php";
}



?>

<div class="row" id="bloco">
    <div class="container">

        <div class="grou-fechar-pedido">

            <form id="finalizar_pedido">
                <?php
                if ($qtd_carrinho != "") {
                ?>
                <div class="bloco-carrinho-fechar">
                    <div class="titulo-carrinho-fechar">
                        <h3>Fechar solicitação de pedido</h3>
                    </div>

                    <div class="dados-pedido">
                        <div class="titulo">
                            <p>Dados do pedido</p>
                        </div>
                        <hr>

                        <div class="form">
                            <div class="form-row">
                                <div class="input">
                                    <label for="data_entrega_finalizar_pedido">Expectativa de entrega (Opc)</label>
                                    <input type="text" OnKeyUp="mascaraData(this);" autocomplete="off" maxlength="10"
                                        onkeypress="return onlynumber();" name="data_entrega_finalizar_pedido"
                                        placeholder="xx/xx/xxxx" id="data_entrega_finalizar_pedido">
                                </div>

                                <div class="input">
                                    <label for="frete">Expectativa de Frete (Opc)</label>
                                    <select name="frete" id="frete">
                                        <?php while ($linha = mysqli_fetch_assoc($resultado_frete)) { ?>
                                        <option value="<?php echo ($linha["cl_id"]); ?>">
                                            <?php echo utf8_encode($linha["cl_descricao"]); ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="input">
                                    <label for="tipo_pagamento">Expectativa de Forma pagamento (Opc)</label>
                                    <select name="tipo_pagamento" id="tipo_pagamento">
                                        <?php while ($linha = mysqli_fetch_assoc($resultado_pagamento)) { ?>
                                        <option value="<?php echo ($linha["cl_id"]); ?>">
                                            <?php echo utf8_encode($linha["cl_descricao"]); ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <span id="esse"></span>
                                <div class="input">

                                    <input type="hidden" name="cliente" value="<?php echo $b_id_cliente ?>"
                                        id="cliente">
                                </div>
                                <div class="input">
                                    <input type="hidden" name="sessao" value="<?php echo $sessao; ?>" id="sessao">
                                </div>
                            </div>
                        </div>

                        <div class="dados-produto">
                            <div class="titulo">
                                <p>Dados do Produto</p>
                            </div>
                            <hr>
                            <div id="produto-carrinho-fechar" class="produto-carrinho-fechar">
                                <nav>
                                    <ul>
                                        <?php

                                            while ($linha = mysqli_fetch_assoc($resultado_carrinho)) {
                                                $titulo_prod = $linha['titulo'];
                                                $img = $linha['imagem'];
                                                $id = $linha['cl_id'];
                                                $fabricante = $linha['fabricante'];
                                                $id_produto = $linha['id_produto'];
                                                $titulo = $linha['titulo'];
                                                $subcategoria = $linha['subcategoria'];
                                                $qtd = $linha['quantidade'];
                                                $disponivel = $linha['cl_disponivel'];
                                                $valor = $linha['cl_valor'];
                                                $recorrente = $linha['cl_recorrente'];

                                            ?>
                                        <li>
                                            <div class="blco-produto">
                                                <div class="img-produtos">
                                                    <a
                                                        href="?produto=<?php echo $id_produto; ?>&desc=<?php echo $titulo; ?>&subcg=<?php echo $subcategoria ?>">
                                                        <img src="<?php echo "adm/classes/produto/" . $img; ?>">
                                                    </a>
                                                </div>
                                                <div class="bloco-informacao">
                                                    <a
                                                        href="?produto=<?php echo $id_produto; ?>&desc=<?php echo $titulo; ?>&subcg=<?php echo $subcategoria ?>">
                                                        <p class="titulo">
                                                            <?php echo $titulo_prod; ?>
                                                        </p>
                                                    </a>
                                                    <p class="fabricantes"><?php echo $fabricante ?></p>
                                                    <p class="qtd">Qtd: <a
                                                            href="?incfor&id=<?php echo $id ?>"><?php echo $qtd; ?></a>
                                                    </p>

                                                    <p><?php if ($disponivel == 1) {
                                                                    echo real_format($valor);
                                                                } ?></p>
                                                    <div>

                                                        <label class="container">
                                                            <a> Esse produto é recorrente na sua empresa?</a>
                                                            <input dados_id="<?php echo $id; ?>" id="<?php echo $id; ?>"
                                                                type="checkbox"
                                                                <?php if ($recorrente == 1) {
                                                                                                                                                    ?>checked<?php
                                                                                                                                                            } ?>
                                                                class="check_recorrente">
                                                            <div class="checkmark"></div>
                                                        </label>

                                                    </div>

                                                    <a dados_id="<?php echo $id; ?>" class="btn-add-informacao">
                                                        Incluir Informações
                                                    </a>

                                                </div>
                                            </div>
                                        </li>
                                        <hr>

                                        <?php
                                            }

                                            ?>
                                    </ul>
                                </nav>


                            </div>
                        </div>

                    </div>

                </div>
                <div class="fechar-pedido">
                    <div class="finalizar-pedido">
                        <button type="submit" class="btn_finalizar_pedido">
                            Finalizar Pedido
                        </button>

                        <a class="btn-voltar" href="JavaScript: window.history.back();">
                            Voltar
                        </a>

                    </div>
                    <div class="dados_empresa">
                        <p class="titulo">Seus dados</p>
                        <hr>
                        <div class="inf-empresa">
                            <p>Empresa: <?php echo $b_cliente_nome_fantasia; ?></p>
                            <p>Cnpj: <?php echo $b_cliente_cnpj ?></p>
                            <p>Telefone: <?php echo $b_cliente_telefone ?></p>
                            <p>Email: <?php echo $b_cliente_email ?></p>
                  

                        </div>
                        <hr>
                        <div class="inf">
                            Para corrigir os dados da
                            empresa clique <a>aqui</a> ou entre
                            no menu usuário para corrigir ou completar o seu cadastro
                            <hr>
                            Por que queroms saber se os produtos é recorrente na sua empresa?
                            Vamos analisar os produtos que sua empresa mais necessita para informar os produtos certos a
                            sua empresa

                        </div>
                    </div>
                </div>
                <?php
                } else {

                    echo "
                <div class='bloco-carrinho-fechar'>
                    <div class='titulo-carrinho-fechar'>
                        <h3>Fechar solicitação de pedido</h3>
                    </div>
                  
                <div class='img-carrinho-vazio'>
                <img width='100%' src='img/carrinho-vazio.svg'>
                <p>Ops!<br>Seu carrinho está vazio!</p>,
                <a href='index.php'>Continuar comprando</a>
                </div>
                </div>
                ";
                }
                ?>
            </form>
        </div>
    </div>
</div>
<script src="_js/jquery.js"></script>
<script src="_js/script.js"></script>

<!-- <script>
$('#produto-carrinho ul li a.excluir').click(function(e) {
    e.preventDefault();
    $(this).parent().parent().fadeOut();
});
</script> -->

<script>
$(document).ready(function(e) {
    // window.location.href = "?incfor&id=" + id_produto
    var data_prevista = document.getElementById("data_entrega_finalizar_pedido");
    var frete_previsto = document.getElementById("frete");
    var pagamento_previsto = document.getElementById("tipo_pagamento");
    var dados_localstorage = localStorage.getItem("dados_solicitacao")
    var dados_solicitacao = JSON.parse(dados_localstorage)

    data_prevista.value = dados_solicitacao.data_prevista
    frete_previsto.value = dados_solicitacao.frete_previsto
    pagamento_previsto.value = dados_solicitacao.pagamento_previsto

})

$('.btn-add-informacao').click(function(e) {
    //salvar as informacoes do imput no localstorage
    var id_produto = $(this).attr("dados_id");
    var data_prevista = document.getElementById("data_entrega_finalizar_pedido").value;
    var frete_previsto = document.getElementById("frete").value;
    var pagamento_previsto = document.getElementById("tipo_pagamento").value;
    localStorage.setItem("dados_solicitacao", JSON.stringify({
        data_prevista,
        frete_previsto,
        pagamento_previsto
    }))

    window.location.href = "?incfor&id=" + id_produto



})

$('.check_recorrente').click(function(e) {
    var id_produto = $(this).attr("dados_id");
    //pegar o id
    var check = document.getElementById(id_produto);

    if (check.checked) {
        $.ajax({
            type: "POST",
            data: "prodR=" + id_produto, //recorrente
            url: "crud.php",
            async: false
        }).then(sucesso, falha);

        function sucesso(data) {
            $sucesso = $.parseJSON(data)["sucesso"];
            if ($sucesso) {} else {
                alertify.alert("Erro || contatar suporte");
            }
        }

        function falha() {
            console.log("erro");
        }

    } else {
        $.ajax({
            type: "POST",
            data: "prodN=" + id_produto, //recorrente
            url: "crud.php",
            async: false
        }).then(sucesso, falha);

        function sucesso(data) {
            $sucesso = $.parseJSON(data)["sucesso"];
            if ($sucesso) {

            } else {
                alertify.alert("Erro || contatar suporte");
            }
        }

        function falha() {
            console.log("erro");

        }
    }
})


$("#finalizar_pedido").submit(function(e) {
    e.preventDefault();
    var formulario = $(this);
    var retorno = finalizar_pedido(formulario)

})


function finalizar_pedido(dados) {
    $.ajax({
        type: "POST",
        data: dados.serialize(),
        url: "crud.php",
        async: false
    }).then(sucesso, falha);

    function sucesso(data) {
        $mensagem = $.parseJSON(data)["mensagem"];
        $sucesso = $.parseJSON(data)["sucesso"];
        $cd_pedido = $.parseJSON(data)["codigo_pedido"];

        if ($sucesso) {
            let diretorio = ""
            window.location.href = "?slc&" + "cds=" + $cd_pedido;
            localStorage.removeItem("dados_solicitacao")

            // Swal.fire(
            //     'Pedido finalizado! Codigo do seu pedido ',
            //     'A equipe da marvolt entrara em contato com voçê via email para a confirmação da situação dos produtos',
            //     'success'
            // )

        } else {
            Swal.fire({
                icon: 'error',
                title: $mensagem,

            })

        }
    }

    function falha() {
        console.log("erro");
    }

}
</script>