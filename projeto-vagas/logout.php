<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Sair do Sistema');

use \App\Session\Login;

Login::doLogout();
