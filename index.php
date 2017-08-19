<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'config/config.php';

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],$db['user'], $db['pass']);
    $pdo->exec("set names utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
//Clientes
$container['ClienteController'] = function($container) use ($app){
	return new Api\Controllers\ClienteController($container);
};

$app->get('/cliente','ClienteController:listaClientes')->setName('cliente');
$app->get('/cliente/{id}','ClienteController:listaCliente')->setName('cliente');

//Categorias
$container['CategoriaController'] = function($container) use ($app){
	return new Api\Controllers\CategoriaController($container);
};

$app->get('/categoria','CategoriaController:listaCategorias')->setName('categoria');
$app->get('/categoria/{id}','CategoriaController:listaCategoria')->setName('categoria');

//Produtos
$container['ProdutoController'] = function($container) use ($app){
	return new Api\Controllers\ProdutoController($container);
};

$app->get('/produto','ProdutoController:listaProdutos')->setName('produto');
$app->get('/produto/{id}','ProdutoController:listaProduto')->setName('produto');
$app->get('/produto/busca/{descricao}','ProdutoController:busca')->setName('produto');

$app->run();