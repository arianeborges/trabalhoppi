<?php 

include "sidebar.php";

session_start();

if(!$_SESSION['login']) {
    header("Location:index.php");
    die();
}

?>

<h1 style="text-align: center"> Área Administrativa </h1>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-adm" onclick="location.href='listafunc.php'">
                <h2>Funcionarios</h2>
                <p>0</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-adm" onclick="location.href='listacontatos.php'">
                <h2>Contatos</h2>
                <p>0</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-adm" onclick="location.href='listaagenda.php'">
                <h2>Agendamentos</h2>
                <p>0</p>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"?>