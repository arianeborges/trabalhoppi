<?php include "header.php" ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <title>Clinica Melhor Sorriso</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script src="js/responsiveslides.min.js"></script>
  <link rel="stylesheet" href="css/estilopaginaindex.css?v=15">
  <script>
    $(function () {

        // Slideshow 1
        $("#slideshows1").responsiveSlides({
            maxwidth: 800,
            speed: 200
        });

    });

    $(function () {

        // Slideshow 1
        $("#slideshows2").responsiveSlides({
        maxwidth: 800,
        speed: 200
        });

    });
  </script>
</head>

<body>
    <div class = "logo">
        <img src="logo-clinica.png" alt="" >
        <h1> CLÍNICA MELHOR SORRISO </h1>
        <p> Descrição </p>
    </div>
  
   <div class="slides1"> 
    <h3> Nossa missão: </h3>
    <p> Temos a missão de fazer pessoas sorrirem independente de quem seja. </p>
              
        <ul class="autoslides1" id="slideshows1">
            <li><img src="galeria-home/foto1.jpg" alt=""></li>
            <li><img src="galeria-home/foto2.jpg" alt=""></li>
            <li><img src="galeria-home/foto3.jpg" alt=""></li>
        </ul>
    </div>

    <div class="slides2"> 
    <h3> Nossos valores: </h3>
    <p> Trabalhamos com o compromisso de deixar nossos clientes satisfeitos através de tratamentos rápidos e flexiveis. Além disso,
        temos foco nos resultados de nossos atendimentos e responsabilidade pelos resultados. Para isso, contamos com a tecnologia de ponta e
        os melhores materiais oferecidos no mercado e com a ajuda dos melhores profissionais da área.
    </p>
              
        <ul class="autoslides2" id="slideshows2">
            <li><img src="galeria-home/foto5.jpg" alt=""></li>
            <li><img src="galeria-home/foto6.jpg" alt=""></li>
            <li><img src="galeria-home/foto7.jpg" alt=""></li>
        </ul>
    </div>

</body>
</html>
