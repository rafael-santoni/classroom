<?php

namespace App\WebService;

class Speedio {

    /**
     * URL base da API do Speedio
     * @var string
     */
    const URL_BASE = 'https://api-publica.speedio.com.br';

    /**
     * Método responsável por consultar um CNPJ nas APIs do Speedio
     * @param string $cnpj
     * @return array
     */
    public function consultarCNPJ($cnpj) {
        //Remove os caracteres inválidos
        $cnpj = preg_replace('/\D/', '', $cnpj);

        //Retorna a execução da consulta
        return $this->get('/buscarcnpj?cnpj='.$cnpj);
    }

    /**
     * Método responsável por executar a consulta nas APIs do Speedio
     * @param string $resource
     * @return array
     */
    public function get($resource) {
        //Endpoint completo da API
        $endpoint = self::URL_BASE.$resource;

        //Inicia o cURL
        $curl = curl_init();

        //Configurações do cURL
        curl_setopt_array($curl,[
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        //Desabilita a verificação de certificados de segurança
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

        //Executa a requisição
        $response = curl_exec($curl);

        //Fecha a conexão
        curl_close($curl);

        //Response em Array
        $responseArray = json_decode($response,true);

        //Retorna o Array com os dados
        return is_array($responseArray) ? $responseArray : [];
    }
}