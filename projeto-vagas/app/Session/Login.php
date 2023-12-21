<?php

namespace App\Session;

class Login{
	
	/**
	 * Método responsável por iniciar a sessão
	 */
	private static function init(){
		if(session_status() !== PHP_SESSION_ACTIVE){
			session_start();
		}
	}

	/**
	 * Método responsável por verificar se o usuário já está logado
	 * @return boolean
	 */
	public static function isLogged(){
		self::init();
		
		return isset($_SESSION['usuario']['id']);	
	}
	
	/**
	 * Método responsável por obrigar o usuário a estar logado para acessar a página
	 * @return boolean
	 */
	public static function requireLogin(){
		if (!self::isLogged()){
			header('location: login.php');
			exit;
		}
	}
	
	/**
	 * Método responsável por obrigar o usuário a estar Deslogado para acessar a página
	 * @return boolean
	 */
	public static function requireLogout(){
		if (self::isLogged()){
			header('location: index.php');
			exit;
		}
	}
	
	/**
	 * Método responsável por criar a sessão e logar o Usuário no Sistema
	 * @param Usuario $objUsuario
	 */
	public static function doLogin($objUsuario){
		self::init();
		
		$_SESSION['usuario'] = [
									'id'=> $objUsuario->id,
									'nome'=> $objUsuario->nome,
									'email'=> $objUsuario->email
								];
		header('location: index.php');
		exit;
	}
	
	/**
	 * Método responsável por deslogar o Usuário no Sistema
	 */
	public static function doLogout(){
		self::init();
		unset($_SESSION['usuario']);
		
		header('location: login.php');
		exit;
	}
	
	/**
	 * Método responsável por criar a sessão e logar o Usuário no Sistema
	 * @return array
	 */
	public static function getUsuarioLogado(){
		self::init();
		
		return self::isLogged() ? $_SESSION['usuario'] : null;
	}
	
}