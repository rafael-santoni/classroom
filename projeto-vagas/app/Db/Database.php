<?php

namespace App\Db;

class Database {
	
	/**
	 * Host para conexão com o BD
	 * @var string
	 */
	const HOST = 'localhost:3306';
	
	/**
	 * Nome do Bando de Dados
	 * @var string
	 */
	const NAME = "rafasantoni_vagas";
	
	/**
	 * Usuário para conectar no BD
	 * @var string
	 */
	const USER = "rafasantoni_conn";
	
	/**
	 * Senha de acesso do Usuário para conectar no BD
	 * @var string
	 */
	const PASS = "thunder02";
	
	/**
	 * Nome da tabela que a ser manipulada
	 * @var string
	 */
	public $table;
	
	/**
	 * Instância de conexão com o Banco de Dados
	 * @var PDO
	 */
	public $connection;
	
	/**
	 * Instancia a conexão
	 * @param string $table
	 */
	public function __construct($table=null){
		$this->table = $table;
		$this->setConnection();
	}
	
	/**
	 * Método responsável por criar a conexão com o BD
	 */
	private function setConnection(){
		try{
			$this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASS);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
			die('Erro: '.$e->getMessage());
		}
	}
	
	/**
	 * Método responsável por executar QUERIES no Banco de Dados
	 * @param string $query
	 * @param array $params [ field => value ]
	 * @return PDOStatement
	 */
	public function execute($query, $params=[]){
		try{
			$statement = $this->connection->prepare($query);
			$statement->execute($params);
			return $statement;
		} catch(PDOException $e){
			die('Erro: '.$e->getMessage());
		}
	}
	
	/**
	 * Método responsável por inserir dados no BD
	 * @param array $values [ field => value ]
	 * @return integer (ID inserido)
	 */
	public function insert($values){
		//Dados da QUERY
		$fields = array_keys($values);
		$binds  = array_pad([],count($fields),'?');
		
		//Cria a QUERY
		$query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
		
		//Executa a QUERY
		$var = 
		$this->execute($query,array_values($values));
		
		//retorna o ID inserido
		return $this->connection->lastInsertId();
	}
	
	/**
	 * Método para obter dados do BD
	 * @param string $where
	 * @param string $order
	 * @param string $limit
	 * @param string $fields
	 * @return PDOStatement
	 */
	public function select($where=null, $order=null, $limit=null, $fields="*"){
		
		//Trata os dados para a QUERY
		$where = strlen($where) ? 'WHERE '.$where : '';
		$order = strlen($order) ? 'ORDER BY '.$order : '';
		$limit = strlen($limit) ? 'LIMIT '.$limit : '';
		
		$query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;
		
		return $this->execute($query);
	}
	
	/**
	 * Método para atualizar dados no Banco de Dados
	 * @param string $where
	 * @param array $values [ field => values ]
	 * @return Boolan
	 */
	public function update($where, $values){
		//Trata os campos e dados da QUERY
		$fields = array_keys($values);
		$dados = array_values($values);
		
		$query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
		
		$this->execute($query,$dados);
		
		return true;
	}
	
	/**
	 * Método para excluir dados no Banco de Dados
	 * @param string $where
	 * @return Boolan
	 */
	public function delete($where){
		$query = 'DELETE FROM '.$this->table.' WHERE '.$where;
		
		$this->execute($query);
		
		return true;
	}
	
}