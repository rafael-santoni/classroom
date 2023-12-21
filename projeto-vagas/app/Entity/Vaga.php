<?php

namespace App\Entity;

use \App\Db\Database;

class Vaga {
	
	/**
	 * ID único da vaga
	 * @var integer
	 */
	public $id;
	
	/**
	 * Título da vaga
	 * @var string
	 */
	public $titulo;
	
	/**
	 * Descrição da vaga (pode conter TAGs)
	 * @var string
	 */
	public $descricao;
	
	/**
	 * Define se a vaga está ativa
	 * @var string (s/n)
	 */
	public $ativo;
	
	/**
	 * Data de inclusão da vaga no BD
	 * @var string
	 */
	public $data;
	
	/**
	 * Método para cadastrar novas vagas no BD
	 * @return boolean
	 */
	public function cadastrar(){
		$this->data = date('Y-m-d H:i:s');
		
		$objDatabase = new Database('vagas');
		$this->id = $objDatabase->insert([
											'titulo' => $this->titulo,
											'descricao' => $this->descricao,
											'ativo' => $this->ativo,
											'data' => $this->data
										]);
		return true;
	}
	
	/**
	 * Método para atualizar os dados de uma vaga no BD
	 * @return Boolean
	 */
	public function atualizar(){
		return (new Database('vagas'))->update('id = '.$this->id, [
																	'titulo' => $this->titulo,
																	'descricao' => $this->descricao,
																	'ativo' => $this->ativo,
																	'data' => $this->data
																]);
	}
	
	/**
	 * Método para excluir a vaga do BD
	 * @return Boolean
	 */
	public function excluir(){
		return (new Database('vagas'))->delete('id = '.$this->id);
	}
	
	/**
	 * Método para obter as vagas no BD
	 * @param string $where
	 * @param string $order
	 * @param string $limit
	 * @return array
	 */
	public static function getVagas($where=null, $order=null, $limit=null){
		return (new Database('vagas'))->select($where, $order, $limit)
									  ->fetchAll(PDO::FETCH_CLASS, self::class);
	}
	
	/**
	 * Método para obter a quantidade de vagas no BD
	 * @param string $where
	 * @return integer
	 */
	public static function getQuantidadeVagas($where=null){
		return (new Database('vagas'))->select($where,null,null,'COUNT(*) as qtd')
									  ->fetchObject()
									  ->qtd;
	}
	
	/**
	 * Método para buscar uma vaga no BD pelo seu ID
	 * @param integer $id
	 * @return Vaga
	 */
	public static function getVagaByID($id){
		return (new Database('vagas'))->select('id = '.$id)
									  ->fetchObject(self::class);
	}
}