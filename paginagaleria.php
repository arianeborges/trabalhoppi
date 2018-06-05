<?php include "header.php"; ?>

<style>
/*  css pagina galeria */

.center {
    margin: 0 auto;
    border: 0;
}

.galeria th, td {
    width: 300px;
    height: 250px;
    padding: 10px;
}

.imagem {
    width: 300px;
    height: 250px;
    border-radius: 20px;
    display: none;
}

.video{
    width: 300px;
    height: 250px;
}
   

/* fim css pagina galeria */

</style>

    <h2>Galeria</h2>
    <div class="table-responsive">
    <table class="center">
        <tr class = "video">
            <td> <embed src="https://www.youtube.com/embed/SHNMBVZa6NA?rel=0&loop=1&autoplay=1" frameborder="0" allowfullscreen="true"> </td>
            <td> <embed src="https://www.youtube.com/embed/f_ed-M_3xqk?rel=0&loop=1&autoplay=1" frameborder="0" allowfullscreen="true"> </td>
            <td> <embed src="https://www.youtube.com/embed/v99PM9X_Uh8?rel=0&loop=1&autoplay=1" frameborder="0" allowfullscreen="true"> </td>
            </tr>
        <tr class="galeria">
            <td><img class="imagem" src="galeria/slideshow1.png" id="img01"></td>
            <td><img class="imagem" src="galeria/slideshow3.png" id="img03"></td>           
            <td><img class="imagem" src="galeria/slideshow6.png" id="img06"></td>  
        </tr>
        <tr class="galeria">
            <td><img class="imagem" src="galeria/slideshow5.png" id="img05"></td>                      
            <td><img class="imagem" src="galeria/slideshow2.png" id="img02"></td>
            <td><img class="imagem" src="galeria/slideshow4.png" id="img04"></td>
        </tr>
        
    </table>
    <div>

            
<?php include "footer.php"; ?>