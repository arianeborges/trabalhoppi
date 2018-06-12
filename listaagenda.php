<?php include "sidebar.php";

session_start();

if(!$_SESSION['login']) {
    header("Location:index.php");
    die();
}

?>
<?php

require "conexaobd.php"; //inclui arquivo com os dados e funções de conexão
require "agenda.php";

$arrayAgenda = "";
$erro = "";	

try{

	$conexao = conectaBD();
	$arrayAgenda = getAgenda($conexao);

}catch(Exception $e){

	$erro = $e->getMessage();
}

?>

  <div class="container lista">	  
  	<h2 class="listagens">LISTA DE AGENDAMENTOS</h2>
	  		<div class="table-responsive">
				<table class="table">
					<thead>
						<tr class="tabelalistagens">
							<th>Nome do Médico</th>
							<th>Especialidade</th>
							<th>Data da Consulta</th>
							<th>Hora da Consulta</th>
							<th>Nome do Paciente</th>                        
							<th>Telefone do Paciente</th>
						</tr>
					</thead>
					
				<tbody>
					<?php
					
						if ($arrayAgenda != "")
						{
						
								foreach ($arrayAgenda as $agenda)
								{       
									echo "
									<tr>
									<td>$agenda->codFuncionario</td>
									<td>$agenda->especialidade</td>
									<td>$agenda->dataconsulta</td>
									<td>$agenda->horaconsulta</td>
									<td>$agenda->codPaciente</td>
									<td>$agenda->telefone</td>       
									</tr>      
									";
								}
						}
						
					?>    
					
				</tbody>
				</table>

			
			<!-- <?php
			
			if ($erro != "")
				echo "<p class='text-danger'>A operação não pode ser realizada: $erro</p>";
			
			?> -->
		</div>
	</div>

<?php include "footer.php" ?>