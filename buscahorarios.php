<?php

    require "agenda.php";
    require "conexaobd.php";

    $conn = conectabd();

    $agenda = getAgendaFuncionarioDia($conn, $_GET["nome"], $_GET["data"]);

    $retorno = [];

    for ($i = 0; $i < 24; $i++) {
        array_push($retorno, 1);
    }

    foreach($agenda as $a) {
        $retorno[$a->horaconsulta] = 0;
    }

    $jsonString = json_encode($retorno);
    echo $jsonString;

?>