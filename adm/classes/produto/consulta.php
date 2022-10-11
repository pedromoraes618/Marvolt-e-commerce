<section class="consulta">
    <div class="bloco-pesquisa">
        <form method="get">
            <div class="cx-pesquisa">
                <input type="text" name="csta_prod" placeholder="O que você procura?">
                <input type="hidden" name="pesquisa">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>
    <div class="dados_tabela">
        <table class="table table-bordered">
            <thead>
                <tr id="cabecalho_pesquisa_consulta">
                    <td>
                        Código
                    </td>

                    <td>
                        Titulo
                    </td>
                    <td>
                        Categoria
                    </td>
                    <td>
                        Fabricante
                    </td>
                    <td>
                        Ativo
                    </td>
                    <td>
                        Destaque
                    </td>
                    <td>

                    </td>

                </tr>
            </thead>

            <tbody>
                <?php 
                if(isset($_GET['pesquisa'])){
                if(isset($_GET["csta_prod"])){
                    while($linha = mysqli_fetch_assoc($operacao_select_produto)){
                      $b_id = $linha["cl_id"];
                      $b_imagem = ($linha["cl_imagem"]);
                      $b_titulo = ($linha["cl_titulo"]);
                      $b_descricao = (($linha["cl_descricao"]));
                      $b_fabricante = ($linha["as_descricao_fabricante"]);
                      $b_categoria = ($linha["as_descricao_categoria"]);
                      $b_ativo = ($linha["cl_ativo"]);
                      $destaque = ($linha["cl_destaque"]);
                      ?>

                <tr id="body_pesquisa_consulta">
                    <td >
                        <p><?php echo $b_id ; ?></p>
                    </td>

                    <td>

                        <?php echo $b_titulo; ?>
                        >
                    </td>

                    <td>
                        <?php echo $b_fabricante; ?>
                    <td>
                        <?php echo $b_categoria; ?>
                    </td>
                    <td>
                        <?php if($b_ativo==1){
                                ?><i style="color:green; cursor:pointer" title="ativo"
                            class="fa-solid fa-circle-check"></i><?php
                            }else{
                                ?>
                        <i style="color:red;cursor:pointer" title="Inativo" class="fa-solid fa-circle-xmark"></i>
                        <?php
                            }?>

                    </td>
                    <td>
                        <?php if($destaque==1){
                                ?><i style="color:yellow; cursor:pointer" title="Destaque"
                            class="fa-solid fa-star"></i><?php
                            }?>

                    </td>
                    <td>
                        <a href="" class="btn-acao-editar">
                            <button type="button" name="Editar">Editar</button>

                        </a>
                        <a onclick="window.open('editar_cliente.php?codigo=', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');"
                            class="btn-acao-editar">
                            <button class="img" name="Editar">Imagem</button>
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