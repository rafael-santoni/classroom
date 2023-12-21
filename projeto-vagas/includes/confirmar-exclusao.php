<main class="text-light">

	<h2 class="mt-3"><?=TITLE?></h2>
	
	<form method="post">
		<div class="form-group">
			<p>Deseja realmente excluir a vaga <strong><?=$objVaga->titulo?></strong></p>
		</div>
		
		<div class="form-group">
			<a href="index.php"><button type="button" class="btn btn-success">Cancelar</button></a>
			<button type="submit" class="btn btn-danger" name="excluir">Excluir</button>
		</div>
		
	</form>
</main>