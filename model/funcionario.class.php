<?php
	class funcionario
	{
		private $id;
		private $id_perfil;	
		private $id_empresa;	
		private $status;
		private $nome;		
		private $email;
		private $senha;
		
		
		public function __construct($id="", $id_perfil="", $id_empresa="", $status="",$nome="", $email="", $senha="")
		{
			$this->id = $id;
			$this->id_perfil = $id_perfil;
			$this->id_empresa = $id_empresa;
			$this->status = $status;
			$this->nome = $nome;			
			$this->email = $email;
			$this->senha = $senha;		
		}//construct
		
		public function getId()
		{
			return $this->id;
		}	
		public function getId_perfil()
		{
			return $this->id_perfil;
		}
		public function getId_empresa()
		{
			return $this->id_empresa;
		}		
		public function getStatus()
		{
			return $this->status;
		}
		public function getNome()
		{
			return $this->nome;
		}		
		public function getEmail()
		{
			return $this->email;
		}
		
		public function getSenha()
		{
			return $this->senha;
		}
		public function setId_perfil($id_perfil)
		{
			$this->id_perfil = $id_perfil;
		}
		public function setId_empresa($id_empresa)
		{
			$this->id_empresa = $id_empresa;
		}		
	}//class
?>