<?php 
if($_GET){
//consultar produtos
if (isset($_GET['csta_prod'])){
    include "classes/produto/consulta.php";
    include "crud.php";
}elseif(isset($_GET['csta_ctgr'])){
    include "classes/categoria/consulta.php";
    include "crud.php";
}
}