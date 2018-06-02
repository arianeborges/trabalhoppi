<?php include "sidebar.php" ?>

  <div class="container">	  
  	<h2 class="listagens">LISTA DE CONTATOS</h2>
	  		<div class="table-responsive">
				<table class="table table-striped">
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
	</div>

<?php include "footer.php" ?>