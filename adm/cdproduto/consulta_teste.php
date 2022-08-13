<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

</head>

<body>
    <button class="btn">load</button>
    <input type="text" id=nome  placeholder="buscar por" name="nome">
    <div class="result"></div>



</body>
<script src="../jquery.js"></script>

</html>

<script>
$(function() {
    $(".btn").on("click", function() {
        var buscar = document.getElementById("nome").value
      
        $.ajax({
            
            type: 'GET',
            url: "teste.php?codigo="+buscar,
            success: function(result) {
                $(".result").html(result);
            },
        });
    })
})
</script>