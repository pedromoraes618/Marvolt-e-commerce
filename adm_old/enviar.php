<html>

<head>
    <meta charset="UTF-8">

    <!-- estilo -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <main>
        <form class="form-horizontal" action="recebe.php" method="POST">
            <fieldset>

                <label class="col-md-1 control-label" for="enviar">nome</label>
                <input type="text" name="nome" id="nome" value="">

                <label class="col-md-2 control label for singlebutton">
                    <button type="submit" class="btn btn-success" name="enviar">Enviar dados</button>
                </label>
            </fieldset>

            <?php 
            if(isset($_POST['enviar'])){
                      print_r($_POST);
            }
?>

        </form>


    </main>


</body>

</html>