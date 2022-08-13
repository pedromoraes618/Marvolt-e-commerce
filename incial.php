<div class="row" id="fornecedor-1">

    <div id="about-carousel-fornecedor" class="about-carousel">
        <div id="fornecedor_carousel" class="owl-carousel owl-them">
            <div class="item">
                <div class="card">
                    <div class="content">
                        <a href="" target="_blank">
                            <div class="item"><img src="img/fornecedores/weq.PNG"></div>
                        </a>
                    </div>

                </div>
            </div>
            <div class="item">
                <div class="card">
                    <div class="content">
                        <a href="" target="_blank">
                            <div class="item"><img src="img/fornecedores/fphilips.PNG"></div>
                        </a>
                    </div>

                </div>
            </div>

            <div class="item">
                <div class="card">
                    <div class="content">
                        <a href="" target="_blank"><img src="img/fornecedores/ffamac.PNG"></a>
                    </div>

                </div>
            </div>
            <div class="item">
                <div class="card">
                    <div class="content">
                        <a href="" title="Ir para o site" target="_blank"><img src="img/fornecedores/fsermat.PNG"></a>
                    </div>

                </div>
            </div>
            <div class="item">
                <div class="card">
                    <div class="content">
                        <a href="" target="_blank"><img src="img/fornecedores/fhp.PNG"></a>
                    </div>

                </div>
            </div>



        </div>

    </div>
</div>
<div class="row" id="center-1">


    <div class="center-1-1">
        <div class="texto-center">
            <h3>Destaques</h3>
        </div>
    </div>
    <div id="about-carousel-destaques" class="about-carousel">
        <div id="destaques_carousel" class="owl-carousel owl-them">
            <?php 
                while($linha = mysqli_fetch_assoc($resultado_destaque)){
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
    <!-- 
                <div class="botao-contao">
                    <button class="contato-center">Contato
                    </button>
                </div> -->

</div>

<div class="row" id="center-2">
    <div class="center-2-1">
        <div class="texto-center">
            <h3>Diversos</h3>
        </div>
    </div>
    <div class="center2-2">
        <div class="about-card">

            <?php 
						while($linha = mysqli_fetch_assoc($resultado_diversos)){
                            $b_id = ($linha["cl_id"]);
                            $b_imagem = ($linha["cl_imagem"]);
                            $b_titulo = ($linha["cl_titulo"]);
                            $b_fabricante = ($linha["fabricante"]);
                            $b_embalagem = ($linha["embalagem"]);
                            $b_codigo = ($linha["cl_codigo"]);
                            $b_subcategoria = ($linha["cl_subcategoria"]);
						?>
            <?php 
            include "classes/card/card.php";    
            
            }?>
        </div>

    </div>
</div>