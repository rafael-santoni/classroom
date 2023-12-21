<?php

$mensagem = '';
if(isset($_GET['status'])){
	switch ($_GET['status']) {
		case 'success':
			$mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
			break;
		case 'error':
			$mensagem = '<div class="alert alert-danger">Ação não pode ser executada!</div>';
			break;
	}
}

$linhasTabela='';

foreach($vagas as $vaga){
	$linhasTabela .= '<tr>
						<td>'.$vaga->id.'</td>
						<td>'.$vaga->titulo.'</td>
						<td>'.$vaga->descricao.'</td>
						<td>'.($vaga->ativo == 's' ? 'Ativo' : 'Inativo').'</td>
						<td>'.date('d/m/Y à\s H:i:s', strtotime($vaga->data)).'</td>
						<td>
							<a href="editar.php?id='.$vaga->id.'">
								<button class="btn btn-primary">Editar</button>
							</a>
							<a href="excluir.php?id='.$vaga->id.'">
								<button class="btn btn-danger">Excluir</button>
							</a>
						</td>
					</tr>';
}

$linhasTabela = strlen($linhasTabela) ? $linhasTabela : '<tr><td colspan="6" class="text-center">Nenhuma vaga foi encontrada!</td></tr>' ;


//   **********  PAGINAÇÃO  **********
unset($_GET['status']);
unset($_GET['pagina']);
$newGET = http_build_query($_GET);

$paginacao = '';
$paginas = $objPagination->getPages();

foreach($paginas as $key=>$pagina){
	$btnClass = $pagina['atual'] ? 'btn-primary' : 'btn-light' ;
	$paginacao .= '<a href="?pagina='.$pagina['pagina'].'&'.$newGET.'">
						<button type="button" class="btn '.$btnClass.'">'.$pagina['pagina'].'</button>
					</a>';
}


//   **********  PAGINAÇÃO  **********

?>

<main>
	
	<?=$mensagem?>
	
	<section>
		<a href="cadastrar.php">
			<button class="btn btn-success">Nova vaga</button>
		</a>
	</section>
		<form method="GET">
			<div class="row my-4">
				<div class="col">
					<label class="text-light">Buscar por título</label>
					<input type="text" name="busca" class="form-control" value="<?=$busca?>"/>
				</div>
				<div class="col">
					<label class="text-light">Status</label>
					<select name="filtroStatus" class="form-control">
						<option value="">Ativa/Inativa</option>
						<option value="s" <?=$filtroStatus=='s' ? 'selected' : ''?>>Ativa</option>
						<option value="n" <?=$filtroStatus=='n' ? 'selected' : ''?>>Inativa</option>
					</select>
				</div>
				<div class="col d-flex align-items-end">
					<button type="submit" class="btn btn-primary">Filtrar</button>
				</div>
			</div>
		</form>
	<section>
		
	</section>
	
	<section>
		<table class="table bg-light mt-3">
			<thead class="thead">
				<tr>
					<th>ID</th>
					<th>Título</th>
					<th>Descrição</th>
					<th>Status</th>
					<th>Data de Inclusão</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody class="tbody">
				<?=$linhasTabela?>
			</tbody>
			
		</table>
	</section>
	
	<section class="mb-3">
		<?=$paginacao?>
	</section>
	
</main>