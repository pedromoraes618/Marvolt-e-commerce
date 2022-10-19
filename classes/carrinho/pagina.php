<?php 






//consultar tabela produto 
    $select = "SELECT f.cl_descricao as fabricante,cl_disponivel,cl_valor, c.cl_quantidade as quantidade, p.cl_titulo as titulo,p.cl_subcategoria as subcategoria, c.cl_sessao, c.cl_id,c.cl_produtoID as id_produto, p.cl_titulo as titulo, p.cl_imagem as imagem from tb_carrinho as c
     inner join tb_produto as p on p.cl_id = c.cl_produtoID inner join tb_fabricante as f on f.cl_id = p.cl_fabricante  where c.cl_cliente = $b_id_cliente and c.cl_sessao = '$sessao'";
    $resultado_carrinho = mysqli_query($conecta, $select);
    if(!$resultado_carrinho){
        include "classes/erro/504.php";
    }

    //pegar q quantidade de produtos que estão no carrinho
$select = "SELECT sum(cl_quantidade) as qtd_prod from tb_carrinho where cl_cliente = $b_id_cliente and cl_sessao = '$sessao' and cl_produtoID > 0 ";
$resultado_qtd_carrinho = mysqli_query($conecta, $select);
if(!$resultado_qtd_carrinho){
    include "classes/erro/504.php";
}else{
$linha = mysqli_fetch_assoc($resultado_qtd_carrinho);
$qtd_carrinho = $linha['qtd_prod'];

}


    // if(isset($_GET['enviar_pedido'])){
    //     echo "sim";
    //     $sessao = $sessao + 1;
    //     $inserir = "INSERT INTO tb_carrinho ";
    //     $inserir .= "(cl_data,cl_cliente,cl_produtoID,cl_sessao)";
    //     $inserir .= " VALUES ";
    //     $inserir .= "('$hoje','$b_id_cliente','fechado','$sessao' )";
    //     $operacao_fechar_pedido = mysqli_query($conecta, $inserir);
    //     if(!$operacao_fechar_pedido){
    //         include "classes/erro/504.php";
    //     }
    // }
?>

<div class="row" id="bloco">
    <div class="container">
        <div class="bloco-carrinho">
            <div class="titulo-carrinho">
                <h3>Carrinho de produtos</h3>
            </div>
            <?php 
                  if($qtd_carrinho !=""){
            ?>
            <div id="produto-carrinho" class="produto-carrinho">
                <nav>
                    <ul>

                        <?php
                  
while($linha = mysqli_fetch_assoc($resultado_carrinho)){
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
?>
                        <li>
                            <div class="blco-produto">
                                <div class="img-produtos">
                                    <a
                                        href="?produto=<?php echo $id_produto; ?>&desc=<?php echo $titulo;?>&subcg=<?php echo $subcategoria ?>">
                                        <img src="<?php echo "adm/classes/produto/".$img;?>">
                                    </a>
                                </div>
                                <div class="bloco-informacao">
                                    <a
                                        href="?produto=<?php echo $id_produto; ?>&desc=<?php echo $titulo;?>&subcg=<?php echo $subcategoria ?>">
                                        <p class="titulo">
                                            <?php echo $titulo_prod; ?>
                                        </p>
                                    </a>
                                    <p class="fabricantes"><?php echo $fabricante ?></p>
                                    <p class="qtd">Qtd: <a href="?incfor&id=<?php echo $id ?>"><?php echo $qtd; ?></a>
                                    </p>

                                    <p><?php if($disponivel == 1){
                                         echo real_format($valor) ; 
                                      } ?></p>

                                    <a href="?incfor&id=<?php echo $id ?>" class="btn-add-informacao">
                                        Incluir Informações
                                    </a>

                                    </a>
                                    <a href="" class="excluir" id_prod_exlr="<?php echo $id; ?>"
                                       >
                                        <!-- href="?acao=del&id=-->
                                        Excluir
                                    </a>
                                </div>
                                <hr style="width:80%;margin-bottom:5px">
                            </div>

                        </li>


                        <?php
}

?>
                    </ul>
                </nav>

                <div class="fechar-pedido">
                    <p class="qtd_itens">Quantidades de itens: <?php echo $qtd_carrinho; ?></p>
                    <a href="?fecharpd">
                        Fechar Solicitação
                    </a>
                    <a href="index.php" class="cnt_comprando">
                        Continuar Comprando
                    </a>
                </div>
            </div>
            <?php 
            }else{

                echo "
                <div class='img-carrinho-vazio'>
                <img width='100%' src='img/carrinho-vazio.svg'>
                <p>Ops!<br>Seu carrinho está vazio!</p>,
                <a href='index.php'>Continuar comprando</a>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</div>

<script src="_js/jquery.js"></script>
<script src="_js/script.js"></script>

<script>
$('#produto-carrinho ul li a.excluir').click(function(e) {
    e.preventDefault();
  
    let cliente = document.getElementById("cliente").value
    let sessao = document.getElementById("sessao").value
    let id_prod = $(this).attr("id_prod_exlr")

    Swal.fire({
        title: 'Tem certeza?',
        text: "Deseja remover o produto do carrinho",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Não',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim'
    }).then((result) => {
        if (result.isConfirmed) {
            $(this).parent().parent().fadeOut();
            $.ajax({
                type: "POST",
                data: "acao=del&id=" + id_prod + "&cliente=" + cliente + "&sessao=" +
                    sessao, //recorrente
                url: "crud.php",
                async: false
            }).then(sucesso, falha);

            function sucesso(data) {
                $sucesso = $.parseJSON(data)["sucessoDel"];
                $qtdcar = $.parseJSON(data)["car"];
                if ($sucesso) {
                    Swal.fire(
                        'Removido!',
                        'Produto removido com sucesso.',
                        'success'
                    )
                    $(".qtd-carrinho").html($qtdcar);
                    $(".qtd_itens").html("Quantidades de itens: " + $qtdcar);

                }
            }
            function falha() {
                console.log("erro");
            }

        }
    })


});
</script>