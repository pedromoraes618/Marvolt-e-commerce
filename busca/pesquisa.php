<?php

use FontLib\Table\Type\head;

if($_GET){
   
if (isset($_GET['categoria'])) {
    $b_id = $_GET['categoria'];
    include "crud_categoria.php";
    include "classes/categoria/pagina.php";
    
}elseif(isset($_GET['subcategoria'])) {
$b_id = $_GET['subcategoria'];
include "crud_categoria.php";
include "classes/subcategoria/pagina.php";

}elseif(isset($_GET['produto'])) {
    $b_id = $_GET['produto'];
    $b_desc = $_GET['desc']; //titulo do produto
    include "crud_categoria.php";
    include "classes/produto/pagina.php";
}elseif(isset($_GET['buscar'])or isset($_GET['pagina'])){
    include "crud_categoria.php";
    include "classes/buscar/pagina.php";
}elseif(isset($_GET['addavalicao'])){
    include "crud_categoria.php";
    include "classes/avaliacao/pagina.php";
    
}elseif(isset($_GET['acao']) or (isset($_GET['car']))){
    include "crud_categoria.php";
    include "classes/carrinho/pagina.php";
}elseif(isset($_GET['incfor'])) {
    include "crud_categoria.php";
    include "classes/carrinho/add_info_prod.php";
    
    }elseif(isset($_GET['logincr'])){
        include "crud_categoria.php";
        include "classes/carrinho/card_login.php";
    }
//elseif(isset($_GET['enviar_pedido'])){
//     include "crud_categoria.php";
//     include "classes/carrinho/pagina.php";
// }
}
?>