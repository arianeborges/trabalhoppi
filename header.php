<!DOCTYPE html>
<html lang="pt-br">

<?php
require "conexaobd.php";

function filtraEntrada($dado){

    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
  
    return $dado;
}

if ($_SERVER["REQUEST_METHOD"]=="POST") {

    if(isset($_POST["usuario"]) && isset($_POST["senha"])) {
        $usuario = filtraEntrada($_POST["usuario"]);
        $senha = filtraEntrada($_POST["senha"]);

        try {
            $sql = "SELECT * from usuario WHERE login='$usuario' and senha='$senha'";

            $conexao = conectabd();

            $resultado = $conexao->query($sql);

            if(!$resultado) {
                throw new Exception("Falha ao buscar usuario. " . $conexao->$error);
            }

            if ($resultado->num_rows == 1) {
                if(!session_id()) {
                    session_start();
                }
                $_SESSION['login'] = true;
                
                echo '<script>window.open("paginarestrita.php", "_blank")</script>';
            } else {
                echo "<script>alert('Senha ou usuario invalidos.')</script>";
            }

        } catch(Exception $e) {
            $erro = $e->getMessage();
        }
    }
}

?>

<head>

    <title>Clinica Melhor Sorriso</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/jquery.maskedinput-1.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>
    <script src="js/scriptgaleria.js"></script>
    <script src="js/scriptindex.js"></script>

    <!-- estilos css -->
    <link rel="stylesheet" href="css/estilopaginas.css?v=15">

    <script type="text/javascript">
        $(document).ready(function () {
            $("#myModal").on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var titleData = button.data('title');
                $(this).find('.modal-title').text(titleData);
            });
        });
    </script>

    <style type="text/css">
        .bs-example {
            margin: 20px;
        }
    </style>

</head>

<body>
      
    <div class="navbar navbar-inverse navbar-static-top ">
        <div class="container">            
            
            <button class="navbar-toggle" data-toggle="collapse" data-target=".collapsibleNavbar">
                <a class="navbar-brand" href="#">CLÍNICA MELHOR SORRISO</a> 
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="collapse navbar-collapse collapsibleNavbar">
                <ul class="nav navbar-nav navbar-center">
                        <li><a href="index.php"><span class="glyphicon glyphicon-home"> </span></a></li>
                        <li><a href="paginagaleria.php">GALERIA</a></li>
                        <li><a href="paginacontato.php">CONTATO</a></li>
                        <li><a href="paginaagendamento.php">AGENDAMENTO</a></li>
                        <?php
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            } 

                            if ( isset($_SESSION['login']) && $_SESSION['login'] == true) {
                                echo '<li> <a href="paginarestrita.php" data-title="Acesso Restrito"> ÁREA ADMINISTRATIVA </a>
                                        </li>';

                                echo '<li> <a href="logout.php" data-title="Logout">
                                            <span class="glyphicon glyphicon-log-out"></span></a>
                                    </li>';                                   
                            }
                            else {
                                echo '<li><a href="#" data-toggle="modal" data-target="#myModal" data-title="Login">
                                        <span class="glyphicon glyphicon-user"></span></a>
                                </li>';
                            }
                            
                        ?>
                </ul>
            </div> 

        </div>         
    </div>
        

    <!-- Modal html -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">LOGIN</h4>
                </div>
                <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="usuario" class="control-label">Login:</label>
                                <input type="text" class="form-control" name="usuario" id="usuario">
                            </div>
                            <div class="form-group">
                                <label for="senha" class="control-label">Senha:</label>
                                <input type="password" class="form-control" name="senha" id="senha">
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancela</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    