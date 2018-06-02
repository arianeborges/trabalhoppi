<?php

    class Contato{
        public $nome;
        public $data;
        public $email;
        public $motivo;
        public $mensagem;
    }

    function getContato($conexao){

        $arrayContato = [];

        $sql = "SELECT * FROM Contato";

        $result = $conexao->query($sql);
        if(! $result)
            throw new Exception('Ocorreu uma falha ao gerar o relatorio de testes: ' . $conexao->error);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                $contato = new Contato();
                $contato->nome = $row["nome"];
                $contato->data = $row["data"];
                $contato->email = $row["email"];
                $contato->motivo = $row["motivo"];
                $contato->mensagem = $row["mensagem"];

                $arrayContato[] = $contato;

            }
        }

        return $arrayContato;
    }
?>
