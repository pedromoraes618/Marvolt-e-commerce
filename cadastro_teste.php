<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PHP com AJAX</title>

    <link href="_css/estilo.css" rel="stylesheet">
</head>

<body>
    <main>
        <div id="janela_formulario">

            <form id="formulario_transportadora">
                <label for="nometransportadora">Nome da Transportadora</label>
                <input type="text" name="nometransportadora" id="nometransportadora">

                <button type="button" id="buttom">Adicionar</button>

                <div id="mensagem">
                    <table>

                    </table>
                </div>
            </form>

        </div>
    </main>

    <script src="_js/jquery.js">

    </script>
    <script>
    var numeros = [];
    $("#buttom").click(function(e) {
        e.preventDefault();

        var nome = document.getElementById("nometransportadora")
        var id = Math.random(100, 20000);
        produtos = {
            "codigoid":id,
            "produto": nome.value
        };
        numeros.push(produtos);

        for ( item in numeros) {
            $("#mensagem table").html("<tr><td>" + item+ "</td></td>")

        }




    })
    </script>
</body>

</html>