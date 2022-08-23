<?php 


$select = "SELECT * from tb_categoria";
$lista_categoria = mysqli_query($conecta,$select);
if(!$lista_categoria){
    die("Falaha no banco de dados");
 }

 
$select = "SELECT s.cl_id, s.cl_descricao, c.cl_descricao as categoria_descricao from tb_subcategoria as s inner join tb_categoria as c on c.cl_id = s.cl_categoria";
$lista_subcategoria = mysqli_query($conecta,$select);
if(!$lista_subcategoria){
    die("Falaha no banco de dados");
 }


$select = "SELECT * from tb_fabricante";
$lista_fabricante = mysqli_query($conecta,$select);
if(!$lista_fabricante){
    die("Falaha no banco de dados");
 }


 $select = "SELECT * from tb_embalagem";
$lista_embalagem = mysqli_query($conecta,$select);
if(!$lista_embalagem){
    die("Falaha no banco de dados");
 }

