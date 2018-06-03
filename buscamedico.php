<?php 

    require "funcionario.php";
    require "conexaobd.php";

    $conn = conectabd();

    $funcionarios = getFuncionario($conn);

    $retorno = [];

    foreach($funcionarios as $f) {
        if($f->especialidade == $_GET['especialidade'] ) {
            array_push($retorno, $f);
        }
    }

    $jsonString = json_encode($retorno);
    echo $jsonString;
?>