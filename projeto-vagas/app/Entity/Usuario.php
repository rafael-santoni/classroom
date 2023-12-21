<?php

namespace App\Entity;

use \App\Db\Database;

class Usuario{
	
	/**
	 * ID do Usuário
	 * @var integer
	 */
	public $id;
	
	/**
	 * Nome do Usuário
	 * @var varchar
	 */
	public $nome;
	
	/**
	 * Endereço de e-mail do Usuário
	 * @var varchar
	 */
	public $email;
	
	/**
	 * Hash da senha de acesso ao sistema do Usuário
	 * @var varchar
	 */
	public $senha;
	
	/**
	 * Método responsável por cdastrar um novo Usuário no BD
	 * @return boolean
	 */
	public function cadastrar(){
		$objDB = new Database('usuarios');
		
		$this->id = $objDB->insert([
									'nome' => $this->nome,
									'email' => $this->email,
									'senha' => $this->senha
								]);
		
		return true;
	}
	
	/**
	 * Método responsável por retornar uma instância de Usuário com base em seu e-mail
	 * @param string $email
	 * @return Usuario
	 */
	public static function getUsuarioByEmail($email){
		return (new Database('usuarios'))->select('email ="'.$email.'"')->fetchObject(self::class);
	}
}