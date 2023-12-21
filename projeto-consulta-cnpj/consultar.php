<?php 

require __DIR__.'/vendor/autoload.php';

use \App\WebService\Speedio;

//Nova instância de Speedio
$objSpeedio = new Speedio;

$cnpj = '00.000.000/0001-91';
// $cnpj = '00000000000191';

//Consulta o CNPJ nas APIs do Speedio
$resultado = $objSpeedio->consultarCNPJ($cnpj);

//Verifica o resultado
if(empty($resultado)) {
    die('Problemas ao consultar CNPJ');
}

//Verifica o erro da requisição
if(isset($resultado['error'])) {
    die($resultado['error']);
}

//Imprime os dados de sucesso
echo "CNPJ: $cnpj <br>";
echo 'Razão Social: '.$resultado['RAZAO SOCIAL'].'<br>';
echo 'Nome Fantasia: : '.$resultado['NOME FANTASIA'].'<br>';

// echo "<pre>";
// print_r($resultado);
// echo "</pre>"; exit;
