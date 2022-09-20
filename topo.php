<div class="secition-top">
    <div class="top-1-1" id="movelmenu">
        <section class="top-1-1-1">

            <div class="col logo-marvolt-top-1">
                <a href="/marvoltect"> <img src="img/LogoPreto.png"></a>
            </div>
            <div class="col menu-cliente">
                <nav class="dp-cliente">
                    <ul>
                        <li>
                            <i class="fa-solid fa-circle-user"></i><?php
                                if(isset($_SESSION["user_portal"])){
                                    ?>
                            <a>
                                <?php
                                    echo $b_cliente;
                                    ?>
                            </a>
                            <?php
                                }else{
                                    ?>
                            <a href="login.php">
                                <?php
                                  echo "Login - Cadastrar";
                                  ?>
                            </a>
                            <?php
                                } ?>
                            <ul>
                                <?php 
                                 if(isset($_SESSION["user_portal"])){
                                ?>
                                <li><a href="">Meu usuario</a></li>
                                <hr style="margin-top:0px;margin-bottom:0px">
                                <li><a href="deslogar.php">Sair</a></li>
                                <?php 
                                 }else{
                                    ?>
                                <li><a href="login.php">Login</a></li>
                                <hr style="margin-top:0px;margin-bottom:0px">

                                <?php 
                                 }
                                ?>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>

        </section>
    </div>

    <form method="get">
        <div class="top-1-2">

            <section class="top-1-1-2">
                <div class="col logo-marvolt">
                    <a href="/marvoltect"> <img src="img/LogoPreto.png">
                    </a>
                </div>

                <div class="col input-pesquisa">
                    <div class="cx-pesquisa">
                        <input type="text" name="buscar" placeholder="O que você procura?">
                        <button class="img-pesquisar glyphicon glyphicon-search">

                    </div>
                </div>
                <div class="carrinho-compras">
                    <?php 
                              if(isset($_SESSION["user_portal"])){
                    ?>
                    <a href="?car">
                        <?php
                              }else{
                                ?>
                        <a href="?logincr">
                            <?php
                              }
                    ?>
                            <i class="fa-solid fa-cart-shopping"></i>
                            <div class="qtd-carrinho"><?php if(!isset($qtd_carrinho)){
$qtd_carrinho = 0;
echo $qtd_carrinho;
                        }else{ echo $qtd_carrinho;} ?></div>
                        </a>
                </div>
            </section>
        </div>
        <div class="top-1-3">
            <div class="menu-mobile">
                <?php 
                    include "menu_mobile.php";
                 ?>
            </div>
            <?php 
                 include "menu.php";
          ?>
        </div>

</div>