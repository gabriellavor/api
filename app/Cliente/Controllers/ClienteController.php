<?php
	namespace Cliente\Controllers;
	use Cliente\Controllers\Controller;

	class ClienteController extends Controller{


		public function listaClientes($request,$response,$args){
			$clientes_sql = $this->db->prepare("SELECT * FROM `clientes`");
			$clientes_sql->execute();
			$clientes = $clientes_sql->fetchAll();
			$retorno = json_encode($clientes);
			$this->logger->addInfo("Ticket list :".$retorno);
			$retorno = $this->fff(12);
			return $retorno;
		}

		public function listaCliente($request,$response,$args){
			$retorno = array();
			$id = (int)$args['id'];
			if($id > 0){
				$clientes_sql = $this->db->prepare("SELECT * FROM `clientes` where `id` = ".$id);
				$clientes_sql->execute();
				$clientes = $clientes_sql->fetchAll();
				$retorno = json_encode($clientes);
			}
			$this->logger->addInfo("Ticket list :".$retorno);
				$retorno = $this->fff(12);
			return $retorno;
		}

		public function fff(int $i){
			$count = 0;
			while ($i > 0) {
				if($i % 3 == 0 && $i % 2 == 0 ){
					$count += 6;
					$i = $i / 6;
				}elseif($i % 3 == 0){
					$count += 3;
					$i = $i / 3;
				}elseif($i % 2 == 0){
					$count += 2;
					$i = $i / 2;
				}else{
					$count += 1;
					$i--;
				}
			}
			echo $count;
			return $count;
		}

	
	}