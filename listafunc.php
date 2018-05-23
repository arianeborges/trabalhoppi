<?php include "sidebar.php"; ?>

  <div class="container lista">
		<h2>LISTA DE FUNCIONÁRIOS</h2>
		<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Nome do Funcionário</th>
							<th>Sexo</th>
							<th>Cargo</th>
							<th>RG</th>
							<th>Logradouro</th>                        
							<th>Cidade</th>
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

<?php include "footer.php"; ?>