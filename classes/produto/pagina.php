<div class="row" id="bloco-desc-prod">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="margin-bottom:0px;">
            <li class="breadcrumb-item"><a href="/marvoltect"><i class="fas fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="?categoria=<?php echo $b_id_categoria; ?>"><?php echo  (($b_desc_categoria)); ?></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="?subcategoria=<?php echo $b_id_subcategoria;?>">
                    <?php echo $b_desc_subcategoria; ?></a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo  ucfirst(($b_desc_titulo)); ?></a></li>
        </ol>
    </nav>
    <div class="container">

        <div class="bloco-1">
            <div class="img">
                <img src="adm/cdproduto/<?php echo $b_desc_img;?>">
            </div>
        </div>

        <div class="bloco-2">
            <div class="info">
                <div class="titulo">
                    <p><?php echo $b_desc_titulo; ?></p>
                </div>

                <ul>
                    <li>
                        <p>Código: <?php echo $b_desc_codigo; ?></p>
                    </li>
                    <li>
                        <p>Modelo: <?php echo $b_desc_modelo; ?></p>
                    </li>
                    <li>
                        <p>Fabricante: <?php echo $b_desc_fabricante ?></p>
                    </li>
                    <li>
                        <p>Embalagem: <?php echo $b_desc_embalagem ?></p>
                    </li>
                    <li>
                        <p style="color:green ;"><?php if($b_disponivel == 1){
                            echo "Disponivel". "   ".real_format($b_valor) ; 
                        } ?></p>
                    </li>
                </ul>

            </div>
          
            <?php
                if(isset($_SESSION["user_portal"])){
                 ?>
            <a href="?acao=add&id=<?php echo $b_id; ?>" class="add-carrinho">
                <div class="add-carrinho-desc">
                    <i class="fa-solid fa-cart-plus"></i> Adicionar
                </div>
            </a>
            <?php
              }else{
                ?>
            <a href="login.php" class="add-carrinho">
                <div class="add-carrinho-desc">
                    <i class="fa-solid fa-cart-plus"></i> Entre com o seu login
                </div>
            </a>
            <?php
              }
                 ?>

        </div>

    </div>
    <div class="container-2">
        <div class="titulo-prod">
            <h3>Descrição</h3>
        </div>
        <div class="descricao-prod">
            <p><?php echo $b_desc_descricao; ?></p>

        </div>

    </div>
    <hr>
    <div class="container-3">

        <div class="titulo-prod">
            <h3>Produtos Relacionados</h3>

        </div>
        <div id="about-carousel-prod" class="about-carousel">

            <div id="carousel-prod" class="owl-carousel owl-them">
                <?php 
                while($linha = mysqli_fetch_assoc($resultado_prod)){
                $b_id = ($linha["cl_id"]);
                $b_imagem = ($linha["cl_imagem"]);
                $b_titulo = ($linha["cl_titulo"]);
                $b_fabricante = ($linha["fabricante"]);
                $b_embalagem = ($linha["embalagem"]);
                $b_codigo = ($linha["cl_codigo"]);
                $b_subcategoria = ($linha["cl_subcategoria"]);
                $b_disponivel = ($linha["cl_disponivel"]);
                $b_valor = ($linha["cl_valor"]);
                ?>
                <div class="item">
                    <?php
                    include "classes/card/card-carousel.php"
                    ?>

                </div>
                <?php }?>
            </div>

        </div>
    </div>
    <div class="container-4">
        <div class="titulo-prod">
            <?php 
            if(isset($_SESSION["user_portal"])){
            ?>
            <h3>Deixe a sua avaliação</h3>
            <a href="?addavalicao=<?php echo $b_id_produto; ?>&desc=<?php echo $b_desc_titulo;?>" class="add-avaliacao">
                <i class="fa-solid fa-plus"> Avaliar o produto</i>

            </a>
            <?php 
            }else{
                ?>
            <h3>Deixe a sua avaliação</h3>
            <a href="login.php" class="add-avaliacao">
                <p>Entre com o seu login</p>
            </a>
            <?php
            }
            ?>
        </div>
        <nav>
            <?php 
            while($linha = mysqli_fetch_assoc($resultado_mapa_subcategoria)){
            $b_cliente_avaliacao = $linha['usuario'];
            $b_titulo_avaliacao = utf8_encode($linha['cl_titulo']);
            $b_descricao_avaliacao = utf8_encode($linha['cl_descricao']);
            $b_data_avaliacao = $linha['cl_data'];
            
            ?>
            <ul>
                <li>
                    <div class="comentario">
                        <div class="usuario">
                            <div class="img">
                                <img src="img/user.png">
                            </div>

                            <div class="bloco-right">
                                <div class="name">
                                    <p><?php
                                    echo $b_cliente_avaliacao;
                                    ?></p>
                                </div>
                                <div class="data">
                                    <p><?php echo formatDateB($b_data_avaliacao); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="palavra_chave">
                            <p><?php
                            echo $b_titulo_avaliacao;
                            ?>
                            </p>
                        </div>

                        <div class="texto">
                            <p><?php echo $b_descricao_avaliacao; ?></p>
                        </div>

                    </div>
                </li>
                <?php 

              }
              ?>

            </ul>
        </nav>

    </div>

</div>