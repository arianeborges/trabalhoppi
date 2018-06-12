<?php

    class Funcionario{
        public $nome;
        public $sexo;
        public $cargo;
        public $rg;
        public $especialidade;
    }

    class EnderecoFunc{
        public $cidade;
        public $logradouro;
    }

    function getFuncionario($conexao){

        $arrayFuncionario = [];

        $sql = "SELECT F.nome, F.sexo, F.cargo, F.rg, F.especialidade, E.cidade, E.logradouro 
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
                $funcionario->cargo = $row["cargo"];
                $funcionario->rg = $row["rg"];
                $funcionario->cidade = $row["cidade"];
                $funcionario->logradouro = $row["logradouro"];
                $funcionario->especialidade = $row["especialidade"];

                $arrayFuncionario[] = $funcionario;

            }
        }

        return $arrayFuncionario;
    }
?>
