<?php

namespace App\Db;

class Pagination{
	
	/**
	 * Número máximo de registris por página
	 * @var integer
	 */
	private $limit;
	
	/**
	 * Quantidade total de resultados do Banco de Dados
	 * @var integer
	 */
	private $results;
	
	/**
	 * Quantidade de páginas
	 * @var integer
	 */
	private $pages;
	
	/**
	 * Indicar a Página Atual
	 * @var integer
	 */
	private $currentPage;
	
	/**
	 * Construtor da classe
	 * @param integer $results
	 * @param integer $currentPage
	 * @param integer $limit
	 */
	public function __construct($results, $currentPage = 1, $limit = 10) {
		$this->results = $results;
		$this->currentPage = (is_numeric($currentPage) and $currentPage>0) ? $currentPage : 1;
		$this->limit = $limit;
		$this->calculatePages();
	}
	
	/**
	 * Calcula o total de páginas
	 */
	private function calculatePages(){
		$this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;
		
		$this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;   // Verifica se a página atual não excede o número de páginas
	}
	
	/**
	 * Mátodo responsável por retornar a cláusula LIMIT do SQL
	 */
	public function getSqlLimit(){
		$offset = ($this->limit * ($this->currentPage - 1));
		return $offset.','.$this->limit;
	}
	
	/**
	 * Método responsável por retornar as opções de páginas disponíveis
	 * @return integer $limit
	 */
	public function getPages(){
		if ($this->pages == 1) return [];
		
		$paginas = [];
		for($i = 1; $i<= $this->pages; $i++){
			$paginas[] = [
				'pagina' => $i,
				'atual' => $i == $this->currentPage
			];
		}
		
		return $paginas;
	}
	
}