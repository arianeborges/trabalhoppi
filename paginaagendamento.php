<?php include "header.php" ;?>

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

          <label class="control-label col-sm-2" for="nomemedico">Médico:</label>
          <div class="col-sm-2">
            <select name="nomemedico" class="form-control">
              <option value="" selected>Selecione</option>
            </select>
          </div>
        </div>


        <div class="form-group">
          <label class="control-label col-sm-2" for="dataconsulta">Data da consulta:</label>
          <div class="col-sm-2">
            <input type="date" class="form-control" name="dataconsulta">
          </div>

          <label class="control-label col-sm-2" for="horariodisponivel">Horário da consulta:</label>
          <div class="col-sm-2">
            <select name="horariodisponivel" class="form-control">
              <option value="" selected>Selecione</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="nomepaciente">Nome:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="nomepaciente" placeholder="Escreva seu nome..">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="telefonepaciente">Telefone Celular:</label>
          <div class="col-sm-2">
            <input type="text" name="telefonepaciente" id="telefonepaciente">
          </div>
        </div>

        <div class="col-sm-offset-2">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="reset" class="btn btn-danger">Limpar</button>
        </div>



    </form>
    </div>

<?php include "footer.php" ;?>