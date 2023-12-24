<?php

// Controle de fluxo da aplicação
define('CONTROL', true);

// Incluir arquivos
$routes = require_once('includes/routes.php');
require_once('includes/ApiConsumer.php');

// Definir rota
$route = $_GET['route'] ?? 'home';

if (!in_array($route, $routes)) {
    $route = '404';
}

// Fluxo das rotas
switch ($route) {
    case 'home':
        require_once 'includes/header.php';
        require_once 'app/home.php';
        require_once 'includes/footer.php';
        break;
    case '404':
        require_once 'includes/header.php';
        require_once 'app/404.php';
        require_once 'includes/footer.php';
        break;
}
