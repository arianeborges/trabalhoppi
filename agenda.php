<?php 

    class Agenda {
        public $codAgendamento;
        public $dataconsulta;
        public $horaconsulta;
        public $codFuncionario;
        public $codPaciente;
    }

    function getAgenda($conexao){

        $arrayAgenda = [];

        $sql = "SELECT * FROM Agenda";

        $result = $conexao->query($sql);

        if(! $result)
            throw new Exception('Ocorreu uma falha ao gerar o relatorio de testes: ' . $conexao->error);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                $agenda = new Agenda();
                $agenda->codAgendamento = $row["codAgendamento"];
                $agenda->dataconsulta = $row["dataconsulta"];
                $agenda->horaconsulta = $row["horaconsulta"];
                $agenda->codFuncionario = $row["codFuncionario"];
                $agenda->codPaciente = $row["codPaciente"];

                $arrayAgenda[] = $agenda;

            }
        }

        return $arrayAgenda;
    }

    function getAgendaFuncionarioDia($conexao, $nome, $data) {
        $arrayAgenda = [];

        $sql = "SELECT * FROM Agenda INNER JOIN Funcionario F ON codFuncionario=F.id WHERE dataconsulta='$data' and F.nome='$nome'";

        $result = $conexao->query($sql);

        if(! $result)
            throw new Exception('Ocorreu uma falha ao gerar o relatorio de testes: ' . $conexao->error);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                $agenda = new Agenda();
                $agenda->codAgendamento = $row["codAgendamento"];
                $agenda->dataconsulta = $row["dataconsulta"];
                $agenda->horaconsulta = $row["horaconsulta"];
                $agenda->codFuncionario = $row["codFuncionario"];
                $agenda->codPaciente = $row["codPaciente"];

                $arrayAgenda[] = $agenda;

            }
        }

        return $arrayAgenda;
    }
?>