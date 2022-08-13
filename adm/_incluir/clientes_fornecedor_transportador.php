<html>

<?php

require_once("../../conexao/conexao.php");

//consultar cliente/forncedor/transportador
$selectcft = "SELECT clienteftID, nome from forclietrans";
$lista_cft = mysqli_query($conecta, $selectcft);
if(!$lista_cft){
die("Falaha no banco de dados  Linha 31 inserir_transportadora");
}

?>

<select name="cft" id="cft">
<?php while($linha_cft = mysqli_fetch_assoc($lista_cft)){
?>
<option value="<?php echo $linha_cft["clienteftID"];?>">
    <?php echo utf8_encode($linha_cft["nome"]);?>
</option>

<?php
 }
?>

</select>






</html>
