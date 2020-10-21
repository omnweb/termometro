<?php
	class pesquisa
	{
		private $id;		
		private $id_campanha;
		private $data_pesquisa;				
		private $atendimento;
		private $espera;
		private $ambiente;
		private $qualidade_produtos;
		private $item;
		private $observacao;	
		
		function __construct($id="", $id_campanha="", $data_pesquisa="", $atendimento="", $espera="", $ambiente="", $qualidade_produtos="", $item="", $observacao="")
		{
			$this->id = $id;
			$this->id_campanha = $id_campanha;							
			$this->data_pesquisa = $data_pesquisa;
			$this->atendimento = $atendimento;
			$this->espera = $espera;
			$this->ambiente = $ambiente;
			$this->qualidade_produtos = $qualidade_produtos;
			$this->item= $item;	
			$this->observacao = $observacao;				

		}//construct
		function getId()
		{
			return $this->id;
		}
		function getIdCampanha()
		{
			return $this->id_campanha;
		}
		function getData_pesquisa()
		{
			return $this->data_pesquisa;
		}
		function getAtendimento()
		{
			return $this->atendimento;
		}
		function getEspera()
		{
			return $this->espera;
		}
		function getAmbiente()
		{
			return $this->ambiente;
		}	
		function getQualidade_produtos()
		{
			return $this->qualidade_produtos;
		}
		function getItem()
		{
			return $this->item;
		}		
		function getObservacao()
		{
			return $this->observacao;
		}	
	}//class
?>