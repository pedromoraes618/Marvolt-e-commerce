<?php 

?>
<div class="row" id="bloco">
    <div class="tile-bloco">
        <p>Buscar por <?php 
        echo $b_desc_p; ?></p>
    </div>
    <div class="container">
        <div class="bloco-1">



        </div>


        <div class="bloco-2">
            <div class="about-card">

                <?php 
                if (mysqli_num_rows($resultado_busca)==0)
                {
                   ?>
                <div class="msg-alert">
                    <p>Nenhum produto encontrado</p>
                </div>
                <?php
                } else {
              
						while($linha = mysqli_fetch_assoc($resultado_busca)){
                            $b_id = ($linha["cl_id"]);
                            $b_imagem = ($linha["cl_imagem"]);
                            $b_titulo = ($linha["cl_titulo"]);
                            $b_fabricante = ($linha["fabricante"]);
                            $b_embalagem = ($linha["embalagem"]);
                            $b_codigo = ($linha["cl_codigo"]);
                            $b_subcategoria = ($linha["cl_subcategoria"]);
						?>

                <?php 
            include "/../card/card.php";    
            } 
                }?>
            </div>
          
        </div>

    </div>
</div>
<?php ?>