<?php

use \App\Session\Login;

$usuarioLogado = Login::getUsuarioLogado();

$headerUsuario = $usuarioLogado ? 
			'Olá '.$usuarioLogado['nome'].'! <a href="logout.php" class="text-light font-weight-bold ml-2">Sair</a>' : 
			'Olá Visitante! <a href="login.php" class="text-light font-weight-bold ml-2">Entrar</a>';

?>

<!doctype html>
<html lang="pt-BR">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

		<title>MMav - Vagas</title>
	</head>
	<body class="bg-dark text-black-50">
		<div class="container">
			<div class="jumbotron bg-info">
				<h1>MMav - Vagas</h1>
				<p>Projeto com exemplos de CRUD, OO, PDO e composer</p>
				<hr class="border-light" />
				<div class="d-flex justify-content-start">
					<?=$headerUsuario?>
				</div>
			</div>
