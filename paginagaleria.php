<?php include "header.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title>Clinica Melhor Sorriso</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- estilos css -->
    <link rel="stylesheet" href="css/estilopaginagaleria.css?v=15">

    <script>
            console.log("entramos na pagina")
            $(document).ready(function () {
                    
                $(".imagem").each(function(i) {
                    $(this).delay(500*i).fadeIn();
                });
                
                
            });
        </script>

</head>

<body>
    <h2>Galeria</h2>
    <table class="center">
        <tr>
            <td><img class="imagem" src="galeria/slideshow1.png" id="img01"></td>
            <td><img class="imagem" src="galeria/slideshow2.png" id="img02"></td>
            <td><img class="imagem" src="galeria/slideshow3.png" id="img03"></td>
        </tr>
        <tr>
            <td><img class="imagem" src="galeria/slideshow4.png" id="img04"></td>
            <td><img class="imagem" src="galeria/slideshow5.png" id="img05"></td>
            <td><img class="imagem" src="galeria/slideshow6.png" id="img06"></td>
        </tr>

    </table>

</body>

</html>
<?php include "footer.php"; ?>