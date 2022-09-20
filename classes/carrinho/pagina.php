<?php 


//funcao para verificar se é o mesmo produto que está sendo adicionado duas vez/ se for não realizar o insert no banco de dados
function verificaProd($b_id_cliente,$sessao,$id_prod){
    include "conexao/conexao.php";
    //pegar se o usuario está adicionado o mesmo produto a mesma sessao
    $select = "SELECT * from tb_carrinho where cl_cliente = $b_id_cliente and cl_sessao = '$sessao' and cl_produtoID = $id_prod";
    $resultado_produto_sessao = mysqli_query($conecta, $select);
    if(!$resultado_produto_sessao){
        include "classes/erro/504.php";
    }else{
    $linha = mysqli_fetch_assoc($resultado_produto_sessao);
    $id_produto = $linha['cl_produtoID'];
    return $id_produto;
    }
}

if(isset($_GET['acao'])){
    if(!empty($_GET['id'])){
        $id_prod = $_GET['id'];
        //Sera adicionado o produto apenas se o id for diferente dos produto já adicionados na mesma sessao
        if(verificaProd($b_id_cliente,$sessao,$id_prod) != $id_prod){
        //adicionar o produto no carrinho
            if(($_GET['acao'] == "add")){
            $inserir = "INSERT INTO tb_carrinho ";
            $inserir .= "(cl_data,cl_cliente,cl_produtoID,cl_sessao,cl_quantidade)";
            $inserir .= " VALUES ";
            $inserir .= "('$hoje','$b_id_cliente','$id_prod','$sessao',1)";
            $operacao_inserir = mysqli_query($conecta, $inserir);
                if(!$operacao_inserir){
                    include "classes/erro/504.php";
                }
            }
        }

            if(($_GET['acao'] == "del")){
               
                $delete = "DELETE FROM tb_carrinho where cl_id = '$id_prod' and cl_cliente = $b_id_cliente ";
                $operacao_delete = mysqli_query($conecta, $delete);
                if(!$operacao_delete){
                    include "classes/erro/504.php";
                }
            }
    
    }else{
    include "classes/erro/404.php";
    }
}  



//consultar tabela produto 
    $select = "SELECT f.cl_descricao as fabricante,c.cl_quantidade as quantidade, p.cl_titulo as titulo,p.cl_subcategoria as subcategoria, c.cl_sessao, c.cl_id,c.cl_produtoID as id_produto, p.cl_titulo as titulo, p.cl_imagem as imagem from tb_carrinho as c
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
            <div class="produto-carrinho">
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
?>
                        <li>
                            <div class="blco-produto">
                                <div class="img-produtos">
                                    <a
                                        href="?produto=<?php echo $id_produto; ?>&desc=<?php echo $titulo;?>&subcg=<?php echo $subcategoria ?>">
                                        <img src="<?php echo "adm/cdproduto/".$img;?>">
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
                                    <a href="?incfor&id=<?php echo $id ?>" class="btn-add-informacao">
                                        Incluir Informações
                                    </a>

                                    </a>
                                    <a onclick="return confirm('Tem certeza que deseja remover este produto?')"
                                        href="?acao=del&id=<?php echo $id ?>">
                                        Excluir
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

                <div class="fechar-pedido">
                    <P>Quantidades de itens: <?php echo $qtd_carrinho; ?></P>
                    <a href="?fecharpd">
                        Fechar pedido
                    </a>
                    <a href="index.php">
                        Continuar comprando
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