<?php
	namespace Api\Controllers;
	use Api\Controllers\Controller;

	class CategoriaController extends Controller{


		public function listaCategorias($request,$response,$args){
			$categorias_sql = $this->db->prepare("SELECT * FROM `categoria`");
			$categorias_sql->execute();
			$categorias = $categorias_sql->fetchAll();
			$newResponse = $response->withHeader('Content-type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
			return $newResponse->withJson($categorias, 201);
		}

		public function listaCategoria($request,$response,$args){
			$categorias = array();
			$id = (int)$args['id'];
			if($id > 0){
				$categorias_sql = $this->db->prepare("SELECT * FROM `categoria` where `id` = ".$id);
				$categorias_sql->execute();
				$categorias = $categorias_sql->fetchAll();
			}
			$newResponse = $response->withHeader('Content-type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
			return $newResponse->withJson($categorias, 201);
		}
	}