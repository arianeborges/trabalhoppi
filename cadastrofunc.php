<?php include "sidebar.php" ;

session_start();

if(!$_SESSION['login']) {
    header("Location:index.php");
    die();
}

?>

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

  $nome = $datanascimento = $sexo = $estadocivil = $cargofunc = $especialidade = $cpffunc = $rgfunc = $outro = $cep = $estado = $cidade = $bairro = $tipologradouro = $logradouro = $numero = $complemento = "";
  $nome = filtraEntrada($_POST["nome"]);
  $datanascimento = filtraEntrada($_POST["datanascimento"]); 
  $sexo = filtraEntrada($_POST["sexo"]); 
  $estadocivil = filtraEntrada($_POST["estadocivil"]); 
  $cargofunc = filtraEntrada($_POST["cargofunc"]);

  if(isset($_POST["especialidade"]))
    $especialidade = filtraEntrada($_POST["especialidade"]); 

  $cpffunc = filtraEntrada($_POST["cpffunc"]); 
  $rgfunc = filtraEntrada($_POST["rgfunc"]); 
  $outro = filtraEntrada($_POST["outro"]); 
  $cep = filtraEntrada($_POST["cep"]); 
  $estado = filtraEntrada($_POST["estado"]); 
  $cidade = filtraEntrada($_POST["cidade"]); 
  $bairro = filtraEntrada($_POST["bairro"]); 
  $tipologradouro = filtraEntrada($_POST["tipologradouro"]); 
  $logradouro = filtraEntrada($_POST["logradouro"]); 
  $numero = filtraEntrada($_POST["numero"]); 
  $complemento = filtraEntrada($_POST["complemento"]); 

  try{

    $conexao = conectabd();

    $sql1 = "INSERT INTO Funcionario(id, nome, datanascimento, sexo, estadocivil, cargofunc, especialidade, cpffunc, rgfunc, outro) 
    VALUES (null,'$nome','$datanascimento','$sexo','$estadocivil','$cargofunc','$especialidade','$cpffunc','$rgfunc','$outro')"; 

    if(! $conexao->query($sql1))
    throw new Exception ("Falha na inserção dos dados: " . $conexao->error);

    $ultimo_id = $conexao->insert_id;

    $sql2 = "INSERT INTO EnderecoFunc(id_funcionario, cep, estado, cidade, bairro, tipologradouro, logradouro, numero, complemento) 
    VALUES ('$ultimo_id', '$cep', '$estado' ,'$cidade','$bairro','$tipologradouro', '$logradouro', '$numero', '$complemento')"; 

    if(! $conexao->query($sql2))
      throw new Exception ("Falha na inserção dos dados: " . $conexao->error);
    
    $formProcSucesso = true;
  }catch(Exception $e){

    $erro = $e->getMessage();
  }

}
?>

    <div class="container cadastro">
            <div class = "col-sm-offset-1 col-sm-10">
                <h2> CADASTRO DE NOVO FUNCIONARIO </h2>
                <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">   
                <div class="panel with-nav-tabs panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            
                            <li class="active">
                                <a data-toggle="tab" href="#dadospessoais">Dados Pessoais</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#documentos">Documentos</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#endereco">Endereço</a>
                            </li>
                        
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="dadospessoais">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="nome">Nome:</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="nome" id="nome" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="datanascimento">Data de nascimento:</label>
                                        <div class="col-sm-3">
                                            <input type="date" class="form-control" name="datanascimento" id="datanascimento" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="sexo">Sexo:</label>
                                        <input type="radio" name="sexo" id="sexo" value="M">Masculino</label>
                                        <input type="radio" name="sexo" id="sexo" value="F">Feminino</label>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="estadocivil">Estado Civil:</label>
                                        <div class="col-sm-3">
                                            <select name="estadocivil" id="estadocivil" required>
                                                <option value="" selected>Selecione</option>
                                                <option value="solteiro">Solteiro</option>
                                                <option value="casado">Casado</option>
                                                <option value="divorciado">Divorciado</option>
                                                <option value="viuvo">Viuvo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cargofunc">Cargo:</label>
                                        <div class="col-sm-4">
                                            <select name="cargofunc" id="cargofunc" required>
                                                <option value="" selected>Selecione</option>
                                                <option value="secretario">Secretário</option>
                                                <option value="dentista">Medico</option>
                                                <option value="enfermeiro">Enfermeiro</option>
                                                <option value="informatica">Suporte</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="especialidades" class="form-group" hidden="true">
                                        <label class="control-label col-sm-4" for="especialidade">Especialidade médica:</label>
                                        <div class="col-sm-3">
                                            <select name="especialidade" id="especialidade" required>
                                                <option value="" selected>Selecione</option>
                                                <option value="cirurgiaodentista">Cirurgião Dentista</option>
                                                <option value="odontopediatra">Odontopediatra</option>
                                                <!-- saúde bucal das crianças -->
                                                <option value="odontohebiatria">Odontohebiatria</option>
                                                <!-- saúde bucal dos adolescentes -->
                                                <option value="ortodontista">Ortodontista</option>
                                                <!-- aparelhos ortodônticos -->
                                                <option value="odontologiaestetica">Odontologia Estética</option>
                                                <!-- clareamentos dentais, uso de resinas e peeling gengival -->
                                                <option value="endodontista">Endodontista</option>
                                                <!-- tratamento de canal  -->
                                                <option value="periodontista">Periodontista</option>
                                                <!-- cuidados relacionados a doenças de gengiva -->
                                                <option value="protesista">Protesista</option>
                                                <!-- reabilitação bucal: estética, fonética e mastigação -->
                                                <option value="implantodontista">Implantodontista</option>
                                                <!-- inserção de protéses fixas/implantes -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-4">
                                        <button type="reset" class="btn btn-danger">Limpar</button>
                                    </div>

                            </div>

                            <div class="tab-pane fade" id="documentos">

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="cpffunc">CPF:</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="cpffunc" id="cpffunc" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="rgfunc">RG:</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="rgfunc" id="rgfunc" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="outro">Outro:</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="outro" id="outro">
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-3">
                                        <button type="reset" class="btn btn-danger">Limpar</button>
                                        <!-- <button> <span class="glyphicon glyphicon-triangle-right"> </span> </button> -->
                                    </div>

                            </div>

                            <div class="tab-pane fade" id="endereco">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cep">CEP:</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="cep" id="cep" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="estado">Estado:</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="estado" id="estado" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cidade">Cidade:</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="cidade" id="cidade" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="bairro">Bairro:</label>
                                        <div class="col-sm-3">
                                            <input type="bairro" class="form-control" name="bairro" id="bairro" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="tipologradouro">Tipo de logradouro:</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="tipologradouro" id="tipologradouro" placeholder="Rua, Avenida.." required>
                                        </div>

                                        <label class="control-label col-sm-2" for="logradouro">Logradouro:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="logradouro" id="logradouro" required>
                                        </div>
                                    </div>
                                    <div class = "form-group">
                                        <label class="control-label col-sm-4" for="numero">Número:</label>
                                        <div class="col-sm-2">
                                            <input type="number" class="form-control" name="numero" min="0" max="9999" id="numero" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="complemento">Complemento:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="complemento" id="complemento">
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-4">
                                        <button type="reset" class="btn btn-danger">Limpar</button>
                                        <button type="submit" class="btn btn-info">Enviar</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
                </form>        
                    <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST"){

                        if($erro == "")
                            echo "<script>alert('Cadastro realizado!');</script>";
                        else
                            echo "$erro";
                    }
                ?>

            </div>
    </div>

    <script>

        $(document).ready(function() {
            $("#cargofunc").on('change', function(e) {

                var opt = $("option:selected", this).text();

                if(opt == "Medico")
                    $("#especialidades").show();
                else 
                    $("#especialidades").hide();  
                    
            })
        });

    </script>

<?php include "footer.php" ?>