<?php
//phpinfo();die; 

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
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$container['ClienteController'] = function($container) use ($app){
	return new Cliente\Controllers\ClienteController($container);
};


$app->get('/cliente','ClienteController:listaClientes')->setName('cliente');
$app->get('/cliente/{id}','ClienteController:listaCliente')->setName('cliente');
// $app->get('/cliente',function($request,$response,$args){
// 	$clientes_sql = $this->db->prepare("SELECT * FROM `clientes`");
// 	$clientes_sql->execute();
// 	$clientes = $clientes_sql->fetchAll();
// 	$retorno = json_encode($clientes);
// 	$this->logger->addInfo("Ticket list :".$retorno);
// 	return $retorno;
// });

// $app->post('/cliente/{id}',function($request,$response,$args){
// 	$ticket_id = (int)$args['id']
// 	$clientes_sql = $this->db->prepare("SELECT * FROM `clientes`");
// 	$clientes_sql->execute();
// 	$clientes = $clientes_sql->fetchAll();
// 	$retorno = json_encode($clientes);
// 	$this->logger->addInfo("Ticket list :".$retorno);
// 	return $retorno;
//});

$app->run();