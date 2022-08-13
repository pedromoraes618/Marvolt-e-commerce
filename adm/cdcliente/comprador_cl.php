<?php 
session_start();

if(isset($_SESSION['venda'])){
}else{
    $_SESSION['venda'] = array();
}


if (isset($_GET["enviar"])){
    $cliente = $_GET['cliente'];

    $_GET['id']+=1;
    if($_GET['id'] == ""){
        $_GET['id'] =  0;
    }else{
        $id = $_GET['id'];
        $contador = $id + 1;
    }
    }
  
    if(isset($_GET['id'])){
        array_push($_SESSION['venda'], $_GET);
   
    }

    if(isset($_GET['del'])){
        $delete = $_GET['del'];
        unset($_SESSION['venda'][$delete]);
    
    }
    

require_once("../conexao/conexao.php");
         

/*
if(isset($_GET['teste'])){
    $_SESSION['venda'] = [];
}

*/


/*
if(isset($_GET['del'])){
    print_r($_SESSION['venda']);
    $del = $_GET['del'];
   
  
  
   }
   */

?>


<?php 

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho compras</title>
</head>

<h1>Produtos</h1>

<body>


    <form action="comprador_cl.php" method="get">
    
    <input type="text" name="cliente" id="cliente" placeholder="Digite o cliente" value="<?php if(isset($_GET['codigo']))
    
    {
        $codigo = $_GET['codigo'];
        echo $codigo;
    }elseif(isset($_GET['cliente'])){
        $codigoCliente = $_GET['cliente'];
        echo $codigoCliente;

    }
    ?>">

     <input type="text" name="clienteID" id="clienteID" placeholder="clienteID"  value="">

        <input type="hidden" id="id" name="id" value="<?php if(isset($_GET['enviar'])){
            echo $contador -1;
        }?>">
        <input type="text" id="campo" name="campo">
        <input type="text" id="qtd" name="qtd">
        <input type="text" id="valor" name="valor">
        <p id="texto"></p>

        <input type="submit" name=enviar value="Cadastrar" class="btn btn-info btn-sm"></input>

        <table width="700" border="1">
            <tr>
                <td>id</td>
                <td>Comprador</td>
                <td>Email</td>
                <td>Contato</td>
                <td>Cliente</td>
            </tr>

            <?php
        foreach($_SESSION['venda'] as  $chave => $valor):
                if(isset($valor['campo'])){
                 
                echo '<tr>';
                echo '<td>'.$chave  .'</td>';
                echo '<td>'. ($valor['campo']) .'</td>';
                echo '<td>'. ($valor['qtd']) .'</td>';
                echo '<td>'. ($valor['valor']) .'</td>';
              
                echo '<td><a href="comprador_cl.php?del='.$chave.'"><input type=button value="Deletar"  > </a></td>';
                echo '</tr>';
                


                
            }
        endforeach;


        ?>

        </table>

</body>


</html>

<script>
var input = "";

function capturar(){
    input = document.getElementById('cliente').value;
    document.getElementById('clienteID').innerHTML = input;

}


</script>