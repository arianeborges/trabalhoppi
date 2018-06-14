<?php include "sidebar.php" ;

session_start();

if(!$_SESSION['login']) {
    header("Location:index.php");
    die();
}

?>

<!-- Adicionando Javascript -->
<script type="text/javascript" >


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
    $("#datanascimento").attr("max", today);


    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#logradouro").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#logradouro").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#logradouro").val(dados.logradouro);                        
                        $("#uf").val(dados.uf);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});

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

  $nome = $datanascimento = $sexo = $estadocivil = $cargo = $especialidade = $cpf = $rg = $outro = $cep = $uf = $cidade = $bairro = $tipologradouro = $logradouro = $numero = $complemento = "";
  $nome = filtraEntrada($_POST["nome"]);
  $datanascimento = filtraEntrada($_POST["datanascimento"]); 
  $sexo = filtraEntrada($_POST["sexo"]); 
  $estadocivil = filtraEntrada($_POST["estadocivil"]); 
  $cargo = filtraEntrada($_POST["cargo"]);

  if(isset($_POST["especialidade"]))
    $especialidade = filtraEntrada($_POST["especialidade"]); 

  $cpf = filtraEntrada($_POST["cpf"]); 
  $rg = filtraEntrada($_POST["rg"]); 
  $outro = filtraEntrada($_POST["outro"]); 
  $cep = filtraEntrada($_POST["cep"]); 
  $uf = filtraEntrada($_POST["uf"]); 
  $cidade = filtraEntrada($_POST["cidade"]); 
  $bairro = filtraEntrada($_POST["bairro"]); 
  $tipologradouro = filtraEntrada($_POST["tipologradouro"]); 
  $logradouro = filtraEntrada($_POST["logradouro"]); 
  $numero = filtraEntrada($_POST["numero"]); 
  $complemento = filtraEntrada($_POST["complemento"]); 

  try{

    $conexao = conectabd();

    $sql1 = "INSERT INTO Funcionario(id, nome, datanascimento, sexo, estadocivil, cargo, especialidade, cpf, rg, outro) 
    VALUES (null,'$nome','$datanascimento','$sexo','$estadocivil','$cargo','$especialidade','$cpf','$rg','$outro')"; 

    if(! $conexao->query($sql1))
    throw new Exception ("Falha na inserção dos dados: " . $conexao->error);

    $ultimo_id = $conexao->insert_id;

    $sql2 = "INSERT INTO EnderecoFunc(id_funcionario, cep, estado, cidade, bairro, tipologradouro, logradouro, numero, complemento) 
    VALUES ('$ultimo_id', '$cep', '$uf' ,'$cidade','$bairro','$tipologradouro', '$logradouro', '$numero', '$complemento')"; 

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
                <h2 class = "listagens"> CADASTRO DE NOVO FUNCIONÁRIO </h2>
                <form id="cadastro-form" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">   
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
                                        <div class="col-sm-3">
                                            <input type="radio" name="sexo" id="sexo" value="M"> Masculino</label>
                                            <input type="radio" name="sexo" id="sexo" value="F"> Feminino</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="estadocivil">Estado Civil:</label>
                                        <div class="col-sm-3">
                                            <select name="estadocivil" id="estadocivil" required>
                                                <option value="" selected>Selecione</option>
                                                <option value="Solteiro">Solteiro</option>
                                                <option value="Casado">Casado</option>
                                                <option value="Divorciado">Divorciado</option>
                                                <option value="Viuvo">Viuvo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cargo">Cargo:</label>
                                        <div class="col-sm-4">
                                            <select name="cargo" id="cargo" required>
                                                <option value="" selected>Selecione</option>
                                                <option value="Secretario">Secretário</option>
                                                <option value="Dentista">Médico</option>
                                                <option value="Enfermeiro">Enfermeiro</option>
                                                <option value="Informática">Suporte</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="especialidades" class="form-group" hidden="true">
                                        <label class="control-label col-sm-4" for="especialidade">Especialidade médica:</label>
                                        <div class="col-sm-3">
                                            <select name="especialidade" id="especialidade" required>
                                                <option value="" selected>Selecione</option>
                                                <option value="CirurgiaoDentista">Cirurgião Dentista</option>
                                                <option value="Odontopediatra">Odontopediatra</option>
                                                <!-- saúde bucal das crianças -->
                                                <option value="Odontohebiatria">Odontohebiatria</option>
                                                <!-- saúde bucal dos adolescentes -->
                                                <option value="Ortodontista">Ortodontista</option>
                                                <!-- aparelhos ortodônticos -->
                                                <option value="OdontologiaEstética">Odontologia Estética</option>
                                                <!-- clareamentos dentais, uso de resinas e peeling gengival -->
                                                <option value="Endodontista">Endodontista</option>
                                                <!-- tratamento de canal  -->
                                                <option value="Periodontista">Periodontista</option>
                                                <!-- cuidados relacionados a doenças de gengiva -->
                                                <option value="Protesista">Protesista</option>
                                                <!-- reabilitação bucal: estética, fonética e mastigação -->
                                                <option value="Implantodontista">Implantodontista</option>
                                                <!-- inserção de protéses fixas/implantes -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-4">
                                        <button type="reset" class="btn btn-danger">Limpar</button>
                                        <button type="button" class="btn btn-success" id="prox">Avançar</button>
                                    </div>

                            </div>

                            <div class="tab-pane fade" id="documentos">

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="cpf">CPF:</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="cpf" id="cpf" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="rg">RG:</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="rg" id="rg" required>
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
                                        <button type="button" class="btn btn-success" id="prox">Avançar</button>
                                    </div>

                            </div>

                            <div class="tab-pane fade" id="endereco">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cep">CEP:</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="cep" id="cep" size="10" maxlength="9" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="uf">Estado:</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="uf" id="uf" size="2" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="cidade">Cidade:</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="cidade" id="cidade" size="60" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="bairro">Bairro:</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="bairro" id="bairro"  size="60" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="tipologradouro">Tipo de logradouro:</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="tipologradouro" id="tipologradouro" placeholder="Rua, Avenida.." required>
                                        </div>

                                        <label class="control-label col-sm-2" for="logradouro">Logradouro:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="logradouro" id="logradouro"  size="60" required>
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
            $("#cargo").on('change', function(e) {

                var opt = $("option:selected", this).text();

                if(opt == "Médico")
                    $("#especialidades").show();
                else 
                    $("#especialidades").hide();  
                    
            })
        });

    </script>

<?php include "footer.php" ?>