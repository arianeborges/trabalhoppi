<?php include "header.php"; ?>

<?php

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["motivo"]) && isset($_POST["mensagem"])){

  $erro = "";

  $nome = $email = $motivo = $mensagem = "";
  $nome = filtraEntrada($_POST["nome"]);
  $email = filtraEntrada($_POST["email"]);
  $motivo = filtraEntrada($_POST["motivo"]);
  $mensagem = filtraEntrada($_POST["mensagem"]);

  try{

    $conexao = conectabd();

    $sql = "INSERT INTO Contato( nome, data, email, motivo, mensagem ) 
    VALUES ('$nome', now() ,'$email','$motivo','$mensagem')"; 

    if(! $conexao->query($sql))
      throw new Exception ("Falha na inserção dos dados: " . $conexao->error);
    
    $formProcSucesso = true;
  }catch(Exception $e){

    $erro = $e->getMessage();
  }

}
?>

<h2> Envie sua mensagem </h2>
<div class="container contato card">
        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
                          <option value="Sugestão">Sugestão</option>
                          <option value="Dúvida">Dúvida</option>
                          <option value="Elogio">Elogio</option>
                          <option value="Reclamação">Reclamação</option>
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
                      <button type="reset" class="btn btn-danger">Limpar</button>
                      <button type="submit" class="btn btn-primary">Enviar</button>
                  </div>
                  
            </form>

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

</div>

<?php include "footer.php"; ?>