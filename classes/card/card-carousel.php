<div class="card">
    <div class="content">
        <div class="header">
            <a href="?produto=<?php echo $b_id; ?>&desc=<?php echo $b_titulo;?>&subcg=<?php echo $b_subcategoria ?>"><img
                    class="img-responsive" src="adm/cdproduto/<?php echo $b_imagem;?>"></a>
        </div>
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
                <li>
                        <p style="color:green ;"><?php if($b_disponivel == 1){
                            echo "Disponivel". "   ".real_format($b_valor) ; 
                        } ?></p>
                    </li>
            </ul>
            <div class="card-footer">
                <?php
                if(isset($_SESSION["user_portal"])){
                 ?>
                <a href="?acao=add&id=<?php echo $b_id; ?>" class="add-carrinho">
                    <i class="fa-solid fa-cart-plus"></i> Adicionar
                </a>
                <?php
              }else{
                ?>
                <a href="login.php" class="add-carrinho">
                    <i class="fa-solid fa-cart-plus"></i> Entre com o seu login
                </a>
                <?php
              }
                 ?>
            </div>

        </div>
    </div>
</div>