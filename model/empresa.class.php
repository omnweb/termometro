<?php
	class empresa
	{
		private $id;
		private $status;
		private $descritivo;		
		private $cnpj;
		private $telefone;
		private $contato;
		
		public function __construct($id="", $status="", $descritivo="", $cnpj="", $telefone="", $contato="")
		{
			$this->id = $id;
			$this->status = $status;
			$this->descritivo = $descritivo;
			$this->cnpj = $cnpj;
			$this->telefone = $telefone;
			$this->contato = $contato;			
		}//construct
		
		public function getId()
		{
			return $this->id;
		}			
		public function getStatus()
		{
			return $this->status;
		}
		public function getDescritivo()
		{
			return $this->descritivo;
		}
		public function getCnpj()
		{
			return $this->cnpj;
		}
		public function getTelefone()
		{
			return $this->telefone;
		}
		public function getContato()
		{
			return $this->contato;
		}			
	}//class
?>