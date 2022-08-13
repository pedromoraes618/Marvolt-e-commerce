<div class="card-diversos">
    <div class="card col-md-4">
        <div class="content">

            <a href="?produto=<?php echo $b_id; ?>&desc=<?php echo $b_titulo;?>&subcg=<?php echo $b_subcategoria ?>"><img class="img-responsive"
                    src="adm/cdproduto/<?php echo $b_imagem;?>"></a>

            <div class="info">
                <div class="destaque-card-titulo">
                    <p><a href="?produto=<?php echo $b_id;?>&desc=<?php echo $b_titulo; ?>&subcg=<?php echo $b_subcategoria ?>"> <?php echo $b_titulo;?></a></p>
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