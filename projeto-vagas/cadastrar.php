<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Cadastrar Vaga');

use \App\Entity\Vaga;
use \App\Session\Login;

// Obriga o Usuário a estar logado
Login::requireLogin();


$objVaga = new Vaga;

// Validação do POST
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])){
	//$objVaga = new Vaga;
	$objVaga->titulo = $_POST['titulo'];
	$objVaga->descricao = $_POST['descricao'];
	$objVaga->ativo = $_POST['ativo'];
	
	$objVaga->cadastrar();
	
	header('location: index.php?status=success');
	exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';