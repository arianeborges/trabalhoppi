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
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <script type="text/javascript" src="./js/jquery.maskedinput-1.3.1.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>
    <script src="js/scriptgaleria.js"></script>
    <script src="js/scriptindex.js"></script>
    <script src="js/scriptmensagem.js"></script>

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
    <ul>
     
    <!-- <li><img class="img-responsive" style="padding-left:50px;width:280px;height:80px;" src="main-logo.png" alt="Clinica Melhor Sorriso"></li> -->
    <li><a href="index.php"><span class="fas fa-home"> </span></a></li>
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
                            <span class="fas fa-log-out"></span></a>
                    </li>';                                   
            }
            else {
                echo '<li><a href="#" data-toggle="modal" data-target="#myModal"><span class="fas fa-user"></span></a>
                </li>';
            }                
        ?>
        <footer class="footer">
                <p class="text-muted">© 2018 - Ariane Santos Borges e Weuler Borges Santos Filho</p>
        </footer>
    </ul>

    <div class="modalbox">
        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ÁREA ADMINISTRATIVA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
    