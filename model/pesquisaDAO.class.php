<?php
	class pesquisaDAO extends Conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		//buscar Pesquisas
		
		public function buscarPesquisa($id_empresa)
		{
			$sql = "SELECT c.descritivo, DATE_FORMAT(p.data_pesquisa, '%d/%m/%Y')'data', p.atendimento, p.espera, p.ambiente, p.qualidade_produtos, p.item, p.observacao, FORMAT(AVG((p.atendimento + p.espera + p.ambiente + p.qualidade_produtos)/4),2)'media'
			FROM empresa e 
			INNER JOIN campanha c ON (e.id_empresa = c.id_empresa)
			INNER JOIN pesquisa p ON (c.id_campanha = p.id_campanha)
			WHERE c.id_empresa = ? 
			GROUP BY p.id_pesquisa
			ORDER BY media DESC";
			try
			{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(1, $id_empresa);
			$stmt->execute();
			$resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
			$this->db = null;
			return $resultado;
			}
			catch (PDOException $e)
			{
				die( $e->getMessage());
			}
		}	
		
		// Busca intervalo de datas

		public function intervaloDatas($data_pesquisa, $data_pesquisa2, $id_empresa)
		{
			$sql = "SELECT COUNT(p.id_pesquisa)'pesquisas', FORMAT(AVG(p.atendimento),2)'atendimento', FORMAT(AVG(p.espera),2)'espera', FORMAT(AVG(p.ambiente),2)'ambiente', FORMAT(AVG(p.qualidade_produtos),2)'qualidade_produtos', FORMAT(AVG((p.atendimento + p.espera + p.ambiente + p.qualidade_produtos)/4),2)'media'
			FROM empresa e 
			INNER JOIN campanha c ON (e.id_empresa = c.id_empresa)
			INNER JOIN pesquisa p ON (c.id_campanha = p.id_campanha)
			WHERE data_pesquisa BETWEEN '$data_pesquisa' AND '$data_pesquisa2' AND e.id_empresa =  $id_empresa AND c.status_campanha = 1";
			try
			{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(1, $data_pesquisa);
			$stmt->bindValue(2, $data_pesquisa2);
			$stmt->bindValue(3, $id_empresa);
			$stmt->execute();
			$resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
			$this->db = null;
			return $resultado;
			}
			catch (PDOException $e)
			{
				die( $e->getMessage());
			}
		}	

		//Busca Campanha

		public function pesquisaCampanha($campanha, $id_empresa)
		{
			$sql = "SELECT COUNT(p.id_pesquisa)'pesquisas', 
			FORMAT(AVG(p.atendimento),2)'atendimento', 
			FORMAT(AVG(p.espera),2)'espera', 
			FORMAT(AVG(p.ambiente),2)'ambiente', 
			FORMAT(AVG(p.qualidade_produtos),2)'qualidade_produtos', 
			FORMAT(AVG((p.atendimento + p.espera + p.ambiente + p.qualidade_produtos)/4),2)'media',
			(SELECT SUM(item = 1) FROM pesquisa WHERE id_campanha = $campanha) / (SELECT COUNT(id_pesquisa) FROM pesquisa  WHERE id_campanha = $campanha )*100 AS sim,
			(SELECT SUM(item = 2) FROM pesquisa WHERE id_campanha = $campanha) / (SELECT COUNT(id_pesquisa) FROM pesquisa  WHERE id_campanha = $campanha )*100 AS nao
			FROM empresa e 
			INNER JOIN campanha c ON (e.id_empresa = c.id_empresa)
			INNER JOIN pesquisa p ON (c.id_campanha = p.id_campanha)
			WHERE c.id_campanha = ? AND c.id_empresa = ?";
			try
			{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(1, $campanha);
			$stmt->bindValue(2, $id_empresa);
			$stmt->execute();
			$resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
			$this->db = null;
			return $resultado;
			}
			catch (PDOException $e)
			{
				die( $e->getMessage());
			}
		}

		
		//Cadastrar Pesquisa
		
		public function cadastrarPesquisa($pesquisa){			
			$sql = "INSERT INTO pesquisa(id_campanha, data_pesquisa, atendimento, espera, ambiente, qualidade_produtos, item, observacao) VALUES(?,?,?,?,?,?,?,?)";
			
			try
			{
				$f = $this->db->prepare($sql);
				$f->bindValue(1, $pesquisa->getIdCampanha());					
				$f->bindValue(2, $pesquisa->getData_pesquisa());
				$f->bindValue(3, $pesquisa->getAtendimento());
				$f->bindValue(4, $pesquisa->getEspera());
				$f->bindValue(5, $pesquisa->getAmbiente());
				$f->bindValue(6, $pesquisa->getQualidade_produtos());
				$f->bindValue(7, $pesquisa->getItem());
				$f->bindValue(8, $pesquisa->getObservacao());

				$ret = $f->Execute();
				
				$this->db = null;
				
				if(!$ret)
				{
					die("Erro ao Cadastrar resposta da pesquisa");
				}
				else
				{
					echo"<script>alert('Resposta da pesquisa cadastrada com sucesso')</script>";
					echo'<script>window.location="pesquisa.php";</script>';
				}
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}				
	}//class
?>