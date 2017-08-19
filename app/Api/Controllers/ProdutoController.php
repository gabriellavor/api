<?php
	namespace Api\Controllers;
	use Api\Controllers\Controller;

	class ProdutoController extends Controller{


		public function listaProdutos($request,$response,$args){
			$produtos_sql = $this->db->prepare("SELECT * FROM `produto`");
			$produtos_sql->execute();
			$produtos = $produtos_sql->fetchAll();
			$newResponse = $response->withHeader('Content-type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
			return $newResponse->withJson($produtos, 200);
		}

		public function listaProduto($request,$response,$args){
			$produtos = array();
			$id = (int)$args['id'];
			if($id > 0){
				$produtos_sql = $this->db->prepare("SELECT * FROM `produto` where `id` = ".$id);
				$produtos_sql->execute();
				$produtos = $produtos_sql->fetchAll();
			}
			$newResponse = $response->withHeader('Content-type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
			return $newResponse->withJson($produtos, 200);
		}

		public function busca($request,$response,$args){
			$produtos = array();
			$argumento = (string)$args['descricao'];
			if(!empty($argumento)){
				$produtos_sql = $this->db->prepare("SELECT * FROM `produto` where `descricao` like '%$argumento%'");
				$produtos_sql->execute();
				$produtos = $produtos_sql->fetchAll();
			}
			$newResponse = $response->withHeader('Content-type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
			return $newResponse->withJson($produtos, 200);
		}
	}