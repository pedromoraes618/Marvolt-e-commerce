<section class="consulta">
    <div class="bloco-pesquisa">
        <form method="get">
            <div class="cx-pesquisa">
                <input type="text" name="csta_ctgr" placeholder="O que você procura?">
                <input type="hidden" name="pesquisa">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>
    <div class="dados_tabela">
        <table class="table table-bordered">
            <thead>
                <tr id="cabecalho_pesquisa_consulta">
                    <td >
                        <p>Código</p>
                    </td>
                    <td>
                        <p>Categoria</p>
                    </td>
     
                    <td>
                    </td>
                </tr>
            </thead>

            <tbody>
                <?php 
                if(isset($_GET['pesquisa'])){
                if(isset($_GET["csta_ctgr"])){
                    while($linha = mysqli_fetch_assoc($resultado_select)){
                        $b_id = $linha["cl_id"];
                        $b_categoria = ($linha["cl_descricao"]);
                      ?>

                <tr id="body_pesquisa_consulta">
                    <td>
                        <p><?php echo $b_id ; ?></p>
                    </td>
                    <td>
                        <font size="2"><?php echo $b_categoria ?> </font>
                    </td>
        
                    <td>
                        <a href="" class="btn-acao-editar">
                            <button type="button" name="Editar">Editar</button>
                        </a>
                    </td>

                </tr>
                <?php
                    }
            }
        }
                ?>
            </tbody>
        </table>
    </div>
</section>