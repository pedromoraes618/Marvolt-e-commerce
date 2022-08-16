<div class="row" id="bloco-desc-prod">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo  $b_desc_categoria; ?></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo  $b_desc_subcategoria; ?></li>

           
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
                </ul>

            </div>
            <a href="">
                <div class="add-carrinho-desc">
                    <i class="fa-solid fa-cart-plus"></i> Adicionar
                </div>
            </a>

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
                ?>
                <div class="item">
                    <div class="card">
                        <div class="content">
                            <a
                                href="?produto=<?php echo $b_id; ?>&desc=<?php echo $b_titulo;?>&subcg=<?php echo $b_subcategoria ?>"><img
                                    class="img-responsive" src="adm/cdproduto/<?php echo $b_imagem;?>"></a>
                            <div class="info">
                                <div class="destaque-card-titulo">
                                    <p><a
                                            href="?produto=<?php echo $b_id;?>&desc=<?php echo $b_titulo; ?>&subcg=<?php echo $b_subcategoria ?>">
                                            <?php echo $b_titulo;?></a></p>
                                </div>
                                <ul>
                                    <li>
                                        <p>Código: <?php echo $b_codigo; ?></p>
                                    </li>
                                    <li>
                                        <p>Fabricante: <?php echo $b_fabricante; ?></p>
                                    </li>
                                    <li>
                                        <p>Embalagem: <?php echo $b_embalagem; ?></p>
                                    </li>
                                </ul>

                                <a href="?add=<?php ?>" class="add-carrinho">
                                    <i class="fa-solid fa-cart-plus"></i> Adicionar
                                </a>

                            </div>
                        </div>

                    </div>
                </div>
                <?php }?>
            </div>

        </div>
    </div>
</div>
<?php ?>