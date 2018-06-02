<?php

    class Funcionario{
        public $nome;
        public $sexo;
        public $cargofunc;
        public $rgfunc;
    }

    class EnderecoFunc{
        public $cidade;
        public $logradouro;
    }

    function getFuncionario($conexao){

        $arrayFuncionario = [];

        $sql = "SELECT F.nome, F.sexo, F.cargofunc, F.rgfunc, E.cidade, E.logradouro 
                FROM Funcionario as F, EnderecoFunc as E 
                WHERE F.id = E.id_funcionario";

        $result = $conexao->query($sql);
        if(! $result)
            throw new Exception('Ocorreu uma falha ao gerar o relatorio de testes: ' . $conexao->error);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                $funcionario = new Funcionario();
                $funcionario->nome = $row["nome"];
                $funcionario->sexo = $row["sexo"];
                $funcionario->cargofunc = $row["cargofunc"];
                $funcionario->rgfunc = $row["rgfunc"];
                $funcionario->cidade = $row["cidade"];
                $funcionario->logradouro = $row["logradouro"];

                // $endereco = new EnderecoFunc();
                // $endereco->cidade = $row["cidade"];
                // $endereco->logradouro = $row["logradouro"];

                $arrayFuncionario[] = $funcionario;

            }
        }

        return $arrayFuncionario;
    }
?>
