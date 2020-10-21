<?php
	class EmpresaDAO extends Conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}

		//Listar Empresa

		public function listarEmpresa()
		{
			$sql = "SELECT * FROM empresa";
			
			try
			{
				$f = $this->db->prepare($sql);
				$ret = $f->execute();
				$this->db = null;
				if(!$ret)
				{
					die("Erro ao buscar todas as Empresas");
				}
				else
				{
					return $retorno = $f->fetchAll(PDO::FETCH_OBJ);
				}
			}	
			catch(Exception $e)
			{
				die($e->getMessage());
			}			
		}		

		//Cadastrar Empresa
		
		public function cadastrarEmpresa($empresa)
		{
			$sql = "INSERT INTO empresa(status_empresa, descritivo, cnpj, telefone, contato) VALUES(?,?,?,?,?)";
			
			try
			{
				$f = $this->db->prepare($sql);	
				$f->bindValue(1, $empresa->getStatus());
				$f->bindValue(2, $empresa->getDescritivo());
				$f->bindValue(3, $empresa->getCnpj());
				$f->bindValue(4, $empresa->getTelefone());
				$f->bindValue(5, $empresa->getContato());				
				$ret = $f->Execute();
				
				$this->db = null;
				
				if(!$ret)
				{
					die("Erro ao inserir Empresa");
				}else
				{
					echo"<script>alert('Empresa cadastrada com sucesso')</script>";
					echo'<script>window.location="listar_empresa.php";</script>';
				}
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}		
				
		//Listar Empresas
		
		public function buscarTodas()
		{
			$sql = "SELECT empresa.*, descritivo FROM empresa WHERE id_empresa = id_empresa";
			
			try
			{
				$f = $this->db->prepare($sql);
				$ret = $f->execute();
				$this->db = null;
				if(!$ret)
				{
					die("Erro ao buscar todas as Empresas");
				}
				else
				{
					return $retorno = $f->fetchAll(PDO::FETCH_OBJ);
				}
			}	
			catch(Exception $e)
			{
				die($e->getMessage());
			}			
		}		
		
		//excluir Empresa
		
		public function excluir($empresa)
		{
			$sql = "DELETE FROM empresa WHERE id_empresa = ?";
			
			try
			{
				$f = $this->db->prepare($sql);
				$f->bindValue(1, $empresa->getId());				
				$ret = $f->Execute();
				$this->db = null;				
				if(!$ret)
				{
					die("Erro ao excluir empresa");
				}
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}			
		}
		
		//alterar empresa
		
		public function alterar($empresa)
		{
			$sql="UPDATE empresa SET status_empresa=?, descritivo=?, cnpj=?, telefone=?, contato=? WHERE id_empresa = ?";
			
			try
			{
				$f = $this->db->prepare($sql);
				$f->bindValue(1, $empresa->getStatus());
				$f->bindValue(2, $empresa->getDescritivo());
				$f->bindValue(3, $empresa->getCnpj());
				$f->bindValue(4, $empresa->getTelefone());
				$f->bindValue(5, $empresa->getContato());
				$f->bindValue(6, $empresa->getId());
				
				$ret = $f->Execute();
				$this->db = null;
				
				if(!$ret)
				{
					die("Erro ao Atualizar Empresa");
				}else
				{
					echo"<script>alert('Empresa atualizada com sucesso')</script>";
					echo'<script>window.location="listar_empresa.php";</script>';
				}
				
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}			
		}

		//buscar Empresa/Funcionario
		
		public function buscarEmpresaFuncionario($empresa)
		{
			$sql = "SELECT e.id_empresa, e.descritivo
			FROM empresa e
			INNER JOIN funcionario f ON (f.id_empresa = e.id_empresa)
			WHERE f.id_funcionario = ?";
			try
			{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(1, $empresa->getId());
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
		
		//buscar um
		
		public function buscarEmpresa($empresa)
		{
			$sql = "SELECT * FROM empresa where id_empresa = ?";
			try
			{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(1, $empresa->getId());
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