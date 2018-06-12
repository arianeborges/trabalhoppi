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
    if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["especialidademedica"]) &&  $_POST["nomemedico"] && $_POST["dataconsulta"] && $_POST["horariodisponivel"] && $_POST["paciente"] && $_POST["telefonepaciente"]) {


      $conn = conectabd();
    
      $especialidade = $_POST["especialidademedica"];
      $medico = $_POST["nomemedico"];
      $data = $_POST["dataconsulta"];
      $horario = $_POST["horariodisponivel"];
      $paciente = $_POST["paciente"];
      $telefone = $_POST["telefonepaciente"];
    
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
      } else {
        echo "<span style='padding-left: 15px' class='success-message'> Agendamento realizado com sucesso!! </span>";
      }
    }
  ?>
<!-- <script>

jQuery(function ($) {
    $.mask.definitions['~'] = '[+-]';
    //Inicio Mascara Telefone
    $("#telefonepaciente").mask("(99) 9999-9999?9").ready(function (event) {
      var target, phone, element;
      target = (event.currentTarget) ? event.currentTarget : event.srcElement;
      phone = target.value.replace(/\D/g, '');
      element = $(target);
      element.unmask();
      if (phone.length > 10) {
        element.mask("(99) 99999-999?9");
      } else {
        element.mask("(99) 9999-9999?9");
      }
    });
  });
</script> -->

  
  <h2> Agendamento de consulta </h2>
  <div class="container agendamento card ">
    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <div class="form-group">
          <label class="control-label col-sm-3" for="especialidademedica">Especialidade Médica:</label>
            <div class="col-sm-3">
              <select id="especialidademedica" name="especialidademedica" class="form-control" onchange="buscaMedico(this.value)">
                <option value="" selected>Selecione</option>
                <option value="CirurgiaoDentista">Cirurgião Dentista</option>
                <option value="Odontopediatra">Odontopediatra</option> <!-- saúde bucal das crianças -->
                <option value="Odontohebiatria">Odontohebiatria</option> <!-- saúde bucal dos adolescentes -->
                <option value="Ortodontista">Ortodontista</option> <!-- aparelhos ortodônticos -->
                <option value="OdontologiaEstetica">Odontologia Estética</option><!-- clareamentos dentais, uso de resinas e peeling gengival -->
                <option value="Endodontista">Endodontista</option><!-- tratamento de canal  -->
                <option value="Periodontista">Periodontista</option><!-- cuidados relacionados a doenças de gengiva -->
                <option value="Protesista">Protesista</option> <!-- reabilitação bucal: estética, fonética e mastigação -->
                <option value="Implantodontista">Implantodontista</option> <!-- inserção de protéses fixas/implantes -->
              </select>
            </div>

            <label class="control-label col-sm-2" for="medico">Médico:</label>
            <div class="col-sm-2">
              <select id="nome" name="nomemedico" class="form-control" onchange="buscaHorarios()" required>
                <option value="" selected>Selecione</option>
              </select>
            </div>
      </div>

        <div class="form-group">
            <label class="control-label col-sm-3" for="dataconsulta">Data da consulta:</label>
            <div class="col-sm-3">
              <input type="date" class="form-control" name="dataconsulta" id="data" onchange="buscaHorarios()" required>
            </div>

            <label class="control-label col-sm-2" for="horario">Horário da consulta:</label>
            <div class="col-sm-2">
              <select name="horariodisponivel" class="form-control" id="horarios" required>
                <option value="" selected>Selecione</option>
              </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3" for="paciente">Nome:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="paciente" id="paciente" placeholder="Escreva seu nome.." required>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3" for="telefonepaciente">Telefone Celular:</label>
            <div class="col-sm-3">
              <input type="text" name="telefonepaciente" id="telefonepaciente" required>
            </div>
        </div>

        <div class="col-sm-offset-3">          
          <button type="reset" class="btn btn-danger">Limpar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>



    </form>
</div>

<?php include "footer.php" ;?>