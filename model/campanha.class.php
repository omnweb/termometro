<?php
	class campanha
	{
		private $id;
		private $id_empresa;
		private $id_funcionario;
		private $status;
		private $descritivo;
				
		public function __construct($id="", $id_empresa="", $id_funcionario="", $status="", $descritivo="")
		{
			$this->id = $id;
			$this->id_empresa = $id_empresa;
			$this->id_funcionario = $id_funcionario;
			$this->status = $status;
			$this->descritivo = $descritivo;
			
		}//construct
		
		public function getId()
		{
			return $this->id;
		}
		public function getId_empresa()
		{
			return $this->id_empresa;
		}
		public function getId_funcionario()
		{
			return $this->id_funcionario;
		}
		public function getStatus()
		{
			return $this->status;
		}			
		public function getDescritivo()
		{
			return $this->descritivo;
		}
	}//class
?>