<?php
	namespace Api\Controllers;
	use Api\Controllers\Controller;

	class ClienteController extends Controller{


		public function listaClientes($request,$response,$args){
			$clientes_sql = $this->db->prepare("SELECT * FROM `cliente`");
			$clientes_sql->execute();
			$clientes = $clientes_sql->fetchAll();
			$retorno = json_encode($clientes);
			return $retorno;
		}

		public function listaCliente($request,$response,$args){
			$retorno = array();
			$id = (int)$args['id'];
			if($id > 0){
				$clientes_sql = $this->db->prepare("SELECT * FROM `cliente` where `id` = ".$id);
				$clientes_sql->execute();
				$clientes = $clientes_sql->fetchAll();
				$retorno = json_encode($clientes);
			}
			return $retorno;
		}
	}