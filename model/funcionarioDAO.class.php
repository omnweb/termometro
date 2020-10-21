<?php
	class FuncionarioDAO extends Conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		//login
		
		public function login($user)
		{
			$sql = "SELECT id_funcionario, id_perfil, nome
					FROM funcionario 
                    WHERE email = ? && senha = ?";
			try
			{						
				$f = $this->db->prepare($sql);
				$f->bindValue(1, $user->getEmail());
				$f->bindValue(2, $user->getSenha());
				$ret = $f->execute();	
				$this->db = null;
				if(!$ret)
				{
					die("Erro ao validar usuario/senha");
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
		
        //Cadastrar Funcionario
		
		public function cadastrarFuncionario($funcionario)
		{
			$sql = "INSERT INTO funcionario(id_perfil, id_empresa, status_funcionario, nome, email, senha) VALUES(?,?,?,?,?,?)";
			
			try
			{
				$f = $this->db->prepare($sql);	
				$f->bindValue(1, $funcionario->getId_perfil());
				$f->bindValue(2, $funcionario->getId_empresa());
				$f->bindValue(3, $funcionario->getStatus());
				$f->bindValue(4, $funcionario->getNome());
				$f->bindValue(5, $funcionario->getEmail());
				$f->bindValue(6, $funcionario->getSenha());				
				$ret = $f->Execute();
				
				$this->db = null;
				
				if(!$ret)
				{
					die("Erro ao inserir Funcionário");
				}else
				{
					echo"<script>alert('Funcionário cadastrado com sucesso!')</script>";
					echo'<script>window.location="listar_funcionario.php";</script>';
				}
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}		
				
		//Listar Funcionarios
		
		public function listarFuncionario()
		{
			$sql = "SELECT * FROM funcionario";
			
			try
			{
				$f = $this->db->prepare($sql);
				$ret = $f->execute();
				$this->db = null;
				if(!$ret)
				{
					die("Erro ao buscar Funcionarios");
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
		
		//excluir Funcionario
		
		public function excluir($funcionario)
		{
			$sql = "DELETE FROM funcionario WHERE id_funcionario = ?";
			
			try
			{
				$f = $this->db->prepare($sql);
				$f->bindValue(1, $funcionario->getId());				
				$ret = $f->Execute();
				$this->db = null;				
				if(!$ret)
				{
					die("Erro ao excluir funcionario");
				}
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}			
		}
		
		//alterar funcionario
		
		public function alterar($funcionario)
		{
			$sql="UPDATE funcionario SET id_perfil=?, id_empresa=?, status_funcionario=?, nome=?, email=?, senha=? WHERE id_funcionario = ?";
			
			try
			{
				$f = $this->db->prepare($sql);
				$f->bindValue(1, $funcionario->getId_perfil());
				$f->bindValue(2, $funcionario->getId_empresa());
				$f->bindValue(3, $funcionario->getStatus());
				$f->bindValue(4, $funcionario->getNome());
				$f->bindValue(5, $funcionario->getEmail());
				$f->bindValue(6, $funcionario->getSenha());
				$f->bindValue(7, $funcionario->getId());
				
				$ret = $f->Execute();
				$this->db = null;
				
				if(!$ret)
				{
					die("Erro ao atualizar funcionario");
				}
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}			
		}
		
		//buscar um Funcionário
		
		public function buscarFuncionario($funcionario)
		{
			$sql = "SELECT * FROM funcionario where id_funcionario = ?";
			try
			{
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(1, $funcionario->getId());
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

		//Funcionario / Empresa

		public function funcionarioEmpresa($empresa)
		{
			$sql = "SELECT *
					FROM funcionario f
					INNER JOIN empresa e ON (f.id_empresa = e.id_empresa)
					WHERE e.id_empresa = ?";
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