<?php include "headerrestrito.php" ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Clinica Melhor Sorriso</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  
  <!-- estilos css -->
  <link rel="stylesheet" href="css/estilolistagens.css?v=15">

</head>

<body>

  <div class="container lista">
		<h2>Lista de Agendamentos</h2>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>Nome do Médico</th>
						<th>Especialidade</th>
						<th>Data da Consulta</th>
						<th>Hora da Consulta</th>
                        <th>Nome do Paciente</th>                        
						<th>Telefone do Paciente</th>
					</tr>
				</thead>
				
				<!-- <tbody>
			<?php
			
				if ($arraySeries != "")
				{
				
						foreach ($arraySeries as $serie)
						{       
							echo "
							<tr>
							<td>$serie->nome</td>
							<td>$serie->lugar</td>
							<td>$serie->temporadas</td>
							<td>$serie->genero</td>
							<td>$serie->datalanc</td>         
							</tr>      
							";
						}
				}
				
			?>    
				
				</tbody> -->
			</table>

		
		<!-- <?php
		
		if ($erro != "")
			echo "<p class='text-danger'>A operação não pode ser realizada: $erro</p>";
		
		?> -->
		
	</div>

</body>
</html>

<?php include "footer.php" ?>