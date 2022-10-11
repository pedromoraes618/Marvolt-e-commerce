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
            <p><?php echo categoria($b_id); ?></p>

            <?php while ($linha = mysqli_fetch_assoc($resultado_subcategoria_mobile)) {
                        $b_subcategoria = ($linha['cl_descricao']);
                        $b_id_mobile = $linha['cl_id'];
                         ?>
            <li>
                <a href="?subcategoria=<?php echo $b_id_mobile; ?>">
                    <p> <?php echo $b_subcategoria; ?></p>
                </a>
                <div class="qtd">
                    <p><?php  echo qtd_subcategoria($b_id_mobile); ?></p>
                </div>

            </li>

            <?php }?>
        </ul>
    </nav>
</div>