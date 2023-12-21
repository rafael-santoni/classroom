<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Vaga;
use \App\Db\Pagination;
use \App\Session\Login;

// Obriga o Usuário a estar logado
Login::requireLogin();


// ***********  BUSCA E FILTRO DE STATUS  *********** //
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

$filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_SANITIZE_STRING);
$filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : '';

$condicoesSQL = [
	strlen($busca) ? 'titulo LIKE "%'.str_replace(' ','%',$busca).'%"' : null,
	strlen($filtroStatus) ? 'ativo = "'.$filtroStatus.'"' : null
];

$condicoesSQL = array_filter($condicoesSQL);  // Remove posições NULL
// ***********  BUSCA E FILTRO DE STATUS  *********** //


//Cria a clausula WHERE para a Busca
$where = implode(' AND ',$condicoesSQL);

$quantidadeVagas = Vaga::getQuantidadeVagas($where);
$paginaAtual = $_GET['pagina'] ?? 1;    //  Operedor ternário com isset() 


//  ***************  Paginação  ***************
$objPagination = new Pagination($quantidadeVagas, $paginaAtual, 5);
$sqlLimit = $objPagination->getSqlLimit();

//  ***************  Paginação  ***************


$vagas = Vaga::getVagas($where,null,$sqlLimit);

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';