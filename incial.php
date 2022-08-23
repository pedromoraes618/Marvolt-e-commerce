<div class="row" id="fornecedor-1">

    <div id="about-carousel-fornecedor" class="about-carousel">
        <div id="fornecedor_carousel" class="owl-carousel owl-them">
            <div class="item">
                <div class="card">
                    <div class="content">
                        <a target="_blank">
                            <div class="item"><img src="img/fornecedores/weq.PNG"></div>
                        </a>
                    </div>

                </div>
            </div>
            <div class="item">
                <div class="card">
                    <div class="content">
                        <a target="_blank">
                            <div class="item"><img src="img/fornecedores/fphilips.PNG"></div>
                        </a>
                    </div>

                </div>
            </div>

            <div class="item">
                <div class="card">
                    <div class="content">
                        <a target="_blank"><img src="img/fornecedores/ffamac.PNG"></a>
                    </div>

                </div>
            </div>
            <div class="item">
                <div class="card">
                    <div class="content">
                        <a title="Ir para o site" target="_blank"><img src="img/fornecedores/fsermat.PNG"></a>
                    </div>

                </div>
            </div>
            <div class="item">
                <div class="card">
                    <div class="content">
                        <a target="_blank"><img src="img/fornecedores/fhp.PNG"></a>
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
            <p class="linha"></p>
        </div>
    </div>
    <div id="about-carousel" class="about-carousel">
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
                    <?php
                    include "classes/card/card-carousel.php"
                    ?>
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

<div class="row" id="categoria-incial">
    <div class="baner-1">
        <div class="baner-categoria">
            <img src="img/baner1.PNG" class="img-responsive" width="90%">
        </div>
        <div id="about-carousel" class="about-carousel">
            <div id="categoria-apresentacao-1" class="owl-carousel owl-them">
                <?php 
                while($linha = mysqli_fetch_assoc($resultado_categoria_1)){
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
                        <?php
                    include "classes/card/card-carousel.php"
                    ?>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>

    </div>
    <div class="baner-2">
        <div class="baner-categoria">
            <img src="img/baner2.PNG" class="img-responsive" width="90%">
        </div>
        <div id="about-carousel" class="about-carousel">
            <div id="categoria-apresentacao-2" class="owl-carousel owl-them">
                <?php 
                while($linha = mysqli_fetch_assoc($resultado_categoria_2)){
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
                        <?php
                    include "classes/card/card-carousel.php"
                    ?>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>

    </div>




</div>

<hr>
<div class="row" id="center-2">
    <div class="center-2-1">
        <div class="texto-center">
            <h3>Diversos</h3>
            <p class="linha"></p>
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
