<!DOCTYPE php>
<php lang="pt-br">

<head>

    <title>Clinica Melhor Sorriso</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- estilos css -->
    <link rel="stylesheet" href="css/estiloheader.css?v=15">    
    <link rel="stylesheet" href="css/estilofooter.css?v=15">     

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

    <div class="container-fluid header">
        <ul class="menu">
            <li>
                <a href="index.php">
                    <span class="glyphicon glyphicon-home"> </span>
                </a>
            </li>
            <li>
                <a href="paginagaleria.php">GALERIA</a>
            </li>
            <li>
                <a href="paginacontato.php">CONTATO</a>
            </li>
            <li>
                <a href="paginaagendamento.php">AGENDAMENTO</a>
            </li>
            <li>
                <a href="#" data-toggle="modal" data-target="#myModal" data-title="Login">
                    <span class="glyphicon glyphicon-user"> </span>
                </a>
            </li>
        </ul>


        <!-- Modal html -->
        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">LOGIN</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form">
                            <div class="form-group">
                                <label for="usuario" class="control-label">Login:</label>
                                <input type="text" class="form-control" id="usuario">
                            </div>
                            <div class="form-group">
                                <label for="senha" class="control-label">Senha:</label>
                                <input type="password" class="form-control" id="senha">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancela</button>
                        <a href="paginarestrita.php">
                            <button type="button" class="btn btn-primary">Enviar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>