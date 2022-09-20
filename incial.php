<div class="row" id="fornecedor-1">

    <div id="about-carousel-fornecedor" class="about-carousel">
        <div id="fornecedor_carousel" class="owl-carousel owl-them">
            <div class="item">
                <div class="card">
                    <div class="content">
                        <a target="_blank">
                            <img src="img/fornecedores/weg-logo.svg">
                        </a>
                    </div>

                </div>
            </div>
            <div class="item">
                <div class="card">
                    <div class="content">
                        <a target="_blank">
                            <img src="img/fornecedores/philips-logo.png">
                        </a>
                    </div>

                </div>
            </div>

            <div class="item">
                <div class="card">
                    <div class="content">
                        <a target="_blank"><img src="img/fornecedores/logo-famac.png"></a>
                    </div>

                </div>
            </div>
            <div class="item">
                <div class="card">
                    <div class="content">
                        <a title="Ir para o site" target="_blank"><img src="img/fornecedores/logo-fsermat.png"></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card">
                    <div class="content">
                        <a target="_blank"><img src="img/fornecedores/hp-logo.svg"></a>
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
    <!-- 
                <div class="botao-contao">
                    <button class="contato-center">Contato
                    </button>
                </div> -->

</div>

<div class="row" id="categoria-incial">
    <div class="baner-1">
        <div class="baner-categoria">
            <img src="img/baner1.png" class="img-responsive">
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
    <div class="baner-2">
        <div class="baner-categoria">
            <img src="img/baner2.png" class="img-responsive">
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




</div>

<div class="row" id="center-3">
    <div class="center-3-1">
        <div class="card-categoria">
            <div class="img">
                <a href="">
                    <img src="img/ferramentas.jpg">
                </a>
            </div>
            <div class="titulo">
                <p>
                    Ferramentas
                </p>
            </div>
        </div>
        <div class="card-categoria">
            <div class="img">
                <a href="">
                    <img src="img/ti.jpg">
                </a>
            </div>
            <div class="titulo">
                <p>
                    Tecnologia
                </p>
            </div>
        </div>
        <div class="card-categoria">
            <div class="img">
                <a href="">
                    <img src="img/inner-page-cabeamento-eletrico-img.jpg">
                </a>
            </div>
            <div class="titulo">
                <p>
                    Elétrico
                </p>
            </div>
        </div>
        <div class="card-categoria">
            <div class="img">
                <a href="">
                    <img src="img/hidraulico.jpg">
                </a>
            </div>
            <div class="titulo">
                <p>
                    Hidraulico
                </p>
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
                            $b_disponivel = ($linha["cl_disponivel"]);
                            $b_valor = ($linha["cl_valor"]);
						?>
            <?php 
            include "classes/card/card.php";    
            
            }?>
        </div>

    </div>
</div>

