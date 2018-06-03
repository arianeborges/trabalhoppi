<?php include "sidebar.php"; 

session_start();

if(!$_SESSION['login']) {
    header("Location:index.php");
    die();
}

?>

<?php

require "conexaobd.php"; //inclui arquivo com os dados e funções de conexão
require "funcionario.php";

$arrayFuncionario = "";
$erro = "";	

try{

	$conexao = conectaBD();
	$arrayFuncionario = getFuncionario($conexao);

}catch(Exception $e){

	$erro = $e->getMessage();
}

?>

  <div class="container lista">
		<h2 class="listagens">LISTA DE FUNCIONÁRIOS</h2>
		<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr class="tabelalistagens">
							<th>Nome do Funcionário</th>
							<th>Sexo</th>
							<th>Cargo</th>
							<th>RG</th>
							<th>Logradouro</th>                        
							<th>Cidade</th>
						</tr>
					</thead>
					
				<tbody>
					<?php
					
						if ($arrayFuncionario != "")
						{
						
								foreach ($arrayFuncionario as $funcionario)
								{       
									echo "
									<tr>
									<td>$funcionario->nome</td>
									<td>$funcionario->sexo</td>
									<td>$funcionario->cargofunc</td>
									<td>$funcionario->rgfunc</td>
									<td>$funcionario->logradouro</td>  
									<td>$funcionario->cidade</td>       
									</tr>      
									";
								}
						}
						
					?>    
					
				</tbody>
				</table>

			
			<?php
			
			if ($erro != "")
				echo "<p class='text-danger'>A operação não pode ser realizada: $erro</p>";
			
			?>
		</div>
	</div>

<?php include "footer.php"; ?>