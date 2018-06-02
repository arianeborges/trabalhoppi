<?php include "sidebar.php" ?>

<?php

require "conexaobd.php"; //inclui arquivo com os dados e funções de conexão
require "contato.php";

$arrayContato = "";
$erro = "";	

try{

	$conexao = conectaBD();
	$arrayContato = getContato($conexao);

}catch(Exception $e){

	$erro = $e->getMessage();
}

?>

  	<div class="container lista">
		<h2 class="listagens">LISTA DE CONTATOS</h2>
		<div class = "table-responsive">
			<table class="table table-striped">
				<thead>
					<tr class="tabelalistagens">
						<th>Nome do Cliente</th>
						<th>Data da mensagem</th>
						<th>E-mail do Cliente</th>
						<th>Motivo do Contato</th>
						<th>Mensagem</th>              
					</tr>
				</thead>
					
				<tbody>
					<?php
					
						if ($arrayContato != "")
						{
						
								foreach ($arrayContato as $contato)
								{       
									echo "
									<tr>
									<td>$contato->nome</td>
									<td>$contato->data</td>
									<td>$contato->email</td>
									<td>$contato->motivo</td>
									<td>$contato->mensagem</td>         
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

<?php include "footer.php" ?>