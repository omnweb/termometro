<?php
	class CampanhaDAO extends Conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		//Cadastrar Campanha
		
		public function cadastrarCampanha($campanha)
		{
			$sql = "INSERT INTO campanha(id_empresa, id_funcionario, status_campanha, descritivo) VALUES(?,?,?,?)";
			
			try
			{
				$f = $this->db->prepare($sql);	
				$f->bindValue(1, $campanha->getId_empresa());
				$f->bindValue(2, $campanha->getId_funcionario());
				$f->bindValue(3, $campanha->getStatus());
				$f->bindValue(4, $campanha->getDescritivo());
				$ret = $f->Execute();
				
				$this->db = null;
				
				if(!$ret)
				{
					die("Erro ao inserir Empresa");
				}else
				{
					echo"<script>alert('Campanha cadastrada com sucesso!')</script>";
					echo'<script>window.location="listar_campanha.php";</script>';
				}
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}		
				
		//Sessão Campanha
		
		public function sessaoCampanha($sessao_empresa)
		{
			$sql = "SELECT * FROM campanha where  id_empresa = ? ";
			try
			{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(1, $sessao_empresa->getId());
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
		
		//Funcionario Campanha
		
		public function funcionarioCampanha($campanha)
		{
			$sql = "SELECT id_campanha, descritivo FROM campanha where status_campanha = 1 AND id_funcionario = ?";
			try
			{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(1, $campanha->getId());
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
		
		//excluir Empresa
		
		public function excluir($campanha)
		{
			$sql = "DELETE FROM campanha WHERE id_campanha = ?";
			
			try
			{
				$f = $this->db->prepare($sql);
				$f->bindValue(1, $campanha->getId());				
				$ret = $f->Execute();
				$this->db = null;				
				if(!$ret)
				{
					die("Erro ao excluir Campanha");
				}
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}			
		}
		
		//alterar Campanha
		
		public function alterar($campanha)
		{
			$sql="UPDATE campanha SET id_empresa=?, id_funcionario=?, status_campanha=?, descritivo=? WHERE id_campanha = ?";
			
			try
			{
				$f = $this->db->prepare($sql);
				$f->bindValue(1, $campanha->getId_empresa());
				$f->bindValue(2, $campanha->getId_funcionario());
				$f->bindValue(3, $campanha->getStatus());
				$f->bindValue(4, $campanha->getDescritivo());
				$f->bindValue(5, $campanha->getId());
				
				$ret = $f->Execute();
				$this->db = null;
				
				if(!$ret)
				{
					die("Erro ao atualizar Empresa");
				}
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}			
		}
		
		//buscar um
		
		public function buscarCampanha($campanha)
		{
			$sql = "SELECT * FROM campanha where id_campanha = ?";
			try
			{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(1, $campanha->getId());
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
		
		//Campanha / Empresa

		public function campanhaEmpresa($campanha)
		{
			$sql = "SELECT c.id_campanha, c.descritivo
					FROM campanha c
					INNER JOIN empresa e ON (c.id_empresa = e.id_empresa)
					WHERE e.id_empresa = ?";
			try
			{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(1, $campanha->getId());
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
		
	}//class
?>