<?php include "header.php" ;

require_once "conexaobd.php";

?>

  <script>
    $(document).ready(function() {
      var today = new Date();

      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();

      if(dd<10){
          dd='0'+dd
      } 

      if(mm<10){
          mm='0'+mm
      } 

      today = yyyy+'-'+mm+'-'+dd;
      $("#data").attr("min", today);
    });
    

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
    if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["especialidademedica"]) &&  $_POST["nomemedico"] && $_POST["dataconsulta"] && $_POST["horariodisponivel"] && $_POST["paciente"] && $_POST["telefonepaciente"]) {

      $erro = "";
      $conn = conectabd();
    
      $especialidade = $_POST["especialidademedica"];
      $medico = $_POST["nomemedico"];
      $data = $_POST["dataconsulta"];
      $horario = $_POST["horariodisponivel"];
      $paciente = $_POST["paciente"];
      $telefone = $_POST["telefonepaciente"];
      
      try {
        $conn->begin_transaction();
        //adiciona novo paciente
        $paciente_query = "INSERT INTO Paciente(paciente, telefone) VALUES ('$paciente', '$telefone')";
      
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
        $agenda_query = "INSERT INTO Agenda(codAgendamento, dataconsulta, horaconsulta, codFuncionario, codPaciente) 
                          VALUES (null, '$data', '$horario', '$id_funcionario', '$id_paciente')";
      
        $res = $conn->query($agenda_query);
      
        
        if(! $res) {
          throw new Exception('Ocorreu uma falha ao inserir na Agenda: ' . $conn->error);          
        }
      
        
        $conn->commit();
        
      } catch(Exception $e) {
        $conn->rollback();
        echo "correu uma falha ao inserir na Agenda" . $e->getMessage();
      }
    }
  ?>


<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
     
  <div class="cardbox">
      <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
          if(isset($erro)) {
            if($erro == "")
              echo "<script>alert('Obrigada pelo seu contato!')</script>";
            else
              echo "<script>alert('Contato não realizado:', $erro)</script>";
          }
        }
      ?> 
          
    <div class="form-row">
      <div class="form-group col-sm-6">
        <label for="especialidademedica">Especialidade Médica:</label><br>
        <select id="especialidademedica" name="especialidademedica" class="form-control" onchange="buscaMedico(this.value)">
          <option value="" selected>Selecione</option>
          <option value="CirurgiaoDentista">Cirurgião Dentista</option>
          <option value="Odontopediatra">Odontopediatra</option> 
          <option value="Odontohebiatria">Odontohebiatria</option>
          <option value="Ortodontista">Ortodontista</option> 
          <option value="OdontologiaEstetica">Odontologia Estética</option>
          <option value="Endodontista">Endodontista</option>
          <option value="Periodontista">Periodontista</option>
          <option value="Protesista">Protesista</option> 
          <option value="Implantodontista">Implantodontista</option> 
        </select>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-sm-4">
        <label for="medico">Médico:</label>
        <select id="nome" name="nomemedico" class="form-control" onchange="buscaHorarios()" required><option value="" selected>Selecione</option></select>
      </div>
      <div class="form-group col-sm-4">
        <label for="dataconsulta">Data da consulta:</label>
        <input type="date" class="form-control" name="dataconsulta" id="data" onchange="buscaHorarios()" required>
      </div>
      <div class="form-group col-sm-4">
        <label for="horario">Horário da consulta:</label>
          <select name="horariodisponivel" class="form-control" id="horarios" required><option value="" selected>Selecione</option></select>
      </div>
    </div>


    <div class="form-row">
      <div class="form-group col-sm-8">
        <label for="paciente">Nome:</label>
          <input type="text" class="form-control" name="paciente" id="paciente" placeholder="Escreva seu nome.." required>
      </div>
      <div class="form-group col-sm-4">
        <label for="telefonepaciente">Telefone Celular:</label>
          <input type="text" class="form-control" name="telefonepaciente" id="telefonepaciente" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-sm-4">          
        <button type="reset" class="btn btn-danger">Limpar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
</form>
    
<?php include "footer.php" ;?>