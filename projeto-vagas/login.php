<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Acesse o Sistema ou Cadastre-se');

use \App\Session\Login;
use \App\Entity\Usuario;

// Obriga o Usuário a estar logado
Login::requireLogout();

$alertaLogin = '';
$alertaCadastro = '';

if(isset($_POST['acao'])){
	switch($_POST['acao']){
		case 'logar':
			if(isset($_POST['email'],$_POST['senha'])){	
				$objUsuario = Usuario::getUsuarioByEmail($_POST['email']);
				if(!$objUsuario instanceof Usuario || !password_verify($_POST['senha'],$objUsuario->senha)){
					$alertaLogin = 'E-mail ou senha inválidos.';
					break;
				}
				
				Login::doLogin($objUsuario);
			}
			break;
		case 'cadastrar':
			if(isset($_POST['nome'],$_POST['email'],$_POST['senha'])){
				$objUsuario = Usuario::getUsuarioByEmail($_POST['email']);
				if($objUsuario instanceof Usuario){
					$alertaCadastro = 'O e-mail informado já está em uso.';
					break;
				}
				
				
				$objUsuario = new Usuario();
				$objUsuario->nome  = $_POST['nome'];
				$objUsuario->email = $_POST['email'];
				$objUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
				$objUsuario->cadastrar();
				
				Login::doLogin($objUsuario);
			}
			break;
		
	}
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario-login.php';
include __DIR__.'/includes/footer.php';