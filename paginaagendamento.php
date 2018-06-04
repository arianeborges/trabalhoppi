<?php include "header.php" ;

require_once "conexaobd.php";

?>

  <script>

  function buscaMedico(especialidade) {
    var jq = $.getJSON("buscamedico.php?especialidade="+especialidade, function(data) {
      $("#nome").html('Selecione');
      $.each(data, function(){
          $("#nome").append('<option value="'+ this.nome +'">'+ this.nome +'</option>');
      });
    });

    jq.fail(function(textStatus, error) {
      var ms = textStatus + " " + error;
      console.log("Falha ao buscar dados no servidor --- " + ms);
    });
  }

  function transformaHoraEmRange(hora) {
    if (hora < 9) {
      return '0'+hora+':'+'00 - 0'+(hora+1)+':00';
    }

    if (hora == 9) {
      return '09:00 - 10:00';
    }

    return hora+':'+'00 - '+ (hora+1) +':00';
  }

  function buscaHorarios() {
    nome = $("#nome").val();
    data = $("#data").val();
    if(nome != "" && data != "") {
      console.log(nome + " " + data);

      var jq = $.getJSON("buscahorarios.php?nome="+nome+"&data="+data, function(data) {
        $("#horarios").html('');
        // $.each(data, function(){
        //     $("#nome").append('<option value="'+ this.nome +'">'+ this.nome +'</option>');
        // });
        console.log(data);

        for(var i = 8; i <= 18; i++) {
          if (data[i] == 1) {
            $("#horarios").append('<option value="'+ i +'">'+ transformaHoraEmRange(i) +'</option>');
          }
        }
      });

      jq.fail(function(textStatus, error) {
        var ms = textStatus + " " + error;
        console.log("Falha ao buscar dados no servidor --- " + ms);
      });
    }      
  }


  </script>

<?php

require "conexaobd.php"; //inclui arquivo com os dados e funções de conexão

function filtraEntrada($dado){

  $dado = trim($dado);
  $dado = stripslashes($dado);
  $dado = htmlspecialchars($dado);

  return $dado;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

  $erro = "";

  $especialidade = $medico = $dataconsulta = $horario = $nome = $telefone = "";

  $especialidade = filtraEntrada($_POST["especialidade"]);
  $medico = filtraEntrada($_POST["medico"]); 
  $dataconsulta = filtraEntrada($_POST["dataconsulta"]); 
  $horario = filtraEntrada($_POST["horario"]); 
  $nome = filtraEntrada($_POST["nome"]); 
  $telefone = filtraEntrada($_POST["telefone"]); 

  try{

    $conexao = conectabd();

    $sql = "INSERT INTO Funcionario(codAgendamento, dataconsulta, horario, codFuncionario, codPaciente) 
    VALUES (null,'$dataconsulta','$horario','$codFuncionario','$codPaciente')"; 

    if(! $conexao->query($sql))
    throw new Exception ("Falha na inserção dos dados: " . $conexao->error);

    //inserindo paciente
    $sql1 = "INSERT INTO Paciente(id, nome, telefone) 
    VALUES (null,'$nome','$telefone')"; 

    if(! $conexao->query($sql1))
    throw new Exception ("Falha na inserção dos dados: " . $conexao->error);
    
    $ultimo_id = $conexao->insert_id;
    
    $formProcSucesso = true;
  }catch(Exception $e){

    $erro = $e->getMessage();
  }

}
?>

  <h2> Agendamento de consulta </h2>

  <div class="container agendamento card">

    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

      <div class="form-group">

        <?php
          if ($_SERVER["REQUEST_METHOD"]=="POST") {


            $conn = conectabd();
          
            $especialidade = $_POST["especialidademedica"];
            $medico = $_POST["nomemedico"];
            $data = $_POST["dataconsulta"];
            $horario = $_POST["horariodisponivel"];
            $nome = $_POST["nomepaciente"];
            $telefone = $_POST["telefonepaciente"];
          
            //adiciona novo paciente
            $paciente_query = "INSERT INTO Paciente(nome, telefone) VALUES ('$nome', '$telefone')";
          
            $res = $conn->query($paciente_query);
          
            if(! $res) {
              throw new Exception('Ocorreu uma falha ao criar novo paciente: ' . $conn->error);
            }
          
            $id_paciente = $conn->insert_id;
          
            //pega o id do medico selecionado
            $medico_query = "SELECT id FROM funcionario WHERE nome='$medico'";
          
            $res = $conn->query($medico_query); 
          
            if(! $res) {
              throw new Exception('Ocorreu uma falha buscar id do medico: ' . $conn->error);
            }
          
            $row = $res->fetch_assoc();
            $id_funcionario = $row["id"];
          
            //realiza agendamento
            $agenda_query = "INSERT INTO agenda(dataconsulta, horaconsulta, codFuncionario, codPaciente) VALUES ('$data', '$horario', '$id_funcionario', '$id_paciente')";
          
            $res = $conn->query($agenda_query);
          
            if(! $res) {
              throw new Exception('Ocorreu uma falha ao inserir na Agenda: ' . $conn->error);
            } else {
              echo "<span style='padding-left: 15px' class='success-message'> Agendamento realizado com sucesso!! </span>";
            }
          }
        ?>

        <div class="form-group">
          <label class="control-label col-sm-2" for="especialidademedica">Especialidade Médica:</label>
          <div class="col-sm-2">
            <select id="especialidademedica" name="especialidademedica" class="form-control" onchange="buscaMedico(this.value)">
              <option value="" selected>Selecione</option>
              <option value="cirurgiaodentista">Cirurgião Dentista</option>
              <option value="odontopediatra">Odontopediatra</option> <!-- saúde bucal das crianças -->
              <option value="odontohebiatria">Odontohebiatria</option> <!-- saúde bucal dos adolescentes -->
              <option value="ortodontista">Ortodontista</option> <!-- aparelhos ortodônticos -->
              <option value="odontologiaestetica">Odontologia Estética</option><!-- clareamentos dentais, uso de resinas e peeling gengival -->
              <option value="endodontista">Endodontista</option><!-- tratamento de canal  -->
              <option value="periodontista">Periodontista</option><!-- cuidados relacionados a doenças de gengiva -->
              <option value="protesista">Protesista</option> <!-- reabilitação bucal: estética, fonética e mastigação -->
              <option value="implantodontista">Implantodontista</option> <!-- inserção de protéses fixas/implantes -->
            </select>
          </div>

          <label class="control-label col-sm-2" for="medico">Médico:</label>
          <div class="col-sm-2">
