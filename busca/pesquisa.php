<?php
if($_GET){
   
if (isset($_GET['categoria'])) {
    $b_id = $_GET['categoria'];
    include "crud_categoria.php";
    include "/../classes/categoria/pagina.php";
    
}elseif(isset($_GET['subcategoria'])) {
$b_id = $_GET['subcategoria'];
include "crud_categoria.php";
include "/../classes/subcategoria/pagina.php";

}elseif(isset($_GET['produto'])) {
    $b_id = $_GET['produto'];
    $b_desc = $_GET['desc']; //titulo do produto

    include "crud_categoria.php";
    include "/../classes/produto/pagina.php";
    }
}
?>