<?php include "header.php"; ?>

<h2> Contato </h2>
<div class="container contato">
        <form class="form-horizontal" method="POST">
            <div class="form-group">
                    <label class="control-label col-sm-2" for="nome">Nome:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" placeholder= "Informe seu nome..." name="nome" required>
                    </div>
                    
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">E-mail:</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" placeholder="Informe seu e-mail..." name="email" required>
                    </div>
                  </div>
    
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="motivo">Motivo:</label>
                    <div class="col-sm-2">
                      <select name="motivo" class="form-control" required>
                          <option value="" selected>Selecione</option>
                          <option value="sugestao">Sugestão</option>
                          <option value="duvida">Dúvida</option>
                          <option value="elogio">Elogio</option>
                          <option value="reclamar">Reclamação</option>
                      </select>
                    </div>
                  </div>                  
                  
                  <div class="form-group">
                        <label class="control-label col-sm-2" for="mensagem">Mensagem:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="mensagem" style="resize: none"></textarea>
                        </div>
                    </div>

                  <div class="col-sm-offset-2">
                      <button type="submit" class="btn btn-primary">Enviar</button>
                  </div>
                  
            </form>
</div>


<?php include "footer.php"; ?>