<<<<<<< HEAD
            <select name="medico" class="form-control">
=======
            <select id="nome" name="nomemedico" class="form-control" onchange="buscaHorarios()" required>
>>>>>>> e8e7af7ab6fced065428a1f5c2e4eb77b521369c
              <option value="" selected>Selecione</option>
            </select>
          </div>
        </div>


        <div class="form-group">
          <label class="control-label col-sm-2" for="dataconsulta">Data da consulta:</label>
          <div class="col-sm-2">
            <input type="date" class="form-control" name="dataconsulta" id="data" onchange="buscaHorarios()" required>
          </div>

          <label class="control-label col-sm-2" for="horario">Horário da consulta:</label>
          <div class="col-sm-2">
<<<<<<< HEAD
            <select name="horario" class="form-control">
=======
            <select name="horariodisponivel" class="form-control" id="horarios" required>
>>>>>>> e8e7af7ab6fced065428a1f5c2e4eb77b521369c
              <option value="" selected>Selecione</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="paciente">Nome:</label>
          <div class="col-sm-8">
<<<<<<< HEAD
            <input type="text" class="form-control" name="paciente" placeholder="Escreva seu nome..">
=======
            <input type="text" class="form-control" name="nomepaciente" placeholder="Escreva seu nome.." required>
>>>>>>> e8e7af7ab6fced065428a1f5c2e4eb77b521369c
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="telefonepaciente">Telefone Celular:</label>
          <div class="col-sm-2">
<<<<<<< HEAD
            <input type="text" name="telefone" id="telefone">
=======
            <input type="text" name="telefonepaciente" id="telefonepaciente" required>
>>>>>>> e8e7af7ab6fced065428a1f5c2e4eb77b521369c
          </div>
        </div>

        <div class="col-sm-offset-2">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="reset" class="btn btn-danger">Limpar</button>
        </div>



    </form>
    </div>

<?php include "footer.php" ;?>