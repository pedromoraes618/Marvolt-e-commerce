<?php 


$select = "SELECT * from tb_categoria";
$lista_categoria = mysqli_query($conecta,$select);
if(!$lista_categoria){
    die("Falaha no banco de dados");
 }

 
$select = "SELECT * from tb_subcategoria";
$lista_subcategoria = mysqli_query($conecta,$select);
if(!$lista_subcategoria){
    die("Falaha no banco de dados");
 }


$select = "SELECT * from tb_fabricante";
$lista_fabricante = mysqli_query($conecta,$select);
if(!$lista_fabricante){
    die("Falaha no banco de dados");
 }