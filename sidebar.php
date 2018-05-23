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
    <link rel="stylesheet" href="css/estilopaginarestrita.css?v=15">
    <link rel="stylesheet" href="css/estilofooter.css?v=15"> 
    <script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    </script>
</head>

<body>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>        
        <a href="cadastrofunc.php">NOVO FUNCIONÁRIO</a>
        <a href="listafunc.php">LISTAR FUNCIONÁRIOS</a>
        <a href="listacontatos.php">LISTAR CONTATOS</a>
        <a href="listaagenda.php">LISTAR AGENDAMENTOS</a>
        <a href="index.php"><span class="glyphicon glyphicon-log-out"></span></a>
    </div>

    <span style="font-size:25px;cursor:pointer" onclick="openNav()">&#9776; MENU</span>

    
