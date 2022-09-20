<div class="menu_filtro">
    <div class="filtro">
        <button id="abrir_filtro" type="button"><i class="fa-solid fa-filter"></i>
            <p> Filtro</p>
        </button>
    </div>
    <nav>
        <div class="titulo">
            <p>Filtro</p> <i class="fa-solid fa-filter"></i><button id="fechar_filtro" type="button"><i
                    class="fa-solid fa-xmark"></i></button>
        </div>
        <ul>
            <p><?php echo titulo_subcategoria($b_id);   ?></p>

            <?php    while ($linha = mysqli_fetch_assoc($resultado_produto_f_filtro)) {
                       $b_fabricante = utf8_encode($linha['inner_fabricante']);
                       $b_id_f = $linha['inner_id_fabricante'];
                        ?>
            <li>
                <a href="?subcategoria=<?php echo $b_id_f; ?>">
                    <p> <?php echo $b_fabricante; ?></p>
                </a>
                <div class="qtd">
                    <p><?php    echo qtd_fabricante($b_id_f,$b_id); ?></p>
                </div>

            </li>

            <?php }?>
        </ul>
    </nav>
</div>
