<?php include "header.php" ;?>

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

    <form class="form-horizontal" method="POST">

      <div class="form-group">

        <div class="form-group">
          <label class="control-label col-sm-2" for="especialidademedica">Especialidade Médica:</label>
          <div class="col-sm-2">
            <select name="especialidademedica" class="form-control">
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
            <select name="medico" class="form-control">
              <option value="" selected>Selecione</option>
            </select>
          </div>
        </div>


        <div class="form-group">
          <label class="control-label col-sm-2" for="dataconsulta">Data da consulta:</label>
          <div class="col-sm-2">
            <input type="date" class="form-control" name="dataconsulta">
          </div>

          <label class="control-label col-sm-2" for="horario">Horário da consulta:</label>
          <div class="col-sm-2">
            <select name="horario" class="form-control">
              <option value="" selected>Selecione</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="paciente">Nome:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="paciente" placeholder="Escreva seu nome..">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="telefonepaciente">Telefone Celular:</label>
          <div class="col-sm-2">
            <input type="text" name="telefone" id="telefone">
          </div>
        </div>

        <div class="col-sm-offset-2">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="reset" class="btn btn-danger">Limpar</button>
        </div>



    </form>
    </div>

<?php include "footer.php" ;?>