<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Excluir Vaga');

use \App\Entity\Vaga;
use \App\Session\Login;

// Obriga o Usuário a estar logado
Login::requireLogin();

//Validar o ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
	header('location: index.php?status=error');
	exit;
}

$objVaga = Vaga::getVagaByID($_GET['id']);

//Validar a vaga
if(!$objVaga instanceof Vaga){
	header('location: index.php?status=error');
}

// Validação do POST
if(isset($_POST['excluir'])){
	
	$objVaga->excluir();
	
	
	header('location: index.php?status=success');
	exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmar-exclusao.php';
include __DIR__.'/includes/footer.php';