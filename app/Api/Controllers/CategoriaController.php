<?php
	namespace Api\Controllers;
	use Api\Controllers\Controller;

	class CategoriaController extends Controller{


		public function listaCategorias($request,$response,$args){
			$categorias_sql = $this->db->prepare("SELECT * FROM `categoria`");
			$categorias_sql->execute();
            $categorias = $categorias_sql->fetchAll();
            $retorno = json_encode($categorias);    
			return $retorno;
		}

		public function listaCategoria($request,$response,$args){
			$retorno = array();
			$id = (int)$args['id'];
			if($id > 0){
				$categorias_sql = $this->db->prepare("SELECT * FROM `categoria` where `id` = ".$id);
				$categorias_sql->execute();
				$categorias = $categorias_sql->fetchAll();
				$retorno = json_encode($categorias);
			}
			return $retorno;
		}
	}